<?php
session_start();
require 'database.php';

if (isset($_POST['submit'])) {
	$emailbody = 'Entered By: ' .$_POST['name'] ."\n"
	.'Email Address: ' .$_POST['email'] ."\n"
	.'Date: ' .$_POST['Date'] ."\n"
	.'Job Number: ' .$_POST['job'] ."\n"
	.'Reason: ' .$_POST['reason'] ."\n"
	.'Note: ' .$_POST['my_text'] ."\n";

	mail($team, 'Job Notes', $emailbody);
	header('location: jobEntry.php')
}

?>
