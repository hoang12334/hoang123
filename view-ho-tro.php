<?php include('head.php');?>

<head>
<title>Yêu cầu hỗ trợ #<?=$_GET['id'];?></title>
</head> 
<?php include('nav.php');?>
<?php if(!isset($_SESSION['username']))
{
    echo '<script type="text/javascript">swal("Thất Bại", "Vui lòng đăng nhập để tiếp tục.", "error");
        setTimeout(function(){ location.href = "/dang-nhap/" },100);</script>';
    die();
}
?>
<style type="text/css">
  .scroll-cards {
  width: 370px;
  height: 100%;
  overflow: auto;

  padding: 20px 0px 5px 0px;
}
.card {
  background-color: white;
  border-radius: 4px;
  margin-top: 8px;
  margin-bottom: 5px;
  padding: 25px 25px 15px 25px;
  transition: 0.3s;
}
.card:hover {
  box-shadow: 5px 1px 20px 1px #ddd;
  transform: scale(0.96);
}

.mail-names {
  color: grey;
  font-weight: bold;
  font-size: 15px;
  margin-left: 10px;
}

.mails {
  display: flex;
  align-items: center;
}
.mails > img {
  width: 35px;
  border-radius: 10px;
}
.mail-info {
  margin: 10px 65px;
  margin-left: 0px;
  line-height: 1.7;
  font-weight: 600;
}

</style>
<div class="header bg-gradient pb-8 pt-5 pt-md-8" style="background-color: <?=$site_color;?>">  <!-- Mask -->

      <span class="mask bg-gradient opacity-8" style="background-color: <?=$site_color1;?>;"></span>

  <!-- Header container -->

</div>
<?php
if (isset($_GET['id'])) 
{
    $id = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_GET['id']))));
    $conntent_1 = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT `content` FROM `ticket` WHERE `id` = '".$id."'  ")) ['content'];
    $time_ticket = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT `createdate` FROM `ticket` WHERE `id` = '".$id."'  ")) ['createdate'];
    $title_ticket = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT `title` FROM `ticket` WHERE `id` = '".$id."'  ")) ['title'];
    $status_ticket = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT `status` FROM `ticket` WHERE `id` = '".$id."'  ")) ['status'];
}

if(isset($_POST["submit"])) 
{
  $content = addslashes($_POST['content']);
  if(!isset($_SESSION['username']))
  {
    echo '<script type="text/javascript">swal("Thất Bại", "Vui lòng đăng nhập để tiếp tục", "error");
    setTimeout(function(){ location.href = "/dang-nhap/" },1000);</script>';
    die;
  }
  if($status_ticket == 'dong')
  {
    echo '<script type="text/javascript">swal("Thất Bại", "TICKET NÀY ĐÃ ĐƯỢC ĐÓNG, BẠN KHÔNG THỂ TRẢ LỜI TIẾP TICKET NÀY, VUI LÒNG TẠO MỚI!", "error");
    setTimeout(function(){ location.href = "/ho-tro/" },3000);</script>';
    die;
  }
  else
  {
    $create = mysqli_query($ketnoi,"INSERT INTO `reply_ticket` SET 
    `id_ticket` = '".$id."',
    `username` = '".$my_username."',
    `content` = '".$content."',
    `createdate` = now() ");

    mysqli_query($ketnoi,"UPDATE `ticket` SET 
            `status` = 'xuly' WHERE `id` = '".$id."' ");
    if($create)
    {
        echo '<script type="text/javascript">swal("Thành Công","","success");
                setTimeout(function(){ location.href = "" },0);</script>';
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
<div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-8">
          <div class="card card-profile shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Phiếu #<?=$id;?></h3>
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
                        <textarea rows="3" name="content" class="form-control form-control-alternative" placeholder="Nhập câu trả lời..." ></textarea>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info">Submit</button>
                      </div>
                    </div>
                  </div>
              </form> 
            </div>
          </div>
        </div>

        <div class="col-xl-4">
          <div class="card card-info shadow">
            <div class="card-header">
              <div class="d-flex justify-content-between">
                <h2 class="float-left"><?=$title_ticket;?></h2>
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <?=$conntent_1;?>
                  </div>
                  <hr>
                  <i class="text-right">Thời gian: <?=$time_ticket;?></i>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php
$result = mysqli_query($ketnoi,"SELECT * FROM `reply_ticket` WHERE `id_ticket` = '".$id."' ORDER BY id desc limit 0, 100 ");
while($row = mysqli_fetch_assoc($result))
{
  $get_img_user = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT `id_facebook` FROM `users` WHERE `username` = '".$row['username']."'  ")) ['id_facebook'];
?>
        <div class="col-xl-12">
          <div class="card">
            <div class="mails">
              <img src="//graph.facebook.com/<?=$get_img_user;?>/picture" />
              <div class="mail-names">
                <?=$row['username'];?>
              </div>
              <hr>
            </div>
            <div class="mail-info">
              <?=$row['content'];?>
            </div>
            <div>
            </div>
            <div class="bottom-info">
              <i class="date" style="float: right;"><?=$row['createdate'];?></i>
            </div>
          </div>

        </div>

<?php }?>


    </div>

<?php include('foot.php');?>