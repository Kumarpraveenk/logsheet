<?php
$servername = "localhost"; // Change to your MySQL server name
$username = "root"; // Change to your MySQL username
$password = ""; // Change to your MySQL password
$dbname = "logdata"; // Change to your MySQL database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data from JavaScript
$data = json_decode(file_get_contents('php://input'), true);

$selectedIssueType = $data['selectedIssueType'];
$enteredDocId = $data['enteredDocId'];
$startTime = $data['startTime'];
$endTime = $data['endTime'];

// Insert log entry into the database
$sql = "INSERT INTO log_entries (issue_type, doc_id, start_time, end_time) 
        VALUES ('$selectedIssueType', '$enteredDocId', '$startTime', '$endTime')";

if ($conn->query($sql) === TRUE) {
    echo "Log entry inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
