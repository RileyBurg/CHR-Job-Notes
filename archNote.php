<?php 
session_start();
require 'database.php';
$recnum = $_POST['idfield'];

$archRecord = "UPDATE `notes` SET archive='1' WHERE id='$recnum'";

if (mysqli_query($connection, $archRecord)) {
    	echo "Record updated successfully";
	} 	

?>

<!DOCTYPE html>
<html>
<head>
	<title>Time Submit</title>
	<meta http-equiv="refresh" content="0; url=http://notes.chreynolds.local/MeetingEntry.php" />
</head>
<body onload="MeetingEntry.php">

</body>
</html>