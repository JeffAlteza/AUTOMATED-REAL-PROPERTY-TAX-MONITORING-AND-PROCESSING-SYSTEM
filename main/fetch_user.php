<?php 
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  session_destroy();
  exit;
}
include('connection.php');

$output= array();
$sql = "SELECT * FROM accounts ";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql = "SELECT * FROM accounts WHERE Username like '%".$search_value."%' OR FirstName like '%".$search_value."%' OR lastName like '%".$search_value."%' OR priv like '%".$search_value."%'";

}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$column_name." ".$order."";
}
else
{
	$sql .= " ORDER BY ID desc";
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
	$sub_array[] = $row['Username'];
	$sub_array[] = $row['FirstName'];
	$sub_array[] = $row['lastName'];
	$sub_array[] = $row['priv'];
	$sub_array[] = $row['status'];
	if($row['priv'] == 'Admin'){
		$sub_array[] = '
			<span style="display: -webkit-box; display: -ms-flexbox; display: flex; text-align: right !important;">
			<a  rel="tooltip" title="Deactivate" data-bs-toggle="modal" data-bs-target="#faildeact" class="btn btn-success btn-link btn-sm deactAdmin" style="margin: 0px; padding: 5px"><i class="material-icons">lock_open</i></a>
			<a  rel="tooltip" href="javascript:void(0);" data-id="'.$row['ID'].'" title="Edit" class="btn btn-primary btn-link btn-sm editbtn" style="margin: 0px; padding: 5px"><i class="material-icons">edit</i></a>
			<a  rel="tooltip" title="Delete" data-bs-toggle="modal" data-bs-target="#faildelete" class="btn btn-danger btn-link btn-sm deleteAdmin" style="margin: 0px;  padding: 5px"><i class="material-icons">delete</i></a>
			</span>';
	}
	if($row['status'] == 'ACTIVE'){
		$sub_array[] = '
			<span style="display: -webkit-box; display: -ms-flexbox; display: flex; text-align: right !important;">
			<a href="javascript:void(0);" data-id="'.$row['ID'].'"  rel="tooltip" title="Deactivate" class="btn btn-success btn-link btn-sm deactivatebtn" style="margin: 0px; padding: 5px"><i class="material-icons">lock_open</i></a>
			<a href="javascript:void(0);" data-id="'.$row['ID'].'"  rel="tooltip" title="Edit" class="btn btn-primary btn-link btn-sm editbtn" style="margin: 0px; padding: 5px"><i class="material-icons">edit</i></a>
			<a href="javascript:void(0);" data-id="'.$row['ID'].'"  rel="tooltip" title="Delete" class="btn btn-danger btn-link btn-sm deleteBtn" style="margin: 0px;  padding: 5px"><i class="material-icons">delete</i></a>
			</span>';
	} else {
	$sub_array[] = '
	<span style="display: -webkit-box; display: -ms-flexbox; display: flex; text-align: right !important;">
	<a href="javascript:void(0);" data-id="'.$row['ID'].'"  rel="tooltip" title="Activate" class="btn btn-warning btn-link btn-sm activatebtn" style="margin: 0px; padding: 5px"><i class="material-icons">lock</i></a>
	<a href="javascript:void(0);" data-id="'.$row['ID'].'"  rel="tooltip" title="Edit" class="btn btn-primary btn-link btn-sm editbtn" style="margin: 0px; padding: 5px"><i class="material-icons">edit</i></a>
	<a href="javascript:void(0);" data-id="'.$row['ID'].'"  rel="tooltip" title="Delete" class="btn btn-danger btn-link btn-sm deleteBtn" style="margin: 0px;  padding: 5px"><i class="material-icons">delete</i></a>
	</span>';
	}
	$data[] = $sub_array;
}



$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);









