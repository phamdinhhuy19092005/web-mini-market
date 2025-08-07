<div class="row">
    <!-- Key Features Section -->
    <div class="col-md-12">
        <div class="k-portlet">
            <div class="k-portlet__head">
                <div class="k-portlet__head-label">
                    <h3 class="k-portlet__head-title">{{ __('Đặc điểm nổi bật') }}</h3>
                </div>
            </div>
            <div class="k-portlet__body">
                <div class="key_features_repeater">
                    <div data-repeater-list="key_features">
                        @if (empty(old('key_features')) && empty($inventory->key_features))
                            @if (empty($commonInventoryKeyFeatured))
                                <div data-repeater-item class="k-repeater__item mb-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text"
                                                   name="title"
                                                   class="form-control"
                                                   placeholder="{{ __('Nhập đặc điểm nổi bật') }}"
                                                   value="">
                                            <div class="input-group-append">
                                                <button data-repeater-delete
                                                        class="btn btn-secondary"
                                                        type="button">
                                                    <i class="la la-close"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @error('key_features.*.title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @else
                                @foreach ($commonInventoryKeyFeatured as $item)
                                    <div data-repeater-item class="k-repeater__item mb-3">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text"
                                                       name="title"
                                                       class="form-control"
                                                       placeholder="{{ __('Nhập đặc điểm nổi bật') }}"
                                                       value="{{ old('key_features.*.title', data_get($item, 'name', '')) }}">
                                                <div class="input-group-append">
                                                    <button data-repeater-delete
                                                            class="btn btn-secondary"
                                                            type="button">
                                                        <i class="la la-close"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            @error('key_features.*.title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @else
                            @foreach (old('key_features', $inventory->key_features ?? []) as $keyFeature)
                                <div data-repeater-item class="k-repeater__item mb-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text"
                                                   name="title"
                                                   class="form-control"
                                                   placeholder="{{ __('Nhập đặc điểm nổi bật') }}"
                                                   value="{{ old('key_features.*.title', data_get($keyFeature, 'title', '')) }}">
                                            <div class="input-group-append">
                                                <button data-repeater-delete
                                                        class="btn btn-secondary"
                                                        type="button">
                                                    <i class="la la-close"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @error('key_features.*.title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="k-repeater__add-data mt-3">
                        <button data-repeater-create
                                class="btn btn-info btn-sm"
                                type="button">
                            <i class="la la-plus"></i> {{ __('Thêm') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Information Section -->
    <div class="col-md-12">
        <div class="k-portlet">
            <div class="k-portlet__head">
                <div class="k-portlet__head-label">
                    <h3 class="k-portlet__head-title">{{ __('Thông tin chi tiết') }}</h3>
                </div>
            </div>
            <div class="k-portlet__body">
                <!-- Display on Frontend -->
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{ __('Hiển thị FE') }}</label>
                    <div class="col-md-3">
                        <span class="k-switch">
                            <label>
                                <input type="checkbox"
                                       name="display_on_frontend"
                                       value="1"
                                       {{ old('display_on_frontend', $inventory->display_on_frontend ?? false) ? 'checked' : '' }}>
                                <span></span>
                            </label>
                        </span>
                        @error('display_on_frontend')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Allow Frontend Search -->
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{ __('Tìm kiếm FE') }}</label>
                    <div class="col-md-3">
                        <span class="k-switch">
                            <label>
                                <input type="checkbox"
                                       name="allow_frontend_search"
                                       value="1"
                                       {{ old('allow_frontend_search', $inventory->allow_frontend_search ?? false) ? 'checked' : '' }}>
                                <span></span>
                            </label>
                        </span>
                        @error('allow_frontend_search')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Status -->
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{ __('Hoạt động') }}</label>
                    <div class="col-md-3">
                        <span class="k-switch">
                            <label>
                                <input type="checkbox"
                                       name="status"
                                       value="1"
                                       {{ old('status', $inventory->status ?? ($inventory->id ? $inventory->status : true)) ? 'checked' : '' }}>
                                <span></span>
                            </label>
                        </span>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        $('.key_features_repeater').repeater({
            initEmpty: false,
            defaultValues: {
                'title': ''
            },
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if (confirm('Bạn có chắc chắn muốn xoá đặc điểm này không?')) {
                    $(this).slideUp(deleteElement);
                }
            },
            ready: function (setIndexes) {
               
            }
        });
    });
</script>
@endpush
