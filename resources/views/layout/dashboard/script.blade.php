{{-- Izitoast JS --}}
<script src="{{ asset('libraries/izitoast/dist/js/iziToast.min.js') }}"></script>

{{-- Sweet alert --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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

<script>
    $(document).ready(function() {
        $('.btn-delete').click(function(e) {
            e.preventDefault()
            let href = $(this).attr('href')
            swal({
                title: "Warning",
                text: "This Data Will be Deleted",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
                    $(this).parent('div').parent('div').parent('td').parent('tr').remove()
                    $.ajax({
                        url: href,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'DELETE',
                        dataType: 'json',
                        success: function(res) {
                            swal({
                                title: 'Success',
                                text: 'Data Successfully Deleted',
                                icon: "success",
                                button: "Close"
                            }).then(() => {
                                location.reload()
                            })
                        },
                        error: function(res) {
                            swal({
                                title: "Oops..!",
                                text: "Something went Wrong",
                                icon: "error",
                                button: "Close",
                            }).then(() => {
                                location.reload();
                            });
                        }
                    })
                }
            })
        })

        $('#image').change(function(e) {
            let reader = new FileReader()
            reader.onload = function(e) {
                $('#showImage').removeClass('d-none')
                $('#showImage').attr('src', e.target.result)
            }
            reader.readAsDataURL(e.target.files['0'])
        })
    })
</script>

<script>
    $(document).ready(function() {
        $('.approval-btn').click(function(e) {

            e.preventDefault()

            let href = $(this).attr('href')

            if ($(this).attr('id') == "approve") {
                swal({
                    title: "Warning",
                    text: "This Data Will be Aprroved",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((result) => {
                    if (result) {
                        $.ajax({
                            url: href,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            success: function(res) {
                                swal({
                                    title: 'Success',
                                    text: 'Data Successfully Approved',
                                    icon: "success",
                                    button: "Close"
                                }).then(() => {
                                    location.reload()
                                })
                            },
                            error: function(res) {
                                swal({
                                    title: "Oops..!",
                                    text: "Something went Wrong",
                                    icon: "error",
                                    button: "Close",
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        })
                    }
                })
                console.log(href)
            } else {
                swal({
                    title: "Warning",
                    text: "This Data Will be Rejected",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((result) => {
                    if (result) {
                        $.ajax({
                            url: href,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            success: function(res) {
                                swal({
                                    title: 'Success',
                                    text: 'Data Successfully Rejected',
                                    icon: "success",
                                    button: "Close"
                                }).then(() => {
                                    location.reload()
                                })
                            },
                            error: function(res) {
                                swal({
                                    title: "Oops..!",
                                    text: "Something went Wrong",
                                    icon: "error",
                                    button: "Close",
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        })
                    }
                })
            }
        })
    })
</script>
