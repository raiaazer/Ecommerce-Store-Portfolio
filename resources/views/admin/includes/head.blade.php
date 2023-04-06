<head>
    <title>Metronic - the world's #1 selling Bootstrap Admin Theme Ecosystem for HTML, Vue, React, Angular &amp; Laravel by Keenthemes</title>
    <meta charset="utf-8" />
    <meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Keenthemes | Metronic" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="{{ asset('admin_assets/assets/media/logos/favicon.ico') }}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    {{-- light --}}
    <link id="light-theme" href="{{ admin_asset('/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link id="light-theme-datatable" href="{{ admin_asset('/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />

    <link id="light-theme-global" href="{{ admin_asset('/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link id="light-theme-style" href="{{ admin_asset('/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    {{-- dark --}}
    <link id="dark-theme" href="{{ admin_asset('/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" disabled/>
    <link id="dark-theme-datatable" href="{{ admin_asset('/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" disabled/>
    <link id="dark-theme-global" href="{{ admin_asset('/plugins/global/plugins.dark.bundle.css') }}" rel="stylesheet" type="text/css" disabled/>
    <link id="dark-theme-style" href="{{ admin_asset('/css/style.dark.bundle.css') }}" rel="stylesheet" type="text/css" disabled/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--end::Global Stylesheets Bundle-->
    @yield('css')
    <!--Begin::Google Tag Manager -->
    {{-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&amp;l='+l:'';j.async=true;j.src= '../../../www.googletagmanager.com/gtm5445.html?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-5FS8GGP');</script> --}}
    <!--End::Google Tag Manager -->
</head>
