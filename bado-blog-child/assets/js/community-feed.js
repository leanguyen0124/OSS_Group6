(function () {
    const list = document.querySelector('.oss-feed-list');
    const loader = document.querySelector('.oss-feed-loader');
    const button = document.querySelector('.oss-feed-more');
    const status = document.querySelector('.oss-feed-load-status');
    if (!list || !loader || !button || !status || typeof ossFeed === 'undefined') return;

    let offset = list.children.length;
    let busy = false;
    let done = loader.dataset.hasMore !== '1';

    const loadMore = async () => {
        if (busy || done) return;
        busy = true;
        button.disabled = true;
        status.textContent = 'Đang tải bài đăng…';

        const data = new URLSearchParams({
            action: 'oss_community_load_more',
            nonce: ossFeed.nonce,
            offset: String(offset)
        });

        try {
            const response = await fetch(ossFeed.url, {
                method: 'POST',
                credentials: 'same-origin',
                body: data
            });
            if (!response.ok) throw new Error('Feed request failed');
            const result = await response.json();
            if (!result.success) throw new Error('Feed response failed');

            list.insertAdjacentHTML('beforeend', result.data.html);
            offset += result.data.count;
            done = !result.data.has_more || result.data.count === 0;
            status.textContent = done ? 'Bạn đã xem hết bài đăng.' : '';
            button.hidden = done;
            if (done && observer) observer.disconnect();
        } catch (error) {
            status.textContent = 'Không tải được bài đăng. Hãy thử lại.';
        } finally {
            busy = false;
            button.disabled = false;
        }
    };

    button.addEventListener('click', loadMore);
    let observer = null;
    if ('IntersectionObserver' in window) {
        observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) loadMore();
        }, { rootMargin: '0px 0px 500px 0px' });
        if (!done) observer.observe(loader);
    }
    if (done) {
        button.hidden = true;
        status.textContent = 'Bạn đã xem hết bài đăng.';
    }
})();
