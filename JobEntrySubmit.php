<?php 
session_start();
require 'database.php';
	
	$_SESSION["message"] ="";

		$repname = $_POST['repName'];
		$nteType = $_POST['nteType'];
		$indate = $_POST['inDate'];
		$job = $_POST['job'];
		$phase = $_POST['phase'];
		$costCode = $_POST['costCode'];
		$enteredby = $_POST['enteredBy'];
		$notes =  htmlspecialchars($_POST['notes'], ENT_QUOTES);

	if(empty($indate) || empty($repname) || empty($nteType) || empty($job) || empty($enteredby) || empty($notes))
	{
    	$_SESSION["message"] = "One or more fields have been left blank" . "<br>";
    }
	
	else
	{
		$timeRecord = "INSERT INTO `notes` (note_dt, jobnum, usrnme, report_name, cost_code, phase, meeting_type, note) VALUES ('$indate', '$job', '$enteredby', '$repname', '$costCode', '$phase', '$nteType', '$notes')";
	}
	
	if (mysqli_query($connection, $timeRecord)) 
	{
    	$_SESSION["message"] = "New record created successfully";
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
