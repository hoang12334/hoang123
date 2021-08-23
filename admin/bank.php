
<?php include('head.php');?>
<?php include('nav.php');?>

<?php
if (isset($_GET['delete'])) 
{
    $delete = $_GET['delete'];

    $create = mysqli_query($ketnoi,"DELETE FROM `bank` WHERE `id` = '".$delete."' ");

    if ($create)
    {
      echo '<script type="text/javascript">swal("Thành Công","XÓA THÀNH CÔNG","success");setTimeout(function(){ location.href = "bank.php" },500);</script>'; 
    }
    else
    {
      echo '<script type="text/javascript">swal("Lỗi","LỖI MÁY CHỦ, VUI LÒNG LIÊN HỆ KỸ THUẬT VIÊN","error");setTimeout(function(){ location.href = "bank.php" },1000);</script>'; 
    }
}
?>
<?php
    if (isset($_POST["submit"]))
    {
        
          $name = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['name']))));
          $stk = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['stk']))));
          $bank_name = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['bank_name']))));
          $chi_nhanh = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['chi_nhanh']))));

          $create = mysqli_query($ketnoi,"INSERT INTO `bank` SET 
            `name` = '".$name."',
            `stk` = '".$stk."',
            `bank_name` = '".$bank_name."',
            `chi_nhanh` = '".$chi_nhanh."' ");
          if ($create)
          {
            echo '<script type="text/javascript">swal("Thành Công","THÊM THÀNH CÔNG","success");setTimeout(function(){ location.href = "" },1000);</script>'; 
          }
          else
          {
            echo '<script type="text/javascript">swal("Lỗi","LỖI MÁY CHỦ, VUI LÒNG LIÊN HỆ KỸ THUẬT VIÊN","error");setTimeout(function(){ location.href = "" },1000);</script>'; 
          }
    }

?>


        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ngân Hàng</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DANH SÁCH NGÂN HÀNG</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover">
                  <thead>                  
                    <tr>
                      <th class="text-center">NGÂN HÀNG</th>
                      <th class="text-center">CHỦ TÀI KHOẢN</th>
                      <th class="text-center">STK</th>
                      <th class="text-center">CHI NHÁNH</th>
                      <th class="text-center">THAO TÁC</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$result = mysqli_query($ketnoi,"SELECT * FROM `bank` ORDER BY id desc limit 0, 100000");
while($row = mysqli_fetch_assoc($result))
{
?>
                    <tr>
                      <td class="text-center"><?=$row['name'];?></td>
                      <td class="text-center"><?=$row['bank_name'];?></td>
                      <td class="text-center"><?=$row['stk'];?></td>
                      <td class="text-center"><?=$row['chi_nhanh'];?></td>
                      <td class="text-center">
                        <a href="bank.php?delete=<?=$row['id'];?>" class="btn btn-default">
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
                <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default" class="btn btn-info">THÊM NGÂN HÀNG</a>
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
              <h4 class="modal-title">THÊM NGÂN HÀNG</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form role="form" action="" method="post">
                  <div class="form-group">
                    <label for="exampleInputEmail1">TÊN NGÂN HÀNG:</label>
                    <input type="text" class="form-control" name="name"  placeholder="Tên ngân hàng cần thêm" required="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">SỐ TÀI KHOẢN:</label>
                    <input type="text" class="form-control" name="stk"  placeholder="Số tài khoản" required="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">CHỦ TÀI KHOẢN:</label>
                    <input type="text" class="form-control" name="bank_name"  placeholder="Tên chủ tài khoản" required="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">CHI NHÁNH:</label>
                    <input type="text" class="form-control" name="chi_nhanh"  placeholder="Chi nhánh ngân hàng" required="">
                  </div>        
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">ĐÓNG</button>
              <button type="submit" name="submit" class="btn btn-primary">TẠO</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->        
<?php include('foot.php');?>