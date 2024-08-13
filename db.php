<?php

$servername = "localhost";
$username = "user1";
$password = "userdbserver2025";
$dbname = "internpj";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>