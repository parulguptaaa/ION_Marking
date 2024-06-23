<?php
// Connect to the database
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'connect.php';
session_start();

header('Content-Type: application/json');

$data = mysqli_connect($servername, $username, $password, $dbname);

if (!$data) {
    $response['error'] = 'Failed to connect to the database: ' . mysqli_connect_error();
    echo json_encode($response);
    exit();
}

if (!isset($_SESSION['username']) || !isset($_SESSION['letter_id'])) {
    $response['error'] = 'Session variables are not set';
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

$sql = "SELECT * FROM emp_id WHERE username='$username'";
$result = mysqli_query($data, $sql);

if (!$result) {
    $response['error'] = 'Error fetching user: ' . mysqli_error($data);
    echo json_encode($response);
    exit();
}

$row = mysqli_fetch_array($result);
$user_id = $row['id'];

// Get the group_ids from POST data
$selected_groups = json_decode($_POST['selected_employees'], true);

$inserted_rows = 0;

// Iterate over each group_id and fetch employees
foreach ($selected_groups as $adghID) {
    $query1 = "SELECT emp_id, adgh_id FROM adgh WHERE adgh_id='$adghID'";
    $result1 = mysqli_query($data, $query1);

    if (!$result1) {
        $response = array('success' => false, 'error' => 'Failed to fetch employees for ADGH ID: ' . $adghID . ' - ' . mysqli_error($data));
        echo json_encode($response);
        exit();
    }

    // Insert marked employees into the database
    while ($row1 = mysqli_fetch_array($result1)) {
        $employee_id = $row1['emp_id'];
        if ($employee_id != $user_id) {
            $query = "INSERT INTO marked_letters (marked_letter_id, marked_by, marked_to,marked_letter_number) VALUES ('$letter_id', '$user_id', '$employee_id','$marked_letter_number')";
            $insert_result = mysqli_query($data, $query);

            if (!$insert_result) {
                $response = array('success' => false, 'error' => 'Failed to insert marked employee for ADGH ID: ' . $adghID . ' - ' . mysqli_error($data));
                echo json_encode($response);
                exit();
            } else {
                $inserted_rows++;
            }
        }
    }
}

// Check if any rows were affected
if ($inserted_rows > 0) {
    $response = array('success' => true);
} else {
    $response = array('success' => false, 'error' => 'Failed to insert marked employees');
}

// Close the database connection
mysqli_close($data);

// Output the response as JSON
echo json_encode($response);
?>

