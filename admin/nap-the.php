
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
            <h1 class="m-0 text-dark">Nạp Thẻ</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DANH SÁCH NẠP THẺ CÀO</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover">
                  <thead>                  
                    <tr>
                      <th class="text-center">CODE</th>
                      <th class="text-center">USERNAME</th>
                      <th class="text-center">TYPE</th>
                      <th class="text-center">AMOUONT</th>
                      <th class="text-center">SERI</th>
                      <th class="text-center">PIN</th>
                      <th class="text-center">CREATE</th>
                      <th class="text-center">NOTE</th>
                      <th class="text-center">STATUS</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$result = mysqli_query($ketnoi,"SELECT * FROM `card` ORDER BY id desc limit 0, 100000");
while($row = mysqli_fetch_assoc($result))
{
?>
                    <tr>
                      <td class="text-center"><?=$row['code'];?></td>
                      <td class="text-center"><?=$row['username'];?></td>
                      <td class="text-center"><?=$row['type'];?></td>
                      <td class="text-center"><?=$row['amount'];?></td>
                      <td class="text-center"><?=$row['seri'];?></td>
                      <td class="text-center"><?=$row['pin'];?></td>
                      <td class="text-center"><?=$row['createdate'];?></td>
                      <td class="text-center"><?=$row['note'];?></td>
                      <td class="text-center">
                        <?php
                          if ($row['status'] == 'xuly')
                          {
                            echo '<span class="badge bg-primary">ĐANG XỬ LÝ</span>';
                          }
                          if ($row['status'] == 'thatbai')
                          {
                            echo '<span class="badge bg-danger">THẤT BẠI</span>';
                          }
                          if ($row['status'] == 'thanhcong')
                          {
                            echo '<span class="badge bg-success">THÀNH CÔNG</span>';
                          }
                        ?>
                        
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
     
<?php include('foot.php');?>