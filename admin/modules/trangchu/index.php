<?php require_once __DIR__ . "/../../../libraries/database.php";
$db = new Database;
$category = $db->fetchAll("anh_slide");
?>

<!-- header -->
<?php require_once __DIR__ . "/../../layouts/header.php"; ?>

<div id="content-wrapper">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Quản lý</a>
        </li>
        <li class="breadcrumb-item active">Cài đặt trang chủ</li>
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
                            <th>Link</th>
                            <th>Ảnh</th>
                            <th>Sửa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($category as $item) : ?>
                            <tr>
                                <td><?php echo $item['STT'] ?></td>
                                <td><?php echo $item['Loai'] ?></td>
                                <td><?php echo $item['Link'] ?></td>
                                <td><img id="blah" src="/Nhom04_WebsiteBanXeMay/img/<?php echo $item['Ten'] ?>" class="img-rounded" style="width:100%;height:auto;"></td>
                                <td>
                                    <a class="btn btn-primary" href="/Nhom04_WebsiteBanXeMay/admin/modules/trangchu/edit.php?id=<?php echo $item['STT']; ?>"><i class="fa fa-edit"></i>Sửa</a>
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
<?php require_once __DIR__ . "/../../layouts/footer.php"; ?>