<?php include 'header.php'; ?>
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
      if(isset($_GET['hapuspost'])){
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
        $ext     = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image   = date('mdYhia').'.'.$ext;
        $target  = "../images/".basename($image);
        //nama gambar
        
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

 <!-- INI BARU HTML NYA --> <!-- INI BARU HTML NYA --> <!-- INI BARU HTML NYA --> <!-- INI BARU HTML NYA --> <!-- INI BARU HTML NYA -->
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
<div class="w3-container w3-card-4 w3-padding">
    <h2>Edit Post Event</h2>
    <div class="formasik">
        <form role="form" method="post" action="edit_post.php?id=<?php echo $id; ?>" enctype="multipart/form-data">

            <label>Event Title</label>
            <input name="title" type="text" class="form-control" placeholder="Enter Title" value="<?php echo $event['title']; ?>">

            <label>Location</label>
            <input name="address" type="text" class="form-control" placeholder="Enter Address" value="<?php echo $event['alamat']; ?>">

            <p>Date start:  <input type="text" name="date" id="datepicker" value= "<?php echo $event['bulan']; echo '/'; echo $event['tanggal']; echo '/'; echo $event['tahun']; ?>"></p>
            <p>Date finish: <input type="text" name="date_finish" id="datepicker2" value= "<?php echo $event['month_finish']; echo '/'; echo $event['date_finish']; echo '/'; echo $event['year_finish']; ?>"></p>
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



        </form>
          <center><div onclick="document.getElementById('delete').style.display='block'" class="w3-center w3-button w3-red">Delete</div></center>
          <div class="w3-center"><a style="text-decoration:none;" href="index.php"><div class="w3-teal w3-button">Cancel</div></a></div>
 </div>

 <div id="delete" class="w3-modal">
     <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:350px">

       <div class="w3-teal w3-center"><br>
         <span onclick="document.getElementById('delete').style.display='none'" class="w3-button w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
       </div>

       <div class="w3-padding">
           <div class="w3-container">
             <p>Apakah Anda yakin ingin menghapus Event <b><?php echo $event['title']; ?> ?</b></p>
             </br>
             <a href="edit_post.php?id=<?php echo $event['id']; ?>&hapuspost=<?php echo $event['id']; ?>"><span class="w3-button w3-blue">YA</span></a><span class="w3-button w3-red" onclick="document.getElementById('delete').style.display='none'">TIDAK</span>
           </div>
       </div>
     </div>
   </div>
</div>
</br>
<?php include 'footer.php'; ?>
