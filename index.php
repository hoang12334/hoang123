<?php include('head.php');?>
<head>
<title>Home | <?=$site_tenweb;?></title>
</head> 
<?php include('nav.php');?>

<?php 
$total_donhang = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT COUNT(*) FROM `orders` WHERE `username` = '".$my_username."' ")) ['COUNT(*)'];  
?>

 <div class="header bg-gradient pb-8 pt-5 pt-md-8" style="background-color: <?=$site_color;?>">
      <div class="container-fluid">
        <div class="header-body">
          <?php if(isset($_SESSION['username'])){?>
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">TỔNG TIỀN ĐÃ NẠP</h5>
                      <span class="h3 font-weight-bold mb-0"><?=format_cash($my_total_nap);?> <?=$site_currency;?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape text-dark rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-nowrap">Tổng tiền nạp toàn thời gian</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">SỐ DƯ HIỆN CÓ</h5>
                      <span class="h3 font-weight-bold mb-0"><?=format_cash($my_vnd);?> <?=$site_currency;?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape text-dark rounded-circle shadow">
                        <i class="fas fa-wallet"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-nowrap">Số dư của bạn hiện tại</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">TỔNG SỐ ORDER</h5>
                      <span class="h3 font-weight-bold mb-0"><?=format_cash($total_donhang);?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape text-dark rounded-circle shadow">
                        <i class="fas fa-file-invoice"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-nowrap">Tổng số hóa đơn toàn thời gian</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">CHIẾT KHẤU KHUYẾN MÃI</h5>
                      <span class="h3 font-weight-bold mb-0"><?=$my_ck;?>%</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape text-dark rounded-circle shadow">
                        <i class="fas fa-percent"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-nowrap">Chiết khấu giao dịch</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
            <?php } else { echo '<h1 class="text-center text-white">Vui lòng Đăng Nhập</h1>';}?>
            <br>
          <?php if ($site_thong_bao_chay != '') {?>
          <div class="alert alert-default alert-dismissible fade show" role="alert">
              <span class="alert-icon"><i class="ni ni-like-2"></i></span>
              <span class="alert-text"><?=$site_thong_bao_chay;?></span>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
        <?php }?>
        </div>
      </div>
    </div>

    <div class="container-fluid mt--7">
      <div class="row">

<?php
$result = mysqli_query($ketnoi,"SELECT * FROM `category` ");
while($row = mysqli_fetch_assoc($result))
{
?>
        <div class="col-xl-4 mt-3">
          <div class="card shadow">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h2 class="mb-0"><i class="ni ni-shop"></i> <?=$row['name'];?> <i class="ni ni-shop"></i></h2>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="card">
                <a href="/order/<?=$row['code'];?>" class="btn btn-primary"> XEM THÊM <i class="ni ni-check-bold"></i></a>
              </div>
            </div>
          </div>
        </div>
<?php }?>

      </div>
<?php if(isset($_SESSION['username'])){?>
      <div class="row mt-5">
        <div class="col-xl-7 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">ORDER GẦN ĐÂY</h3>
                </div>
                <div class="col text-right">
                  <a href="/nhat-ky/order/" class="btn btn-sm btn-primary">XEM THÊM</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">CODE</th>
                    <th scope="col">SERVICE</th>
                    <th scope="col">AMOUNT</th>
                    <th scope="col">STATUS</th>
                  </tr>
                </thead>
                <tbody>
<?php
$result = mysqli_query($ketnoi,"SELECT * FROM `orders` WHERE `username` = '".$my_username."' ORDER BY id desc limit 0, 5");
while($row = mysqli_fetch_assoc($result))
{
?>
                  <tr>
                    <th scope="row">
                      <?=$row['code'];?>
                    </th>
                    <td>
                      <?=$row['service_name'];?>
                    </td>
                    <td>
                      <?=$row['amount'];?>
                    </td>
                    <td>
                      <?=status($row['status']);?>
                    </td>
                  </tr>
<?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-xl-5">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">HOẠT ĐỘNG GẦN ĐÂY</h3>
                </div>
                <div class="col text-right">
                  <a href="/profile/" class="btn btn-sm btn-primary">XEM THÊM</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">NỘI DUNG</th>
                    <th scope="col">THỜI GIAN</th>
                  </tr>
                </thead>
                <tbody>
<?php
$result = mysqli_query($ketnoi,"SELECT * FROM `log` WHERE `username` = '".$my_username."' ORDER BY id desc limit 0, 5");
while($row = mysqli_fetch_assoc($result))
{
?>
                  <tr>
                    <td>
                      <?=$row['content'];?>
                    </td>
                    <td>
                      <?=$row['createdate'];?>
                    </td>
                    
                  </tr>
<?php }?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
<?php }?>

<?php include('foot.php');?>          