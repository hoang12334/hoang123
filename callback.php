
<?php
require_once('config.php');
error_reporting(0);
if(isset($_GET['Code']))
{
    $status = $_GET['Code'];
    $message = $_GET['Mess'];
    $Reason = $_GET['Reason'];
    $CardCode = $_GET['CardCode'];
    $CardSeri = $_GET['CardSeri'];
    $CardValue = $_GET['CardValue'];
    $request_id = $_GET['TrxID'];
//GHI LOG
    $myfile = fopen("log.txt", "w") or die("Unable to open file!");
    $txt = "Status: ".$status." | id:".$request_id." | MGT:".$CardValue."\n";
    fwrite($myfile, $txt);
    fclose($myfile); 

// Xử lý, xác định thông tin callback trả về :
// Lấy thông tin thẻ và nhiều thứ    
/// status = 1 ==> thẻ đúng
/// status = 2 ==> thẻ sai mệnh giá
/// status = 3 ==> thẻ sai mênh giá
/// status = 5 ==> thẻ sai
/// status = 99 ==> Bảo trì   



$get_username = mysqli_fetch_assoc(mysqli_query($ketnoi,"SELECT `username` FROM `card` WHERE status = 'xuly' AND code = '".$request_id."'"))['username'];
$get_thucnhan = mysqli_fetch_assoc(mysqli_query($ketnoi,"SELECT `thucnhan` FROM `card` WHERE status = 'xuly' AND code = '".$request_id."'"))['thucnhan'];
$get_vnd = $ketnoi->query("SELECT `money` FROM `users` WHERE `username` = '".$get_thucnhan."' ")->fetch_array()['money'];

    if (!$request_id)
    {
        echo json_encode(array('status' => "error", 'title' => "Thất Bại", 'msg' => " Request id ?")); 
        exit;
    }
    elseif (!$CardSeri)
    {
        echo json_encode(array('status' => "error", 'title' => "Thất Bại", 'msg' => " Seri ?")); 
        exit;
    }
    elseif (!$CardCode)
    {
        echo json_encode(array('status' => "error", 'title' => "Thất Bại", 'msg' => " Pin ?")); 
        exit;
    }
    elseif($status == 1)// Thành Công
    {

        $ketnoi->query("UPDATE card SET status = 'thanhcong' WHERE status = 'xuly' AND code = '".$request_id."'");
          //cong tien
        $ketnoi->query("UPDATE users SET 
      	`money` = `money` + '".$get_thucnhan."',
      	`total_nap` = `total_nap` + '".$get_thucnhan."'
      	WHERE `username` = '".$get_username."' ");

        $ketnoi->query("INSERT INTO `log` SET 
        `content`= '".format_cash($get_vnd)." + ".format_cash($get_thucnhan)." = ".format_cash(phepcong($get_vnd,$get_thucnhan))."  lý do: Nạp tiền qua thẻ cào seri ".$CardSeri." ',
        `createdate` = now(),
        `username`= '".$get_username."' ");

    }
    elseif($status == 2)// Sai mệnh giá
    {
        $ketnoi->query("UPDATE card SET status = 'thatbai', note = 'Sai mệnh giá' WHERE status = 'xuly' AND code = '".$request_id."'"); 
    }
    elseif($status == 3)// Sai mệnh giá
    {
        $ketnoi->query("UPDATE card SET status = 'thatbai', note = 'Sai mệnh giá' WHERE status = 'xuly' AND code = '".$request_id."'"); 
    }   
    elseif($status == 5)// Thẻ sai
    {
        $ketnoi->query("UPDATE card SET status = 'thatbai', note = 'Thẻ sai' WHERE status = 'xuly' AND code = '".$request_id."'"); 
    }
    elseif($status == 99)// Bảo trì
    {
    	$ketnoi->query("UPDATE card SET status = 'thatbai', note = 'Nạp thẻ đang bảo trì' WHERE status = 'xuly' AND code = '".$request_id."'"); 
    }
    else
    {   
        echo json_encode(array('status' => "success", 'title' => "Value", 'msg' => "Du lieu call back tra ve thieu sot  ! "));
    }
}
else
{   
    echo json_encode(array('status' => "success", 'title' => "Value", 'msg' => "Du lieu ? "));
}
?>