<?php
require_once __DIR__ . "/../../../libraries/database.php";

$db = new Database;
$category = $db->fetchIDOne('anh_slide', '*', 'STT', $_GET['id']);

$message = "";

if (!$category) {
    header("Location: /Nhom04_WebsiteBanXeMay/admin/modules/trangchu");
}
?>

<!-- Update -->
<?php
$id  = $image = $loai = $thongtin = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["idsanpham"])) {
        $id = $_POST["idsanpham"];
    }
    if (isset($_POST["loai"])) {
        $loai = $_POST["loai"];
    }
    $image = 'slide'.$id . '.png';
    if (isset($_POST["thongtin"])) {
        $thongtin = $_POST["thongtin"];
    }

    //save Anh
    if (isset($_FILES['image'])) {
        $path = "../../../img/";
        move_uploaded_file($_FILES['image']['tmp_name'], $path . $image);
    }

    $key = ['STT', 'Ten', 'Loai', 'Link'];
    $data = [$id, $image, $loai, $thongtin];
    $message = $db->update("anh_slide", $data, $key, 'STT', $id);
    header("Location: /Nhom04_WebsiteBanXeMay/admin/modules/trangchu");
}
?>

<?php require_once __DIR__ . "/../../layouts/header.php"; ?>

<!--  -->
<div id="content-wrapper">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Quản lý</a>
        </li>
        <li class="breadcrumb-item active">Cài đặt trang chủ</li>
        <li class="breadcrumb-item active">Sửa</li>
    </ol>

    <div class="card mb-3">
        <div class="card-body">

            <!-- Form sửa -->
            <form method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>STT</label>
                        <input type="text" class="form-control" name='idsanpham' readonly value="<?php echo  $category['STT']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Loại</label>
                        <select name="loai" class="form-control" required>
                            <option <?php if($category['Loai']=='TT') echo 'selected' ?> value="TT" >Tin tức</option>
                            <option <?php if($category['Loai']=='SP') echo 'selected' ?> value="SP">Sản phẩm</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Link</label>
                    <input type="text" class="form-control" name="thongtin" value="<?php echo $category['Link'] ?>">
                </div>
                <div class="file-upload-wrapper">
                    <input type="file" name="image" class="file-upload" data-height="500" onchange="readURL(this);" />
                    <img id="blah" style="width:50%" src="/Nhom04_WebsiteBanXeMay/img/<?php echo $category['Ten'] ?>" class="img-thumbnail">
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