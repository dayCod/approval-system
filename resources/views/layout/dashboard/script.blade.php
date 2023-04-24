{{-- Izitoast JS --}}
<script src="{{ asset('libraries/izitoast/dist/js/iziToast.min.js') }}"></script>

@if (Session::has('success'))
    <script>
        iziToast.success({
            title: 'Berhasil',
            message: "{{ session('success') }}",
            position: "topRight",
        });
    </script>
@endif

@if (Session::has('fail'))
    <script>
        iziToast.error({
            title: '',
            message: "{{ session('fail') }}",
            position: "topRight",
        });
    </script>
@endif
