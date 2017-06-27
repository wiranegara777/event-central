<?php include 'modules/connect.php'; ?>
<?php include 'includes/header_all_event.php'; ?>
<?php
    $id = '';
    $conn = mysqli_connect('localhost', 'root', '','event') //urutannya server, username, password, nama data base di myphp
    or die ("Gagal koneksi ke server".mysqli_error());

    if(isset($_GET['category'])){
      $id = $_GET['category'];
      $query = "SELECT * FROM post WHERE category = '$id' AND validation = 1";
      //run query
      $catego = mysqli_query($conn,$query);      //post

      //untuk munculin nama category di thumbanail
      $query = "SELECT * FROM categories WHERE id = '$id'";
      $cek = mysqli_query($conn,$query);
      $hehe = mysqli_fetch_assoc($cek);
      /////////////////////////////////////////////////
      // untuk filter categories paling atas
      $query = "SELECT * FROM categories";
      $categories = mysqli_query($conn,$query);

    }else {
      // $query = "SELECT post.*, categories.name FROM post
      //             INNER JOIN categories
      //             ON post.category = categories.id ORDER BY id DESC";
      $query = "SELECT * FROM post WHERE validation = 1 ORDER BY id DESC";
      $catego = mysqli_query($conn,$query);

      $query = "SELECT * FROM categories";
      $categories = mysqli_query($conn,$query);

      $hehe = 0;
    }
?>
<link rel="stylesheet" href="css/grid.css">
<style>
.parallax {
    /* The image used */
    background-image: url("images/pexels-photo-112631.jpeg");

    /* Set a specific height */
    height: 100%;

    /* Create the parallax scrolling effect */
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;

}
</style>
<!-- <div class="parallax">
 <div class="w3-display-middle"> -->
  <!--<center><h1  id="damion-big">PROFILE</h1></center >-->
</div>
</div>
<!-- Header -->
<div class="w3-container w3-teal w3-card-8">

<center><h2 id="damion-big" style="font-size:50px">- All Event -</h2></center>
</div>


<title>All Event | Event Central</title>
<meta charset="UTF-8">
<body class="w3-light-grey">
<link rel="stylesheet" href="css/all_sponsor.css">
<!-- Page Container -->
<div class="w3-content w3-margin-top" style="max-width:1400px;">

<!-- The Grid -->
<div class="w3-row-padding">

  <!-- Right Column -->

  <div class="w3-threethird">
    <div class="w3-container w3-card w3-white w3-margin-bottom">
      <div class="w3-row-padding">
        <div class="w3-threethird">
          <!-- CATEGORY ------------------------------------------------------>
            <div class="w3-card-2 w3-margin">
              <div class="w3-blue w3-container w3-padding">
                <center><h4>- Category -</h4></center>
              </div>
              <?php if($categories) : ?>
              <div class="w3-container w3-white">
                    <p>
                        <center>
                      <?php if($id==''){ ?>
                      <a href="all_post.php"><span class="w3-animate-zoom w3-btn w3-card-4 w3-hover-blue w3-tag w3-red w3-margin-bottom">ALL</span></a>
                      <?php } else { ?>
                      <a href="all_post.php"><span class="w3-animate-zoom w3-btn w3-hover-blue w3-tag w3-teal w3-margin-bottom">ALL</span></a>
                      <?php } ?>
                        <?php while($row = mysqli_fetch_assoc($categories)) : ?>
                        <?php if($row['id'] == $id) { ?>
                        <a href="all_post.php?category=<?php echo $row['id'];?>"><span class="w3-animate-zoom w3-card-4 w3-btn w3-hover-blue w3-tag w3-red w3-margin-bottom"><?php echo $row['name'];?></span></a>
                      <?php } else if($id == '') { ?>
                        <a href="all_post.php?category=<?php echo $row['id'];?>"><span class="w3-animate-zoom w3-btn w3-hover-blue w3-tag w3-teal w3-margin-bottom"><?php echo $row['name'];?></span></a>
                      <?php } else { ?>
                        <a href="all_post.php?category=<?php echo $row['id'];?>"><span class="w3-animate-zoom w3-btn w3-hover-blue w3-tag w3-teal w3-margin-bottom"><?php echo $row['name'];?></span></a>
                      <?php } ?>
                        <?php endwhile ; ?>
                      </center>
                    </p>
              <?php else : ?>
                    <p>Ga ada kategori bung!</p>
              <?php endif; ?>
              </div>
            </div>
          <!-- END OF CATEGORY --------------------------------------------->
        </div>
        <div class="row">
        <?php while($row = mysqli_fetch_assoc($catego) ) : ?>
          <!-- ini adalah query untuk memfetch dan mencocokkan antara post dengan user untuk author  -->
          <?php
          $count=0;
          $query = "SELECT * FROM user";
          $userr = mysqli_query($conn,$query);
           ?>
          <!-- ini adalah query untuk memfetch dan mencocokkan antara post dengan user untuk author  -->
          <?php if($row['id']%2 == 0) { ?>

                <div class="w3-animate-zoom col s12 m4">
                <div class="card">
                  <div class="card-image waves-effect waves-block waves-light">
                    <img style="height:300px;" class="activator" src="<?php echo $row['image'] ?>">
                  </div>
                  <div class="card-content w3-teal">
                    <span class="card-title activator white-text text-darken-4 w3-large"><b><?php echo $row['title']; ?></b></span>
                    <p><a href="#" class="w3-hover-text w3-text-white">Read More</a> <i class="material right">
                      <?php
                          if($row['category'] == $hehe['id']){
                            echo $hehe['name'];
                      }
                      else {
                           $id_katego = $row['category'];
                           $query = "SELECT * FROM categories WHERE id = '$id_katego'";
                           $jalan = mysqli_query($conn,$query);
                           $pop_catego = mysqli_fetch_assoc($jalan);
                           echo $pop_catego['name'];
                      }
                         ?>
                    </i></p>
                  </div>
                  <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4"><?php echo $row['title']; ?><i class="material-icons right">close</i></span>

                    <p><i class="fa fa-calendar"></i> : <?php echo $row['date'] ?></p>

                  </div>
                </div>
              </div>
<?php $count+=1;} else if($row['id']%2 > 0) { $count+=1;?>
            <div class="w3-animate-zoom col s12 m4">
            <div class="card">
              <div class="card-image waves-effect waves-block waves-light">
                <img style="height:300px;" class="activator" src="<?php echo $row['image'] ?>">
              </div>
              <div class="card-content w3-red">
                <span class="card-title activator white-text text-darken-4 w3-large"><b><?php echo $row['title']; ?></b></span>
                <p><a href="#" class="w3-hover-text w3-text-white">Read More</a> <i class="material right">
                  <?php
                      if($row['category'] == $hehe['id']){
                        echo $hehe['name'];
                  }
                  else {
                       $id_katego = $row['category'];
                       $query = "SELECT * FROM categories WHERE id = '$id_katego'";
                       $jalan = mysqli_query($conn,$query);
                       $pop_catego = mysqli_fetch_assoc($jalan);
                       echo $pop_catego['name'];
                  }
                     ?>
                </i></p>
              </div>
              <div class="card-reveal">
                <span class="card-title grey-text text-darken-4"><?php echo $row['title']; ?><i class="material-icons right">close</i></span>

                <p><i class="fa fa-calendar"></i> : <?php echo $row['date'] ?></p>

              </div>
            </div>
          </div>

          <?php } ?>
          <?php  endwhile; ?>
  </div>


          </div>

      </div>
  </div>

<!-- End Grid -->
</div>

<!-- End Page Container -->
</div>

  <div class="parallax">
  </div>

</body>
</html>

  <?php include 'includes/footer.php'; ?>
