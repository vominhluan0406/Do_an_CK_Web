<?php
session_start();
if (isset($_SESSION['user'])) {
  header("Location: /Nhom04_WebsiteBanXeMay/index.php");
  unset($_SESSION['user']);
}
if (isset($_SESSION['admin'])){
  unset($_SESSION['admin']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Đăng nhập</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Đăng nhập</div>
      <div class="card-body">
        <form method="POST" action="/Nhom04_WebsiteBanXeMay/public/customer/dangnhap.php">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="user" id="inputEmail" class="form-control" placeholder="Email address" required>
              <label for="inputEmail">Tài khoản</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
              <label for="inputPassword">Mật khẩu</label>
            </div>
          </div>
          <div class="col text-center">
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline1" name="type" class="custom-control-input" required value="kh">
              <label class="custom-control-label" for="customRadioInline1">Người dùng</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline2" name="type" class="custom-control-input" value="admin">
              <label class="custom-control-label" for="customRadioInline2">Quản trị viên</label>
            </div>
          </div>
          <button class="btn btn-primary btn-block">Đăng nhập</button>
        </form>
        <?php
        if (isset($_SESSION['dangnhap'])) {
          echo '<div class="alert alert-danger" role="alert">';
          echo $_SESSION['dangnhap'];
          echo '</div>';
          unset($_SESSION['dangnhap']);
        }
        ?>
        <div class="text-center">
          <a class="d-block small mt-3" href="register.html">Đăng ký tài khoản</a>
          <a class="d-block small" href="forgot-password.html">Quên mật khẩu</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>