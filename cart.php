<?php
require_once __DIR__ . "/public/customer/layouts/header.php";
require_once __DIR__ . "/public/customer/layouts/menu.php";

// Tinh tong sp va Tien
if (isset($_SESSION['cart'])) {
    $sluong = 0;
    $tongtien = 0;
    $giamgia = 0;
    foreach ($_SESSION['cart'] as $key => $value) {
        $sluong += intval($value['qty']);
        $tongtien += $value['qty'] * ($db->fetchIDOne('sanpham', '*', 'MaSp', $key)['Gia']);
    }
    // Lấy mgg từ url
    if (isset($_GET['coupon'])) {
        $mgg = strtoupper($_GET['coupon']);
        $num = $db->find('khuyenmai', [$mgg], ['MaKM']);
        if ($num == 0)
            $giamgia = 0;
        else
            $giamgia = $db->fetchIDOne('khuyenmai', 'Giam', 'MaKM', $mgg)['Giam'];
    }
}
?>


<!--  -->

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Giỏ hàng</h2>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Page title area -->



<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <?php
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            ?>
                <div style="margin: 1em auto;border: solid black 1px;box-shadow: 5px 5px 15px 15px #888888;">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            <!-- Form -->
                            <form method="POST" action="checkout.php">
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                        <tr>
                                            <th class="product-name" colspan="2">Sản phẩm</th>
                                            <th class="product-price">Giá</th>
                                            <th class="product-quantity">Số lượng</th>
                                            <th class="product-subtotal">Tổng cộng</th>
                                            <th class="product-subtotal">Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Danh sach sp trong gio hang -->
                                        <?php
                                        foreach ($_SESSION['cart'] as $key => $value) {
                                            $sp = $db->fetchIDOne('sanpham', '*', 'MaSp', $key);
                                            $gia = $sp['Gia'];
                                            $tong = $gia * $value['qty'];
                                        ?>
                                            <tr class="cart_item">
                                                <th><?php echo $sp['TenSP'] ?></th>
                                                <th class="product-thumbnail">
                                                    <img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="img/<?php echo $sp['Anh'] ?>">
                                                </th>
                                                <th class="product-price">
                                                    <span class="amount"><?php echo number_format($gia) ?> VND</span>
                                                </th>
                                                <!-- Tang giam sp -->
                                                <td class="product-quantity">
                                                    <div class="quantity buttons_added">
                                                        <a href="libraries/cart.php?id=<?php echo $key ?>&qty=-1" class="btn">-</a>
                                                        <input type="number" size="4" class="input-text qty text" title="Qty" value="<?php echo $value['qty'] ?>" min="0" step="1">
                                                        <a href="libraries/cart.php?id=<?php echo $key ?>&qty=1" class="btn">+</a>
                                                    </div>
                                                </td>
                                                <th class="<?php echo number_format($tong) ?> VND">
                                                    <span class="amount"><?php echo number_format($tong) ?> VND</span>
                                                </th>
                                                <th class="product-subtotal">
                                                    <a href="libraries/cart.php?id=<?php echo $key ?>&qty=-1">X</a>
                                                </th>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td class="actions" colspan="6">
                                                <!-- Nhap Ma giam gia -->
                                                <div class="coupon">
                                                    <input type="text" placeholder="Mã giảm giá" value="<?php if(isset($_GET['coupon'])) echo $_GET['coupon']?>" id="coupon_code" class="input-text" name="coupon_code">
                                                    <input type="submit" name="add_coupon" value="Xác nhận" />
                                                </div>
                                                <!-- /Nhap Ma giam gia -->
                                                <?php if ($giamgia != 0) { ?>
                                                    <div>
                                                        <input type="text" readonly value="<?php echo $db->fetchIDOne('khuyenmai', '*', 'MaKM', $mgg)['NoiDung'] ?>">
                                                    </div>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="cart-collaterals">
                                    <div class="cart_totals ">
                                        <h2>Tổng cộng</h2>
                                        <table cellspacing="0">
                                            <tbody>
                                                <tr class="cart-subtotal">
                                                    <th>Tổng tiền</th>
                                                    <td><span class="amount"><?php echo number_format($tongtien) ?> VND</span></td>
                                                </tr>
                                                <tr class="shipping">
                                                    <th>Giảm giá</th>
                                                    <td>
                                                        <?php
                                                        echo number_format($tongtien * $giamgia / 100);
                                                        ?> VND
                                                    </td>
                                                </tr>
                                                <tr class="order-total">
                                                    <th>Thành tiền</th>
                                                    <td><strong><span class="amount"><?php echo number_format($tongtien * (1 - $giamgia / 100)); ?> VND</span></strong> </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <small>(Chưa bao gồm phí làm giấy tờ)</small>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="check_out"><h2>Thanh toán</h2></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } else if (empty($_SESSION['cart']) || !isset($_SESSION['cart'])) {
                echo '<h2 style="color:red;text-align:center;">Không có sản phẩm nào trong giỏ hàng của bạn<br><a href="index.php" title="Trang chủ">ĐẾN TRANG CHỦ</a></h2>';
            } ?>
        </div>
    </div>
</div>


<?php require_once __DIR__ . "/public/customer/layouts/footer.php"; ?>