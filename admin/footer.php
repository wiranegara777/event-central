<div class="w3-container w3-teal w3-card-8">
  <h5 class="w3-center" id="roboto">- More Content Coming Soon! -</h5>
</div>
<!-- Footer -->
<footer class="w3-container w3-padding-32 w3-center w3-opacity w3-light-grey w3-xlarge">
        <i class="fa fa-facebook-official w3-hover-text-indigo"></i>
        <i class="fa fa-instagram w3-hover-text-purple"></i>
        <i class="fa fa-snapchat w3-hover-text-yellow"></i>
        <i class="fa fa-pinterest-p w3-hover-text-red"></i>
        <i class="fa fa-twitter w3-hover-text-light-blue"></i>
        <i class="fa fa-linkedin w3-hover-text-indigo"></i>
        <p id="roboto" class="w3-medium">Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank" style="text-decoration:none">Muhammad Wiranegara Girinata</a></p>
</footer>

<!-- End page content -->
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
      mySidebar.style.display = 'none';
      overlayBg.style.display = "none";
  } else {
      mySidebar.style.display = 'block';
      overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>

</body>
</html>
