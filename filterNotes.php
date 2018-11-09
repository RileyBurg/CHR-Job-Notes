<?php 
session_start();
require 'database.php';
$jobnum = $_POST['sendFilter'];
$_SESSION["jobnum"] = $jobnum;
?>