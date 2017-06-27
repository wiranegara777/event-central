<?php include 'header.php'; ?>
 <script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<!--  <script src="text/ckeditor.js"></script> -->
  <?php
      $id = $_GET['id'];
      //create query
      $query = "SELECT * FROM post WHERE id = '$id'";
      //run query
      $op = mysqli_query($conn,$query);
      $post = mysqli_fetch_assoc($op);
  ?>
  <div class="w3-container w3-teal w3-card-8">
  <center><h2 id="damion-big" style="font-size:50px">- Preview Event -</h2></center>
  </div>
  <div class="w3-card-4 w3-margin w3-white">
    <img src="../<?php echo $post['image']; ?>" alt="Nature" style="width:100%">
    <div class="w3-container">
      <h1><b><?php echo $post['title']; ?></b></h1>
  <a class"w3-hover-red" style="text-decoration:none;" href="profile.php?id=<?php echo urlencode($post['user_id']); ?>">
      <h5>
        <?php
            $query = "SELECT * FROM user";
            $userr = mysqli_query($conn,$query);
            $nama=''; $ava='';
              while($username = mysqli_fetch_assoc($userr)){
                if($username['id'] == $post['user_id'] )
                {$nama = $username['nama'];
                 $ava = $username['avatar'];
                }
              }
       ?>
       <?php echo 'by '; echo $nama;  ?><img style="height:37px; width:37px; margin-top:0; margin-right:10px" class="avatar w3-hover-shadow w3-card-4 w3-left" src="../<?php echo $ava; ?>">

      </h5>
    </a>
      <span class="w3-opacity"><?php echo formatDate($post['date']); ?></span>
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


    </div>

</div>
<?php include 'footer.php'; ?>
