<?php
session_start();

require_once __DIR__."../../../../send.php";
// Nguoi mua
$user = 'quest';
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}
echo $user;

require_once __DIR__ . "/../../../libraries/database.php";
$db = new Database;

// thong tin

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['tp']) && isset($_POST['cs']))
        $coso = $_POST['tp'] . ' cơ sở: ' . $_POST['cs'];
    if (isset($_POST['hoten']))
        $ten = $_POST['hoten'];
    if (isset($_POST['ngaysinh']))
        $ngaysinh = $_POST['ngaysinh'];
    if (isset($_POST['cmnd']))
        $cmnd = $_POST['cmnd'];
    if (isset($_POST['sdt']))
        $sdt = $_POST['sdt'];
    if (isset($_POST['email']))
        $email = $_POST['email'];
    if (isset($_POST['diachi']))
        $diachi = $_POST['diachi'];
    if (isset($_POST['order_comments']))
        $ghichu = $_POST['order_comments'];
    $thongtin = 'Tên: ' . $ten . ' -- Ngày sinh: ' . $ngaysinh . ' -- CMND: ' . $cmnd . ' -- Số điện thoại: ' . $sdt . ' -- Email: ' . $email . ' -- Địa chỉ: ' . $diachi . ' -- Ghi chú: ' . $ghichu;
    $ngay = date("Y-m-d");
    $madon = ($db->fetchOrder('dondh', 'DESC', 'MaDonDH')['MaDonDH'] + 1);
    $db->insert('dondh', [$madon, $user, $ngay, $thongtin, $_SESSION['tongtien']]);

    // Gui thong bao ve admin
    $data['madondh'] = $madon;
    $pusher->trigger('my-channel', 'my-event', $data);
    
    foreach ($_SESSION['cart'] as $key => $value) {
        $stt = ($db->fetchOrder('chitietdondh', 'DESC', 'STT')['STT'] + 1);
        $db->insert('chitietdondh', [$stt, $madon, $key, $value['qty']]);

        $sp_conlai = $db->fetchIDOne('soluongsp','Soluong','MaSP',$key)['Soluong'];
        $sp_conlai -= $value['qty'];
        $db->update('soluongsp',[$sp_conlai],['Soluong'],'MaSP',$key);
    }
    unset($_SESSION['tongtien']);
    unset($_SESSION['cart']);
}
header('Location: ../../../checkout.php?ok');
exit();
