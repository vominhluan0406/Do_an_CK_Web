<?php
    require_once __DIR__. "/../../libraries/database.php";

    $db = new Database;

    $MaKH = $UserName = $HoTen = $Pass = $CMND = $DiaChi =$Email = $SDT = $NgayDK =$Ngaysinh = "";

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST['user'])){
            $UserName = $_POST['user'];
        }
        if(isset($_POST['hovaten'])){
            $HoTen = $_POST['hovaten'];
        }
        if(isset($_POST['cmnd'])){
            $CMND = $_POST['cmnd'];
        }
        if(isset($_POST['sdt'])){
            $SDT = $_POST['sdt'];
        }
        if(isset($_POST['inputEmail'])){
            $Email = $_POST['inputEmail'];
        }
        if(isset($_POST['password'])){
            $Pass = md5($_POST['password']);
        }
        if(isset($_POST['diachi'])){
            $DiaChi = $_POST['diachi'];
        }
        if(isset($_POST['ngaysinh'])){
            $Ngaysinh = $_POST['ngaysinh'];
        }
        $NgayDK = date("Y/m/d");
        
        $MaKHcurrent = $db->fetchOrder('khachhang','DESC','MaKH','MaKH')['MaKH'];
        
        $MaKH = 'KH'.($MaKHcurrent[2]+1);

        $tmp = [$MaKH,$UserName,$Pass,$HoTen,$Ngaysinh,$CMND,$DiaChi,$Email,$SDT,$NgayDK];
        
        $db->insert('khachhang',$tmp);
        header("Location: /Nhom04_WebsiteBanXeMay/login.php");
        exit;
    }
?>