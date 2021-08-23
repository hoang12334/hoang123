
<?php include('head.php');?>
<head>
<title>Đăng Nhập | <?=$site_tenweb;?></title>
</head> 
<body style="background:url(<?=$bg_login;?>); background-repeat: no-repeat; background-size: cover;">
  <div class="main-content" >
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark" style="background-color:#2f2f2f00;">
      <div class="container px-4" >
        <a class="navbar-brand" href="/home/">
          <img src="<?=$site_logo;?>" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main" >
          <!-- Collapse header -->
          <div class="navbar-collapse-header d-md-none" >
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="/home/">
                  <img src="<?=$site_logo;?>" width="100%">
                </a>
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>
          <!-- Navbar items -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="/home/">
                <i class="ni ni-planet"></i>
                <span class="nav-link-inner--text">TRANG CHỦ</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="/dang-ky/">
                <i class="ni ni-circle-08"></i>
                <span class="nav-link-inner--text">ĐĂNG KÝ</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="/dang-nhap/">
                <i class="ni ni-key-25"></i>
                <span class="nav-link-inner--text">ĐĂNG NHẬP</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient py-7 py-lg-8">
      <div class="container" >
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <p class="text-white"><?=$site_text_login;?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <!-- Table -->
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
          <div class="card bg-secondary shadow border-0">
            <!--<div class="card-header bg-transparent pb-5">
              <div class="text-muted text-center mt-2 mb-4"><small>Sign up with</small></div>
              <div class="text-center">
                <a href="#" class="btn btn-neutral btn-icon mr-4">
                  <span class="btn-inner--icon"><img src="../assets/img/icons/common/github.svg"></span>
                  <span class="btn-inner--text">Github</span>
                </a>
                <a href="#" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--icon"><img src="../assets/img/icons/common/google.svg"></span>
                  <span class="btn-inner--text">Google</span>
                </a>
              </div>
            </div>-->
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small>VUI LÒNG NHẬP THÔNG TIN ĐỂ ĐĂNG NHẬP</small>
              </div>

<?php

if (isset($_POST["submit"]))
{
    $username = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['username']))));
    $password = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['password']))));

    $password = md5($password);

    if ($username == "" || $password =="") 
    {
        echo '<script type="text/javascript">swal("Lỗi", " Không được để trống tên đăng nhập hoặc mật khẩu", "error");
        setTimeout(function(){ location.href = "" },2000);</script>';
        die();
    }
    else
    {
        $sql = "select * from users where username = '$username' and password = '$password' ";
        $query = mysqli_query($ketnoi,$sql);
        $num_rows = mysqli_num_rows($query);

        if ($num_rows == 0) 
        {
            echo '<script type="text/javascript">swal("Thất Bại", " Thông tin đăng nhập không chính xác !!!", "error");</script>';

        }
        else
        {
            $_SESSION['username'] = $username;
            mysqli_query($ketnoi,"UPDATE `users` SET ip =  '".$ip_address."' WHERE `username` = '".$username."'");


            $ketnoi->query("INSERT INTO `log` SET 
              `content`= 'Đăng nhập vào hệ thống!',
              `createdate` = now(),
              `username`= '".$_SESSION['username']."' ");

            echo '<script type="text/javascript">swal("Thành Công","Đăng Nhập Thành Công","success");
                setTimeout(function(){ location.href = "/home/" },1000);</script>';
            exit();
        }
    }
}
?> 


              <form role="form" action="" method="post">
                <div class="form-group">
                  <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                    </div>
                    <input class="form-control" placeholder="Tài khoản" name="username" type="text"  required="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Password" name="password" type="password" required="">
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary mt-4" name="submit">ĐĂNG NHẬP</button>
                  <a type="button" class="btn btn-info mt-4" href="/quen-mat-khau/">QUÊN MẬT KHẨU</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--   Core   -->
 
  <script src="/assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--   Optional JS   -->
  <!--   Argon JS   -->
  <script src="/assets/js/argon-dashboard.min.js?v=1.1.2"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
  </script>
</body>