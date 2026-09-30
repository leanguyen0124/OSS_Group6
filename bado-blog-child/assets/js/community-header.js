(function () {
    const topbar = document.querySelector('.oss-sticky-topbar');
    const nav = document.querySelector('.oss-sticky-nav');
    const brand = document.querySelector('.badoblog-css-site-branding');
    const logo = document.querySelector('.oss-sticky-cat');
    if (!topbar) return;

    const updateHeight = () => {
        document.documentElement.style.setProperty('--oss-topbar-height', `${Math.ceil(topbar.getBoundingClientRect().height)}px`);
        if (nav) document.documentElement.style.setProperty('--oss-nav-height', `${Math.ceil(nav.getBoundingClientRect().height)}px`);
    };

    updateHeight();
    if ('ResizeObserver' in window) {
        const observer = new ResizeObserver(updateHeight);
        observer.observe(topbar);
        if (nav) observer.observe(nav);
    }
    window.addEventListener('resize', updateHeight, { passive: true });

    const updateScroll = () => {
        const stickyGap = parseFloat(window.getComputedStyle(topbar).top) || 0;
        const topbarRect = topbar.getBoundingClientRect();
        const topbarStuck = window.scrollY > 0 && topbarRect.top <= stickyGap + 1;
        document.body.classList.toggle('oss-page-scrolled', topbarStuck);
        const brandRect = brand ? brand.getBoundingClientRect() : null;
        document.body.classList.toggle('oss-brand-behind-bar', Boolean(brandRect && brandRect.top < topbarRect.bottom && brandRect.bottom > topbarRect.bottom));
        const visible = !brandRect || brandRect.bottom <= topbarRect.bottom + 24;
        document.body.classList.toggle('oss-brand-compact', visible);
        if (logo && visible) {
            logo.removeAttribute('aria-hidden');
            logo.removeAttribute('tabindex');
        } else if (logo) {
            logo.setAttribute('aria-hidden', 'true');
            logo.setAttribute('tabindex', '-1');
        }
    };

    updateScroll();
    window.addEventListener('scroll', updateScroll, { passive: true });
    window.addEventListener('resize', updateScroll, { passive: true });
})();
