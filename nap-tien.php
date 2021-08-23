<?php include('head.php');?>
<head>
<title>Nạp Tiền | <?=$site_tenweb;?></title>
</head> 
<?php include('nav.php');?>
<?php if(!isset($_SESSION['username']))
{
    echo '<script type="text/javascript">swal("Thất Bại", "Vui lòng đăng nhập để tiếp tục.", "error");
        setTimeout(function(){ location.href = "/dang-nhap/" },100);</script>';
    die();
}
?>
    
<div class="header bg-gradient pb-8 pt-5 pt-md-8" style="background-color: <?=$site_color;?>">  <!-- Mask -->
  <span class="mask bg-gradient opacity-8" style="background-color: <?=$site_color1;?>;"></span>
  <!-- Header container -->
</div>

<div class="container-fluid mt--7">



<div class="row">
  <div class="col-xl-4">
    <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#napbank">
      NẠP QUA NGÂN HÀNG
    </button>
  </div>
  <div class="col-xl-4">
    <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#momo" >
    NẠP QUA MOMO AUTO
    </button>
  </div>
  <div class="col-xl-4">
    <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#quydinh">
      QUY ĐỊNH
    </button>
  </div>
</div>
<br>
<!-- Modal -->
<div class="modal fade" id="momo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">NẠP TIỀN TỰ ĐỘNG QUA VÍ MOMO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<h3>Thông Tin ví MOMO</h3>
<ul>
<li>Số Điện Thoại: <b><?=$site_sdt_momo;?></b> <a data-toggle="collapse" data-target="#qr"><i class="fa fa-qrcode" aria-hidden="true"></i>
</a>
</li>
<li>Chủ Tài Khoản: <b><?=$site_ten_momo;?></b></li>
<li>Nội Dung: <b style="color: red;"><?=$site_noidung_momo;?></b></li>
</ul>
<div id="qr" class="collapse">
<img src="<?=$site_qr_momo;?>" width="100%">
</div>
<form method="post" action="">
<div class="form-group">
<input class="form-control" name="tranid" type="text" required placeholder="Nhập mã giao dịch" required="">
</div>
<button class="btn btn-success btn-block" type="submit" name="submit_momo"><i class="fas fa-caret-right"></i> XÁC NHẬN</button>
</form>
<img src="/img/huong-dan-momo.png" width="100%">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ĐÓNG</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="napbank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">THÔNG TIN CHUYỂN KHOẢN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <label for="exampleInputPassword1">NỘI DUNG CHUYỂN TIỀN</label>
        <div class="input-group mb-3">
          <input type="text" class="form-control" value="naptien <?=$my_username;?>" id="myInput" readonly>
          <div class="input-group-append">
            <button class="btn btn-outline-primary" type="submit" onclick="myFunction()" onmouseout="outFunc()">COPY</button>
          </div>
        </div>
        <h4 class="text-center">VUI LÒNG CHUYỂN ĐẾN 1 TRONG CÁC NGÂN HÀNG DƯỚI ĐÂY</h4>
        <h5>Lưu Ý: chuyển chính xác nội dung chuyển tiền để QTV xử lý giao dịch.</h5>
<?php
$result = mysqli_query($ketnoi,"SELECT * FROM `bank` ORDER BY id desc limit 0, 10");
while($row = mysqli_fetch_assoc($result))
{
?>
<hr>
        <ul>
          <li>Tên Ngân Hàng:   <b><?=$row['name'];?></b></li>
          <li>Số Tài Khoản:   <b><?=$row['stk'];?></b></li>
          <li>Chủ Tài Khoản:   <b><?=$row['bank_name'];?></b></li>
          <li>Chi Nhánh:   <b><?=$row['chi_nhanh'];?></b></li>
        </ul>
<?php }?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ĐÓNG</button>
      </div>
    </div>
  </div>
</div>

<?php

if(isset($_POST["submit_momo"])) 
{

  if(isset($_SESSION['username']))
  {
        $tranid = check_string($_POST['tranid']);

        $curl = curl_init();
       
        curl_setopt_array($curl, array(
          CURLOPT_URL => $site_domain."api.php?code=$tranid",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
        ));
       
      $response = curl_exec($curl);
      curl_close($curl);
      $data = json_decode($response, true);
     
      if ($data['status'] == 'success' && $data['content'] == $site_noidung_momo )
      {
        $check_tranID = $ketnoi->query("SELECT * FROM `momo` WHERE `tranId` = '".$tranid."' ");

        if(mysqli_num_rows($check_tranID)  > 0)
        {
            echo '<script type="text/javascript">swal("Thông Báo", "Mã Giao Dịch Này Đã Được Xử Lý!", "warning");</script>';
        }
        else
        {
          $money_check = str_replace('.', '', $data['data']['money']);
          $create = $ketnoi->query("INSERT INTO `momo` SET 
          `tranId` = '".$data['data']['code']."',
          `partnerId` = '".$data['data']['phone']."',
          `partnerName` = '".$data['data']['name']."',
          `amount` = '".$data['data']['money']."',
          `comment` = '".$data['data']['content']."',
          `time` = '".$data['data']['time']."',
          `username` = '".$my_username."'  ");

          $ketnoi->query("INSERT INTO `log` SET 
          `content`= '".format_cash($my_vnd)." + ".format_cash($money_check)." = ".format_cash(phepcong($money_check,$my_vnd))."  lý do: Nạp MOMO  #".$data['data']['code']." ',
          `createdate` = now(),
          `username`= '".$my_username."' ");

          $create = $ketnoi->query("UPDATE users SET 
            `money` = `money` + '".$money_check."',
            `total_nap` = `total_nap` + '".$money_check."' WHERE `username` = '".$my_username."' ");


          if($create)
          {
            echo '<script type="text/javascript">swal("Thành Công", "'.$data['msg'].'","success");</script>';
          }
          else
          {
            echo '<script type="text/javascript">swal("Thất Bại", "Vui lòng thao tác lại hoặc báo cáo QTV", "error");</script>';
          }
        }
      }
      else
      {
          echo '<script type="text/javascript">swal("Thất Bại", "'.$data['msg'].'", "error");</script>';
      }
  }
  else
  {
    echo '<script type="text/javascript">swal("Thất Bại", "Vui lòng đăng nhập để tiếp tục", "error");
        setTimeout(function(){ location.href = "/dang-nhap/" },1000);</script>';
    session_destroy();
    die();
  }
}
?>


<!-- Modal -->
<div class="modal fade" id="quydinh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">CHÍNH SÁCH KHI NẠP TIỀN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?=$site_text_nap_tien;?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ĐÓNG</button>
      </div>
    </div>
  </div>
</div>

      <div class="row">
        <div class="col-xl-4 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">NẠP THẺ TỰ ĐỘNG</h3>
                </div>
                <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-primary">PHÍ <?=$site_ck_nap_the;?>%</a>
                </div>
              </div>
            </div>
            <div class="card-body">
      
      <form method="POST" action="" accept-charset="UTF-8">

			    
		    <label for="email">Loại Thẻ:</label>
  		    <select class="form-control form-control-alternative" name="loaithe" required>
            <option value="">Chọn loại thẻ</option>
            <option value="VTT">Viettel</option>
            <option value="VNP">Vinaphone</option>
            <option value="VMS">Mobifone</option>
            <option value="VNM">Vietnam Mobile</option>
  				</select>
				</label>
				<label for="email">Mệnh Giá:</label>
				<select class="form-control form-control-alternative" name="menhgia" required>
				<option value="">Chọn mệnh giá</option>
				<option value="10000">10.000</option>
				<option value="20000">20.000</option>
				<option value="30000">30.000</option>
				<option value="50000">50.000</option>
				<option value="100000">100.000</option>
				<option value="200000">200.000</option>
				<option value="300000">300.000</option>
				<option value="500000">500.000</option>
				<option value="1000000">1.000.000</option>
				</select>
				</label>
			    <label for="email">Seri:</label>
			    <input type="text" class="form-control form-control-alternative" name="seri" required="">
			    <label for="pwd">Mã Thẻ:</label>
			    <input type="text" class="form-control form-control-alternative" name="pin" required="">
			<hr class="my-4" />
			<button type="submit" name="submit_napthe" class="btn btn-primary ">NẠP THẺ</button>
		</form>
            </div>
          </div>
        </div>

<?php
if(isset($_POST["submit_napthe"])) 
{
   
  if(isset($_SESSION['username']))
  {

      $request_id = random('QWERTYUIOPASDFGHJKLZXCVBNM0123456789', '12');
      $seri = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['seri'])))); // string
      $pin = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['pin'])))); // string
      $loaithe = check_string($_POST['loaithe']); // string
      $menhgia = check_string($_POST['menhgia']); // string
      $url = "http://api.tichhop247.com/API/NapThe?APIKey=$site_api&Network=$loaithe&CardCode=$pin&CardSeri=$seri&TrxID=$request_id&CardValue=$menhgia&URLCallback=$site_callback"; // thực hiện post dữ liệu lên link tích hợp
      $ch1 = curl_init();
      curl_setopt($ch1, CURLOPT_URL, $url);  
      curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch1, CURLOPT_POSTFIELDS, "APIKey=$site_api&Network=$loaithe&CardCode=$pin&CardSeri=$seri&TrxID=$request_id&CardValue=$menhgia&URLCallback=$site_callback"); 
      curl_setopt($ch1, CURLOPT_POST, 1);
      $result = curl_exec($ch1);
      $obj = json_decode($result);
      $code =$obj->Code;


      if($code == 0)
      {
        echo '<script type="text/javascript">swal("Thất Bại", "'.$obj->Message.'", "error");</script>';
      }
      else if($code == 1)
      {    
        $thucnhandoithe = $menhgia - $menhgia * $site_ck_nap_the / 100;
        //Gửi thẻ thành công, đợi duyệt.
        $create = mysqli_query($ketnoi,"INSERT INTO `card` SET
          `username` = '".$my_username."',
          `code` = '".$request_id."',
          `type` = '".$loaithe."',
          `amount` = '".$menhgia."',
          `thucnhan` = '".$thucnhandoithe."',
          `seri` = '".$seri."',
          `pin` = '".$pin."',
          `status` = 'xuly',
          `createdate` = now()
         ");
        
        if($create)
        {
            echo '<script type="text/javascript">swal("Thành Công", "Gửi thẻ thành công, vui lòng đợi!","success");
            setTimeout(function(){ location.href = "" },1000);</script>';
        }
        else
        {
            echo '<script type="text/javascript">swal("Thất Bại", "Vui lòng thao tác lại hoặc báo cáo QTV", "error");</script>';
        }
      }
      else
      {    

        $thucnhandoithe = $menhgia - $menhgia * $site_ck_nap_the / 100;
        //Gửi thẻ thành công, đợi duyệt.
        $create = mysqli_query($ketnoi,"INSERT INTO `card` SET
          `username` = '".$my_username."',
          `code` = '".$request_id."',
          `type` = '".$loaithe."',
          `amount` = '".$menhgia."',
          `thucnhan` = '".$thucnhandoithe."',
          `seri` = '".$seri."',
          `pin` = '".$pin."',
          `status` = 'xuly',
          `createdate` = now()
         ");
        
        if($create)
        {
            echo '<script type="text/javascript">swal("Thành Công", "Gửi thẻ thành công, vui lòng đợi!","success");
            setTimeout(function(){ location.href = "" },1000);</script>';
        }
        else
        {
            echo '<script type="text/javascript">swal("Thất Bại", "Vui lòng thao tác lại hoặc báo cáo QTV", "error");</script>';
        }

      }
  }
  else
  {
    echo '<script type="text/javascript">swal("Thất Bại", "Vui lòng đăng nhập để tiếp tục", "error");
        setTimeout(function(){ location.href = "/dang-nhap/" },1000);</script>';
    session_destroy();
    die();
  }

}
?>


        <div class="col-xl-8 order-xl-2">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">LỊCH SỬ NẠP THẺ</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
            	<div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">MÃ GD</th>
                    <th scope="col">LOẠI THẺ</th>
                    <th scope="col">MỆNH GIÁ</th>
                    <th scope="col">THỰC NHẬN</th>
                    <th scope="col">SERI/PIN</th>
                    <th scope="col">TRẠNG THÁI</th>
                    <th scope="col">GHI CHÚ</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>     
<?php
$result = mysqli_query($ketnoi,"SELECT * FROM `card` WHERE `username` = '".$my_username."' ORDER BY id desc limit 0, 100");
while($row = mysqli_fetch_assoc($result))
{
?>
                  <tr>
                    <th scope="row">
                      <?=$row['code'];?>
                    </th>
                    <td>
                      <?=$row['type'];?>
                    </td>
                    <td>
                      <?=format_cash($row['amount']);?>đ
                    </td>
                    <td>
                      <?=format_cash($row['thucnhan']);?>đ
                    </td>
                    <td>
                      <?=$row['seri'];?> / <?=$row['pin'];?>
                    </td>
                    <td>
                      <?=status($row['status']);?>
                    </td>
                    <td>
                      <?=$row['note'];?>
                    </td>
                  </tr>
<?php }?>
                </tbody>
              </table>
            </div>
            </div>
          </div>
        </div>

      </div>
<script>
function myFunction() {
var copyText = document.getElementById("myInput");
copyText.select();
copyText.setSelectionRange(0, 99999);
document.execCommand("copy");

var tooltip = document.getElementById("myTooltip");
tooltip.innerHTML = "Copied: " + copyText.value;
}

function outFunc() {
var tooltip = document.getElementById("myTooltip");
tooltip.innerHTML = "Copy to clipboard";
}
</script>
<?php include('foot.php');?>
