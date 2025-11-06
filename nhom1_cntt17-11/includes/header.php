<?php
// Bắt buộc phải có config để lấy session
require_once 'config.php'; 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Báo lỗi nếu chưa đăng nhập 
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$current_page = basename($_SERVER['PHP_SELF']);
$is_admin = $_SESSION['user']['role'] === 'admin';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quảng Xương Resort - Quản lý</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <h1>Quảng Xương Resort</h1>
        <ul class="nav-links">
            <li class="<?= $current_page === 'home.php' ? 'active' : '' ?>">
                <a href="home.php">Trang chủ</a>
            </li>
            <li class="<?= $current_page === 'rooms.php' ? 'active' : '' ?>">
                <a href="rooms.php">Phòng</a>
            </li>
            <li class="<?= $current_page === 'bookings.php' ? 'active' : '' ?>">
                <a href="bookings.php">Đặt phòng</a>
            </li>
            <li class="<?= $current_page === 'customers.php' ? 'active' : '' ?>">
                <a href="customers.php">Khách hàng</a>
            </li>
            <?php if ($is_admin): ?>
            <li>
                <a href="admin/index.php" style="font-weight: 700;">Quản trị</a>
            </li>
            <?php endif; ?>
        </ul>
        <div class="nav-links">
            <span class="user-info">Xin chào, <?= htmlspecialchars($_SESSION['user']['username']) ?></span>
            <a class="btn" href="logout.php" style="background-color:#dc3545; box-shadow:none; padding: 8px 15px;">Đăng xuất</a>
        </div>
    </nav>
    <main>