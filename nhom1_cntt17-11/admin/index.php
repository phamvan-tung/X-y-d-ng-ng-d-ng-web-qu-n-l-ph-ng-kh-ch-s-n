<?php
session_start();
require_once __DIR__ . '/../config.php';

// Kiểm tra đăng nhập và quyền admin
if (!isset($_SESSION['user']) || !$_SESSION['user']['is_admin']) {
    header('Location: ../login.php');
    exit;
}

// Nếu vượt qua kiểm tra thì hiển thị giao diện admin
require_once __DIR__ . '/../includes/header.php';
?>

<section class="cards">
  <div class="card"><h3>Quản lý phòng</h3><p>Thêm, sửa, xóa phòng</p><a class="btn" href="rooms.php">Mở</a></div>
  <div class="card"><h3>Quản lý đặt phòng</h3><p>Xử lý đặt phòng</p><a class="btn" href="bookings.php">Mở</a></div>
  <div class="card"><h3>Quản lý khách hàng</h3><p>Danh sách khách</p><a class="btn" href="customers.php">Mở</a></div>
  <div class="card"><h3>Quản lý nhân viên</h3><p>Danh sách tài khoản</p><a class="btn" href="staff.php">Mở</a></div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
