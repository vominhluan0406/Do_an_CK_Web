<?php require_once __DIR__ . "/../../../libraries/database.php";
$db = new Database;

$dondh = $db->fetchIDOne('dondh','*','MaDonDH',$_GET['id']);

$id = $_GET['id'];
$chitietdh = $db->fetchOne('chitietdondh', " MaDonDH = $id");

?>
<?php require_once __DIR__ . "/../../layouts/header.php"; ?>
<div id="content-wrapper">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Quản lý</a>
        </li>
        <li class="breadcrumb-item active">Đơn hàng</li>
        <li class="breadcrumb-item active">Chi tiết</li>
    </ol>
    <div class="card mb-3">
        <div class="card-body">
            <div class="form-row">
                <div class="col">
                    <label>ID Đơn hàng</label>
                    <input type="text" class="form-control" readonly value="<?php echo  $_GET['id'] ?>">
                </div>
                <div class="col">
                    <label>ID Khách Hàng</label>
                    <input type="text" class="form-control" readonly value="<?php echo  $dondh['UserName'] ?>">
                </div>
            </div>
        </div>

        <!-- chi tiet -->
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($chitietdh as $item) : ?>
                    <tr>
                        <td><?php echo $item['MaSP'] ?></td>
                        <td><?php echo $item['SoLuong'] ?></td>
                        <td><?php echo $item['DonGia'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    <div class="alert alert-success" role="alert" style="display:none" id="alert">
        <h4 class="alert-heading">Đã xóa</h4>
    </div>
</div>

<!-- Xóa -->
<script>
    function xoa() {
        let booll = confirm('Bạn muốn xóa khách hàng <?php echo $item['HoTen'] ?>?');
        if (booll) {
            <?php
            $db->delete('giohang', 'UserName', $item['UserName']);
            ?>
            $('.alert').css('display', 'block');
            setTimeout(function() {
                location.reload();
            }, 1000);
        }
    }
</script>

<?php require_once __DIR__ . "/../../layouts/footer.php"; ?>