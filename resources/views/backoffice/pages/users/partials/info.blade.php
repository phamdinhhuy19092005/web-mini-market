<div class="k-portlet">
    <div class="k-portlet__head">
        <div class="k-portlet__head-label">
            <h3 class="k-portlet__head-title">Thông tin chung</h3>
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