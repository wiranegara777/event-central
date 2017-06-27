<?php
	$conn = mysqli_connect('localhost', 'root', '', 'event')
	or die ("Connection Failed".mysqli_error());
	session_start();
	if(!(isset($_SESSION['id']))) {
		$_SESSION['status'] = "nouser";
	}
?>
