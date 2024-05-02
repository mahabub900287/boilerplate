<!-- ==== CSS Dependencies Start ==== -->
<link rel="stylesheet" href="{{ asset('assets/admin/vendors/vendor-min.css') }}" />
<!-- ==== CSS Dependencies End ==== -->
<!-- default grey-theme -->
<link rel="stylesheet" type="text/css"
    href="https://unpkg.com/@fonticonpicker/fonticonpicker@3.0.0-alpha.0/dist/css/themes/grey-theme/jquery.fonticonpicker.grey.min.css" />

{{ $topStyle ?? '' }}
<!-- Main css -->
<link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}" />
<!--Custom css use development purpose-->
<link rel="stylesheet" href="{{ asset('assets/admin/css/custom.css') }}" />
{{-- <link rel="stylesheet" href="{{ asset('assets/admin/css/datatable.css') }}" /> --}}
{{ $bottomStyle ?? '' }}
{{-- @vite('resources/css/app.css') --}}
