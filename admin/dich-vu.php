
<?php include('head.php');?>
<?php include('nav.php');?>
<?php
if (isset($_GET['delete'])) 
{
    $delete = $_GET['delete'];

    $create = mysqli_query($ketnoi,"DELETE FROM `service` WHERE `id` = '".$delete."' ");

    if ($create)
    {
      echo '<script type="text/javascript">swal("Thành Công","Xóa thành công","success");setTimeout(function(){ location.href = "dich-vu.php" },500);</script>'; 
    }
    else
    {
      echo '<script type="text/javascript">swal("Lỗi","Lỗi máy chủ","error");setTimeout(function(){ location.href = "chuyen-muc.php" },1000);</script>'; 
    }
}
?>
<?php
if(isset($_POST["submit"]))
{
    $name = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['name']))));
    $money = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['money']))));
    $category = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['category']))));
    $status = check_string($_POST['status']);
    $stt = check_string($_POST['stt']);  

    $create = mysqli_query($ketnoi,"INSERT INTO `service` SET 
    `name` = '".$name."',
    `stt` = '".$stt."',
    `content` = '".$_POST['content']."',
    `status` = '".$status."',
    `category` = '".$category."',
    `money` = '".$money."' ");

    if ($create)
    {
      echo '<script type="text/javascript">swal("Thành Công","Tạo thành công","success");setTimeout(function(){ location.href = "dich-vu.php" },1000);</script>'; 
    }
    else
    {
      echo '<script type="text/javascript">swal("Lỗi","Lỗi máy chủ","error");setTimeout(function(){ location.href = "" },1000);</script>'; 
    }
}

?>

        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dịch Vụ</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DANH SÁCH DỊCH VỤ</h3>
                <div class="text-right">
                <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default" class="btn btn-info">TẠO DỊCH VỤ</a>
              </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover">
                  <thead>                  
                    <tr>
                      <th class="text-center">STT</th>
                      <th class="text-center">NAME</th>
                      <th class="text-center">MONEY</th>
                      <th class="text-center">CATEGORY</th>
                      <th class="text-center">STATUS</th>
                      <th class="text-center">THAO TÁC</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$result = mysqli_query($ketnoi,"SELECT * FROM `service` ORDER BY category desc limit 0, 100000");
while($row = mysqli_fetch_assoc($result))
{
?>
                    <tr>
                      <td class="text-center"><?=$row['stt'];?></td>
                      <td class="text-center"><b><?=$row['name'];?></b></td>
                      <td class="text-center"><?=format_cash($row['money']);?>đ/1</td>
                      <td class="text-center">
              <a href="edit-chuyen-muc.php?id=<?=$row['category'];?>"><?=$ketnoi->query("SELECT `name` FROM `category` WHERE `code` = '".$row['category']."'  ")->fetch_array()['name'];?></a></td>
                      <td class="text-center"><?=display($row['status']);?></td>
                      <td class="text-center">
                        <a href="edit-dich-vu.php?id=<?=$row['id'];?>" class="btn btn-default">
                          <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="dich-vu.php?delete=<?=$row['id'];?>" class="btn btn-default">
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
              <h4 class="modal-title">TẠO DỊCH VỤ</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form role="form" action="" method="post">
                  <div class="form-group">
                    <label for="exampleInputEmail1">TÊN DỊCH VỤ:</label>
                    <input type="text" class="form-control" name="name"  placeholder="Tên dịch vụ cần tạo">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">RATE</label>
                    <input type="number" class="form-control" name="money" placeholder="Rate dịch vụ, ví dụ: 100 (100đ/1 lượt)">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">STT</label>
                    <input type="number" class="form-control" name="stt">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">MÔ TẢ DỊCH VỤ</label>
                    <textarea class="textarea" name="content" placeholder="Nhập mô tả dịch vụ của bạn"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Hiển Thị</label>
                    <select class="custom-select" name="status">
                          <option value="show">Show</option>
                          <option value="hide">Hide</option>
                        </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">THỂ LOẠI</label>
                    <select class="custom-select" name="category">
                       <?php
$AADaDCC = mysqli_query($ketnoi,"SELECT * FROM `category` ");
while ($row1 = mysqli_fetch_array($AADaDCC) ) 
{ ?>
<option value="<?=$row1['code'];?>"><?=$row1['name'];?></option>
<?php } ?>
                        </select>
                  </div>
                  <button type="submit" name="submit" class="btn btn-primary">TẠO</button>
              </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal --> 
<?php include('foot.php');?>