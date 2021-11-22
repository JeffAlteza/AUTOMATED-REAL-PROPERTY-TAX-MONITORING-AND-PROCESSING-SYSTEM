<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  session_destroy();
  exit;
}
include('connection.php');
$barangay = $_SESSION['barangay'];
$user_id = $_POST['id'];
switch ($barangay) {
    	case 'bangin':
            $sql = "DELETE FROM bangin WHERE ID=?";
            break;
        case 'banyaga':
            $sql = "DELETE FROM banyaga WHERE ID=?";
            break;
        case 'bilibinwang':
            $sql = "DELETE FROM bilibinwang WHERE ID=?";
            break;
        case 'coral_na_munti':
            $sql = "DELETE FROM coral_na_munti WHERE ID=?";
            break;
        case 'pamiga':
            $sql = "DELETE FROM pamiga WHERE ID=?";
            break;
        case 'pansipit':
            $sql = "DELETE FROM pansipit WHERE ID=?";
            break;
        case 'poblacion':
            $sql = "DELETE FROM poblacion WHERE ID=?";
            break;
        case 'pook':
            $sql = "DELETE FROM pook WHERE ID=?";
            break;
        case 'san_jacinto':
            $sql = "DELETE FROM san_jacinto WHERE ID=?";
            break;
        case 'subic_ibaba':
            $sql = "DELETE FROM subic_ibaba WHERE ID=?";
            break;
        case 'subic_ilaya':
            $sql = "DELETE FROM subic_ilaya WHERE ID=?";
            break;
    default:
    echo '<script>alert("Please select specific Barangay")</script>';
        break;
};
$stmt = mysqli_prepare($con,$sql);
mysqli_stmt_bind_param($stmt, 'i', $user_id );
if (mysqli_stmt_execute($stmt)) {
    $data = array(
        'status' => 'success',
    );
    echo json_encode($data);
} else {
    $data = array(
        'status' => 'failed',
    );
    echo json_encode($data);
}
