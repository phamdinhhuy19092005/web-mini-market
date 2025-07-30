@extends('backoffice.layouts.master')

@php
    $title = __('Chỉnh sửa bào viết');

    $breadcrumbs = [
        [
            'label' => __('Tiện ích'),
        ],
        [
            'label' => __('Blogs'),
        ],
        [
            'label' => __('Bài viết'),
        ],
        [
            'label' => __('Chỉnh sửa bào viết'),
        ],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
    <!-- Begin::Content Body -->
    <div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
        <div class="row">
            <div class="col-md-12">
                <!-- Begin::Portlet -->
                <div class="k-portlet">
                    <div class="k-portlet__head">
                        <div class="k-portlet__head-label">
                            <h3 class="k-portlet__head-title">Chỉnh sửa bài viết</h3>
                        </div>
                    </div>

                    <!-- Begin::Form -->
                    <form class="k-form" action="{{ route('bo.web.addresses.update', $address->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                       <div class="k-portlet__body">
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="province_code">Tỉnh / Thành phố <span class="text-danger">*</span></label>
                                    <select name="province_code" id="province_code" class="form-control selectpicker" data-live-search="true">
                                        <option value="">-- Chọn Tỉnh / Thành phố --</option>
                                        @foreach($provinces as $province)
                                            <option value="{{ $province->code }}" {{ old('province_code', $address->province_code ?? '') == $province->code ? 'selected' : '' }}>
                                                {{ $province->full_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('province_code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="district_code">Quận / Huyện <span class="text-danger">*</span></label>
                                    <select name="district_code" id="district_code" class="form-control selectpicker" data-live-search="true" disabled>
                                        <option value="">-- Chọn Quận / Huyện --</option>
                                    </select>
                                    @error('district_code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="ward_code">Phường / Xã <span class="text-danger">*</span></label>
                                    <select name="ward_code" id="ward_code" class="form-control selectpicker" data-live-search="true" disabled>
                                        <option value="">-- Chọn Phường / Xã --</option>
                                    </select>
                                    @error('ward_code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="user_id">Người dùng</label>
                                    <select name="user_id" id="user_id" class="form-control selectpicker" data-live-search="true">
                                        <option value="">-- Chọn người dùng --</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id',  $address->user_id) == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="name">Tên người nhận <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $address->name) }}" required>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="phone">Số điện thoại <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $address->phone) }}" required>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="address_line">Địa chỉ chi tiết <span class="text-danger">*</span></label>
                                    <input type="text" name="address_line" id="address_line" class="form-control" value="{{ old('address_line', $address->address_line) }}" required>
                                </div>

                                <div class="col-md-6 form-group d-flex align-items-center">
                                    <label class="mr-3">Là địa chỉ mặc định?</label>
                                    <span class="k-switch">
                                        <label>
                                            <input type="hidden" name="is_default" value="0">
                                            <input type="checkbox" name="is_default" value="1" {{ old('is_default', $address->is_default ?? false) ? 'checked' : '' }}>
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="k-portlet__foot">
                            <div class="k-form__actions">
                                <button type="submit" class="btn btn-primary">Lưu bài viết</button>
                                <button type="reset" class="btn btn-secondary">Hủy</button>
                            </div>
                        </div>
                    </form>
                    <!-- End::Form -->
                </div>
                <!-- End::Portlet -->
            </div>
        </div>
    </div>
    <!-- End::Content Body -->
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const districts = @json($districts); 
        const wards = @json($wards);        

        const provinceSelect = document.getElementById("province_code");
        const districtSelect = document.getElementById("district_code");
        const wardSelect = document.getElementById("ward_code");

        if (!provinceSelect || !districtSelect || !wardSelect) return;

        function populateSelect(select, options, valueKey = 'code', textKey = 'name') {
            select.innerHTML = '<option value="">-- Chọn --</option>';
            options.forEach(opt => {
                const option = document.createElement('option');
                option.value = opt[valueKey];
                option.textContent = opt[textKey];
                select.appendChild(option);
            });
            select.removeAttribute("disabled");
            $(select).selectpicker('refresh');
        }

        // Reset & bind
        provinceSelect.addEventListener("change", function () {
            const provinceCode = this.value;
            const filteredDistricts = districts.filter(d => d.province_code === provinceCode);
            populateSelect(districtSelect, filteredDistricts);
            wardSelect.innerHTML = '<option value="">-- Chọn Phường / Xã --</option>';
            wardSelect.setAttribute("disabled", "disabled");
            $(wardSelect).selectpicker('refresh');
        });

        districtSelect.addEventListener("change", function () {
            const districtCode = this.value;
            const filteredWards = wards.filter(w => w.district_code === districtCode);
            populateSelect(wardSelect, filteredWards);
        });

        // Nếu có giá trị cũ thì tự set lại
        const oldProvince = "{{ old('province_code', $address->province_code ?? '') }}";
        const oldDistrict = "{{ old('district_code', $address->district_code ?? '') }}";
        const oldWard = "{{ old('ward_code', $address->ward_code ?? '') }}";

        if (oldProvince) {
            provinceSelect.value = oldProvince;
            const filteredDistricts = districts.filter(d => d.province_code === oldProvince);
            populateSelect(districtSelect, filteredDistricts);
            districtSelect.value = oldDistrict;
            $(districtSelect).selectpicker('refresh');
        }

        if (oldDistrict) {
            const filteredWards = wards.filter(w => w.district_code === oldDistrict);
            populateSelect(wardSelect, filteredWards);
            wardSelect.value = oldWard;
            $(wardSelect).selectpicker('refresh');
        }
    });
</script>
@endpush

