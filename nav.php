
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light" id="sidenav-main" style="background: <?=$site_color_nav;?>">
<?php
if ($site_baotri == 'ON')
{
  echo '<script type="text/javascript">swal("Thông Báo", "Hệ thống đang bảo trì định kỳ, xin quý khách vui lòng quay lại sau.", "warning");</script>';
  die();
} 
?>
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="/home/">
        <img src="<?=$site_logo;?>" class="navbar-brand-img" alt="...">
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
<?php if($my_level == 'admin') { ?>
          <li class="nav-item dropdown">
            <a class="nav-link nav-link-icon" href="/admin/" >
              <i class="ni ni-settings"></i>
            </a>
          </li>
<?php } ?>
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-icon" href="#" type="button"  data-toggle="modal" data-target="#modal-notification">
            <i class="ni ni-bell-55"></i>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="rounded-circle">
                <?php if ($my_idfb != '') { ?>
                <img src="https://graph.facebook.com/<?=$my_idfb;?>/picture?type=large&width=45&height=45" width="100%" class="rounded-circle">
                <?php } else { ?>
                <img src="https://i.imgur.com/k9AlaAq.png" width="45px" height="45px" class="rounded-circle">
                <?php }?>
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <div class="navi navi-spacer-x-0 pt-2">
                <h6 class="mb-0 text-center">
                  <?php if ($my_idfb != '') { ?>
                  <img src="https://graph.facebook.com/<?=$my_idfb;?>/picture?type=large&width=100&height=100" width="55" class="rounded-circle">
                  <?php } else { ?>
                  <img src="https://i.imgur.com/k9AlaAq.png" width="45px" height="45px" class="rounded-circle">
                  <?php }?>
                  </h6>
                  <h5 class="text-center pt-3"><?=$my_username;?></h5>
                  <h4 class="text-center"  style="color: <?=$site_color;?>;"><?=format_cash($my_vnd);?></h4>
                </div>
            </div>
            <?php if(isset($_SESSION['username'])){?>
              <a href="/profile/" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>Tài khoản</span>
              </a>
              <a href="/nap-tien/" class="dropdown-item">
                <i class="ni ni-money-coins"></i>
                <span>Nạp tiền</span>
              </a>
              <a href="/ho-tro/" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>Tạo hỗ trợ</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="/dang-xuat/" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Đăng xuất</span>
              </a>
              <?php } else { ?>
              <a href="/dang-nhap/" class="dropdown-item">
                <i class="ni ni-circle-08"></i>
                <span>Đăng nhập</span>
              </a>
              <a href="/dang-ky/" class="dropdown-item">
                <i class="ni ni-key-25"></i>
                <span>Đăng ký</span>
              </a>
              <?php }?>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="/home/">
                <img src="<?=$site_logo;?>">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Form -->
        <form class="mt-4 mb-3 d-md-none">
          <div class="input-group input-group-rounded input-group-merge">
            <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <span class="fa fa-search"></span>
              </div>
            </div>
          </div>
        </form>
        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item  active ">
            <a class="nav-link  active " href="/home/">
              <i class="ni ni-tv-2 text-primary"></i> DASHBOARD
            </a>
          </li>
<?php if ($site_status_top == 'ON') {?>
          <li class="nav-item">
            <a class="nav-link" href="/top-nap/">
              <i class="ni ni-trophy"></i> TOP NẠP
            </a>
          </li>
<?php }?>
<?php if(isset($_SESSION['username'])){?>
          <li class="nav-item">
            <a class="nav-link" href="/nap-tien/">
              <i class="ni ni-money-coins"></i> NẠP TIỀN
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/ho-tro/">
              <i class="ni ni-support-16"></i> HỖ TRỢ
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/nhat-ky/order/">
              <i class="ni ni-time-alarm"></i> NHẬT KÝ ORDER
            </a>
          </li>
<?php }?>
        </ul>
      <hr class="my-3">
        <ul class="navbar-nav">
<?php
$result = mysqli_query($ketnoi,"SELECT * FROM `category` ");
while($row = mysqli_fetch_assoc($result))
{
?>
          <li class="nav-item">
            <a class="nav-link" href="/order/<?=$row['code'];?>">
               <i><img src="<?=$row['img'];?>" width='30px' ></i> <?=$row['name'];?>
            </a>
          </li>
<?php }?>

        </ul>


      </div>
    </div>
  </nav>
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#"><i class="ni ni-notification-70"></i> Xin chào <?=$my_username;?>!</a>
        <!-- 
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
          <div class="form-group mb-0">
            <div class="input-group input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input class="form-control" placeholder="Search" type="text">
            </div>
          </div>
        </form>-->
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
<?php if($my_level == 'admin') { ?>
          <li class="nav-item dropdown">
            <a class="nav-link nav-link-icon" href="/admin/" >
              <i class="ni ni-settings"></i>
            </a>
          </li>
<?php } ?>
          <li class="nav-item dropdown">
            <a class="nav-link nav-link-icon" href="#" type="button"  data-toggle="modal" data-target="#modal-notification">
              <i class="ni ni-bell-55"></i>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="rounded-circle">
                  <?php if ($my_idfb != '') { ?>
                  <img src="https://graph.facebook.com/<?=$my_idfb;?>/picture?type=large&width=45&height=45" width="100%" class="rounded-circle">
                  <?php } else { ?>
                  <img src="https://i.imgur.com/k9AlaAq.png" width="45px" height="45px" class="rounded-circle">
                  <?php }?>
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">
                    
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
              <div class="navi navi-spacer-x-0 pt-3">
                <h6 class="mb-0 text-center">
                  <?php if ($my_idfb != '') { ?>
                  <img src="https://graph.facebook.com/<?=$my_idfb;?>/picture?type=large&width=100&height=100" width="55" class="rounded-circle">
                  <?php } else { ?>
                  <img src="https://i.imgur.com/k9AlaAq.png" width="45px" height="45px" class="rounded-circle">
                  <?php }?>
                  </h6>
                  <h5 class="text-center pt-3"><?=$my_username;?></h5>
                  <h4 class="text-center"  style="color: <?=$site_color;?>;"><?=format_cash($my_vnd);?></h4>
                </div>
            </div>

              <?php if(isset($_SESSION['username'])){?>
              <a href="/profile/" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>Tài khoản</span>
              </a>
              <a href="/nap-tien/" class="dropdown-item">
                <i class="ni ni-money-coins"></i>
                <span>Nạp tiền</span>
              </a>
              <a href="/ho-tro/" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>Tạo hỗ trợ</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="/dang-xuat/" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Đăng xuất</span>
              </a>
              <?php } else { ?>
              <a href="/dang-nhap/" class="dropdown-item">
                <i class="ni ni-circle-08"></i>
                <span>Đăng nhập</span>
              </a>
              <a href="/dang-ky/" class="dropdown-item">
                <i class="ni ni-key-25"></i>
                <span>Đăng ký</span>
              </a>
              <?php }?>

            </div>
          </li>
        </ul>
      </div>
    </nav>

<div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
<div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger">
          
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification">Thông Báo</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <div class="modal-body">
              
                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <p><?=$site_thongbao;?></p>
                </div>
                
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Đóng</button>
            </div>
            
        </div>
    </div>
</div>


<div class="pageloader"></div>