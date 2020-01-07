<?php
require_once __DIR__ . "/../../libraries/database.php";

session_start();

if (isset($_SESSION['dangnhap'])) {
    unset($_SESSION['dangnhap']);
    if (isset($_SESSION['xemganday']))
        unset($_SESSION['xemganday']);
}

$db = new Database;

$user = $password = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['type'])) {
        if (isset($_POST['user'])) {
            $user = $_POST['user'];
        }
        if (isset($_POST['password'])) {
            $password = $_POST['password'];
        }
        $key = ['UserName', 'Password'];
        $value = [$user, md5($password)];

        //Tai khoan nguoi dung
        if ($_POST['type'] == 'kh') {
            $num = $db->find('khachhang', $value, $key);
            if ($num == 0) {
                $_SESSION['dangnhap'] = "Tài khoản hoặc mật khẩu không chính xác!";
                header("Location: /Nhom04_WebsiteBanXeMay/login.php");
            } else {
                $_SESSION['user'] = $user;
                if (isset($_SESSION['xemganday']))
                    unset($_SESSION['xemganday']);
                $_SESSION['xemganday'] = array();
                header("Location: /Nhom04_WebsiteBanXeMay");
            }
        }
        //Tai khoan admin
        else {
            $num = $db->find('quantri', $value, $key);
            if ($num == 0) {
                $_SESSION['dangnhap'] = "Tài khoản hoặc mật khẩu không chính xác!";
                header("Location: /Nhom04_WebsiteBanXeMay/login.php");
            } else {
                $_SESSION['admin'] = $user;
                $_SESSION['pass']  = md5($password);
                header("Location: /Nhom04_WebsiteBanXeMay/admin");
            }
        }
    }
}
