<script src="{{ asset('assets/admin/vendors/vendor-min.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
<!-- Main js -->
<script src="{{ asset('assets/admin/js/main.js') }}"></script>
<script src="{{ asset('assets/common/js/sweetalert2@10.js') }}"></script>
{{ $topScript ?? '' }}
<!--Custom js use development purpose-->
<script src="{{ asset('assets/admin/js/custom.js') }}"></script>
{{ $bottomScript ?? '' }}
{{-- @vite('resources/js/app.js') --}}
