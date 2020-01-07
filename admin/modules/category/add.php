<?php require_once __DIR__ . "/../../../libraries/database.php";
$db = new Database;
?>

<!-- Insert -->
<?php
$id = "";
$ten = "";
$hang = "";
$image = "";
$loai = "";
$gioithieu = "";
$thongtin = "";
$gia = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["idsanpham"])) {
    $id = $_POST["idsanpham"];
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
  $image = $_POST["idsanpham"] . '.jpg';
  if (isset($_POST["gioithieu"])) {
    $gioithieu = $_POST["gioithieu"];
  }
  if (isset($_POST["thongtin"])) {
    $thongtin = $_POST["thongtin"];
  }
  if (isset($_POST['gia'])) {
    $gia = $_POST['gia'];
  }

  //save Anh
  if (isset($_FILES['image'])) {
    $path = "../../../img/";
    move_uploaded_file($_FILES['image']['tmp_name'],$path.$image);
  }

  $ngay = date("Y/m/d");

  $tmp = [$id, $loai, $ten, $hang, $image, $gia, $gioithieu, $thongtin,$ngay];
  $message = $db->insert("sanpham", $tmp);
  $sl = [$id, 0];
  $db->insert("soluongsp", $sl);
} else {
  $message = "";
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
    <li class="breadcrumb-item active">Sản phẩm</li>
    <li class="breadcrumb-item active">Thêm mới sản phẩm</li>
  </ol>

  <div class="card mb-3">
    <div class="card-body">

      <!-- Form thêm sản phẩm -->
      <form method="post" enctype="multipart/form-data">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>ID Sản phẩm</label>
            <input type="text" class="form-control" name='idsanpham' required>
          </div>
          <div class="form-group col-md-6">
            <label>Tên sản phẩm</label>
            <input type="text" class="form-control" name="tensanpham" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Hãng</label>
            <input type="text" class="form-control" name="hangsx">
          </div>
          <div class="form-group col-md-6">
            <label>Loại</label>
            <select name="loai" class="form-control">
              <option value="CT">Côn tay</option>
              <option value="TG">Tay Ga</option>
              <option value="SS">Xe số</option>
              <option value="PKL">Phân khối lớn</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label>Giá tiền</label>
          <input type="text" class="form-control" name="gia">
        </div>
        <div class="form-group">
          <label>Giới thiệu sản phẩm</label>
          <textarea class="form-control" name="gioithieu" rows="3"></textarea>
        </div>
        <div class="form-group">
          <label>Thông tin chi tiết</label>
          <textarea class="form-control" name="thongtin" rows="3"></textarea>
        </div>
        <div class="file-upload-wrapper">
          <input type="file" name="image" class="file-upload" data-height="500" onchange="readURL(this);" />
          <img id="blah" src="#" class="img-thumbnail">
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Thêm</button>
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