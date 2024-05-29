<?php
/*session_start();

// Connect to the database
$servername = "localhost";
$username = "voting db";
$password = "pami0805";
$dbname = "voting";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the user's ID from the session
$user_id = filter_var($_SESSION['id'], FILTER_SANITIZE_NUMBER_INT);

// Get the candidate the user voted for
$candidate = filter_var($_POST['candidate'], FILTER_SANITIZE_STRING);

// Prepare the statement to update the user's status
$stmt = mysqli_prepare($conn, "UPDATE register SET status = 1 WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);

// Prepare the statement to insert a new row into the voter_results table
$stmt = mysqli_prepare($conn, "INSERT INTO voter_results (username, candidate_a, candidate_b)
SELECT username, IF(id = ?, 1, 0) AS candidate_a, IF(id = ?, 0, 1) AS candidate_b
FROM register");
mysqli_stmt_bind_param($stmt, "ii", $user_id, $user_id);
mysqli_stmt_execute($stmt);

// Close the database connection
mysqli_close($conn);

// Redirect the user back to the dashboard
echo '<script>
    alert("Successfully voted!! You will be redirected to the home page!!")
    window.location="landingpage.html";
</script>';
exit;*/



session_start();

// Connect to the database
$servername = "localhost";
$username = "voting db";
$password = "pami0805";
$dbname = "voting";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Define a secret key for encryption
$secret_key = bin2hex(random_bytes(32));
echo $secret_key;


// Get the user's ID from the session
$user_id = filter_var($_SESSION['id'], FILTER_SANITIZE_NUMBER_INT);

// Get the candidate the user voted for
$candidate = filter_var($_POST['candidate'], FILTER_SANITIZE_STRING);

// Encrypt the vote
function encryptText($text, $key) {
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($text, 'aes-256-cbc', $key, 0, $iv);
    return base64_encode($iv . $encrypted);
}

function decryptText($encryptedText, $key) {
    $data = base64_decode($encryptedText);
    $ivSize = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($data, 0, $ivSize);
    $encrypted = substr($data, $ivSize);
    return openssl_decrypt($encrypted, 'aes-256-cbc', $key, 0, $iv);
}
$candidate_key_a = bin2hex(random_bytes(32));
$candidate_key_b = bin2hex(random_bytes(32));
// Encrypt the vote differently for candidate A and candidate B
if ($candidate == 'A') {
    $candidate_a = encryptText('1', $secret_key);
    $candidate_b = encryptText('0', $secret_key);
} else {
    $candidate_a = encryptText('0', $secret_key);
    $candidate_b = encryptText('1', $secret_key);
}

// Prepare the statement to update the user's status
$stmt = mysqli_prepare($conn, "UPDATE register SET status = 1 WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);

// Prepare the statement to insert a new row into the voter_results table
$stmt = mysqli_prepare($conn, "INSERT INTO voter_results (username, candidate_a, candidate_b)
SELECT username, ?, ?
FROM register WHERE id = ?");
mysqli_stmt_bind_param($stmt, "ssi", $candidate_a, $candidate_b, $user_id);
mysqli_stmt_execute($stmt);

// Close the database connection
mysqli_close($conn);

// Redirect the user back to the dashboard
echo '<script>
    alert("Successfully voted!! You will be redirected to the home page!!")
    window.location="landingpage.html";
</script>';
exit;

?>