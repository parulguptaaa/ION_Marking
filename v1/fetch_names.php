<?php
header('Content-Type: application/json');

// Start output buffering
ob_start();

// Start the session to access session variables
session_start();

// Turn off error reporting
error_reporting(0);
include 'connect.php';

// Determine which type of names to fetch
$type = isset($_GET['type']) ? $_GET['type'] : '';
if(!isset($username)){
    header("location: index.php");
    exit(); // Ensure no further code is executed
}
// Retrieve group_id from session
$group_id = isset($_SESSION['group_id']) ? $_SESSION['group_id'] : '';

// Initialize the names array
$names = array();

// Set the appropriate SQL query based on the type
if ($type == 'AD'&& !empty($group_id)) {
    $sql = "SELECT emp_id,adgh_id, display_name FROM adgh WHERE group_id = '$group_id'";
} elseif ($type == 'EMPLOYEES' && !empty($group_id)) {
    $sql = "SELECT emp_id, username AS display_name FROM emp_id WHERE group_id = '$group_id'";
} else {
    echo json_encode(['error' => 'Invalid type or group ID specified']);
    ob_end_clean();
    exit();
}

// Execute the query
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        // Fetch each row as an associative array
        while ($row = $result->fetch_assoc()) {
            $names[] = ['id' => $row['emp_id'], 'adgh_id'=>$row['adgh_id'],'name' => $row['display_name']];
        }
    } else {
        echo json_encode(['error' => 'No names found']);
        ob_end_clean();
        exit();
    }
    $result->free();
} else {
    echo json_encode(['error' => 'Error executing query: ' . $conn->error]);
    ob_end_clean();
    exit();
}

$conn->close();

ob_end_clean();
echo json_encode($names);
?>

