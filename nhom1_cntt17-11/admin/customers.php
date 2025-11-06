<?php
require_once __DIR__ . '/../config.php';
if (!isset($_SESSION['user']) || !$_SESSION['user']['is_admin']) { header('Location: /quangxuong/index.php'); exit; }
$res = $mysqli->query('SELECT * FROM customers ORDER BY id DESC');
require_once __DIR__ . '/../includes/header.php';
?>
<section>
  <h2>Quản lý khách hàng</h2>
  <table class="table">
    <thead><tr><th>ID</th><th>Tên</th><th>Điện thoại</th><th>Email</th></tr></thead>
    <tbody>
    <?php while($r=$res->fetch_assoc()): ?>
      <tr>
        <td><?=$r['id']?></td>
        <td><?=htmlspecialchars($r['name'])?></td>
        <td><?=htmlspecialchars($r['phone'])?></td>
        <td><?=htmlspecialchars($r['email'])?></td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>