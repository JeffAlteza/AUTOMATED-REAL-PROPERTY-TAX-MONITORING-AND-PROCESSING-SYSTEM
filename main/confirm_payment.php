<?php
date_default_timezone_set('Asia/Manila');
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  session_destroy();
  exit;
}
include('connection.php');


$current_Years = date('Y');
$td_arp = htmlspecialchars($_POST['tdarp']);
$tpname = ($_POST['TPname']);
$address = htmlspecialchars($_POST['addr']);
$ass_val = htmlspecialchars($_POST['assessVal']);
$rpt_sef = ($_POST['sef_rpt']);
$subtotal = $rpt_sef * 2;
$tot_val =$_POST['totalVal'];
$sel_date = htmlspecialchars($_POST['selectDate']);
$uname = htmlspecialchars($_POST['Users_name']);
$selYears = $_POST["Selected_Year"];
$selRanges = $_POST["Selected_Range"];
$sub_pena = htmlspecialchars($_POST['sub_pen']);
$sub_disc = htmlspecialchars($_POST['sub_dis']);
$currentYear = date('Y');
$currentDate = date('Y-m-d');
$classifications = $_POST['classification'];
$payors_name = $_POST['payor_name'];

//---BASIC and SEF
$basic_report = 0;
$sef_report = 0;
$totaldiv = $tot_val /2;
$intparts = floor( $tot_val );
$fraction = $tot_val - $intparts ;
$decimal = round($fraction * 100, 2);
$rounded = 0.01 * (int)($totaldiv*100);
if ($decimal % 2 == 0) {
  $basic_report = $totaldiv;
  $sef_report= $totaldiv;
}else{
  $basic_report = $rounded + 0.01;
  $sef_report = $rounded;
}
//-----------------------

$decnum= $_SESSION['TD_ARPS']; 
$sql3=("SELECT * FROM payment_history WHERE TD_ARP = '".$decnum."' ORDER BY LAST_PAYMENT DESC limit 1");
$result3=mysqli_query($con, $sql3);

if ($result3->num_rows>0) {
if($row3=$result3-> fetch_assoc()) {
    $latestPayments=$row3['LAST_PAYMENT'];
    $latestPayments1 = $latestPayments + 1;


if($selRanges==0 && $selYears != 0){// specific year only
  $sql = "INSERT INTO payment_history (TD_ARP, TAXPAYER_NAME, ADDRESS, CLASSIFICATION, ASSESSED_VALUE, SEF, BASIC, SUBTOTAL, DISCOUNT, PENALTY, TOTAL_PAYMENT, BASIC_REPORT, SEF_REPORT, DATE, LAST_PAYMENT, PAYOR, USERS_NAME) values 
  (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  $stmt = mysqli_prepare($con,$sql);
  mysqli_stmt_bind_param($stmt, 'sssssssssssssssss', $td_arp, $tpname, $address, $classifications, $ass_val, $rpt_sef, $rpt_sef, $subtotal, $sub_disc, $sub_pena, $tot_val, $basic_report, $sef_report, $sel_date, $selYears, $payors_name, $uname);

  $sqls = "INSERT INTO payment_history_backup (TD_ARP, TAXPAYER_NAME, ADDRESS, CLASSIFICATION, ASSESSED_VALUE, SEF, BASIC, SUBTOTAL, DISCOUNT, PENALTY, TOTAL_PAYMENT, BASIC_REPORT, SEF_REPORT, DATE, LAST_PAYMENT, PAYOR, USERS_NAME) values 
  (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  $stmts = mysqli_prepare($con,$sqls);
  mysqli_stmt_bind_param($stmts, 'sssssssssssssssss', $td_arp, $tpname, $address, $classifications, $ass_val, $rpt_sef, $rpt_sef, $subtotal, $sub_disc, $sub_pena, $tot_val, $basic_report, $sef_report, $sel_date, $selYears, $payors_name, $uname);

}else if($selRanges != 0 && $selranges != $current_Years && $selYears== $latestPayments1){//range
  $sql = "INSERT INTO payment_history (TD_ARP, TAXPAYER_NAME, ADDRESS, CLASSIFICATION, ASSESSED_VALUE, SEF, BASIC, SUBTOTAL, DISCOUNT, PENALTY, TOTAL_PAYMENT, BASIC_REPORT, SEF_REPORT, DATE, PAYMENT_YEAR, LAST_PAYMENT, PAYOR, USERS_NAME) values 
  (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  $stmt = mysqli_prepare($con,$sql);
  mysqli_stmt_bind_param($stmt, 'ssssssssssssssssss', $td_arp, $tpname, $address, $classifications, $ass_val, $rpt_sef, $rpt_sef, $subtotal, $sub_disc, $sub_pena, $tot_val, $basic_report, $sef_report, $sel_date, $selYears, $selRanges, $payors_name, $uname);

  $sqls = "INSERT INTO payment_history_backup (TD_ARP, TAXPAYER_NAME, ADDRESS, CLASSIFICATION, ASSESSED_VALUE, SEF, BASIC, SUBTOTAL, DISCOUNT, PENALTY, TOTAL_PAYMENT, BASIC_REPORT, SEF_REPORT, DATE, PAYMENT_YEAR, LAST_PAYMENT, PAYOR, USERS_NAME) values 
  (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  $stmts = mysqli_prepare($con,$sqls);
  mysqli_stmt_bind_param($stmts, 'ssssssssssssssssss', $td_arp, $tpname, $address, $classifications, $ass_val, $rpt_sef, $rpt_sef, $subtotal, $sub_disc, $sub_pena, $tot_val, $basic_report, $sef_report, $sel_date, $selYears, $selRanges, $payors_name, $uname);

}


else if($selYears== $latestPayments1 && $selRanges == $current_Years) { // all year
  $sql = "INSERT INTO payment_history (TD_ARP, TAXPAYER_NAME, ADDRESS, CLASSIFICATION, ASSESSED_VALUE, SEF, BASIC, SUBTOTAL, DISCOUNT, PENALTY, TOTAL_PAYMENT, BASIC_REPORT, SEF_REPORT, DATE, PAYMENT_YEAR, LAST_PAYMENT, PAYOR, USERS_NAME) values 
  (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  $stmt = mysqli_prepare($con,$sql);
  mysqli_stmt_bind_param($stmt, 'ssssssssssssssssss', $td_arp, $tpname, $address, $classifications, $ass_val, $rpt_sef, $rpt_sef, $subtotal, $sub_disc, $sub_pena, $tot_val, $basic_report, $sef_report, $sel_date, $selYears, $selRanges, $payors_name, $uname);
  
  $sqls = "INSERT INTO payment_history_backup (TD_ARP, TAXPAYER_NAME, ADDRESS, CLASSIFICATION, ASSESSED_VALUE, SEF, BASIC, SUBTOTAL, DISCOUNT, PENALTY, TOTAL_PAYMENT, BASIC_REPORT, SEF_REPORT, DATE, PAYMENT_YEAR, LAST_PAYMENT, PAYOR, USERS_NAME) values 
  (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  $stmts = mysqli_prepare($con,$sqls);
  mysqli_stmt_bind_param($stmts, 'ssssssssssssssssss', $td_arp, $tpname, $address, $classifications, $ass_val, $rpt_sef, $rpt_sef, $subtotal, $sub_disc, $sub_pena, $tot_val, $basic_report, $sef_report, $sel_date, $selYears, $selRanges, $payors_name, $uname);
 
}
}}

else{// no history
  $sql = "INSERT INTO payment_history (TD_ARP, TAXPAYER_NAME, ADDRESS, CLASSIFICATION, ASSESSED_VALUE, SEF, BASIC, SUBTOTAL, DISCOUNT, PENALTY, TOTAL_PAYMENT, BASIC_REPORT, SEF_REPORT, DATE, LAST_PAYMENT, PAYOR, USERS_NAME) values 
  (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  $stmt = mysqli_prepare($con,$sql);
  mysqli_stmt_bind_param($stmt, 'sssssssssssssssss', $td_arp, $tpname, $address, $classifications, $ass_val, $rpt_sef, $rpt_sef, $subtotal, $sub_disc, $sub_pena, $tot_val, $basic_report, $sef_report, $currentDate, $current_Years, $payors_name, $uname);

  $sqls = "INSERT INTO payment_history_backup (TD_ARP, TAXPAYER_NAME, ADDRESS, CLASSIFICATION, ASSESSED_VALUE, SEF, BASIC, SUBTOTAL, DISCOUNT, PENALTY, TOTAL_PAYMENT, BASIC_REPORT, SEF_REPORT, DATE, LAST_PAYMENT, PAYOR, USERS_NAME) values 
  (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  $stmts = mysqli_prepare($con,$sqls);
  mysqli_stmt_bind_param($stmts, 'sssssssssssssssss', $td_arp, $tpname, $address, $classifications, $ass_val, $rpt_sef, $rpt_sef, $subtotal, $sub_disc, $sub_pena, $tot_val, $basic_report, $sef_report, $currentDate, $current_Years, $payors_name, $uname);


}





if(mysqli_stmt_execute($stmt)){
  if(mysqli_stmt_execute($stmts)){
   mysqli_close($con);
   echo 'success';
   return false;
  }
}else{
  echo 'fail';
  die('mysqli error: '.mysqli_error($con));
  return false;
} ?>