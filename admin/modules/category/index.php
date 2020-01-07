<?php require_once __DIR__ . "/../../../libraries/database.php";
$db = new Database;
$category = $db->fetchAll("sanpham");
?>
<?php require_once __DIR__ . "/../../layouts/header.php"; ?>
<div id="content-wrapper">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Quản lý</a>
    </li>
    <li class="breadcrumb-item active">Danh sách sản phẩm</li>
  </ol>

  <!--Table-->
  <div class="card mb-3">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Tên</th>
              <th>Loại Xe</th>
              <th>Ảnh</th>
              <th>Hãng</th>
              <th>Giá</th>
              <th>Sửa, Xóa</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($category as $item) : ?>
              <tr>
                <td><?php echo $item['MaSp'] ?></td>
                <td><?php echo $item['TenSP'] ?></td>
                <td><?php echo $db->fetchIDOne("loaisp", "TenLoai", "MaLoai", $item['MaLoai'])['TenLoai'] ?></td>
                <td><img id="blah" src="/Nhom04_WebsiteBanXeMay/img/<?php echo $item['Anh']?>" class="img-rounded" style="width:10%;height:auto;"></td>
                <td><?php echo $item['HangSX'] ?></td>
                <td><?php echo $item['Gia'] ?></td>
                <td>
                  <a class="btn btn-primary" href="/Nhom04_WebsiteBanXeMay/admin/modules/category/edit.php?id=<?php echo $item['MaSp']; ?>"><i class="fa fa-edit"></i>Sửa</a>
                  <a class="btn btn-danger" href="/Nhom04_WebsiteBanXeMay/admin/modules/category/delete.php?id=<?php echo $item['MaSp']; ?>"><i class="fa fa-times"></i>Xóa</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid
<?php require_once __DIR__ . "/../../layouts/footer.php"; ?>