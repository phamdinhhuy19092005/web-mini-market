<script>
    const ORDER_ADD_TO_CART = {
    cart_items: {},
    elements: {
        btn_add: $('#btn_add_to_cart'),
        cart_item: $('[name="inventory_id"]'),
        table: $('#items_in_cart_table'),
    },

    init: () => {
        ORDER_ADD_TO_CART.onAddToCart();
        ORDER_ADD_TO_CART.onSubmit();
    },

    onAddToCart: () => {
        ORDER_ADD_TO_CART.elements.btn_add.on('click', function() {
            const inventoryId = ORDER_ADD_TO_CART.elements.cart_item.val();

            // Kiểm tra inventoryId hợp lệ
            if (!inventoryId || isNaN(inventoryId) || inventoryId === 'undefined') {
                fstoast.error('Vui lòng chọn một sản phẩm hợp lệ.');
                return;
            }

            const option = $(`[name="inventory_id"] option[data-inventory-id="${inventoryId}"]`);
            let value;
            try {
                value = JSON.parse(option.attr('data-value') || '{}');
            } catch (err) {
                console.error('Lỗi parse data-value:', err);
                fstoast.error('Dữ liệu sản phẩm không hợp lệ.');
                return;
            }

            // Kiểm tra các trường bắt buộc trong value
            if (!value.id || isNaN(value.id) || !value.title || !value.final_price || !value.stock_quantity) {
                console.error('Thông tin sản phẩm không đầy đủ:', value);
                fstoast.error('Thông tin sản phẩm không đầy đủ hoặc không hợp lệ.');
                return;
            }

            // Kiểm tra sản phẩm đã có trong giỏ
            if (ORDER_ADD_TO_CART.cart_items[inventoryId]) {
                fstoast.warning("{{ __('Sản phẩm đã được thêm') }}");
                return;
            }

            // Tạo đối tượng accepted với các giá trị đã được xác thực
            const accepted = {
                id: parseInt(value.id), // Đảm bảo id là số nguyên
                image: value.image || '',
                title: value.title,
                final_price: parseFloat(value.final_price),
                stock_quantity: parseInt(value.stock_quantity),
            };

            ORDER_ADD_TO_CART.cart_items[inventoryId] = {
                ...accepted,
                changed: { quantity: 1, price: accepted.final_price },
            };

            ORDER_ADD_TO_CART.elements.cart_item.val('');
            ORDER_ADD_TO_CART.elements.cart_item.selectpicker('refresh');

            ORDER_ADD_TO_CART.renderCartItems(ORDER_ADD_TO_CART.cart_items);
            ORDER_ADD_TO_CART.recalculateTotalOfCart(ORDER_ADD_TO_CART.cart_items);
            ORDER_ADD_TO_CART.onChangeQuantity();
        });
    },

    onChangeQuantity: () => {
        $('[data-value="cart_quantity"]').off('change').on('change', function() {
            const value = parseInt($(this).val());
            const price = parseFloat($(this).attr('data-price'));
            const inventoryId = $(this).attr('data-inventory-id');

            // Kiểm tra số lượng hợp lệ
            if (isNaN(value) || value < 1) {
                fstoast.error('Số lượng không hợp lệ.');
                $(this).val(1);
                return;
            }

            console.log({ inventoryId });

            const finalPrice = price * value;
            ORDER_ADD_TO_CART.cart_items[inventoryId] = {
                ...ORDER_ADD_TO_CART.cart_items[inventoryId],
                changed: { quantity: value, price: finalPrice },
            };

            ORDER_ADD_TO_CART.renderCartItems(ORDER_ADD_TO_CART.cart_items);
            ORDER_ADD_TO_CART.recalculateTotalOfCart(ORDER_ADD_TO_CART.cart_items);
        });
    },

    renderCartItems: (items) => {
        const itemsDom = Object.values(items).map((item, index) => {
            // Kiểm tra item.id để tránh undefined
            if (!item.id || isNaN(item.id)) {
                console.error('ID sản phẩm không hợp lệ:', item);
                return ''; // Bỏ qua mục không hợp lệ
            }

            return `
                <tr>
                    <th>${item.id}</th>
                    <th><img src="${item.image || ''}" width="50" alt=""></th>
                    <th>${item.title}</th>
                    <th><input type="text" value="${fscommon.formatPrice(item.final_price)}" class="form-control" disabled></th>
                    <th>
                        <input type="hidden" name="cart_items[${index}][inventory_id]" value="${item.id}" />
                        <input type="number" name="cart_items[${index}][quantity]" 
                               data-value="cart_quantity" 
                               data-price="${item.final_price}" 
                               data-inventory-id="${item.id}" 
                               step="1" 
                               value="${item.changed.quantity}" 
                               min="1" 
                               max="${item.stock_quantity}" 
                               class="form-control">
                    </th>
                    <th><input type="text" value="${fscommon.formatPrice(item.changed.price)}" class="form-control" disabled></th>
                    <th>
                        <button type="button" class="btn btn-danger btn-icon" onclick="ORDER_ADD_TO_CART.removeItem('${item.id}')">
                            <i class="flaticon-delete"></i>
                        </button>
                    </th>
                </tr>
            `;
        }).filter(row => row !== ''); // Loại bỏ các hàng không hợp lệ

        ORDER_ADD_TO_CART.elements.table.find('tbody').html(itemsDom);
    },

    removeItem: (inventoryId) => {
        delete ORDER_ADD_TO_CART.cart_items[inventoryId];
        ORDER_ADD_TO_CART.renderCartItems(ORDER_ADD_TO_CART.cart_items);
        ORDER_ADD_TO_CART.recalculateTotalOfCart(ORDER_ADD_TO_CART.cart_items);
    },

    recalculateTotalOfCart: (items) => {
        const totalPrice = Object.values(items).reduce((prev, curr) => prev + parseFloat(curr.changed.price), 0);
        const totalQuantity = Object.values(items).reduce((prev, curr) => prev + parseFloat(curr.changed.quantity), 0);

        console.log('Total Quantity:', totalQuantity);
        console.log('Total Price:', totalPrice);

        const table = ORDER_ADD_TO_CART.elements.table || $('#items_in_cart_table');

        table.find('tfoot [data-name="total_quantity"]').val(totalQuantity);
        table.find('tfoot [data-name="total_price"]').val(fscommon.formatPrice(totalPrice));

        $('#input_total_quantity').val(totalQuantity);
        $('#input_total_price').val(totalPrice);
    },


    renderShippingOptions: () => {
        const { province_code, district_code, ward_code } = ADDRESS_MANAGEMENT.address_info;

        if (!province_code || !district_code || !ward_code) {
            console.warn('Thiếu thông tin địa chỉ:', { province_code, district_code, ward_code });
            const element = $('[name="shipping_option_id"]');
            element.prop('disabled', true).selectpicker('refresh');
            fstoast.warning('Vui lòng chọn đầy đủ Tỉnh/TP, Quận/Huyện và Phường/Xã.');
            return;
        }

        const route = "{{ route('bo.api.shipping-options.available') }}";

        $.ajax({
            url: route,
            method: 'GET',
            data: { status: 1, province_code, paginate: false },
            success: (response) => {
                console.log('📦 Response từ server:', response);
                console.log('Phản hồi từ API shipping-options:', response);

                const shippingOptions = Array.isArray(response) ? response : (response.data || []);
                const element = $('[name="shipping_option_id"]');
                element.html('');

                if (!shippingOptions.length) {
                    console.warn('Không có tùy chọn vận chuyển:', shippingOptions);
                    element.prop('disabled', true).selectpicker('refresh');
                    fstoast.warning('Không có tùy chọn vận chuyển nào khả dụng cho địa chỉ này.');
                    return;
                }

                element.prop('disabled', false);
                const options = shippingOptions.map(option =>
                    $('<option>')
                        .attr('data-option-name', option.name)
                        .val(option.id)
                        .text(option.name)
                );

                element.html(options).selectpicker('refresh').trigger('changed.bs.select');

                if (shippingOptions.length === 1) {
                    element.selectpicker('val', shippingOptions[0].id);
                    console.log('Tự động chọn shipping_option_id:', shippingOptions[0].id);
                } else {
                    element.val(null).selectpicker('refresh');
                    fstoast.info('Vui lòng chọn một tùy chọn vận chuyển.');
                }
            },
            error: (err) => {
                console.error('Lỗi khi tải tùy chọn vận chuyển:', err);
                const element = $('[name="shipping_option_id"]');
                element.prop('disabled', true).selectpicker('refresh');
                fstoast.error('Lỗi khi tải tùy chọn vận chuyển. Vui lòng thử lại.');
            },
        });
    },

    onSubmit: () => {
        $('#form_create_order').on('submit', function(e) {
            e.preventDefault();

            const requiredFields = ['user_id', 'order_channel[type]', 'province_code', 'district_code', 'ward_code', 'shipping_option_id', 'payment_option_id'];
            let hasError = false;
            requiredFields.forEach(field => {
                const element = $(`[name="${field}"]`);
                if (!element.val() || element.prop('disabled')) {
                    console.error(`Trường ${field} trống hoặc bị vô hiệu hóa`);
                    hasError = true;
                }
            });

            // Kiểm tra giỏ hàng
            if (!Object.keys(ORDER_ADD_TO_CART.cart_items).length) {
                console.error('Giỏ hàng trống');
                hasError = true;
            }

            // Kiểm tra cart_items
            Object.values(ORDER_ADD_TO_CART.cart_items).forEach((item, index) => {
                if (!item.id || isNaN(item.id)) {
                    console.error(`cart_items[${index}][inventory_id] không hợp lệ:`, item.id);
                    fstoast.error(`Sản phẩm tại vị trí ${index + 1} có ID không hợp lệ.`);
                    hasError = true;
                }
            });

            if (hasError) {
                fstoast.error('Vui lòng điền đầy đủ các trường bắt buộc, chọn tùy chọn vận chuyển và thêm sản phẩm hợp lệ vào giỏ hàng.');
                return;
            }

            const formData = $(this).serialize();
            console.log('Dữ liệu gửi đi:', formData);

            const route = "{{ route('bo.web.orders.store') }}";

            $.ajax({
                url: route,
                method: 'POST',
                data: formData,
                success: (response) => {
                    console.log('Phản hồi thành công:', JSON.stringify(response, null, 2));
                    let orderId = response?.data?.id || response?.id || response?.order?.id;
                    if (orderId) {
                        const redirectUrl = "{{ route('bo.web.orders.edit', ['id' => ':id']) }}".replace(':id', orderId);
                        console.log('Chuyển hướng đến:', redirectUrl);
                        window.location.href = redirectUrl;
                    } else {
                        console.error('❌ Không tìm thấy ID đơn hàng trong phản hồi:', response);
                        fstoast.error('Không lấy được ID đơn hàng từ phản hồi.');
                    }
                    $('#form_create_order').find('[type="submit"]').prop('disabled', false);
                },
                error: (xhr, status, error) => {
                    console.error('Lỗi AJAX:', { status: xhr.status, response: xhr.responseJSON || xhr.responseText, error });
                    let errorMessage = 'Đã xảy ra lỗi khi lưu đơn hàng. Vui lòng kiểm tra lại.';
                    if (xhr.status === 422 && xhr.responseJSON?.errors) {
                        errorMessage = 'Dữ liệu không hợp lệ: ' + Object.values(xhr.responseJSON.errors).flat().join(', ');
                    } else if (xhr.responseJSON?.message) {
                        errorMessage = 'Lỗi: ' + xhr.responseJSON.message;
                    } else if (xhr.responseText.includes('Sfdump')) {
                        errorMessage = 'Lỗi server nội bộ. Vui lòng kiểm tra log server Laravel.';
                    }
                    fstoast.error(errorMessage);
                    $('#form_create_order').find('[type="submit"]').prop('disabled', false);
                },
            });
        });
    },
};

// Quản lý địa chỉ (giữ nguyên, không cần sửa)
const ADDRESS_MANAGEMENT = {
    address_info: {
        province_code: null,
        district_code: null,
        ward_code: null,
    },

    init: () => {
        ADDRESS_MANAGEMENT.onChangeProvince();
        ADDRESS_MANAGEMENT.onChangeDistrict();
        ADDRESS_MANAGEMENT.onChangeWard();
    },

    onChangeProvince: () => {
        $('[name="province_code"]').on('change', function() {
            const code = $(this).val();
            ADDRESS_MANAGEMENT.address_info.province_code = code;
            ADDRESS_MANAGEMENT.address_info.district_code = null;
            ADDRESS_MANAGEMENT.address_info.ward_code = null;
            $('[name="district_code"]').html('').prop('disabled', true).selectpicker('refresh');
            $('[name="ward_code"]').html('').prop('disabled', true).selectpicker('refresh');
            ADDRESS_MANAGEMENT.renderDistrictsByProvince(code);
        });
    },

    onChangeDistrict: () => {
        $('[name="district_code"]').on('change', function() {
            const code = $(this).val();
            ADDRESS_MANAGEMENT.address_info.district_code = code;
            ADDRESS_MANAGEMENT.address_info.ward_code = null;
            $('[name="ward_code"]').html('').prop('disabled', true).selectpicker('refresh');
            ADDRESS_MANAGEMENT.renderWardsByDistrict(code);
        });
    },

    onChangeWard: () => {
        $('[name="ward_code"]').on('change', function() {
            const code = $(this).val();
            console.log('Ward selected:', code);
            ADDRESS_MANAGEMENT.address_info.ward_code = code;
            if (ADDRESS_MANAGEMENT.address_info.province_code &&
                ADDRESS_MANAGEMENT.address_info.district_code &&
                ADDRESS_MANAGEMENT.address_info.ward_code) {
                ORDER_ADD_TO_CART.renderShippingOptions();
            }
        });
    },

    renderDistrictsByProvince: (province) => {
        try {
            const element = $('[name="district_code"]');
            const districts = JSON.parse(element.attr('data-districts') || '[]');
            const originalValues = JSON.parse(element.attr('data-original-value') || '[]');
            const filteredDistricts = districts.filter(district => province == district.province_code);

            element.html('').prop('disabled', !filteredDistricts.length).selectpicker('refresh').trigger('changed.bs.select');

            if (!filteredDistricts.length) return;

            const options = filteredDistricts.map(district =>
                $('<option>')
                    .attr('data-tokens', `${district.code} | ${district.full_name}`)
                    .attr('data-district-code', district.code)
                    .attr('data-district-name', district.full_name)
                    .val(district.code)
                    .text(district.full_name)
            );

            element.html(options).selectpicker('refresh').selectpicker('val', originalValues);
        } catch (err) {
            console.error('Lỗi renderDistrictsByProvince:', err);
        }
    },

    renderWardsByDistrict: (district) => {
        try {
            const element = $('[name="ward_code"]');
            const wards = JSON.parse(element.attr('data-wards') || '[]');
            const filteredWards = wards.filter(ward => district == ward.district_code);

            element.html('').prop('disabled', !filteredWards.length).selectpicker('refresh').trigger('changed.bs.select');

            if (!filteredWards.length) {
                ADDRESS_MANAGEMENT.address_info.ward_code = null;
                return;
            }

            const options = filteredWards.map(ward =>
                $('<option>')
                    .attr('data-tokens', `${ward.code} | ${ward.full_name}`)
                    .attr('data-ward-code', ward.code)
                    .attr('data-ward-name', ward.full_name)
                    .val(ward.code)
                    .text(ward.full_name)
            );

            element.html(options).selectpicker('refresh');

            element.off('change').on('change', function() {
                const code = $(this).val();
                console.log('Ward selected:', code);
                ADDRESS_MANAGEMENT.address_info.ward_code = code;
                if (ADDRESS_MANAGEMENT.address_info.province_code &&
                    ADDRESS_MANAGEMENT.address_info.district_code &&
                    ADDRESS_MANAGEMENT.address_info.ward_code) {
                    ORDER_ADD_TO_CART.renderShippingOptions();
                }
            });

            if (filteredWards.length === 1) {
                const onlyWardCode = filteredWards[0].code;
                element.selectpicker('val', onlyWardCode).trigger('change');
                ADDRESS_MANAGEMENT.address_info.ward_code = onlyWardCode;
            } else {
                element.val(null).selectpicker('refresh');
                ADDRESS_MANAGEMENT.address_info.ward_code = null;
            }
        } catch (err) {
            console.error('Lỗi renderWardsByDistrict:', err);
        }
    },
};

// Khởi tạo
ADDRESS_MANAGEMENT.init();
ORDER_ADD_TO_CART.init();


</script>
