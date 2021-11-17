<?php 

session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  session_destroy();
  exit;
}
include('connection.php');
$td_arp = htmlspecialchars($_POST['tdap']);
$classification =($_POST['classification']);
$fname = ($_POST['name']);
$adds = htmlspecialchars($_POST['add']);
$AV = htmlspecialchars($_POST['av_field']);


$barangays = $_SESSION['barangay'];
switch($barangays) {
    
    case 'bangin':
		$sql = "INSERT INTO `bangin` (`TD_ARP`,`NAME`,`AV_2021`,`ADDRESS`, `CLASSIFICATION` ) values (?,?,?,?,?) ";
		break;
	case 'banyaga':
		$sql = "INSERT INTO `banyaga` (`TD_ARP`,`NAME`,`AV_2021`,`ADDRESS`, `CLASSIFICATION` ) values (?,?,?,?,?) ";
		break;
	case 'bilibinwang':
		$sql = "INSERT INTO `bilibinwang` (`TD_ARP`,`NAME`,`AV_2021`,`ADDRESS`, `CLASSIFICATION` ) values (?,?,?,?,?) ";
		break;
	case 'coral_na_munti':
		$sql = "INSERT INTO `coral_na_munti` (`TD_ARP`,`NAME`,`AV_2021`,`ADDRESS`, `CLASSIFICATION` ) values (?,?,?,?,?) ";
		break;
	case 'pamiga':
		$sql = "INSERT INTO `pamiga` (`TD_ARP`,`NAME`,`AV_2021`,`ADDRESS`, `CLASSIFICATION` ) values (?,?,?,?,?) ";
		break;
	case 'pansipit':
		$sql = "INSERT INTO `pansipit` (`TD_ARP`,`NAME`,`AV_2021`,`ADDRESS`, `CLASSIFICATION` ) values (?,?,?,?,?) ";
		break;
	case 'poblacion':
		$sql = "INSERT INTO `poblacion` (`TD_ARP`,`NAME`,`AV_2021`,`ADDRESS`, `CLASSIFICATION` ) values (?,?,?,?,?) ";
		break;
	case 'pook':
		$sql = "INSERT INTO `pook` (`TD_ARP`,`NAME`,`AV_2021`,`ADDRESS`, `CLASSIFICATION` ) values (?,?,?,?,?) ";
		break;
	case 'san_jacinto':
		$sql = "INSERT INTO `san_jacinto` (`TD_ARP`,`NAME`,`AV_2021`,`ADDRESS`, `CLASSIFICATION` ) values (?,?,?,?,?) ";
		break;
	case 'subic_ibaba':
		$sql = "INSERT INTO `subic_ibaba` (`TD_ARP`,`NAME`,`AV_2021`,`ADDRESS`, `CLASSIFICATION` ) values (?,?,?,?,?) ";
		break;
	case 'subic_ilaya':
		$sql = "INSERT INTO `subic_ilaya` (`TD_ARP`,`NAME`,`AV_2021`,`ADDRESS`, `CLASSIFICATION` ) values (?,?,?,?,?) ";
		break;
    default:
    echo '<script>alert("Please select specific Barangay")</script>';
	break;
}
//$sql = "INSERT INTO `poblacion` (`TD_ARP`,`NAME`,`AV_2021`,`ADDRESS`) values ('$td_arp', '$fname', '$AV','$adds' )";


$stmt = mysqli_prepare($con,$sql);
mysqli_stmt_bind_param($stmt, 'ssiss', $td_arp, $fname, $AV,$adds, $classification);

if(mysqli_stmt_execute($stmt)){
   
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