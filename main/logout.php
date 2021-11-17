<?php
// clear all the session variables and redirect to index
session_start();
session_unset();
session_write_close();
unset($_SESSION["login"]);
session_destroy();
header("Location:records.php");
?>