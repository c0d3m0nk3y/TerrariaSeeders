<?php
	session_start();
	
	if(isset($_SESSION['id'])) {
		header("Location: notes.php");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Notes</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href='https://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>
	
	<!-- Suppress browser request for favicon.ico -->
    <link rel="shortcut icon" type="image/x-icon" href="data:image/x-icon;,">
    <script src="favicon.js"></script>
</head>

<body>
	<div class="header">
		<a href="index.php">Notes</a>
	</div>
	
	<h1>Please Login or Register</h1>
	<a href="login.php">Login</a> or
	<a href="register.php">Register</a>

</body>
</html>
