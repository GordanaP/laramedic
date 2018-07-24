<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/helpers.js') }}"></script>
<script src="{{ asset('js/schedule_helpers.js') }}"></script>

<!-- Custom scripts for this template -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.24.4/sweetalert2.min.js"></script>
<script src="{{ asset('vendor/carbon-master/vendor/chart.js/chart.min.js') }}"></script>
<script src="{{ asset('vendor/carbon-master/js/carbon.js') }}"></script>
<script src="{{ asset('vendor/carbon-master/js/demo.js') }}"></script>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $.notify("{{ session('message') }}", "{{ session('type') }}")
</script>


@yield('scripts')