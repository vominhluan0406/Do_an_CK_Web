<?php
require_once __DIR__ . "../../../../libraries/database.php";
$db = new Database;
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $num = $db->fetchOrder('nhanxet', 'DESC', 'MaNX')['MaNX'] + 1;
    $id = $noidung = $UserName = $Sao  = "";
    if (isset($_GET['id']))
        $id = $_GET['id'];
    if (isset($_GET['rate']))
        $Sao = $_GET['rate'];
    if (isset($_GET['review']))
        $noidung = $_GET['review'];
    if (isset($_GET['user']))
        $UserName = $_GET['user'];
    $db->insert('nhanxet',[$num,$UserName,$id,$noidung,$Sao]);
}
if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
}
