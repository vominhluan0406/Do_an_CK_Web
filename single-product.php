<?php
require_once __DIR__ . "/public/customer/layouts/header.php";
require_once __DIR__ . "/public/customer/layouts/menu.php";
require_once __DIR__ . "/libraries/database.php";

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
            <div class="col-md-4">
                <div class="single-sidebar">
                    <h2 class="sidebar-title">Tìm kiếm</h2>
                    <!-- Tim kiem -->
                    <form autocomplete="off" action="">
                        <div class="autocomplete" style="width:300px;">
                            <input id="myInput" type="text" name="xe" placeholder="Tìm kiếm sản phẩm...">
                        </div>
                        <input type="submit" value="Tìm">
                    </form>
                </div>

                <div class="single-sidebar">
                    <h2 class="sidebar-title">Sản phẩm</h2>

                    <!-- San pham -->
                    <div class="thubmnail-recent">
                        <img src="img/product-thumb-1.jpg" class="recent-thumb" alt="">
                        <h2><a href="">Sony Smart TV - 2015</a></h2>
                        <div class="product-sidebar-price">
                            <ins>$700.00</ins>
                        </div>
                    </div>


                </div>

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

                                <!-- <div class="product-gallery">
                                    <img src="img/product-thumb-1.jpg" alt="">
                                    <img src="img/product-thumb-2.jpg" alt="">
                                    <img src="img/product-thumb-3.jpg" alt="">
                                </div> -->
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="product-inner">
                                <h2 class="product-name"><?php echo $product['TenSP'] ?></h2>
                                <div class="product-inner-price">
                                    <ins><?php echo number_format($product['Gia']) ?> VND</ins>
                                </div>

                                <form action="" class="cart">
                                    <div class="quantity">
                                        <input id="numberic" type="number" size="4" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
                                    </div>
                                    <div class="product-option-shop"><a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="#">Thêm vào giỏ hàng</a></div>
                                </form>

                                <div class="product-inner-category">
                                    <p>Hãng: <a href=""><?php echo $product['HangSX'] ?></a> Loại: <a href="shop.php?id=<?php echo $product['MaLoai'] ?>"><?php echo $db->fetchIDOne('loaisp', 'TenLoai', 'MaLoai', $product['MaLoai'])['TenLoai'] ?></a> </p>
                                </div>

                                <div role="tabpanel">
                                    <ul class="product-tab" role="tablist">
                                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Thông tin</a></li>
                                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Đánh giá</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                                            <h2>Thông tin sản phẩm</h2>
                                            <p><?php echo $product['GioiThieu'] . '</br></br>' . $product['ThongTin'] ?></p>


                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="profile">
                                            <h2>Đánh giá</h2>
                                            <div class="submit-review">
                                                <p><label for="name">Tên</label> <input name="name" type="text"></p>
                                                <p><label for="email">Email</label> <input name="email" type="email"></p>
                                                <div class="rating-chooser">
                                                    <p>Đánh giá của bạn</p>

                                                    <div class="rating-wrap-post">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <p><label for="review">Bình luận</label> <textarea name="review" id="" cols="30" rows="10"></textarea></p>
                                                <p><input type="submit" value="Submit"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="related-products-wrapper">
                        <h2 class="related-products-title">Liên quan</h2>
                        <div class="related-products-carousel">
                            <?php
                            $hang = $product['HangSX'];
                            $loai = $product['MaLoai'];
                            $sql = " MaLoai = '$loai' OR HangSX = '$hang'";
                            $lienquan = $db->fetchOne('sanpham',$sql);
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/public/customer/layouts/footer.php" ?>