<?php require_once __DIR__ . "/../../../../libraries/database.php";
$db = new Database;
?>

<!-- Insert -->
<?php
$bd = $kt = $code = $giam = $ndung = $id = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["bd"])) {
        $bd = $_POST["bd"];
    }
    if (isset($_POST["kt"])) {
        $kt = $_POST["kt"];
    }
    if (isset($_POST["code"])) {
        $code = $_POST["code"];
    }
    if (isset($_POST["ndung"])) {
        $ndung = $_POST["ndung"];
    }

    if (isset($_POST["giam"])) {
        $giam = $_POST["giam"];
    }

    if($bd>$kt){
        $message="Lỗi ngày";
    }else{
    $id = $db->fetchOrder('khuyenmai','DESC','TenKM')['TenKM']+1;
    $tmp = [$id, $code, $ndung, $giam, $bd, $kt];
    $message = $db->insert("khuyenmai", $tmp);
    }
}
?>
<!-- /Insert -->

<?php require_once __DIR__ . "/../../../layouts/header.php"; ?>

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

            <!-- Form thêm mã km -->
            <form method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Ngày bắt đầu</label>
                        <input type="date" class="form-control" name='bd' required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Ngày kết thúc</label>
                        <input type="date" class="form-control" name="kt" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Mã khuyến mãi</label>
                        <input type="text" class="form-control" name='code' required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Giảm (%)</label>
                        <input type="number" class="form-control" name="giam" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Nội dung</label>
                    <textarea class="form-control" name="ndung" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Thêm</button>
                <?php if(isset($message)){ ?>
                <div class="alert alert-success" role="alert">
                    <p class="mb-0"><?php echo $message ?></p>
                </div>
                <?php }?>
            </form>
        </div>
    </div>
    <?php require_once __DIR__ . "/../../../layouts/footer.php" ?>