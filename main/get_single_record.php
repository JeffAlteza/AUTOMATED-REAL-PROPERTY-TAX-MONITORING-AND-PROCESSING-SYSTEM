<?php

session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  session_destroy();
  exit;
}
include('connection.php');


$ids = $_POST['id'];
$barangay = $_SESSION['barangay'];
//$barangay = 'poblacion';
switch($barangay) {
	case 'bangin':
		$sql = "SELECT * FROM bangin WHERE ID='$ids' LIMIT 1";
		break;
	case 'banyaga':
		$sql = "SELECT * FROM banyaga WHERE ID='$ids' LIMIT 1";
		break;
	case 'bilibinwang':
		$sql = "SELECT * FROM bilibinwang WHERE ID='$ids' LIMIT 1";
		break;
	case 'coral_na_munti':
		$sql = "SELECT * FROM coral_na_munti WHERE ID='$ids' LIMIT 1";
		break;
	case 'pamiga':
		$sql = "SELECT * FROM pamiga WHERE ID='$ids' LIMIT 1";
		break;
	case 'pansipit':
		$sql = "SELECT * FROM pansipit WHERE ID='$ids' LIMIT 1";
		break;
	case 'poblacion':
		$sql = "SELECT * FROM poblacion WHERE ID='$ids' LIMIT 1";
		break;
	case 'pook':
		$sql = "SELECT * FROM pook WHERE ID='$ids' LIMIT 1";
		break;
	case 'san_jacinto':
		$sql = "SELECT * FROM san_jacinto WHERE ID='$ids' LIMIT 1";
		break;
	case 'subic_ibaba':
		$sql = "SELECT * FROM subic_ibaba WHERE ID='$ids' LIMIT 1";
		break;
	case 'subic_ilaya':
		$sql = "SELECT * FROM subic_ilaya WHERE ID='$ids' LIMIT 1";
		break;
	echo '<script>alert("Please select specific Barangay")</script>';
	default:

	break;
}



$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
?>
