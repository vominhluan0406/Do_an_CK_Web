<?php 
    require_once __DIR__. "/../../../libraries/database.php";
    $db = new Database;
    if(isset($_GET['id'])){
        $user = $db->fetchOne('sanpham','MaSp ="'.$_GET['id'].'"');
        if($user){
            $db->delete('sanpham','MaSp',$_GET['id']);
        }
    }
    header('Location: /admin/modules/category');
?>