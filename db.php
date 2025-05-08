<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "xpoemployees";

// Krijo koneksionin
$conn = new mysqli($servername, $username, $password, $dbname);

// Kontrollo lidhjen
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
