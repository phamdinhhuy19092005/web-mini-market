@extends('backoffice.layouts.master')

@php
    $title = __('Edit Page');

    $breadcrumbs = [
        [
            'label' => __('Utilities'),
        ],
        [
            'label' => __('Blogs'),
        ],
        [
            'label' => __('Edit Page'),
        ],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
    <div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
        <div class="row">
            <div class="col-md">
                <!--begin::Portlet-->
                <div class="k-portlet">
                    <div class="k-portlet__head">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">Chỉnh sửa vùng vận chuyển</h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form action="{{ route('bo.web.shipping-zones.update', $shippingZone->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                         <div class="card-body">
                            <div class="form-group">
                                <label for="name">{{ __('Tên') }}</label>
                                <input type="text" name="name" id="name" class="form-control"
                                       placeholder="{{ __('Nhập tên') }}" autocomplete="off"
                                       value="{{ old('name', $shippingZone->name) }}"
                                       @error('name') is-invalid @enderror>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('Quốc gia hỗ trợ') }}</label>
                                <select
                                    name="supported_countries[]"
                                    class="form-control k_selectpicker Supported_Countries_Selector"
                                    title="-- {{ __('Chọn quốc gia') }} --"
                                    data-actions-box="true"
                                    data-size="5"
                                    data-live-search="true"
                                    data-selected-text-format="count > 5"
                                    multiple
                                >
                                    @foreach($countries as $country)
                                        <option
                                            value="{{ $country->iso2 }}"
                                            data-tokens="{{ $country->iso2 }} | {{ $country->name }}"
                                            data-subtext="{{ $country->iso2 }}"
                                            data-country-iso2="{{ $country->iso2 }}"
                                            data-country-name="{{ $country->name }}"
                                            {{ in_array($country->iso2, old('supported_countries', $shippingZone->supported_countries ?? [])) ? 'selected' : '' }}
                                        >
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('supported_countries')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <div class="Badge_Holder_Wrapper form-group Supported_Countries_Allowed_Holder mb-0">
                                    <div class="Supported_Countries_Holder_Content"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>{{ __('Tỉnh/TP hỗ trợ') }}</label>
                                <select
                                    name="supported_provinces[]"
                                    title="-- {{ __('Chọn Tỉnh/TP') }} --"
                                    data-size="5"
                                    data-live-search="true"
                                    class="form-control k_selectpicker Supported_Provinces_Selector"
                                    multiple
                                    data-actions-box="true"
                                    data-selected-text-format="count > 5"
                                >
                                    @foreach($provinces as $province)
                                        <option
                                            value="{{ $province->code }}"
                                            data-tokens="{{ $province->code }} | {{ $province->full_name }}"
                                            data-province-code="{{ $province->code }}"
                                            data-province-name="{{ $province->full_name }}"
                                            {{ in_array($province->code, old('supported_provinces', $shippingZone->supported_provinces ?? [])) ? 'selected' : '' }}
                                        >
                                            {{ $province->full_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('supported_provinces')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <div class="Badge_Holder_Wrapper form-group Supported_Provinces_Allowed_Holder mb-0">
                                    <div class="Supported_Provinces_Holder_Content"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>{{ __('Quận/Huyện hỗ trợ') }}</label>
                                <select
                                    name="supported_districts[]"
                                    title="-- {{ __('Chọn Quận/Huyện') }} --"
                                    data-size="5"
                                    data-live-search="true"
                                    class="form-control k_selectpicker Supported_Districts_Selector"
                                    multiple
                                    data-actions-box="true"
                                    data-selected-text-format="count > 5"
                                    data-districts='@json($districts)'
                                    data-provinces='@json($provinces)'
                                    disabled
                                >
                                </select>
                                @error('supported_districts')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <div class="Badge_Holder_Wrapper form-group Supported_Districts_Allowed_Holder mb-0">
                                    <div class="Supported_Districts_Holder_Content"></div>
                                </div>
                            </div>

                            <div class="form-group d-flex align-items-center">
                                <label>{{ __('Hoạt động') }}</label>
                                <span class="k-switch" style="margin-left: 20px;">
                                    <label>
                                        <input type="checkbox" name="status" value="1" {{ old('status', 1) ? 'checked' : '' }}>
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Lưu</button>
                            <button type="reset" class="btn btn-secondary">Hủy</button>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Portlet-->
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const provinceSelect = document.querySelector(".Supported_Provinces_Selector");
            const districtSelect = document.querySelector(".Supported_Districts_Selector");

            const allDistricts = JSON.parse(districtSelect.getAttribute('data-districts') || '[]');
            const allProvinces = JSON.parse(districtSelect.getAttribute('data-provinces') || '[]');

            function updateDistrictOptions(selectedProvinces) {
                districtSelect.innerHTML = '';

                if (selectedProvinces.length === 0) {
                    districtSelect.setAttribute("disabled", "disabled");
                    $(districtSelect).selectpicker('refresh');
                    return;
                }

                const groupedDistricts = {};

                // Gom nhóm quận/huyện theo province_code
                allDistricts.forEach(d => {
                    if (selectedProvinces.includes(d.province_code)) {
                        if (!groupedDistricts[d.province_code]) {
                            groupedDistricts[d.province_code] = [];
                        }
                        groupedDistricts[d.province_code].push(d);
                    }
                });

                // Render optgroup
                Object.keys(groupedDistricts).forEach(provinceCode => {
                    const province = allProvinces.find(p => p.code === provinceCode);
                    const optgroup = document.createElement('optgroup');
                    optgroup.label = province ? province.full_name : 'Không rõ Tỉnh/TP';

                    groupedDistricts[provinceCode].forEach(district => {
                        const option = document.createElement('option');
                        option.value = district.code;
                        option.textContent = district.full_name;
                        option.setAttribute('data-district-name', district.full_name);
                        option.setAttribute('data-district-code', district.code);
                        option.setAttribute('data-district-name', district.name);
                        optgroup.appendChild(option);
                    });

                    districtSelect.appendChild(optgroup);
                });

                districtSelect.removeAttribute("disabled");
                $(districtSelect).selectpicker('refresh');
            }

            provinceSelect.addEventListener("change", function () {
                const selected = Array.from(provinceSelect.selectedOptions).map(opt => opt.value);
                updateDistrictOptions(selected);
            });

            // Tự động load lại khi có old value
            
            const oldProvinces = @json(old('supported_provinces', $shippingZone->supported_provinces ?? []));
            const oldDistricts = @json(old('supported_districts', $shippingZone->supported_districts ?? []));

            if (oldProvinces.length > 0) {
                updateDistrictOptions(oldProvinces);

                setTimeout(() => {
                    // Đánh dấu selected lại
                    for (let option of districtSelect.options) {
                        if (oldDistricts.includes(option.value)) {
                            option.selected = true;
                        }
                    }
                    $(districtSelect).selectpicker('refresh');
                }, 200);
            }
        });
    </script>
@endsection