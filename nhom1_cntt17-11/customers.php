<?php
require_once 'config.php';
require 'includes/header.php';

// Lấy danh sách khách hàng
$res = $mysqli->query('SELECT * FROM customers ORDER BY id DESC');
?>
<section>
  <h2>👤 Danh sách khách hàng</h2>
  <p>Tổng hợp thông tin các khách hàng đã từng đặt phòng tại resort.</p>
  
  <table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Điện thoại</th>
            <th>Email</th>
            <th>Ngày tham gia</th>
        </tr>
    </thead>
    <tbody>
    <?php while($r = $res->fetch_assoc()): ?>
      <tr>
        <td>#<?=$r['id']?></td>
        <td><strong><?=htmlspecialchars($r['name'])?></strong></td>
        <td><?=htmlspecialchars($r['phone'])?></td>
        <td><?=htmlspecialchars($r['email'])?></td>
        <td><?=date('d/m/Y', strtotime($r['created_at']))?></td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</section>

<?php 
require 'includes/footer.php'; 
?>