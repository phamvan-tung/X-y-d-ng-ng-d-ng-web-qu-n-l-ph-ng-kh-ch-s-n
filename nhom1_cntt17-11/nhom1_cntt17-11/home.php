<?php
require_once 'config.php';
if (!isset($_SESSION['user'])) { header('Location: index.php'); exit; }
require 'includes/header.php';
?>
<section class="hero">
  <div class="hero-text">
    <h2>Xin chào, <?=htmlspecialchars($_SESSION['user']['username'])?></h2>
    <p>Trang tổng quan Quảng Xương Resort. Chọn chức năng quản lý bên trên.</p>
  </div>
  <div style="flex:0 0 380px;">
    <img src="/quangxuong/assets/images/banner.svg" alt="banner" style="width:100%;border-radius:8px">
  </div>
</section>

<section class="cards">
  <div class="card">
    <h3>Quản lý phòng</h3>
    <p>Thêm / Sửa / Xóa phòng, cập nhật trạng thái.</p>
    <a class="btn" href="rooms.php">Mở</a>
  </div>
  <div class="card">
    <h3>Quản lý đặt phòng</h3>
    <p>Xem và xử lý các đặt phòng của khách.</p>
    <a class="btn" href="bookings.php">Mở</a>
  </div>
  <div class="card">
    <h3>Quản lý khách hàng</h3>
    <p>Danh sách khách đã đặt phòng và thông tin liên hệ.</p>
    <a class="btn" href="customers.php">Mở</a>
  </div>
  <div class="card">
    <h3>Quản lý nhân viên</h3>
    <p>Danh sách tài khoản quản trị.</p>
    <a class="btn" href="admin/index.php">Mở</a>
  </div>
</section>

<?php require 'includes/footer.php'; ?>