<?php
require_once __DIR__ . "/../../../libraries/database.php";
$db = new Database;
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  echo '<script>
      window.history.back();
    </script>';

  utf8_decode($id);
  // Kiem tra 
  $num = $db->find('sanpham', [$id], ['TenSP']);

  if ($num != 0) {
    $id = $db->fetchIDOne('sanpham', 'MaSp', 'TenSP', $id)['MaSp'];
    header("Location: /single-product.php?id=$id");
    exit;
  } else {
    echo '<script>
      window.history.back();
    </script>';
  }
}
