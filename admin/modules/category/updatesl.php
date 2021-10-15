<?php
    require_once __DIR__ . "/../../../libraries/database.php";

    $db = new Database;

    $id ="";
    $sl=[];
    $key = ['Soluong'];

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET['id'])){
            $id=$_GET['id'];
        }
        if(isset($_GET['soluong'])){
            array_push($sl,(int)$_GET['soluong']);
        }

        $db->update('soluongsp',$sl,$key,'MaSP',$id);
    }
    header('Location: /admin/modules/category/soluongsp.php');
?>