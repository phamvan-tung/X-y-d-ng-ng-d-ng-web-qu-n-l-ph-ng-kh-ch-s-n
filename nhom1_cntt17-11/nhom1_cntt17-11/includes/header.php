<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Quảng Xương Resort - Quản lý</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/quangxuong/assets/style.css">
</head>
<body>
<header class="site-header">
  <div class="container header-inner">
    <div class="brand">
      <img src="/quangxuong/assets/images/logo.svg" alt="Quảng Xương Resort" class="logo">
      <div>
        <h1>Quảng Xương Resort</h1>
        <p class="tagline">Hòn ngọc miền quê Thanh Hóa</p>
      </div>
    </div>
    <nav class="main-nav">
      <a href="/quangxuong/home.php">Trang chủ</a>
      <a href="/quangxuong/rooms.php">Phòng</a>
      <a href="/quangxuong/bookings.php">Đặt phòng</a>
      <a href="/quangxuong/customers.php">Khách hàng</a>
      <?php if($user): ?>
        <span class="greet">Xin chào, <?=htmlspecialchars($user['username'])?></span>
        <a href="/quangxuong/logout.php">Đăng xuất</a>
      <?php else: ?>
        <a href="/quangxuong/index.php">Đăng nhập</a>
      <?php endif; ?>
    </nav>
  </div>
</header>
<main class="container">