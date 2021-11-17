<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  session_destroy();
  exit;
}
require 'connection.php';

//Define the query\
$historyId = $_POST['id'];
$cancelled = 'CANCELLED';
$zero = 0;
//$query = "DELETE FROM payment_history WHERE RECEIPT_NO = ?";
//$query = "UPDATE `payment_history` SET  `TAXPAYER_NAME`=? , `TD_ARP`= ?, `ASSESSED_VALUE`= ?, `ADDRESS`=?, `CLASSIFICATION`=? `BASIC`=? , `SEF`= ?, `SUBTOTAL`= ?, `DISCOUNT`=?, `PENALTY`=?, `PAYMENT_YEAR`= ?, `LAST_PAYMENT`=?, `PAYOR`=?, `USERS_NAME`=?, `BASIC_REPORT`=?, `SEF_REPORT`=?  WHERE id=? ";	
$sql ="UPDATE `payment_history` SET `TD_ARP`= ?,`TAXPAYER_NAME`=?,`ADDRESS`=?,`CLASSIFICATION`=?,`ASSESSED_VALUE`=?,`BASIC`=?,`SEF`=?,`SUBTOTAL`=?,`DISCOUNT`=?,`PENALTY`=?,`TOTAL_PAYMENT`=?,`BASIC_REPORT`=?,`SEF_REPORT`=?,`PAYMENT_YEAR`=?,`LAST_PAYMENT`=?,`PAYOR`=?,`USERS_NAME`=? WHERE `RECEIPT_NO` =? ";
$stmt = mysqli_prepare($con,$sql);
mysqli_stmt_bind_param($stmt, 'ssssiiiiiiiiiiissi',$cancelled,$cancelled,$cancelled,$cancelled,$zero,$zero,$zero,$zero,$zero,$zero,$zero,$zero,$zero,$zero,$zero,$cancelled,$cancelled, $historyId );

if(mysqli_stmt_execute($stmt)){
    mysqli_close($con);
    echo $historyId;
    echo 'success';
    return false;
} else { 
    echo 'fail';
  die('mysqli error: '.mysqli_error($con));
  return false;
}



?>