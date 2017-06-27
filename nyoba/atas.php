<?php include 'config/config.php'; ?>
<?php include 'libraries/Database.php'; ?>
<?php include 'helpers/format_helpers.php'; ?>
<?php
  include "connect.php";
  if($_SESSION['status'] == "User" || $_SESSION['status'] == "Admin" || $_SESSION['status'] == "Sponsor" || $_SESSION['status'] == "Panitia" ){
   	$id = $_SESSION['id'];
	$query = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id'");
	$result = mysqli_fetch_array($query);
} ?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
<link rel="stylesheet" href="css/w3.css">
<script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Damion" rel="stylesheet">
<link rel="stylesheet" href="css/font.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
<link rel="stylesheet" href="admin/kampret.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">

<!-- w3-content defines a container for fixed size centered content,
and is wrapped around the whole page content, except for the footer in this example -->
<div class="w3-content" style="max-width:1400px">

  <div class="w3-responsive w3-bar w3-blue w3-card-8">
      <span class="w3-bar-item" style="font-family:'Damion'; font-size:18px">EventCentral</span>
          <a href="index.php"><span class="w3-hover-text-black  w3-bar-item"><i class="fa fa-home"></i>Home</span></a>
          <a href="all_post.php"><span class="w3-hover-text-black  w3-bar-item"><i class="fa fa-list-ul"></i>All Event</span></a>
          <a href="list_sponsor.php"><span class="w3-hover-text-black  w3-bar-item"><i class="fa fa-usd"></i>List Sponsor</span></a>
          <?php if($_SESSION['status']=="Admin" ){ ?>
            <a href="admin/index.php"><span class="w3-hover-text-black  w3-bar-item"><i class="fa fa-tachometer"></i>Dashboard</span></a>
          <?php } ?>
        <?php if($_SESSION['status'] == "User" || $_SESSION['status'] == "Admin" || $_SESSION['status'] == "Sponsor" || $_SESSION['status'] == "Panitia" ) {?>
        <a href="profile.php?id=<?php echo urlencode($id); ?>"> <span><img style="height:37px; width:37px; margin-top:0" class="w3-hover-shadow w3-right avatar" src="<?php echo $result['avatar']; ?>"></span> </a>
            <div class="w3-right w3-bar-item w3-display-top">Welcome <strong><?php echo $result['nama']; ?></strong></div>
          <a href="admin/logout.php" style="text-decoration:none;" class="w3-hover-text-black w3-bar-item w3-right w3-text-white"><i class="fa fa-sign-out"></i>Log out</a>
        <?php } ?>
          <?php if($_SESSION['status'] == "nouser") { ?>
          <a href="login/register.php"><span class="w3-right w3-hover-text-black  w3-bar-item"><i class="fa fa-address-book-o"></i>Register</span></a>
          <a href="login/loglog.php"><span class="w3-right w3-hover-text-black  w3-bar-item"><i class="fa fa-sign-in"></i>Log in</span></a>
          <?php } ?>
  </div>
