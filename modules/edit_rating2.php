<!-- Labels / tags -->
<?php
$conn = mysqli_connect('localhost', 'root', '', 'event')
or die ("Connection Failed".mysqli_error());
  if(isset($_POST['update'])){
  $id_rate = $_GET['id'];
  $id_user = $_SESSION['id'];
  $rate    = $_POST['rate'];
  $comment = $_POST['komen'];

  $query = mysqli_query($conn,"UPDATE ratings SET rate='$rate',comment='$comment' WHERE id_user='$id_user' AND id_post='$id_rate'");
?>
  <script language="javascript">alert("Successfully update ratings");</script>
  <script>document.location.href='post.php?id=<?php echo $id_rate ?>';</script>
<?php
  }
?>

<?php
  if(isset($_POST['delete'])){
    $id_rate = $_GET['id'];
    $id_user = $_SESSION['id'];

    $query3 = mysqli_query($conn, "DELETE FROM ratings WHERE id_user = '$id_user' AND id_post = '$id_rate'");

    if($query3){
    ?>
    <script language="javascript">alert("Successfully delete ratings");</script>
    <script>document.location.href='post.php?id=<?php echo $id_rate ?>';</script>
    <?php
    }
  }
 ?>
<div id="editrate" class="w3-modal">
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

<div class="w3-card-2 w3-modal-content w3-margin-bottom w3-animate-zoom" style="max-width:400px">

<?php if($_SESSION['status']!='nouser') {  ?>
          <div class="w3-card-2 w3-container w3-white">
            <ul class="w3-ul w3-white">
          <?php
                $fork = $_SESSION['id'];
                $cekah=0;
                $query = "SELECT * FROM ratings WHERE id_post = '$id_POST' AND id_user ='$fork'";
                $opt  = mysqli_query($conn,$query);
                $udah_rating = mysqli_fetch_assoc($opt);
                if($udah_rating['id_user'] == $_SESSION['id']) {

                $cek = $_SESSION['id'];
                $query = "SELECT * FROM user WHERE id = '$cek'";
                $opt  = mysqli_query($conn,$query);
                $guna = mysqli_fetch_assoc($opt);
          ?>
              <li class="w3-padding-16">
                    <img src="<?php echo $guna['avatar']; ?>" alt="Image" class="w3-card-4 w3-shadow w3-left w3-margin-right" style="width:50px">
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
                      <button onclick="document.getElementById('editrate').style.display='none'" class="w3-teal w3-btn w3-wide"><i class="fa fa-star"></i>Cancel</button>

                </center>

              </li>
        <?php $cekah = 1;
     }
        if($cekah == 1) { ?>
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
                        <input class="w3-blue" name="update" type="submit" value="Update">
                        <input class="w3-red"  name="delete" type="submit" value="Delete">

                  </form>
              </li>

    <?php } ?>
            </ul>
          </div>
<?php } ?>
</div>
</div>
