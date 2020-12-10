BX.ready(function () {

    const $form = $('form[name="register-form"]');
    const submitBtn = $('[type="submit"]', $form);

    $form.on('submit', function (evt) {
        evt.preventDefault();
        $(submitBtn).attr('disabled', true);
        const sendData = $form.serialize();
        const errClass = 'input-error';
        const errorBlock = $('.register-form__errors');

        $('.register-form__field').removeClass(errClass);
        errorBlock.html('');

        BX.ajax({
            url: this.action,
            data: sendData,
            method: 'POST',
            dataType: 'json',
            onsuccess: function (response) {

                if(response.errors && response.errors.length !== 0){
                    $(submitBtn).attr('disabled', false);
                    const errors = response.errors;

                    for (name in errors) {
                        const fieldWrap = $('[name="' + name + '"]').closest('.register-form__field');
                        fieldWrap.addClass(errClass);
                        fieldWrap.find('.label-style__error').text(errors[name]);
                    }

                }else if(response.global_errors) {
                    const errorText = response.global_errors;
                    $(submitBtn).attr('disabled', false);
                    errorBlock.html(errorText);
                }else if(response.status && response.status === 'ok'){
                    $('.register-form__success').text('Спасибо. На указанный email выслано письмо для подтверждения регистрации');
                    setTimeout(function () {
                        window.location.replace($('input[name="success"]', $form).val());
                    }, 3000);
                }
                $(submitBtn).attr('disabled', false);

            }

        });
    });

})