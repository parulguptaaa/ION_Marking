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


$response = array();
$letter_id = $_SESSION['letter_id'];
$username = $_SESSION['username'];
$sql = "select * from emp_id where username='".$username."'";
$result = mysqli_query($data, $sql);
$erow = mysqli_fetch_array($result);
$user_id=$erow['id'];

$group_id = isset($_SESSION['group_id']) ? $_SESSION['group_id'] : '';

if ($group_id == 0) {
    echo json_encode(['error' => 'Invalid group ID specified']);
    ob_end_clean();
    exit();
}

$sql = "SELECT id, first_name, middle_name, last_name FROM emp_id WHERE group_id = $group_id";
$result = mysqli_query($conn, $sql);


$names = array();
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if($row['id']!=$user_id){
            $id = $row['id'];
            $full_name = trim($row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name']);
            $names[] = ['id' => $id, 'name' => $full_name];
        }
    }
    } else {
        echo json_encode(['error' => 'No names found']);
        ob_end_clean();
        exit();
    }
    mysqli_free_result($result);
} else {
    echo json_encode(['error' => 'Error executing query: ' . mysqli_error($conn)]);
    ob_end_clean();
    exit();
}

mysqli_close($conn);
ob_end_clean();
echo json_encode($names);
?>
