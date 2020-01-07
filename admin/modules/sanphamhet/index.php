<?php require_once __DIR__ . "/../../../libraries/database.php";
$db = new Database;
$category = $db->fetchAll("soluongsp");
?>
<?php require_once __DIR__ . "/../../layouts/header.php"; ?>
<div id="content-wrapper">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Quản lý</a>
    </li>
    <li class="breadcrumb-item active">Sản phẩm</li>
    <li class="breadcrumb-item active">Số lượng sản phẩm</li>
  </ol>

  <!--Table-->
  <div class="card mb-3">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Tên</th>
              <th>Số lượng</th>
              <th>Sửa</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($category as $item) : ?>
              <?php if($item['Soluong']<=5){?>
              <tr>
                <form action="/Nhom04_WebsiteBanXeMay/admin/modules/category/updatesl.php" method="get">
                <td><input class="form-control" type="text" name="id" value="<?php echo $item['MaSP'] ?>" readonly></td>
                <td><input class="form-control" type="number" value="<?php echo $item['Soluong'] ?>" name="soluong"></td>
                <td>
                  <button type="submit" class="btn btn-secondary">Cập nhật</button>
                </td>
                </form>
              </tr>
            <?php }endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid
<?php require_once __DIR__ . "/../../layouts/footer.php"; ?>