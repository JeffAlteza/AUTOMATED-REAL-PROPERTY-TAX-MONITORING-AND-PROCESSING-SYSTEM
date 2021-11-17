<?php 

session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  session_destroy();
  exit;
}
include('connection.php');

$barangay = $_SESSION['barangay'];
$username = ($_POST['username']);
$tdaps = htmlspecialchars($_POST['td_arps']);
$adrrs = htmlspecialchars($_POST['addr']);
$idss = htmlspecialchars($_POST['ids']);
$AVS = htmlspecialchars($_POST['avs']);
$classifications = ($_POST['classifications']);

switch($barangay) {
        
    case 'bangin':
		$sql = "UPDATE `bangin` SET  `NAME`=? , `TD_ARP`= ?, `AV_2021`= ?, `ADDRESS`=?, `CLASSIFICATION`=? WHERE id=? ";
		break;
	case 'banyaga':
		$sql = "UPDATE `banyaga` SET  `NAME`=? , `TD_ARP`= ?, `AV_2021`= ?, `ADDRESS`=?, `CLASSIFICATION`=? WHERE id=? ";
		break;
	case 'bilibinwang':
		$sql = "UPDATE `bilibinwang` SET  `NAME`=? , `TD_ARP`= ?, `AV_2021`= ?, `ADDRESS`=?, `CLASSIFICATION`=? WHERE id=? ";
		break;
	case 'coral_na_munti':
		$sql = "UPDATE `coral_na_munti` SET  `NAME`=? , `TD_ARP`= ?, `AV_2021`= ?, `ADDRESS`=?, `CLASSIFICATION`=? WHERE id=? ";
		break;
	case 'pamiga':
		$sql = "UPDATE `pamiga` SET  `NAME`=? , `TD_ARP`= ?, `AV_2021`= ?, `ADDRESS`=?, `CLASSIFICATION`=? WHERE id=? ";
		break;
	case 'pansipit':
		$sql = "UPDATE `pansipit` SET  `NAME`=? , `TD_ARP`= ?, `AV_2021`= ?, `ADDRESS`=?, `CLASSIFICATION`=? WHERE id=? ";
		break;
	case 'poblacion':
		$sql = "UPDATE `poblacion` SET  `NAME`=? , `TD_ARP`= ?, `AV_2021`= ?, `ADDRESS`=?, `CLASSIFICATION`=? WHERE id=? ";
		break;
	case 'pook':
		$sql = "UPDATE `pook` SET  `NAME`=? , `TD_ARP`= ?, `AV_2021`= ?, `ADDRESS`=?, `CLASSIFICATION`=? WHERE id=? ";
		break;
	case 'san_jacinto':
		$sql = "UPDATE `san_jacinto` SET  `NAME`=? , `TD_ARP`= ?, `AV_2021`= ?, `ADDRESS`=?, `CLASSIFICATION`=? WHERE id=? ";
		break;
	case 'subic_ibaba':
		$sql = "UPDATE `subic_ibaba` SET  `NAME`=? , `TD_ARP`= ?, `AV_2021`= ?, `ADDRESS`=?, `CLASSIFICATION`=? WHERE id=? ";
		break;
	case 'subic_ilaya':
		$sql = "UPDATE `subic_ilaya` SET  `NAME`=? , `TD_ARP`= ?, `AV_2021`= ?, `ADDRESS`=?, `CLASSIFICATION`=? WHERE id=? ";
		break;
	default:

	break;
}

$stmt = mysqli_prepare($con,$sql);
mysqli_stmt_bind_param($stmt,'sssssi',$username, $tdaps, $AVS, $adrrs, $classifications, $idss);
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