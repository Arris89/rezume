"use strict";

/* eslint-disable no-unused-vars */

/* eslint-disable no-undef */
(function ($, app) {
  function initCategory() {
    var catItem = $('.js-cat-item');
    catItem.hover(function () {
      var $this = $(this);
      var thisAttr = $this.attr('data-project-item');
      var imageAttr = 'data-project-bg';
      var thisImage = $("[".concat(imageAttr, " = ").concat(thisAttr, "]"));
      $this.siblings().addClass('unactive');
      $this.addClass('active');
      thisImage.addClass('active');
    }, function () {
      var $this = $(this);
      var thisAttr = $this.attr('data-project-item');
      var imageAttr = 'data-project-bg';
      var thisImage = $("[".concat(imageAttr, " = ").concat(thisAttr, "]"));
      $this.siblings().removeClass('unactive');
      $this.removeClass('active');
      thisImage.removeClass('active');
    });
  }

  app.initCategory = initCategory;
})(jQuery, window.app);