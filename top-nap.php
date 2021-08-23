<?php include('head.php');?>
<head>
<title>TOP Nạp Tiền | <?=$site_tenweb;?></title>
</head> 

<?php include('nav.php');?>


<div class="header bg-gradient pb-8 pt-5 pt-md-8" style="background-color: <?=$site_color;?>">  <!-- Mask -->
      <span class="mask bg-gradient opacity-8" style="background-color: <?=$site_color1;?>;"></span>
  <!-- Header container -->

</div>
<div class="container-fluid mt--7">
<?php if($site_status_top != 'ON')
{
  echo '<script type="text/javascript">swal("Thông Báo", "Chức năng tạm đóng bới BQT!", "warning");</script>';
  die();
}
?>
      <div class="row">
        <div class="col-xl-12 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
             <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">TOP NẠP TIỀN</h3>
                </div>
                <div class="col text-right">
                  <a href="/" class="btn btn-default">QUAY LẠI</a>
                </div>
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
				      <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">TOP</th>
                    <th scope="col">USER</th>
                    <th scope="col">TỔNG TIỀN NẠP</th>
                  </tr>
                </thead>
                <tbody>
<?php
$result = mysqli_query($ketnoi,"SELECT * FROM `users` WHERE `total_nap` > '0' ORDER BY total_nap desc limit 0, 100");
$i = 1;
while($row = mysqli_fetch_assoc($result)) { ?>
                  <tr>
                    <th scope="row">
                      <h3><?php echo $i;?></h3>
                    </th>
                    <td>
                      <span class="badge badge-pill badge-default"><?=$row['username'];?></span>
                    </td>
                    <td>
                      <span class="badge badge-pill badge-danger"><?=format_cash($row['total_nap']);?> <?=$site_currency;?></span>
                    </td>
                  </tr>
                  <?php $i++; ?>
<?php } ?>
                </tbody>
              </table>
            </div>
            </div>
          </div>
        </div>
    </div>
  
<?php include('foot.php');?>
