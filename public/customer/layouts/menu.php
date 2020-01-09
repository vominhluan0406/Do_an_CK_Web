<?php
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$tag =  substr($url, 24, 2);
$tag = strtoupper($tag);
?>

<div class="mainmenu-area">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapsXe">
                <ul class="nav navbar-nav">

                    <li <?php if ($tag == 'IN' || $tag == '') echo 'class="active"' ?>><a href="index.php">Trang chủ</a></li>
                    <li <?php if ($tag == 'SH') echo 'class="active"' ?>><a href="shop.php">Cửa hàng</a></li>
                    <li <?php if ($tag == 'SI') echo 'class="active"' ?>><a href="single-product.php">Sản phẩm</a></li>
                    <li <?php if ($tag == 'CA') echo 'class="active"' ?>><a href="cart.php">Giỏ hàng</a></li>
                    <li <?php if ($tag == 'CH') echo 'class="active"' ?>><a href="checkout.php">Thanh toán</a></li>
                    <li <?php if ($tag == 'EV') echo 'class="active"' ?>><a href="event.php">Tin tức</a></li>
                    <li <?php if ($tag == 'CO') echo 'class="active"' ?>><a href="contact.php">Liên hệ</a></li>
                </ul>
                <form class="example" action="public/customer/xuly/search.php">
                    <button type="submit" style="float: right"><i class="fa fa-search"></i></button>
                    <input class='auto' type="text" placeholder="Tìm kiếm" name="id" style="margin:auto;max-width:300px;float: right">
                </form>
            </div>
        </div>
    </div>

</div> <!-- End mainmenu area -->
<!-- Autocomplete -->
<script type="text/javascript">

    arr = "<?php require_once __DIR__ . "/../xuly/autocomplete.php"; ?>";
    arr = arr.split(',');
    //autocomplete
    $(".auto").autocomplete({
        source: arr
    });

</script>