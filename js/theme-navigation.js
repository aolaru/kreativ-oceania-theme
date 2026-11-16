(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var toggle = document.querySelector('[data-kreativ-menu-toggle]');
        var navigation = document.getElementById('site-navigation');
        var settings = window.kreativCoreSettings || {};

        if (!toggle || !navigation) {
            return;
        }

        function closeNavigation() {
            navigation.classList.remove('open');
            toggle.setAttribute('aria-expanded', 'false');
        }

        function closeSubmenus() {
            navigation.querySelectorAll('.menu-item-has-children.menu-item-open').forEach(function (item) {
                item.classList.remove('menu-item-open');
                item.querySelector('[data-kreativ-submenu-toggle]').setAttribute('aria-expanded', 'false');
            });
        }

        navigation.querySelectorAll('.menu-item-has-children').forEach(function (item, index) {
            var submenu = item.querySelector(':scope > .sub-menu');

            if (!submenu) {
                return;
            }

            submenu.id = submenu.id || 'kreativ-submenu-' + index;

            var submenuToggle = document.createElement('button');
            submenuToggle.type = 'button';
            submenuToggle.className = 'kreativ-submenu-toggle';
            submenuToggle.setAttribute('data-kreativ-submenu-toggle', '');
            submenuToggle.setAttribute('aria-controls', submenu.id);
            submenuToggle.setAttribute('aria-expanded', 'false');
            submenuToggle.setAttribute('aria-label', settings.submenuLabel || 'Toggle submenu');
            submenuToggle.innerHTML = '<span aria-hidden="true">+</span>';
            item.insertBefore(submenuToggle, submenu);

            submenuToggle.addEventListener('click', function () {
                var isOpen = item.classList.toggle('menu-item-open');
                submenuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            });
        });

        toggle.addEventListener('click', function () {
            var isOpen = navigation.classList.toggle('open');
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');

            if (isOpen) {
                var firstMenuLink = navigation.querySelector('.kreativ-primary-menu a');

                if (firstMenuLink) {
                    window.setTimeout(function () {
                        firstMenuLink.focus();
                    }, 50);
                }
            }
        });

        document.addEventListener('keydown', function (event) {
            if ('Escape' === event.key && navigation.classList.contains('open')) {
                event.preventDefault();
                closeSubmenus();
                closeNavigation();
                toggle.focus();
            }
        }, true);
    });
}());
