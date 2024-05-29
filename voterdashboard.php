<?php

session_start();
//check if the user logged in
if (!isset($_SESSION['id']) || $_SESSION['id'] == '') {
    // User is not logged in, redirect to the login page
    header("Location: loginpage.html");
    exit;
}
$data = $_SESSION['data'];
if ($_SESSION['status'] == 1) {
    $status = '<span class="text-success">Voted</span>';
} else {
    $status = '<span class="text-danger">Not Voted</span>';
}


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

// Retrieve all candidates from the database
$stmt = $conn->prepare("SELECT candidate_id, full_name FROM candidates");
$stmt->execute();
$result = $stmt->get_result();

$candidates = [];
while ($row = $result->fetch_assoc()) {
    $candidates[] = $row;
}
$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voter Dashboard</title>
    <link rel="stylesheet" href="voters_dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>

    <div class="container">
        <div class="header">
            <div class="heading-box">
                <h1 class="heading">Voter Dashboard</h1>
            </div>
        </div>

        <div class="voter-details">
            <h2>Voter Details</h2>

            <table class="voter-table">
                <tr>
                    <th>Name</th>
                    <td id="voterName"><?php echo $data['username']; ?></td>

                </tr>
                <tr>
                    <th>Phone</th>
                    <td id="voterPhone"> <?php echo $data['phone_number']; ?></td>
                </tr>
                <tr>
                    <th>Date of Birth</th>
                    <td id="voterDOB"><?php echo $data['dob']; ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td id="voterStatus"><?php echo $status; ?></td>
                </tr>
            </table>
        </div>

        <div class="candidate-details">
            <h2>Candidates</h2>
            <form action="voting.php" method="post">
                <table class="candidate-table">
                    <tr>
                        <th></th>
                        <th>Candidate Name</th>
                    </tr>
                    <?php foreach ($candidates as $candidate) : ?>
                        <tr>
                            <td><input type="radio" name="candidate" value="<?php echo $candidate['candidate_id']; ?>"></td>
                            <td><?php echo $candidate['full_name']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="2"><button type="submit" id="vote-button" class="green-button">Vote</button></td>
                    </tr>
                </table>
            </form>
            <div class="actions">
                <a href="count_results.php" class="green-button">View Results</a>
                <a href="loginpage.html"><button class="green-button">Back</button></a>
                <a href="landingpage.html"><button class="green-button">Logout</button></a>
            </div>
        </div>

    </div>

    <script src="voters_dashboard.js"></script>
    <script>
        // Remove vote button if voter has already voted
        const voterStatusElement = document.getElementById("voterStatus");
        if (voterStatusElement) {
            if (voterStatusElement.textContent.trim() === "Voted") {
                const voteButton = document.getElementById("vote-button");
                if (voteButton) {
                    voteButton.disabled = true;
                    voteButton.style.opacity = 0.5;
                }
            }
        }
    </script>
    <script>
        // Store the dashboard type in local storage
        localStorage.setItem('dashboardType', 'voter');
    </script>
</body>

</html>