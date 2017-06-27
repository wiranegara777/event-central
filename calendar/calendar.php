<link rel="stylesheet" href="calendar/calendar.css">

<?php
$monthNames = Array("January", "February", "March", "April", "May", "June", "July",
"August", "September", "October", "November", "December");
?>

<?php
if (!isset($_REQUEST["month"])) $_REQUEST["month"] = date("n");
if (!isset($_REQUEST["year"]))  $_REQUEST["year"] = date("Y");
?>

<?php
$cMonth = $_REQUEST["month"];
$cYear = $_REQUEST["year"];

$prev_year = $cYear;
$next_year = $cYear;
$prev_month = $cMonth-1;
$next_month = $cMonth+1;

if ($prev_month == 0 ) {
    $prev_month = 12;
    $prev_year = $cYear - 1;
}
if ($next_month == 13 ) {
    $next_month = 1;
    $next_year = $cYear + 1;
}
?>



<?php
$timestamp = mktime(0,0,0,$cMonth,1,$cYear);
$maxday    = date("t",$timestamp);
$thismonth = getdate ($timestamp);
$startday  = $thismonth['wday'];

?>



<body>


<div class="month">
  <ul>
    <a href="<?php echo $_SERVER["PHP_SELF"] . "?month=". $prev_month . "&year=" . $prev_year; ?>"><li class="prev">&#10094;</li></a>
    <a href="<?php echo $_SERVER["PHP_SELF"] . "?month=". $next_month . "&year=" . $next_year; ?>"><li class="next">&#10095;</li></a>
    <li style="text-align:center">
      <?php echo $monthNames[$cMonth-1]; ?><br>
      <span style="font-size:18px"><?php echo $cYear; ?></span>
    </li>
  </ul>
</div>

<ul class="weekdays">
  <li class="w3-red">Sun</li>
  <li>Mon</li>
  <li>Tue</li>
  <li>Wed</li>
  <li>Thu</li>
  <li>Fri</li>
  <li>Sat</li>
</ul>

<ul class="days">

  <?php
          $cek=0;
        for ($i=0; $i<($maxday+$startday); $i++) {
          $cek = ($i - $startday + 1);
          if($cek <= 0) { ?>
            <li class="jalang"></li>
          <?php }

      else {  $chek = 0;
              $qty = "SELECT * FROM post WHERE tanggal='$cek' AND bulan='$cMonth' AND tahun='$cYear'";
              $query = mysqli_query($conn,$qty);
               if(mysqli_fetch_assoc($query)){$chek = 1;}
              if($chek == 1){
                ?>
                <li style="font-size:14px;" class="w3-blue jalang"><?php echo $cek; ?></li>
            <?php } else { ?>
               <li style="font-size:14px;" class="jalang"><?php echo $cek; ?></li>
    <?php     }
          }
      }
   ?>

</ul>

<div class="w3-blue w3-card-4 w3-container w3-padding">
  <h4>Event This Month</h4>
</div>
<ul class="w3-ul w3-hoverable w3-white">
  <?php
  $bulan = $cMonth;
  $query = "SELECT * FROM post WHERE bulan='$bulan' AND tahun = '$cYear' ORDER BY tanggal ASC";
  $query2 = "SELECT * FROM post WHERE bulan='$bulan' AND tahun = '$cYear' ORDER BY tanggal ASC";
  $fulus = mysqli_query($conn,$query2);
  //run query
  // $newevent = $db->select($query);   //newevnt

  $newevent2 = mysqli_query($conn,$query); ?>
  <?php if(mysqli_fetch_assoc($fulus)) { ?>
    <div style="height: 120px; overflow: auto;">
      <?php while($row = mysqli_fetch_assoc($newevent2) ) { ?>
        <a style="text-decoration:none;" href="post.php?id=<?php echo urlencode($row['id']); ?>">
  <li class="w3-hover-blue w3-padding-16">
        <img src="<?php echo $row['image']; ?>" alt="Image" class="w3-card-4 w3-left w3-margin-right" style="width:50px">  <p style="font-size:11px" class="w3-right"><?php echo $row['tanggal']; echo ' '; echo $monthNames[$cMonth-1]; echo ' '; echo $cYear; ?></p>
        <span><?php echo $row['title']; ?> </span><br>
  </li>
  <div class="w3-container w3-light-grey" style="height:1px;">
  </div>
      </a>
  <?php } ?>
</div>
  <?php } else { ?>
      <li class="w3-hover-blue w3-padding-16">There are no event this month</li>
  <?php } ?>

</ul>
</body>
