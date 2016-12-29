<?php
	session_start();

	if(isset($_SESSION['id'])) {
		header("Location: notes.php");
	}
	
	require 'db.php';

	if(!empty($_POST['username']) && !empty($_POST['password'])) {
		$records = $db->prepare('SELECT id,username,password,email FROM users WHERE username = :username');
		$records->bindParam(':username', $_POST['username']);
		$records->execute();
		$results = $records->fetch(PDO::FETCH_ASSOC);
		
		$message = '';

		if(count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
			$_SESSION['id'] = $results['id'];
			header("Location: notes.php");
		} else {
			$message = "Something went wrong logging in.  Sorry about that!";
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
	<title>Login to Notes</title>
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

	<?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?>
	
	<h1>Login</h1>
	<span>or <a href="register.php">register here</a></span>
	
	<form action="login.php" method="POST">
		<input type="text" placeholder="Enter your username" name="username">
		<input type="password" placeholder="and password" name="password">
		<input type="submit">
	</form>
</body>
</html>
