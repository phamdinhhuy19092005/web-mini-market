@extends('backoffice.layouts.master')

@php
    $title = __('Tạo quản trị viên');
    $breadcrumbs = [
        ['label' => __('Quản trị viên')],
        ['label' => __('Tạo quản trị viên')],
    ];
@endphp

@component('backoffice.partials.breadcrumb', ['title' => $title, 'items' => $breadcrumbs])
@endcomponent

@section('content_body')
<div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
    <div class="row">
        <div class="col-md-12">
            <!--begin::Portlet-->
            <div class="k-portlet k-portlet--tabs">
                <div class="k-portlet__head">
                    <div class="k-portlet__head-label">
                        <h3 class="k-portlet__head-title">Thêm quản trị viên</h3>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="k-form" method="POST" action="{{ route('bo.web.admins.store') }}" enctype="multipart/form-data">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="k-portlet__body">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="mainTab">
                                <!-- Email -->
                                <div class="form-group">
                                    <label>Email *</label>
                                    <input type="text" class="form-control" name="email" placeholder="Nhập email" value="" required >
                                </div>

                                <!-- Name -->
                                <div class="form-group">
                                    <label>Tên *</label>
                                    <input type="text" class="form-control" name="name" placeholder="Nhập tên" value="" required>
                                </div>

                                <!-- Roles -->
                                {{-- <div class="form-group">
                                    <label>Roles * <div class="invalid-feedback">Chọn role</div></label>
                                    <div class="k-checkbox-list">
                                         @foreach($roles as $role)
                                            <label class="k-checkbox k-checkbox--success">
                                                <input class="roles" name="roles[{{ $role->id }}]" type="checkbox"> {{ $role->name }}
                                                <span></span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div> --}}

                                <!-- Password -->
                                <div class="form-group">
                                    <label>Mật khẩu *</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Nhập password" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" id="toggle-password" type="button"><i class="fa fa-eye"></i></button>
                                            <button class="btn btn-primary" id="random-password" type="button">Ngẫu nhiên</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="k-portlet__foot">
                        <div class="k-form__actions">
                            <button type="submit" class="btn btn-primary">Lưu</button>
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('bo.web.admins.index') }}'">Huỷ</button>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
</div>

<!-- end:: Content Body -->

<script>
    const togglePassword = document.querySelector('#toggle-password');
    const passwordInput = document.querySelector('#password');
    const randomPasswordBtn = document.querySelector('#random-password');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    function generateRandomPassword(length = 12) {
        const chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+{}:\"<>?|[];',./`~";
        let password = "";
        for (let i = 0; i < length; i++) {
            password += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        return password;
    }

    randomPasswordBtn.addEventListener('click', function () {
        const randomPass = generateRandomPassword();
        passwordInput.value = randomPass;

        if (passwordInput.getAttribute('type') === 'password') {
            passwordInput.setAttribute('type', 'text');
            togglePassword.querySelector('i').classList.remove('fa-eye');
            togglePassword.querySelector('i').classList.add('fa-eye-slash');
        }
    });
</script>

@endsection
