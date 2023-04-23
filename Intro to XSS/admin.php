<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="utf-8">
  <title>Basic XSS examples | Admin</title> 
 </head>
  <body>
  <font size="1"><a href="xss.php"><b><u>GO BACK TO MAIN PAGE</u></b></a></font>
    <center><h1><u>Basic backend admin panel (staff only):</u></h1></center>
  
    <?php
	error_reporting(0);
    $admin = "<hr><h3>Administrative Staff Panel:</h3>";
    echo $admin;
    echo "<hr>";
    echo "<br />";
	echo "<p>Recent user reviews:</p><br />";
    session_start();
    echo $_SESSION['reviewz'];
    ?>
  
   	<br /><br /><br />
   	<hr>
	<h3>Basic DOM XSS example scenario:</h3>
	<hr><br />
	<p>For a quick example of DOM-Based XSS, we will demonstrate it via an open redirect. This website has some redirection functionality where you can input the URL you want to redirect to via '?redir' GET param.</p>
	
	<?php
	$url = $_GET['redir'];
	if (isset($url)) {
		echo "<script>window.location.href = '" . $url . "';</script>";
	}
	?>
	
	<br /><br /><br />
	<hr>
	<h3>DOM XSS example scenario #2:</h3>
	<hr><br />
	<a id="a" href>DOM XSS Example #2</a>
	<br />
	<p>Use the '#url=' fragment to build an <a> tag in DOM</p>
	
	<script>
	function getHashes() {
		aURL = window.location.href;
		var vars = {};
		var hashes = aURL.slice(aURL.indexOf('#') + 1).split('&');
		for(var i = 0; i < hashes.length; i++) {
			var hash = hashes[i].split('=');
				if(hash.length > 1) {
					vars[hash[0]] = hash[1];
				}else{
					vars[hash[0]] = null;
				}
			}
		return vars;
	}

	var hashes = getHashes(), redirect;
	if(hashes["url"]) {
		redirect = hashes["url"];
		document.getElementById('a').setAttribute("href",redirect)
	}
	</script>
	
	<br /><br /><br />
   	<hr>
	<h3>Execute system commands as admin (XSS->RCE Example):</h3>
	<hr><br />
	As a system administrator, you have the ability to execute system commands via the admin panel.
	<br /><font size='1'>* You can use this functionality to practice an XSS->RCE scenario by using the BlindXSS to trigger a payload that hijacks the admin's browser and uses it to execute system commands on your behalf.</font>
	<br /><br />
	To execute system commands, you can pass the command via the '?cmd' HTTP GET parameter.<br />
	The result of the command you executed will be outputted below:
	
	<?php
	$cmd = $_GET['cmd'];
	$result = exec($cmd);
	if (isset($cmd)) {
		echo "<br /><br />";
		echo "<font color='green'><b>";
		echo $result;
		echo "</b></font>";
		}
	?>
	
	<hr>
  </body>
</html>
