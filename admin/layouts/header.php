<?php
session_start();
require_once __DIR__ . "/../../libraries/database.php";
$db = new Database;

//Kiem tra 
if (isset($_SESSION['admin'])) {
  $num = $db->find('quantri', [$_SESSION['admin'], $_SESSION['pass']], ['UserName', 'Password']);
  if ($num == 0)
    header("Location: /Nhom04_WebsiteBanXeMay/admin");
} else {
  header("Location: /Nhom04_WebsiteBanXeMay/");
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

  <title>Quan li</title>

  <!-- Custom fonts for this template-->
  <link href="/Nhom04_WebsiteBanXeMay/public/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="/Nhom04_WebsiteBanXeMay/public/admin/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="/Nhom04_WebsiteBanXeMay/public/admin/css/sb-admin.css" rel="stylesheet">


  <!-- Pusher -->
  <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
  <script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('135cee8f6453c6fc2267', {
      cluster: 'ap1',
      forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      str = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
        '<strong>Có đơn đặt hàng mới </strong><a href="/Nhom04_WebsiteBanXeMay/admin/modules/donhang/chitiet.php?id=' + data['madondh'] + '">Click để xem</a>' +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
        '<span aria-hidden="true">&times;</span>' +
        '</button></div>';
      $('#thongbao').replaceWith(str);
    });
    var channel = pusher.subscribe('my-channel1');
    channel.bind('my-event', function(data) {
      id = (data);

      alert(id["message"]);
    });
  </script>


</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="/Nhom04_WebsiteBanXeMay/admin">Quản lý</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">

      <!-- Chat -->
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="https://dashboard.tawk.to" id="chat" role="button" target="_blank">
          <i class="fas fa-comment"></i>
        </a>
      </li>

      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="/Nhom04_WebsiteBanXeMay/admin/mk.php">Đổi mật khẩu</a>
          <a class="dropdown-item" href="/Nhom04_WebsiteBanXeMay/login.php">Logout</a>
        </div>
      </li>


    </ul>

  </nav>
  <div id="thongbao">

  </div>
  <div id="wrapper">
    <?php @include('menu.php');
    require_once __DIR__ . "/../../libraries/function.php";
    ?>