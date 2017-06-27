<?php
      $monthNames = Array("January", "February", "March", "April", "May", "June", "July",
      "August", "September", "October", "November", "December");
?>
<?php   session_start();
        if(!(isset($_SESSION['id']))) {
          $_SESSION['status'] = "nouser";
          $_SESSION['id'] = 0;
        }
?>
<?php if(isset($_GET['id']))
      {
        $id_POST = $_GET['id'];
      } else {
        $id_POST = '';
      }
?>

<?php include 'includes/header.php'; ?>
<style>
.parallax3 {
    /* The image used */
    background-image: url("images/bg-post2.jpg");

    /* Set a specific height */
    min-height: 200px;

    /* Create the parallax scrolling effect */
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;

}
</style>
<div class="parallax3">
</div>
<?php
        include 'connect.php';
        if(isset($_POST['submit']))
        {
          $id_post = $id_POST;
          $id_user = $_SESSION['id'];
          $comment = $_POST['komen'];
          $rating  = $_POST['rate'];

          $query = "INSERT INTO ratings
                      (id_user,id_post,rate,comment)
                           VALUES('$id_user','$id_post', '$rating','$comment')";
                    if(mysqli_query($conn,$query)) { ?>
                          <script language="javascript">alert("Rating Berhasil ditambahkan");</script>
                          <script>document.location.href='post.php?id=<?php echo $id_POST; ?>';</script>
                      <?php } else { ?>
                          <script language="javascript">alert("Rating Gagal");</script>
                          <script>document.location.href='post.php?id=<?php echo $id_POST; ?>';</script>
                        <?php }
         mysqli_close($conn);
      }
?>
<?php
      //create query
      $query = "SELECT * FROM post WHERE id = '$id_POST'";
      //run query
      $op    = mysqli_query($conn,$query);
      $post  = mysqli_fetch_assoc($op); //post
?>
<!-- ini membuat total rating di attribut post --><!-- ini membuat total rating di attribut post -->
<?php
      $query  = "SELECT * FROM ratings WHERE id_post = '$id_POST'";
      $rem    = mysqli_query($conn,$query);
      $emilia = 0;
      while($subaru = mysqli_fetch_assoc($rem))
      {$emilia+=1;}
      $query = "UPDATE post SET total_rating = '$emilia' WHERE id = '$id_POST'";
      mysqli_query($conn,$query);
?>
<!-- ini membuat total rating di attribut post --><!-- ini membuat total rating di attribut post -->
<!-- ini membuat query pendaftaran sponsor hehehe --><!-- ini membuat query pendaftaran sponsor hehehe -->
<?php
        if(isset($_GET['daftarsponsor'])){
          $id_USER      = $_SESSION['id'];
          $query        = "SELECT * FROM user WHERE id ='$id_USER'";
          $tet          = mysqli_query($conn,$query);
          $ram          = mysqli_fetch_assoc($tet);
          $id_post      = $_GET['daftarsponsor'];
          $nama_sponsor = $ram['nama'];
          $foto_sponsor = $ram['avatar'];
          $query = "INSERT INTO daftar_sponsor
                              (ID_POST,ID_SPONSOR,nama_sponsor,foto_sponsor) VALUES('$id_post','$id_USER','$nama_sponsor','$foto_sponsor')";
          if(mysqli_query($conn,$query)){
?>
                <script language="javascript">alert("Berhasil daftar sponsor");</script>
                <script>document.location.href='post.php?id=<?php echo $id_post; ?>';</script>
<?php
          } else { ?>
                <script language="javascript">alert("gagal daftar sponsor");</script>
                <script>document.location.href='post.php?id=<?php echo $id_post; ?>';</script>
            <?php
          }
            mysqli_close($conn);
        }
 ?>
 <!-- ini membuat query pendaftaran sponsor hehehe --><!-- ini membuat query pendaftaran sponsor hehehe -->
 <?php
        if(isset($_GET['batalsponsor']))
        {
            $id_post    = $_GET['batalsponsor'];
            $id_sponsor = $_SESSION['id'];
            $query = "DELETE FROM daftar_sponsor WHERE ID_POST = '$id_post' AND ID_SPONSOR = '$id_sponsor'" ;
            // $query = "DELETE FROM daftar_sponsor WHERE ID_SPONSOR ='$id_sponsor' AND ID_POST = '$id_POST'";
            if(mysqli_query($conn,$query)) { ?>
                  <script language="javascript">alert("Canceled Sponsorship");</script>
                  <script>document.location.href='post.php?id=<?php echo $id_post; ?>';</script>
            <?php } else { ?>
                  <script language="javascript">alert("Failed canceling Sponsorship");</script>
                  <script>document.location.href='post.php?id=<?php echo $id_POST; ?>';</script>
            <?php }
        }
 ?>

 <?php
         if(isset($_GET['daftar_event'])){
           $id_USER      = $_SESSION['id'];
           $query        = "SELECT * FROM user WHERE id ='$id_USER'";
           $tet          = mysqli_query($conn,$query);
           $ram          = mysqli_fetch_assoc($tet);
           $id_post      = $id_POST;
           $nama_pendaftar = $ram['nama'];
           $query = "INSERT INTO daftar_event
                               (id_user,id_post,nama) VALUES('$id_USER','$id_post','$nama_pendaftar')";
           if(mysqli_query($conn,$query)){
 ?>
                 <script language="javascript">alert("Berhasil daftar Event");</script>
                 <script>document.location.href='post.php?id=<?php echo $id_post; ?>';</script>
 <?php
           } else { ?>
                 <script language="javascript">alert("gagal daftar Event");</script>
                 <script>document.location.href='post.php?id=<?php echo $id_post; ?>';</script>
             <?php
           }
             mysqli_close($conn);
         }
  ?>
  <?php
         if(isset($_GET['batal_event']))
         {
             $id_post    = $id_POST;
             $id_user = $_SESSION['id'];
             $query = "DELETE FROM daftar_event WHERE id_post = '$id_post' AND id_user = '$id_user'" ;
             // $query = "DELETE FROM daftar_sponsor WHERE ID_SPONSOR ='$id_sponsor' AND ID_POST = '$id_POST'";
             if(mysqli_query($conn,$query)) { ?>
                   <script language="javascript">alert("Canceled Event Succesfull");</script>
                   <script>document.location.href='post.php?id=<?php echo $id_post; ?>';</script>
             <?php } else { ?>
                   <script language="javascript">alert("Failed canceling Event");</script>
                   <script>document.location.href='post.php?id=<?php echo $id_POST; ?>';</script>
             <?php }
         }
  ?>
  <!-- Header -->
  <?php include 'modules/edit_rating2.php'; ?>
  <title><?php echo $post['title']; ?> | Event Central</title>
  <div class="w3-container w3-teal w3-card-8">
        <center><h2 style="font-family:'Raleway'">- Main Post -</h2></center>
  </div>
  <!-- Grid -->
  <div class="w3-row">

      <!-- Blog entries -->
        <div class="w3-col l8 s12">
        <!-- Blog entry -->
              <div class="w3-card-4 w3-margin w3-white">
                  <img src="<?php echo $post['image']; ?>" alt="Nature" style="width:100%">
                  <div class="w3-container w3-card-4 w3-blue">
                      <h1><b><?php echo $post['title']; ?></b></h1>
                  </div>
                  <div class="w3-container">

                        <a class"w3-hover-red" style="text-decoration:none;" href="profile.php?id=<?php echo urlencode($post['user_id']); ?>">
                              <h5>
                                <?php
                                    $query = "SELECT * FROM user";
                                    $userr = mysqli_query($conn,$query);
                                    $nama  = '';
                                    $ava   = '';
                                      while($username = mysqli_fetch_assoc($userr)){
                                        if($username['id'] == $post['user_id'] )
                                        {
                                          $nama = $username['nama'];
                                          $ava  = $username['avatar'];
                                        }
                                      }
                               ?>
                              <i> <?php echo 'by '; echo $nama;  ?></i><img style="height:37px; width:37px; margin-top:0; margin-right:10px" class="avatar w3-hover-shadow w3-card-4 w3-left" src="<?php echo $ava; ?>">
                              </h5>
                          </a>
                          <span class="w3-right w3-opacity"><?php echo formatDate($post['date']); ?></span>
                 </div>
                 <div style="font-size:18px;" class="w3-container">
                       <span><i class="fa fa-map-marker"></i> : <?php echo $post['alamat']; ?></span></br>
                       <span>Start Event :<i class="fa fa-calendar"></i> : <?php echo $post['tanggal']; ?> - <?php echo $monthNames[$post['bulan']-1]; ?> - <?php echo $post['tahun']; ?></span></br>
                       <span>finish Event :<i class="fa fa-calendar"></i> : <?php echo $post['date_finish']; ?> - <?php echo $monthNames[$post['month_finish']-1]; ?> - <?php echo $post['year_finish']; ?></span>
                </div>
                <div class="w3-container w3-light-grey" style="height:3px;">
                </div>
          <!-- ini paragraf -->
         <div class="w3-container">
                <p class="w3-justify"><?php echo $post['body']; ?></p>
         </div>
         <div class="w3-container">
               <span><strong class="righteous">Lokasi :</strong></span>
         </div>
          <div class="postmap">
               <div id="map" style="width:100%;height:300px;"></div>
               <div class="w3-text-white mapdetail hide-on-med-and-down">
                     <div class="col s6"><strong>Latitude : </strong><span id="latspan"></span></div>
                     <div class="col s6"><strong>Longitude: </strong><span id="lngspan"></span></div>
               </div>
          </div>
          <script type="text/javascript">
            function initMap() {
              var wisata = {lat: <?php echo $post['langtitude'] ?>, lng: <?php echo $post['longtitude'] ?>};

              var map = new google.maps.Map(document.getElementById('map'), {
                center: wisata,
                scrollwheel: false,
                zoom: 15
              });

              var marker = new google.maps.Marker({
                map: map,
                position: wisata,
                title: '<?php echo $post['title'] ?>'
              });

              google.maps.event.addListener(map, 'mousemove', function(event){
                document.getElementById('latspan').innerHTML = event.latLng.lat();
                document.getElementById('lngspan').innerHTML = event.latLng.lng();
              });
            }
          </script>
          <script async defer
              src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDeTMHQ3sm7_RXFEBlAbVRrHwCH6sOTSUU&callback=initMap">
          </script>
    <!-- INI BAGIAN TESTIMONI   --><!-- INI BAGIAN TESTIMONI   --><!-- INI BAGIAN TESTIMONI   --><!-- INI BAGIAN TESTIMONI   --><!-- INI BAGIAN TESTIMONI   -->
          <div class="w3-container w3-teal w3-card-8">
               <center><h2 style="font-family:'Raleway'">- Testimonial -</h2></center>
          </div>
          <ul class="w3-ul w3-hoverable w3-white">
          <?php
                $query = "SELECT * FROM ratings WHERE id_post ='$id_POST'";
                $exe2   = mysqli_query($conn,$query);
                if(mysqli_fetch_assoc($exe2)) {
          ?>
                  <div style="height: 550px; overflow: auto;">
                <?php
                      $query = "SELECT * FROM ratings WHERE id_post ='$id_POST'";
                      $exe   = mysqli_query($conn,$query);
                ?>
                <?php  while($ratee = mysqli_fetch_assoc($exe)) { ?>
                    <?php
                          $idd_user = $ratee['id_user'];
                          $query    = "SELECT * FROM user WHERE id = '$idd_user'";
                          $z        = mysqli_query($conn,$query);
                          $mar      = mysqli_fetch_assoc($z);
                    ?>
                            <a style="text-decoration:none;" href="profile.php?id=<?php echo urlencode($idd_user); ?>">
                  <li class="w3-hover-blue w3-padding-16">
                        <span class="w3-right"><?php echo formatDate($ratee['dates']); ?></span>
                        <img src="<?php echo $mar['avatar']; ?>"alt="Image" class="w3-circle w3-card-4 w3-left w3-margin-right" style="width:50px">
                        <span class="w3-large"><i><strong><?php echo $mar['nama']; ?></strong></i></span><br>

                        <?php if($ratee['rate'] == 5) { ?>
                        <span class="w3-large"><h4>Rating :
                          <i class="fa fa-star w3-text-amber " ></i>
                          <i class="fa fa-star w3-text-amber " ></i>
                          <i class="fa fa-star w3-text-amber " ></i>
                          <i class="fa fa-star w3-text-amber " ></i>
                          <i class="fa fa-star w3-text-amber " ></i>
                        </h4></span></br>
                        <?php } elseif($ratee['rate'] == 4) { ?>
                            <span class="w3-large"><h4>Rating :
                          <i class="fa fa-star w3-text-amber " ></i>
                          <i class="fa fa-star w3-text-amber " ></i>
                          <i class="fa fa-star w3-text-amber " ></i>
                          <i class="fa fa-star w3-text-amber " ></i>
                          <i class="fa fa-star-o w3-text-amber " ></i>
                        </h4></span></br>
                        <?php } elseif($ratee['rate'] == 3) { ?>
                            <span class="w3-large"><h4>Rating :
                          <i class="fa fa-star w3-text-amber " ></i>
                          <i class="fa fa-star w3-text-amber " ></i>
                          <i class="fa fa-star w3-text-amber " ></i>
                          <i class="fa fa-star-o w3-text-amber " ></i>
                          <i class="fa fa-star-o w3-text-amber " ></i>
                        </h4></span></br>
                        <?php } elseif($ratee['rate'] == 2) { ?>
                            <span class="w3-large"><h4>Rating :
                          <i class="fa fa-star w3-text-amber " ></i>
                          <i class="fa fa-star w3-text-amber " ></i>
                          <i class="fa fa-star-o w3-text-amber " ></i>
                          <i class="fa fa-star-o w3-text-amber " ></i>
                          <i class="fa fa-star-o w3-text-amber " ></i>
                        </h4></span></br>
                        <?php } elseif($ratee['rate'] == 1) { ?>
                            <span class="w3-large"><h4>Rating :
                          <i class="fa fa-star w3-text-amber " ></i>
                          <i class="fa fa-star-o w3-text-amber " ></i>
                          <i class="fa fa-star-o w3-text-amber " ></i>
                          <i class="fa fa-star-o w3-text-amber " ></i>
                          <i class="fa fa-star-o w3-text-amber " ></i>
                        </h4></span></br>
                        <?php } ?>

                        <h6 style="font-size:18px; font-family:'Raleway';"><i class="fa fa-commenting"></i><?php echo '  ' ?><?php echo $ratee['comment']; ?> </h6>
                  </li>
                <div class="w3-container w3-light-grey" style="height:3px;">
                </div>
                </a>

                <?php } ?>
        </div>
            <?php }else{ ?>
                  <li style="font-size:24px;" class="w3-center w3-padding-16">Sorry there are No Review yet for this Event </li>
              <?php } ?>
              </ul>

  </div>
        <hr>
    <!-- INI BAGIAN TESTIMONI   --><!-- INI BAGIAN TESTIMONI   --><!-- INI BAGIAN TESTIMONI   --><!-- INI BAGIAN TESTIMONI   --><!-- INI BAGIAN TESTIMONI   --><!-- INI BAGIAN TESTIMONI   -->
      </div>

      <!-- Introduction menu -->
      <div class="w3-col l4">

        <!-- Posts -->
        <div class="w3-card-2 w3-margin">
          <div class="w3-teal w3-card-4 w3-container w3-padding">

            <h4>Registered Sponsor</h4>

          </div>
          <?php
                $query  = "SELECT * FROM daftar_sponsor WHERE ID_POST ='$id_POST'";
                $jalan  = mysqli_query($conn,$query);
                $jalan2 = mysqli_query($conn,$query);
                $ngecek = mysqli_fetch_assoc($jalan2);  //ngecek apakah didatabase sudah ada atau belum!

          ?>
          <ul class="w3-ul w3-hoverable w3-white">
            <?php     if($ngecek) {
                      while($cobol = mysqli_fetch_assoc($jalan) ) { ?>
            <li class="w3-padding-16">
                <img src="<?php echo $cobol['foto_sponsor']; ?>" alt="Image" class="w3-left w3-margin-right" style="width:50px">
                <span class="w3-large"><?php echo $cobol['nama_sponsor']; ?></span><br>
            </li>
            <?php } ?>
          <?php } else { ?>
              <li class="w3-padding-16">tidak ada pendaftar sponsor. .</li>
            <?php } ?>
          </ul>
          <?php
                if($_SESSION['status']=='Sponsor' || $_SESSION['status']=='Admin' ) {
                $id_sponsor = $_SESSION['id'];
                $query      = "SELECT * FROM daftar_sponsor WHERE ID_POST ='$id_POST' AND ID_SPONSOR = '$id_sponsor'";
                $chekk      = mysqli_query($conn,$query);

                if(mysqli_fetch_assoc($chekk)){
                  ?>
                  <div class="w3-container">
                    <center>  <a href="post.php?batalsponsor=<?php echo $id_POST; ?>"><button class="w3-red w3-btn w3-wide"><i class="fa fa-trash"></i>Batal daftar Sponsor</button></a> </center>
                  </div>
                <?php } else { ?>
                  <div class="w3-container w3-white">
                    <center>  <a href="post.php?daftarsponsor=<?php echo $id_POST; ?>"><button class="w3-blue w3-btn w3-wide"><i class="fa fa-usd"></i>Daftar Sponsor</button></a> </center>
                  </div>
                <?php

              }
            }
          ?>
        </div>
        <hr>

        <!-- Labels / tags -->
        <?php $query = "SELECT * FROM ratings WHERE id_post ='$id_POST'";
              $jalan = mysqli_query($conn,$query);
              $total = 0; $rate_total=0;
              while($w = mysqli_fetch_assoc($jalan)){
                $total+=1;
                $rate_total+=$w['rate'];
              }
              if($total != 0){
                    $number = $rate_total*1.0/$total;
             } else {$number = 0;}
         ?>

        <div class="w3-card-2 w3-margin">
          <div class="w3-card-4 w3-blue w3-container w3-padding">
            <h2>Overall :
              <!-- kalo 5 -->
              <?php if($number == 5) { ?>
                <i class="fa fa-star w3-text-amber" ></i>
                <i class="fa fa-star w3-text-amber" ></i>
                <i class="fa fa-star w3-text-amber" ></i>
                <i class="fa fa-star w3-text-amber" ></i>
                <i class="fa fa-star w3-text-amber" ></i>
                <!-- kalo 4,1 - 4,4 -->
                <?php } elseif($number >= 4.1) { ?>
                  <i class="fa fa-star w3-text-amber" ></i>
                  <i class="fa fa-star w3-text-amber" ></i>
                  <i class="fa fa-star w3-text-amber" ></i>
                  <i class="fa fa-star w3-text-amber" ></i>
                  <i class="fa fa-star-half-o w3-text-amber" ></i>
                  <!-- kalo 4 -->
                  <?php } elseif($number == 4) { ?>
                    <i class="fa fa-star w3-text-amber" ></i>
                    <i class="fa fa-star w3-text-amber" ></i>
                    <i class="fa fa-star w3-text-amber" ></i>
                    <i class="fa fa-star w3-text-amber" ></i>
                    <i class="fa fa-star-o w3-text-amber" ></i>
                  <!-- kalo 3,5 - 3,9 -->
                  <?php } elseif($number >= 3.1) { ?>
                    <i class="fa fa-star w3-text-amber" ></i>
                    <i class="fa fa-star w3-text-amber" ></i>
                    <i class="fa fa-star w3-text-amber" ></i>
                    <i class="fa fa-star-half-o w3-text-amber" ></i>
                    <i class="fa fa-star-o w3-text-amber" ></i>
                    <!-- kalo 3,0 - 3,4 -->
                    <?php } elseif($number == 3) { ?>
                      <i class="fa fa-star w3-text-amber" ></i>
                      <i class="fa fa-star w3-text-amber" ></i>
                      <i class="fa fa-star w3-text-amber" ></i>
                      <i class="fa fa-star-o w3-text-amber" ></i>
                      <i class="fa fa-star-o w3-text-amber" ></i>
                      <!-- kalo 2,5 - 2,9 -->
                      <?php } elseif($number >= 2.1) { ?>
                        <i class="fa fa-star w3-text-amber" ></i>
                        <i class="fa fa-star w3-text-amber" ></i>
                        <i class="fa fa-star-half-o w3-text-amber" ></i>
                        <i class="fa fa-star-o w3-text-amber" ></i>
                        <i class="fa fa-star-o w3-text-amber" ></i>
                      <!-- kalo 2,0 - 2,4 -->
                        <?php } elseif($number == 2) { ?>
                          <i class="fa fa-star w3-text-amber" ></i>
                          <i class="fa fa-star w3-text-amber" ></i>
                          <i class="fa fa-star-o w3-text-amber" ></i>
                          <i class="fa fa-star-o w3-text-amber" ></i>
                          <i class="fa fa-star-o w3-text-amber" ></i>
                            <!-- kalo 1,5 - 1,9 -->
                          <?php } elseif($number >= 1.1) { ?>
                            <i class="fa fa-star w3-text-amber" ></i>
                            <i class="fa fa-star-half-o w3-text-amber" ></i>
                            <i class="fa fa-star-o w3-text-amber" ></i>
                            <i class="fa fa-star-o w3-text-amber" ></i>
                            <i class="fa fa-star-o w3-text-amber" ></i>
                            <!-- kalo 1 - 1,4 -->
                          <?php } elseif($number >= 1) { ?>
                                <i class="fa fa-star w3-text-amber" ></i>
                                <i class="fa fa-star-o w3-text-amber" ></i>
                                <i class="fa fa-star-o w3-text-amber" ></i>
                                <i class="fa fa-star-o w3-text-amber" ></i>
                                <i class="fa fa-star-o w3-text-amber" ></i>
                      <?php } elseif($number == 0) { ?>
                        <i class="fa fa-star-o w3-text-amber" ></i>
                        <i class="fa fa-star-o w3-text-amber" ></i>
                        <i class="fa fa-star-o w3-text-amber" ></i>
                        <i class="fa fa-star-o w3-text-amber" ></i>
                        <i class="fa fa-star-o w3-text-amber" ></i>
                      <?php } ?>


              <?php $query = "SELECT * FROM ratings WHERE id_post ='$id_POST'";
                    $jalan = mysqli_query($conn,$query);
                    $total = 0; $rate_total=0;
                    while($w = mysqli_fetch_assoc($jalan)){
                      $total+=1;
                      $rate_total+=$w['rate'];
                    }
               ?>
              (<?php echo $total; ?>)</h2> <br>
          <div class="w3-container">
              <center style="margin-top:0px;">
                  <span style="font-size:70px; font-family:Roboto">
                    <strong>
                          <?php
                          if($total != 0){
                        $number = $rate_total*1.0/$total;}
                        else {$number = 0;}
                        print round($number, 1); ?>
                   </strong></span>
              </center>
         </div>
          </div>

    <?php if($_SESSION['status']!='nouser') {  ?>
                  <div class="w3-card-2 w3-container w3-white">
                    <ul class="w3-ul w3-white">
                  <?php
                        $fork        = $_SESSION['id'];
                        $cekah       = 0;
                        $query       = "SELECT * FROM ratings WHERE id_post = '$id_POST' AND id_user ='$fork'";
                        $opt         = mysqli_query($conn,$query);
                        $udah_rating = mysqli_fetch_assoc($opt);
                        if($udah_rating['id_user'] == $_SESSION['id']) {
                        $cek   = $_SESSION['id'];
                        $query = "SELECT * FROM user WHERE id = '$cek'";
                        $opt   = mysqli_query($conn,$query);
                        $guna  = mysqli_fetch_assoc($opt);
                  ?>
                      <li class="w3-padding-16">
                            <img src="<?php echo $guna['avatar']; ?>" alt="Image" class="w3-circle w3-card-4 w3-shadow w3-left w3-margin-right" style="width:50px">
                            <span class="w3-large"><?php echo $guna['nama']; ?></span><br>
                            <?php if($udah_rating['rate'] == 5) { ?>
                            <span class="w3-large"><h4>Rating :
                              <i class="fa fa-star" ></i>
                              <i class="fa fa-star" ></i>
                              <i class="fa fa-star" ></i>
                              <i class="fa fa-star" ></i>
                              <i class="fa fa-star" ></i>
                            </h4></span></br>
                            <?php } elseif($udah_rating['rate'] == 4) { ?>
                                <span class="w3-large"><h4>Rating :
                              <i class="fa fa-star" ></i>
                              <i class="fa fa-star" ></i>
                              <i class="fa fa-star" ></i>
                              <i class="fa fa-star" ></i>
                              <i class="fa fa-star-o" ></i>
                            </h4></span></br>
                            <?php } elseif($udah_rating['rate'] == 3) { ?>
                                <span class="w3-large"><h4>Rating :
                              <i class="fa fa-star" ></i>
                              <i class="fa fa-star" ></i>
                              <i class="fa fa-star" ></i>
                              <i class="fa fa-star-o" ></i>
                              <i class="fa fa-star-o" ></i>
                            </h4></span></br>
                            <?php } elseif($udah_rating['rate'] == 2) { ?>
                                <span class="w3-large"><h4>Rating :
                              <i class="fa fa-star" ></i>
                              <i class="fa fa-star" ></i>
                              <i class="fa fa-star-o" ></i>
                              <i class="fa fa-star-o" ></i>
                              <i class="fa fa-star-o" ></i>
                            </h4></span></br>
                            <?php } elseif($udah_rating['rate'] == 1) { ?>
                                <span class="w3-large"><h4>Rating :
                              <i class="fa fa-star" ></i>
                              <i class="fa fa-star-o" ></i>
                              <i class="fa fa-star-o" ></i>
                              <i class="fa fa-star-o" ></i>
                              <i class="fa fa-star-o" ></i>
                            </h4></span></br>
                            <?php } ?>

                            <h6 style="font-family:'Raleway'"><?php echo $udah_rating['comment']; ?></h6>
                              <div style="height:3px;" class="w3-card-4 w3-container w3-blue">
                              </div>
                            <center>
                              <!-- href="edit_rating.php?id= echo urlencode($id_POST); ?>" -->
                                <a><button onclick="document.getElementById('editrate').style.display='block'" class="w3-teal w3-btn w3-wide"><i class="fa fa-star"></i>Edit Rating</button></a>

                          </center>
                      </li>
                <?php $cekah = 1;
             }
                if($cekah == 0) { ?>
                      <li>
                          <form action="post.php?id=<?php echo $id_POST; ?>" method="post" enctype="multipart/form-data">
                            Rating : <select name="rate">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                  </select>
                                <input type=text name="komen" placeholder="enter your testimoni">
                                <input name="submit" type="submit" value="Rate!">

                          </form>
                      </li>

            <?php } ?>
                    </ul>
                  </div>
    <?php } ?>
        </div>
        <hr>
        <!-- Labels / tags -->
        <?php
            $query7 = mysqli_query($conn,"SELECT * FROM daftar_event WHERE id_post = '$id_POST'");
            $query76 = mysqli_query($conn,"SELECT * FROM daftar_event WHERE id_post = '$id_POST'");
         ?>
         <div class="w3-card-2 w3-margin">
          <div class="w3-teal w3-container w3-padding">
            <h4>List Pendaftar</h4>
          </div>

            <table class="w3-container w3-card-4 w3-table-all w3-hoverable">
              <thead>
                <tr class="w3-blue">
                  <th>No.</th>
                  <th>Reserved People</th>
                </tr>
              </thead>
                <?php if(mysqli_fetch_assoc($query76)) : ?>
                <?php $sum = 1; ?>
                <?php while($row = mysqli_fetch_assoc($query7)) : ?>
              <tr>
                      <td><?php echo $sum; $sum++; ?></td>
                      <td class="w3-hover-teal"><?php echo $row['nama']; ?></td>
              </tr>
                  <?php endwhile; ?>
                <?php else : ?>
                  <td>There are no attendant yet<td>
              <?php endif; ?>
            </table>
        </div>
        <?php $sama = 0; $id = $_SESSION['id'];
        $query5 = mysqli_query($conn,"SELECT * FROM daftar_event WHERE id_post = '$id_POST'");
        while($row = mysqli_fetch_assoc($query5)) {
        if($row['id_user'] == $id) {$sama = 1;}}
        if($sama == 0 && $_SESSION['id']!=0)
        {
        ?>
        <?php if($_SESSION['status'] != "Sponsor") { ?>
        <div class="w3-container">
          <center>  <a href="post.php?id=<?php echo $id_POST; ?>&daftar_event=<?php echo $id_POST; ?>"><button class="w3-blue w3-btn w3-wide"><i class="fa fa-usd"></i>Daftar Event</button></a> </center>
        </div>
        <?php }}?>

        <?php if($sama == 1 && $_SESSION['id']!=0) { ?>
        <div class="w3-container">
          <center>  <a href="post.php?id=<?php echo $id_POST?>&batal_event=<?php echo $id_POST; ?>"><button class="w3-red w3-btn w3-wide"><i class="fa fa-usd"></i>Batal Daftar Event</button></a> </center>
        </div>
        <?php } ?>
      <!-- END Introduction Menu -->
      </div>

  <!-- END GRID -->
  </div><br>

  <!-- END w3-content -->
  </div>
  <?php include 'includes/footer.php'; ?>
