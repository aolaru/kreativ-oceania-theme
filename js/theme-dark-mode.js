(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var toggle = document.createElement('button');
        var storage = null;
        var settings = window.kreativCoreSettings || {};
        var root = document.documentElement;

        try {
            storage = window.localStorage;
        } catch (error) {
            storage = null;
        }

        toggle.classList.add('dark-toggle');
        toggle.setAttribute('type', 'button');
        toggle.setAttribute('aria-label', settings.darkModeLabel || '');
        toggle.setAttribute('aria-pressed', root.classList.contains('kreativ-dark-mode') ? 'true' : 'false');
        toggle.innerHTML = '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21.64 13a9 9 0 0 1-8.64 8.95A9 9 0 0 1 12 3v0a9 9 0 0 1 9.64 10z"/></svg>';
        (document.querySelector('.kreativ-site-nav') || document.body).appendChild(toggle);

        document.body.classList.toggle('dark-mode', root.classList.contains('kreativ-dark-mode'));

        toggle.addEventListener('click', function () {
            var isDarkMode = !root.classList.contains('kreativ-dark-mode');

            root.classList.toggle('kreativ-dark-mode', isDarkMode);
            document.body.classList.toggle('dark-mode', isDarkMode);
            toggle.setAttribute('aria-pressed', isDarkMode ? 'true' : 'false');

            if (storage) {
                try {
                    storage.setItem('kreativ-dark', isDarkMode ? 'true' : 'false');
                } catch (error) {
                    storage = null;
                }
            }
        });
    });
}());
