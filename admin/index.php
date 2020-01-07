<?php
require_once __DIR__ . "/layouts/header.php";

$user = $db->countTable('khachhang', '*') - 1;
$product = $db->countTable('sanpham', '*');
$dondh  = $db->countTable('dondh', '*');

$soluong = $db->fetchAll('soluongsp');
$sp = 0;

foreach($soluong as $item):
  if($item['Soluong']<=5)
    $sp++;
endforeach;
?>
<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Quản lý</a>
      </li>
    </ol>

    <!-- Icon Cards-->
    <div class="row">
      <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-primary o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fas fa-fw fa-comments"></i>
            </div>
            <div class="mr-5"><?php echo $user ?> khách hàng</div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="modules/user/index.php">
            <span class="float-left">Chi tiết</span>
            <span class="float-right">
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-warning o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fas fa-fw fa-list"></i>
            </div>
            <div class="mr-5"><?php echo $product ?> sản phẩm</div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="modules/category/index.php">
            <span class="float-left">Chi tiết</span>
            <span class="float-right">
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-success o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fas fa-fw fa-shopping-cart"></i>
            </div>
            <div class="mr-5"><?php echo $dondh ?> đơn hàng</div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="/Nhom04_WebsiteBanXeMay/admin/modules/donhang">
            <span class="float-left">Chi tiết</span>
            <span class="float-right">
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>

      <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-secondary o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fas fa-fw fa-shopping-cart"></i>
            </div>
            <div class="mr-5"><?php echo $sp ?> sản phẩm sắp hết</div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="/Nhom04_WebsiteBanXeMay/admin/modules/sanphamhet">
            <span class="float-left">Chi tiết</span>
            <span class="float-right">
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>

    </div>
  </div>
  <div class="alert alert-success" role="alert">
    <h1 class="alert-heading">WELCOME!</h1>
    <hr>
    <p class="mb-0">Đây là trang quản lý</p>
  </div>
</div>
<!-- /.container-fluid -->
<?php require_once __DIR__ . "/layouts/footer.php" ?>