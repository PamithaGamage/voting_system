<?php
// deleteElection.php

// Database connection parameters
$servername = "localhost";
$username = "voting db";
$password = "pami0805";
$dbname = "voting";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to drop the voter_results table if it exists
$sqlDrop = "DROP TABLE IF EXISTS voter_results";

if ($conn->query($sqlDrop) === TRUE) {
    // SQL to create the voter_results table with the new structure
    $sqlCreate = "CREATE TABLE voter_results (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        candidate_a INT DEFAULT 0,
        candidate_b INT DEFAULT 0
    )";

    if ($conn->query($sqlCreate) === TRUE) {
        echo "Table voter_results cleared and recreated successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
} else {
    echo "Error dropping table: " . $conn->error;
}

$conn->close();
?>
