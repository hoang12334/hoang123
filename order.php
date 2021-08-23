<?php include('head.php');?>
<head>
<title>Order | <?=$site_tenweb;?></title>
</head> 

<?php include('nav.php');?>


<div class="header bg-gradient pb-8 pt-5 pt-md-8" style="background-color: <?=$site_color;?>">  <!-- Mask -->
      <span class="mask bg-gradient opacity-8" style="background-color: <?=$site_color1;?>;"></span>
  <!-- Header container -->

</div>

<div class="container-fluid mt--9">
<?php
if (isset($_GET['id'])) 
{
    $id = check_string($_GET['id']); 
}

?>




      <div class="row">

        <div class="col-xl-9 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0"><?=$ketnoi->query("SELECT `name` FROM `category` WHERE `code` = '".$id."' ")->fetch_array()['name'];?> </h3>
                </div>
                <div class="col text-right">
                  <a href="/" class="btn btn-sm btn-primary">HOME</a>
                </div>
              </div>
            </div>





            <div class="card-body pt-0 pt-md-4">
<div class="nav-wrapper">    
<ul class="nav nav-pills nav-fill flex-column flex-sm-row" role="tablist">
  <li class="nav-item active"><a data-toggle="tab" class="nav-link mb-sm-3 mb-md-0 active" href="#taodonhang">Tạo Đơn Hàng</a></li>
  <li class="nav-item"><a class="nav-link mb-sm-3 mb-md-0" data-toggle="tab" href="#nhatky">Nhật Ký</a></li>
</ul>
</div>

<div class="tab-content">
  <div id="taodonhang" class="tab-pane fade show active">
          <form action="" method="POST">
          <div class="form-group">
          <label class="form-control-label" for="input-first-name">Chọn Dịch Vụ</label>
          <select class="form-control form-control-alternative" id="dichvu" name="service">
          <?php $BAADX = mysqli_query($ketnoi,"SELECT * FROM `service` WHERE `category` = '".$id."' AND `status` = 'show' ORDER BY stt ");
          while ($row = mysqli_fetch_array($BAADX) ) 
          {?>
          <option value="<?=$row['id'];?>" data-price="<?=$row['money'];?>" ><?=$row['name'];?> (<?=$row['money'];?> <?=$site_currency;?>)</option>
          <?php }?>
          </select>
          </div>
          <div class="form-group">
          <label class="form-control-label" for="input-email">Số Lượng Tăng</label>
          <input type="number" class="form-control form-control-alternative" name="amount" id="amount" placeholder="Nhập số lượng" required="">
          </div>
          <div class="form-group">
          <label class="form-control-label" for="input-email">Nick Cần Tăng</label>
          <input type="text" class="form-control form-control-alternative" name="url" placeholder="Nhập link, uid hoặc username cần chạy" required="">
          </div>
          <div class="form-group">
          <label class="form-control-label" for="input-email">Ghi Chú</label>
          <textarea  rows="3" name="note"   class="form-control form-control-alternative" placeholder="Ghi chú nếu có" ></textarea>
          </div>
          <div class="form-group">
            <div class="alert alert-primary" role="alert">
              <h4 class="text-center text-white"> Số lượng cần tăng: <span class="cl-green bold"><span id="soluong" style="color: yellow;">0</span> </span></h4>
              <h3 class="text-center text-white"> Chiết khấu giảm: <span class="cl-green bold"><span style="color: yellow;"><?=$my_ck;?></span>% </span></h3>
              <h2 class="text-center text-white"> Tổng: <span class="cl-green bold"><span id="ketqua" style="color: yellow;">0</span> <?=$site_currency;?></span></h2>
            </div>
          </div>
          <hr class="my-4" />
          <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">TẠO TIẾN TRÌNH</button> 

          <script type="text/javascript">
          $('#amount').keyup(function()
          {
          var amount = $("#amount").val();
          var service = $('#dichvu').children("option:selected").attr('data-price');
          console.log(service);

          var ck = <?=$my_ck;?>;
          var ketquaz = service * amount;
          var ketqua = ketquaz - ketquaz * ck / 100;
          $('#ketqua').html(ketqua.toString().replace(/(.)(?=(\d{3})+$)/g,'$1,'));
          $('#soluong').html(amount.toString().replace(/(.)(?=(\d{3})+$)/g,'$1,'));
          });

          $('#dichvu').on('change', function(){
          var amount = $('#amount').val();
          if(amount >= 1){
          total = $(this).children('option:selected').attr('data-price') * amount;
          var ck = <?=$my_ck;?>;
          var ketquazz = total - total * ck / 100;
          $('#ketqua').html(ketquazz.toString().replace(/(.)(?=(\d{3})+$)/g,'$1,'));
          $('#soluong').html(amount.toString().replace(/(.)(?=(\d{3})+$)/g,'$1,'));
          }
          });
          </script>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="xacnhanorder" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="xacnhanorder">XÁC NHẬN GIAO DỊCH</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                <?=$site_text_xac_minh_giao_dich;?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">HỦY</button>
                  <button type="submit" name="submit" class="btn btn-primary">XÁC NHẬN</button>
                </div>
              </div>
            </div>
          </div>
    </form>
  </div>
          <div id="nhatky" class="tab-pane fade show" >
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th class="text-center" scope="col">MÃ GD</th>
                    <th class="text-center" scope="col">DỊCH VỤ</th>
                    <th class="text-center" scope="col">INPUT</th>
                    <th class="text-center" scope="col">SỐ LƯỢNG</th>
                    <th class="text-center" scope="col">TỔNG TIỀN</th>
                    <th class="text-center" scope="col">THỜI GIAN TẠO</th>
                    <th class="text-center" scope="col">CẬP NHẬT</th>
                    <th class="text-center" scope="col">TRẠNG THÁI</th>
                    <th class="text-center" scope="col">GHI CHÚ</th>
                  </tr>
                </thead>
                <tbody>
<?php
$result = mysqli_query($ketnoi,"SELECT * FROM `orders` WHERE `username` = '".$my_username."' AND `category_code` = '".$id."' ORDER BY id desc limit 0, 100");
while($row = mysqli_fetch_assoc($result)){?>
                  <tr>
                    <td class="text-center">
                      <?=$row['code'];?>
                    </th>
                    <td class="text-center">
                      <span class="badge badge-default"><b class="text-white"><?=$row['service_name'];?></b></span>
                    </td>
                    <td class="text-center"><?=$row['url'];?></td>
                    <td class="text-center">
                      <b style="color: blue;"><?=format_cash($row['amount']);?></b>
                    </td>
                    <td class="text-center">
                      <b style="color: red;"><?=format_cash($row['money']);?></b> <?=$site_currency;?>
                    </td>
                    <td class="text-center"><?=$row['createdate'];?></td>
                    <td class="text-center"><?=$row['updatedate'];?></td>
                    <td class="text-center"><?=status($row['status']);?></td>
                    <td class="text-center"><?=$row['note_status'];?></td>
                  </tr> <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div> <!--tab-content-->
      </div>
    </div>
  </div>

  <div class="col-xl-3 order-xl-2 mb-5 mb-xl-0">
    <div class="card">
      <div class="card-body pt-0 pt-md-4">
        <div class="row align-items-center">
          <div class="col-auto">
            <?php if ($my_idfb != '') { ?>
            <img src="https://graph.facebook.com/<?=$my_idfb;?>/picture?type=large&width=100&height=100" width="100%" class="active avatar-home">
            <?php } else { ?>
            <img src="https://i.imgur.com/k9AlaAq.png" width="100px" height="100px" class="active avatar-home">
            <?php }?>
          </div>
          <div class="col pl-0" id="auto_load">
            <h5 class="bold mb-0"><?=$my_username;?></h5>
            <h4 class="font-bold"><?=format_cash($my_vnd);?> <?=$site_currency;?></h4>
            <div class="card bg-red-2">
              <div class="badge badge-primary text-center cl-red font-bold">Giảm <?=$my_ck;?>%</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <br>
    <div class="card">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Chú Ý</h3>
          </div>
        </div>
      </div>
      <div class="card-body pt-0 pt-md-4">
    <?=$ketnoi->query("SELECT `note` FROM `category` WHERE `code` = '".$id."' ")->fetch_array()['note']; ?>
      </div>
    </div>
  </div>
</div>


<?php
if (isset($_POST["submit"]))
{
    
  $service = check_string($_POST['service']);
  $note = check_string($_POST['note']);
  $amount = check_string($_POST['amount']);
  $url = str_replace(array('<',"'",'>','?','--','eval(','<php'),array('','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['url']))));

  $money_service = $ketnoi->query("SELECT `money` FROM `service` WHERE `id` = '$service'  ")->fetch_array()['money'];
  $name_service = $ketnoi->query("SELECT `name` FROM `service` WHERE `id` = '$service'  ")->fetch_array()['name'];

  $code = random('QWERTYUIOPASDFGHJKLZXCVBNM1234567890','6');
  
  $total_money_service1 = $money_service * $amount;
  $total_money_service = $total_money_service1 - $total_money_service1 * $my_ck / 100;
  if(!isset($_SESSION['username']))
  {
      echo '<script type="text/javascript">swal("Thất Bại", "VUI LÒNG ĐĂNG NHẬP!", "error");
      setTimeout(function(){ location.href = "/dang-nhap/" },1000);</script>';
      die();
  }
  else if($site_status_order == 'OFF')
  {
      echo '<script type="text/javascript">swal("Thất Bại", "Đang bảo trì chức năng này!", "error");</script>';      
  }
  else if($amount < $site_min_order)
  {
    echo '<script type="text/javascript">swal("Thất Bại", "Số lượng tối thiểu cần chạy là: '.format_cash($site_min_order).'", "error");</script>'; 
  }
  else if($my_vnd < $total_money_service)
  {
      $if_vnd_buy = $total_money_service - $my_vnd;
      echo '<script type="text/javascript">swal("Thất Bại", "Bạn cần thêm: '.format_cash($if_vnd_buy).'đ để thanh toán đơn hàng này!", "error");</script>';      
  }
  else if ($service == '')
  {
    echo '<script type="text/javascript">swal("Thất Bại", "Vui lòng chọn dịch vụ", "error");</script>';   
  }
  else if ($amount == '')
  {
    echo '<script type="text/javascript">swal("Thất Bại", "Vui lòng nhập số lượng", "error");</script>';   
  }
  else if ($amount <= '0')
  {
    echo '<script type="text/javascript">swal("Thất Bại", "Vui lòng nhập số lượng lớn hơn 0", "error");</script>';   
  }
  else if ($url == '')
  {
    echo '<script type="text/javascript">swal("Thất Bại", "Vui lòng nhập link cần tăng", "error");</script>';   
  }
  else
  {


    $create = $ketnoi->query("INSERT INTO `orders` SET 
    `service_name` = '".$name_service."',
    `category_code` = '".$id."',
    `service_id` = '".$service."',
    `username` = '".$my_username."',
    `amount` = '".$amount."',
    `money` = '".$total_money_service."',
    `note` = '".$note."',
    `code` = '".$code."',
    `url` = '".$url."',
    `createdate` = now() ");

    $ketnoi->query("INSERT INTO `log` SET 
    `content`= '".format_cash($my_vnd)." - ".format_cash($total_money_service)." = ".format_cash(pheptru($my_vnd,$total_money_service))."  lý do: Thanh Toán Đơn ".$name_service." #".$code."',
    `createdate` = now(),
    `username`= '".$my_username."' ");

    $ketnoi->query("UPDATE users SET 
      `money` = `money` - '".$total_money_service."' WHERE `username` = '".$my_username."' ");

    if ($create)
    {
      $cookie = $site_cookie;
      $idNguoiNhan = $site_idfb;
      $noiDungTinNhan = '[SYSTEM] '.$my_username.' vừa tạo 1 ĐƠN HÀNG đang đợi bạn xử lý.';
      $idAnh = '';
      senInboxCSM($cookie, $noiDungTinNhan, $idAnh, $idNguoiNhan);
      ///////////////////////////////////
      $guitoi = $site_gmail;   
      $subject    = 'CÓ ĐƠN HÀNG ĐANG ĐỢI BẠN XỬ LÝ';
      $bcc = $site_tenweb;
      $hoten ='Admin';
      $noi_dung = '<h2>Đơn hàng #'.$code.'</h2>
          <table >
          <tbody>
          <tr>
          <td>Dịch Vụ:</td>
          <td><b>'.$name_service.'</b></td>
          </tr>
          <td>Số Lượng:</td>
          <td><b>'.format_cash($amount).'</b></td>
          </tr>
          <tr>
          <td>Thành Tiền:</td>
          <td><b style="color:blue;">'.format_cash($total_money_service).'</b></td>
          </tr>
          <tr>
          <td>Khách Hàng</td>
          <td><b style="color:red;">'.$my_username.'</b></td>
          </tr>
          </tbody>
          </table>';

      sendCSM($guitoi, $hoten, $subject, $noi_dung, $bcc);  

      //////////////////////////////////
      echo '<script type="text/javascript">swal("Thành Công","Tạo đơn hàng thành công","success");setTimeout(function(){ location.href = "/nhat-ky/order/" },1000);</script>';
      exit();
    }
    else
    {
      echo '<script type="text/javascript">swal("Lỗi","Lỗi máy chủ","error");setTimeout(function(){ location.href = "" },1000);</script>'; 
    }
     
  }    
}
?>


<script> 
$(document).ready(function(){
setInterval(function(){
      $("#auto_load").load(window.location.href + " #auto_load" );
}, 3000);
});
</script>
<?php include('foot.php');?>
