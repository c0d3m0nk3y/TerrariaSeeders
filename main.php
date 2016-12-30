<?php
	session_start();
	
	// redirect if not logged in
	if(!isset($_SESSION['id'])) {
		header("Location: index.php");
	}

	require 'db.php';

	$records = $db->prepare('SELECT id,username,password,email FROM users WHERE id = :id');
	$records->bindParam(':id', $_SESSION['id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);
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

	<a href="addnote.php">Add A Note</a>
	-
	<a href="logout.php"><?php echo $results['username'] ?> Logout</a>

	<br /><br />

	<div style="overflow-x:auto">
		<table id="seeds">
			<tr>
				<th style='width:20%'>Title</th>
				<th>Seed</th>
				<th style='width:10%'>Tags</th>
				<th style='width:10%'>Date</th>
				<th style='width:5%' />
			</tr>

			<?php
				$seeds = "";
				$sql = 'SELECT * FROM seeds ORDER BY id ASC';
			    foreach ($db->query($sql) as $row) {
			    	$id = $row['id'];
			    	$title = $row['title'];
			    	$seed = substr($row['seed'], 0, 100);
			    	$seed .= " ...";
					$tags = $row['tags'];
					$date = $row['date'];

					$seeds .= "<tr><td>$title</td><td>$seed</td><td>$tags</td><td>$date</td><td><a href='seed.php?id=$id'>Open</td></tr>";
			    }

			    echo $seeds;
			?>
		</table>
	</div>
</body>
</html>
