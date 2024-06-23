<?php
// Connect to the database
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'connect.php';
session_start();
$data = mysqli_connect($servername, $username, $password, $dbname);

if (!isset($_SESSION['username']) || !isset($_SESSION['letter_id'])) {
    $response['error'] = 'Session variables are not set blah';
    echo json_encode($response);
    exit();
}
if (isset($_SESSION['letter_id']) && isset($_SESSION['mark_id'])) {
    $letter_id = $_SESSION['letter_id'];
    $mark_id = $_SESSION['mark_id'];
    // $sql_select = "SELECT * FROM marked_letters WHERE mark_id = '$mark_id'";
    // $result_select = mysqli_query($data, $sql_select);
    // $row = mysqli_fetch_array($result_select);

    // Update query to set mark_status to 1
    $sql_update = "UPDATE marked_letters SET mark_status = 1 WHERE mark_id = '$mark_id'";
    if (mysqli_query($data, $sql_update)) {
        
    } else {
        echo "Error updating record: " . mysqli_error($data);
    }
}
$response = array();
$letter_id = $_SESSION['letter_id'];
$username = $_SESSION['username'];
$letter_sql = "SELECT * FROM letters WHERE letter_id='$letter_id'";
$letter_result = mysqli_query($data, $letter_sql);

if (!$letter_result) {
    $response['error'] = 'Error fetching user: ' . mysqli_error($data);
}
$letter_row = mysqli_fetch_array($letter_result);
$marked_letter_number=$letter_row['letter_number'];

$sql = "select * from emp_id where username='".$username."'";
$result = mysqli_query($data, $sql);
$row = mysqli_fetch_array($result);
$id=$row['id'];

// Get the submitted form data
$selected_employees = json_decode($_POST['selected_employees'], true);

// Insert the marked employees into the database
foreach ($selected_employees as $employee_id) {
    $query = "INSERT INTO marked_letters (marked_letter_id,marked_by,marked_to,marked_letter_number) VALUES ('$letter_id','$id','$employee_id','$marked_letter_number')";
    mysqli_query($conn, $query);
}

// Check if the insert was successful
if (mysqli_affected_rows($conn) > 0) {
    $response = array('success' => true);
} else {
    $response = array('success' => false, 'error' => 'Failed to insert marked employees');
}

// Close the database connection
mysqli_close($conn);

// Output the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
