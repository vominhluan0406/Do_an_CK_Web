<?php
require_once __DIR__ . "/public/customer/layouts/header.php";
require_once __DIR__ . "/public/customer/layouts/menu.php";

if (isset($_GET['id'])) {
    if (!isset($_SESSION['xemganday']))
        $_SESSION['xemganday'] = array();
    $id = $_GET['id'];
    $db = new Database;
    $product = $db->fetchIDOne('sanpham', '*', 'MaSp', $id);
    array_unshift($_SESSION['xemganday'], $id);
} else {
    //Quay lai trang trc
    echo "<script>history.go(-1);</script>";
}

?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Sản phẩm</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="product-content-right">
                    <div class="product-breadcroumb">
                        <a href="">Trang chủ</a>
                        <a href="">Sản phẩm</a>
                        <a href=""><?php echo $product['TenSP'] ?></a>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="product-images">
                                <div class="product-main-img">
                                    <img src="img/<?php echo $product['Anh']; ?>" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="product-inner">
                                <h2 class="product-name"><?php echo $product['TenSP'] ?></h2>
                                <div class="product-inner-price">
                                    <ins><?php echo number_format($product['Gia']) ?> VND</ins>
                                </div>

                                <form action="libraries/cart.php" class="cart">
                                    <div class="quantity">
                                        <input id="numberic" type="number" size="4" class="input-text qty text" title="Qty" value="" name="qty" min="1" step="1">
                                    </div>
                                    <div class="product-option-shop">
                                        <input type="text" value="<?php echo $product['MaSp'] ?>" name="id" hidden>
                                        <input type="submit" value="Thêm vào giỏ hàng">
                                    </div>
                                </form>

                                <div class="product-inner-category">
                                    <p>Hãng: <a href=""><?php echo $product['HangSX'] ?></a> Loại: <a href="shop.php?id=<?php echo $product['MaLoai'] ?>"><?php echo $db->fetchIDOne('loaisp', 'TenLoai', 'MaLoai', $product['MaLoai'])['TenLoai'] ?></a> </p>
                                </div>

                                <div role="tabpanel">
                                    <ul class="product-tab" role="tablist">
                                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Thông tin</a></li>
                                        <?php if (isset($_SESSION['user'])) { ?>
                                            <li role="presentation"><a href="#danhgia" aria-controls="profile" role="tab" data-toggle="tab">Đánh giá</a></li>
                                        <?php } ?>
                                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Xem Đánh giá</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                                            <h2>Thông tin sản phẩm</h2>
                                            <p><?php echo $product['GioiThieu'] . '</br></br>' . $product['ThongTin'] ?></p>
                                        </div>
                                        <!-- Đánh giá -->
                                        <?php if (isset($_SESSION['user'])) { ?>
                                            <div role="tabpanel" class="tab-pane fade" id="danhgia">
                                                <form action="public/customer/xuly/binhluan.php" method="GET">
                                                    <h2>Đánh giá</h2>
                                                    <div class="submit-review">
                                                        <p><label for="name">Tên</label>
                                                            <input name="name" type="text" value="<?php echo $db->fetchIDOne('khachhang', 'HoTen', 'UserName', $user)['HoTen'] ?>">
                                                            <input type="text" value="<?php echo $user ?>" hidden name="user">
                                                        </p>
                                                        <div class="rating-chooser">
                                                            <p>Đánh giá của bạn</p>
                                                            <input type="text" value="<?php echo $id ?>" hidden name="id">
                                                            <div class="rating-wrap-post">
                                                                <div class="rate">
                                                                    <input type="radio" id="star5" name="rate" value="5" />
                                                                    <label for="star5" title="text">5 stars</label>
                                                                    <input type="radio" id="star4" name="rate" value="4" />
                                                                    <label for="star4" title="text">4 stars</label>
                                                                    <input type="radio" id="star3" name="rate" value="3" />
                                                                    <label for="star3" title="text">3 stars</label>
                                                                    <input type="radio" id="star2" name="rate" value="2" />
                                                                    <label for="star2" title="text">2 stars</label>
                                                                    <input type="radio" id="star1" name="rate" value="1" />
                                                                    <label for="star1" title="text">1 star</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p><label for="review">Đánh giá</label> <textarea name="review" id="" cols="30" rows="10"></textarea></p>
                                                        <p><button type="submit">Gửi</button></p>
                                                </form>
                                            </div>
                                    </div>
                                <?php } ?>
                                <div role="tabpanel" class="tab-pane fade" id="profile" style="overflow:auto;height:15em">
                                    <ul class="smooth-scroll list-unstyled">
                                        <?php
                                        $danhsach = $db->fetchOne('nhanxet', " MaSP = '$id'");
                                        foreach ($danhsach as $item) {
                                        ?>
                                            <li>
                                                <div class="product-sidebar-price">
                                                    <ins><?php echo $db->fetchIDOne('khachhang', 'HoTen', 'UserName', $item['UserName'])['HoTen'] ?></ins>
                                                </div>
                                                <div class="product-wid-rating">
                                                    <?php for ($x = 0; $x < $item['Sao']; $x++) { ?>
                                                        <i class="fa fa-star"></i>
                                                    <?php } ?>
                                                </div>
                                                <p><?php echo $item['NoiDung'] ?></p>
                                            </li>
                                            <hr>
                                        <?php } ?>
                                    </ul>
                                </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4">


                <div class="single-sidebar">
                    <h2 class="sidebar-title">Xem gần đây</h2>
                    <ul>
                        <?php if (isset($_SESSION['xemganday'])) {
                            $danhsach_xem = $_SESSION['xemganday'];
                            $i = 0;
                            foreach ($danhsach_xem as $item) {
                                if ($i == 3) break;
                                $i++;
                                $item = $db->fetchIDOne('sanpham', '*', 'MaSp', $item);
                        ?>
                                <li><a href="single-product.php?id=<?php echo $item['MaSp'] ?>"><?php echo $item['TenSP'] ?></a></li>
                        <?php }
                        } ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <!-- <div class="related-products-wrapper"> -->
                    <h2 class="related-products-title">Liên quan</h2>
                    <div class="related-products-carousel">
                        <?php
                        $hang = $product['HangSX'];
                        $loai = $product['MaLoai'];
                        $sql = " MaLoai = '$loai' OR HangSX = '$hang'";
                        $lienquan = $db->fetchOne('sanpham', $sql);
                        foreach ($lienquan as $item) {
                            $item = $db->fetchIDOne('sanpham', '*', ' MaSp', $item['MaSp']);
                        ?>
                            <!-- San pham lien quan -->
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="img/<?php echo $item['Anh'] ?>" alt="">
                                    <div class="product-hover">

                                        <a href="single-product.php?id=<?php echo $item['MaSp'] ?>" class="view-details-link"><i class="fa fa-link"></i> Chi tiết</a>
                                    </div>
                                </div>

                                <h2><a href="single-product.php?id=<?php echo $item['MaSp'] ?>"><?php echo $item['TenSP'] ?></a></h2>

                                <div class="product-carousel-price">
                                    <ins><?php echo number_format($item['Gia']) ?> VND</ins>
                                </div>
                            </div>
                        <?php } ?>
<!-- 
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php require_once __DIR__ . "/public/customer/layouts/footer.php" ?>