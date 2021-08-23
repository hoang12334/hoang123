<?php include('head.php');?>
<head>
<title>Nhật Ký Order | <?=$site_tenweb;?></title>
</head> 

<?php include('nav.php');?>

<?php if(!isset($_SESSION['username']))
{
    echo '<script type="text/javascript">swal("Thất Bại", "Vui lòng đăng nhập để tiếp tục.", "error");
        setTimeout(function(){ location.href = "/dang-nhap/" },100);</script>';
    die();
}
?>
<div class="header bg-gradient pb-8 pt-5 pt-md-8" style="background-color: <?=$site_color;?>">  <!-- Mask -->
      <span class="mask bg-gradient opacity-8" style="background-color: <?=$site_color1;?>;"></span>
  <!-- Header container -->

</div>
<div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-12 order-xl-2 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">NHẬT KÝ ĐƠN HÀNG</h3>
                </div>
                <div class="col text-right">
                  <a href="/" class="btn btn-sm btn-primary">HOME</a>
                </div>
              </div>
            </div>
				      <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th class="text-center" scope="col">MÃ GD</th>
                    <th class="text-center" scope="col">DỊCH VỤ</th>
                    <th class="text-center" scope="col">INPUT</th>
                    <th class="text-center" scope="col">SỐ LƯỢNG</th>
                    <th class="text-center" scope="col">TỔNG TIỀN</th>
                    <th class="text-center" scope="col">THỜI GIAN TẠO</th>
                    <th class="text-center" scope="col">CẬP NHẬT</th>
                    <th class="text-center" scope="col">TRẠNG THÁI</th>
                    <th class="text-center" scope="col">GHI CHÚ</th>
                  </tr>
                </thead>
                <tbody>
<?php
$result = mysqli_query($ketnoi,"SELECT * FROM `orders` WHERE `username` = '".$my_username."' ORDER BY id desc limit 0, 100");
while($row = mysqli_fetch_assoc($result))
{
?>
                  <tr>
                    <th scope="row">
                      <?=$row['code'];?>
                    </th>
                    <td class="text-center">
                      <span class="badge badge-default"><b class="text-white"><?=$row['service_name'];?></b></span>
                    </td>
                    <td class="text-center"><?=$row['url'];?></td>
                    <td class="text-center">
                      <b style="color: blue;"><?=format_cash($row['amount']);?></b>
                    </td>
                    <td class="text-center">
                      <b style="color: red;"><?=format_cash($row['money']);?></b> <?=$site_currency;?>
                    </td>
                    <td class="text-center"><?=$row['createdate'];?></td>
                    <td class="text-center"><?=$row['updatedate'];?></td>
                    <td class="text-center"><?=status($row['status']);?></td>
                    <td class="text-center"><?=$row['note_status'];?></td>
                  </tr>
<?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
   
<?php include('foot.php');?>
