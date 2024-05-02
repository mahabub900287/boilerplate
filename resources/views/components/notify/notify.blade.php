<link rel="stylesheet" href="{{ asset('/assets/common/css/iziToast.min.css') }}">
<script src="{{ asset('assets/common/js/iziToast.min.js') }}"></script>
<script src="{{ asset('vendor/hnotify/hnotify.js') }}"></script>
@if (session()->has('notify'))

    @foreach (session('notify') as $message)
        <script type="text/javascript">
            const notifyMsg = "{{ $message[1] }}";
            const status = "{{ $message[0] }}";

            triggerNotify(status, notifyMsg);
        </script>
    @endforeach
@endif


@if (isset($errors) && $errors->any())
    <link rel="stylesheet" href="{{ asset('assets/common/css/iziToast.min.css') }}">
    <script src="{{ asset('assets/common/js/iziToast.min.js') }}"></script>
    <script type="text/javascript">
        triggerArrayNotify(@json($errors->all()));
    </script>
@endif


<script>
    function notify(status, message) {
        triggerNotify(status, message);
    }
</script>
