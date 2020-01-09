<?php require_once __DIR__ . "/../../../../libraries/database.php";
$db = new Database;
$category = $db->fetchAll("khuyenmai");

// Xoa
if (isset($_GET['id']) && isset($_GET['xoa'])) {
    $db->delete('khuyenmai', 'TenKM', $_GET['id']);
    header("Location: index.php");
    exit;
}
?>

<!-- header -->
<?php require_once __DIR__ . "/../../../layouts/header.php"; ?>

<div id="content-wrapper">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Quản lý</a>
        </li>
        <li class="breadcrumb-item active">Thêm</li>
        <li class="breadcrumb-item active">Chương trình khuyến mãi</li>
        <li class="breadcrumb-item active">
            <td>
                <a class="btn btn-success" href="/Nhom04_WebsiteBanXeMay/admin/modules/trangchu/khuyenmai/add.php">
                    <i class="fa fa-cart-plus" aria-hidden="true"> </i> Thêm
                </a>
            </td>

        </li>
    </ol>

    <!-- ND -->
    <div class="card mb-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Nội dung</th>
                            <th>Giảm</th>
                            <th>Thời gian</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($category as $item) : ?>
                            <tr>
                                <td><?php echo $item['TenKM'] ?></td>
                                <td><?php echo $item['MaKM'] ?></td>
                                <td><?php echo $item['NoiDung'] ?></td>
                                <td><?php echo $item['Giam'] ?> %</td>
                                <td>
                                    <?php echo $item['NgayBD'] . " - " . $item['NgayKT'] ?>
                                </td>
                                <td>
                                    <a class="btn btn-danger" href="/Nhom04_WebsiteBanXeMay/admin/modules/trangchu/khuyenmai/index.php?id=<?php echo $item['TenKM']; ?>&xoa=ok">
                                        <i class="fa fa-times"> </i>
                                    </a>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- footer -->
<?php require_once __DIR__ . "/../../../layouts/footer.php"; ?>