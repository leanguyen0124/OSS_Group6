# Đối chiếu yêu cầu UniForum với BuddyPress và bbPress

Nguồn yêu cầu: tài liệu “TASK 3 — Functional Requirements cho website diễn đàn”, gồm FR-01 đến FR-28 và các user flow ở mục 6-12. Bản đối chiếu này đã được điều chỉnh theo quyết định mới: **không có vai trò Moderator; nhiều Admin cùng chịu trách nhiệm kiểm duyệt nội dung và quản lý người dùng vi phạm**.

## Quy ước

- **Có sẵn**: plugin cung cấp luồng và dữ liệu cốt lõi; chủ yếu cần cấu hình/giao diện.
- **Một phần**: có nền tảng hoặc một nửa luồng, nhưng vẫn phải viết tích hợp/nghiệp vụ.
- **Không có**: nên xây trong plugin riêng, không đặt vào `functions.php` của theme.
- **Loại bỏ/gộp**: ID cũ được giữ để truy vết tài liệu gốc nhưng không còn là requirement độc lập.
- **WP**: WordPress core; **BP**: BuddyPress; **bbP**: bbPress.

## Mô hình quyền sau điều chỉnh

- **Member**: sử dụng hồ sơ, forum, group, notification, message, point/badge và gửi report.
- **Admin**: có toàn bộ quyền kiểm duyệt trên mọi forum/group, xử lý report, khóa người dùng, quản lý rule và xem toàn bộ audit log.
- Không còn phân công moderator theo community/forum và không còn dashboard/lịch sử riêng cho Moderator.
- Về kỹ thuật, nên tạo role `uniforum_admin` với đúng các capability nghiệp vụ thay vì cấp WordPress `Administrator` cho tất cả người kiểm duyệt. Chỉ người thực sự cần quản lý plugin/theme/cấu hình hệ thống mới nên có `manage_options`.

## Bảng đối chiếu requirements sau khi đơn giản hóa quyền

Bảng chỉ hiển thị **26 requirement có hiệu lực**. Hai requirement cũ dành riêng cho Moderator đã được loại khỏi bảng: FR-21 được gộp vào FR-26 (Admin block/restrict user), còn FR-22 được gộp vào FR-27 (Admin audit log). ID gốc được giữ cho các requirement còn lại để dễ đối chiếu với PDF.

| ID | Requirement sau điều chỉnh | BuddyPress sẵn có | bbPress sẵn có | Mức đáp ứng tổng thể | Functions planning |
|---|---|---|---|---|---|
| FR-01 | Đăng ký, email activation, trạng thái Pending/Active | **Có sẵn**: signup, activation và hồ sơ mở rộng | Không phụ trách | **Có sẵn** với BP + WP | Dùng UI/flow BP. Chỉ thêm `uf_validate_signup_fields()` qua validation hook để kiểm tra chính sách mật khẩu/tên; chạy tác vụ sau kích hoạt trên `bp_core_activated_user`. Không tự viết lại `wp_create_user()` hay cơ chế activation. |
| FR-02 | Đăng nhập bằng email/username + password | Dùng xác thực WP | Không phụ trách | **Có sẵn** | Dùng `wp_signon()`/form đăng nhập WP-BP. Nếu cần redirect, lọc `login_redirect` trong `uf_login_redirect()`; không lưu session/token riêng. |
| FR-03 | Tên, avatar, bio, social links, tag quan tâm, điểm và lịch sử điểm | **Có sẵn** tên/avatar và Extended Profile | Chỉ hiển thị thông tin forum profile cơ bản | **Một phần** | Tạo social links/tag quan tâm bằng xProfile; cập nhật bằng `xprofile_set_field_data()`. Viết `uf_get_user_points()` và `uf_get_point_history()`; chèn tab “Điểm” vào member navigation. Không lưu lịch sử điểm trong một chuỗi `user_meta`. |
| FR-04 | Browse Forum/Topic; Newest/Hot; visibility | Không phải chức năng chính | **Có sẵn** directory, topic list, visibility và thứ tự mới nhất; không có công thức “Hot” theo yêu cầu | **Một phần** | Đăng ký view `hot` bằng `bbp_register_view()`. Viết `uf_hot_score()` dựa trên reply/view/recency; cache ID bằng transient và xóa cache ở `bbp_new_topic`, `bbp_new_reply`. Luôn để bbP kiểm tra `read_forum`. |
| FR-05 | Tạo/sửa/xóa Topic, tags, lưu nháp, nonce/sanitize | Không phụ trách | **Có sẵn** CRUD, tags, status, nonce, sanitize; front-end draft theo sản phẩm chưa hoàn chỉnh | **Một phần** | Dùng form/handler bbP thay vì chèn post trực tiếp. Nếu cần “Lưu nháp”, viết `uf_save_topic_draft()` qua REST/AJAX có nonce, `current_user_can( 'publish_topics' )`, sanitize và `wp_insert_post( post_status=draft )`; khi publish gọi API bbP để đồng bộ meta/count. |
| FR-06 | Reply vào topic mở; trả lời/quote reply khác | Không phụ trách | **Có sẵn** reply, kiểm tra topic/forum, reply-to khi threaded replies bật; quote nguyên văn không phải luồng lõi | **Một phần** | Bật threaded replies. Dùng `bbp_new_reply` cho sự kiện sau lưu. Nếu cần quote, `uf_quote_reply()` chỉ lấy nội dung user được phép đọc, giới hạn độ dài, escape output và truyền `bbp_reply_to`; không sao chép HTML thô từ request. |
| FR-07 | Subscribe Topic/Forum và nhận notification | BP có kho notification nhưng không tự nối sự kiện subscribe bbP | **Có sẵn** subscribe Topic/Forum và email notification | **Một phần** | Giữ subscription bằng `bbp_add_user_subscription()`. Viết bridge `uf_notify_subscribers_on_topic()`/`uf_notify_subscribers_on_reply()` ở `bbp_new_topic`/`bbp_new_reply`, gọi `bp_notifications_add_notification()` và loại người tạo sự kiện khỏi recipients. |
| FR-08 | Favorite Topic | Không cần | **Có sẵn** favorite và danh sách favorite trong profile | **Có sẵn** | Dùng `bbp_add_user_favorite()`/UI bbP. Chỉ thêm `uf_favorite_audit()` nếu sản phẩm thực sự cần analytics; không tạo bảng bookmark thứ hai. |
| FR-09 | In-app notification cho reply, mention, badge; unread +1 | **Có sẵn** notification, unread counter, mention/message/group events; chưa có sự kiện bbP/badge tùy biến | bbP subscription chủ yếu gửi email | **Một phần** | Tạo component/action riêng `uniforum` (`new_reply`, `badge_awarded`, `warning`). Viết `uf_add_notification_once()` bọc `bp_notifications_add_notification()` và khóa chống trùng theo user + action + item IDs. Viết formatter để trả URL topic/reply/badge. |
| FR-10 | Đọc notification, mark read, redirect đúng object | **Có sẵn** read/unread/delete và counter | Cung cấp permalink topic/reply | **Có sẵn / cần bridge URL** | Dùng API BP để mark read, ví dụ `bp_notifications_mark_notifications_by_item_id()`. Formatter custom phải kiểm tra object còn tồn tại/quyền đọc trước khi trả `bbp_get_topic_permalink()` hoặc URL reply. |
| FR-11 | Tự cộng Points, không reward trùng, có transaction history | Không có point engine | Không có point engine; có hook sự kiện | **Không có** | Viết service `uf_award_points( $user_id, $event, $object_id, $points )`. Lưu bảng `wp_uf_point_transactions` với unique key `(user_id,event,object_id)`; cập nhật tổng điểm trong cùng transaction/critical section. Gắn `bbp_new_topic`, `bbp_new_reply`, sự kiện accepted answer; có hàm reverse khi spam/trash. |
| FR-12 | Trao Badge theo rule, không trao trùng, gửi notification | Không có rule/badge engine; có profile + notifications | Không có | **Không có** | Tạo `uf_evaluate_badges( $user_id, $event )`, bảng rule/badge và bảng user-badge có unique `(user_id,badge_id)`. Gọi sau khi cộng điểm; khi insert thành công mới tạo BP notification. Nếu dùng GamiPress thì chỉ viết adapter, không xây engine thứ hai. |
| FR-13 | Report Topic/Reply kèm lý do, trạng thái OPEN | Không có report cho bbP content | Có spam/trash moderation nhưng không có report workflow của member | **Không có** | Thêm nút qua `bbp_theme_after_topic_content` và `bbp_theme_after_reply_content`. Handler `uf_submit_report()` phải có nonce, login, `read_post`, reason allow-list và unique open report theo reporter/target. Lưu bảng `wp_uf_reports`, không dùng comment thường. |
| FR-14 | Search Topic/Forum/Member theo keyword | **Có sẵn** member search | **Có sẵn** forum-wide search cho forum/topic/reply | **Một phần** | Giữ hai query engine riêng và viết `uf_unified_search()` để hợp nhất DTO kết quả. Thêm filter forum/tag/time bằng query args/tax query; member dùng `BP_User_Query`. Không ghép một câu SQL lớn qua mọi bảng trong MVP. |
| FR-15 | Member tạo/tham gia Group theo Forum | **Có sẵn** public/private/hidden groups, join/request/invite và group roles | Có tích hợp Group Forums khi cả hai plugin hoạt động | **Có sẵn / cần quy ước ánh xạ** | Chọn quan hệ **1 BP Group : 1 bbP Forum**. Dùng `groups_create_group()`, `groups_join_group()` và Group Forums; `uf_get_group_forum_id()` là một nơi duy nhất đọc mapping. Không sử dụng vai trò Group Moderator trong luồng sản phẩm. |
| FR-16 | Private Message và notification riêng | **Có sẵn** inbox/sent/thread, unread count, notification/email | Không phụ trách | **Có sẵn** | Dùng `messages_new_message()` và `messages_get_unread_count()`. Chỉ thêm policy `uf_can_message_user()` (blocked users/privacy/rate limit); không lưu message bằng post/comment. |
| FR-17 | Admin Dashboard: xem tất cả report OPEN, filter theo forum/group/trạng thái | BP không có report dashboard | bbP có moderation capability nhưng không có report queue | **Không có** | Tạo screen dùng `uf_get_reports( $filters )`; quyền truy cập là `manage_uniforum_moderation`. Query toàn site, có pagination/filter và không cần logic “forum được phân công”. |
| FR-18 | Admin xử lý report: dismiss/warn/close/trash/spam; RESOLVED/REJECTED; ghi audit | BP có thể gửi notification cảnh báo | **Có sẵn** primitive close/trash/spam, không có report state/audit | **Một phần** | `uf_resolve_report( $report_id, $action, $note )`: khóa report OPEN, kiểm tra `manage_uniforum_moderation`, resolve target từ server, gọi API bbP tương ứng, ghi audit rồi đổi trạng thái. |
| FR-19 | Admin Close/Pin Topic | Không phụ trách | **Có sẵn** close/open và sticky/super-sticky | **Có sẵn** | `uf_admin_update_topic_state()` kiểm tra `manage_uniforum_moderation`, gọi `bbp_close_topic()`/`bbp_stick_topic()` và ghi audit. Không update status/meta trực tiếp. |
| FR-20 | Admin sửa/xóa nội dung người khác; ghi audit | BP có quản lý activity/group ở cấp admin | **Có sẵn** edit/delete others; không có audit nghiệp vụ hợp nhất | **Một phần** | `uf_admin_moderate_content()` kiểm tra capability Admin toàn site rồi gọi API WP/bbP; các hook edit/trash/spam gọi `uf_log_moderation_action()`. Không cần `map_meta_cap` theo từng forum/group. |
| FR-23 | Gán/thu hồi vai trò Member/Admin | BP member type không nên dùng làm capability | bbP có roles/capabilities, nhưng không nên dùng bbP Moderator trong mô hình mới | **Một phần** | `uf_register_admin_role()` đăng ký role `uniforum_admin`; `uf_set_account_role( $user_id, $role )` chỉ nhận `member`/`uniforum_admin`, bảo vệ tài khoản hiện tại và Site Owner. Chỉ cấp WP `Administrator` khi người đó thật sự cần quyền hệ thống. |
| FR-24 | Quản lý Forum và bật/tắt component/plugin settings | **Có sẵn** component/settings admin | **Có sẵn** Forums/Topics/Replies/settings admin | **Có sẵn** | Chủ yếu cấu hình. Nếu cần trang hợp nhất, dùng Settings API trong `uf_register_settings()` và lưu option có schema/version; không gọi deactivate plugin từ front-end. |
| FR-25 | Admin cấu hình points/badge rules | Không có | Không có | **Không có** | Tạo CRUD rule có capability `manage_uniforum_rules`, validate event từ allow-list và số điểm/range. `uf_save_reward_rule()` tăng `rules_version`; `uf_evaluate_badges()` chỉ đọc rule active. Có preview/dry-run trước khi áp dụng hồi tố. |
| FR-26 | Admin block/restrict tạm thời hoặc vĩnh viễn toàn tài khoản | BP không có site-wide account ban chuẩn | bbP **Blocked** chỉ chặn capability diễn đàn, không chặn login/toàn BP | **Không có** | `uf_block_user( $user_id, $until, $reason )`, `uf_unblock_user()` và `uf_unblock_expired_users()`: kiểm tra `manage_uniforum_users`, hủy active sessions, chặn login/hành động, bảo vệ Site Owner/chính mình và ghi audit. |
| FR-27 | Admin xem toàn bộ Moderation Log, filter theo Admin/forum/action/time | Không có audit hợp nhất | Không có | **Không có** | `uf_query_moderation_logs( $filters )` dùng prepared query, pagination và filter whitelist; chỉ capability `view_uniforum_audit_log`. Có filter theo actor để mỗi Admin tự kiểm tra lịch sử của mình. |
| FR-28 | Admin tạo/xóa/quản lý Group và forum liên kết | **Có sẵn** quản lý group; BP vẫn có group roles nội bộ | Group Forums có thể gắn forum vào group | **Có sẵn** | `uf_admin_manage_group()` bọc `groups_create_group()`/`groups_delete_group()` để validation, audit và đồng bộ forum mapping. Không cung cấp chức năng gán Group Moderator trong UI sản phẩm. |

## Các yêu cầu ẩn trong user flow nhưng chưa có FR riêng

| Yêu cầu trong flow | Hiện trạng | Recommendation |
|---|---|---|
| Đánh dấu “câu trả lời chính xác/accepted answer” | BP và bbP core không có Q&A accepted answer | `uf_accept_reply( $topic_id, $reply_id )`: chỉ topic author hoặc Admin được gọi; nonce + kiểm tra reply thuộc topic; lưu `_uf_accepted_reply_id`; phát event duy nhất để cộng điểm/badge/notification và hỗ trợ undo/reverse. |
| Quên mật khẩu có giới hạn số lần gửi | WP có reset password, nhưng rate-limit theo yêu cầu cần gia cố | Giữ flow WP; thêm `uf_allow_password_reset_request()` dùng transient theo normalized account/IP, trả lỗi chung để tránh dò email. |
| Trending 24 giờ/7 ngày | Không có công thức thống nhất trong core | Tính score có time decay từ reply/activity/view; cache riêng theo window; invalidation theo event và refresh định kỳ. |
| Trừ điểm khi xử phạt | Không có point ledger | Không sửa trực tiếp tổng điểm. Ghi transaction âm liên kết `moderation_log_id`; unique key chống trừ lặp và transaction bù khi rollback quyết định. |

## Kiến trúc custom plugin đề xuất

Không nên đặt các nghiệp vụ trên vào theme `functions.php`, vì đổi theme sẽ làm mất logic và rất khó kiểm thử. Nên tạo một plugin `uniforum-core` với cấu trúc tối thiểu:

```text
uniforum-core/
├── uniforum-core.php
├── includes/
│   ├── class-uf-points-service.php
│   ├── class-uf-badge-service.php
│   ├── class-uf-notification-bridge.php
│   ├── class-uf-report-service.php
│   ├── class-uf-moderation-service.php
│   ├── class-uf-access-control.php
│   └── class-uf-search-service.php
├── admin/
│   ├── class-uf-reports-screen.php
│   └── class-uf-rules-screen.php
└── templates/
```

Các bảng riêng phù hợp hơn `post_meta`/`user_meta` cho dữ liệu tăng nhanh và cần truy vấn:

| Bảng | Mục đích | Khóa chống trùng/tra cứu quan trọng |
|---|---|---|
| `wp_uf_point_transactions` | Ledger cộng/trừ điểm | unique `(user_id, event_key, object_id)`; index `(user_id, created_at)` |
| `wp_uf_user_badges` | Badge đã cấp | unique `(user_id, badge_id)` |
| `wp_uf_reports` | Report workflow | index `(status, forum_id, created_at)`; chống nhiều report OPEN cùng reporter/target |
| `wp_uf_moderation_log` | Audit bất biến | index `(actor_id, created_at)`, `(forum_id, created_at)` |
| `wp_uf_restrictions` | Block/restriction tài khoản có thời hạn | index `(user_id, status, expires_at)` |

## Functions planning theo subsystem

| Subsystem | Functions chính cần lập kế hoạch | Hook/API nền | Trách nhiệm |
|---|---|---|---|
| Account & profile | `uf_validate_signup_fields()`, `uf_login_redirect()`, `uf_get_user_points()`, `uf_get_point_history()` | BP signup/activation, xProfile, WP authentication | Validation bổ sung, redirect và dữ liệu điểm trên hồ sơ; không thay thế authentication/activation core. |
| Forum discovery | `uf_hot_score()`, `uf_register_hot_view()`, `uf_invalidate_hot_cache()` | `bbp_register_view`, `bbp_new_topic`, `bbp_new_reply` | Xếp hạng Hot/Trending và quản lý cache. |
| Topic/reply extensions | `uf_save_topic_draft()`, `uf_quote_reply()`, `uf_accept_reply()` | bbP form handlers, topic/reply APIs | Draft front-end, quote an toàn và accepted answer. |
| Notification bridge | `uf_notify_subscribers_on_topic()`, `uf_notify_subscribers_on_reply()`, `uf_add_notification_once()`, `uf_format_notification()` | `bbp_new_topic`, `bbp_new_reply`, BP Notifications API | Nối event bbP/badge/moderation vào in-app notification, chống trùng và tạo URL hợp lệ. |
| Gamification | `uf_award_points()`, `uf_reverse_points()`, `uf_evaluate_badges()`, `uf_refresh_leaderboard()` | Event bbP + accepted answer + moderation | Ledger idempotent, badge rules, hoàn tác điểm và leaderboard cache. |
| Reports | `uf_submit_report()`, `uf_get_reports()`, `uf_resolve_report()` | bbP template hooks + moderation APIs | Tạo queue OPEN, dashboard toàn site cho Admin và state transition có kiểm soát. |
| Admin moderation | `uf_admin_update_topic_state()`, `uf_admin_moderate_content()`, `uf_log_moderation_action()` | bbP close/stick/spam, WP edit/trash hooks | Thực hiện action toàn site, luôn kiểm tra capability Admin và ghi audit. |
| Admin account control | `uf_register_admin_role()`, `uf_set_account_role()`, `uf_block_user()`, `uf_unblock_user()`, `uf_unblock_expired_users()` | WP roles/capabilities, authentication/session hooks, cron | Quản lý Member/Admin, khóa tài khoản có thời hạn và hủy session. |
| Audit | `uf_query_moderation_logs()` | Custom log table | Filter theo Admin/forum/action/time, pagination và kiểm soát quyền xem. |
| Search | `uf_unified_search()` | bbP search + `BP_User_Query` | Hợp nhất kết quả forum/topic/member và filter forum/tag/time. |
| Group integration | `uf_get_group_forum_id()`, `uf_admin_manage_group()` | BP Groups API + bbP Group Forums | Mapping 1:1, quản lý group/forum và audit; không có moderator assignment. |
| Settings/rules | `uf_register_settings()`, `uf_save_reward_rule()` | WP Settings API | Cấu hình component, points và badge rules có validation/version. |

## Thứ tự triển khai khuyến nghị

1. **MVP lõi**: FR-01 đến FR-10, FR-14 đến FR-16, FR-19, FR-24, FR-28 bằng cấu hình core + notification bridge.
2. **Trust & safety trước khi public launch**: FR-13, FR-17, FR-18, FR-20, FR-23, FR-26, FR-27; FR-21 và FR-22 không triển khai riêng.
3. **Engagement**: FR-11, FR-12, FR-25, accepted answer, leaderboard và trending.
4. **Hardening**: test capability Admin, chống tự khóa/Site Owner bị khóa, chống event trùng, rate limit, cron expiry, rollback reward và kiểm tra quyền đọc notification target.

## Kết luận

BuddyPress + bbPress đáp ứng tốt nền tảng tài khoản, hồ sơ, group, activity/message, forum/topic/reply, favorite/subscription và thao tác moderation cơ bản. Sau khi bỏ Moderator, phần quyền hạn đơn giản hơn đáng kể: Admin có phạm vi toàn site và không cần mapping người kiểm duyệt theo community. Phần cần custom chính còn lại là **gamification**, **notification bridge**, **report + audit workflow**, và **block/restriction tài khoản**. Các phần này nên là module độc lập trong `uniforum-core`, với API/hook của BP/bbP ở biên và dữ liệu nghiệp vụ riêng ở bên trong.

## Nguồn kiểm chứng chính

- BuddyPress official: [Profiles](https://buddypress.org/about/profiles/), [Notifications](https://buddypress.org/about/notifications/), [Groups](https://buddypress.org/about/groups/), [Private Messaging](https://buddypress.org/about/private-messaging/) và [Components and Features](https://codex.buddypress.org/buddypress-components-and-features/).
- bbPress official: [Forum Settings](https://codex.bbpress.org/getting-started/configuring-bbpress/forum-settings/), [Creating Content](https://codex.bbpress.org/getting-started/configuring-bbpress/creating-content/), [User Roles and Capabilities](https://codex.bbpress.org/getting-started/before-installing/bbpress-user-roles-and-capabilities/), [Subscriptions](https://codex.bbpress.org/features/subscriptions/) và [Favorites](https://codex.bbpress.org/features/favorites/).
- API BuddyPress được đối chiếu trực tiếp trong checkout hiện tại: signup/activation, xProfile, notifications, groups, messages và activity. API/hook bbPress được đối chiếu với source chính thức nhánh `trunk`, đặc biệt `bbp_new_topic` và `bbp_new_reply`.

Kết quả “Có sẵn” giả định các component tương ứng đã được bật và theme tương thích. Trước khi code production cần chốt phiên bản WordPress/BuddyPress/bbPress thực tế rồi chạy integration test trên đúng bộ phiên bản đó.
