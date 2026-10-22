(() => {
    const root = document.documentElement;
    const intro = document.querySelector('.oss-welcome');
    const page = document.getElementById('page');
    if (!intro || !page) return;
    const button = intro.querySelector('button');
    const reduced = matchMedia('(prefers-reduced-motion: reduce)').matches;
    let entered = false;
    const enter = () => {
        if (entered) return;
        entered = true;
        const fromWords = intro.querySelectorAll('.oss-welcome-title span');
        const toWords = document.querySelectorAll('.oss-wordmark span');
        if (!reduced) fromWords.forEach((word, index) => {
            const from = word.getBoundingClientRect();
            const to = toWords[index].getBoundingClientRect();
            const dx = to.left + to.width / 2 - from.left - from.width / 2;
            const dy = to.top - from.top;
            const matrix = new DOMMatrix(getComputedStyle(word).transform);
            word.animate([
                { transform: getComputedStyle(word).transform, opacity: 1 },
                { transform: `translate(${dx}px, ${dy}px) scale(${matrix.a * to.width / from.width}, ${matrix.d * to.height / from.height})`, opacity: .25 }
            ], { duration: 1250, easing: 'cubic-bezier(.22,.7,.2,1)', fill: 'forwards' });
        });
        root.classList.remove('oss-welcome-pending');
        root.classList.add('oss-welcome-entered');
        page.inert = true;
        try { sessionStorage.setItem('oss-welcome-seen', '1'); } catch (_) {}
        window.setTimeout(() => {
            window.location.assign(intro.dataset.home);
        }, reduced ? 0 : 1150);
    };
    if (root.classList.contains('oss-welcome-pending')) {
        page.inert = true;
        button.focus({ preventScroll: true });
    } else { intro.hidden = true; }
    button.addEventListener('click', enter);
    window.addEventListener('pageshow', (event) => {
        if (event.persisted) window.location.reload();
    });
})();
