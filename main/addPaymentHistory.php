<?php


session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  session_destroy();
  exit;
}

include('connection.php');
$receipt_num = htmlspecialchars($_POST['receiptNumber']);
$td_arp = htmlspecialchars($_POST['td_ARP']);
$tpname = ($_POST['namePayer']);
$address = htmlspecialchars($_POST['addRess']);
$ass_val = htmlspecialchars($_POST['valueAssessed']);
$tot_val = htmlspecialchars($_POST['amountPaid']);
$sel_date = htmlspecialchars($_POST['dateSelect']);
$uname = htmlspecialchars($_POST['nameUser']);


$sql = "INSERT INTO payment_history (RECEIPT_NO, TD_ARP, TAXPAYER_NAME, ADDRESS, ASSESSED_VALUE, TOTAL_PAYMENT, DATE, LAST_PAYMENT, USERS_NAME) values 
(?,?,?,?,?,?,?,?,?)";

$stmt = mysqli_prepare($con,$sql);
mysqli_stmt_bind_param($stmt, 'sssssssss',$receipt_num, $td_arp, $tpname, $address, $ass_val, $tot_val, $sel_date, $sel_date, $uname);
if(mysqli_stmt_execute($stmt)){
   mysqli_close($con);
   echo 'success';
   return false;
}else{
  echo 'fail';
  die('mysqli error: '.mysqli_error($con));
  return false;
} ?>