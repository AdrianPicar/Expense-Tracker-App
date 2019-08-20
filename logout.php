<?php
session_start();

$_SESSION["username"] = "";

//session_destroy();
//session_write_close();
//setcookie("PHPSESSID",'',0,'/');
header('LOCATION: index.php');
?>
