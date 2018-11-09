<?php 
session_start();
require 'database.php';
	$recnum = $_POST['idfield2'];
	$repname = $_POST['repName2'];
	$nteType = $_POST['nteType2'];
	$indate = $_POST['inDate2'];
	$job = $_POST['job2'];
	$phase = $_POST['phase2'];
	$costCode = $_POST['costCode2'];
	$enteredby = $_POST['enteredBy2'];
	$notes =  htmlspecialchars($_POST['notes2'], ENT_QUOTES);

	if(empty($indate) || empty($repname) || empty($nteType) || empty($job) || empty($enteredby) || empty($notes))
	{
    	$message = "One or more fields have been left blank" . "<br>";
    }
	else
	{
		$recordUpdate = "UPDATE `notes` SET note_dt='$indate', jobnum='$job', usrnme='$enteredby', report_name='$repname', cost_code='$costCode', phase='$phase', meeting_type='$nteType', note='$notes' WHERE id='$recnum'";
	}

	if (mysqli_query($connection, $recordUpdate)) 
	{
    	$message = "New record created successfully";
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