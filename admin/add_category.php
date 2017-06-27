<?php include 'header.php'; ?>
<?php
$conn = mysqli_connect('localhost', 'root', '', 'event')
or die ("Connection Failed".mysqli_error());
?>
<?php

    if(isset($_POST['submit'])){
      //assigns Var
      $name = $_POST['name'];
      //Simple validation
      if($name == ''){
          //set error
          $error = 'Isi semua atribut!';
          echo $error;
      }else {
          $query = mysqli_query($conn,"INSERT INTO categories
                      (name)
                        VALUES('$name')");
     ?>
     <script language="javascript">alert("Added Categories");</script>
     <script>document.location.href='index.php';</script>
      <?php

      }
    }
?>
<script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<div class="w3-container w3-card-4 w3-padding">
    <h2>Add Category</h2>
    <div class="formasik">
        <form role="form" method="post" action="add_category.php">

            <label>Category Name</label>
            <input name="name" type="text" placeholder="Enter Category">

          <input name="submit" class="w3-blue" type="submit" value="Submit">
        </form>
 </div>

</div>
<?php include 'footer.php'; ?>
