"use strict";

/* eslint-disable no-unused-vars */

/* eslint-disable no-undef */
// import {isFormValidate} from './initValidate';
(function ($, app) {
  /**
   * init
   */
  var initSendForm = function initSendForm() {
    $('body').on('submit', 'form', function (e) {
      return sendForm(e);
    });
  };
  /**
   * Валидация перед отправкой формы
   *
   * @param {object} e event
   */


  var sendForm = function sendForm(e) {
    var t = $(e.target);

    if (!app.isFormValidate(t)) {
      e.preventDefault();
      e.stopPropagation();
      $('.js-form-result', t).text('Заполните все поля');
      $('.invalid-input', t).first().focus();
    } else if (t.hasClass('js-ajax-form')) {
      e.preventDefault();
      e.stopPropagation();
      t.addClass('load');
      axios.post(t.attr('action'), new FormData(t.get(0))).then(function (response) {
        successResponse(response.data, t);
        t.removeClass('load');
      })["catch"](function (error) {
        errorResponse(error.response.data, t);
        t.removeClass('load');
      });
    } else {
      // let uploadFormData = new FormData(t.get(0));
      // for (let [key, value] of uploadFormData.entries()) { // не работает в IE
      //     console.log(key, value);
      // }
      $('.js-form-result', t).text('');
      e.preventDefault();
      e.stopPropagation();
    }
  };
  /**
   * fail callback
   *
   * @param data
   * @param form
   */


  var errorResponse = function errorResponse(data, form) {
    if (isObject(data.errors)) {
      $('.js-form-result', form).text('');

      for (var i in data.errors) {
        if ({}.hasOwnProperty.call(data.errors, i)) {
          $('[name="' + i + '"]', form).addClass('invalid-input');
          $('.js-form-result', form).append(data.errors[i].join('</br>'));
        }
      }

      form.addClass('form-invalid');
    } else {
      $('.js-form-result', form).text(data.message);
      form.addClass('form-invalid');
    }
  };
  /**
   * callback success
   *
   * @param data
   * @param form
   */


  var successResponse = function successResponse(data, form) {
    if (data.action === 'modal') {
      openModal(data.modal);
    } else if (data.action === 'reload') {
      location.reload();
    } else if (data.action === 'navigate') {
      location.href = data.link;
    } else if (data.action === 'send') {
      form.html('<div class="form__message form__message_success">' + data.content + '</div>');

      if (data.goal) {
        sendTarget(data.goal);
      }
    } else if (data.action === 'load') {
      openModal(data.modal);
      $('#popup-check-register button[type="reset"]').click();
      $('.section-calendar .calendar__table').html(data.content);
    }
  };

  app.initSendForm = initSendForm;
})(jQuery, window.app);