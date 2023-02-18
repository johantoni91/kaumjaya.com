@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key={{ env('MIDTRANS_CLIENT_KEY') }}></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tampilPass').click(function() {
            if ($(this).is(':checked')) {
                $('.form-password').attr('type', 'text');
            } else {
                $('.form-password').attr('type', 'password');
            }
        });
        $('#tampilPass2').click(function() {
            if ($(this).is(':checked')) {
                $('.form-password2').attr('type', 'text');
            } else {
                $('.form-password2').attr('type', 'password');
            }
        });
        $('#tampilPass3').click(function() {
            if ($(this).is(':checked')) {
                $('.form-password3').attr('type', 'text');
            } else {
                $('.form-password3').attr('type', 'password');
            }
        });
    });
</script>
</body>

</html>
