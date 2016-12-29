<?php
	session_start();
	include("db.php");
	
	// If we land on the page with no query, go to index.php
	if(!isset($_GET['id'])) {
		header("Location: index.php");
	} else {
		$id = $_GET['id'];
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Note</title>
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
	
	<?php
		$records = $db->prepare('SELECT * FROM notes WHERE id = :id');
		$records->bindParam(':id', $id);
		$records->execute();
		$results = $records->fetch(PDO::FETCH_ASSOC);
		
		$message = '';

		if(count($results) > 0) {
			$title = $results['title'];
			$note = $results['note'];
			$tags = $results['tags'];
			$date = $results['date'];

			echo "<p><b>$title</b></p><p>$note</p><p><i>$tags</i></p><p>$date</p>";
		} else {
			$message = "Something went wrong getting this note.  Sorry about that!";
		}
	?>

</body>
</html>
