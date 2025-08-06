<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ auth('admin')->user()->name ?? 'admin' }} | Không phận sự cấm vào</title>

    <!-- Web Fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
    <script>
        WebFontConfig = {
            google: { families: ['Poppins:300,400,500,600,700'] },
            active: () => { sessionStorage.setItem('fonts', 'true'); }
        };
        (function(d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <!-- CSS -->
    @include('backoffice.layouts.css.master-css')
    @yield('style_datatable')
    @stack('style_pages')
</head>
<body class="k-header--fixed k-header-mobile--fixed k-aside--enabled k-aside--fixed">
    <div class="k-grid k-grid--hor k-grid--root">
        <div class="k-grid__item k-grid__item--fluid k-grid k-grid--ver k-page">
            <!-- Aside -->
            <aside class="k-aside k-aside--fixed aside-menu-bootstrap k-grid__item k-grid k-grid--desktop k-grid--hor-desktop" id="k_aside">
                @include('backoffice.includes.aside')
            </aside>

            <!-- Main Wrapper -->
            <div class="k-grid__item k-grid__item--fluid k-grid k-grid--hor k-wrapper" id="k_wrapper">
                <!-- Header -->
                @include('backoffice.includes.header')

                <!-- Content -->
                <main class="k-content k-grid__item k-grid__item--fluid k-grid k-grid--hor" id="k_content">
                    <nav class="k-content__head-breadcrumbs">
                        @yield('breadcrumb')
                    </nav>
                    <section class="k-content__body">
                        @yield('content_body')
                    </section>
                </main>
            </div>
        </div>
    </div>

    <div id="k_scrolltop" class="k-scrolltop">
        <i class="la la-arrow-up"></i>
    </div>

    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
    @include('backoffice.layouts.js.master-js')
    <script src="{{ asset('js/backoffice/components/renderers.js') }}"></script>
    @yield('js_datatable')
    @stack('js_pages')
    @yield('js_script')
    @stack('scripts')
    @stack('modals')
</body>
</html>