<?php include('head.php');?>
<head>
<title>Profile | <?=$site_tenweb;?></title>
</head> 
<?php include('nav.php');?>

<?php if(!isset($_SESSION['username']))
{
    echo '<script type="text/javascript">swal("Thất Bại", "Vui lòng đăng nhập để tiếp tục.", "error");
        setTimeout(function(){ location.href = "/dang-nhap/" },100);</script>';
    die();
}
?>


 <!-- End Navbar -->
    <!-- Header -->
<div class="header bg-gradient pb-8 pt-5 pt-md-8" style="background-color: <?=$site_color;?>">      <!-- Mask -->
      <span class="mask bg-gradient opacity-8" style="background-color: <?=$site_color1;?>;"></span>
      <!-- Header container -->

    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <?php if ($my_idfb != '') { ?>
                    <img src="https://graph.facebook.com/<?=$my_idfb;?>/picture?type=large&width=200&height=200" width="200%" class="rounded-circle">
                    <?php } else { ?>
                    <img src="https://i.imgur.com/k9AlaAq.png" width="200px" height="200px" class="rounded-circle">
                    <?php }?>
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">

              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">

                   
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h3>
                  <?=$my_username;?>
                </h3>
                <h3>
                  <?=format_cash($my_vnd);?> <?=$site_currency;?>
                </h3>
                <hr class="my-4" />
                
                <a href="/dang-xuat/"  class="btn btn-info">THOÁT</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Thông Tin Tài Khoản</h3>
                </div>
                <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-primary">Settings</a>
                </div>
              </div>
            </div>
            <div class="card-body">
<div class="nav-wrapper">
    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
        <li class="nav-item">
            <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-settings-gear-65 mr-2"></i>CÀI ĐẶT</a>
        </li>
        <li class="nav-item">
            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-calendar-grid-58 mr-2"></i>NHẬT KÝ</a>
        </li>
    </ul>
</div>

          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                <?php
if (isset($_POST["submit"])) 
{
  $newmk = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['newmk']))));
  $password = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['password']))));
  $fullname = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['fullname']))));
  $phone = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['phone']))));
  $idfb = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['idfb']))));
  $check_pass = mysqli_fetch_assoc(mysqli_query($ketnoi,"SELECT `password` FROM `users` WHERE `username` = '".$_SESSION['username']."'"))['password'];

  $password = md5($password);

  if(!isset($_SESSION['username']))
  {
    echo '<script type="text/javascript">swal("Thất Bại", "Vui lòng đăng nhập để tiếp tục", "error");
    setTimeout(function(){ location.href = "/dang-nhap/" },1000);</script>';
    die;
  }
  else if ($password != $check_pass) 
  {
    echo '<script type="text/javascript">swal("Lỗi", " Mật khẩu cũ không chính xác", "error");</script>';
  }
  else 
  {
    mysqli_query($ketnoi,"UPDATE users SET 
      password =  '".$newmk."',
      fullname =  '".$fullname."',
      phone =  '".$phone."',
      id_facebook =  '".$idfb."'

      WHERE username = '".$_SESSION['username']."'");
    echo '<script type="text/javascript">swal("Thành Công","Thay đổi đã được lưu!","success");
    setTimeout(function(){ location.href = "" },2000);</script>';
  } 
}
?>

             <form role="form" action="" method="post">
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Username</label>
                        <input type="text" id="input-username" class="form-control form-control-alternative" value="<?=$my_username;?>" disabled>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email</label>
                        <input type="email" id="input-email" class="form-control form-control-alternative" value="<?=$my_mail;?>" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Họ và Tên</label>
                        <input type="text" id="input-first-name" class="form-control form-control-alternative" name="fullname" placeholder="Nhập họ và tên của bạn" value="<?=$my_fullname;?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Số Điện Thoại</label>
                        <input type="number" id="input-first-name" class="form-control form-control-alternative" name="phone" placeholder="Nhập số điện thoại của bạn" value="<?=$my_phone;?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">ID Facebook</label>
                        <input type="number" id="input-first-name" class="form-control form-control-alternative" placeholder="Nhập ID Facebook của bạn" name="idfb" value="<?=$my_idfb;?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Mật khẩu mới</label>
                        <input type="password" id="input-first-name" class="form-control form-control-alternative" name="newmk" placeholder="Nhập mật khẩu mới cần đổi" required="">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Mật khẩu cũ</label>
                        <input type="password" id="input-first-name" class="form-control form-control-alternative" name="password" placeholder="Nhập mật khẩu hiện tại của bạn"  required="">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <button  type="submit" name="submit" class="btn btn-info">Lưu Thông Tin</button>
              </form>
            </div>
            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
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
$result = mysqli_query($ketnoi,"SELECT * FROM `log` WHERE `username` = '".$my_username."' ORDER BY id desc limit 0, 100");
while($row = mysqli_fetch_assoc($result))
{
?>
                  <tr>
                    <td>
                      <?=$row['content'];?>
                    </td>
                    <td>
                      <span class="badge badge-default text-white"><?=$row['createdate'];?></span>
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
        </div>

      </div>

<?php include('foot.php');?>          