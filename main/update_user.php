<?php 

session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  session_destroy();
  exit;
}
include('connection.php');
$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$email = $_POST['email'];
$fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
$lname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
$roles = filter_var($_POST['roles'], FILTER_SANITIZE_STRING);
$ids = filter_var($_POST['ids'], FILTER_SANITIZE_STRING);
$password = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
$pass = md5($password);

if($password==""){
    $sql = "UPDATE `accounts` SET  `Username`=?, `FirstName`=?, `lastName`=?,  `priv`=?, `email`=? WHERE `id`=? ";
    $stmt = mysqli_prepare($con,$sql);
    mysqli_stmt_bind_param($stmt,'sssssi',$username, $fname, $lname, $roles, $email, $ids);

}else{ 
    $sql = "UPDATE `accounts` SET  `Username`=?, `FirstName`=?, `lastName`=?, `Password`=?, `priv`=?, `email`=? WHERE `id`=? ";
    $stmt = mysqli_prepare($con,$sql);
    mysqli_stmt_bind_param($stmt,'ssssssi',$username, $fname, $lname, $pass, $roles, $email, $ids);
}



if (mysqli_stmt_execute($stmt)) {
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