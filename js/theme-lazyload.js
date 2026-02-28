(function ($) {
    function normalizeLazyAttributes() {
        $('img.lazyload[data-src]').each(function () {
            var $image = $(this);

            if (!$image.attr('data-original')) {
                $image.attr('data-original', $image.attr('data-src'));
            }
        });
    }

    function initLazyload() {
        normalizeLazyAttributes();

        $('img[data-original]').lazyload({
            effect: 'fadeIn',
            threshold: 200
        });
    }

    $(initLazyload);
})(jQuery);
