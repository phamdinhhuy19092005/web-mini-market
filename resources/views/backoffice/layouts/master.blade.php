<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>HuyPham | Dashboard</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

    <!--begin:: Css  -->
    @include('backoffice.layouts.css.master-css')
    <!--end:: Css  -->

    @yield('style_datatable')

</head>


<body class="k-header--fixed k-header-mobile--fixed k-aside--enabled">

    <div class="k-grid k-grid--hor k-grid--root">
        <div class="k-grid__item k-grid__item--fluid k-grid k-grid--ver k-page">
            <div class="k-aside  k-aside--fixed   aside-menu-bootstrap	k-grid__item k-grid k-grid--desktop k-grid--hor-desktop" id="k_aside" style="position: fixed;">
                @include('backoffice.includes.aside')
            </div>

            <div class="k-grid__item k-grid__item--fluid k-grid k-grid--hor k-wrapper" id="k_wrapper">

                @include('backoffice.includes.header')
                <div class="k-content k-grid__item k-grid__item--fluid k-grid k-grid--hor" id="k_content" style="padding-left: 285px">
                    <div class="k-content__head-breadcrumbs">
                        @yield('breadcrumb')
                    </div>

                    <!--begin:: Content Body -->
                    @yield('content_body')
                    <!--end:: Content Body -->
                </div>
            </div>
        </div>
    </div>

    <!--begin:: Global JS-->
    @include('backoffice.layouts.js.master-js')
    <!--end:: Global JS-->

    @yield('js_datatable')
</body>
</html>
