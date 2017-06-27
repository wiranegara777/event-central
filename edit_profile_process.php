<?php
      $id = $_GET['id'];
      include 'connect.php';
?>
 <!--UNTUK HAPUS POST!!-------------------------------------------------->
<?php
      if(isset($_POST['delete'])){
        $sql_hapus = "DELETE FROM user WHERE id = '$id'";

        if (mysqli_query($conn, $sql_hapus)){
      ?>
      		<script language="javascript">alert("Delete Successful");</script>   //skrip javascript untuk alert sderhana
      		<script>document.location.href='profile.php?id=<?php echo $id; ?>';</script>
      <?php
      	}
      	else{
      ?>
      		<script language="javascript">alert("Delete Failed");</script>
      		<script>document.location.href='profile.php?id=<?php echo $id; ?>';</script>
      <?php
      	}
      	mysqli_close($conn);

      }
 ?>
 <!-- UNTUK UPDATE POST ----------------------------------------------------------------------------------->
<?php
      if(isset($_POST['submit'])){
        //assigns Var
        $nama     = $_POST['title'];
        $alamat     = $_POST['alamat'];
        $body      = $_POST['body'];
        $telp     = $_POST['telp'];
        //target direktori tempat nyimpen gambar
        $target = "images/".basename($_FILES['image']['name']);
        //nama gambar
        $image = $_FILES['image']['name'];

        //Simple validation
        if($nama == ''|| $body == '' || $telp == '' || $alamat == '' ){
            //set error
            $error = 'Isi semua atribut!';
            echo $error;
        }else if($image != ''){
            $ganti =  "UPDATE user SET nama='$nama',deskripsi = '$body',alamat = '$alamat',telepon = '$telp',avatar='images/$image' WHERE id = '$id'";
            move_uploaded_file($_FILES['image']['tmp_name'],"$target");
            if(mysqli_query($conn,$ganti)){
              ?>
              <script language="javascript">alert("Profile Successfully Updated");</script>
              <script>document.location.href='profile.php?id=<?php echo $id; ?>';</script>
              <?php
              }else{
              ?>
              <script language="javascript">alert("Profile Failed to Update");</script>
              <script>document.location.href='profile.php?id=<?php echo $id; ?>';</script>
            <?php }

        } else {
          $ganti =  "UPDATE user SET nama='$nama',deskripsi = '$body',alamat = '$alamat',telepon = '$telp' WHERE id = '$id'";
          if(mysqli_query($conn,$ganti)){
            ?>
            <script language="javascript">alert("Profile Successfully Updated");</script>
          <script>document.location.href='profile.php?id=<?php echo $id; ?>';</script>
            <?php
            }else{
            ?>
            <script language="javascript">alert("Profile Failed to Update");</script>
          <script>document.location.href='profile.php?id=<?php echo $id; ?>';</script>
          <?php }
        }
          mysqli_close($conn);
      }
 ?>
