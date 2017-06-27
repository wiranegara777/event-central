<!DOCTYPE HTML>
<html>
<style>
/*--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
--*/
/* reset */
html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,dl,dt,dd,ol,nav ul,nav li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline;}
article, aside, details, figcaption, figure,footer, header, hgroup, menu, nav, section {display: block;}
ol,ul{list-style:none;margin:0px;padding:0px;}
blockquote,q{quotes:none;}
blockquote:before,blockquote:after,q:before,q:after{content:'';content:none;}
table{border-collapse:collapse;border-spacing:0;}
/* start editing from here */
a{text-decoration:none;}
.txt-rt{text-align:right;}/* text align right */
.txt-lt{text-align:left;}/* text align left */
.txt-center{text-align:center;}/* text align center */
.float-rt{float:right;}/* float right */
.float-lt{float:left;}/* float left */
.clear{clear:both;}/* clear float */
.pos-relative{position:relative;}/* Position Relative */
.pos-absolute{position:absolute;}/* Position Absolute */
.vertical-base{	vertical-align:baseline;}/* vertical align baseline */
.vertical-top{	vertical-align:top;}/* vertical align top */
nav.vertical ul li{	display:block;}/* vertical menu */
nav.horizontal ul li{	display: inline-block;}/* horizontal menu */
img{max-width:100%;}
/*end reset*/
body {
	background:url('bg2.jpg') no-repeat 62% 90%;
	background-size: cover;
	text-align: center;
font-family: 'Open Sans', sans-serif;
}

/*--header--*/

.header-w3l{
	margin: 75px;
}
.header-w3l h1{
font-size:3em;
	color:white;
	letter-spacing: 6px;
	font-weight: 300;
	font-family: 'Open Sans', sans-serif;
	text-transform: uppercase;
}
/*--//header--*/

/*--main--*/

.main-content-agile {
	margin: 145px 0px;
}
.sub-main-w3 input[type="text"],.sub-main-w3 input[type="password"] {
	outline: none;
	font-size: 1.1em;
	padding: 20px 10px 20px 10px;
	border: none;
	margin: 0 0 15px 0;
	font-family: 'Open Sans', sans-serif;
	background: none;
	border-bottom: 2px solid #eee;
	width: 20%;
	color: white;
	font-weight: 600;
}
.sub-main-w3 input[type="submit"] {
background: url('arrow.png') no-repeat 30% 45%;
	height: 67px;
	outline: none;
	margin-top: 38px;
	border-radius: 50%;
	cursor: pointer;
	border: 2px solid #fff;
	width: 67px;
}
/*--//main--*/

/*--footer--*/
.footer {
	padding: 2.3em 0;
}
.footer p {
	font-size: .9em;
	color: white;
}
.footer p a {
	color: #d20962;
}
.footer p a:hover {
 text-decoration:underline;
}
/*--//footer--*/

/*--placeholder-color--*/

::-webkit-input-placeholder{
color:rgba(255, 255, 255, 0.65);
}

:-moz-placeholder { /* Firefox 18- */
 color: rgba(255, 255, 255, 0.65);
}

::-moz-placeholder {  /* Firefox 19+ */
 color: rgba(255, 255, 255, 0.65);
}

:-ms-input-placeholder {
 color: rgba(255, 255, 255, 0.65);
}
/*--//placeholder-color--*/

/*--responsive--*/

@media(max-width:1440px){

}
@media (max-width:1366px){
.sub-main-w3 input[type="password"],.sub-main-w3 input[type="text"]{
	width:22%;
}
}
@media (max-width:1280px){
.sub-main-w3 input[type="password"],.sub-main-w3 input[type="text"] {
	width:23%;
}
}
@media (max-width:1024px){
.sub-main-w3 input[type="password"],.sub-main-w3 input[type="text"]{
	width:28%;
}
}
@media (max-width:991px){
.sub-main-w3 input[type="password"],.sub-main-w3 input[type="text"] {
	width:29%;
}
}
@media(max-width:800px){
.header-w3l h1 {
	font-size: 39px;
}
.sub-main-w3 input[type="password"],.sub-main-w3 input[type="text"] {
	width:34%;
}
}
@media(max-width:768px){
.header-w3l h1 {
	font-size: 36px;
}
.main-content-agile {
	margin: 226px 0px;
}
.sub-main-w3 input[type="password"],.sub-main-w3 input[type="text"] {
	width:36%;
}
}
@media(max-width:736px){
.header-w3l h1 {
	font-size: 34px;
}
.sub-main-w3 input[type="password"],.sub-main-w3 input[type="text"] {
	width:40%;
	font-size: 0.9em;
}
.main-content-agile {
	margin: 181px 0px;
}
}
@media(max-width:667px){
.header-w3l h1 {
	font-size: 28px;
}
.main-content-agile {
	margin: 124px 0px;
}
.header-w3l{
	margin: 38px;
}
}
@media(max-width:640px){
.header-w3l h1 {
	font-size: 26px;
}
.sub-main-w3 input[type="password"],.sub-main-w3 input[type="text"] {
	width:42%;
	font-size: 0.9em;
}
}
@media(max-width:600px){
.header-w3l h1 {
	font-size: 27px;
}
.sub-main-w3 input[type="password"],.sub-main-w3 input[type="text"] {
	width:46%;
	font-size: 0.9em;
}
.header-w3l {
	margin: 52px;
}
}
@media(max-width:568px){
.header-w3l h1 {
	font-size: 30px;
}
.sub-main-w3 input[type="password"],.sub-main-w3 input[type="text"] {
	width:48%;
	font-size: 0.9em;
}
.header-w3l {
	margin: 24px 0px;
}
}
@media(max-width:480px){
.header-w3l{
	margin:48px 0px;
}
.header-w3l h1 {
	font-size: 21px;
	letter-spacing: 3px;
	font-weight: 400;
	line-height: 0.7em;
}
.sub-main-w3 input[type="password"],.sub-main-w3 input[type="text"] {
	width:56%;
	font-size: 0.9em;
}
.footer p{
	line-height: 28px;
}
}
@media(max-width:414px){
.header-w3l h1 {
	font-size: 28px;
	line-height: 0.7em;
	letter-spacing: 1px;
}
.main-content-agile {
	margin: 84px 0px;
}
.sub-main-w3 input[type="password"],.sub-main-w3 input[type="text"] {
	width:60%;
	font-size: 0.9em;
}
.footer p{
	line-height: 28px;
}
.footer {
	padding: 4.3em 0;
}
}
@media(max-width:384px){
.header-w3l h1 {
	font-size: 24px;
}
.sub-main-w3 input[type="password"],.sub-main-w3 input[type="text"] {
	width:64%;
	font-size: 0.9em;
}
.footer p{
	line-height: 28px;
}
}
@media(max-width:375px){
.footer p{
	line-height: 28px;
}
.sub-main-w3 input[type="password"],.sub-main-w3 input[type="text"] {
	width:68%;
	font-size: 0.9em;
}
.footer {
	padding: 3em 0 1em;
}
}
@media(max-width:320px){
.header-w3l {
	margin: 31px 0px;
}
.header-w3l h1 {
	font-size: 18px;
	font-weight: 500;
	letter-spacing: 3px;
	line-height: 1.7em;
}
.sub-main-w3 input[type="password"],.sub-main-w3 input[type="text"] {
	width:68%;
	font-size: 0.9em;
}
.footer p{
	line-height: 28px;
	font-size: 0.9em;
}
.main-content-agile {
	margin: 55px 0px;
}
 .footer {
	padding: 0em 0 1.1em;
}
}
/*--//responsive--*/

</style>
<?php
		$conn = mysqli_connect('localhost', 'root', '', 'event')
		or die ("Connection Failed".mysqli_error());

		$query="SELECT * FROM otoritas";
	  $level =  mysqli_query($conn,$query);
 ?>
<head>
<title>Register | Event Central</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Transparent Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
<!--web-fonts-->
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css' />
<!--web-fonts-->
</head>

<body>
<!--header-->
	<div class="header-w3l">
		<h1> Event Central Register</h1>
	</div>
<!--//header-->

<!--main-->
<div class="main-content-agile">
	<div class="sub-main-w3">
		<form action="../modules/registerprocess.php" method="post">
			<input placeholder="Name" name="nama" class="user" type="text" required></br>
			<input placeholder="Username or E-mail" name="email" class="user" type="text" required=""><br>
			<input  placeholder="Password" name="password" class="pass" type="password" required=""><br>
			<select class="user" name="otoritas">
				<?php while( $row = mysqli_fetch_assoc($level)) : ?>
					<option value="<?php echo $row['id']; ?>"><?php echo $row['level']; ?></option>
				<?php endwhile; ?>
			</select></br>
			<input type="submit" value="">
		</form>
	</div>
</div>
<!--//main-->

<!--footer-->
<div class="footer">
	<p>&copy; 2017 All rights reserved | Design by <a href="google.com">Wiranegara</a></p>
</div>
<!--//footer-->

</body>
</html>
