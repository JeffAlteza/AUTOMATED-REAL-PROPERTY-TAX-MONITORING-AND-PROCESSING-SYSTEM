<?php

session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  session_destroy();
  exit;
}
include 'connection.php';
//$_POST['username'] = "asdsa";

$query = "SELECT * FROM payment_history WHERE RECEIPT_NO = '".$_POST['receipt_no']."'";
$results = mysqli_query($con,$query);
$anything_found = mysqli_num_rows($results);

if($anything_found>0)
{
    echo "fail";
    return false;  
}
else 
{ 
    echo "success"; 
    return false;    
}

?>