(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var toggle = document.querySelector('[data-kreativ-menu-toggle]');
        var navigation = document.getElementById('site-navigation');

        if (!toggle || !navigation) {
            return;
        }

        function closeNavigation() {
            navigation.classList.remove('open');
            toggle.setAttribute('aria-expanded', 'false');
        }

        toggle.addEventListener('click', function () {
            var isOpen = navigation.classList.toggle('open');
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');

            if (isOpen) {
                var firstMenuLink = navigation.querySelector('.navbar-nav a');

                if (firstMenuLink) {
                    window.setTimeout(function () {
                        firstMenuLink.focus();
                    }, 50);
                }
            }
        });

        document.addEventListener('keydown', function (event) {
            if ('Escape' === event.key && navigation.classList.contains('open')) {
                closeNavigation();
                toggle.focus();
            }
        });
    });
}());
