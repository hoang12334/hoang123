
<?php include('head.php');?>
<?php include('nav.php');?>
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
<?php
if (isset($_GET['id'])) 
{
    $id = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_GET['id']))));
    $conntent_1 = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT `content` FROM `ticket` WHERE `id` = '".$id."'  ")) ['content'];
    $time_ticket = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT `createdate` FROM `ticket` WHERE `id` = '".$id."'  ")) ['createdate'];
    $title_ticket = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT `title` FROM `ticket` WHERE `id` = '".$id."'  ")) ['title'];
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
  else
  {
    $create = mysqli_query($ketnoi,"INSERT INTO `reply_ticket` SET 
    `id_ticket` = '".$id."',
    `username` = '".$my_username."',
    `content` = '".$content."',
    `createdate` = now() ");
    mysqli_query($ketnoi,"UPDATE `ticket` SET 
    `status` = 'traloi' WHERE `id` = '".$id."'  ");

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
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
                <h2 class="float-left">TRẢ LỜI</h2>
                <a href="ho-tro.php" class="float-right"><h2>QUAY LẠI</h2></a>
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              <form action="" method="POST">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <textarea  rows="12" name="content" class="textarea" placeholder="Nhập nội dung cần hỗ trợ..." ></textarea>
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
</div>     
<?php include('foot.php');?>