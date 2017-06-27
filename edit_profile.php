<?php
      $conn = mysqli_connect('localhost', 'root', '','event') //urutannya server, username, password, nama data base di myphp
      or die ("Gagal koneksi ke server".mysqli_error());
      session_start();
      if(!(isset($_SESSION['id']))) {
        $_SESSION['status'] = "nouser";
      }
 ?>
<?php include 'includes/header.php'; ?>
<?php

    $id = $_SESSION['id'];
    //create query
    $query = "SELECT * FROM user WHERE id = '$id'";
    //run query
    $op = mysqli_query($conn,$query);
    $post = mysqli_fetch_assoc($op);

?>
<style>
.parallax {
    /* The image used */
    background-image: url("<?php echo $result['avatar']; ?>");

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


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body class="w3-light-grey">

<!-- Page Container -->
<div class="w3-content w3-margin-top" style="max-width:1400px;">

<!-- The Grid -->

<div class="w3-row-padding">


  <!-- Right Column -->
  <div style="margin-left:220px"  class="w3-twothird">

    <div class="w3-container w3-card-2 w3-white w3-margin-bottom">


          <h2>Edit Profile</h2>
          <div class="formasik">
              <form role="form" method="post" action="edit_profile_process.php?id=<?php echo $post['id']; ?>" enctype="multipart/form-data">

                  <label>Display Name</label>
                  <input name="title" type="text" placeholder="Enter Name" value="<?php echo $post['nama']; ?>">


                  <label>Alamat</label>
                  <input name="alamat" type="text" placeholder="Enter Address" value="<?php echo $post['alamat']; ?>">

                  <label>No Telfon</label>
                  <input name="telp" type="text" placeholder="Enter No.Telp" value="<?php echo $post['telepon']; ?>">

                  <label>Deskripsi Profile</label>
                  <textarea name="body" placeholder="Enter Description Event">
                      <?php echo $post['deskripsi']; ?>
                  </textarea>
                    </br>
                  <script>
                      CKEDITOR.replace( 'body' );
                  </script>

                      <label>Select Avatar</label></br>
                          <input type="hidden" name="size" value"1000000">
                          <input type="file"   name="image">

                <input class="w3-blue" name="submit" type="submit" value="Update">
                <input class="w3-red"  name="delete" type="submit" value="Delete">
              </form>
       </div>



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
