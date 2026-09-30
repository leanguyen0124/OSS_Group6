# Chạy website WordPress local với Docker và wp-env

Tài liệu này hướng dẫn chạy Bado Blog, BuddyPress và bbPress trong môi trường local bằng Docker. Các lệnh bên dưới được viết cho macOS/Linux và chạy từ thư mục gốc của dự án.

## 1. Cài phần mềm cần thiết

Cài các phần mềm sau:

- [Docker Desktop](https://www.docker.com/products/docker-desktop/)
- [Node.js LTS](https://nodejs.org/)
- npm (đi kèm Node.js)

Mở Docker Desktop và kiểm tra:

```bash
docker --version
node --version
npm --version
```

Cài `wp-env`:

```bash
npm install --global @wordpress/env
wp-env --version
```

Nếu không muốn cài toàn cục, có thể thay `wp-env` trong tài liệu bằng `npx @wordpress/env`.

## 2. Khởi động website

Đi tới thư mục dự án được clone về:

Ví du
```bash
cd /Users/macbook/Documents/VSC/OSS
```

Đảm bảo Docker Desktop đang chạy, sau đó khởi động:

```bash
wp-env start
```

Khi thấy dòng `WordPress development site started`, mở:

```text
http://localhost:8890
```

Môi trường hiện tại tự động:

- mount theme `bado-blog` và `bado-blog-child`;
- mount và kích hoạt BuddyPress;
- cài và kích hoạt bbPress;
- kích hoạt theme Bado Blog Child;
- kích hoạt OSS Community Rewards;
- bật debug nhưng ghi lỗi vào log thay vì hiển thị trên giao diện.

Màu, khung trang và header theo giao diện cộng đồng nằm trong
`bado-blog-child/assets/css/community-theme.css`. Theme con nạp tệp này sau CSS
Customizer của Bado Blog để các chỉnh sửa vẫn có hiệu lực.

Thông tin đăng nhập mặc định của `wp-env`:

```text
Username: admin
Password: password
Email: wordpress@example.com
```

Dừng website:

```bash
wp-env stop
```

Sau khi thay đổi `.wp-env.json` hoặc gặp trạng thái container cũ:

```bash
wp-env stop && wp-env start
```

## 3. Cài Mailpit để kiểm thử email local

Mailpit là hộp thư giả lập. Nó nhận email từ WordPress và hiển thị trên máy local, không gửi email ra Gmail/Outlook thật.

Tạo và chạy container Mailpit:

```bash
docker run -d \
  --name mailpit \
  --restart unless-stopped \
  -p 8025:8025 \
  -p 1025:1025 \
  axllent/mailpit
```

Nếu container đã tồn tại:

```bash
docker start mailpit
```

Kiểm tra container:

```bash
docker ps | grep mailpit
```

Mở giao diện Mailpit tại:

```text
http://localhost:8025
```

## 4. Cài và cấu hình plugin gửi email

Cài WP Mail SMTP bằng WP-CLI:

```bash
wp-env run cli wp plugin install wp-mail-smtp --activate
```

Kết nối WordPress trong Docker với Mailpit trên máy Mac bằng lệnh:

```bash
wp-env run cli wp wp-mail-smtp setup --force \
  --mail.from_email=wordpress@example.com \
  --mail.from_name=OSS \
  --mail.mailer=smtp \
  --mail.return_path=true \
  --mail.from_email_force=true \
  --smtp.host=host.docker.internal \
  --smtp.port=1025 \
  --smtp.encryption=none \
  --smtp.autotls=false \
  --smtp.auth=false
```

Gửi email kiểm tra:

```bash
wp-env run cli wp wp-mail-smtp test test@example.com
```

Nếu lệnh báo `Success: Test email sent`, mở `http://localhost:8025` để xem email.

## 5. Kiểm thử email activation của BuddyPress

1. Đăng xuất khỏi WordPress.
2. Mở trang đăng ký thành viên BuddyPress.
3. Đăng ký bằng bất kỳ địa chỉ email nào, ví dụ `your-email@gmail.com`.
4. Mở `http://localhost:8025`.
5. Mở email `Activate your account`.
6. Bấm link `Activate`.

Email sẽ xuất hiện trong Mailpit dù địa chỉ người nhận là Gmail. Email không được gửi tới Gmail thật vì Mailpit chỉ dùng cho local.

Nội dung email activation có thể chỉnh trong:

```text
WordPress Admin → Emails → Activate your account
```

Không xóa biến sau khỏi nội dung email:

```text
{{{activate.url}}}
```

Đây là link kích hoạt tài khoản.

## 6. Các lệnh kiểm tra hữu ích

Điểm, huy hiệu và bảng xếp hạng hiển thị trên các trang dùng shortcode
`[oss_reward_profile]` và `[oss_leaderboard]`. Plugin không tự thêm các khối này
vào trang chủ hoặc diễn đàn. Điểm chỉ phát sinh khi thành viên đăng chủ đề hoặc
trả lời sau khi plugin hoạt động; nội dung cũ không được tính lại tự động.

Giao diện, menu, bài viết, diễn đàn, widget, logo và thiết lập Customize nằm trong
database WordPress. Chỉ chạy lại mã nguồn không khôi phục các mục này từ một site
khác; cần nhập bản sao database và thư mục uploads của site đó.

Xem trạng thái môi trường:

```bash
wp-env status
```

Xem plugin đang hoạt động:

```bash
wp-env run cli wp plugin list
```

Xem theme đang hoạt động:

```bash
wp-env run cli wp theme list --status=active
```

Xem toàn bộ bảng database:

```bash
wp-env run cli wp db tables --all-tables-with-prefix
```

Xem log WordPress:

```bash
wp-env run cli tail -n 50 /var/www/html/wp-content/debug.log
```

Xem log Mailpit:

```bash
docker logs -f mailpit
```

## 7. Xử lý lỗi thường gặp

### `ERR_CONNECTION_REFUSED` ở `localhost:8890`

Docker hoặc container WordPress chưa sẵn sàng. Chạy:

```bash
docker ps
wp-env status
wp-env start
```

Đợi đến khi `wp-env start` hoàn tất rồi tải lại trang.

### `The 'buddypress' plugin could not be found`

Container cũ có thể đang giữ mount từ cấu hình trước. Chạy:

```bash
wp-env stop && wp-env start
```

### Email không xuất hiện trong Mailpit

Kiểm tra lần lượt:

```bash
docker ps | grep mailpit
wp-env run cli wp wp-mail-smtp test test@example.com
```

Đảm bảo SMTP host là `host.docker.internal` và port là `1025`.

### Notice vẫn xuất hiện trong terminal

WP-CLI có thể in Notice ra terminal dù `WP_DEBUG_DISPLAY=false`. Website vẫn không hiển thị Notice; nội dung được ghi vào `wp-content/debug.log`.

## 8. Dọn dẹp

Dừng Mailpit:

```bash
docker stop mailpit
```

Dừng WordPress:

```bash
wp-env stop
```

Không dùng `wp-env reset` hoặc `wp-env destroy` nếu chưa muốn xóa database local.
