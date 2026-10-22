(function () {
    document.addEventListener('click', function (event) {
        const trigger = event.target.closest('[data-dialog-open]');
        if (trigger) {
            const dialog = document.getElementById(trigger.dataset.dialogOpen);
            if (dialog && !dialog.open) dialog.showModal();
        }
        if (event.target.matches('dialog.oss-help-dialog')) {
            const bounds = event.target.getBoundingClientRect();
            if (event.clientX < bounds.left || event.clientX > bounds.right || event.clientY < bounds.top || event.clientY > bounds.bottom) event.target.close();
        }
    });
    const coverInput = document.getElementById('oss-forum-cover');
    if (coverInput) {
        const picker = coverInput.closest('.oss-forum-cover-picker');
        const preview = picker.querySelector('.oss-cover-preview');
        const image = preview.querySelector('img');
        const status = picker.querySelector('[role="status"]');
        let previewUrl;
        const clearPreview = () => {
            if (previewUrl) URL.revokeObjectURL(previewUrl);
            previewUrl = null;
            image.removeAttribute('src');
            preview.hidden = true;
        };
        coverInput.addEventListener('change', () => {
            clearPreview();
            status.textContent = '';
            coverInput.setCustomValidity('');
            const file = coverInput.files[0];
            if (!file) return;
            if (file.type !== 'image/png' || file.size > 5 * 1024 * 1024) {
                status.textContent = file.size > 5 * 1024 * 1024 ? 'Ảnh không được lớn hơn 5 MB.' : 'Vui lòng chọn ảnh PNG.';
                coverInput.value = '';
                return;
            }
            previewUrl = URL.createObjectURL(file);
            image.src = previewUrl;
            preview.hidden = false;
            status.textContent = 'Đã chọn: ' + file.name;
        });
        image.addEventListener('error', () => {
            clearPreview();
            coverInput.value = '';
            status.textContent = 'Không đọc được ảnh. Hãy chọn một ảnh PNG khác.';
        });
        picker.querySelector('.oss-cover-remove').addEventListener('click', () => {
            clearPreview();
            coverInput.value = '';
            status.textContent = 'Đã bỏ ảnh. Diễn đàn sẽ dùng ảnh mặc định.';
            coverInput.focus();
        });
    }
})();
