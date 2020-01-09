<?php
require_once __DIR__ . "/../../libraries/database.php";

session_start();

// Đăng xuất
if (isset($_SESSION['dangnhap'])) {
    unset($_SESSION['dangnhap']);
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
                
                // giỏ hàng
                $num = $db->find('giohang',[$user],['UserName']);
                if($num!=0){
                    $danhsach_sp = explode(',',$db->fetchIDOne('giohang','DanhSach','UserName',$user)['DanhSach']);
                    $danhsach_sl = explode(',',$db->fetchIDOne('giohang','SoLuong','UserName',$user)['SoLuong']);
                    array_pop($danhsach_sl);
                    array_pop($danhsach_sp);
                    $_SESSION['cart']=array();
                    for($x=0;$x<sizeof($danhsach_sl);$x++){
                        $_SESSION['cart'][$danhsach_sp[$x]] = array(
                            'qty'=>$danhsach_sl[$x]
                        );
                    }
                    var_dump($_SESSION['cart']);
                }
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
