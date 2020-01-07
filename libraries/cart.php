<?php
if (isset($_GET['id']) && isset($_GET['qty'])) {
    require_once __DIR__ . "/database.php";
    $db = new Database;
    session_start();

    $id = $_GET['id'];
    $qty = $_GET['qty'];

    if (isset($_SESSION['cart'])) {
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
}
if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}
