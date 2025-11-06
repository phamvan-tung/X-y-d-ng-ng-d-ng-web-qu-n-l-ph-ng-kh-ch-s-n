<?php
require_once __DIR__ . '/../config.php';
if (!isset($_SESSION['user']) || !$_SESSION['user']['is_admin']) { header('Location: /quangxuong/index.php'); exit; }
if ($_SERVER['REQUEST_METHOD']==='POST' and isset($_POST['action'])) {
    if ($_POST['action']==='create') {
        $username=$_POST['username']; $password=$_POST['password']; $role=$_POST['role'];
        $st=$mysqli->prepare('INSERT INTO staff (username,password,role) VALUES (?,?,?)');
        $st->bind_param('sss',$username,$password,$role); $st->execute();
    }
    header('Location: staff.php'); exit;
}
$res=$mysqli->query('SELECT id,username,role,created_at FROM staff ORDER BY id DESC');
require_once __DIR__ . '/../includes/header.php';
?>
<section>
  <h2>Quản lý nhân viên</h2>
  <form method="post" action="staff.php">
    <input type="hidden" name="action" value="create">
    <div class="form-group"><label>Tên tài khoản</label><input name="username" required></div>
    <div class="form-group"><label>Mật khẩu</label><input name="password" required></div>
    <div class="form-group"><label>Role</label><select name="role"><option value="admin">admin</option><option value="staff">staff</option></select></div>
    <button class="btn" type="submit">Thêm nhân viên</button>
  </form>
  <hr>
  <table class="table">
    <thead><tr><th>ID</th><th>Tên</th><th>Role</th><th>Ngày tạo</th></tr></thead>
    <tbody>
    <?php while($r=$res->fetch_assoc()): ?>
      <tr><td><?=$r['id']?></td><td><?=htmlspecialchars($r['username'])?></td><td><?=htmlspecialchars($r['role'])?></td><td><?=htmlspecialchars($r['created_at'])?></td></tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>