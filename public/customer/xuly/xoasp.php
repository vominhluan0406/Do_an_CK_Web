<?php
    session_start();
    if(isset($_GET['id'])){
        foreach($_SESSION['cart'] as $key=>$value){
            if($key==$_GET['id']){
                unset($_SESSION['cart'][$key]);
                if (isset($_SERVER["HTTP_REFERER"])) {
                    header("Location: " . $_SERVER["HTTP_REFERER"]);
                }
            }
        }
    }
?>