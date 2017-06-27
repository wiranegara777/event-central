<?php include 'config/config.php'; ?>
<?php include 'helpers/format_helpers.php'; ?>
<?php include 'libraries/dbasepost.php';?>
<!DOCTYPE html>
<html>
<title>Event Central</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
  <script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Damion" rel="stylesheet">
<link rel="stylesheet" href="css/font.css">
<link rel="stylesheet" href="admin/kampret.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">

<!-- w3-content defines a container for fixed size centered content,
and is wrapped around the whole page content, except for the footer in this example -->
<div class="w3-content" style="max-width:1400px">

  <div class="w3-bar w3-blue w3-card-8">
          <span class="w3-bar-item" style="font-family:'Damion'; font-size:18px">Event Central</span>
          <a href="index.php" class="w3-bar-item w3-button w3-hover-teal"><i class="fa fa-home"></i></a>
          <a href="#" class="w3-bar-item w3-button w3-right w3-hover-teal" style="font-size:17px" id="roboto"><i class="w3-large fa fa-address-book-o"></i> Register</a>
          <a href="#" class="w3-bar-item w3-button w3-right w3-hover-teal" style="font-size:17px" id="roboto"><i class="w3-large fa fa-sign-in"></i> Log In</a>
  </div>
