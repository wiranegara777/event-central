<?php include 'includes/header_post_event.php'; ?>
<?php
    $id = $_GET['id'];
    //create query
    $query = "SELECT * FROM categories";
    //run query
  //  $categories = $db->select($query);    //categories
    $categories =  mysqli_query($conn,$query);

    $query = "SELECT * FROM post WHERE id = '$id'";
    $edit = mysqli_query($conn,$query);
    $event = mysqli_fetch_assoc($edit);
 ?>
 <!--UNTUK HAPUS POST!!-------------------------------------------------->
<?php
      if(isset($_POST['delete'])){
        $hapus2="DELETE FROM daftar_sponsor WHERE ID_POST = '$id'";
        mysqli_query($conn,$hapus2);

        $sql_hapus = "DELETE FROM post WHERE id = '$id'";
        if (mysqli_query($conn, $sql_hapus)){
      ?>
      		<script language="javascript">alert("Delete Event Successful");</script>
      		<script>document.location.href='index.php';</script>
      <?php
      	}
      	else{
      ?>
      		<script language="javascript">alert("Delete Event Failed");</script>
      		<script>document.location.href='index.php';</script>
      <?php
      	}
      	mysqli_close($conn);

      }
 ?>
 <!-- UNTUK UPDATE POST ----------------------------------------------------------------------------------->
<?php
      if(isset($_POST['submit'])){
        //assigns Var
        $title    = $_POST['title'];
        $address  = $_POST['address'];
        $tanggal  = $_POST['date'];
        $tanggal2 = $_POST['date_finish'];
        $body     = $_POST['body'];
        $category = $_POST['category'];

        $bulan   = strtok($tanggal,'/');
        $tanggal = strtok('/');
        $tahun   = strtok('/');

        $bulan2   = strtok($tanggal2,'/');
        $tanggal2 = strtok('/');
        $tahun2   = strtok('/');

        //target direktori tempat nyimpen gambar
        $target = "images/".basename($_FILES['image']['name']);
        //nama gambar
        $image = $_FILES['image']['name'];
        $id_user = $_SESSION['id'];
        $lat = $_POST['lat'];
        $long = $_POST['long'];

        //Simple validation
        if($title == ''|| $body == '' || $category == ''){
            //set error
            $error = 'Isi semua atribut!';
            echo $error;
        }else if($image != ''){
            $ganti =  "UPDATE post SET title='$title',body = '$body',category = '$category', langtitude = '$lat',longtitude = '$long' ,
            alamat = '$address', tanggal='$tanggal',bulan = '$bulan',tahun = '$tahun' ,image ='images/$image',
            date_finish = '$tanggal2', month_finish = '$bulan2', year_finish = '$tahun2'
             WHERE id = '$id'";
            move_uploaded_file($_FILES['image']['tmp_name'],"$target");
            if(mysqli_query($conn,$ganti)){
              ?>
              <script language="javascript">alert("Event Successfully Updated");</script>
              <script>document.location.href='index.php';</script>
              <?php
              }else{
              ?>
              <script language="javascript">alert("Event Failed to Update");</script>
              <script>document.location.href='index.php';</script>
            <?php }

        } else {
          $ganti =  "UPDATE post SET title='$title',body = '$body',category = '$category', langtitude = '$lat',longtitude = '$long' ,
          alamat = '$address', tanggal='$tanggal',bulan = '$bulan',tahun = '$tahun', date_finish = '$tanggal2', month_finish = '$bulan2', year_finish = '$tahun2'
          WHERE id = '$id'";
          if(mysqli_query($conn,$ganti)){
            ?>
            <script language="javascript">alert("Event Successfully Updated");</script>
            <script>document.location.href='index.php';</script>
            <?php
            }else{
            ?>
            <script language="javascript">alert("Event Failed to Update");</script>
            <script>document.location.href='index.php';</script>
          <?php }
        }
      }
      mysqli_close($conn);
 ?>


<div class="parallax2"></div>
  <div class="w3-container w3-blue w3-card-8">
        <center><h2 id="damion-big" style="font-size:50px">Edit Event</h2></center>
  </div>

  <!DOCTYPE html>
  <html>
  <title>Edit Event | Event Central</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <body class="w3-light-grey">

  <!-- Page Container -->
  <div class="w3-content w3-margin-top" style="max-width:1400px;">

  <!-- The Grid -->

  <div class="w3-row-padding">


    <!-- Right Column -->
    <div style="margin-left:220px"  class="w3-twothird">

      <div class="w3-container w3-card-4 w3-padding">
          <h2>Edit Post Event</h2>
          <div class="formasik">
              <form role="form" method="post" action="edit_event.php?id=<?php echo $id; ?>" enctype="multipart/form-data">

                  <label>Event Title</label>
                  <input name="title" type="text" class="form-control" placeholder="Enter Title" value="<?php echo $event['title']; ?>">

                  <label>Location</label>
                  <input name="address" type="text" class="form-control" placeholder="Enter Address" value="<?php echo $event['alamat']; ?>">

                  <p>Date start:  <input type="text" name="date" id="datepicker" value= "<?php echo $event['bulan']; echo '/'; echo $event['tanggal']; echo '/'; echo $event['tahun']; ?>"></p>
                  <p>Date finish: <input type="text" name="date_finish" id="datepicker2" value= "<?php echo $event['month_finish']; echo '/'; echo $event['date_finish']; echo '/'; echo $event['year_finish']; ?>"></p>
                </br>
                </br>


                  <label>Event Description</label>
                  <textarea class="ckeditor" id="body" name="body" placeholder="Enter Description Event">
                          <?php echo $event['body']; ?>
                  </textarea>
                    </br>
                  <script>
                      CKEDITOR.replace( 'body' );
                  </script>

                  <label>Category</label>
                      <select name="category">
                        <?php while($row = mysqli_fetch_assoc($categories)) {
                             if($row['id'] == $event['category'] ){
                                  $selected = 'selected';
                            }
                              else {
                                $selected = '';
                              }
                            ?>
                          <option <?php echo $selected; ?> value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                        <?php } ?>
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
            						<input style="width:30%;" type="text" name="lat" id="lat" value="<?php echo $event['langtitude']; ?>">
            						<label class="item" for="latpost">Latitude</label>
            					</div>
            					<div class="input-field col s6">
            						<i class="fa fa-map prefix"></i>
            						<input style="width:30%;" type="text" name="long" id="long" value="<?php echo $event['longtitude']; ?>">
            						<label class="item" for="long">Longitude</label>
            					</div>

                      <script type="text/javascript">
                      						function initMap() {
                      							var bogor = {lat: <?php echo $event['langtitude']; ?>, lng: <?php echo $event['longtitude']; ?>};

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

                <input name="submit" class="w3-blue" type="submit" value="Update">
                <input name="delete" class="w3-red" type="submit" value="delete">


              </form>
                <div class="w3-center"><a style="text-decoration:none;" href="index.php"><div class="w3-teal w3-button">Cancel</div></a></div>
       </div>

      </div>
</br>

    <!-- End Right Column -->
    </div>

  <!-- End Grid -->
  </div>

  <!-- End Page Container -->
  </div>



  </body>
  </html>


<?php include 'includes/footer.php'; ?>
