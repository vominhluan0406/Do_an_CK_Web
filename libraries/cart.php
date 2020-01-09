<?php
// Kiem tra sp và số lượng
if (isset($_GET['id']) && isset($_GET['qty'])) {
    require_once __DIR__ . "/database.php";
    $db = new Database;
    session_start();

    $id = $_GET['id'];
    $qty = $_GET['qty'];

    if (isset($_SESSION['cart'])) {      //$_SESSION['cart']=array( '$id'=>['qty'=>sl] )
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['qty'] += intval($qty);
            if ($_SESSION['cart'][$id]['qty'] <= 0)
                unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id] = array(
                "qty" => 1
            );
        }
    } else {
        $_SESSION['cart'] = array();
        $_SESSION['cart'][$id] = array(
            'qty' => 1
        );
    }
    
    // Luu gio hang
    if (isset($_SESSION['cart']) && isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        $danhsach_sp = "";
        $danhsach_sl = "";
        foreach ($_SESSION['cart'] as $key => $value) {
            $danhsach_sp .= $key . ",";
            $danhsach_sl .= $value['qty'] . ",";
        }
        $num = $db->find('giohang', [$user], ['UserName']);
        if ($num == 0)
            $db->insert('giohang', [$user, $danhsach_sp, $danhsach_sl]);
        else
            $db->update('giohang', [$danhsach_sp, $danhsach_sl], ['DanhSach', 'SoLuong'], 'UserName', $user);
    }
}
if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}
