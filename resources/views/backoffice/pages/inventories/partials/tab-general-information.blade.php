<div class="row">
    <div class="col-md-12">
        <div class="k-portlet">
            <div class="k-portlet__head">
                <div class="k-portlet__head-label d-flex justify-content-between align-items-center w-100">
                    <h3 class="k-portlet__head-title mb-0">Sản phẩm</h3>
                    <a href="{{ route('bo.web.products.edit', $selectedProduct->id) }}" target="_blank" class="btn btn-sm" style="background-color: #e83e8c; color: white;">
                        <i class="flaticon-eye"></i>
                        <span>Chi tiết</span>
                    </a>
                </div>
            </div>
            <div class="k-portlet__body">
                <div class="row">
                    <!-- Product Image -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="mt-2">
                                <img class="img-fluid image-preview" 
                                     style="max-width: 180px; display: {{ $selectedProduct->primary_image ? 'block' : 'none' }};" 
                                     src="{{ $selectedProduct->primary_image ?? '' }}" 
                                     alt="Image preview">
                            </div>
                            @error('image.*')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- Product Details -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="product_name">Tên</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="product_name" 
                                   name="product_name" 
                                   value="{{ $selectedProduct ? '[' . $selectedProduct->id . '] [' . ($selectedProduct->code ?? 'N/A') . '] ' . $selectedProduct->name . ' (' . ($selectedProduct->type_name ?? 'N/A') . ')' : '' }}" 
                                   disabled>
                            <input type="hidden" 
                                   name="product_id" 
                                   id="product_id" 
                                   value="{{ $selectedProduct ? $selectedProduct->id : '' }}">
                            @error('product_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @if(!$selectedProduct && request()->query('product_id'))
                                <span class="text-danger">{{ __('Sản phẩm không hợp lệ hoặc không phải loại simple') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="category_names">Danh mục</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="category_names" 
                                   name="category_names" 
                                   value="{{ $selectedProduct && $selectedProduct->categories ? $selectedProduct->categories->pluck('name')->join(', ') : '' }}" 
                                   disabled>
                            @error('category_names')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- Brand and Status -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="brand_name">Thương hiệu</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="brand_name" 
                                   name="brand_name" 
                                   value="{{ $selectedProduct && $selectedProduct->brand ? $selectedProduct->brand->name : '' }}" 
                                   disabled>
                            @error('brand_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Trạng thái</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="status" 
                                   name="status" 
                                   value="{{ $selectedProduct && $selectedProduct->status_name ? $selectedProduct->status_name : '' }}" 
                                   disabled>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Information -->
<div class="row">
    <div class="col-md-12">
        <div class="k-portlet">
            <div class="k-portlet__head">
                <div class="k-portlet__head-label">
                    <h3 class="k-portlet__head-title">Sản phẩm kho</h3>
                </div>
            </div>
            <div class="k-portlet__body">
                {{-- @if ($inventory->id)
                    <div class="form-group">
                        <label for="">{{ __('Xem chi tiết') }} *</label>

                        <div>
                            <a href="{{ route('fe.web.products.index', ['slug' => data_get($inventory, 'slug'), 'sku' => data_get($inventory, 'sku')]) }}" target="_blank">
                                {{ route('fe.web.products.index', ['slug' => data_get($inventory, 'slug'), 'sku' => data_get($inventory, 'sku')]) }}
                            </a>

                            <button type="button" data-copy-clipboard data-copy-clipboard-content="{{ route('fe.web.products.index', ['slug' => data_get($inventory, 'slug'), 'sku' => data_get($inventory, 'sku')]) }}" class="btn btn-sm btn-outline-primary ml-2">{{ __('COPY') }}</button>
                        </div>
                    </div>
                @endif --}}
                <!-- Name -->
                <div class="form-group">
                    <label for="title">Tiêu đề <span class="text-danger">*</span></label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           class="form-control" 
                           placeholder="Nhập tên tiêu đề" 
                           autocomplete="off" 
                           value="{{ old('title', $inventory->title ?? '') }}" 
                           required>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <!-- Available From -->
                        <div class="form-group">
                            <label for="available_from">{{ __('Có sẵn từ') }}
                                <i data-toggle="tooltip" 
                                data-title="Ngày mà hàng sẽ có sẵn. Mặc định = ngay lập tức" 
                                class="flaticon-questions-circular-button"></i>
                            </label>
                            <input type="datetimepicker" 
                                class="form-control @error('available_from') is-invalid @enderror" 
                                name="available_from" 
                                value="{{ old('available_from', data_get($inventory, 'available_from', date('Y-m-d h:i:s', strtotime(now())))) }}">
                            @error('available_from')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Minimum Order Quantity -->
                        <div class="form-group">
                            <label for="min_order_quantity">{{ __('Số lượng đặt hàng tối thiểu') }}
                                <i data-toggle="tooltip" 
                                data-bs-title="Số lượng cho phép nhận đặt hàng. Phải là một giá trị số nguyên. Mặc định = 1" 
                                class="flaticon-questions-circular-button"></i>
                            </label>
                            <input type="number" 
                                class="form-control @error('min_order_quantity') is-invalid @enderror" 
                                id="min_order_quantity" 
                                name="min_order_quantity" 
                                value="{{ old('min_order_quantity', data_get($inventory, 'min_order_quantity', 1)) }}">
                            @error('min_order_quantity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>


                <!-- Weight and Fake Sold Count -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="weight">{{ __('Khối lượng (g)') }}</label>
                            <div class="input-group">
                                <input type="text" 
                                       name="weight" 
                                       id="weight" 
                                       class="form-control {{ $errors->has('weight') ? 'is-invalid' : '' }}" 
                                       placeholder="{{ __('10.01') }}" 
                                       value="{{ old('weight', $inventory->weight ?? '') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">{{ __('gam (g)') }}</span>
                                </div>
                            </div>
                            @error('weight')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="init_sold_count">{{ __('Fake số lượng bán') }}
                                <i data-toggle="tooltip" 
                                   data-bs-title="{{ __('Số lượng đã bán này chỉ dành cho khách hàng sử dụng.') }}" 
                                   class="flaticon-questions-circular-button"></i>
                            </label>
                            <input type="number" 
                                   class="form-control @error('init_sold_count') is-invalid @enderror" 
                                   id="init_sold_count" 
                                   name="init_sold_count" 
                                   min="0" 
                                   value="{{ old('init_sold_count', data_get($inventory, 'init_sold_count', 0)) }}">
                            @error('init_sold_count')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- Offer Start and End Dates -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="offer_start">{{ __('Ngày bắt đầu ưu đãi') }}
                                <i data-toggle="tooltip" 
                                   data-bs-title="Một khuyến mãi phải có ngày bắt đầu. Bắt buộc nếu trường giá ưu đãi được cung cấp" 
                                   class="flaticon-questions-circular-button"></i>
                            </label>
                            <input type="datetimepicker" 
                                   class="form-control @error('offer_start') is-invalid @enderror" 
                                   id="offer_start" 
                                   name="offer_start" 
                                   value="{{ old('offer_start', $inventory->offer_start ?? '') }}">
                            @error('offer_start')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="offer_end">{{ __('Ngày kết thúc ưu đãi') }}</label>
                            <input type="datetimepicker" 
                                   class="form-control @error('offer_end') is-invalid @enderror" 
                                   id="offer_end" 
                                   name="offer_end" 
                                   value="{{ old('offer_end', $inventory->offer_end ?? '') }}">
                            @error('offer_end')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="content">Nội dung</label>
                    <x-backoffice.content-editor
                        id="condition_note"
                        name="condition_note"
                        :value="old('condition_note', $inventory->condition_note)"
                        :cols="30"
                        :rows="10"
                        placeholder=""
                        disk="public"
                        class=""
                        :config="[]"
                    />
                </div>
            </div>
        </div>
    </div>
</div>