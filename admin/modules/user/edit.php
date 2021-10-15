<?php require_once __DIR__ . "/../../../libraries/database.php";
$db = new Database;
if (isset($_GET['id']))
  $user = $db->fetchIDOne('khachhang', '*', 'MaKH', $_GET['id']);
if(!$user){
  header("Location: /admin/modules/user");
}
?>

<!-- Update -->
<?php
$id = "";
$ten = "";
$username = "";
$email = "";
$cmnd = "";
$sdt = "";
$diachi = "";
$message = "";

if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['id'])){
    $id=$_POST['id'];
  }
  if(isset($_POST['user'])){
    $username=$_POST['user'];
  }
  if(isset($_POST['hovaten'])){
    $ten=$_POST['hovaten'];
  }
  if(isset($_POST['email'])){
    $email=$_POST['email'];
  }
  if(isset($_POST['cmnd'])){
    $cmnd=$_POST['cmnd'];
  }
  if(isset($_POST['sdt'])){
    $sdt=$_POST['sdt'];
  }
  if(isset($_POST['diachi'])){
    $diachi=$_POST['diachi'];
  }
  $key =['MaKH','HoTen','UserName','Email','CMND','SDT','DiaChi'];
  $value = [$id,$ten,$username,$email,$cmnd,$sdt,$diachi];
  $db->update('khachhang',$value,$key,'MaKH',$id);
  
  header("Location: /admin/modules/user");
}

?>
<?php require_once __DIR__ . "/../../layouts/header.php"; ?>

<!--  -->
<div id="content-wrapper">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Quản lý</a>
    </li>
    <li class="breadcrumb-item active">Người dùng</li>
    <li class="breadcrumb-item active">Sửa thông tin</li>
  </ol>

  <div class="card mb-3">
    <div class="card-body">

      <!-- Form thêm sản phẩm -->
      <form method="post">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Mã Khách Hàng</label>
            <input type="text" class="form-control" name='id' readonly value="<?php echo $user['MaKH'] ?>">
          </div>
          <div class="form-group col-md-6">
            <label>Tài khoản</label>
            <input type="text" class="form-control" name="user" readonly value="<?php echo $user['UserName'] ?>">
          </div>
        </div>
        <div class="form-group">
          <label>Họ và Tên</label>
          <input type="text" class="form-control" name="hovaten" rows="3" value="<?php echo $user['HoTen'] ?>" require>
          <label>Email</label>
          <input type="text" class="form-control" name="email" rows="3" value="<?php echo $user['Email'] ?>">
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>CMND</label>
            <input type="text" class="form-control" name="cmnd" value="<?php echo $user['CMND'] ?>">
          </div>
          <div class="form-group col-md-6">
            <label>Số điện thoại</label>
            <input type="text" class="form-control" name="sdt" value="<?php echo $user['SDT'] ?>">
          </div>
        </div>
        <div class="form-group">
          <label>Địa chỉ</label>
          <textarea class="form-control" name="diachi" rows="3"><?php echo $user['DiaChi'] ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Cập nhật</button>
      </form>
    </div>
  </div>
  <?php require_once __DIR__ . "/../../layouts/footer.php" ?>