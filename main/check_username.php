<?php

session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  session_destroy();
  exit;
}
include 'connection.php';
//$_POST['username'] = "asdsa";
$query = "SELECT Username FROM accounts WHERE Username = '".$_POST['username']."'";
$result_login = mysqli_query($con,$query);
$anything_found = mysqli_num_rows($result_login);

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
