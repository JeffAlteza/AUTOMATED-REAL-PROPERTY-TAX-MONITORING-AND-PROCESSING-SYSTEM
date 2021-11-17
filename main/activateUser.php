<?php 

session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  session_destroy();
  exit;
}
include('connection.php');
$id = filter_var($_POST['id'], FILTER_SANITIZE_STRING);
$deactivate = "ACTIVE";

    $sql = "UPDATE `accounts` SET  `status`=? WHERE `id`=? ";
    $stmt = mysqli_prepare($con,$sql);
    mysqli_stmt_bind_param($stmt,'si', $deactivate, $id);



if (mysqli_stmt_execute($stmt)) {
    $data = array(
        'status'=>'success',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'fail',
      
    );

    echo json_encode($data);
} 

?>