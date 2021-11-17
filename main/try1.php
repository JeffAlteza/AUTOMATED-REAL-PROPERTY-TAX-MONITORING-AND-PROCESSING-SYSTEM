<?php
session_start();
$sel_year = ($_POST['selected']);
            $_SESSION['SEL_YEAR']= $sel_year;
$sel_range = ($_POST['selected_range']);
    $_SESSION['SEL_RANGE']= $sel_range;
?>