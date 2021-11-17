<?php 
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  session_destroy();
  exit;
}
include('connection.php');

$user_id = $_POST['id'];
$sql = "DELETE FROM accounts WHERE ID=?";


$stmt = mysqli_prepare($con,$sql);
mysqli_stmt_bind_param($stmt, 'i', $user_id );
if (mysqli_stmt_execute($stmt)) {
	 $data = array(
        'status'=>'success',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'failed',
      
    );

    echo json_encode($data);
} 

?>