<?php
session_start();
require_once 'config.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // Kiểm tra người dùng
    $stmt = $mysqli->prepare("SELECT id, username, password, role FROM staff WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Dùng mật khẩu plain 'admin' cho tài khoản seed (theo database.sql)
    if ($user && $password === $user['password']) {
        // Lưu session
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'role' => $user['role'],
            'is_admin' => ($user['role'] === 'admin')
        ];
        
        // Chuyển hướng đến home.php (đã cập nhật)
        header('Location: home.php'); 
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="overlay">
        <header>
            <h1>Quảng Xương Resort</h1>
            <p>Hệ thống Quản lý Du lịch & Nghỉ dưỡng</p>
        </header>

        <main>
            <h2>Đăng nhập Hệ thống</h2>
            <p class="desc">Vui lòng sử dụng tài khoản được cung cấp để truy cập vào Dashboard quản trị.</p>
            
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
             &copy; <?= date('Y') ?> Quảng Xương Resort.
        </footer>
    </div>
</body>
</html>