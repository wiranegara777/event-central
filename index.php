<style>
.parallax2 {
    /* The image used */
    background-image: url("images/bing_chicago_final-51-w1200h800.jpg");

    /* Set a specific height */
    min-height: 300px;

    /* Create the parallax scrolling effect */
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;

}
</style>
<?php
      session_start();
      if(!(isset($_SESSION['id']))) {
        $_SESSION['status'] = "nouser";
      }
 ?>
 <?php
     // $db = new Database();
     include 'connect.php';
     //create query
     $query = "SELECT * FROM post ORDER BY total_rating DESC LIMIT 5";
     //run query
     // $newevent = $db->select($query);   //newevnt
     $newevent = mysqli_query($conn,$query);
     //create query
     $query = "SELECT * FROM post WHERE validation = 1 ORDER BY id DESC LIMIT 1";
     //run query
     // $post = $db->select($query);      //post
     $post = mysqli_query($conn,$query);

 ?>
<?php include 'includes/header.php'; ?>

<style>
#damioon-big{
  font-family:'Damion';
  font-size:6.5vw;
  color: white;
  text-shadow: 2px 2px 4px #000000;
}
</style>
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/jquery.typeit/4.4.0/typeit.min.js"></script>
<title>Event Central</title>
  <!--header mantap-->
        <div class="parallax">
         <div class="w3-mobile w3-display-middle">
          <center ><h3 id="damioon-big">Event Central</h3>
                      <b><p id="element" style="text-shadow: 2px 2px 4px #000000; font-size:22px;" class="w3-text-white"></p></b>

          </center >
               <center>
                        <a class="w3-hover-text-white" href="post_event.php" style="text-decoration:none">
                          <div class="w3-round w3-hover-shadow w3-container w3-hover-teal w3-cell w3-blue">
                                <b><p style="font-size:1.2vw;">Publish Your Event Here!</p></b>

                                <script>
                                $('#element').typeIt({
                                  strings: ["Welcome to Event Central","Find Your Favorite Event Here!", "Find Sponsor here","Publish Your Event Here"],
                                    speed: 120,
                                    breakLines: false,
                                    autoStart: true,
                                    loop: true
                                  });
                                </script>

                          </div>
                      </a>
             </center>
       </div>
     </div>
<!-- Header -->
<div class="w3-container w3-teal w3-card-8" >
     <center><h3>
        - OUR SERVICE -
         <center><div style="height:3px; width:60px" class="w3-white"></div></center>
     </h3></center></br>

</div>

<!-- Our Services -->
<div style="height:350px;" class="w3-container w3-teal">
      <div class="w3-margin-left w3-margin-right">
              <div class="w3-row w3-margin-top">
                      <div class="w3-third w3-center">

                            <i class="fa fa-users w3-jumbo"></i>
                            <h4 class="service-heading"><b>Publish Event</b></h4>
                            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                            <a class="w3-hover-text-white" href="post_event.php" style="text-decoration:none">
                              <div class="w3-round w3-hover-shadow w3-container w3-hover-teal w3-cell w3-blue">
                                    <b><p style="font-size:1.2vw;">Publish Event</p></b>
                              </div>
                           </a>
                      </div>
                      <div class="w3-third w3-center">

                            <i class="fa fa-handshake-o w3-jumbo"></i>
                            <h4 class="service-heading"><b>Find Sponsor</b></h4>
                            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                            <a class="w3-hover-text-white" href="list_sponsor.php" style="text-decoration:none">
                              <div class="w3-round w3-hover-shadow w3-container w3-hover-teal w3-cell w3-blue">
                                    <b><p style="font-size:1.2vw;">View Sponsor</p></b>
                              </div>
                           </a>
                      </div>
                      <div class="w3-third w3-center">

                            <i class="fa fa-search w3-jumbo"></i>
                            <h4 class="service-heading"><b>Find Event</b></h4>
                            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                            <a class="w3-hover-text-white" href="all_post.php" style="text-decoration:none">
                              <div class="w3-round w3-hover-shadow w3-container w3-hover-teal w3-cell w3-blue">
                                    <b><p style="font-size:1.2vw;">View Event</p></b>
                              </div>
                           </a>
                      </div>


              </div>

      </div>
</div>


<!-- Grid -->
<div class="w3-row">

<!-- Blog entries -->
<div class="w3-col l8 s12">

      <?php while( $row = mysqli_fetch_array($post) ) : ?>
  <!-- Blog entry -->
  <div class="w3-card-4 w3-margin w3-white">
    <img src="<?php echo $row['image']; ?>" alt="Nature" style="width:100%">

    <div class="w3-container">
      <h3><b><?php echo $row['title']; ?></b></h3>
      <h5>
            <?php
                  $query = "SELECT * FROM user";
                  $userr = mysqli_query($conn,$query);
                  $nama  = ''; $ava='';
                  while($username = mysqli_fetch_assoc($userr)){
                    if($username['id'] == $row['user_id'] )
                    {$nama = $username['nama'];
                     $ava  = $username['avatar'];
                    }
                  }
           ?>
           <?php echo 'by '; echo $nama;  ?><img style="height:37px; width:37px; margin-top:0; margin-right:10px" class="avatar w3-hover-shadow w3-card-4 w3-left" src="<?php echo $ava; ?>">
      </h5>
      <span class="w3-opacity"><?php echo formatDate($row['date']); ?></span>
    </div>
    <!-- ini paragraf -->
      <div class="w3-container">
          <p class="w3-justify"><?php echo shortenText($row['body']); ?></p>
      <div class="w3-row">
        <div class="w3-col m8 s12">
          <p><a href="post.php?id=<?php echo urlencode($row['id']); ?>"><button class="w3-button w3-padding-large w3-white w3-border"><b>READ MORE »</b></button></a></p>
        </div>
        <div class="w3-col m4 w3-hide-small">
          <p><span class="w3-padding-large w3-right"><b>Review  </b> <span class="w3-tag"><?php echo $row['total_rating']; ?></span></span></p>
        </div>
      </div>
    </div>
  </div>
  <hr>
    <?php endwhile; ?>


<!-- END BLOG ENTRIES -->
</div>
<!-- Introduction menu -->
<div class="w3-col l4">
  <!-- About Card -->
  <!-- <div class="w3-card-2 w3-margin w3-margin-top">
  <img src="images/ganteng.jpg" style="width:100%">
    <div class="w3-container w3-white">
      <h4><b>Muhammad Wiranegara Girinata</b></h4>
      <p>Seorang Mahasiswa Ilmu Komputer Semester 4 yang sedang
      berusaha belajar web developing</p>
    </div>
  </div><hr> -->

  <!-- New Events -->
  <div class="w3-card-2 w3-margin">
    <div class="w3-red w3-card-4 w3-container w3-padding">
      <h4 style="font-family:'Roboto';">Top 5 Hottest Events <i class="fa fa-free-code-camp"></i></h4>
    </div>
      <style>
        .mySlides {display:none;}
      </style>
          <div class="w3-content w3-section" style="max-width:500px">
            <?php while($row = mysqli_fetch_assoc($newevent)) { ?>
                <div class="mySlides w3-animate-right">
                    <a href="post.php?id=<?php echo $row['id']; ?>"><img class="w3-hover-opacity" src="<?php echo $row['image'] ?>" style="width:100%"></a>
                    <div class="w3-display-bottomleft w3-card-8 w3-container w3-padding-16 w3-blue">
                        <?php echo $row['title']; ?>
                    </div>
               </div>
               <?php } ?>
          </div>

        <script>
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
              x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) {myIndex = 1}
            x[myIndex-1].style.display = "block";
            setTimeout(carousel, 4000);
        }
        </script>
  </div><hr>

  <div class="w3-card-4 w3-margin">
    <?php include 'calendar/calendar.php'; ?>
  </div>


<!-- END Introduction Menu -->
</div>

<!-- END GRID -->
</div><br>

<div class="parallax2">
 <div class="w3-display-middle">
  <!--<center><h1  id="damion-big">PROFILE</h1></center >-->
</div>
</div>
<!-- END w3-content -->
</div>
<?php include 'includes/footer.php'; ?>
