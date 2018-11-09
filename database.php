<?php
$server = '192.168.100.16';
$username = 'admin_root';
$password = 'Cyber@95131';
$database = 'admin_mtg_notes';

$connection = mysqli_connect($server, $username, $password);
if (!$connection) {
	die("Database Connection Failed" . mysqli_error($connection));
}

$select_db = mysqli_select_db($connection, $database);
if (!$select_db) {
	die("Database Selection Failed" . mysqli_error($connection));
}

?>
