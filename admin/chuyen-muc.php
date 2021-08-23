
<?php include('head.php');?>
<?php include('nav.php');?>

<?php
if (isset($_GET['delete'])) 
{
    $delete = $_GET['delete'];

    $create = mysqli_query($ketnoi,"DELETE FROM `category` WHERE `id` = '".$delete."' ");

    if ($create)
    {
      echo '<script type="text/javascript">swal("Thành Công","Xóa thành công","success");setTimeout(function(){ location.href = "chuyen-muc.php" },500);</script>'; 
    }
    else
    {
      echo '<script type="text/javascript">swal("Lỗi","Lỗi máy chủ","error");setTimeout(function(){ location.href = "chuyen-muc.php" },1000);</script>'; 
    }
}
?>
<?php
    if (isset($_POST["submit"]))
    {
        
        $name = check_string($_POST['name']);
        $code = xoadau($name);

          $create = mysqli_query($ketnoi,"INSERT INTO `category` SET 
          `name` = '".$name."',
          `code` = '".$code."',
          `note` = '".$_POST['note']."',
          `img` = '".$_POST['img']."' ");


          if ($create)
          {
            echo '<script type="text/javascript">swal("Thành Công","Tạo thành công","success");setTimeout(function(){ location.href = "" },1000);</script>'; 
          }
          else
          {
            echo '<script type="text/javascript">swal("Lỗi","Lỗi máy chủ","error");setTimeout(function(){ location.href = "" },1000);</script>'; 
          }
    }

?>


        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Category</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DANH SÁCH THỂ LOẠI</h3>
                <div class="text-right">
                <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default" class="btn btn-info">TẠO CHUYÊN MỤC</a>
              </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">ID</th>
                      <th class="text-center">NAME</th>
                      <th class="text-center">THAO TÁC</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$result = mysqli_query($ketnoi,"SELECT * FROM `category` ORDER BY id desc limit 0, 100000");
while($row = mysqli_fetch_assoc($result))
{
?>
                    <tr>
                      <td class="text-center"><?=$row['id'];?></td>
                      <td class="text-center"><?=$row['name'];?></td>
                      <td class="text-center">
                        <a href="edit-chuyen-muc.php?id=<?=$row['id'];?>" class="btn btn-default">
                          <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="chuyen-muc.php?delete=<?=$row['id'];?>" class="btn btn-default">
                          <i class="fas fa-trash"></i> Delete
                        </a>
                      </td>  
                    </tr>
<?php }?>
                  </tbody>
                </table>
              </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                VUI LÒNG THAO TÁC CẨN THẬN
              </div>
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
              <h4 class="modal-title">TẠO CHUYÊN MỤC</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form role="form" action="" method="post">
                  <div class="form-group">
                    <label for="exampleInputEmail1">TÊN CHUYÊN MỤC:</label>
                    <input type="text" class="form-control" name="name"  placeholder="Tên thể loại cần tạo" required="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">ICON CHUYÊN MỤC:</label>
                    <input type="text" class="form-control" name="img" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">CHÚ Ý CHUYÊN MỤC:</label>
                    <textarea class="textarea" name="note" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                  </div>      
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">ĐÓNG</button>
              <button type="submit" name="submit" class="btn btn-primary">TẠO NGAY</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->        
<?php include('foot.php');?>