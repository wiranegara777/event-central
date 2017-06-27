<?php
	include "connect.php";
	$cek =0;

	$email    = $_POST['email'];
	$pass     = $_POST['password'];
	$name     = $_POST['nama'];
	$confirm  = $_POST['confirm'];
	$otoritas = $_POST['otoritas'];

	$query = "SELECT * FROM user";
	$jalan = mysqli_query($conn,$query);
while($row = mysqli_fetch_assoc($jalan))
{
	if($row['email'] == $email)
	{$cek =1;}
}
if($pass != $confirm) {$cek = 1;}
if($cek == 0){
	$sql_buat = "INSERT INTO user(id, email, password, nama, otoritas) VALUE('','$email','$pass','$name','$otoritas')";

	if (mysqli_query($conn, $sql_buat)){
		$query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
  	$result = mysqli_fetch_array($query);
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
		<script language="javascript">alert("Register Successful");</script>
		<script>document.location.href='../index.php';</script>
<?php
	}
	else{
?>
		<script language="javascript">alert("Register Failed");</script>
		<script>document.location.href='../index.php';</script>
<?php
	}
}
else { ?>
	<script language="javascript">alert("Email telah digunakan!");</script>
	<script>document.location.href='../index.php';</script>
<?php }
	mysqli_close($conn);
?>
