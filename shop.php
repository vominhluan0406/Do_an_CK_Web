<!-- database -->
<?php
require_once __DIR__ . "/libraries/database.php";
$db = new Database;

if (isset($_GET['id'])) {
    $id = strtoupper($_GET['id']);
    if ($id != "ALL")
        $danhsachsp  = $db->fetchOne("sanpham", " MaLoai = '$id'");
    else
        $danhsachsp = $db->fetchAll('sanpham');
} else {
    $danhsachsp = $db->fetchAll('sanpham');
}
?>

<!-- header -->
<?php require_once __DIR__ . "/public/customer/layouts/header.php" ?>
<!-- menu -->
<?php require_once __DIR__ . "/public/customer/layouts/menu.php"; ?>
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Danh sách xe máy</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="classify">
    <div id="myBtnContainer">
        <a href="shop.php?id=all" class="btn <?php if ($id == 'ALL' || $id == '') echo 'active' ?>">TẤT CẢ</a>
        <a href="shop.php?id=tg" class="btn <?php if ($id == 'TG') echo 'active' ?>">XE TAY GA</a>
        <a href="shop.php?id=ss" class="btn <?php if ($id == 'SS') echo 'active' ?>">XE SỐ</a>
        <a href="shop.php?id=ct" class="btn <?php if ($id == 'CT') echo 'active' ?>">XE CÔN TAY</a>
        <a href="shop.php?id=pkl" class="btn <?php if ($id == 'PKL') echo 'active' ?>">XE PHÂN KHỐI LỚN</a>
    </div>

    <div class="container" id="listproduct">
    </div>
</div>

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <!-- Hien thi san pham -->
            <?php foreach ($danhsachsp as $item) : ?>
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper"><img src="img/<?php echo $item['Anh'] ?>" alt=""></div>
                        <h2><a href="single-product.php?id=<?php echo $item['MaSp'] ?>"><?php echo $item['TenSP'] ?></a></h2>
                        <div class="product-carousel-price"><ins><?php echo number_format($item['Gia']) ?> VND</ins></div>
                        <div class="product-option-shop">
                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="libraries/cart.php?id=<?php echo $item['MaSp'] ?>&qty=1">Thêm vào giỏ hàng</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>


<?php require_once __DIR__ . "/public/customer/layouts/footer.php" ?>;