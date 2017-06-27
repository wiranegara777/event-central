<?php $id='';
$id = $_GET['id']; ?>

<?php
      include 'connect.php';
      session_start();
      if(!(isset($_SESSION['id']))) {
        $_SESSION['status'] = "nouser";
        $_SESSION['id'] = '';
        $id = $_GET['id'];
      } else if($_SESSION['id'] != $_GET['id']) {
        $id = $_GET['id'];
      } else {
        $id = $_SESSION['id'];
      }
      $query   = "SELECT * FROM user WHERE id ='$id'";
      $check = mysqli_query($conn,$query);
      $resultt = mysqli_fetch_assoc($check);
 ?>

 <?php

         if(isset($_GET['delete'])){
           $id_USER = $_SESSION['id'];

           $query = "DELETE FROM user WHERE id = '$id_USER'";
           $query1  = mysqli_query($conn,"DELETE FROM daftar_event where id_user = '$id_USER'");
           $query2  = mysqli_query($conn,"DELETE FROM daftar_sponsor where ID_SPONSOR = '$id_USER'");
           $query4  = mysqli_query($conn,"DELETE FROM ratings WHERE id_user = '$id_USER'");
           if(mysqli_query($conn,$query)){
?>
          <script language="javascript">alert("Profile deleted Successfully");</script>
          <script>document.location.href='index.php';</script>
<?php
            session_destroy();
           } else { ?>
             <script language="javascript">alert("Delete profile unsuccess");</script>
             <script>document.location.href='index.php';</script>
             <?php
           }
             mysqli_close($conn);
         }


  ?>
<?php include 'includes/header.php'; ?>
<style>
.parallax {
    /* The image used */
    background-image: url("<?php echo $resultt['avatar']; ?>");

    /* Set a specific height */
    min-height: 350px;

    /* Create the parallax scrolling effect */
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;

}
</style>
<div class="parallax">
 <div class="w3-display-middle">
  <!--<center><h1  id="damion-big">PROFILE</h1></center >-->
</div>
</div>
<!-- Header -->
<div class="w3-container w3-blue w3-card-8">
<center><h2 id="damion-big" style="font-size:50px">Profile</h2></center>
</div>
<!DOCTYPE html>
<html>
<title>Profile | Event Central</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<body class="w3-light-grey">

<!-- Page Container -->
<div class="w3-content w3-margin-top" style="max-width:1400px;">

<!-- The Grid -->
<div class="w3-row-padding">

  <!-- Left Column -->
  <div class="w3-third">

    <div class="w3-white w3-text-grey w3-card-4">
      <div class="w3-display-container">
        <img src="<?php echo $resultt['avatar']; ?>" style="width:100%" alt="Avatar">
        <div class="w3-display-bottomleft w3-container w3-text-black">

        </div>
      </div>
      <div class="w3-container">
        <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $resultt['nama']; ?></p>
        <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $resultt['alamat']; ?></p>
        <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $resultt['email']; ?></p>
        <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $resultt['telepon']; ?></p>
        <hr>
      </br>
    </div>
    <div class="w3-center w3-container">
    <?php if($resultt['id'] == $_SESSION['id']){ ?>
      <a href="edit_profile.php?id=<?php echo $resultt['id']; ?>"><button class="w3-blue w3-btn w3-wide"><i class="fa fa-cog"></i>Edit Profile</button></a>
      <a href="profile.php?delete=<?php echo $resultt['id'] ?>"><button class="w3-red w3-btn w3-wide"><i class="fa fa-trash"></i>Delete Profile</button></a>
    <?php } ?>
    </div>
  </div>
</br>
<?php
    if($resultt['id'] == $_SESSION['id']){
    $query = "SELECT * FROM post WHERE user_id = '$id'";
    $jalan = '';
    $jalan = mysqli_query($conn,$query);

    $query2 = mysqli_query($conn,"SELECT * FROM post WHERE user_id = '$id'");

 ?>
  <div class="w3-card-2 w3-margin-top">
    <div class="w3-teal w3-card-4 w3-container w3-padding">
      <h4>Your Event Post </h4>
    </div>
    <ul class="w3-ul w3-hoverable w3-white">
      <?php if(mysqli_fetch_assoc($query2)) { ?>
        <div style="height: 120px; overflow: auto;">
          <?php while($row = mysqli_fetch_assoc($jalan) ) { ?>

      <li class="w3-hover-blue w3-padding-16">
              <img src="<?php echo $row['image']; ?>" alt="Image" class="w3-card-4 w3-left w3-margin-right" style="width:50px">
            <span><?php echo $row['title']; echo ' '; ?><a style="text-decoration:none;" href="edit_event.php?id=<?php echo urlencode($row['id']); ?>">
              <i class="fa fa-pencil"></i></a></span><br>
      </li>
      <div class="w3-container w3-light-grey" style="height:1px;">
      </div>


          <!-- </div> -->
      <?php } ?> </div> <?php }else {  ?>
        <li class="w3-hover-blue w3-padding-16">
           You don't have any event post!
           make it <a href="post_event.php"><b>here</b></a>
        </li>
      <?php } ?>

    </ul>
  </div>
<?php } ?>
</br>


<?php
    if($resultt['id'] == $_SESSION['id']){
    $query = "SELECT * FROM notif WHERE id_user = '$id' ORDER BY id_notif DESC";
    $jalan = '';
    $jalan = mysqli_query($conn,$query);

    $query2 = mysqli_query($conn,"SELECT * FROM notif WHERE id_user = '$id'");

 ?>
  <div class="w3-card-2 w3-margin-top">
    <div class="w3-blue w3-card-4 w3-container w3-padding">
      <h4>  Notification Log </h4>
    </div>
    <ul class="w3-ul w3-hoverable w3-white">
      <?php if(mysqli_fetch_array($query2)) { ?>
        <div style="height: 240px; overflow: auto;">
          <?php while($row = mysqli_fetch_assoc($jalan) ) { ?>

      <li class="w3-hover-blue w3-padding-16">
           <i class="fa fa-check"></i>
            <span><?php echo $row['pesan']; echo ' '; ?>
            </span><p class="w3-right"><?php echo $row['waktu']; ?></p> <br>
      </li>
      <div class="w3-container w3-light-grey" style="height:1px;">
      </div>


          <!-- </div> -->
      <?php } ?> </div> <?php }else {  ?>
        <li class="w3-hover-blue w3-padding-16">
           Tidak Ada Notifikasi
        </li>
      <?php } ?>

    </ul>
  </div>
<?php } ?>
</br>
  <!-- End Left Column -->

</div>

  <!-- Right Column -->
  <div class="w3-twothird">

    <div class="w3-container w3-card-2 w3-white w3-margin-bottom">
      <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i><?php echo $resultt['nama']; ?></h2>
      <div class="w3-container">
        <p><?php echo $resultt['deskripsi']; ?></p>
        <hr>
      </div>



  <!-- End Right Column -->
  </div>

<!-- End Grid -->
</div>

<!-- End Page Container -->
</div>



</body>
</html>

  <?php include 'includes/footer.php'; ?>
