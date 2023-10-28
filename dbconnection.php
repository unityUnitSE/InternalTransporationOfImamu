<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "imamubuss";

// generate a secure password, set it to the username database, and store it in a environment variable for instance
$password = getenv('MYSQL_SECURE_PASSWORD');
// Create connection
$connection  = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection ->connect_error) {
    die("Connection failed: " . $connection ->connect_error);
}
?>
