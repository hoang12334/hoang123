<?php include('head.php');?>
<head>
<title>Danh Sách Yêu Cầu Hỗ Trợ | <?=$site_tenweb;?></title>
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
          <div class="card card-profile shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">YÊU CẦU HỖ TRỢ</h3>
                </div>
                <div class="col text-right">
                  <a href="/ho-tro/create/" class="btn btn-default">TẠO MỚI</a>
                </div>
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
				<div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">KHÁCH HÀNG</th>
                    <th scope="col">TIÊU ĐỀ</th>
                    <th scope="col">THỜI GIAN</th>
                    <th scope="col">TRẠNG THÁI</th>
                  </tr>
                </thead>
                <tbody>
<?php
$result = mysqli_query($ketnoi,"SELECT * FROM `ticket` WHERE `username` = '".$my_username."' ORDER BY id desc limit 0, 100");
while($row = mysqli_fetch_assoc($result))
{
?>
                  <tr>
                    <th scope="row">
                      <div class="media align-items-center">
                        <a href="#" class="avatar rounded-circle mr-3">
                          <img alt="Image placeholder" src="//graph.facebook.com/<?=$my_idfb;?>/picture">
                        </a>
                      </div>
                    </th>
                    <td>
                      <a href="/ho-tro/view/<?=$row['id'];?>"><?=$row['title'];?>
                    </td>
                    <td>
                      <?=$row['createdate'];?>
                    </td>
                    <td>
                      <span class="badge badge-dot mr-4">
                        <?php
                        	if ($row['status'] == 'xuly')
                        	{
                        		echo '<i class="bg-info"></i> ĐANG XỬ LÝ';
                        	}
                        	else if ($row['status'] == 'traloi')
                        	{
                        		echo '<i class="bg-warning"></i> ĐÃ TRẢ LỜI';
                        	}
                        	else if ($row['status'] == 'dong')
                        	{
                        		echo '<i class="bg-danger"></i> ĐÓNG';
                        	}
                          else if ($row['status'] == 'hoantat')
                          {
                            echo '<i class="bg-success"></i> ĐÃ GIẢI QUYẾT';
                          }
                        ?>
                      </span>
                    </td>
                  </tr>
<?php }?>
                </tbody>
              </table>
            </div>
            </div>
          </div>
        </div>
    </div>
 
<?php include('foot.php');?>
