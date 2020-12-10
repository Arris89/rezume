/* eslint-disable no-unused-vars */
/* eslint-disable no-undef */
(function ($, app) {

    function initMask() {
        $(".js-phone-mask").mask("+7 (000) 000-00-00");
    }

    app.initMask = initMask;
})(jQuery, window.app);
