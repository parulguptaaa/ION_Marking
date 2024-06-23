<?php
header('Content-Type: application/json');

// Start the session to access session variables
session_start();

// Turn off error reporting
error_reporting(0);
include 'connect.php';

// Check if username is set in session
if(!isset($_SESSION['username'])){
    header("location: index.php");
    exit(); // Ensure no further code is executed
}

$username = $_SESSION['username']; // Retrieve the username from session
$esql = "SELECT * FROM emp_id WHERE username='$username'";
$eresult = mysqli_query($conn, $esql); // Use $conn instead of $data if $data is not defined
$erow = mysqli_fetch_array($eresult);
$user_id = $erow['id'];

// Determine which type of names to fetch
$groupId = isset($_GET['groupId']) ? $_GET['groupId'] : '';

// Initialize the names array
$names = array();
$sql = "SELECT emp_id, adgh_id, display_name FROM adgh WHERE group_id = '$groupId'";

// Execute the query
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        // Fetch each row as an associative array
        while ($row = $result->fetch_assoc()) {
            if ($row['emp_id'] != $user_id) {
                $names[] = ['id' => $row['emp_id'], 'adgh_id' => $row['adgh_id'], 'name' => $row['display_name']];
            }
        }
    } else {
        echo json_encode(['error' => 'No names found']);
        exit();
    }
    $result->free();
} else {
    echo json_encode(['error' => 'Error executing query: ' . $conn->error]);
    exit();
}

$conn->close();

echo json_encode($names);
?>


