
<?php include('head.php');?>
<?php include('nav.php');?>

        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->

<?php 

$total_donhang = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT COUNT(*) FROM `orders` ")) ['COUNT(*)']; 
$total_donhangthanhcong = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT COUNT(*) FROM `orders` WHERE `status` = 'thanhcong' ")) ['COUNT(*)']; 

$total_thanhvien = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT COUNT(*) FROM `users` ")) ['COUNT(*)']; 
$total_thanhvienbanned = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT COUNT(*) FROM `users` WHERE `banned` = '1' ")) ['COUNT(*)']; 
$total_tiennap = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT SUM(total_nap) FROM `users` ")) ['SUM(total_nap)']; 
$total_vnd = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT SUM(money) FROM `users` ")) ['SUM(money)']; 
$total_doanhthu = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT SUM(money) FROM `orders` ")) ['SUM(money)']; 
$total_refund = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT SUM(money) FROM `orders` WHERE `status` = 'thatbai' ")) ['SUM(money)']; 

?>
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?=format_cash($total_donhang);?></h3>

                <p>TỔNG ĐƠN HÀNG</p>
              </div>
              <a href="#" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?=format_cash($total_donhangthanhcong);?></h3>

                <p>ĐƠN HÀNG THÀNH CÔNG</p>
              </div>
              <a href="#" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?=format_cash($total_thanhvien);?></h3>

                <p>TỔNG THÀNH VIÊN</p>
              </div>
              <a href="#" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?=format_cash($total_thanhvienbanned);?></h3>

                <p>THÀNH VIÊN BỊ VÔ HIỆU HÓA</p>
              </div>
              <a href="#" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?=format_cash($total_tiennap);?>đ</h3>

                <p>TỔNG TIỀN NẠP</p>
              </div>
              <a href="#" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?=format_cash($total_vnd);?>đ</h3>

                <p>TỔNG SỐ DƯ THÀNH VIÊN</p>
              </div>
              <a href="#" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?=format_cash($total_doanhthu);?>đ</h3>

                <p>DOANH THU TỪ ĐƠN HÀNG</p>
              </div>
              <a href="#" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?=format_cash($total_refund);?>đ</h3>

                <p>TỔNG TIỀN HOÀN TRẢ</p>
              </div>
              <a href="#" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
<script> 
$(document).ready(function(){
setInterval(function(){
      $("#table_auto").load(window.location.href + " #table_auto" );
}, 1000);
});
</script>
        <div class="row">
<section class="col-lg-12 connectedSortable">
<form class="form-horizontal" action="" method="post">  
<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">Nhật Ký Hoạt Động</h3>
  </div>
  <div class="card-body">
    <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap" id="table_auto">
      <thead>
        <tr>
          <th>Username</th>
          <th>Content</th>
          <th>Time</th>
        </tr>
      </thead>
      <tbody>
<?php $A12A6 = mysqli_query($ketnoi,"SELECT * FROM `log`   ORDER BY id desc limit 0, 1000 ");
while ($row1 = mysqli_fetch_array($A12A6) ) 
{?>
        <tr>
          <td><a href="edit-thanh-vien.php?username=<?=$row1['username'];?>" >
          <?=$row1['username'];?>
          </td>
          <td><?=$row1['content'];?></td>
          <td><?=$row1['createdate'];?></td>
        </tr>
<?php }?>
      </tbody>
    </table>
  </div>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
</form>
</section>

        </div>
        <!-- /.row (main row) -->
<?php include('foot.php');?>