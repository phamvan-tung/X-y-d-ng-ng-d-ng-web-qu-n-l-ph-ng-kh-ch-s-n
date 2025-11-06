<?php
session_start();
require_once 'config.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $mysqli->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && $password === $user['password']) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'role' => $user['role'],
            // tự thêm dòng này để tiện kiểm tra
            'is_admin' => ($user['role'] === 'admin')
        ];

        header('Location: admin/index.php');
        exit;
    } else {
        $error = 'Sai tên đăng nhập hoặc mật khẩu!';
    }
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quảng Xương Resort - Đăng nhập</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="overlay">
        <header>
            <h1>Quảng Xương Resort</h1>
            <p>Hòn ngọc miền quê Thanh Hóa</p>
        </header>

        <main>
            <h2>Chào mừng đến với Quảng Xương Resort 🌴</h2>
            <p class="desc">Hệ thống quản lý đặt phòng, khách hàng và dịch vụ nghỉ dưỡng – nơi lưu giữ nét thanh bình miền quê Thanh Hóa.</p>
            
            <form method="POST">
                <label>Tên đăng nhập</label>
                <input type="text" name="username" required>

                <label>Mật khẩu</label>
                <input type="password" name="password" required>

                <?php if ($error): ?>
                    <p class="error"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>

                <button type="submit">Đăng nhập</button>
            </form>
        </main>

        <footer>
            © 2025 Quảng Xương Resort · Địa chỉ: Quảng Xương, Thanh Hóa
        </footer>
    </div>
</body>
</html>
