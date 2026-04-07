(function ($) {
    "use strict";

    // O preloader não precisa de jQuery! Vanilla JS é mais seguro aqui.
    window.addEventListener('load', function () {
        var preloader = document.getElementById('preloader');
        if (preloader) {
            preloader.style.transition = "opacity 0.5s ease";
            preloader.style.opacity = "0";
            setTimeout(function () {
                preloader.style.display = "none";
                preloader.remove();
            }, 500);
        }
    });

})(jQuery);