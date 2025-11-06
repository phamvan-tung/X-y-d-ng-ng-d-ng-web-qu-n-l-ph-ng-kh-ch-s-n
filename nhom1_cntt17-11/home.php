<?php
require_once 'config.php';
if (!isset($_SESSION['user'])) { header('Location: index.php'); exit; }
require 'includes/header.php';

// 1. Lấy tổng số phòng
$total_rooms_res = $mysqli->query('SELECT COUNT(*) AS total FROM rooms');
$total_rooms = $total_rooms_res->fetch_assoc()['total'];

// 2. Lấy số phòng đang trống
$available_rooms_res = $mysqli->query("SELECT COUNT(*) AS available FROM rooms WHERE status = 'available'");
$available_rooms = $available_rooms_res->fetch_assoc()['available'];

// 3. Lấy tổng số đặt phòng (chưa xử lý hoặc đang diễn ra)
$total_bookings_res = $mysqli->query("SELECT COUNT(*) AS total FROM bookings WHERE status IN ('pending', 'confirmed')");
$total_bookings = $total_bookings_res->fetch_assoc()['total'];

// 4. Lấy tổng số khách hàng
$total_customers_res = $mysqli->query('SELECT COUNT(*) AS total FROM customers');
$total_customers = $total_customers_res->fetch_assoc()['total'];
?>
<section class="hero">
  <div class="hero-text">
    <h2>Chào mừng trở lại, <?=htmlspecialchars($_SESSION['user']['username'])?> 👋</h2>
    <p>Trang tổng quan hệ thống quản lý Quảng Xương Resort. Theo dõi các chỉ số quan trọng bên dưới.</p>
  </div>
  <div style="flex:0 0 300px; text-align:right;">
    <img src="assets/images/banner.svg" alt="banner" style="width:100%;"> 
  </div>
</section>

<section>
    <h3>📈 Thống kê chính</h3>
    <div class="cards dashboard-stats">
        <div class="card" style="border-left: 5px solid #17a2b8;">
            <h3 style="color:#17a2b8;"><?= $total_bookings ?></h3>
            <p>Đơn đặt phòng đang xử lý</p>
            <a class="btn" href="bookings.php" style="background-color:#17a2b8;">Chi tiết</a>
        </div>
        <div class="card" style="border-left: 5px solid #28a745;">
            <h3 style="color:#28a745;"><?= $available_rooms ?></h3>
            <p>Phòng còn trống</p>
            <a class="btn" href="rooms.php?status=available" style="background-color:#28a745;">Xem phòng</a>
        </div>
        <div class="card" style="border-left: 5px solid #fd7e14;">
            <h3 style="color:#fd7e14;"><?= $total_rooms ?></h3>
            <p>Tổng số phòng</p>
            <a class="btn" href="rooms.php" style="background-color:#fd7e14;">Quản lý</a>
        </div>
        <div class="card" style="border-left: 5px solid #6c757d;">
            <h3 style="color:#6c757d;"><?= $total_customers ?></h3>
            <p>Tổng số khách hàng</p>
            <a class="btn" href="customers.php" style="background-color:#6c757d;">Xem danh sách</a>
        </div>
    </div>
</section>

<section>
    <h3>📋 Các chức năng chính</h3>
    <div class="cards">
      <div class="card">
        <h3>Quản lý phòng</h3>
        <p>Thêm, sửa, xóa phòng và cập nhật trạng thái.</p>
        <a class="btn" href="rooms.php">Mở chức năng</a>
      </div>
      <div class="card">
        <h3>Quản lý đặt phòng</h3>
        <p>Xem và xử lý các đặt phòng mới, xác nhận hoặc hủy đơn.</p>
        <a class="btn" href="bookings.php">Mở chức năng</a>
      </div>
      <div class="card">
        <h3>Quản lý khách hàng</h3>
        <p>Quản lý thông tin và lịch sử đặt phòng của khách.</p>
        <a class="btn" href="customers.php">Mở chức năng</a>
      </div>
      <?php if ($_SESSION['user']['role'] === 'admin'): ?>
      <div class="card">
        <h3>Quản lý nhân viên</h3>
        <p>Quản lý tài khoản, phân quyền quản trị (chỉ Admin).</p>
        <a class="btn" href="admin/index.php" style="background-color: var(--color-primary);">Mở chức năng</a>
      </div>
      <?php endif; ?>
    </div>
</section>

<?php require 'includes/footer.php'; ?>