
<?php include('head.php');?>
<?php include('nav.php');?>

        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Dịch Vụ</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
<?php
if (isset($_GET['id'])) 
{
    $id = $_GET['id'];
}

$AADDCC = mysqli_query($ketnoi,"SELECT * FROM `service` WHERE `id` = '".$id."' ");
while ($row = mysqli_fetch_array($AADDCC) ) 
{

?>
<?php
    if (isset($_POST["submit"]))
    {
        
        $name = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['name']))));
        $money = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['money']))));
        $status = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['status']))));
        $category = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['category']))));
        $stt = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['stt'])))); 

          $create = mysqli_query($ketnoi,"UPDATE `service` SET 
            `name` = '".$name."',
            `status` = '".$status."',
            `content` = '".$_POST['content']."',
            `category` = '".$category."',
            `stt` = '".$stt."',
            `money` = '".$money."' WHERE `id` = '".$id."' ");

          if ($create)
          {
            echo '<script type="text/javascript">swal("Thành Công","Lưu thành công","success");setTimeout(function(){ location.href = "dich-vu.php" },1000);</script>'; 
          }
          else
          {
            echo '<script type="text/javascript">swal("Lỗi","Lỗi máy chủ","error");setTimeout(function(){ location.href = "dich-vu.php" },1000);</script>'; 
          }
    }

?>


        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">EDIT DỊCH VỤ</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <form role="form" action="" method="post">
                  <div class="form-group">
                    <label for="exampleInputEmail1">TÊN DỊCH VỤ:</label>
                    <input type="text" class="form-control" name="name"  value="<?=$row['name'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">RATE</label>
                    <input type="number" class="form-control" name="money" value="<?=$row['money'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">STT</label>
                    <input type="number" class="form-control" name="stt" value="<?=$row['stt'];?>">
                  </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">THỂ LOẠI</label>
                  <select class="custom-select" name="category">
                  <option value="<?=$row['category'];?>">
                  <?=$ketnoi->query("SELECT `name` FROM `category` WHERE `code` = '".$row['category']."'  ")->fetch_array() ['name'];?> 
                  </option>
                  <?php
                  $AADaDCC = mysqli_query($ketnoi,"SELECT * FROM `category` ");
                  while ($row1 = mysqli_fetch_array($AADaDCC) ) 
                  { ?>
                  <option value="<?=$row1['code'];?>"><?=$row1['name'];?></option>
                  <?php } ?>
                  </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">MÔ TẢ DỊCH VỤ</label>
                    <textarea class="textarea" name="content" placeholder="Nhập mô tả dịch vụ của bạn"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?=$row['content'];?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">HIỂN THỊ</label>
                    <select class="custom-select" name="status">
                       <option value="<?=$row['status'];?>">
                      <?php
                      if($row['status'] == "show"){ echo 'Show';}
                      if($row['status'] == "hide"){ echo 'Hide';}
                      ?>  
                      </option> 
                          <option value="show">Show</option>
                          <option value="hide">Hide</option>
                        </select>
                  </div>
                  <button type="submit" name="submit" class="btn btn-primary btn-block">Lưu</button>
              </form>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="dich-vu.php" class="btn btn-info">Về Danh Sách Dịch Vụ</a>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row (main row) -->
<?php }?>        
<?php include('foot.php');?>