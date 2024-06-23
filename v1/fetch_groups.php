<?php
header('Content-Type: application/json');
ob_start();
error_reporting(0);
include 'connect.php';

$sql = "SELECT group_id AS id, group_name AS name FROM grps";
$result = $conn->query($sql);

$groups = array();
if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $groups[] = $row;
        }
    } else {
        echo json_encode(['error' => 'No groups found']);
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
echo json_encode($groups);
?>
