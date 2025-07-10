<!-- Header -->
<div id="k_header" class="k-header k-grid__item k-header--fixed">
    <!-- Header Menu -->
    <button class="k-header-menu-wrapper-close" id="k_header_menu_mobile_close_btn">
        <i class="la la-close"></i>
    </button>
    <div class="k-header-menu-wrapper" id="k_header_menu_wrapper">
        <div id="k_header_menu" class="k-header-menu k-header-menu-mobile">
            <ul class="k-menu__nav">
                <li class="k-menu__item k-menu__item--submenu k-menu__item--rel">
                    <a href="#" target="_blank" class="k-menu__link">
                        <span class="k-menu__link-text" style="text-transform: uppercase;">Uchi Mart</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- End Header Menu -->

    <!-- Header Topbar -->
    <div class="k-header__topbar">
        <!-- User Bar -->
        <div class="k-header__topbar-item k-header__topbar-item--user">
            <div class="k-header__topbar-wrapper" id="dropdownMenuUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10px -2px">
                <div class="k-header__topbar-user">
                    <span class="k-header__topbar-welcome k-hidden-mobile">Hi,</span>
                    <span class="k-header__topbar-username k-hidden-mobile">{{ auth('admin')->user()->name ?? 'Guest' }}</span>
                    <img alt="Profile Picture" src="https://i.pinimg.com/originals/0f/9d/bc/0f9dbcffc8a6d409cca58e2cb70d7389.gif">
                    <span class="k-badge k-badge--username k-badge--lg k-badge--brand k-hidden">{{ substr(auth('admin')->user()->name ?? 'G', 0, 1) }}</span>
                </div>
            </div>

            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-md" aria-labelledby="dropdownMenuUser">
                <div class="k-user-card k-margin-b-50 k-margin-b-30-tablet-and-mobile">
                    <div class="k-user-card__wrapper">
                        <div class="k-user-card__pic">
                            <img alt="Profile Picture" src="https://i.pinimg.com/originals/0f/9d/bc/0f9dbcffc8a6d409cca58e2cb70d7389.gif">
                        </div>
                        <div class="k-user-card__details">
                            <div class="k-user-card__name">{{ auth('admin')->user()->name ?? 'admin' }}</div>
                        </div>
                    </div>
                </div>
                <ul class="k-nav k-margin-b-10">
                    <li class="k-nav__item">
                        <a href="javascript:;" data-toggle="modal" data-target="#userProfileModal" class="k-nav__link">
                            <span class="k-nav__link-icon"><i class="flaticon2-calendar-3"></i></span>
                            <span class="k-nav__link-text">Hồ sơ của tôi</span>
                        </a>
                    </li>
                    <li class="k-nav__item k-nav__item--custom k-margin-t-15">
                        <form method="POST" action="{{ route('bo.web.admin.logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-metal btn-hover-brand btn-upper btn-font-dark btn-sm btn-bold">Đăng xuất</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End User Bar -->
    </div>
    <!-- End Header Topbar -->
</div>

<!-- User Profile Modal -->
<div class="modal fade" id="userProfileModal" tabindex="-1" role="dialog" aria-labelledby="userProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <h5 class="mb-4">
                        Hồ sơ của tôi
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span style="color: #a1a8c3">×</span>
                        </button>
                    </h5>
                    <form id="updateCurrentAdminProfileForm" action="{{ route('bo.web.admin.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" type="text" class="form-control" value="{{ auth('admin')->user()->email ?? 'admin@admin.com' }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Tên *</label>
                            <input name="name" required type="text" class="form-control" value="{{ auth('admin')->user()->name ?? 'admin' }}">
                        </div>
                        <div class="form-group mb-2 text-right">
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>
                <div class="k-separator k-separator--border-dashed"></div>
                <div class="form-group mb-2">
                    <h5 class="my-4">Đổi mật khẩu</h5>
                    <form id="Form_UpdateCurrentAdminPassword" action="{{ route('bo.web.admin.password.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Mật khẩu hiện tại *</label>
                            <input required name="password" type="password" class="form-control" autocomplete="current-password">
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu mới *</label>
                            <input required name="new_password" type="password" class="form-control" autocomplete="new-password">
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
