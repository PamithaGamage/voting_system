<?php
// Connect to the database
$servername = "localhost";
$username = "voting db";
$password = "pami0805";
$dbname = "voting";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT candidate_a, candidate_b FROM voter_results";
$result = $conn->query($sql);

$candidate_a_votes = 0;
$candidate_b_votes = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $candidate_a_votes += $row["candidate_a"];
        $candidate_b_votes += $row["candidate_b"];
    }
}


$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting System Result</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="Result.css">
</head>

<body>

    <div class="header">
        <h1>Voting System Result</h1>
    </div>

    <div class="container">
        <table class="result-table">
            <caption>Results</caption>
            <tr>
                <th>Name</th>
                <th>Votes</th>
            </tr>
            <tr>
                <td>jabba</td>
                <td>
                    <?php echo $candidate_a_votes; ?>
                </td>
            </tr>
            <tr>
                <td>balla</td>
                <td>
                    <?php echo $candidate_b_votes; ?>
                </td>
            </tr>
        </table>

        <div class="winner">
            <h2>Winner: Candidate 3</h2>
        </div>


        <center>
            <caption><b>Encrypted Results Table</b></caption>
        </center>
        <img src="r.jpg" alt="Encrypted Results" width="250">





    </div>

    <div class="footer">
        <p><a href="voterdashboard.php">Go Back</a></p>
    </div>

</body>

</html>