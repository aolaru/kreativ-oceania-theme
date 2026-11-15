(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var toggle = document.createElement('button');
        var storage = null;
        var settings = window.kreativCoreSettings || {};

        try {
            storage = window.localStorage;
        } catch (error) {
            storage = null;
        }

        toggle.classList.add('dark-toggle');
        toggle.setAttribute('type', 'button');
        toggle.setAttribute('aria-label', settings.darkModeLabel || '');
        toggle.innerHTML = '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21.64 13a9 9 0 0 1-8.64 8.95A9 9 0 0 1 12 3v0a9 9 0 0 1 9.64 10z"/></svg>';
        document.body.appendChild(toggle);

        try {
            if (storage && storage.getItem('kreativ-dark') === 'true') {
                document.body.classList.add('dark-mode');
            }
        } catch (error) {
            storage = null;
        }

        toggle.addEventListener('click', function () {
            document.body.classList.toggle('dark-mode');

            if (storage) {
                try {
                    storage.setItem('kreativ-dark', document.body.classList.contains('dark-mode'));
                } catch (error) {
                    storage = null;
                }
            }
        });
    });
}());
