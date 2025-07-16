<!-- begin:: Aside Brand -->
<div class="k-aside__brand k-grid__item" id="k_aside_brand">
    <div class="k-aside__brand-logo">
        <a href="{{ route('bo.web.dashboard') }}">
            <img alt="Logo" src="{{ asset('assets/media/logos/logo-uchimart.png') }}" style="width:160px" />
        </a>
    </div>
    <div class="k-aside__brand-tools">
        <button class="k-aside__brand-aside-toggler k-aside__brand-aside-toggler--left" id="k_aside_toggler"><span></span></button>
    </div>
</div>
<!-- end:: Aside Brand -->

<!-- begin:: Aside Menu -->
<div class="k-aside-menu-wrapper k-grid__item k-grid__item--fluid" id="k_aside_menu_wrapper">
    <div id="k_aside_menu" class="k-aside-menu" data-kmenu-vertical="1" data-kmenu-scroll="1" data-kmenu-dropdown-timeout="500">
        <ul class="k-menu__nav">
            <li class="k-menu__item {{ request()->routeIs('bo.web.dashboard') ? 'k-menu__item--active' : '' }}" aria-haspopup="true">
                <a href="{{ route('bo.web.dashboard') }}" class="k-menu__link">
                    <i class="k-menu__link-icon flaticon2-graphic"></i>
                    <span class="k-menu__link-text">Bảng điều khiển</span>
                </a>
            </li>
            <li class="k-menu__item {{ request()->routeIs('bo.web.users.*') ? 'k-menu__item--active' : '' }}" aria-haspopup="true">
                <a href="{{ route('bo.web.users.index') }}" class="k-menu__link">
                    <i class="k-menu__link-icon flaticon-users"></i>
                    <span class="k-menu__link-text">Danh sách khách hàng</span>
                </a>
            </li>
            <li class="k-menu__item k-menu__item--submenu {{ request()->routeIs('bo.web.category-groups.*', 'bo.web.categories.*', 'bo.web.sub-categories.*', 'bo.web.attributes.*', 'bo.web.attribute-values.*', 'bo.web.products.*', 'bo.web.brands.*', 'bo.web.inventories.*') ? 'k-menu__item--open k-menu__item--active' : '' }}" aria-haspopup="true" data-kmenu-submenu-toggle="hover">
                <a href="javascript:;" class="k-menu__link k-menu__toggle">
                    <i class="k-menu__link-icon flaticon2-copy"></i>
                    <span class="k-menu__link-text">Quản lý kho sản phẩm</span>
                    <i class="k-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="k-menu__submenu">
                    <span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <li class="k-menu__item k-menu__item--submenu {{ request()->routeIs('bo.web.category-groups.*', 'bo.web.categories.*', 'bo.web.sub-categories.*') ? 'k-menu__item--open' : '' }}" aria-haspopup="true" data-kmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="k-menu__link k-menu__toggle">
                                <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                <span class="k-menu__link-text">Danh mục</span>
                                <i class="k-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="k-menu__submenu">
                                <span class="k-menu__arrow"></span>
                                <ul class="k-menu__subnav">
                                    <li class="k-menu__item {{ request()->routeIs('bo.web.category-groups.*') ? 'k-menu__item--active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('bo.web.category-groups.index') }}" class="k-menu__link">
                                            <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                            <span class="k-menu__link-text">Nhóm danh mục</span>
                                        </a>
                                    </li>
                                    <li class="k-menu__item {{ request()->routeIs('bo.web.categories.*') ? 'k-menu__item--active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('bo.web.categories.index') }}" class="k-menu__link">
                                            <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                            <span class="k-menu__link-text">Danh mục</span>
                                        </a>
                                    </li>
                                    <li class="k-menu__item {{ request()->routeIs('bo.web.sub-categories.*') ? 'k-menu__item--active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('bo.web.sub-categories.index') }}" class="k-menu__link">
                                            <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                            <span class="k-menu__link-text">Danh mục con</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="k-menu__item k-menu__item--submenu {{ request()->routeIs('bo.web.attributes.*', 'bo.web.attribute-values.*') ? 'k-menu__item--open' : '' }}" aria-haspopup="true" data-kmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="k-menu__link k-menu__toggle">
                                <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                <span class="k-menu__link-text">Thuộc tính</span>
                                <i class="k-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="k-menu__submenu">
                                <span class="k-menu__arrow"></span>
                                <ul class="k-menu__subnav">
                                    <li class="k-menu__item {{ request()->routeIs('bo.web.attributes.*') ? 'k-menu__item--active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('bo.web.attributes.index') }}" class="k-menu__link">
                                            <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                            <span class="k-menu__link-text">Thuộc tính</span>
                                        </a>
                                    </li>
                                    <li class="k-menu__item {{ request()->routeIs('bo.web.attribute-values.*') ? 'k-menu__item--active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('bo.web.attribute-values.index') }}" class="k-menu__link">
                                            <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                            <span class="k-menu__link-text">Biến thể</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="k-menu__item {{ request()->routeIs('bo.web.products.*') ? 'k-menu__item--active' : '' }}" aria-haspopup="true">
                            <a href="{{ route('bo.web.products.index') }}" class="k-menu__link">
                                <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                <span class="k-menu__link-text">Sản phẩm</span>
                            </a>
                        </li>
                        <li class="k-menu__item {{ request()->routeIs('bo.web.brands.*') ? 'k-menu__item--active' : '' }}" aria-haspopup="true">
                            <a href="{{ route('bo.web.brands.index') }}" class="k-menu__link">
                                <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                <span class="k-menu__link-text">Thương hiệu</span>
                            </a>
                        </li>
                        <li class="k-menu__item {{ request()->routeIs('bo.web.inventories.*') ? 'k-menu__item--active' : '' }}" aria-haspopup="true">
                            <a href="{{ route('bo.web.inventories.index') }}" class="k-menu__link">
                                <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                <span class="k-menu__link-text">Kho sản phẩm</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="k-menu__item k-menu__item--submenu {{ request()->routeIs('bo.web.banners.*', 'bo.web.menu-groups.*') ? 'k-menu__item--open k-menu__item--active' : '' }}" aria-haspopup="true" data-kmenu-submenu-toggle="hover">
                <a href="javascript:;" class="k-menu__link k-menu__toggle">
                    <i class="k-menu__link-icon flaticon2-contract"></i>
                    <span class="k-menu__link-text">Giao diện</span>
                    <i class="k-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="k-menu__submenu">
                    <span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <li class="k-menu__item {{ request()->routeIs('bo.web.banners.*') ? 'k-menu__item--active' : '' }}" aria-haspopup="true">
                            <a href="{{ route('bo.web.banners.index') }}" class="k-menu__link">
                                <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                <span class="k-menu__link-text">Cài đặt Banner</span>
                            </a>
                        </li>
                        <li class="k-menu__item k-menu__item--submenu {{ request()->routeIs('bo.web.menu-groups.*') ? 'k-menu__item--open' : '' }}" aria-haspopup="true" data-kmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="k-menu__link k-menu__toggle">
                                <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                <span class="k-menu__link-text">Cấu hình Menu</span>
                                <i class="k-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="k-menu__submenu">
                                <span class="k-menu__arrow"></span>
                                <ul class="k-menu__subnav">
                                    <li class="k-menu__item {{ request()->routeIs('bo.web.menu-groups.*') ? 'k-menu__item--active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('bo.web.menu-groups.index') }}" class="k-menu__link">
                                            <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                            <span class="k-menu__link-text">Nhóm Menu</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="k-menu__item k-menu__item--submenu {{ request()->routeIs('bo.web.post-categories.*', 'bo.web.posts.*', 'bo.web.pages.*', 'bo.web.faq-topics.*', 'bo.web.faqs.*') ? 'k-menu__item--open k-menu__item--active' : '' }}" aria-haspopup="true" data-kmenu-submenu-toggle="hover">
                <a href="javascript:;" class="k-menu__link k-menu__toggle">
                    <i class="k-menu__link-icon fa fa-asterisk"></i>
                    <span class="k-menu__link-text">Tiện ích</span>
                    <i class="k-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="k-menu__submenu">
                    <span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <li class="k-menu__item k-menu__item--submenu {{ request()->routeIs('bo.web.post-categories.*', 'bo.web.posts.*') ? 'k-menu__item--open' : '' }}" aria-haspopup="true" data-kmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="k-menu__link k-menu__toggle">
                                <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                <span class="k-menu__link-text">Blog</span>
                                <i class="k-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="k-menu__submenu">
                                <span class="k-menu__arrow"></span>
                                <ul class="k-menu__subnav">
                                    <li class="k-menu__item {{ request()->routeIs('bo.web.post-categories.*') ? 'k-menu__item--active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('bo.web.post-categories.index') }}" class="k-menu__link">
                                            <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                            <span class="k-menu__link-text">Danh mục</span>
                                        </a>
                                    </li>
                                    <li class="k-menu__item {{ request()->routeIs('bo.web.posts.*') ? 'k-menu__item--active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('bo.web.posts.index') }}" class="k-menu__link">
                                            <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                            <span class="k-menu__link-text">Bài viết</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="k-menu__item {{ request()->routeIs('bo.web.pages.*') ? 'k-menu__item--active' : '' }}" aria-haspopup="true">
                            <a href="{{ route('bo.web.pages.index') }}" class="k-menu__link">
                                <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                <span class="k-menu__link-text">Danh sách trang</span>
                            </a>
                        </li>
                        <li class="k-menu__item k-menu__item--submenu {{ request()->routeIs('bo.web.faq-topics.*', 'bo.web.faqs.*') ? 'k-menu__item--open' : '' }}" aria-haspopup="true" data-kmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="k-menu__link k-menu__toggle">
                                <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                <span class="k-menu__link-text">Câu hỏi thường gặp</span>
                                <i class="k-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="k-menu__submenu">
                                <span class="k-menu__arrow"></span>
                                <ul class="k-menu__subnav">
                                    <li class="k-menu__item {{ request()->routeIs('bo.web.faq-topics.*') ? 'k-menu__item--active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('bo.web.faq-topics.index') }}" class="k-menu__link">
                                            <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                            <span class="k-menu__link-text">Chủ đề FAQs</span>
                                        </a>
                                    </li>
                                    <li class="k-menu__item {{ request()->routeIs('bo.web.faqs.*') ? 'k-menu__item--active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('bo.web.faqs.index') }}" class="k-menu__link">
                                            <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                            <span class="k-menu__link-text">FAQs</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="k-menu__item k-menu__item--submenu {{ request()->routeIs('bo.web.countries.*', 'bo.web.currencies.*') ? 'k-menu__item--open k-menu__item--active' : '' }}" aria-haspopup="true" data-kmenu-submenu-toggle="hover">
                <a href="javascript:;" class="k-menu__link k-menu__toggle">
                    <i class="k-menu__link-icon flaticon-placeholder-3"></i>
                    <span class="k-menu__link-text">Khu vực</span>
                    <i class="k-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="k-menu__submenu">
                    <span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <li class="k-menu__item {{ request()->routeIs('bo.web.countries.*') ? 'k-menu__item--active' : '' }}" aria-haspopup="true">
                            <a href="{{ route('bo.web.countries.index') }}" class="k-menu__link">
                                <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                <span class="k-menu__link-text">Quốc gia</span>
                            </a>
                        </li>
                        <li class="k-menu__item {{ request()->routeIs('bo.web.currencies.*') ? 'k-menu__item--active' : '' }}" aria-haspopup="true">
                            <a href="{{ route('bo.web.currencies.index') }}" class="k-menu__link">
                                <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                <span class="k-menu__link-text">Tiền tệ</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="k-menu__item k-menu__item--submenu {{ request()->routeIs('bo.web.subscribers.*') ? 'k-menu__item--open k-menu__item--active' : '' }}" aria-haspopup="true" data-kmenu-submenu-toggle="hover">
                <a href="javascript:;" class="k-menu__link k-menu__toggle">
                    <i class="k-menu__link-icon flaticon-technology-1"></i>
                    <span class="k-menu__link-text">Hỗ trợ khách hàng</span>
                    <i class="k-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="k-menu__submenu">
                    <span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <li class="k-menu__item {{ request()->routeIs('bo.web.subscribers.*') ? 'k-menu__item--active' : '' }}" aria-haspopup="true">
                            <a href="{{ route('bo.web.subscribers.index') }}" class="k-menu__link">
                                <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                <span class="k-menu__link-text">Người đăng ký</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="k-menu__item k-menu__item--submenu {{ request()->routeIs('bo.web.shipping-zones.*', 'bo.web.shipping-rates.*') ? 'k-menu__item--open k-menu__item--active' : '' }}" aria-haspopup="true" data-kmenu-submenu-toggle="hover">
                <a href="javascript:;" class="k-menu__link k-menu__toggle">
                    <i class="k-menu__link-icon fa fa-truck"></i>
                    <span class="k-menu__link-text">Vận chuyển</span>
                    <i class="k-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="k-menu__submenu">
                    <span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <li class="k-menu__item {{ request()->routeIs('bo.web.shipping-zones.*') ? 'k-menu__item--active' : '' }}" aria-haspopup="true">
                            <a href="{{ route('bo.web.shipping-zones.index') }}" class="k-menu__link">
                                <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                <span class="k-menu__link-text">Khu vực vận chuyển</span>
                            </a>
                        </li>
                        <li class="k-menu__item {{ request()->routeIs('bo.web.shipping-rates.*') ? 'k-menu__item--active' : '' }}" aria-haspopup="true">
                            <a href="{{ route('bo.web.shipping-rates.index') }}" class="k-menu__link">
                                <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                <span class="k-menu__link-text">Cước phí vận chuyển</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="k-menu__item k-menu__item--submenu {{ request()->routeIs('bo.web.shipping-zones.*', 'bo.web.shipping-rates.*') ? 'k-menu__item--open k-menu__item--active' : '' }}" aria-haspopup="true" data-kmenu-submenu-toggle="hover">
                <a href="javascript:;" class="k-menu__link k-menu__toggle">
                    <i class="k-menu__link-icon fa fa-credit-card"></i>
                    <span class="k-menu__link-text">Thanh toán</span>
                    <i class="k-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="k-menu__submenu">
                    <span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <li class="k-menu__item {{ request()->routeIs('bo.web.shipping-zones.*') ? 'k-menu__item--active' : '' }}" aria-haspopup="true">
                            <a href="{{ route('bo.web.shipping-zones.index') }}" class="k-menu__link">
                                <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                <span class="k-menu__link-text">Giao dịch gửi tiền</span>
                            </a>
                        </li>
                        <li class="k-menu__item k-menu__item--submenu {{ request()->routeIs('bo.web.category-groups.*', 'bo.web.categories.*', 'bo.web.sub-categories.*') ? 'k-menu__item--open' : '' }}" aria-haspopup="true" data-kmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="k-menu__link k-menu__toggle">
                                <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                <span class="k-menu__link-text">Cài đặt thanh toán</span>
                                <i class="k-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="k-menu__submenu">
                                <span class="k-menu__arrow"></span>
                                <ul class="k-menu__subnav">
                                    <li class="k-menu__item {{ request()->routeIs('bo.web.payment-providers.*') ? 'k-menu__item--active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('bo.web.payment-providers.index') }}" class="k-menu__link">
                                            <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                            <span class="k-menu__link-text">Đơn vị thanh toán</span>
                                        </a>
                                    </li>
                                    <li class="k-menu__item {{ request()->routeIs('bo.web.payment-providers.*') ? 'k-menu__item--active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('bo.web.payment-providers.index') }}" class="k-menu__link">
                                            <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                            <span class="k-menu__link-text">Phương thức thanh toán</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="k-menu__item k-menu__item--submenu {{ request()->routeIs('bo.web.system*') ? 'k-menu__item--open k-menu__item--active' : '' }}" aria-haspopup="true" data-kmenu-submenu-toggle="hover">
                <a href="javascript:;" class="k-menu__link k-menu__toggle">
                    <i class="k-menu__link-icon flaticon2-settings"></i>
                    <span class="k-menu__link-text">Hệ thống</span>
                    <i class="k-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="k-menu__submenu">
                    <span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <!-- Add system configuration items here if needed -->
                    </ul>
                </div>
            </li>
            <li class="k-menu__item k-menu__item--submenu {{ request()->routeIs('bo.web.admins.*', 'bo.web.roles.*') ? 'k-menu__item--open k-menu__item--active' : '' }}" aria-haspopup="true" data-kmenu-submenu-toggle="hover">
                <a href="javascript:;" class="k-menu__link k-menu__toggle">
                    <i class="k-menu__link-icon fas fa-user-shield"></i>
                    <span class="k-menu__link-text">Quản trị</span>
                    <i class="k-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="k-menu__submenu">
                    <span class="k-menu__arrow"></span>
                    <ul class="k-menu__subnav">
                        <li class="k-menu__item {{ request()->routeIs('bo.web.admins.*') ? 'k-menu__item--active' : '' }}" aria-haspopup="true">
                            <a href="{{ route('bo.web.admins.index') }}" class="k-menu__link">
                                <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                <span class="k-menu__link-text">Quản trị viên</span>
                            </a>
                        </li>
                        <li class="k-menu__item {{ request()->routeIs('bo.web.roles.*') ? 'k-menu__item--active' : '' }}" aria-haspopup="true">
                            <a href="{{ route('bo.web.roles.index') }}" class="k-menu__link">
                                <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
                                <span class="k-menu__link-text">Quyền truy cập</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- end:: Aside Menu -->
