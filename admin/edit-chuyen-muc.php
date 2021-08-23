
<?php include('head.php');?>
<?php include('nav.php');?>

        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Chuyên Mục</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
<?php
if (isset($_GET['id'])) 
{
    $id = $_GET['id'];
}

$AADDCC = mysqli_query($ketnoi,"SELECT * FROM `category` WHERE `id` = '".$id."' ");
while ($row = mysqli_fetch_array($AADDCC) ) 
{

?>
<?php
    if (isset($_POST["submit"]))
    {
        
      $name = check_string($_POST['name']);
      $code = xoadau($name);

      $create = mysqli_query($ketnoi,"UPDATE `category` SET 
        `name` = '".$name."',
        `code` = '".$code."',
        `note` = '".$_POST['note']."',
        `img` = '".$_POST['img']."' WHERE `id` = '".$id."' ");

      if ($create)
      {
        echo '<script type="text/javascript">swal("Thành Công","Lưu thành công","success");setTimeout(function(){ location.href = "chuyen-muc.php" },1000);</script>'; 
      }
      else
      {
        echo '<script type="text/javascript">swal("Lỗi","Lỗi máy chủ","error");setTimeout(function(){ location.href = "chuyen-muc.php" },1000);</script>'; 
      }
    }

?>


        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">EDIT CHUYÊN MỤC</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <form role="form" action="" method="post">
                  <div class="form-group">
                    <label for="exampleInputEmail1">TÊN CHUYÊN MỤC:</label>
                    <input type="text" class="form-control" name="name"  value="<?=$row['name'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">ICON CHUYÊN MỤC:</label>
                    <input type="text" class="form-control" name="img"  value="<?=$row['img'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">CHÚ Ý CHUYÊN MỤC:</label>
                    <textarea class="textarea" name="note" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?=$row['note'];?></textarea>
                  </div>
                  <button type="submit" name="submit" class="btn btn-primary btn-block">Lưu</button>
              </form>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="chuyen-muc.php" class="btn btn-info">Về Danh Sách Chuyên Mục</a>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row (main row) -->
<?php }?>        
<?php include('foot.php');?>