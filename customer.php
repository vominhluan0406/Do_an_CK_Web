<!-- header & menu -->
<?php
require_once __DIR__ . "/public/customer/layouts/header.php";
require_once __DIR__ . "/public/customer/layouts/menu.php";
if (isset($_SESSION['user'])) {

    $khachhang = $_SESSION['user'];
    require_once __DIR__ . "/libraries/database.php";
    $db = new Database;
    $thongtin = $db->fetchIDOne('khachhang', '*', 'UserName', $_SESSION['user']);
}
?>

<!-- ND -->
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Tài khoản</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Thong tin -->
<?php if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY) == '') { ?>
    <div class="overlay-content">
        <form action="public/customer/xuly/update.php" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="ten">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="ten" name="user" readonly value="<?php echo $thongtin['UserName'] ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Ngày đăng ký</label>
                    <input type="date" class="form-control" name="ngay" value="<?php echo $thongtin['NgayDK'] ?>" readonly>
                </div>
            </div>
            <div class="form-group col-md-12">
                <label>Họ và Tên</label>
                <input type="text" class="form-control" name="hoten" value="<?php echo $thongtin['HoTen'] ?>">
            </div>
            <div class="form-group col-md-12">
                <label>Địa chỉ</label>
                <input type="text" class="form-control" name="diachi" value="<?php echo $thongtin['DiaChi'] ?>">
            </div>
            <div class="form-group col-md-12">
                <label>Email</label>
                <input type="text" class="form-control" name="email" value="<?php echo $thongtin['Email'] ?>">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Số điện thoại</label>
                    <input type="text" class="form-control" id="ten" name="sdt" value="<?php echo $thongtin['SDT'] ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>CMND</label>
                    <input type="text" class="form-control" name="cmnd" value="<?php echo $thongtin['CMND'] ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block">Cập nhật</button>

            <?php if (isset($_SESSION['canhan_update'])) { ?>
                <div class="alert alert-info" role="alert">
                    <?php echo $_SESSION['canhan_update']; ?>
                </div>
            <?php unset($_SESSION['canhan_update']);
            } ?>

        </form>
    </div>

    <!-- Thay đổi mật khẩu -->
<?php } else if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY) == 'mk') { ?>
    <div class="overlay-content">
        <form action="public/customer/xuly/update.php" method="post">
            <div class="form-group col-md-12">
                <label>Mật khẩu cũ</label>
                <input type="password" class="form-control" name="mk" required>
            </div>
            <div class="form-group col-md-12">
                <label>Mật khẩu mới</label>
                <input type="password" class="form-control" name="mk1" required>
            </div>
            <div class="form-group col-md-12">
                <label>Nhập lại</label>
                <input type="password" class="form-control" name="mk2" required>
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block">Cập nhật</button>

            <?php if (isset($_SESSION['mk_update'])) { ?>
                <div class="alert alert-info" role="alert">
                    <?php echo $_SESSION['mk_update']; ?>
                </div>
            <?php unset($_SESSION['mk_update']);
            } ?>
        </form>
    </div>

    <!-- Xem bình luận -->
<?php } else if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY) == 'bl') { ?>
    <div class="overlay-content">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Sản phẩm</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Sao</th>
                    <th scope="col">Tùy chọn</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $dsach_dh = $db->fetchOne('nhanxet', " UserName = '$khachhang'");
                foreach ($dsach_dh as $item) {
                    $ten = $item['MaSP'];
                ?>
                    <tr>
                        <th scope="row"><?php echo $db->fetchIDOne('sanpham', 'TenSP', 'MaSp', $ten)['TenSP'] ?></th>
                        <td><?php echo $item['NoiDung'] ?></td>
                        <td>
                            <div class="product-wid-rating">
                                <?php for ($i = 0; $i < $item['Sao']; $i++) { ?>
                                    <i class="fa fa-star"></i>
                                <?php } ?>
                            </div>
                        </td>
                        <td>
                            <a href="">Sửa    </a>
                            <a href="">    Xóa</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Xem đơn hàng -->
<?php } else if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY) == 'dh') { ?>
    <div class="overlay-content">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Mã Đơn</th>
                    <th scope="col">Ngày Mua</th>
                    <th scope="col">Ghi chú</th>
                    <th scope="col">Chi tiết</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $dsach_dh = $db->fetchOne('dondh', " UserName = '$khachhang'");
                foreach ($dsach_dh as $item) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $item['MaDonDH'] ?></th>
                        <td><?php echo $item['Ngay'] ?></td>
                        <td><?php echo $item['GhiChu'] ?></td>
                        <td><a href="http://localhost/Nhom04_WebsiteBanXeMay/customer.php?dh&ma=<?php echo $item['MaDonDH'] ?>">Chi tiết</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } ?>
<!-- footer -->
<?php require_once __DIR__ . "/public/customer/layouts/footer.php" ?>