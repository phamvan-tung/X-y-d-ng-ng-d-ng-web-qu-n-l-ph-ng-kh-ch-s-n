<?php
require_once __DIR__ . '/../config.php';
if (!isset($_SESSION['user']) || !$_SESSION['user']['is_admin']) { header('Location: /quangxuong/index.php'); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['action']) and isset($_POST['id'])) {
    $id=(int)$_POST['id'];
    if ($_POST['action']==='update_status' and isset($_POST['status'])) {
        $st=$mysqli->prepare('UPDATE bookings SET status=? WHERE id=?'); $st->bind_param('si',$_POST['status'],$id); $st->execute();
    }
    header('Location: bookings.php'); exit;
}
$res = $mysqli->query('SELECT b.*, r.room_name FROM bookings b LEFT JOIN rooms r ON b.room_id=r.id ORDER BY b.id DESC');
require_once __DIR__ . '/../includes/header.php';
?>
<section>
  <h2>Quản lý đặt phòng</h2>
  <table class="table">
    <thead><tr><th>ID</th><th>Khách</th><th>Phòng</th><th>Nhận</th><th>Trả</th><th>Trạng thái</th><th>Hành động</th></tr></thead>
    <tbody>
    <?php while($r=$res->fetch_assoc()): ?>
      <tr>
        <td><?=$r['id']?></td>
        <td><?=htmlspecialchars($r['customer_name'])?><br><?=htmlspecialchars($r['phone'])?></td>
        <td><?=htmlspecialchars($r['room_name'])?></td>
        <td><?=htmlspecialchars($r['check_in'])?></td>
        <td><?=htmlspecialchars($r['check_out'])?></td>
        <td><?=htmlspecialchars($r['status'])?></td>
        <td>
          <form method="post" style="display:inline">
            <input type="hidden" name="id" value="<?=$r['id']?>">
            <select name="status"><option value="pending">pending</option><option value="confirmed">confirmed</option><option value="checked_in">checked_in</option><option value="checked_out">checked_out</option><option value="cancelled">cancelled</option></select>
            <input type="hidden" name="action" value="update_status">
            <button class="btn" type="submit">Cập nhật</button>
          </form>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>