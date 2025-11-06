<?php
require_once __DIR__ . '/../config.php';
if (!isset($_SESSION['user']) || !$_SESSION['user']['is_admin']) { header('Location: /quangxuong/index.php'); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['action'])):
    if ($_POST['action'] === 'create') {
        $name = $_POST['room_name']; $type = $_POST['room_type']; $price = (int)$_POST['price']; $status = $_POST['status'];
        $st = $mysqli->prepare('INSERT INTO rooms (room_name, room_type, price, status) VALUES (?,?,?,?)');
        $st->bind_param('sdis', $name, $type, $price, $status); $st->execute();
    } elseif($_POST['action']==='delete' and isset($_POST['id'])) {
        $id=(int)$_POST['id']; $st=$mysqli->prepare('DELETE FROM rooms WHERE id=?'); $st->bind_param('i',$id); $st->execute();
    }
    header('Location: rooms.php'); exit;
endif;
$res = $mysqli->query('SELECT * FROM rooms ORDER BY id DESC');
require_once __DIR__ . '/../includes/header.php';
?>
<section>
  <h2>Quản lý phòng</h2>
  <form method="post" action="rooms.php">
    <input type="hidden" name="action" value="create">
    <div class="form-group"><label>Tên phòng</label><input name="room_name" required></div>
    <div class="form-group"><label>Loại phòng</label><input name="room_type" required></div>
    <div class="form-group"><label>Giá (VND)</label><input name="price" type="number" required></div>
    <div class="form-group"><label>Trạng thái</label><select name="status"><option value="available">available</option><option value="booked">booked</option><option value="maintenance">maintenance</option></select></div>
    <button class="btn" type="submit">Thêm phòng</button>
  </form>
  <hr>
  <table class="table">
    <thead><tr><th>ID</th><th>Tên</th><th>Loại</th><th>Giá</th><th>Trạng thái</th><th>Hành động</th></tr></thead>
    <tbody>
    <?php while($r=$res->fetch_assoc()): ?>
      <tr>
        <td><?=$r['id']?></td>
        <td><?=htmlspecialchars($r['room_name'])?></td>
        <td><?=htmlspecialchars($r['room_type'])?></td>
        <td><?=number_format($r['price'])?></td>
        <td><?=htmlspecialchars($r['status'])?></td>
        <td>
          <form method="post" style="display:inline">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?=$r['id']?>">
            <button class="btn" onclick="return confirm('Xác nhận xóa?')">Xóa</button>
          </form>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>