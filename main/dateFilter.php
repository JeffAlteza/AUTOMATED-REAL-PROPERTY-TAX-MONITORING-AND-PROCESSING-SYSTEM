<?php  
session_start();
if(isset($_POST['selectDate1'])){
    $selected1 = ($_POST['selectDate1']);
    $_SESSION['selectDate1'] = $selected1;
}
if(isset($_POST['selectDate2'])){
    $selected2 = ($_POST['selectDate2']);
    $_SESSION['selectDate2'] = $selected2;
}
?>