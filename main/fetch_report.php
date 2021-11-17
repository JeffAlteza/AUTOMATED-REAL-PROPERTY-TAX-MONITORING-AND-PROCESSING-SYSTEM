<?php 
date_default_timezone_set('Asia/Manila');
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  session_destroy();
  exit;
}
include('connection.php');


$output= array();
$select1 = $_SESSION['selectDate1'];
$select2 = $_SESSION['selectDate2'];

$sql = "SELECT * FROM payment_history WHERE ";
if (($_SESSION['selectDate2']) == ''){
  $sql .= 'DATE = "'.$select1.'"';
} else if (($_SESSION['selectDate1']) == ''){
  $sql .= 'DATE = "'.$select2.'"';
} else {
  $sql .= 'DATE BETWEEN "'.$select1.'" AND "'.$select2.'"';
}
$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

echo mysqli_error($con);


if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$column_name." ".$order."";
}
else
{
	$sql .= " ORDER BY RECEIPT_NO asc";
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
	$sub_array[] = $row['RECEIPT_NO'];
	$sub_array[] = $row['TAXPAYER_NAME'];
	$sub_array[] = $row['ADDRESS'];
    $sub_array[] = $row['TD_ARP'];
    $sub_array[] = $row['CLASSIFICATION'];
	$sub_array[] = number_format($row['ASSESSED_VALUE'],2);
    if($row['PAYMENT_YEAR'] == 0){
        $sub_array[] = $row['LAST_PAYMENT']; 
      }else if($row['LAST_PAYMENT'] == 0){
        $sub_array[] = $row['PAYMENT_YEAR'];
      } else if($row['PAYMENT_YEAR'] != 0 && $row['LAST_PAYMENT'] != 0)  {
        $sub_array[]= $row['PAYMENT_YEAR'].'-'.$row['LAST_PAYMENT'];
      }
    $sub_array[] = number_format($row['BASIC'],2);
    $sub_array[] = number_format($row['SEF'],2);
    $sub_array[] = number_format($row['SUBTOTAL'],2);
    $sub_array[] = number_format($row['DISCOUNT'],2);
    $sub_array[] = number_format($row['PENALTY'],2);
    $sub_array[] = number_format($row['TOTAL_PAYMENT'],2);
    $sub_array[] = $row['DATE'];
    $sub_array[] = $row['PAYOR'];
    $sub_array[] = $row['USERS_NAME'];
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);







