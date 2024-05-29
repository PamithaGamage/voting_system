<?php

// Connect to the database
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

//include('main_connect.php');

// Get data from html form
$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirmPassword'];
$dob = $_POST['dob'];
$phone_number = $_POST['phone_num'];

// Validate passwords
if ($password !== $confirm_password) {
    /*echo "Passwords do not match.";
    exit();*/
    echo '<script>
    window.location="signuppage.html";
    </script>';
} else {
    // Hash password
    //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into database
    $sql = "INSERT INTO register (username, password, dob, phone_number) VALUES ('$username', '$password', '$dob', '$phone_number')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<script>
        alert("registration successful")
    window.location="loginpage.html";
    </script>';
    }
}


