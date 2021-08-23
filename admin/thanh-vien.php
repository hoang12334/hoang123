
<?php include('head.php');?>
<?php include('nav.php');?>

        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Thành Viên</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DANH SÁCH THÀNH VIÊN</h3>
              <div class="float-right">
                <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default" class="btn btn-info">Tạo Thành Viên</a>
              </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">ID</th>
                      <th>NAME</th>
                      <th>MONEY</th>
                      <th>EMAIL</th>
                      <th>CREATE</th>
                      <th>STATUS</th>
                      <th>THAO TÁC</th>
                    </tr>
                  </thead>
                 <tbody>

<?php
if (isset($_POST["timkiem_sub"])) 
{
  $result = mysqli_query($ketnoi,"SELECT * FROM `users` WHERE `username` LIKE '%".$_POST['timkiem']."%' ORDER BY id desc limit 0, 1000");
}
else
{
  $result = mysqli_query($ketnoi,"SELECT * FROM `users` ORDER BY id desc limit 0, 100000");
}
?>
<?php
while($row = mysqli_fetch_assoc($result))
{
?>

                    <tr>
                      <td><?=$row['id'];?></td>
                      <td><?=$row['username'];?></td>
                      <td><?=format_cash($row['money']);?></td>
                      <td><?=$row['mail'];?></td>
                      <td><?=$row['createdate'];?></td>
                      <td><?php
                      if ($row['banned'] == '0')
                      {
                        echo '<span class="badge bg-success">HOẠT ĐỘNG</span>';
                      }
                      else if ($row['banned'] == '1')
                      {
                        echo '<span class="badge bg-danger">BANNED</span>';
                      }
                      ?></td>
                      <td class="text-center">
                        <a href="edit-thanh-vien.php?username=<?=$row['username'];?>" class="btn btn-default">
                          <i class="fas fa-edit"></i> Edit
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

<?php

    if (isset($_POST["btn_submit"]))
    {
        
        $username = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['username']))));
        $password = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['password']))));
        $mail = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['mail']))));

        $query_user_dangky = mysqli_query($ketnoi,"SELECT * FROM `users` WHERE `username` = '".$username."' ");
        $query_email_dangky = mysqli_query($ketnoi,"SELECT * FROM `users` WHERE `mail` = '".$username."' ");
        $biensosanh = str_replace(" ", "", $username);


        if(mysqli_num_rows($query_user_dangky)  > 0)
        {
            echo '<script type="text/javascript">swal("Lỗi", " Tài khoản đã tồn tại!", "error");
            setTimeout(function(){ location.href = "" },2000);</script>';
            die();
        }
        if(mysqli_num_rows($query_email_dangky)  > 0)
        {
            echo '<script type="text/javascript">swal("Lỗi", " Email đã tồn tại!", "error");
            setTimeout(function(){ location.href = "" },2000);</script>';
            die();
        }
        if($username != $biensosanh)
        {
            echo '<script type="text/javascript">swal("Lỗi", " Không được chứa khoản trắng", "error");
             setTimeout(function(){ location.href = "" },2000);</script>';
            die();
        }
        else
        {
            $create = mysqli_query($ketnoi,"INSERT INTO `users` SET 
            `username` = '".$username."',
            `password` = '".$password."',
            `mail` = '".$mail."',
            `createdate` = now() ");
          if ($create)
          {
            echo '<script type="text/javascript">swal("Thành Công","Tạo thành công","success");setTimeout(function(){ location.href = "" },1000);</script>'; 
          }
          else
          {
            echo '<script type="text/javascript">swal("Lỗi","Lỗi máy chủ","error");setTimeout(function(){ location.href = "" },1000);</script>'; 
          }
        }    
    }

?>

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">TẠO THÀNH VIÊN</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form class="form-horizontal" action="" method="post">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" name="username"  required="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" name="mail" required="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="password" required="">
                  </div>

                <!-- /.card-body -->

                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                  <button type="submit" name="btn_submit" class="btn btn-primary">TẠO</button>
                </div>
              </form>
                
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal --> 
<?php include('foot.php');?>