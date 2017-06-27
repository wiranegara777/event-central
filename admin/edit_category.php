<?php include 'header.php'; ?>

<?php
    $id = $_GET['id'];

    //create query
    $query = mysqli_query($conn,"SELECT * FROM categories WHERE id = '$id'");
    //run query

    $category = mysqli_fetch_assoc($query);


?>
<script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<div class="w3-container w3-card-4 w3-padding">
    <h2>Edit Category</h2>
    <div class="formasik">
        <form role="form" method="post" action="edit_category.php">

            <label>Category Name</label>
            <input name="name" type="text" placeholder="Enter Category" value="<?php echo $category['name']; ?>">

          <input name="submit" class="w3-blue" type="submit" value="Update">
          <input class="w3-red" name="delete" type="submit" value="Delete">
        </form>
 </div>

</div>
<?php include 'footer.php'; ?>
