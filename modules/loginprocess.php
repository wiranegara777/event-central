<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>My page</title>

    <!-- CSS dependencies -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>

    <!-- JS dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- bootbox code -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>



<?php
	include "connect.php";

	$email = $_POST['emailmhs'];
	$pass =  $_POST['passmhs'];
	$query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email' and password='$pass'");
	$query2 = mysqli_query($conn, "SELECT * FROM user WHERE nama='$email' and password='$pass'");

  $result = mysqli_fetch_array($query);

  $result2 = mysqli_fetch_array($query2);

	if ($result) {
		$_SESSION['id'] = $result['id'];
				if($result['otoritas'] == 1)
				{
					$_SESSION['status'] = 'Admin';
					}
				else if($result['otoritas'] == 2)
				{
					$_SESSION['status'] = 'Sponsor';
					}
				else if($result['otoritas'] == 3)
				{
					$_SESSION['status'] = 'Panitia';
					}
				else if($result['otoritas'] == 4)
				{
					$_SESSION['status'] = 'User';
					}
?>
		<!-- <script language="javascript">alert("Login Successful");</script> -->
		<!-- <script>bootbox.alert("Anda Sukses Login!");</script> -->
		<script> bootbox.alert({
													message: "Log in Successful",
													className: 'bb-alternate-modal',
													callback: function(){ document.location.href='../index.php'; }
													}); </script>


		<!--<script>document.location.href='../admin/index.php';</script>-->
		<!-- <script>document.location.href='../index.php';</script> -->
<?php
	}else if($result2){
		$_SESSION['id'] = $result2['id'];
				if($result2['otoritas'] == 1)
				{
					$_SESSION['status'] = 'Admin';
					}
				else if($result2['otoritas'] == 2)
				{
					$_SESSION['status'] = 'Sponsor';
					}
				else if($result2['otoritas'] == 3)
				{
					$_SESSION['status'] = 'Panitia';
					}
				else if($result2['otoritas'] == 4)
				{
					$_SESSION['status'] = 'User';
					}
?>
			<script language="javascript">alert("Login Successful");</script>

			<!--<script>document.location.href='../admin/index.php';</script>-->
			<script>document.location.href='../index.php';</script>

<?php	}else{
?>
		<script> bootbox.alert("Log in Failed", function(){ document.location.href='../index.php' }); </script>
<?php
	}
	mysqli_close($conn);
?>


</body>
</html>
