<?php include '../config/config.php'; ?>
<?php include '../libraries/Database.php'; ?>
<?php include '../helpers/format_helpers.php'; ?>
<?php
    include "connect.php";
    if($_SESSION['status'] == "Admin"){
    	$id = $_SESSION['id'];
  	$query = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id'");
  	$result = mysqli_fetch_array($query);
    } else { ?>
    <script language="javascript">alert("You are not allowed here die!");</script>
		<script>document.location.href='../index.php';</script>
  <?php } ?>

<!DOCTYPE html>
<html>
<title>Admin | EventCentral</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/font.css">
<link rel="stylesheet" href="kampret.css">
<link href="https://fonts.googleapis.com/css?family=Damion" rel="stylesheet">
<link rel="stylesheet" href="../css/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">

<!-- Top container -->
<!-- <div class="w3-card-4 w3-bar w3-top w3-teal w3-large" style="z-index:4"> -->
<div class="w3-top w3-bar w3-teal w3-card-8">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>Menu</button>
  <a href="../index.php"><span class="w3-hover-text-black w3-bar-item w3-left w3-text-white" style="font-family:Damion; font-size:18px;">EventCentral</span></a>
<?php if($_SESSION['status'] == "Admin") {?>
  <a href="logout.php" style="text-decoration:none;" ><span class="w3-hover-text-black w3-bar-item w3-right w3-text-white" ><i class="fa fa-sign-out"></i> Log out</span></a>
<?php } ?>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="../<?php echo $result['avatar']; ?>" class="w3-circle" style="height:46px; width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Welcome Admin! <strong><?php echo $result['nama']; ?></strong></span><br>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="index.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Overview</a>
    <a href="add_post.php" class="w3-bar-item w3-button w3-padding w3-hover-teal"><i class="fa fa-pencil-square-o"></i> Add New Event</a>
    <a href="add_category.php" class="w3-bar-item w3-button w3-padding w3-hover-teal"><i class="fa fa-bookmark"></i> Add New Category</a>
  </div>
</nav>

<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">
