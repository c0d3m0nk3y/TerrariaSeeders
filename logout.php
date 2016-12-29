<?php
	session_start();
	session_unset();
	session_destroy();

	header("Location: index.php");
?>

<!--
<!DOCTYPE html>
<html>
<head>
	<title>- Logout -</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href='https://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="header">
		<a href="index.php">Notes</a>
	</div>
	
	<h1>You have logged out...</h1>
	<meta http-equiv="refresh" content="3;url=index.php" />
</body>
</html>
-->