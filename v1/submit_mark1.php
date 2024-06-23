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
$selected_employees = isset($_POST['selected_employees']) ? json_decode($_POST['selected_employees'], true) : [];

if (empty($selected_employees)) {
    $response['error'] = 'No employees selected';
    echo json_encode($response);
    exit();
}

$conn = new mysqli($servername, $username, $password, $dbname);

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

foreach ($selected_employees as $emp_name) {
    // Fetch the emp_id from emp_id table based on the employee name
    $first_name=$conn->query("SELECT SUBSTRING_INDEX('$emp_name', ' ', 1)");
    $emp_result = $conn->query("SELECT id FROM emp_id WHERE first_name ='".$first_name."'");
    if ($emp_result && $emp_result->num_rows > 0) {
        $emp_row = $emp_result->fetch_assoc();
        $emp_id = $emp_row['id'];

        $stmt->bind_param('iii', $letter_id, $logged_in_emp_id, $emp_id);
        if (!$stmt->execute()) {
            $response['error'] = 'Error executing statement: ' . $stmt->error;
            echo json_encode($response);
            $stmt->close();
            $conn->close();
            exit();
        }
    } else {
        $response['error'] = 'Employee not found: ' . $emp_name;
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


