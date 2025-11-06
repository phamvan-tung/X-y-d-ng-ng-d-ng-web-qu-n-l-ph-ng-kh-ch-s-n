<?php
require_once 'config.php';
session_start();

// Nếu chưa đăng nhập → quay lại trang login
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

// Nếu là admin → chuyển hướng sang admin dashboard
if ($_SESSION['user']['role'] === 'admin') {
    header('Location: admin/index.php');
    exit;
}

require_once 'includes/header.php';
?>

<section class="hero">
  <div class="hero-text">
    <h2>Xin chào, <?= htmlspecialchars($_SESSION['user']['username']) ?> 👋</h2>
    <p>Chào mừng bạn đến với hệ thống quản lý Quảng Xương Resort.</p>
    <p>Chọn chức năng bên dưới để tiếp tục.</p>
  </div>
  <div style="flex:0 0 380px;">
    <img src="/quangxuong/assets/images/banner.svg" alt="banner" style="width:100%;border-radius:8px">
  </div>
</section>

<section class="cards">
  <div class="card">
    <h3>Phòng đã đặt</h3>
    <p>Xem danh sách và tình trạng phòng mà bạn đã đặt.</p>
    <a class="btn" href="my_bookings.php">Xem</a>
  </div>
  <div class="card">
    <h3>Đặt phòng mới</h3>
    <p>Chọn phòng và gửi yêu cầu đặt phòng trực tuyến.</p>
    <a class="btn" href="booking_form.php">Đặt phòng</a>
  </div>
  <div class="card">
    <h3>Thông tin cá nhân</h3>
    <p>Cập nhật tên, liên hệ và mật khẩu của bạn.</p>
    <a class="btn" href="profile.php">Cập nhật</a>
  </div>
  <div class="card">
    <h3>Đăng xuất</h3>
    <p>Thoát khỏi hệ thống an toàn.</p>
    <a class="btn" href="logout.php">Đăng xuất</a>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>
