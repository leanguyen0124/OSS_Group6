<?php
/** Front-end member forum form. The plugin owns permission and insertion logic. */
defined( 'ABSPATH' ) || exit;
if ( ! oss_member_can_create_forum() ) { return; }
$errors = array( 'title' => 'Nhập tên diễn đàn hợp lệ, tối đa ' . bbp_get_title_max_length() . ' ký tự.', 'duplicate' => 'Tên diễn đàn đã tồn tại. Hãy chọn tên khác.', 'flood' => 'Bạn vừa đăng nội dung. Hãy đợi một chút rồi thử lại.', 'save' => 'Chưa thể tạo diễn đàn. Hãy thử lại.', 'cover_type' => 'Ảnh cover cần là tệp PNG hợp lệ.', 'cover_size' => 'Ảnh cover không được lớn hơn 5 MB.', 'cover_upload' => 'Chưa thể tải ảnh cover. Hãy chọn lại ảnh và thử lại.' );
$error = sanitize_key( wp_unslash( $_GET['oss_forum_error'] ?? '' ) );
?>
<form id="oss-create-forum" class="oss-create-forum" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" enctype="multipart/form-data">
    <h2>Tạo diễn đàn mới</h2><p>Tạo một không gian chung để mọi người mở chủ đề và thảo luận.</p>
    <?php if ( isset( $errors[ $error ] ) ) : ?><p class="oss-forum-error" role="alert"><?php echo esc_html( $errors[ $error ] ); ?></p><?php endif; ?>
    <input type="hidden" name="action" value="oss_create_forum">
    <?php wp_nonce_field( 'oss-create-forum', 'oss_forum_nonce' ); ?>
    <label for="oss-forum-title">Tên diễn đàn <span aria-hidden="true">*</span></label>
    <input id="oss-forum-title" type="text" name="oss_forum_title" required maxlength="<?php echo (int) bbp_get_title_max_length(); ?>" placeholder="Ví dụ: Góc chia sẻ kinh nghiệm">
    <label for="oss-forum-content">Giới thiệu diễn đàn</label>
    <textarea id="oss-forum-content" name="oss_forum_content" rows="4" placeholder="Mọi người có thể thảo luận về điều gì ở đây?"></textarea>
    <label for="oss-forum-cover">Ảnh cover diễn đàn</label>
    <div class="oss-forum-cover-picker">
        <input id="oss-forum-cover" type="file" name="oss_forum_cover" accept="image/png,.png" aria-describedby="oss-cover-help oss-cover-status">
        <p id="oss-cover-help">Ảnh PNG, tối đa 5 MB. Nên dùng ảnh ngang. Bỏ trống để dùng ảnh mặc định.</p>
        <p id="oss-cover-status" role="status" aria-live="polite"></p>
        <div class="oss-cover-preview" hidden><img alt="Xem trước ảnh cover diễn đàn"><button type="button" class="oss-cover-remove">Bỏ ảnh đã chọn</button></div>
    </div>
    <p class="oss-forum-visibility-note">Diễn đàn mới hiển thị công khai để mọi người cùng tham gia.</p>
    <button class="oss-forum-action" type="submit">Tạo diễn đàn</button>
</form>
