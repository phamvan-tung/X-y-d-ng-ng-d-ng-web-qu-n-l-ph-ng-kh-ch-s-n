<?php
require_once 'config.php';
require 'includes/header.php';
$res = $mysqli->query('SELECT * FROM rooms ORDER BY id DESC');
?>
<section>
  <h2>Danh sách phòng</h2>
  <p><a class="btn" href="admin/rooms.php">Quản lý phòng (admin)</a></p>
  <table class="table">
    <thead><tr><th>ID</th><th>Phòng</th><th>Loại</th><th>Giá (VND)</th><th>Trạng thái</th></tr></thead>
    <tbody>
    <?php while($r = $res->fetch_assoc()): ?>
      <tr>
        <td><?=$r['id']?></td>
        <td><?=htmlspecialchars($r['room_name'])?></td>
        <td><?=htmlspecialchars($r['room_type'])?></td>
        <td><?=number_format($r['price'])?></td>
        <td><?=htmlspecialchars($r['status'])?></td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</section>
<?php require 'includes/footer.php'; ?>