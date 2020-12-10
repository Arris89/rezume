"use strict";

// /* eslint-disable no-unused-vars */
// /* eslint-disable no-undef */
(function ($, app) {
  var isFormValidate = function isFormValidate(form, error_class) {
    var result = true;
    var rq = $('.required', form).length;
    var check = ['input[type="text"]', 'input[type="login"]', 'input[type="password"]', 'input[type="number"]', 'input[type="checkbox"]', 'input[type="tel"]', 'input[type="email"]', 'input[type="select"]', 'input[type="file"]', 'textarea', 'select'];
    var parent;
    error_class = error_class || 'invalid-input';
    $('.required, input, textarea, select').removeClass(error_class);

    if (rq < 1) {
      return result;
    }

    for (var i = 0; i < rq; i++) {
      parent = $('.required', form).eq(i); // eslint-disable-next-line no-loop-func

      $(check.join(','), parent).each(function () {
        if (!isFieldValidate($(this))) {
          if ($(this).attr('type') === 'checkbox' || $(this).attr('type') === 'file') {
            $(this).closest('label').addClass(error_class);
          } else {
            $(this).addClass(error_class);
          }

          result = false;
        }
      });
    }

    if (result) {
      form.removeClass('form-invalid');
    } else {
      form.addClass('form-invalid');
    }

    return result;
  };

  var isValidEmail = function isValidEmail(email) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(email);
  };

  var isValidPhone = function isValidPhone(phone) {
    var pattern = new RegExp(/\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}/i);
    return pattern.test(phone);
  };

  var isValidFile = function isValidFile(file) {
    var maxSize = $(file).data('max-size');
    var type_reg = /^image\/(jpg|png|jpeg|gif)$/;

    if (file.get(0).files[0].size > maxSize || file.get(0).files[0].name === '' || !type_reg.test(file.get(0).files[0].type)) {
      return false;
    }

    return true;
  };

  var isFieldValidate = function isFieldValidate(field) {
    var result = true;
    var val = '';

    if (field && field.attr('name')) {
      if (!field.val()) {
        field.val('');
        return false;
      }

      val = (field.val() + '').trim();

      if (field.hasClass('js-valid_email') && !isValidEmail(val)) {
        result = false;
      } else if (field.attr('name') === 'phone' && !isValidPhone(val)) {
        result = false;
      } else if (field.attr('type') === 'checkbox' && !field.is(':checked')) {
        result = false;
      } else if (field.attr('type') === 'file' && !isValidFile(field)) {
        result = false;
      } else if (val === null || val === '') {
        field.val('');
        result = false;
      }
    }

    return result;
  };

  app.isFormValidate = isFormValidate;
})(jQuery, window.app);