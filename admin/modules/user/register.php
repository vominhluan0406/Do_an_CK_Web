<?php require_once __DIR__ . "/../../../libraries/database.php";
$db = new Database;
?>

<!-- Insert -->
<?php
$id = "";
$ten = "";
$username = "";
$email = "";
$cmnd = "";
$sdt = "";
$diachi = "";
$password ="";

$nameErr="";

// Check giá trị nhập vào
if($_SERVER["REQUEST_METHOD"] == "POST"){

  //MaKH
  if (empty($_POST["id"])) {
    $nameErr = "Mã khách hàng không được để trống";
  } else {
    $name = $_POST["name"];
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }

  // UserName

}


?>
<!-- /Insert -->

<?php require_once __DIR__ . "/../../layouts/header.php"; ?>

<!--  -->
<div id="content-wrapper">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Quản lý</a>
    </li>
    <li class="breadcrumb-item active">Người dùng</li>
    <li class="breadcrumb-item active">Thêm người dùng</li>
  </ol>

  <div class="card mb-3">
    <div class="card-body">

      <!-- Form thêm khách hàng -->
      <form method="post" action="register.php">
      <div class="form-group">
          <label>Mã khách hàng</label>
          <input type="text" class="form-control" name="hovaten" rows="3" require>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Tài khoản</label>
            <input type="text" class="form-control" name='user' require >
          </div>
          <div class="form-group col-md-6">
            <label>Mật khẩu</label>
            <input type="password" class="form-control" name="password" require >
          </div>
        </div>
        <div class="form-group">
          <label>Họ và Tên</label>
          <input type="text" class="form-control" name="hovaten" rows="3" require>
          <label>Email</label>
          <input type="text" class="form-control" name="email" rows="3">
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>CMND</label>
            <input type="text" class="form-control" name="cmnd">
          </div>
          <div class="form-group col-md-6">
            <label>Số điện thoại</label>
            <input type="text" class="form-control" name="sdt">
          </div>
        </div>
        <div class="form-group">
          <label>Địa chỉ</label>
          <textarea class="form-control" name="diachi" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Cập nhật</button>
      </form>
    </div>
  </div>
  <?php require_once __DIR__ . "/../../layouts/footer.php" ?>