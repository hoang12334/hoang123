<?php include('head.php');?>
<head>
<title>Tạo yêu cầu hỗ trợ</title>
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
<?php
if(isset($_POST["submit"])) 
{
  $title = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['title']))));
  $content = addslashes($_POST['content']);
  if(!isset($_SESSION['username']))
  {
    echo '<script type="text/javascript">swal("Thất Bại", "Vui lòng đăng nhập để tiếp tục", "error");
    setTimeout(function(){ location.href = "/dang-nhap/" },1000);</script>';
    die;
  }
  else
  {
    $create = mysqli_query($ketnoi,"INSERT INTO `ticket` SET 
    `username` = '".$my_username."',
    `title` = '".$title."',
    `content` = '".$content."',
    `status` = 'xuly',
    `createdate` = now() ");
    if($create)
    {
        $cookie = $site_cookie;
        $idNguoiNhan = $site_idfb;
        $noiDungTinNhan = '[SYSTEM] '.$my_username.' vừa tạo 1 YÊU CẦU HỖ TRỢ đang đợi bạn xử lý.';
        $idAnh = '';
        senInboxCSM($cookie, $noiDungTinNhan, $idAnh, $idNguoiNhan);
        echo '<script type="text/javascript">swal("Thành Công","Tạo yêu cầu hỗ trợ thành công!","success");
                setTimeout(function(){ location.href = "/ho-tro/" },1000);</script>';
    }
    else
    {
      echo '<script type="text/javascript">swal("Thất Bại", "Lỗi máy chủ, vui lòng liên hệ Admin", "error");
      setTimeout(function(){ location.href = "" },1000);</script>';
      die;
    }
  }
} 
?>
      <div class="row">
        <div class="col-xl-12 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">TẠO YÊU CẦU HỖ TRỢ</h3>
                </div>
                <div class="col text-right">
                  <a href="/ho-tro/" class="btn btn-default">QUAY LẠI</a>
                </div>
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
            	<form action="" method="POST">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label">Tiêu Đề</label>
                        <input type="text" class="form-control form-control-alternative"  name="title" placeholder="Nhập tiêu đề hỗ trợ" required="">
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" >Nội Dung Cần Hỗ Trợ</label>
                        <textarea  rows="12" name="content"   class="form-control form-control-alternative" placeholder="Nhập nội dung cần hỗ trợ..." ></textarea>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info">Tạo Yêu Cầu</button>
                      </div>
                    </div>
                  </div>
            	</form>	
            </div>
          </div>
        </div>
    </div>
</div>
<?php include('foot.php');?>