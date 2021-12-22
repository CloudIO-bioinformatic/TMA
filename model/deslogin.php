<?php
session_start();
session_unset();
unset($_SESSION);
$_SESSION=array();
session_destroy();
header("Location:../vista/login.php");
?>
