@include('template.head')

<body>
    <main>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <strong class="modal-title mx-auto" id="staticBackdropLabel">Konfirmasi</strong>
                    </div>
                    <div class="modal-body d-flex justify-content-between">
                        <a href="{{ route('jajanCart') }}" class="btn border-0 btn-outline-danger"><i
                                class="bi bi-box-arrow-left"></i> Kembali</a>
                        <button type="button" id="pay-button" class="btn border-0 btn-outline-success">Bayar <i
                                class="bi bi-box-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <form action="" id="submit_form" method="POST">
            @csrf
            <input type="hidden" name="json" id="get_data">
        </form>
    </main>
        <script type="text/javascript">
            $(function() {
                $('#staticBackdrop').modal('show')
            })
            $('#pay-button').on('click', function() {
                window.snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result) {
                        document.getElementById('get_data').value = JSON.stringify(result)
                        $('#submit_form').submit()
                    },
                    onPending: function(result) {
                        document.getElementById('get_data').value = JSON.stringify(result)
                        $('#submit_form').submit()
                    },
                    onError: function(result) {
                        document.getElementById('get_data').value = JSON.stringify(result)
                        $('#submit_form').submit()
                    },
                    onClose: function() {
                        alert('Mohon selesaikan pembayaran')
                    }
                })
            })
        </script>
    @include('template.foot')
