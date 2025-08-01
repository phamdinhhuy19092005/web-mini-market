<!DOCTYPE html>

<!--
Theme: Keen - The Ultimate Bootstrap Admin Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: You must have a valid license purchased only from https://themes.getbootstrap.com/product/keen-the-ultimate-bootstrap-admin-theme/ in order to legally use the theme for your project.
-->
<html lang="en">

<!-- begin::Head -->

<head>
    <meta charset="utf-8" />
    <title>Admin | Login</title>
    <meta name="description" content="User login example">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Web font -->

    <!--begin::Page Custom Styles -->
    <link href="{{ asset('assets/custom/user/login-v1.css') }}" rel="stylesheet" type="text/css" />

    <!--end::Page Custom Styles -->

    <!--begin:: Global Mandatory Vendors -->
    <!-- Global Mandatory Vendors -->
    <link href="{{ asset('assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" type="text/css" />

    <!-- Global Optional Vendors -->
    <link href="{{ asset('assets/vendors/general/tether/dist/css/tether.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/nouislider/distribute/nouislider.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/owl.carousel/dist/assets/owl.carousel.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/owl.carousel/dist/assets/owl.theme.default.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/dropzone/dist/dropzone.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/summernote/dist/summernote.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/animate.css/animate.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/toastr/build/toastr.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/morris.js/morris.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/sweetalert2/dist/sweetalert2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/socicon/css/socicon.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/custom/vendors/line-awesome/css/line-awesome.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/custom/vendors/flaticon/flaticon.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/custom/vendors/flaticon2/flaticon.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/custom/vendors/fontawesome5/css/all.min.css') }}" rel="stylesheet" type="text/css" />


    <!--end:: Global Optional Vendors -->

    <!--begin::Global Theme Styles -->
    <link href="../assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins -->
    <link href="../assets/demo/default/skins/header/base/light.css" rel="stylesheet" type="text/css" />
    <link href="../assets/demo/default/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
    <link href="../assets/demo/default/skins/brand/navy.css" rel="stylesheet" type="text/css" />
    <link href="../assets/demo/default/skins/aside/navy.css" rel="stylesheet" type="text/css" />

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="../assets/media/logos/favicon.ico" />
</head>

<!-- end::Head -->

<!-- begin::Body -->

<body style="background-image: url(../assets/media/misc/bg_1.jpg)" class="k-login-v1--enabled k-header--fixed k-header-mobile--fixed k-aside--enabled k-aside--fixed">

    <!-- begin:: Page -->
    <div class="k-grid k-grid--ver k-grid--root k-page">
        <div class="k-grid__item   k-grid__item--fluid k-grid  k-grid k-grid--hor k-login-v1" id="k_login_v1">

            <!--begin::Item-->
            <div class="k-grid__item  k-grid--hor">

                <!--begin::Heade-->
                <!-- <div class="k-login-v1__head">
                    <div class="k-login-v1__head-logo">
                        <a href="#">
                            <img src="../assets/media/logos/logo-4.png" alt="" />
                        </a>
                    </div>
                    <div class="k-login-v1__head-signup">
                        <h4>Don't have an account?</h4>
                        <a href="#" class="k-link">Sign Up</a>
                    </div>
                </div> -->

                <!--begin::Head-->
            </div>

            <!--end::Item-->

            <!--begin::Item-->
            <div class="k-grid__item  k-grid  k-grid--ver  k-grid__item--fluid ">

                <!--begin::Body-->
                <div class="k-login-v1__body">
                    <div class="k-login-v1__body-seaprator"></div>
                    <div class="k-login-v1__body-wrapper">
                        <div class="k-login-v1__body-container">
                            <h3 class="k-login-v1__body-title">
                                Sign To Account
                            </h3>
                            {{-- {{ dd(csrf_token()) }} --}}
                            <!--begin::Form-->
                            <form class="k-login-v1__body-form k-form" action="{{ route('login') }}" method="POST" autocomplete="off">
                               @csrf
                                <input type="hidden" name="_token_debug" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <input class="form-control" type="email" placeholder="Email" name="email" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="Password" name="password" autocomplete="off">
                                </div>

                                <!-- Action buttons phải nằm trong form -->
                                <div class="k-login-v1__body-action">
                                    <button type="submit" class="btn btn-pill btn-elevate">Sign In</button>
                                </div>
                            </form>


                            <!--end::Action-->

                        </div>
                    </div>

                    <!--end::Wrapper-->
                </div>

                <!--begin::Body-->
            </div>

            <!--end::Item-->

            <!--begin::Item-->
            <!--end::Item-->
        </div>
    </div>

    <!-- end:: Page -->

    <!-- begin:: Topbar Offcanvas Panels -->

    <!-- begin::Offcanvas Toolbar Search -->
    <div id="k_offcanvas_toolbar_search" class="k-offcanvas-panel">
        <div class="k-offcanvas-panel__head">
            <h3 class="k-offcanvas-panel__title">
                Search
            </h3>
            <a href="#" class="k-offcanvas-panel__close" id="k_offcanvas_toolbar_search_close"><i class="flaticon2-delete"></i></a>
        </div>
        <div class="k-offcanvas-panel__body">
            <div class="k-search">
                <div class="k-search__form">
                    <form action="#" method="get">
                        <input type="text" name="query" class="form-control" placeholder="Type here...">
                    </form>
                </div>
                <div class="k-search__result">
                    <div class="k-search__section">
                        Documents
                    </div>
                    <div class="k-search__item">
                        <div class="k-search__item-img k-search__item-img--file">
                            <img src="../assets/media/files/doc.svg" alt="" />
                        </div>
                        <div class="k-search__item-wrapper">
                            <a href="#" class="k-search__item-title">
                                AirPlus Requirements
                            </a>
                            <div class="k-search__item-desc">
                                by Grog John
                            </div>
                        </div>
                    </div>
                    <div class="k-search__item">
                        <div class="k-search__item-img k-search__item-img--file">
                            <img src="../assets/media/files/pdf.svg" alt="" />
                        </div>
                        <div class="k-search__item-wrapper">
                            <a href="#" class="k-search__item-title">
                                TechNav Documentation
                            </a>
                            <div class="k-search__item-desc">
                                by Mary Broun
                            </div>
                        </div>
                    </div>
                    <div class="k-search__item">
                        <div class="k-search__item-img k-search__item-img--file">
                            <img src="../assets/media/files/zip.svg" alt="" />
                        </div>
                        <div class="k-search__item-wrapper">
                            <a href="#" class="k-search__item-title">
                                All Framework Docs
                            </a>
                            <div class="k-search__item-desc">
                                by Grog John
                            </div>
                        </div>
                    </div>
                    <div class="k-search__item">
                        <div class="k-search__item-img k-search__item-img--file">
                            <img src="../assets/media/files/xml.svg" alt="" />
                        </div>
                        <div class="k-search__item-wrapper">
                            <a href="#" class="k-search__item-title">
                                AirPlus Requirements
                            </a>
                            <div class="k-search__item-desc">
                                by Grog John
                            </div>
                        </div>
                    </div>
                    <div class="k-search__section">
                        Members
                    </div>
                    <div class="k-search__item">
                        <div class="k-search__item-img">
                            <img src="../assets/media/users/300_14.jpg" alt="" />
                        </div>
                        <div class="k-search__item-wrapper">
                            <a href="#" class="k-search__item-title">
                                Jimmy Curry
                            </a>
                            <div class="k-search__item-desc">
                                Software Developer
                            </div>
                        </div>
                    </div>
                    <div class="k-search__item">
                        <div class="k-search__item-img">
                            <img src="../assets/media/users/300_20.jpg" alt="" />
                        </div>
                        <div class="k-search__item-wrapper">
                            <a href="#" class="k-search__item-title">
                                Milena Gibson
                            </a>
                            <div class="k-search__item-desc">
                                UI Designer
                            </div>
                        </div>
                    </div>
                    <div class="k-search__item">
                        <div class="k-search__item-img">
                            <img src="../assets/media/users/300_2.jpg" alt="" />
                        </div>
                        <div class="k-search__item-wrapper">
                            <a href="#" class="k-search__item-title">
                                Anna Strong
                            </a>
                            <div class="k-search__item-desc">
                                Software Developer
                            </div>
                        </div>
                    </div>
                    <div class="k-search__section">
                        Files
                    </div>
                    <div class="k-search__item">
                        <div class="k-search__item-icon">
                            <i class="flaticon2-box k-font-danger"></i>
                        </div>
                        <div class="k-search__item-wrapper">
                            <a href="#" class="k-search__item-title">
                                2 New items submitted
                            </a>
                            <div class="k-search__item-desc">
                                Marketing Manager
                            </div>
                        </div>
                    </div>
                    <div class="k-search__item">
                        <div class="k-search__item-icon">
                            <i class="flaticon-psd k-font-brand"></i>
                        </div>
                        <div class="k-search__item-wrapper">
                            <a href="#" class="k-search__item-title">
                                79 PSD files generated
                            </a>
                            <div class="k-search__item-desc">
                                by Grog John
                            </div>
                        </div>
                    </div>
                    <div class="k-search__item">
                        <div class="k-search__item-icon">
                            <i class="flaticon2-supermarket k-font-warning"></i>
                        </div>
                        <div class="k-search__item-wrapper">
                            <a href="#" class="k-search__item-title">
                                $2900 worth products sold
                            </a>
                            <div class="k-search__item-desc">
                                Total 234 items
                            </div>
                        </div>
                    </div>
                    <div class="k-search__item">
                        <div class="k-search__item-icon">
                            <i class="flaticon-safe-shield-protection k-font-info"></i>
                        </div>
                        <div class="k-search__item-wrapper">
                            <a href="#" class="k-search__item-title">
                                4 New items submitted
                            </a>
                            <div class="k-search__item-desc">
                                Marketing Manager
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end::Offcanvas Toolbar Search -->

    <!-- begin::Offcanvas Toolbar Quick Actions -->
    <div id="k_offcanvas_toolbar_quick_actions" class="k-offcanvas-panel">
        <div class="k-offcanvas-panel__head">
            <h3 class="k-offcanvas-panel__title">
                Quick Actions
            </h3>
            <a href="#" class="k-offcanvas-panel__close" id="k_offcanvas_toolbar_quick_actions_close"><i class="flaticon2-delete"></i></a>
        </div>
        <div class="k-offcanvas-panel__body">
            <div class="k-grid-nav-v2">
                <a href="#" class="k-grid-nav-v2__item">
                    <div class="k-grid-nav-v2__item-icon"><i class="flaticon2-box"></i></div>
                    <div class="k-grid-nav-v2__item-title">Orders</div>
                </a>
                <a href="#" class="k-grid-nav-v2__item">
                    <div class="k-grid-nav-v2__item-icon"><i class="flaticon-download-1"></i></div>
                    <div class="k-grid-nav-v2__item-title">Uploades</div>
                </a>
                <a href="#" class="k-grid-nav-v2__item">
                    <div class="k-grid-nav-v2__item-icon"><i class="flaticon2-supermarket"></i></div>
                    <div class="k-grid-nav-v2__item-title">Products</div>
                </a>
                <a href="#" class="k-grid-nav-v2__item">
                    <div class="k-grid-nav-v2__item-icon"><i class="flaticon2-avatar"></i></div>
                    <div class="k-grid-nav-v2__item-title">Customers</div>
                </a>
                <a href="#" class="k-grid-nav-v2__item">
                    <div class="k-grid-nav-v2__item-icon"><i class="flaticon2-list"></i></div>
                    <div class="k-grid-nav-v2__item-title">Blog Posts</div>
                </a>
                <a href="#" class="k-grid-nav-v2__item">
                    <div class="k-grid-nav-v2__item-icon"><i class="flaticon2-settings"></i></div>
                    <div class="k-grid-nav-v2__item-title">Settings</div>
                </a>
            </div>
        </div>
    </div>

    <!-- end::Offcanvas Toolbar Quick Actions -->

    <!-- end:: Topbar Offcanvas Panels -->

    <!-- begin::Global Config -->
    <script>
        var KAppOptions = {
            "colors": {
                "state": {
                    "brand": "#5d78ff",
                    "metal": "#c4c5d6",
                    "light": "#ffffff",
                    "accent": "#00c5dc",
                    "primary": "#5867dd",
                    "success": "#34bfa3",
                    "info": "#36a3f7",
                    "warning": "#ffb822",
                    "danger": "#fd3995",
                    "focus": "#9816f4"
                },
                "base": {
                    "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                    "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                }
            }
        };
    </script>

    <!-- end::Global Config -->

    <!--begin:: Global Mandatory Vendors -->
    <script src="../assets/vendors/general/jquery/dist/jquery.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/popper.js/dist/umd/popper.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/js-cookie/src/js.cookie.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/moment/min/moment.min.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/tooltip.js/dist/umd/tooltip.min.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/sticky-js/dist/sticky.min.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/wnumb/wNumb.js" type="text/javascript"></script>

    <!--end:: Global Mandatory Vendors -->

    <!--begin:: Global Optional Vendors -->
    <script src="../assets/vendors/general/jquery-form/dist/jquery.form.min.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/block-ui/jquery.blockUI.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="../assets/vendors/custom/theme/framework/vendors/bootstrap-datepicker/init.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="../assets/vendors/custom/theme/framework/vendors/bootstrap-timepicker/init.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/bootstrap-maxlength/src/bootstrap-maxlength.js" type="text/javascript"></script>
    <script src="../assets/vendors/custom/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/typeahead.js/dist/typeahead.bundle.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/handlebars/dist/handlebars.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/inputmask/dist/jquery.inputmask.bundle.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/inputmask/dist/inputmask/inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/inputmask/dist/inputmask/inputmask.phone.extensions.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/nouislider/distribute/nouislider.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/owl.carousel/dist/owl.carousel.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/autosize/dist/autosize.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/clipboard/dist/clipboard.min.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/dropzone/dist/dropzone.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/summernote/dist/summernote.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/markdown/lib/markdown.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
    <script src="../assets/vendors/custom/theme/framework/vendors/bootstrap-markdown/init.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/jquery-validation/dist/jquery.validate.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/jquery-validation/dist/additional-methods.js" type="text/javascript"></script>
    <script src="../assets/vendors/custom/theme/framework/vendors/jquery-validation/init.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/toastr/build/toastr.min.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/raphael/raphael.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/morris.js/morris.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/chart.js/dist/Chart.bundle.js" type="text/javascript"></script>
    <script src="../assets/vendors/custom/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js" type="text/javascript"></script>
    <script src="../assets/vendors/custom/vendors/jquery-idletimer/idle-timer.min.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/waypoints/lib/jquery.waypoints.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/counterup/jquery.counterup.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/es6-promise-polyfill/promise.min.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script>
    <script src="../assets/vendors/custom/theme/framework/vendors/sweetalert2/init.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/jquery.repeater/src/lib.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/jquery.repeater/src/jquery.input.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/jquery.repeater/src/repeater.js" type="text/javascript"></script>
    <script src="../assets/vendors/general/dompurify/dist/purify.js" type="text/javascript"></script>

    <!--end:: Global Optional Vendors -->

    <!--begin::Global Theme Bundle -->
    <script src="../assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>

    <!--end::Global Theme Bundle -->

    <!--begin::Page Scripts -->
    <script src="../assets/demo/default/custom/custom/login/login.js" type="text/javascript"></script>

    <!--end::Page Scripts -->

    <!--begin::Global App Bundle -->
    <script src="../assets/app/scripts/bundle/app.bundle.js" type="text/javascript"></script>

    <!--end::Global App Bundle -->
</body>

<!-- end::Body -->

</html>
