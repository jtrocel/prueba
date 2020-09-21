<?php
$server   = 'localhost';
$username = 'andres';
$password = '12345678';
$database = 'logi_database';
$port = '3306';
$BD_OPTIONS = [
	PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
	PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
];

try {
	$conn = new PDO("mysql:host=$server;dbname=$database;charset=utf8;port=$port", $username, $password, $BD_OPTIONS);
} catch (PDOException $e) {
	die("Connection failed: ".$e->getMessage());
}

?>