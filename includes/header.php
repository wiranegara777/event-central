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
      <span class="w3-mobile w3-bar-item" style="font-family:'Damion'; font-size:18px">EventCentral</span><b>
          <a href="index.php"><span class="w3-mobile w3-hover-text-black  w3-bar-item"><i class="fa fa-home"></i>Home</span></a>
          <a href="all_post.php"><span class="w3-mobile w3-hover-text-black  w3-bar-item"><i class="fa fa-list-ul"></i>All Event</span></a>
          <a href="list_sponsor.php"><span class="w3-mobile w3-hover-text-black  w3-bar-item"><i class="fa fa-usd"></i>List Sponsor</span></a>

          <?php if($_SESSION['status']=="Admin" ){ ?>
            <a href="admin/index.php"><span class="w3-mobile w3-hover-text-black  w3-bar-item"><i class="fa fa-tachometer"></i>Dashboard</span></a>
          <?php } ?>

          <a href="#"><span onclick="document.getElementById('search').style.display='block';" class="w3-bar-item">Search</span></a>


        <?php if($_SESSION['status'] == "User" || $_SESSION['status'] == "Admin" || $_SESSION['status'] == "Sponsor" || $_SESSION['status'] == "Panitia" ) {?>
        <a href="profile.php?id=<?php echo urlencode($id); ?>"> <span><img style="height:37px; width:37px; margin-top:0" class="w3-mobile w3-hover-shadow w3-right avatar" src="<?php echo $result['avatar']; ?>"></span> </a>

            <div class="w3-mobile w3-right w3-bar-item w3-display-top"> <strong><?php echo $result['nama']; ?></strong></div>

          <a href="admin/logout.php" style="text-decoration:none;" class="w3-mobile w3-hover-text-black w3-bar-item w3-right w3-text-white"><i class="fa fa-sign-out"></i>Log out</a>
        <?php } ?>
          <?php if($_SESSION['status'] == "nouser") { ?>
          <a href="#"><span onclick="document.getElementById('regis').style.display='block'" class="w3-right w3-hover-text-black w3-mobile w3-bar-item"><i class="fa fa-address-book-o"></i>Register</span></a>
          <!-- <a href="login/loglog.php"><span class="w3-right w3-hover-text-black w3-mobile w3-bar-item"><i class="fa fa-sign-in"></i>Log in</span></a> -->
          <a href="#"><span onclick="document.getElementById('id01').style.display='block'" class="w3-right w3-hover-text-black w3-mobile w3-bar-item"><i class="fa fa-sign-in"></i>Log in</span></a>
          <?php } ?>
  </div></b>

  <div id="id01" class="w3-modal">
      <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:350px">

        <div class="w3-teal w3-center"><br>
          <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
          <label style="font-size:20px;;">Log In</label>
        </div>

        <form class="w3-container" action="modules/loginprocess.php" method="post">
          <div class="w3-section">
            <i class="fa fa-user"></i><label><b> Email</b></label>
            <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Email" name="emailmhs" required>
            <i class="fa fa-unlock-alt"></i><label><b> Password</b></label>
            <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="passmhs" required>
            <button class="w3-button w3-block w3-blue w3-section w3-padding" type="submit">Login</button>
          </div>
        </form>

        <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
          <span onclick="document.getElementById('regis').style.display='block'; document.getElementById('id01').style.display='none'" class="w3-center w3-padding w3-hide-small">Don't have an account? <a href="#">Register</a> now</span>
        </div>

      </div>
    </div>
<!-- Registration -->
<?php
		$conn = mysqli_connect('localhost', 'root', '', 'event')
		or die ("Connection Failed".mysqli_error());

		$query = "SELECT * FROM otoritas";
	  $level =  mysqli_query($conn,$query);
 ?>

    <div id="regis" class="w3-modal">
        <div class="w3-margin-bottom w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:350px">

          <div class="w3-teal w3-center"><br>
            <span onclick="document.getElementById('regis').style.display='none'" class="w3-button w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
            <label style="font-size:20px;">Register</label>
          </div>

          <form class="w3-container" action="modules/registerprocess.php" method="post">
            <div class="w3-section">
              <i class="fa fa-user"></i><label><b> Full Name</b></label>
              <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Name" name="nama" required>
              <i class="fa fa-user"></i><label><b> Email</b></label>
              <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Email" name="email" required>
              <i class="fa fa-unlock-alt"></i><label><b> Password</b></label>
              <input class="w3-input w3-border w3-margin-bottom" type="password" placeholder="Enter password" name="password" required>
              <i class="fa fa-unlock-alt"></i><label><b>Confirm Password</b></label>
              <input class="w3-input w3-border w3-margin-bottom" type="password" placeholder="Re-Enter password" name="confirm" required>
              <label> Account </label>
              <select class="user" name="otoritas">
        				<?php while( $row = mysqli_fetch_assoc($level)) { ?>
                  <?php if($row['id'] != 1) { ?>
        					<option value="<?php echo $row['id']; ?>"><?php echo $row['level']; ?></option>
        				<?php } } ?>
        			</select></br>
              <button class="w3-button w3-block w3-blue w3-section w3-padding" type="submit">Register</button>
            </div>
          </form>

          <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
            <span onclick="document.getElementById('id01').style.display='block'; document.getElementById('regis').style.display='none'" class="w3-center w3-padding w3-hide-small">Already have an account? <a href="#">Log in</a> now</span>
          </div>

        </div>
      </div>

      <div id="search" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:350px">
          <div class="w3-teal w3-center"><br>
            <span onclick="document.getElementById('search').style.display='none'" class="w3-button w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
            <label style="font-size:20px;">Search Event</label>
          </div>

          <form action="all_post.php" method="post" class="w3-container">
              <input type="text" name="cari" placeholder="search"><input type="submit" value="cari" name="nyari">
          </form>

     </div>
      </div>
