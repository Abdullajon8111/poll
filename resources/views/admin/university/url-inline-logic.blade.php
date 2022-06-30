<script>

    $('body').on('click', '.switch', function (e) {
        e.preventDefault();
        let id = $(this).data('id')

        let url = '{{ route('admin.university.changeStatus', ['university' => ":university"]) }}';
        url = url.replace([':university'], id);

        window.location.href = url;
    })

</script>
