
<?php include('head.php');?>
<head>
<title>Đăng Ký | <?=$site_tenweb;?></title>
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
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <?=$site_text_login;?>
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
                <small>Vui lòng nhập thông tin để đăng ký tài khoản</small>
              </div>

<?php
if (isset($_POST["submit"]))
{
    $username = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['username']))));
    $password = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['password']))));
    $email = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['email']))));

    $password = md5($password);
    $query_user_dangky = mysqli_query($ketnoi,"SELECT * FROM `users` WHERE `username` = '".$username."' ");
    $query_email_dangky = mysqli_query($ketnoi,"SELECT * FROM `users` WHERE `mail` = '".$username."' ");
    $biensosanh = str_replace(" ", "", $username);


    if(mysqli_num_rows($query_user_dangky)  > 0)
    {
        echo '<script type="text/javascript">swal("Thất Bại", " Tên đăng nhập này đã được sử dụng!", "error");</script>';
    }
    else if(mysqli_num_rows($query_email_dangky)  > 0)
    {
        echo '<script type="text/javascript">swal("Thất Bại", " Email đã tồn tại!", "error");</script>';
    }
    else if($username != $biensosanh)
    {
        echo '<script type="text/javascript">swal("Thất Bại", " Không được chứa khoản trắng", "error");</script>';
    }
    else if($username == '')
    {
        echo '<script type="text/javascript">swal("Thất Bại", " Vui lòng nhập tên đăng nhập!", "error");</script>';
    }
    else if($email == '')
    {
        echo '<script type="text/javascript">swal("Thất Bại", " Vui lòng nhập tên Email!", "error");</script>';
    }
    else if($password == '')
    {
        echo '<script type="text/javascript">swal("Thất Bại", " Vui lòng nhập mật khẩu!", "error");</script>';
    }
    else
    {
      $create = $ketnoi->query("INSERT INTO `users` SET 
      `username` = '".$username."',
      `password` = '".$password."',
      `mail` = '".$email."',
      `ip` = '".$ip_address."',
      `createdate` = now() ");
      $ketnoi->query("INSERT INTO `log` SET 
      `content`= 'Đăng ký tài khoản!',
      `createdate` = now(),
      `username`= '".$username."' ");

      if ($create)
      {
        $_SESSION['username'] = $username;
        echo '<script type="text/javascript">swal("Thành Công","Đăng ký tài khoản thành công","success");setTimeout(function(){ location.href = "/" },1000);</script>';
      }
      else
      {
        echo '<script type="text/javascript">swal("Thất Bại","Vui lòng liên hệ kỹ thuật","error");setTimeout(function(){ location.href = "" },1000);</script>'; 
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
                    <input class="form-control" placeholder="Tài khoản" name="username" type="text" required="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Email" name="email" type="email" required="">
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
                <div class="row my-4">
                  <div class="col-12">
                    <div class="custom-control custom-control-alternative custom-checkbox">
                      <input class="custom-control-input" id="customCheckRegister" type="checkbox">
                      <label class="custom-control-label" for="customCheckRegister">
                        <span class="text-muted">Chấp nhận <a href="#!">điều khoản</a> khi đăng ký</span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary mt-4" name="submit">Đăng Ký</button>
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