<?php
require_once __DIR__ . "/layouts/header.php";
?>
<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Quản lý</a>
            </li>
            <li class="breadcrumb-item">
                Đổi mật khẩu
            </li>
        </ol>

        <!-- Đổi mật khẩu admin-->
        <form method="post" action="doimkadmin.php">
            <input type="text" hidden name="user" value='admin'>
            <div class="form-group">
                <label>Mật khẩu cũ</label>
                <input type="password" class="form-control" name="mkc">
            </div>
            <div class="form-group">
                <label>Mật khẩu mới</label>
                <input type="password" class="form-control" name="mkm">
            </div>
            <div class="form-group">
                <label>Nhập lại</label>
                <input type="password" class="form-control" name="mkm1">
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
        </form>
        <?php
        if (isset($_SESSION['loi'])) {  
            if($_SESSION['loi']=='Thành công!')
            echo '<div class="alert alert-success" role="alert">';
            else
            echo '<div class="alert alert-danger" role="alert">';
            echo $_SESSION['loi'];
            echo '</div>';
            unset($_SESSION['loi']);
        } ?>
    </div>
</div>
<!-- /.container-fluid -->
<?php require_once __DIR__ . "/layouts/footer.php" ?>