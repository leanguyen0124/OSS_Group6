document.addEventListener('click', async function (event) {
	const button = event.target.closest('[data-oss-topic-like]');
	if (!button || button.disabled) return;

	const desiredState = button.getAttribute('aria-pressed') !== 'true';
	const formData = new URLSearchParams();
	formData.set('action', 'oss_topic_like');
	formData.set('topic_id', button.dataset.topicId);
	formData.set('nonce', button.dataset.nonce);
	formData.set('liked', desiredState ? '1' : '0');
	button.disabled = true;

	try {
		const response = await fetch(ossTopicLikes.ajaxUrl, {
			method: 'POST',
			credentials: 'same-origin',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
			},
			body: formData.toString()
		});

		const result = await response.json();

		if (!response.ok || !result.success) {
			throw new Error(
				(result.data && result.data.message) ||
				ossTopicLikes.errorMessage
			);
		}

		button.setAttribute('aria-pressed', String(result.data.liked));
		button.setAttribute(
			'aria-label',
			result.data.liked ? 'Bỏ thích chủ đề' : 'Thích chủ đề'
		);
		button.classList.toggle('is-liked', result.data.liked);
		button.querySelector('.oss-topic-like-heart').textContent =
			result.data.liked ? '♥' : '♡';
		button.querySelector('[data-oss-topic-like-count]').textContent =
			new Intl.NumberFormat().format(result.data.count);
	} catch (error) {
		const status = button.parentElement.querySelector(
			'[data-oss-topic-like-status]'
		);
		if (status) {
			status.textContent = error.message || ossTopicLikes.errorMessage;
		}
	} finally {
		button.disabled = false;
	}
});