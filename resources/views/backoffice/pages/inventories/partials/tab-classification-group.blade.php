<div class="tab-pane" id="Tab_Classification_Group">
    <div class="k-portlet">
        <div class="k-portlet__head">
            <div class="k-portlet__head-label">
                <h3 class="k-portlet__head-title">Nhóm phân loại</h3>
            </div>
        </div>
        <div class="k-portlet__body">
            <!-- Hiển thị attribute_values đã chọn -->
            @php
                $grouped = $inventory->attributeValues->groupBy(fn($value) => optional($value->attribute)->name);
            @endphp

            @if ($grouped->isNotEmpty())
                <div class="attribute-list">
                    @foreach ($grouped as $attributeName => $values)
                        <div class="border border-success rounded px-3 py-2 mb-2 d-inline-block">
                            <div class="d-flex align-items-center">
                                <span class="font-weight-bold mr-2" style="color: #1EC9B7;">
                                    [{{ $loop->iteration }}] {{ $attributeName }}:
                                </span>
                                <span class="text-dark">
                                    {{ $values->pluck('value')->join(' ; ') }}
                                </span>
                                @foreach ($values as $value)
                                    <input type="hidden"
                                           name="attribute_values[{{ $value->attribute->id }}][]"
                                           value="{{ $value->id }}">
                                @endforeach
                                <button type="button"
                                        class="btn btn-sm btn-outline-danger ml-3"
                                        onclick="removeAttributeGroup('{{ $attributeName }}', this)">
                                    ×
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Product Details Section -->
<div class="row">
    <div class="col-md-12">
        <div class="k-portlet">
            <div class="k-portlet__body">
                <!-- Image Upload -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="form-label">
                                {{ __('Hình Ảnh') }} <span class="text-danger">*</span>
                            </label>
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <div class="input-group">
                                        <input type="text" class="form-control image-url" name="image[path]" placeholder="{{ __('Tải ảnh lên hoặc nhập URL') }}"
                                            value="{{ old('image.path', $inventory->image) }}">
                                        <div class="input-group-append">
                                            <label class="btn btn-outline-primary m-0" for="image-file">
                                                <i class="flaticon2-image-file mr-2"></i>{{ __('Tải lên') }}
                                                <input type="file"
                                                    id="image-file"
                                                    name="image[file]"
                                                    class="d-none image-file"
                                                    accept="image/*">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <img class="img-thumbnail image-preview" style="width: 100px; height: 100px; object-fit: cover; display: {{ old('image.path', $inventory->image ?? $product->primary_image) ? 'block' : 'none' }};"
                                        src="{{ old('image.path', $inventory->image ?? $product->primary_image) }}"
                                        alt="Image preview">
                                </div>
                            </div>
                            @error('image.*')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Title -->
                <div class="form-group">
                    <label for="title">{{ __('Tiêu đề') }} <span class="text-danger">*</span></label>
                    <input type="text"
                           name="title"
                           id="title"
                           class="form-control"
                           placeholder="{{ __('Nhập tiêu đề sản phẩm') }}"
                           autocomplete="off"
                           value="{{ old('title', $inventory->title ?? $product->name) }}"
                           required>
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Slug -->
                <div class="form-group">
                    <label for="slug">{{ __('Slug') }} <span class="text-danger">*</span></label>
                    <input type="text"
                           name="slug"
                           id="slug"
                           class="form-control"
                           placeholder="{{ __('Nhập slug sản phẩm') }}"
                           autocomplete="off"
                           value="{{ old('slug', $inventory->slug ?? $product->slug) }}"
                           required>
                    @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- SKU and Condition -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sku">{{ __('SKU') }} <span class="text-danger">*</span>
                                <i data-toggle="tooltip"
                                   class="flaticon-questions-circular-button"
                                   data-title="SKU (Đơn vị lưu kho) là mã nhận dạng cụ thể của người bán. Nó sẽ giúp quản lý hàng tồn kho của bạn."></i>
                            </label>
                            <div class="input-group">
                                <input id="sku"
                                       type="text"
                                       name="sku"
                                       class="form-control {{ $errors->has('sku') ? 'is-invalid' : '' }}"
                                       value="{{ old('sku', $inventory->sku ?? '') }}">
                                @empty($inventory->id)
                                    <div class="input-group-append">
                                        <button class="btn btn-primary"
                                                data-generate
                                                data-generate-length="5"
                                                data-generate-ref="#sku"
                                                data-generate-prefix="{{ $product->code ?? '' }}-"
                                                data-generate-uppercase="true"
                                                type="button">{{ __('Generate SKU') }}</button>
                                    </div>
                                @endempty
                            </div>
                            @error('sku')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="condition">{{ __('Tình trạng') }} <span class="text-danger">*</span>
                                <i data-toggle="tooltip"
                                   class="flaticon-questions-circular-button"
                                   data-title="Tình trạng hiện tại của sản phẩm là gì?"></i>
                            </label>
                            <select name="condition"
                                    id="condition"
                                    class="form-control k_selectpicker {{ $errors->has('condition') ? 'is-invalid' : '' }}"
                                    required>
                                @foreach($inventoryConditionEnumLabels as $key => $label)
                                    <option value="{{ (int) $key }}" {{ (int) old('condition', $inventory->condition) === (int) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('condition')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Stock Quantity and Purchase Price -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stock_quantity">{{ __('Số lượng') }} <span class="text-danger">*</span>
                                <i data-toggle="tooltip"
                                   class="flaticon-questions-circular-button"
                                   data-title="Số lượng mặt hàng bạn có trong kho của mình"></i>
                            </label>
                            <input type="text"
                                   name="stock_quantity"
                                   id="stock_quantity"
                                   class="form-control {{ $errors->has('stock_quantity') ? 'is-invalid' : '' }}"
                                   placeholder="{{ __('Nhập số lượng tồn kho') }}"
                                   value="{{ old('stock_quantity', $inventory->stock_quantity ?? '') }}"
                                   required>
                            @error('stock_quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="purchase_price">{{ __('Giá mua') }}
                                <i data-toggle apparatus="tooltip"
                                   class="flaticon-questions-circular-button"
                                   data-title="Trường được đề xuất. Điều này sẽ giúp tính toán lợi nhuận và tạo báo cáo"></i>
                            </label>
                            <input type="text"
                                   data-digits="2"
                                   data-type="inputmask_numeric"
                                   data-allow-minus="false"
                                   class="form-control {{ $errors->has('purchase_price') ? 'is-invalid' : '' }}"
                                   data-key="purchase_price"
                                   id="purchase_price"
                                   value="{{ old('purchase_price', $inventory->purchase_price ?? '') }}">
                            <input type="hidden"
                                   data-type="inputmask_numeric_unmasked"
                                   name="purchase_price"
                                   data-key="purchase_price"
                                   value="{{ old('purchase_price', $inventory->purchase_price ?? '') }}">
                            @error('purchase_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Sale Price and Offer Price -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sale_price">{{ __('Giá bán') }} <span class="text-danger">*</span>
                                <i data-toggle="tooltip"
                                   class="flaticon-questions-circular-button"
                                   data-title="Giá chưa có thuế. Thuế sẽ được tính tự động dựa trên khu vực vận chuyển."></i>
                            </label>
                            <input type="text"
                                   data-digits="2"
                                   data-type="inputmask_numeric"
                                   data-allow-minus="false"
                                   class="form-control {{ $errors->has('sale_price') ? 'is-invalid' : '' }}"
                                   data-key="sale_price"
                                   id="sale_price"
                                   name="sale_price"
                                   value="{{ old('sale_price', $inventory->sale_price ?? '') }}"
                                   required>
                            <input type="hidden"
                                   data-type="inputmask_numeric_unmasked"
                                   name="sale_price"
                                   data-key="sale_price"
                                   value="{{ old('sale_price', $inventory->sale_price ?? '') }}">
                            @error('sale_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group variant_offer_price">
                            <label for="offer_price">{{ __('Giá khuyến mãi') }}
                                <i data-toggle="tooltip"
                                   class="flaticon-questions-circular-button"
                                   data-title="Giá ưu đãi sẽ được thực hiện giữa ngày bắt đầu và ngày kết thúc ưu đãi"></i>
                            </label>
                            <input type="text"
                                   data-digits="2"
                                   data-type="inputmask_numeric"
                                   data-allow-minus="false"
                                   class="form-control {{ $errors->has('offer_price') ? 'is-invalid' : '' }}"
                                   data-key="offer_price"
                                   id="offer_price"
                                   name="offer_price"
                                   value="{{ old('offer_price', $inventory->offer_price ?? '') }}">
                            <input type="hidden"
                                   data-type="inputmask_numeric_unmasked"
                                   name="offer_price"
                                   data-key="offer_price"
                                   value="{{ old('offer_price', $inventory->offer_price ?? '') }}">
                            @error('offer_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/backoffice/components/form-utils.js') }}"></script>
<script>
    $(document).ready(function () {
        // Khởi tạo selectpicker
        $('.k_selectpicker').selectpicker();

        // Xử lý generate SKU
        $('[data-generate]').on('click', function () {
            const length = $(this).data('generate-length') || 5;
            const ref = $(this).data('generate-ref');
            const prefix = $(this).data('generate-prefix') || '';
            const uppercase = $(this).data('generate-uppercase') ?? true;

            let charset = 'abcdefghijklmnopqrstuvwxyz0123456789';
            if (uppercase) {
                charset = charset.toUpperCase();
            }

            let randomStr = '';
            for (let i = 0; i < length; i++) {
                const randIndex = Math.floor(Math.random() * charset.length);
                randomStr += charset[randIndex];
            }

            const result = prefix + randomStr;
            $(ref).val(result);
        });

        // Xử lý xóa attribute group
        window.removeAttributeGroup = function(attributeName, button) {
            if (!confirm('Bạn có chắc muốn xóa nhóm phân loại này không?')) return;
            button.closest('.border').remove();
        };
    });
</script>
@endpush
