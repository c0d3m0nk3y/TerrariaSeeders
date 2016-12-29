<?php
	session_start();
	
	// redirect if not logged in
	if(!isset($_SESSION['id'])) {
		header("Location: index.php");
	}

	require 'db.php';
	
	$message = '';

	if(isset($_POST['title']) && isset($_POST['note']) && $_POST['title'] != "" && $_POST['note'] != "") {
		$sql = "INSERT INTO notes (title, note, tags) VALUES (:title, :note, :tags)";
		$stmt = $db->prepare($sql);
		
		$stmt->bindParam(':title', $_POST['title']);
		$stmt->bindParam(':note', $_POST['note']);
		$stmt->bindParam(':tags', $_POST['tags']);
		
		if($stmt->execute()) {
			header("Location: notes.php");
		} else {
			$message = 'Something went wrong entering the note. Sorry about that!';
		}

	} else {
		$message = "Enter Title and Note.";
	}
?>

<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8">

	<title>Add a Note</title>
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

	<h1>Add A Note</h1>
	<form action="addnote.php" method="POST">
		<input type="text" name="title" value="" placeholder="Note Title" />
		<input type="text" name="note" value="" placeholder="Note" />
		<input type="text" name="tags" value="" placeholder="Tags" />
		<input type="submit" /><!-- name="submit" value="Submit" /-->
	</form>
	<a href="index.php">Cancel</a>

</body>
</html>