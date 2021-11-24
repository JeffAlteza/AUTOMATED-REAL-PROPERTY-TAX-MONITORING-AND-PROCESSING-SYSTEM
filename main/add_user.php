<?php 

session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  session_destroy();
  exit;
}
include('connection.php');
$addemail = $_POST['addemails'];
$activate = "ACTIVE";
$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
$lname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
$roles = filter_var($_POST['roles'], FILTER_SANITIZE_STRING);
$pwords = filter_var($_POST['pwords'], FILTER_SANITIZE_STRING);
$pwordss = md5($pwords);

$sql = "INSERT INTO `accounts` (`Username`,`FirstName`,`lastName`,`priv`,`Password`,`email`,`status`) values (?,?,?,?,?,?,? )";


$stmt = mysqli_prepare($con,$sql);
mysqli_stmt_bind_param($stmt, 'sssssss', $username, $fname, $lname, $roles, $pwordss, $addemail, $activate);

if(mysqli_stmt_execute($stmt))
{
   
    $data = array(
        'status'=>'true',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 

?>