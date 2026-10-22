(function () {
    const pending = new Set();
    const wrappers = key => Array.from(document.querySelectorAll('[data-like-key]')).filter(el => el.dataset.likeKey === key);
    document.addEventListener('click', async function (event) {
        const button = event.target.closest('[data-oss-heart]');
        if (!button) return;
        event.preventDefault();
        const key = button.closest('[data-like-key]').dataset.likeKey;
        if (pending.has(key)) return;
        pending.add(key);
        const desired = button.getAttribute('aria-pressed') !== 'true';
        wrappers(key).forEach(w => {
            const b = w.querySelector('[data-oss-heart]');
            if (b) b.disabled = true;
            w.querySelector('.oss-like-error').textContent = '';
        });
        try {
            const body = new URLSearchParams({action: 'oss_content_like', content_type: button.dataset.contentType, content_id: button.dataset.contentId, nonce: button.dataset.nonce, liked: desired ? '1' : '0'});
            const response = await fetch(ossTopicLikes.ajaxUrl, {method: 'POST', credentials: 'same-origin', body});
            const result = await response.json();
            if (!response.ok || !result.success) throw new Error(result.data?.message || ossTopicLikes.errorMessage);
            wrappers(key).forEach(w => {
                const b = w.querySelector('[data-oss-heart]');
                if (b) {
                    b.setAttribute('aria-pressed', String(result.data.liked));
                    b.setAttribute('aria-label', result.data.liked ? 'Bỏ tim' : 'Thả tim');
                }
                w.querySelector('[data-oss-like-count]').textContent = result.data.formatted_count + ' lượt thích';
            });
            document.dispatchEvent(new CustomEvent('oss-like-updated', {detail: {key, ...result.data}}));
        } catch (error) {
            button.closest('[data-like-key]').querySelector('.oss-like-error').textContent = error.message || ossTopicLikes.errorMessage;
        } finally {
            pending.delete(key);
            wrappers(key).forEach(w => { const b = w.querySelector('[data-oss-heart]'); if (b) b.disabled = false; });
        }
    });
})();
