<?php  
session_start();
$barangay = ($_POST['selected']);
$_SESSION['barangay'] = $barangay;
echo $_SESSION['barangay'];
?>
	