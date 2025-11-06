Quảng Xương Resort - Hệ thống quản lý khách sạn (Tiếng Việt)
------------------------------------------------------------------

Hướng dẫn nhanh:
1. Giải nén thư mục `quangxuong_resort` vào `C:/xampp/htdocs/quangxuong`.
2. Mở phpMyAdmin hoặc MySQL Workbench, import file `database.sql`.
3. Kiểm tra `config.php` nếu cần thay đổi DB_USER / DB_PASS.
4. Truy cập: http://localhost/quangxuong/

Tài khoản quản trị mặc định:
- Username: admin
- Password: admin

Các file chính:
- index.php (Đăng nhập)
- home.php (Trang chủ)
- admin/ (Dashboard và các trang quản lý)
- includes/ (header, footer)
- assets/images (ảnh minh họa dạng SVG)
- database.sql (tạo DB và seed dữ liệu)
