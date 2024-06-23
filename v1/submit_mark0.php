<?php
header('Content-Type: application/json');
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 0);
include 'connect.php';

$response = [];

// Check if session variables are set
if (!isset($_SESSION['username']) || !isset($_SESSION['letter_id']) || !isset($_SESSION['logged_in_emp_id'])) {
    $response['error'] = 'Session variables are not set';
    echo json_encode($response);
    exit();
}

// Retrieve session variables
$letter_id = $_SESSION['letter_id'];
$username = $_SESSION['username'];
$logged_in_emp_id = $_SESSION['logged_in_emp_id'];

// Retrieve selected employees from POST request
// $selected_employees = isset($_POST['selected_employees']) ? json_decode($_POST['selected_employees'], true) : [];

// if (empty($selected_employees)) {
//     $response['error'] = 'No employees selected';
//     echo json_encode($response);
//     exit();
// }

$conn = new mysqli($servername, $username, $password, $dbname);
$selected_employees = json_decode($_POST['selected_employees'], true);

$response = array();

if (!empty($selected_employees) && is_array($selected_employees)) {
    $stmt = $conn->prepare("INSERT INTO marked_letters ( marked_letter_id, marked_by,marked_to) VALUES (?, ?, ?)");
    $stmt->bind_param("iii",  $letter_id, $logged_in_emp_id,$marked_to );

    foreach ($selected_employees as $marked_to) {
        if (!$stmt->execute()) {
            $response['error'] = "Error inserting data: " . $stmt->error;
            echo json_encode($response);
            exit;
        }
    }

    $response['success'] = true;
} else {
    $response['error'] = "No employees selected or invalid data format.";
}

echo json_encode($response);

$stmt->close();
$conn->close();
?>



// Check connection
if ($conn->connect_error) {
    $response['error'] = 'Database connection failed: ' . $conn->connect_error;
    echo json_encode($response);
    exit();
}

$stmt = $conn->prepare("INSERT INTO marked_letters (marked_letter_id, marked_by, marked_to) VALUES (?, ?, ?)");
if (!$stmt) {
    $response['error'] = 'Error preparing statement: ' . $conn->error;
    echo json_encode($response);
    $conn->close();
    exit();
}

foreach ($selected_employees as $emp_id) {
    // Bind parameters and execute statement
    $stmt->bind_param('iii', $letter_id, $logged_in_emp_id, $emp_id);
    if (!$stmt->execute()) {
        $response['error'] = 'Error executing statement: ' . $stmt->error;
        echo json_encode($response);
        $stmt->close();
        $conn->close();
        exit();
    }
}

$stmt->close();
$conn->close();
$response['success'] = 'Marked successfully';
echo json_encode($response);
?>
