@extends('backoffice.layouts.master')

@php
    $title = __('Tạo địa chỉ');
    $breadcrumbs = [
        ['label' => __('Hỗ trợ khách hàng')],
        ['label' => __('Địa chỉ')],
        ['label' => __('Tạo địa chỉ')],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
<div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
    <div class="row">
        <div class="col-md-12">
            <div class="k-portlet">
                <div class="k-portlet__head">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">Tạo Địa chỉ</h3>
                    </div>
                </div>

                <form action="{{ route('bo.web.addresses.store') }}" method="POST">
                    @csrf

                    <div class="k-portlet__body">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>{{ __('Tỉnh/TP hỗ trợ') }}</label>
                                <select name="supported_provinces[]" title="-- {{ __('Chọn Tỉnh/TP') }} --" data-size="5" data-live-search="true" class="form-control k_selectpicker Supported_Provinces_Selector" data-selected-text-format="count > 5" >
                                    @foreach($provinces as $province)
                                        <option value="{{ $province->code }}" data-tokens="{{ $province->code }} | {{ $province->full_name }}" data-province-code="{{ $province->code }}" data-province-name="{{ $province->full_name }}" {{ in_array($province->code, old('supported_provinces', [])) ? 'selected' : '' }} >
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
        
                            <div class="col-md-4 form-group">
                                <label>{{ __('Quận/Huyện hỗ trợ') }}</label>
                                <select name="supported_districts[]" title="-- {{ __('Chọn Quận/Huyện') }} --" data-size="5" data-live-search="true" class="form-control k_selectpicker Supported_Districts_Selector" data-selected-text-format="count > 5" data-districts='@json($districts)' data-provinces='@json($provinces)' disabled >
                                </select>
                                @error('supported_districts')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <div class="Badge_Holder_Wrapper form-group Supported_Districts_Allowed_Holder mb-0">
                                    <div class="Supported_Districts_Holder_Content"></div>
                                </div>
                            </div>
        
                            <div class="col-md-4 form-group">
                                <label>{{ __('Quận/Huyện hỗ trợ') }}</label>
                                <select name="supported_wards[]" title="-- {{ __('Chọn Phường/Xã') }} --" data-size="5" data-live-search="true" class="form-control k_selectpicker Supported_Wards_Selector" data-selected-text-format="count > 5" data-wards='@json($wards)' data-districts='@json($districts)' disabled>
                                </select>
                                @error('supported_wards')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <div class="Badge_Holder_Wrapper form-group Supported_Wards_Allowed_Holder mb-0">
                                    <div class="Supported_Wards_Holder_Content"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="user_id">Người dùng</label>
                                <select name="user_id" id="user_id" class="form-control selectpicker" data-live-search="true">
                                    <option value="">-- Chọn người dùng --</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="name">Tên người nhận <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $address->name ?? '') }}" required>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="phone">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required>
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="address_line">Địa chỉ chi tiết <span class="text-danger">*</span></label>
                                <input type="text" name="address_line" id="address_line" class="form-control" value="{{ old('address_line') }}" required>
                            </div>

                            <div class="col-md-6 form-group d-flex align-items-center">
                                <label class="mr-3">Là địa chỉ mặc định?</label>
                                <span class="k-switch">
                                    <label>
                                        <input type="checkbox" name="is_default" value="1" {{ old('is_default') ? 'checked' : '' }}>
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="k-portlet__foot">
                        <div class="k-form__actions">
                            <button type="submit" class="btn btn-primary">Lưu địa chỉ</button>
                            <a href="{{ route('bo.web.addresses.index') }}" class="btn btn-secondary">Hủy</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const provinceSelect = document.querySelector(".Supported_Provinces_Selector");
            const districtSelect = document.querySelector(".Supported_Districts_Selector");
            const wardSelect = document.querySelector(".Supported_Wards_Selector");

            const userSelect = document.getElementById("user_id");
            const nameInput = document.getElementById("name");

            const userList = @json($users);

            const allDistricts = JSON.parse(districtSelect.getAttribute('data-districts') || '[]');
            const allProvinces = JSON.parse(districtSelect.getAttribute('data-provinces') || '[]');
            const allWards = JSON.parse(wardSelect.getAttribute('data-wards') || '[]');

            function updateDistrictOptions(selectedProvinces) {
                districtSelect.innerHTML = '';
                wardSelect.innerHTML = '';
                wardSelect.setAttribute("disabled", "disabled");
                $(wardSelect).selectpicker('refresh');

                if (selectedProvinces.length === 0) {
                    districtSelect.setAttribute("disabled", "disabled");
                    $(districtSelect).selectpicker('refresh');
                    return;
                }

                const groupedDistricts = {};
                allDistricts.forEach(d => {
                    if (selectedProvinces.includes(String(d.province_code))) {
                        if (!groupedDistricts[d.province_code]) {
                            groupedDistricts[d.province_code] = [];
                        }
                        groupedDistricts[d.province_code].push(d);
                    }
                });

                Object.keys(groupedDistricts).forEach(provinceCode => {
                    const province = allProvinces.find(p => p.code === provinceCode);
                    const optgroup = document.createElement('optgroup');
                    optgroup.label = province ? province.full_name : 'Không rõ Tỉnh/TP';

                    groupedDistricts[provinceCode].forEach(district => {
                        const option = document.createElement('option');
                        option.value = district.code;
                        option.textContent = district.full_name;
                        option.setAttribute('data-district-name', district.name);
                        option.setAttribute('data-district-code', district.code);
                        optgroup.appendChild(option);
                    });

                    districtSelect.appendChild(optgroup);
                });

                districtSelect.removeAttribute("disabled");
                $(districtSelect).selectpicker('refresh');
            }

            function updateWardOptions(selectedDistricts) {
                wardSelect.innerHTML = '';

                if (selectedDistricts.length === 0) {
                    wardSelect.setAttribute("disabled", "disabled");
                    $(wardSelect).selectpicker('refresh');
                    return;
                }

                const groupedWards = {};
                allWards.forEach(w => {
                    if (selectedDistricts.includes(w.district_code)) {
                        if (!groupedWards[w.district_code]) {
                            groupedWards[w.district_code] = [];
                        }
                        groupedWards[w.district_code].push(w);
                    }
                });

                Object.keys(groupedWards).forEach(districtCode => {
                    const district = allDistricts.find(d => d.code === districtCode);
                    const optgroup = document.createElement('optgroup');
                    optgroup.label = district ? district.full_name : 'Không rõ Quận/Huyện';

                    groupedWards[districtCode].forEach(ward => {
                        const option = document.createElement('option');
                        option.value = ward.code;
                        option.textContent = ward.full_name;
                        option.setAttribute('data-ward-name', ward.name);
                        optgroup.appendChild(option);
                    });

                    wardSelect.appendChild(optgroup);
                });

                wardSelect.removeAttribute("disabled");
                $(wardSelect).selectpicker('refresh');
            }

            provinceSelect.addEventListener("change", function () {
                const selectedProvinces = Array.from(provinceSelect.selectedOptions).map(opt => opt.value);
                updateDistrictOptions(selectedProvinces);
            });

            districtSelect.addEventListener("change", function () {
                const selectedDistricts = Array.from(districtSelect.selectedOptions).map(opt => opt.value);
                updateWardOptions(selectedDistricts);
            });

            // Load lại nếu có old value
            const oldProvinces = @json(old('supported_provinces', []));
            const oldDistricts = @json(old('supported_districts', []));
            const oldWards = @json(old('supported_wards', []));

            if (oldProvinces.length > 0) {
                updateDistrictOptions(oldProvinces);
                setTimeout(() => {
                    for (let option of districtSelect.options) {
                        if (oldDistricts.includes(option.value)) {
                            option.selected = true;
                        }
                    }
                    $(districtSelect).selectpicker('refresh');

                    updateWardOptions(oldDistricts);
                    setTimeout(() => {
                        for (let option of wardSelect.options) {
                            if (oldWards.includes(option.value)) {
                                option.selected = true;
                            }
                        }
                        $(wardSelect).selectpicker('refresh');
                    }, 200);
                }, 200);
            }

            userSelect.addEventListener("change", function () {
            const selectedUserId = this.value;
            const user = userList.find(u => u.id == selectedUserId);
            if (user) {
                nameInput.value = user.name;
            } else {
                nameInput.value = '';
            }
        });
        });
    </script>
@endpush

