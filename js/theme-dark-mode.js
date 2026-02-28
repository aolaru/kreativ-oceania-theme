document.addEventListener('DOMContentLoaded', function () {
    var toggle = document.createElement('button');

    toggle.classList.add('dark-toggle');
    toggle.setAttribute('type', 'button');
    toggle.setAttribute('aria-label', 'Toggle dark mode');
    toggle.innerHTML = '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21.64 13a9 9 0 0 1-8.64 8.95A9 9 0 0 1 12 3v0a9 9 0 0 1 9.64 10z"/></svg>';
    document.body.appendChild(toggle);

    if (localStorage.getItem('kreativ-dark') === 'true') {
        document.body.classList.add('dark-mode');
    }

    toggle.addEventListener('click', function () {
        document.body.classList.toggle('dark-mode');
        localStorage.setItem('kreativ-dark', document.body.classList.contains('dark-mode'));
    });
});
