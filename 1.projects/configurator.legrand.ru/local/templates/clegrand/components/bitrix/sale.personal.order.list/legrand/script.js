BX.ready(function () {
    $('.js-cancel').on('click', function () {
        const id = $(this).data('id');
        $('.js-cancel-form input[name=ID]').val(id);
    })
});