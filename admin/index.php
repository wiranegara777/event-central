 <?php include 'header.php'; ?>
 <?php
     $conn = mysqli_connect('localhost', 'root', '', 'event')
     or die ("Connection Failed".mysqli_error());

     $query = "SELECT user.*, otoritas.level FROM user
                 INNER JOIN otoritas
                 ON user.otoritas = otoritas.id  ORDER BY user.id DESC";
    $jalankan = mysqli_query($conn,$query);
    ?>
 <?php
  //Create DB object
  $db= new Database;

  //create new query
  $query = "SELECT post.*, categories.name FROM post
              INNER JOIN categories
              ON post.category = categories.id where post.validation = 1 ORDER BY post.id DESC";
  //Run query
  $posts = $db->select($query);

  //create query
  $query = "SELECT * FROM categories";
  //run query
  $categories = $db->select($query);    //categories

  $query = "SELECT * FROM post";
  $sum_post= $db->select($query);

  $query = "SELECT * FROM categories";
  $sum_category= $db->select($query);

  $query = "SELECT * FROM user ORDER BY id DESC";
  $sum_user = mysqli_query($conn,$query);

  $query = "SELECT * FROM post WHERE validation = 0";
  $sum_valid = mysqli_query($conn,$query);
?>
<?php
    $total=0;
    $total_category=0;
    $total_user=0;
    $total_valid=0;
    while($row = $sum_post->fetch_assoc()){
    $total+=1;
    }
    while($row = $sum_category->fetch_assoc()){
    $total_category+=1;
    }
    while($row = mysqli_fetch_assoc($sum_user)){
    $total_user+=1;
    }
    while($row = mysqli_fetch_assoc($sum_valid)){
    $total_valid+=1;
    }

 ?>
 <?php
        if(isset($_GET['hapusUser'])){

          $id_user = $_GET['hapusUser'];

          $query1  = "DELETE FROM daftar_event where id_user = '$id_user'";
          $query2  = "DELETE FROM daftar_sponsor where ID_SPONSOR = '$id_user'";
          $query3  = "DELETE FROM user WHERE id = '$id_user'";
          $query4  = "DELETE FROM ratings WHERE id_user = '$id_user'";
          $sum = 0;
          if(mysqli_query($conn,$query1)) {$sum+=1;}
          if(mysqli_query($conn,$query2)) {$sum+=1;}
          if(mysqli_query($conn,$query3)) {$sum+=1;}
          if(mysqli_query($conn,$query4)) {$sum+=1;}
          // $query = "DELETE FROM daftar_sponsor WHERE ID_SPONSOR ='$id_sponsor' AND ID_POST = '$id_POST'";
          if($sum >= 1) { ?>
               <script language="javascript">alert("Berhasil Hapus User");</script>
               <script>document.location.href='index.php';</script>
          <?php } else { ?>
               <script language="javascript">alert("Gagal Hapus User");</script>
               <script>document.location.href='index.php';</script>
          <?php }

            mysqli_close($conn);
        }
 ?>

 <?php
        if(isset($_GET['hapuspost'])){

          $id_post = $_GET['hapuspost'];
          $query = "DELETE FROM post WHERE id = '$id_post'";
          // $query = "DELETE FROM daftar_sponsor WHERE ID_SPONSOR ='$id_sponsor' AND ID_POST = '$id_POST'";
          if(mysqli_query($conn,$query)) { ?>
               <script language="javascript">alert("Berhasil Hapus Post!");</script>
               <script>document.location.href='index.php';</script>
          <?php } else { ?>
               <script language="javascript">alert("Gagal Hapus Post");</script>
               <script>document.location.href='index.php';</script>
          <?php }

            mysqli_close($conn);
        }
 ?>
 <?php
        if(isset($_GET['publish'])){

          $id_post = $_GET['publish'];
          $query = "UPDATE post SET validation = 1 WHERE id = '$id_post'";
          $qq = mysqli_query($conn,"SELECT * FROM post where id = '$id_post'");
          $rrow = mysqli_fetch_array($qq);
          $namaEvent = $rrow['title'];
          $id_user   = $rrow['user_id'];

          // $query = "DELETE FROM daftar_sponsor WHERE ID_SPONSOR ='$id_sponsor' AND ID_POST = '$id_POST'";
          if(mysqli_query($conn,$query)) {
            $query77 = mysqli_query($conn,"INSERT INTO notif (pesan,id_user) values ('$namaEvent Published','$id_user')");
            ?>
            <script language="javascript">alert("Berhasil Publish Post!");</script>
            <script>document.location.href='index.php';</script>
          <?php } else { ?>
            <script language="javascript">alert("Gagal Publish Post");</script>
            <script>document.location.href='index.php';</script>
          <?php }

            mysqli_close($conn);
        }
 ?>
<!-- Overlay effect when opening sidebar on small screens -->
  <!-- Header -->

  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My Dashboard </b></h5>
  </header>

  <?php if(isset($_GET['msg'])) : ?>
        <div class="w3-panel w3-green w3-round">
         <h3><?php echo $_GET['msg']; ?></h3>
       </div>
  <?php endif; ?>

  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-card-4 w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-calendar w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $total; ?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Event Total</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-card-4 w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-tags w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $total_category; ?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Category</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-card-4 w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-share-alt w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $total_valid; ?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Pending Events</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-card-4 w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3> <?php echo $total_user; ?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Users</h4>
      </div>
    </div>
  </div>
<!--Ini Tabel List Event -->
<div class="w3-container">
<h2>List Events</h2>
<div style="height: 400px; overflow: auto;" class="w3-card-4">
<table class="w3-card-4 w3-table-all w3-hoverable">
  <thead>
   <tr class="w3-blue">
      <th>Event #ID</th>
      <th>Event Title</th>
      <th>Category</th>
      <th>Author</th>
      <th>Date</th>
    </tr>
  </thead>

    <?php while($row = $posts->fetch_assoc()) : ?>
  <tr>
          <td><?php echo $row['id']; ?></td>
          <td class="w3-hover-teal"><a style="text-decoration:none;"  href="edit_post.php?id=<?php echo $row['id']; ?>"> <i class="fa fa-pencil"></i><?php echo $row['title']; ?></a></td>
          <td><?php echo $row['name']; ?></td>
          <td>
            <?php
                  $id_USER = $row['user_id'];
                  $query = "SELECT * FROM user WHERE id = '$id_USER'";
                  $my = mysqli_query($conn,$query);
                  $userr = mysqli_fetch_assoc($my);
                  echo $userr['nama'];
              ?>
          </td>
          <td><?php echo formatDate($row['date']); ?></td>
  </tr>
<?php endwhile; ?>

</table>
</div>
</div>

  <div class="w3-container">
  <h2>List pending Events</h2>
<!-- <div style="height: 400px; overflow: auto;" class="w3-card-4"> -->
  <table class="w3-card-4 w3-table-all">
    <thead>
     <tr class="w3-blue">
        <th>Event #ID</th>
        <th>Validation</th>
        <th>Event Title</th>
        <th>Category</th>
        <th>Author</th>
        <th>Date</th>
      </tr>
    </thead>

<?php
      $query = "SELECT * FROM post WHERE validation = 0 ORDER BY id DESC";
      $posts = mysqli_query($conn,$query);

 ?>
      <?php while($row = mysqli_fetch_assoc($posts)) : ?>
    <tr>
            <td><?php echo $row['id']; ?></td>
            <td>
              <span onclick="document.getElementById('de<?php echo $row['id']; ?>').style.display='block'" class="w3-btn w3-red"><i class="fa fa-pencil"></i> Delete </span></a>
              <a href="index.php?publish=<?php echo $row['id']; ?>"><span class="w3-btn w3-green"><i class="fa fa-pencil"></i> Publish </span></a>
            </td>
            <td><a class="w3-text-blue" style="text-decoration:none;"  href="preview_post.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></td>
            <td>
              <?php
                   $id_katego = $row['category'];
                   $query = "SELECT * FROM categories WHERE id = '$id_katego'";
                   $jalan = mysqli_query($conn,$query);
                   $pop_catego = mysqli_fetch_assoc($jalan);
                   echo $pop_catego['name'];
              ?>

            </td>
            <td>
              <?php
                    $id_USER = $row['user_id'];
                    $query = "SELECT * FROM user WHERE id = '$id_USER'";
                    $my = mysqli_query($conn,$query);
                    $userr = mysqli_fetch_assoc($my);
                    echo $userr['nama'];
                ?>
            </td>
            <td><?php echo formatDate($row['date']); ?></td>
    </tr>
    <div id="de<?php echo $row['id']; ?>" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:350px">

          <div class="w3-teal w3-center"><br>
            <span onclick="document.getElementById('de<?php echo $row['id']; ?>').style.display='none'" class="w3-button w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
          </div>

          <div class="w3-padding">
              <div class="w3-container">
                <p>Apakah Anda yakin ingin menghapus Event <b><?php echo $row['title']; ?> ?</b></p>
                </br>
                <a href="index.php?hapuspost=<?php echo $row['id']; ?>"><span class="w3-button w3-blue">YA</span></a><span class="w3-button w3-red" onclick="document.getElementById('de<?php echo $row['id']; ?>').style.display='none'">TIDAK</span>
              </div>
          </div>
        </div>
      </div>
  <?php endwhile; ?>

  </table>
<!-- </div> -->
</div>



<div class="w3-container">
<h2>List User</h2>

<div style="height: 400px; overflow: auto;" class="w3-card-4">
<table class="w3-card-4 w3-table-all w3-hoverable">
  <thead>
    <tr class="w3-blue">
      <th>User #ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Level</th>
    </tr>
  </thead>
    <?php while($row = mysqli_fetch_assoc($jalankan)) : ?>
  <tr>
    <td><?php echo $row['id']; ?></td>
    <td><span onclick="document.getElementById('user<?php echo $row['id']; ?>').style.display='block'" class="w3-btn w3-red"><i class="fa fa-pencil"> </i> Delete </span> <?php echo $row['nama']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['level']; ?></td>
  </tr>
  <div id="user<?php echo $row['id']; ?>" class="w3-modal">
      <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:350px">

        <div class="w3-teal w3-center"><br>
          <span onclick="document.getElementById('user<?php echo $row['id']; ?>').style.display='none'" class="w3-button w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
        </div>

        <div class="w3-padding">
            <div class="w3-container">
              <p>Apakah Anda yakin ingin menghapus User <b><?php echo $row['nama']; ?> ?</b></p>
              </br>
              <a href="index.php?hapusUser=<?php echo $row['id']; ?>"><span class="w3-button w3-blue">YA</span></a><span class="w3-button w3-red" onclick="document.getElementById('user<?php echo $row['id']; ?>').style.display='none'">TIDAK</span>
            </div>
        </div>
      </div>
    </div>
<?php endwhile; ?>
</table>
</div>
</div>
<!--Ini Tabel Category -->
  <div class="w3-third w3-container">
  <h2>List Category</h2>

  <table class="w3-card-4 w3-table-all w3-hoverable">
    <thead>
      <tr class="w3-blue">
        <th>Category #ID</th>
        <th>Category Name</th>
      </tr>
    </thead>
      <?php while($row = $categories->fetch_assoc()) : ?>
    <tr>
      <td><?php echo $row['id']; ?></td>
      <td><a href="edit_category.php?id=<?php echo $row['id']; ?>"> <i class="fa fa-pencil"></i><?php echo $row['name']; ?></td>
    </tr>
  <?php endwhile; ?>
  </table>
</div>
<br>

  <div class="w3-container">
    <h5>Recent Registered Users</h5>
    <?php
          $query ="SELECT * FROM user ORDER BY id DESC LIMIT 3";
          $opt = mysqli_query($conn,$query);
          while($recent = mysqli_fetch_assoc($opt)) {
    ?>
    <ul class="w3-ul w3-card-4 w3-white">
      <li class="w3-padding-16">
        <img src="../<?php echo $recent['avatar']; ?>" class="w3-left w3-circle w3-margin-right" style="width:35px">
        <span class="w3-xlarge"><?php echo $recent['nama']; ?></span><br>
      </li>
  <?php } ?>
    </ul>
  </div>
  <hr>

  <div class="w3-container">
    <h5>Recent Review</h5>
    <?php

          $query = "SELECT * FROM ratings ORDER BY id DESC LIMIT 2";
          $exe = mysqli_query($conn,$query);
    ?>
    <?php  while($ratee = mysqli_fetch_assoc($exe)) { ?>
        <?php
              $idd_user = $ratee['id_user'];
              $query = "SELECT * FROM user WHERE id = '$idd_user'";
              $z = mysqli_query($conn,$query);
              $mar = mysqli_fetch_assoc($z);
        ?>
    <div class="w3-row">
      <div class="w3-col m2 text-center">
        <img class="w3-circle w3-card-4" src="../<?php echo $mar['avatar']; ?>" style="width:96px;height:96px">
      </div>
      <div class="w3-col m10 w3-container">
        <h4><?php echo $mar['nama']; ?> <span class="w3-opacity w3-medium"><?php echo $ratee['dates']; ?></span></h4><br>

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

        <p style="font-size:18px;"><i class="fa fa-commenting"></i><?php echo $ratee['comment']; ?></p><br>
      </div>
    </div>
<div class="w3-container w3-white" style="height:3px;">
</div>
<?php } ?>

  </div>
  <br>

  <?php include 'footer.php';?>
