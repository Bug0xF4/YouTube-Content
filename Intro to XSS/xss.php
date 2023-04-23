<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="utf-8">
  <title>Basic XSS examples</title> 
 </head>
  <body>
  <font size="1"><a href="admin.php"><b><u>NAVIGATE TO ADMIN PANEL</u></b></a></font>
  <center><h1><u>Basic frontend user interface (public facing):</u></h1></center>
  
	<?php
	session_start();
	error_reporting(0);
	$text_intro = "Welcome user, what is your name?\n";
	$name = $_GET['name'];
	$text_greeting = "nice to meet you " . $name . " - welcome to the site";
	echo "<hr><h3>Basic GET-Based Reflective XSS example scenario:</h3><hr><br />";
	echo $text_intro;
	echo "<br />";	
	if (isset($name)) {
		echo $text_greeting;
		echo "<br />";
	}
	else if (!isset($name)) {
		echo "Please input your name via the '?name' GET parameter";
		echo "<br />";
	}
	else {
		echo "error!";
		echo "<br />";
	}
	?>
	
	<br /><br /><br /><hr><h3>Basic POST-Based Reflective XSS example scenario:</h3><hr><br />
	
	<?php
	$text_review = "Please input your address via the form below:*\n";
	echo $text_review;
	echo "<br /><font size='1'>*your address will be saved to this page for us to review</font>";
	?>	
	
    <br />
    <form action="xss.php" method="post">
    <input type="text" name="address">
    <input type="submit">
    </form>
	
    <?php
    if (isset($_POST['address'])) {
		echo "Your address is: ";
		echo $_POST['address'];
    }
		?>
		
	<br /><br /><br /><hr><h3>Basic Stored XSS example scenario:</h3><hr>
	<br />
	<form action="xss.php" method="post">
    Update your profile description via this form: <input type="text" name="profile">
    <input type="submit">
    </form>
	<br />
	
	<?php
	echo "Your user profile description:";
	if (isset($_POST['profile'])) {
		$_SESSION['user_profile'] = $_POST['profile'];
		echo "<br />";
	}
	echo $_SESSION['user_profile'];
	?>
		
   	<br /><br /><br /><hr><h3>Basic Blind XSS example scenario:</h3><hr><br />
	<p>Leave a review via the form below. An admin will then be able to read your review from within the admin panel.</p>
    <form action="xss.php" method="post">
     Please submit your review here: <input type="text" name="review">
    <input type="submit">
    </form>
	
	
	<?php
	if (isset($_POST['review'])) {
	$_SESSION['reviewz'] = $_POST['review'];
	}
	?>
	
  </body>
</html>
