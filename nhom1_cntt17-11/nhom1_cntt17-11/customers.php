<?php
require_once 'config.php';
require 'includes/header.php';
$res = $mysqli->query('SELECT * FROM customers ORDER BY id DESC');
?>
<section>
  <h2>Danh sách khách hàng</h2>
  <table class="table">
    <thead><tr><th>ID</th><th>Tên</th><th>Điện thoại</th><th>Email</th></tr></thead>
    <tbody>
    <?php while($r = $res->fetch_assoc()): ?>
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
<?php require 'includes/footer.php'; ?>