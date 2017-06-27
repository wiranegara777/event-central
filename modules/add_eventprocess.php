<?php include 'connect.php'; ?>
<?php
    if(isset($_POST['submit'])){
      //assigns Var
      $title    = $_POST['title'];
      $address  = $_POST['address'];
      $body     = $_POST['body'];
      $category = $_POST['category'];
      $tanggal  = $_POST['date'];
      $tanggal2  = $_POST['date_finish'];
      //target direktori tempat nyimpen gambar
      //$target     = "../images/".basename($_FILES['image']['name']);
      $foto_size  = $_FILES['image']['size'];
      $tipe_image = $_FILES['image']['type'];
      //nama gambar
      //$image = $_FILES['image']['name'];
      $ext     = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
      $image   = date('mdYhia').'.'.$ext;
      $target  = "../images/".basename($image);
      $id_user = $_SESSION['id'];
      $lat     = $_POST['lat'];
      $long    = $_POST['long'];

      $bulan   = strtok($tanggal,'/');
      $tanggal = strtok('/');
      $tahun   = strtok('/');

      $bulan2   = strtok($tanggal2,'/');
      $tanggal2 = strtok('/');
      $tahun2   = strtok('/');
      //Simple validation
      if($title == ''|| $body == '' || $category == ''){
          //set error
          $error = 'Isi semua atribut!';
          echo $error;
      }else {
          $query = "INSERT INTO post
                      (title,body,category,image,user_id,total_rating,validation,langtitude,longtitude,alamat,tanggal,bulan,tahun,date_finish,month_finish,year_finish)
                        VALUES('$title','$body', '$category','images/$image','$id_user','0','0','$lat','$long','$address','$tanggal','$bulan','$tahun','$tanggal2','$bulan2','$tahun2')";
        //  $insert_row = $db->insert($query);
            }
      if($tipe_image == "image/jpeg" || $tipe_image == "image/png"){
          if($foto_size < 1000000) {
                    if(move_uploaded_file($_FILES['image']['tmp_name'],"$target")){
                       if(mysqli_query($conn,$query)){
                          $query77 = mysqli_query($conn,"INSERT INTO notif (pesan,id_user) values ('Event Successfully uploaded','$id_user')");
                          $query77 = mysqli_query($conn,"INSERT INTO notif (pesan,id_user) values ('Waiting Confirmation from Admin','$id_user')");
                        ?>
                        	<script language="javascript">alert("Upload Event Successful Please wait to be confirmed by admin");</script>
                          <script>document.location.href='../index.php';</script>
                        <?php }else{
                          ?>
                          <script language="javascript">alert("failed making event");</script>
                          <script>document.location.href='../index.php';</script>
                          <?php
                           }
                         }
?>

      <?php

    } else {
    ?>
    <script language="javascript">alert("Ukuran Foto terlalu besar melebihi 1 MB");</script>
    <script>document.location.href='../index.php';</script>
    <?php }
  } else { ?>
    <script language="javascript">alert("File bukan foto!");</script>
    <script>document.location.href='../index.php';</script>
    <?php }
    mysqli_close($conn);

  }
?>
