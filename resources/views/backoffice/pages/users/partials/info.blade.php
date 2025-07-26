<div class="k-portlet">
    <div class="k-portlet__head">
        <div class="k-portlet__head-label">
            <h3 class="k-portlet__head-title">Thông tin chung</h3>
        </div>
        <div class="k-portlet__head-toolbar">
            <div class="k-portlet__head-group">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-primary btn-pill" data-modal="#modal_update_user">
                        <i class="la la-pencil"></i>
                        <span>Cập nhật</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="k-portlet__body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name">Tên <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" autocomplete="off" value="{{ old('name', $user->name) }}" disabled>
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="text" name="email" id="email" class="form-control" autocomplete="off" value="{{ old('email', $user->email) }}" disabled>
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="phome_number">Số điện thoại <span class="text-danger">*</span></label>
                    <input type="number" name="phone_number" id="phone_number" class="form-control" autocomplete="off" value="{{ old('phone_number', $user->phone_number) }}" disabled>
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="last_logged_in_at">Đăng nhập lần cuối <span class="text-danger">*</span></label>
                    <input type="text" name="last_logged_in_at" id="last_logged_in_at" class="form-control" autocomplete="off" value="{{ old('last_logged_in_at', $user->last_logged_in_at) }}" disabled>
                    @error('last_logged_in_at') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="currency_code">Mã tiền tệ <span class="text-danger">*</span></label>
                    <input type="text" name="currency_code" id="currency_code" class="form-control" autocomplete="off" value="{{ old('currency_code', $user->currency_code) }}" disabled>
                    @error('currency_code') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="access_channel_type">Kênh truy cập <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="access_channel_type" name="access_channel_type" value="{{ $user->access_channel_type_name }}" disabled>
                    @error('access_channel_type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_update_user" tabindex="-1" aria-labelledby="modal_update_user_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="form_update_user" method="POST" action="{{ route('bo.web.users.update', $user->getKey()) }}">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_update_user_label">{{ __('Cập nhật thông tin') }}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <label for="name" class="form-label">{{ __('Tên') }}</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
                        </div>

                        <div class="col-lg-4">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
                        </div>

                        <div class="col-lg-4">
                            <label for="genders" class="form-label">{{ __('Giới tính') }} <span class="text-danger">*</span></label>
                            <select class="form-control k_selectpicker" id="genders" name="genders" data-live-search="true" required>
                                <option value="0" {{ old('genders', $user->genders) == 0 ? 'selected' : '' }}>{{ __('Nam') }}</option>
                                <option value="1" {{ old('genders', $user->genders) == 1 ? 'selected' : '' }}>{{ __('Nữ') }}</option>
                            </select>
                            @error('genders')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <label for="phone_number" class="form-label">{{ __('Số điện thoại') }}</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
                        </div>
                        <div class="col-lg-4">
                            <label for="access_channel_type" class="form-label">{{ __('Kênh truy cập') }} <span class="text-danger">*</span></label>
                            <select class="form-control k_selectpicker" id="access_channel_type" name="access_channel_type" required>
                                @foreach($accessChannelTypeLables as $key => $label)
                                    <option value="{{ $key }}" {{ (int) old('access_channel_type', $user->access_channel_type->value ?? '') === (int) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('access_channel_type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="allow_login" class="form-label">{{ __('Cho phép đăng nhập') }} <span class="text-danger">*</span></label>
                            <select class="form-control k_selectpicker" id="allow_login" name="allow_login" data-live-search="true" required>
                                <option value="1" {{ old('allow_login', $user->allow_login) == 1 ? 'selected' : '' }}>{{ __('Có') }}</option>
                                <option value="0" {{ old('allow_login', $user->allow_login) == 0 ? 'selected' : '' }}>{{ __('Không') }}</option>
                            </select>
                            @error('allow_login')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <label for="birthday" class="form-label">{{ __('Sinh nhật') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="birthday" name="birthday" autocomplete="off" data-provide="datepicker" value="{{ old('birthday', $user->birthday) }}">
                                <span class="input-group-text">
                                    <i class="la la-calendar-check-o"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Đóng') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Lưu') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>


