<?php
require_once __DIR__ . "/../../../libraries/database.php";

$db = new Database;
$category = $db->fetchIDOne('sanpham', '*', 'MaSp', $_GET['id']);

$message = "";

if (!$category) {
  header("Location: /Nhom04_WebsiteBanXeMay/admin/modules/category");
}
?>

<!-- Update -->
<?php
$id = $ten = $hang = $image = $loai = $gioithieu = $thongtin = $gia = "";
$iderr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["idsanpham"])) {
    $id = $_POST["idsanpham"];
  }
  if (isset($_POST["gia"])) {
    $gia = $_POST["gia"];
  }
  if (isset($_POST["tensanpham"])) {
    $ten = $_POST["tensanpham"];
  }
  if (isset($_POST["loai"])) {
    $loai = $_POST["loai"];
  }
  if (isset($_POST["hangsx"])) {
    $hang = $_POST["hangsx"];
  }
  $image = $id . '.jpg';
  if (isset($_POST["gioithieu"])) {
    $gioithieu = $_POST["gioithieu"];
  }
  if (isset($_POST["thongtin"])) {
    $thongtin = $_POST["thongtin"];
  }

  //save Anh
  if (isset($_FILES['image'])) {
    $path = "../../../img/";
    move_uploaded_file($_FILES['image']['tmp_name'], $path . $image);
  }

  $key = ['MaLoai', 'TenSP', 'HangSX', 'Anh', 'Gia', 'GioiThieu', 'ThongTin'];
  $data = [$loai, $ten, $hang, $image, $gia, $gioithieu, $thongtin];
  $message = $db->update("sanpham", $data, $key, 'MaSp', $id);
  header("Location: /Nhom04_WebsiteBanXeMay/admin/modules/category");
}
?>

<?php require_once __DIR__ . "/../../layouts/header.php"; ?>

<!--  -->
<div id="content-wrapper">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Quản lý</a>
    </li>
    <li class="breadcrumb-item active">Sản phẩm</li>
    <li class="breadcrumb-item active">Sửa sản phẩm</li>
  </ol>

  <div class="card mb-3">
    <div class="card-body">

      <!-- Form thêm sản phẩm -->
      <form method="post" enctype="multipart/form-data">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>ID Sản phẩm</label>
            <input type="text" class="form-control" name='idsanpham' readonly value="<?php echo  $category['MaSp']; ?>">
          </div>
          <div class="form-group col-md-6">
            <label>Tên sản phẩm</label>
            <input type="text" class="form-control" name="tensanpham" required value="<?php echo  $category['TenSP']; ?>">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Hãng</label>
            <input type="text" class="form-control" name="hangsx" value="<?php echo  $category['HangSX']; ?>">
          </div>
          <div class="form-group col-md-6">
            <label>Loại</label>
            <select name="loai" class="form-control" required>
              <option <?php if($category['MaLoai']=='CT') echo 'selected' ?> value="CT">Côn tay</option>
              <option <?php if($category['MaLoai']=='TG') echo 'selected' ?> value="TG">Tay Ga</option>
              <option <?php if($category['MaLoai']=='SS') echo 'selected' ?> value="SS">Xe số</option>
              <option <?php if($category['MaLoai']=='PKL') echo 'selected' ?> value="PKL">Phân khối lớn</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label>Giá tiền</label>
          <input type="text" class="form-control" name="gia" value="<?php echo $category['Gia'] ?>">
        </div>
        <div class="form-group">
          <label>Giới thiệu sản phẩm</label>
          <textarea class="form-control" name="gioithieu" rows="3"><?php echo  $category['GioiThieu']; ?></textarea>
        </div>
        <div class="form-group">
          <label>Thông tin chi tiết</label>
          <textarea class="form-control" name="thongtin" rows="3"><?php echo  $category['ThongTin']; ?></textarea>
        </div>
        <div class="file-upload-wrapper">
          <input type="file" name="image" class="file-upload" data-height="500" onchange="readURL(this);" />
          <img id="blah" style="width:20%" src="/Nhom04_WebsiteBanXeMay/img/<?php echo $category['Anh'] ?>" class="img-thumbnail">
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Cập nhật</button>
        <div class="alert alert-success" role="alert">
          <p class="mb-0"><?php echo $message ?></p>
        </div>
      </form>
    </div>
  </div>

  <!-- Upload ảnh và hiển thị -->
  <script>
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#blah')
            .attr('src', e.target.result)
            .width(150)
            .height(200);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
  <?php require_once __DIR__ . "/../../layouts/footer.php" ?>