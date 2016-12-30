<?php
	require_once('config/live-config.php');

	$server = DB_HOST;
	$username = DB_USER;
	$password = DB_PASS;
	$database = DB_NAME;
	
	try {
		$db = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
	} catch(PDOException $e) {
		die("Connection failed: " . $e->getMessage());
	}
?>
