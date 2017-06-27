<?php include 'modules/connect.php'; ?>
<?php include 'includes/header.php'; ?>
<?php
    $conn = mysqli_connect('localhost', 'root', '','event') //urutannya server, username, password, nama data base di myphp
    or die ("Gagal koneksi ke server".mysqli_error());

    $query = "SELECT * from user WHERE otoritas = 2";
    $jalan = mysqli_query($conn,$query);

    $query = "SELECT * from user WHERE otoritas = 2 ORDER BY id DESC";
    $jalan2 = mysqli_query($conn,$query);

    $query = "SELECT * from user WHERE otoritas = 2";
    $jalan3 = mysqli_query($conn,$query);
?>
<link rel="stylesheet" href="css/grid.css">
<style>
  .sponsor{
    position: absolute;
  }
</style>
<style>
.parallax {
    /* The image used */
    background-image: url("images/pexels-photo-288477.jpeg");

    /* Set a specific height */
    min-height: 300px;

    /* Create the parallax scrolling effect */
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;

}
</style>
<title>List Sponsor | Event Central</title>
<div class="parallax">
 <div class="w3-display-middle">
  <!--<center><h1  id="damion-big">PROFILE</h1></center >-->
</div>
</div>
<!-- Header -->
<div class="w3-container w3-teal w3-card-8">
<center><h2 id="damion-big" style="font-size:50px">  - Sponsor List -</h2></center>
</div>
<!DOCTYPE html>
<html>
<!-- <link rel="stylesheet" href="css/list_sponsor.css"> -->
<link rel="stylesheet" href="css/all_sponsor.css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<body class="w3-light-grey">

<!-- Page Container -->
<div class="w3-content w3-margin-top" style="max-width:1400px;">

<!-- The Grid -->
<div class="w3-row-padding">



  <div class="w3-threethird">
    <div class="w3-container w3-card w3-white w3-margin-bottom">
      <div class="w3-row-padding">

  <div class="masonry">

<style>
img:hover {
  opacity: 0.5;
  filter: alpha(opacity=50); /* For IE8 and earlier */
}
</style>

      <?php while( $sponsor = mysqli_fetch_assoc($jalan) ) { ?>
  <a href="profile.php?id=<?php echo urlencode($sponsor['id']); ?>">
      <div class="w3-animate-zoom item"><img src="<?php echo $sponsor['avatar']; ?>" alt="Mike" style="width:100%"></div>
</a>
            <?php } ?>






  </div>




          </div>

      </div>
  </div>

<!-- End Grid -->
</div>

<!-- End Page Container -->
</div>

  <div class="parallax">
    <div class="w3-display-middle">
    </div>
  </div>

</body>
</html>

  <?php include 'includes/footer.php'; ?>
