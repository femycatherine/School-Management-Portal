<?php
session_start();
$ip = $_SERVER ['REMOTE_ADDR'];
ini_set('error_reporting', E_ALL & ~E_NOTICE);
if($_SESSION['portal_username']=='') { header('Location: login.php'); }

?>