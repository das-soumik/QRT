<?php
$host = getenv("HOST");
$user = getenv("USER");  // default for XAMPP
$pass = getenv("DB_PASSWORD");      // default is blank
$dbname = getenv("DB");
$port = getenv("DB_PORT");

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
