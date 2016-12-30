<?php
	session_start();
	
	// redirect if not logged in
	if(!isset($_SESSION['id'])) {
		header("Location: index.php");
	}

	require 'db.php';
	
	$message = '';

	if(isset($_POST['title']) && isset($_POST['seed']) && $_POST['title'] != "" && $_POST['seed'] != "") {
		$sql = "INSERT INTO seeds (title, note, tags) VALUES (:title, :seed, :tags)";
		$stmt = $db->prepare($sql);
		
		$stmt->bindParam(':title', $_POST['title']);
		$stmt->bindParam(':seed', $_POST['seed']);
		$stmt->bindParam(':tags', $_POST['tags']);
		
		if($stmt->execute()) {
			header("Location: main.php");
		} else {
			$message = 'Something went wrong entering the seed. Sorry about that!';
		}

	} else {
		$message = "Enter Title and Seed.";
	}
?>

<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8">

	<title>Terraria Seeders</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href='https://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>
	
	<!-- Suppress browser request for favicon.ico -->
    <link rel="shortcut icon" type="image/x-icon" href="data:image/x-icon;,">
    <script src="favicon.js"></script>
</head>

<body>
	<div class="header">
		<a href="index.php">Terraria Seeders</a>
	</div>

	<h1>Add A Seed</h1>
	<form action="addnote.php" method="POST">
		<input type="text" name="title" value="" placeholder="Seed Title" />
		<input type="text" name="seed" value="" placeholder="Seed" />
		<input type="text" name="tags" value="" placeholder="Tags" />
		<input type="submit" /><!-- name="submit" value="Submit" /-->
	</form>
	<a href="index.php">Cancel</a>

</body>
</html>