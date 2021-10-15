<?php
require_once __DIR__ . "../../../../libraries/database.php";

$db = new Database;

session_start();
ob_start();

// Kiem tra nguoi dung
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $db = new Database;
    $kh = $db->fetchIDOne('khachhang', '*', 'UserName', $user);
}

// Tinh tong sp va Tien
if (isset($_SESSION['cart'])) {
    $sluong = 0;
    $tongtien = 0;
    foreach ($_SESSION['cart'] as $key => $value) {
        $sluong += intval($value['qty']);
        $tongtien += $value['qty'] * ($db->fetchIDOne('sanpham', '*', 'MaSp', $key)['Gia']);
    }
}

?>

<!DOCTYPE html>
<!--
	ustora by freshdesignweb.com
	Twitter: https://twitter.com/freshdesignweb
	URL: https://www.freshdesignweb.com/ustora/
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hadon</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <!-- <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'> -->

    <!-- JQuery -->
    <script src="js/jquery-3.4.1.js"></script>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- jQuery UI library -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="css/all.css"> -->

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/responsive.css">
    <style>
        /* Dropdown Cart */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown {
            position: relative;
        }

        .dropdown:hover .dropdown-content {
            display: inline-block;
        }

        .dropdown-content tr {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        /* Đánh giá */
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rate:not(:checked)>input {
            position: absolute;
            top: -9999px;
        }

        .rate:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rate:not(:checked)>label:before {
            content: '★ ';
        }

        .rate>input:checked~label {
            color: #ffc700;
        }

        .rate:not(:checked)>label:hover,
        .rate:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rate>input:checked+label:hover,
        .rate>input:checked+label:hover~label,
        .rate>input:checked~label:hover,
        .rate>input:checked~label:hover~label,
        .rate>label:hover~input:checked~label {
            color: #c59b08;
        }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>


    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        <ul>
                            <?php if (isset($user)) { ?>
                                <li>
                                    <div class="dropdown">
                                        <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-user"></i><?php echo '  Xin chào ' . $kh['HoTen']; ?>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="customer.php">Tài khoản</a>
                                            <a class="dropdown-item" href="customer.php?mk">Đổi mật khẩu</a>
                                            <a class="dropdown-item" href="customer.php?dh">Đơn hàng của tôi</a>
                                            <a class="dropdown-item" href="customer.php?bl">Bình luận của tôi</a>
                                        </div>
                                    </div>
                                </li>
                            <?php } else { ?>
                                <li><a href="#"><i class="fa fa-user"></i>Tài khoản</a></li>
                            <?php } ?>
                            <li><a href="cart.php"><i class="fa fa-user"></i>Giỏ hàng</a></li>
                            <li><a href="checkout.php"><i class="fa fa-user"></i>Thanh toán</a></li>
                            <li><a href="login.php"><i class="fa fa-user"></i><?php if (isset($user)) echo "Đăng xuất";
                                                                                else echo "Đăng nhập"; ?></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div> <!-- End header area -->

    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <a href="./"><img src="img/logo.png"></a>
                        <h3> Cửa hàng xe máy Barcelona</h3>
                    </div>
                </div>


                <div class="col-sm-6">
                    <div class="dropdown">
                        <div class="shopping-item">
                            <a href="cart.php">Giỏ hàng
                                <span class="cart-amunt"><?php if (isset($_SESSION['cart'])) echo number_format($tongtien); ?> VND</span>
                                <i class="fa fa-shopping-cart"></i>
                                <span class="product-count" <?php if (isset($_SESSION['cart'])) echo 'style="display: block;"' ?>><?php echo $sluong ?></span>
                            </a>
                        </div>
                        <!-- Xem chi tiết giỏ hàng -->
                        <div class="dropdown-content">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Tổng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_SESSION['cart'])) {
                                        foreach ($_SESSION['cart'] as $key => $value) {

                                    ?>
                                            <tr>
                                                <td><?php echo $db->fetchIDOne('sanpham', '*', 'MaSp', $key)['TenSP'] ?></td>
                                                <td><?php echo $value['qty'] ?></td>
                                                <td><?php echo number_format($value['qty'] * ($db->fetchIDOne('sanpham', '*', 'MaSp', $key)['Gia'])) ?></td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End site branding area -->