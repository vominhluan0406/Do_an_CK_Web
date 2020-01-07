<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once __DIR__ . "../../../../libraries/database.php";
    session_start();
    $db = new Database;
    $name = $diachi = $sdt = $email = $cmnd = $mk1 = $mk2 = "";

    // Doi mat khau
    if (isset($_POST['mk']) && isset($_POST['mk2']) && isset($_POST['mk1'])){
        if (md5($_POST['mk2']) == md5($_POST['mk1'])) {
            // Kiem tra mk cu~
            $num = $db->find('khachhang',[md5($_POST['mk'])],['PassWord']);
            if($num==0){
                $_SESSION['mk_update']="Sai mật khẩu";
                header("Location: /Nhom04_WebsiteBanXeMay/customer.php?mk");
            }
            else{
                $db->update('khachhang',[md5($_POST['mk2'])],['PassWord'],'UserName',$_SESSION['user']);
                $_SESSION['mk_update']="Thành công";
                header("Location: /Nhom04_WebsiteBanXeMay/customer.php?mk");
            }
        }
        else{
            $_SESSION['mk_update']="Mật khẩu không giống nhau!";
        }
        header("Location: /Nhom04_WebsiteBanXeMay/customer.php?mk");
    }else{

    if (isset($_POST['hoten'])) {
        $name = $_POST['hoten'];
    }
    if (isset($_POST['diachi'])) {
        $diachi = $_POST['diachi'];
    }
    if (isset($_POST['sdt'])) {
        $sdt = $_POST['sdt'];
    }
    if (isset($_POST['cmnd'])) {
        $cmnd = $_POST['cmnd'];
    }
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }

    // update
    $value = [$name, $diachi, $sdt, $cmnd, $email];
    $key = ['HoTen', 'DiaChi', 'SDT', 'CMND', 'Email'];

    $_SESSION['canhan_update'] = $db->update('khachhang', $value, $key, 'UserName', $_POST['user']);
    header("Location: /Nhom04_WebsiteBanXeMay/customer.php");
    }
}
?>
