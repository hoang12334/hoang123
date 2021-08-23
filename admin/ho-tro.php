
<?php include('head.php');?>
<?php include('nav.php');?>



        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Hỗ Trợ</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->


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
    `username` = '".$_POST['username']."',
    `title` = '".$title."',
    `content` = '".$content."',
    `status` = 'xuly',
    `createdate` = now() ");
    if($create)
    {
        
        echo '<script type="text/javascript">swal("Thành Công","Tạo yêu cầu hỗ trợ thành công!","success");
                setTimeout(function(){ location.href = "" },1000);</script>';
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
<?php
    if (isset($_GET['hoantat'])) 
    {
          $create = mysqli_query($ketnoi,"UPDATE `ticket` SET 
            `status` = 'hoantat' WHERE `id` = '".$_GET['hoantat']."' ");
          if ($create)
          {
            echo '<script type="text/javascript">swal("Thành Công","EDIT THÀNH CÔNG","success");setTimeout(function(){ location.href = "ho-tro.php" },1000);</script>'; 
          }
          else
          {
            echo '<script type="text/javascript">swal("Lỗi","LỖI MÁY CHỦ, VUI LÒNG LIÊN HỆ KỸ THUẬT VIÊN","error");setTimeout(function(){ location.href = "ho-tro.php" },1000);</script>'; 
          }
    }
?>
<?php
    if (isset($_GET['huy'])) 
    {
          $create = mysqli_query($ketnoi,"UPDATE `ticket` SET 
            `status` = 'dong' WHERE `id` = '".$_GET['huy']."' ");
          if ($create)
          {
            echo '<script type="text/javascript">swal("Thành Công","EDIT THÀNH CÔNG","success");setTimeout(function(){ location.href = "ho-tro.php" },1000);</script>'; 
          }
          else
          {
            echo '<script type="text/javascript">swal("Lỗi","LỖI MÁY CHỦ, VUI LÒNG LIÊN HỆ KỸ THUẬT VIÊN","error");setTimeout(function(){ location.href = "ho-tro.php" },1000);</script>'; 
          }
    }
?>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DANH SÁCH TICKET</h3>
                <div class="text-right">
                  <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default" class="btn btn-info">TẠO YÊU CẦU</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover">
                  <thead>                  
                    <tr>
                      <th class="text-center">USERNAME</th>
                      <th class="text-center">TITLE</th>
                      <th class="text-center">CREATEDATE</th>
                      <th class="text-center">STATUS</th>
                      <th class="text-center">THAO TÁC</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$result = mysqli_query($ketnoi,"SELECT * FROM `ticket` ORDER BY id desc limit 0, 100000");
while($row = mysqli_fetch_assoc($result))
{

?>
                    <tr>
                      <td class="text-center"><?=$row['username'];?></td>
                      <td class="text-center"><?=$row['title'];?></td>
                      <td class="text-center"><?=$row['createdate'];?></td>
                      <td class="text-center">
                      <?php
                        if ($row['status'] == 'xuly')
                          {
                            echo '<span class="badge bg-primary"> ĐANG CHỜ XỬ LÝ</span>';
                          }
                          else if ($row['status'] == 'traloi')
                          {
                            echo '<span class="badge bg-warning"> ADMIN TRẢ LỜI</span>';
                          }
                          else if ($row['status'] == 'dong')
                          {
                            echo '<span class="badge bg-danger"> ĐÓNG</span>';
                          }
                          else if ($row['status'] == 'hoantat')
                          {
                            echo '<span class="badge bg-success"> ĐÃ GIẢI QUYẾT</span>';
                          }

                      ?>
                      </td>
                      <td class="text-center">

                        <a href="edit-ho-tro.php?id=<?=$row['id'];?>" class="btn btn-default">
                          <i class="fa fa-cog" aria-hidden="true"></i>
                        </a>
                        <a href="ho-tro.php?hoantat=<?=$row['id'];?>" class="btn btn-default">
                          <i class="fa fa-check" aria-hidden="true"></i>
                        </a>
                        <a href="ho-tro.php?huy=<?=$row['id'];?>" class="btn btn-default">
                          <i class="fa fa-times" aria-hidden="true"></i>
                        </a>
                      </td>  
                    </tr>
<?php }?>
                  </tbody>
                </table>
              </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row (main row) -->

<div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">TẠO TICKET</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="POST">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label">Username</label>
                        <input type="text" list="listuser" class="form-control form-control-alternative"  name="username" placeholder="Nhập username cần gửi" required="">
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label">Tiêu Đề</label>
                        <input type="text" class="form-control form-control-alternative"  name="title" placeholder="Nhập tiêu đề hỗ trợ" required="">
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" >Nội Dung</label>
                        <textarea class="textarea" name="content" placeholder="Nhập nội dung" ></textarea>
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
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->        
<?php include('foot.php');?>