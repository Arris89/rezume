// подключение попап
$(document).ready(function () {
  $(".section-header__sub-menu")
    .on('click', 'a[href^="#"]', function (e) {
      var id = $(this).attr('href');

      if (id && $(id).length > 0) {
        e.preventDefault();

        var top = $(id).offset().top;
        top -= ($('.js-fixed-header').length > 0) ? $('.js-fixed-header').outerHeight() : 0;

        //анимируем переход на расстояние - top за 1000 мс
        $('body,html').animate({
          scrollTop: top
        }, 1000);

        return false;
      }
    });

  if (localStorage.getItem('contactsClose') === 'closed') {
    var _modal = $('.fixed-contacts');
    if (!_modal.hasClass('is-close')) {
      _modal.addClass('is-close');
    }
  }
});

// Fixed Contacts
$(document).ready(function () {
  $('.fixed-contacts')
    .click(function (e) {
      var _modal = $(this);
      if (_modal.hasClass('is-close')) {
        _modal.removeClass('is-close');
        return false;
      }
    })
    .on('click', '.fixed-contacts__phone', '.fixed-contacts__address', function (e) {
      var _modal = $(this).parents('.fixed-contacts');
      if (_modal.hasClass('is-close')) {
        _modal.removeClass('is-close');
        localStorage.setItem('contactsClose', 'opened');
        return false;
      }
    })
    .on('click', '.fixed-contacts__close', function (e) {
      var _modal = $(this).parents('.fixed-contacts');
      if (!_modal.hasClass('is-close')) {
        _modal.addClass('is-close');
        localStorage.setItem('contactsClose', 'closed');
      }
      return false;
    });
});
