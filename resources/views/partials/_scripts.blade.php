<script src="{{ asset('js/app.js') }}"></script>
<script>
    $('input[type="file"]').on('change', function() {
        $(this).next('label').text(this.files[0].name);
    });
</script>
