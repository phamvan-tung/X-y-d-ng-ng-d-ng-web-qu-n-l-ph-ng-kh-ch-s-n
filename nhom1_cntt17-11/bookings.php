<?php
require_once 'config.php';
require 'includes/header.php'; 

// Lấy danh sách đặt phòng
$res = $mysqli->query('SELECT b.*, r.room_name FROM bookings b LEFT JOIN rooms r ON b.room_id = r.id ORDER BY b.id DESC');
?>
<section>
  <h2>🧾 Danh sách đặt phòng</h2>
  <p>Tổng hợp các đơn đặt phòng của khách hàng, bao gồm trạng thái đang chờ, đã xác nhận và đã hoàn thành.</p>
  <p><a class="btn" href="admin/bookings.php" style="background-color: var(--color-primary);">Quản lý đặt phòng (Admin)</a></p>
  
  <table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Khách hàng</th>
            <th>Phòng đặt</th>
            <th>Nhận phòng</th>
            <th>Trả phòng</th>
            <th>Trạng thái</th>
            <th>Ngày tạo</th>
        </tr>
    </thead>
    <tbody>
    <?php while($r = $res->fetch_assoc()): ?>
      <tr>
        <td>#<?=$r['id']?></td>
        <td>
            <strong><?=htmlspecialchars($r['customer_name'])?></strong><br>
            <small style="color:#777;"><?=htmlspecialchars($r['phone'])?></small>
        </td>
        <td><?=htmlspecialchars($r['room_name']) ?: '<span style="color:#dc3545; font-style:italic;">[Đã xóa phòng]</span>'?></td>
        <td><?=date('d/m/Y', strtotime($r['check_in']))?></td>
        <td><?=date('d/m/Y', strtotime($r['check_out']))?></td>
        <td>
            <?php $status_class = strtolower(htmlspecialchars($r['status'])); ?>
            <span class="status-badge <?= $status_class ?>">
                <?= ucfirst($status_class) ?>
            </span>
        </td>
        <td><?=date('d/m/Y H:i', strtotime($r['created_at']))?></td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</section>

<?php 
require 'includes/footer.php'; 
?>