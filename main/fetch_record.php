<?php 

session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  session_destroy();
  exit;
}
include('connection.php');


$output= array();
$barangay = $_SESSION['barangay'];
//$barangay = 'poblacion';
switch($barangay) {
	case 'bangin':
		$sql = "SELECT * FROM bangin";
		break;
	case 'banyaga':
		$sql = "SELECT * FROM banyaga";
		break;
	case 'bilibinwang':
		$sql = "SELECT * FROM bilibinwang";
		break;
	case 'coral_na_munti':
		$sql = "SELECT * FROM coral_na_munti";
		break;
	case 'pamiga':
		$sql = "SELECT * FROM pamiga";
		break;
	case 'pansipit':
		$sql = "SELECT * FROM pansipit";
		break;
	case 'poblacion':
		$sql = "SELECT * FROM poblacion";
		break;
	case 'pook':
		$sql = "SELECT * FROM pook";
		break;
	case 'san_jacinto':
		$sql = "SELECT * FROM san_jacinto";
		break;
	case 'subic_ibaba':
		$sql = "SELECT * FROM subic_ibaba";
		break;
	case 'subic_ilaya':
		$sql = "SELECT * FROM subic_ilaya";
		break;
	default:

	break;
}


$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);


 

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	switch($barangay) {
	case 'bangin':
		$sql = "SELECT * FROM bangin WHERE TD_ARP like '%".$search_value."%' OR NAME like '%".$search_value."%' OR ADDRESS like '%".$search_value."%' ";
		break;
	case 'banyaga':
		$sql = "SELECT * FROM banyaga WHERE TD_ARP like '%".$search_value."%' OR NAME like '%".$search_value."%' OR ADDRESS like '%".$search_value."%' ";
		break;
	case 'bilibinwang':
		$sql = "SELECT * FROM bilibinwang WHERE TD_ARP like '%".$search_value."%' OR NAME like '%".$search_value."%' OR ADDRESS like '%".$search_value."%' ";
		break;
	case 'coral_na_munti':
		$sql = "SELECT * FROM coral_na_munti WHERE TD_ARP like '%".$search_value."%' OR NAME like '%".$search_value."%' OR ADDRESS like '%".$search_value."%' ";
		break;
	case 'pamiga':
		$sql = "SELECT * FROM pamiga WHERE TD_ARP like '%".$search_value."%' OR NAME like '%".$search_value."%' OR ADDRESS like '%".$search_value."%' ";
		break;
	case 'pansipit':
		$sql = "SELECT * FROM pansipit WHERE TD_ARP like '%".$search_value."%' OR NAME like '%".$search_value."%' OR ADDRESS like '%".$search_value."%' ";
		break;
	case 'poblacion':
		$sql = "SELECT * FROM poblacion WHERE TD_ARP like '%".$search_value."%' OR NAME like '%".$search_value."%' OR ADDRESS like '%".$search_value."%' ";
		break;
	case 'pook':
		$sql = "SELECT * FROM pook WHERE TD_ARP like '%".$search_value."%' OR NAME like '%".$search_value."%' OR ADDRESS like '%".$search_value."%' ";
		break;
	case 'san_jacinto':
		$sql = "SELECT * FROM san_jacinto WHERE TD_ARP like '%".$search_value."%' OR NAME like '%".$search_value."%' OR ADDRESS like '%".$search_value."%' ";
		break;
	case 'subic_ibaba':
		$sql = "SELECT * FROM subic_ibaba WHERE TD_ARP like '%".$search_value."%' OR NAME like '%".$search_value."%' OR ADDRESS like '%".$search_value."%' ";
		break;
	case 'subic_ilaya':
		$sql = "SELECT * FROM subic_ilaya WHERE TD_ARP like '%".$search_value."%' OR NAME like '%".$search_value."%' OR ADDRESS like '%".$search_value."%' ";
		break;
		
		default:
			$sql = "SELECT * FROM poblacion WHERE TD_ARP like '%".$search_value."%' OR NAME like '%".$search_value."%' OR ADDRESS like '%".$search_value."%' ";
		break;
	}
	

}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$column_name." ".$order."";
}
else
{
	$sql .= " ORDER BY ID asc";
}

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}


$query = mysqli_query($con,$sql);
$count_rows = mysqli_num_rows($query);
$data = array();


while($row = mysqli_fetch_assoc($query))
{
	$sub_array = array();
	$sub_array[] = $row['ID'];
	$sub_array[] = $row['TD_ARP'];
	$sub_array[] = $row['NAME'];
	$sub_array[] = $row['ADDRESS'];
	$sub_array[] = number_format($row['AV_2021'], 2);
	$sub_array[] = '
	<span style="display: -webkit-box; display: -ms-flexbox; display: flex; text-align: right !important;">
	<a href="javascript:void(0);" data-id="'.$row['ID'].'" rel="tooltip" title="Edit" class="btn btn-primary btn-link btn-sm editbtn" style="margin: 0px; padding: 5px"><i class="material-icons">edit</i></a>
	<a href="javascript:void(0);" data-id="'.$row['ID'].'" rel="tooltip" title="Delete" class="btn btn-danger btn-link btn-sm deleteBtn" style="margin: 0px;  padding: 5px"><i class="material-icons">delete</i></a>
	<a href="payment.php?id='.$row['ID'].'&tdID='.$row['TD_ARP'].'" target="_blank" data-id="'.$row['ID'].'" rel="tooltip" title="Payment" class="btn btn-success btn-link btn-sm paymentBtn" style="margin: 0px;  padding: 5px"><i class="material-icons">payment</i></a>
	</span>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);







