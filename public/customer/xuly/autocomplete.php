<?php 
require_once __DIR__ . "/../../../libraries/database.php";
$db = new Database;
$danhsach = $db->fetchAll('sanpham');
$source = "";
foreach ($danhsach as $item => $value) {
    $source .= $value['TenSP'] . ",";
}
echo $source;
?>