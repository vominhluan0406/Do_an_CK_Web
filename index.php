<!-- header -->
<?php require_once __DIR__ . "/public/customer/layouts/header.php" ?>
<!-- menu -->
<?php require_once __DIR__ . "/public/customer/layouts/menu.php" ?>

<?php
$slide = $db->fetchAll('anh_slide');
$spmoi = $db->fetchNew('sanpham', 'DESC', 'Ngay', 7);
// san pham ban chay
$dsach = $db->fetchCot('chitietdondh', 'MaSP,SoLuong');
$danhsach = array();
foreach ($dsach as $item => $value) {
    $danhsach[] =  $value['MaSP'];
}
$dsach = array_count_values($danhsach);
arsort($dsach);
?>

<div class="slider-area">
    <!-- Slider -->
    <div class="block-slider block-slider4">
        <ul class="" id="bxslider-home4">
            <?php foreach ($slide as $item) : ?>
                <li>
                    <a href="<?php echo $item['Link'] ?>"><img src="img/<?php echo $item['Ten'] ?>" alt="Slide"></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <!-- ./Slider -->
</div> <!-- End slider area -->


<div class="promo-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo1">
                    <i class="fa fa-refresh"></i>
                    <p>Bảo hành 3 năm</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo2">
                    <i class="fa fa-cc-discover"></i>
                    <p>Hỗ trợ đăng ký</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo3">
                    <i class="fa fa-money"></i>
                    <p>Trả góp lãi suất thấp</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo4">
                    <i class="fa fa-check   "></i>
                    <p>Chất lượng tuyệt vời</p>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End promo area -->

<div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="latest-product">
                    <h2 class="section-title">Xe ra mắt gần đây</h2>
                    <div class="product-carousel">
                        <?php foreach ($spmoi as $item) : ?>
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="img/<?php echo $item['Anh']; ?>" alt="">
                                    <div class="product-hover">
                                        <a href="#" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                                        <a href="single-product.php?id=<?php echo $item['MaSp']; ?>" class="view-details-link"><i class="fa fa-link"></i> Chi tiết</a>
                                    </div>
                                </div>

                                <h2><a href="single-product.php?id=<?php echo $item['MaSp']; ?>"><?php echo $item['TenSP']; ?></a></h2>

                                <div class="product-carousel-price">
                                    <ins><?php echo number_format($item['Gia']) ?> VND</ins>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End main content area -->

<div class="brands-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="brand-wrapper">
                    <div class="brand-list">
                        <img src="img/brand1.png" alt="">
                        <img src="img/brand2.png" alt="">
                        <img src="img/brand3.png" alt="">
                        <img src="img/brand4.png" alt="">
                        <img src="img/brand5.png" alt="">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End brands area -->

<div class="product-widget-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Bán chạy</h2>
                    <!-- <a href="" class="wid-view-more">Toàn bộ</a> -->
                    <?php
                    $i = 0;
                    foreach ($dsach as $key => $value) {
                        if ($i == 3) break;
                        $i++;
                        $item = $db->fetchIDOne('sanpham', '*', 'MaSp', $key);
                    ?>
                        <div class="single-wid-product">
                            <a href="single-product.html?id=<?php echo $item['MaSp']; ?>"><img src="img/<?php echo $item['Anh'] ?>" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.php?id=<?php echo $item['MaSp']; ?>"><?php echo $item['TenSP']; ?></a></h2>
                            <div class="product-wid-price">
                                <ins><?php echo number_format($item['Gia']); ?> VND</ins>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Xem gần đây</h2>
                    <!-- <a href="#" class="wid-view-more">Toàn bộ</a> -->
                    <?php if (isset($_SESSION['xemganday'])) {
                        $danhsach_xem = $_SESSION['xemganday'];
                        $i = 0;
                        foreach ($danhsach_xem as $item) {
                            if ($i == 3) break;
                            $i++;
                            $item = $db->fetchIDOne('sanpham', '*', 'MaSp', $item);
                    ?>
                            <div class="single-wid-product">
                                <a href="single-product.php?id=<?php echo $item['MaSp'] ?>"><img src="img/<?php echo $item['Anh'] ?>" alt="" class="product-thumb"></a>
                                <h2><a href="single-product.php?id=<?php echo $item['MaSp'] ?>"><?php echo $item['TenSP'] ?></a></h2>
                                <div class="product-wid-price">
                                    <ins><?php echo number_format($item['Gia']) ?> VND</ins>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Mới</h2>
                    <!-- <a href="#" class="wid-view-more">Toàn bộ</a> -->
                    <?php
                    $i = 0;
                    foreach ($spmoi as $item) {
                        if ($i == 3) break;
                            $i++;
                    ?>
                        <div class="single-wid-product">
                            <a href="single-product.php?id=<?php echo $item['MaSp'] ?>"><img src="img/<?php echo $item['Anh'] ?>" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.php?id=<?php echo $item['MaSp'] ?>"><?php echo $item['TenSP'] ?></a></h2>
                            <div class="product-wid-price">
                                <ins><?php echo number_format($item['Gia']) ?> VND</ins>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End product widget area -->

<!-- footer -->
<?php require_once __DIR__ . "/public/customer/layouts/footer.php" ?>;

<!-- Đổi tên sp -> link -->
<script>

</script>