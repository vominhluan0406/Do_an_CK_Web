<?php require_once __DIR__ . "/../../../libraries/database.php";
$db = new Database;
$user = $db->fetchAll("khachhang");
?>
<?php require_once __DIR__ . "/../../layouts/header.php"; ?>
<div id="content-wrapper">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Quản lý</a>
    </li>
    <li class="breadcrumb-item active">Khách hàng</li>
  </ol>
  <div class="card mb-3">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Tai Khoan</th>
              <th>Tên</th>
              <th>CMND</th>
              <th>Địa chỉ</th>
              <th>Email</th>
              <th>Số điện thoại</th>
              <th>Xóa,sửa</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($user as $item) : 
              if($item['UserName']!='quest'){
            ?>
              <tr>
                <td><?php echo $item['MaKH']; ?></td>
                <td><?php echo $item['UserName'] ?></td>
                <td><?php echo $item['HoTen'] ?></td>
                <td><?php echo $item['CMND'] ?></td>
                <td><?php echo $item['DiaChi'] ?></td>
                <td><?php echo $item['Email'] ?></td>
                <td><?php echo $item['SDT'] ?></td>
                <td>
                  <a class="btn btn-primary" href="/Nhom04_WebsiteBanXeMay/admin/modules/user/edit.php?id=<?php echo $item['MaKH'];?>"><i class="fa fa-edit"></i>Sửa</a>
                  <a class="btn btn-danger" href="/Nhom04_WebsiteBanXeMay/admin/modules/user/delete.php?id=<?php echo $item['MaKH'];?>"><i class="fa fa-times"></i>Xóa</a>
                </td>
              </tr>
            <?php }endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="alert alert-success" role="alert" style="display:none" id="alert">
    <h4 class="alert-heading">Đã xóa</h4>
  </div>
</div>

<!-- Xóa -->
<script>
  function xoa(){
    let booll = confirm('Bạn muốn xóa khách hàng <?php echo $item['HoTen']?>?');
    if(booll){
    <?php 
      $db->delete('giohang','UserName',$item['UserName']);
    ?>
    $('.alert').css('display','block');
    setTimeout(function(){
      location.reload();
    },1000);
    }
  }
</script>

<?php require_once __DIR__ . "/../../layouts/footer.php"; ?>