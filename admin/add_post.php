<?php include 'header.php'; ?>
 <script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 <link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
 $( "#datepicker" ).datepicker();
} );
</script>
<script>
$( function() {
 $( "#datepicker2" ).datepicker();
} );
</script>
<!--  <script src="text/ckeditor.js"></script> -->
  <?php

      //create query
      $query = "SELECT * FROM categories";
      //run query
    //  $categories = $db->select($query);    //categories
      $categories =  mysqli_query($conn,$query);
  ?>
<div class="w3-container w3-card-4 w3-padding">

    <div class="formasik"><div class="w3-container w3-card-4 w3-padding">
        <h2>Add New Event</h2>
        <div class="formasik">
            <form role="form" method="post" action="../modules/add_eventprocess.php" enctype="multipart/form-data">

                <label>Event Title</label>
                <input name="title" type="text" class="form-control" placeholder="Enter Title">

                <label>Location</label>
                <input name="address" type="text" class="form-control" placeholder="Enter Address">

                <p>Date start:  <input type="text" name="date" id="datepicker"></p>
                <p>Date finish: <input type="text" name="date_finish" id="datepicker2"></p>
              </br>


                <label>Event Description</label>
                <textarea class="ckeditor" id="body" name="body" placeholder="Enter Description Event"></textarea>
                  </br>
                <script>
                    CKEDITOR.replace( 'body' );
                </script>

                <label>Category</label>
                    <select name="category">
                      <?php while($row = mysqli_fetch_assoc($categories)) : ?>
                          <?php if($row['id'] == $post['category'] ){
                                $selected = 'selected';
                          }
                            else {
                              $selected = '';
                            }
                          ?>
                        <option <?php echo $selected; ?>value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                      <?php endwhile; ?>
                    </select></br></br>
                    <label>Insert Image</label></br>
                        <input type="hidden" name="size" value"1000000">
                        <input type="file" name="image">
                      </br>
                      <center>
                    <label>
                    Klik Lokasi Tempat Event pada Map untuk mendapatkan latitude dan longitude </label>
                    <div id="map" style="width:85%; height:350px; border:2px solid #00ff00;"></div>
                      </center>
                    <div class="input-field col s6">
                      <i class="fa fa-map prefix"></i>
                      <input style="width:30%;" type="text" name="lat" id="lat" value="0">
                      <label class="item" for="latpost">Latitude</label>
                    </div>
                    <div class="input-field col s6">
                      <i class="fa fa-map prefix"></i>
                      <input style="width:30%;" type="text" name="long" id="long" value="0">
                      <label class="item" for="long">Longitude</label>
                    </div>

                    <script type="text/javascript">
                                function initMap() {
                                  var bogor = {lat: -6.5950181, lng: 106.7218509};

                                  var map = new google.maps.Map(document.getElementById('map'), {
                                    center: bogor,
                                    scrollwheel: false,
                                    zoom: 12
                                  });

                                  google.maps.event.addListener(map, 'click', function(event){
                                    document.getElementById('lat').value = event.latLng.lat();
                                    document.getElementById('long').value = event.latLng.lng();
                                  });
                                }
                              </script>
                              <script async defer
                                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDeTMHQ3sm7_RXFEBlAbVRrHwCH6sOTSUU&callback=initMap">
                              </script>

              <input name="submit" class="w3-blue" type="submit" value="Submit">


            </form>
              <a style="text-decoration:none;" href="index.php"><input name="submit" class="w3-red" type="submit" value="Cancel"></a>
     </div>

    </div>

</div>
<?php include 'footer.php'; ?>
