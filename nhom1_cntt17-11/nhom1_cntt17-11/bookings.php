<?php
require_once 'config.php';
require 'includes/header.php';
$res = $mysqli->query('SELECT b.*, r.room_name FROM bookings b LEFT JOIN rooms r ON b.room_id = r.id ORDER BY b.id DESC');
?>
<section>
  <h2>Danh sách đặt phòng</h2>
  <p><a class="btn" href="admin/bookings.php">Quản lý đặt phòng (admin)</a></p>
  <table class="table">
    <thead><tr><th>ID</th><th>Khách</th><th>Phòng</th><th>Nhận</th><th>Trả</th><th>Trạng thái</th></tr></thead>
    <tbody>
    <?php while($r = $res->fetch_assoc()): ?>
      <tr>
        <td><?=$r['id']?></td>
        <td><?=htmlspecialchars($r['customer_name'])?><br><?=htmlspecialchars($r['phone'])?></td>
        <td><?=htmlspecialchars($r['room_name'])?></td>
        <td><?=htmlspecialchars($r['check_in'])?></td>
        <td><?=htmlspecialchars($r['check_out'])?></td>
        <td><?=htmlspecialchars($r['status'])?></td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</section>
<?php require 'includes/footer.php'; ?>