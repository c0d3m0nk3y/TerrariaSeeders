<?php
	include_once('/config/live-config.php');
	
	$server = 'localhost';
	$username = 'user';
	$password = 'password';
	$database = 'notes';
	
	try {
		$db = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
	} catch(PDOException $e) {
		die("Connection failed: " . $e->getMessage());
	}
?>
