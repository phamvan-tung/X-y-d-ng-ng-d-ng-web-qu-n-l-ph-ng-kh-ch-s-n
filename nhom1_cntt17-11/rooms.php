<?php
require_once 'config.php';
require 'includes/header.php';

// Lấy danh sách phòng
$res = $mysqli->query('SELECT * FROM rooms ORDER BY id DESC');
?>
<section>
  <h2>🔑 Danh sách phòng</h2>
  <p>Tổng hợp các phòng trong resort, bao gồm loại phòng, giá và trạng thái hiện tại.</p>
  <p><a class="btn" href="admin/rooms.php" style="background-color: var(--color-primary);">Quản lý phòng (Admin)</a></p>
  
  <table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên phòng</th>
            <th>Loại phòng</th>
            <th>Giá/Đêm (VND)</th>
            <th>Trạng thái</th>
            <th>Ngày tạo</th>
        </tr>
    </thead>
    <tbody>
    <?php while($r = $res->fetch_assoc()): ?>
      <tr>
        <td>#<?=$r['id']?></td>
        <td><strong><?=htmlspecialchars($r['room_name'])?></strong></td>
        <td><?=htmlspecialchars($r['room_type'])?></td>
        <td><?=number_format($r['price'])?></td>
        <td>
            <?php $status_class = strtolower(htmlspecialchars($r['status'])); ?>
            <span class="status-badge <?= $status_class ?>">
                <?= ucfirst($status_class) ?>
            </span>
        </td>
        <td><?=date('d/m/Y', strtotime($r['created_at']))?></td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</section>

<?php 
require 'includes/footer.php'; 
?>