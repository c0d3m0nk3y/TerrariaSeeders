<?php
	// TODO:
	//		Check passwords match
	//		Check valid email
	//		Validate all required
	//		check user/email doesn't exist
	session_start();

	// redirect if logged in
	if(isset($_SESSION['id'])) {
		header("Location: notes.php");
	}

	require 'db.php';
	
	$message = '';

	if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])) {
		$sql = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
		$stmt = $db->prepare($sql);
		
		$stmt->bindParam(':username', $_POST['username']);
		$stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_DEFAULT));
		$stmt->bindParam(':email', $_POST['email']);
		
		if($stmt->execute()) {
			header("Location: login.php");
		} else {
			$message = 'Something went wrong registering. Sorry about that!';
		}
	}

?>

<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8">
	
	<title>Register for notes</title>
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
	
	<h1>Register</h1>
	<span>or <a href="login.php">login here</a></span>
	
	<form action="register.php" method="POST">
		<input type="text" placeholder="Enter your username" name="username">
		<input type="text" placeholder="your email" name="email">
		<input type="password" placeholder="and password" name="password">
		<input type="password" placeholder="confirm password" name="confirm_password">
		<input type="submit">
	</form>
	
</body>
</html>
