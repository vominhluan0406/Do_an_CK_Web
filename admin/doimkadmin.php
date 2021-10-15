<?php
require_once __DIR__ . "/../libraries/database.php";

$db = new Database;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['mkc']) && isset($_POST['mkm']) && isset($_POST['mkm1'])) {

        $key = ['UserName', 'Password'];
        $vallue = [$_POST['user'], md5($_POST['mkc'])];
        //Kiem tra mk
        $kq = $db->find('quantri', $vallue, $key);


        if ($_POST['mkc'] != "" && $_POST['mkm'] != "" && $_POST['mkm1'] != "") {

            if ($kq == 0) {
                $_SESSION['loi'] = "Mật khẩu cũ không đúng!";
            }

            if ($_POST['mkm'] !== $_POST['mkm1']) {
                $_SESSION['loi'] = "Mật khẩu nhập lại không đúng!";
            }
            else if ($kq != 0) {
                $_SESSION['loi'] = "Thành công!";

                $key = ['password'];
                $data = [md5($_POST['mkm'])];
                
                $db->update('quantri',$data,$key,'user',$_POST['user']);
            }
        } else
            $_SESSION['loi'] = "Nhập thiếu dữ liệu!";
    }
}
header("Location: /admin/mk.php");
