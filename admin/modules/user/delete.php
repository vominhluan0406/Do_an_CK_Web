<?php 
    require_once __DIR__. "/../../../libraries/database.php";
    $db = new Database;
    if(isset($_GET['id'])){
        $user = $db->fetchOne('khachhang','MaKH ="'.$_GET['id'].'"');
        if($user){
            $db->delete('khachhang','MaKH',$_GET['id']);
        }
    }
    header('Location: /admin/modules/user');
?>