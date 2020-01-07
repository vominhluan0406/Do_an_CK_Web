<?php
require_once __DIR__ . "/public/customer/layouts/header.php";
require_once __DIR__ . "/public/customer/layouts/menu.php";
$ten = $cmnd = $diachi = $sdt = $email = "";
if (isset($_SESSION['user'])) {
    $id = $_SESSION['user'];
    $khachhang = $db->fetchIDOne('khachhang', '*', 'UserName', $id);
    $ten = $khachhang['HoTen'];
    $cmnd = $khachhang['CMND'];
    $diachi  = $khachhang['DiaChi'];
    $email = $khachhang['Email'];
    $sdt = $khachhang['SDT'];
}
?>


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
</div>


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div>
                <div class="product-content-right">
                    <div style="margin: 1em auto;border: solid black 1px;text-align: center;  box-shadow: 5px 5px 15px 15px #888888;">
                        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) { ?>
                            <form enctype="multipart/form-data" action="libraries/dathang.php" class="checkout" method="get" name="checkout">
                                <div id="customer_details" class="col2-set">
                                    <div style="padding: 10%;">
                                        <div class="woocommerce-shipping-fields">
                                            <h3 id="ship-to-different-address">
                                                <label class="checkbox" for="ship-to-different-address-checkbox">Thông tin mua hàng</label>
                                            </h3>
                                            <div class="shipping_address" style="display: block;">
                                                <p id="shipping_country_field" class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                                                    <label class="" for="shipping_country">Chọn đại lý nhận hàng <abbr title="required" class="required">*</abbr></label>
                                                    <select class="country_to_state country_select" id="billing_country" name="tp"></select>
                                                    <select class="country_to_state country_select" id="shipping_country" name="cs" required></select>

                                                </p>
                                                <p id="shipping_first_name_field" class="form-row form-row-first validate-required">
                                                    <label class="" for="shipping_first_name">Tên <abbr title="required" class="required">*</abbr>
                                                    </label>
                                                    <input type="text" value="<?php echo $ten ?>" placeholder="Họ và tên" id="shipping_first_name" name="hoten" class="input-text " required>
                                                </p>

                                                <p id="shipping_last_name_field" class="form-row form-row-last validate-required">
                                                    <label class="" for="shipping_last_name">Ngày sinh</label>
                                                    <input type="text" value="" placeholder="01/01/2000" id="shipping_last_name" name="ngaysinh" class="input-text ">
                                                </p>
                                                <div class="clear"></div>

                                                <p id="shipping_company_field" class="form-row form-row-wide">
                                                    <label class="" for="shipping_company">Chứng minh nhân dân<abbr title="required" class="required"></abbr>*</label>
                                                    <input type="text" value="<?php echo $cmnd ?>" placeholder="123456789" id="shipping_company" name="cmnd" class="input-text" required>
                                                </p>

                                                <p id="shipping_address_1_field" class="form-row form-row-wide address-field validate-required">
                                                    <label class="" for="shipping_address_1">Địa chỉ <abbr title="required" class="required">*</abbr>
                                                    </label>
                                                    <input type="text" value="<?php echo $diachi ?>" placeholder="Số nhà, tên đường" id="shipping_address_1" name="diachi" class="input-text " required>
                                                </p>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label class="" for="shipping_city">Số điện thoại<abbr title="required" class="required">*</abbr>
                                                        </label>
                                                        <input type="text" value="<?php echo $sdt ?>" placeholder="0123456789" id="shipping_city" name="sdt" class="input-text " required>
                                                    </div>
                                                    <div class="col">
                                                        <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $email ?>" required>
                                                    </div>
                                                </div>

                                                <div class="clear"></div>
                                            </div>
                                            <p id="order_comments_field" class="form-row notes">
                                                <label class="" for="order_comments">Ghi chú</label>
                                                <textarea cols="5" rows="2" placeholder="Yêu cầu thêm" id="order_comments" class="input-text " name="order_comments"></textarea>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <h3 id="order_review_heading">Đơn hàng của bạn</h3>
                                <div id="order_review" style="position: relative;">
                                    <table class="shop_table">
                                        <thead>
                                            <tr>
                                                <th class="product-name">Sản phẩm</th>
                                                <th class="product-total">Tổng tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($_SESSION['cart'] as $key => $value) {
                                                $sp = $db->fetchIDOne('sanpham', '*', 'MaSp', $key);
                                            ?>
                                                <tr class="cart_item">
                                                    <td class="product-name"><?php echo $sp['TenSP'] ?>
                                                        <strong class="product-quantity">× <?php echo $value['qty'] ?></strong> </td>
                                                    <td class="product-total">
                                                        <span class="amount"><?php echo number_format($value['qty'] * $sp['Gia']) ?> VND</span> </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>

                                            <tr class="cart-subtotal">
                                                <th>Khác</th>
                                                <td>
                                                    <span class="amount">
                                                        <?php echo number_format($_SESSION['giamgia'] * $_SESSION['tongtien']) ?>
                                                    </span>
                                                </td>
                                            </tr>


                                            <tr class="order-total">
                                                <th>Thành tiền</th>
                                                <td><strong><span class="amount">
                                                            <?php echo number_format($_SESSION['tongtien']) ?> VND
                                                        </span></strong> </td>
                                            </tr>

                                        </tfoot>
                                    </table>


                                    <div id="payment">
                                        <ul class="payment_methods methods">
                                            <li class="payment_method_bacs">
                                                <input type="radio" data-order_button_text="" checked="checked" value="bacs" name="payment_method" class="input-radio" id="payment_method_bacs">
                                                <label for="payment_method_bacs">Thanh toán tại cửa hàng</label>

                                            </li>
                                        </ul>
                                        <div class="form-row place-order">
                                            <input type="submit" data-value="Place order" value="Place order" id="place_order" name="woocommerce_checkout_place_order" class="button alt">
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </form>
                        <?php } else { ?>
                            <h2>Giỏ hàng trống, mời bạn mua thêm sản phẩm.</h2>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/checkout.js"></script>
<?php require_once __DIR__ . "/public/customer/layouts/footer.php" ?>