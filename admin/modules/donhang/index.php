<?php
require_once __DIR__ . "/../../layouts/header.php";
require_once __DIR__ . "/../../../libraries/database.php";

$db = new Database;

$donhang = $db->fetchAll('dondh');

?>



<div id="content-wrapper">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Đơn hàng</li>
  </ol>

  <!-- Table data -->
  <div class="card mb-3">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Người mua</th>
              <th>Ngày mua</th>
              <th>Chi tiết</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($donhang as $item) : ?>
              <tr>
                <td><?php echo $item['MaDonDH'] ?></td>
                <td><?php echo $item['UserName'] ?></td>
                <td><?php echo $item['Ngay'] ?></td>
                <td>
                  <a href="/Nhom04_WebsiteBanXeMay/admin/modules/donhang/chitiet.php?id=<?php echo $item['MaDonDH'] ?>" class="btn btn-info">Chi tiết</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- /Table data -->

<?php require_once __DIR__ . "/../../layouts/footer.php" ?>