<?php
include 'connect.php';
session_start();
echo "inside function";
if (!isset($_SESSION['val'])) {
    // If the session variable is not set, redirect to the login page or show an error
    header("location: index.php");
    exit(); // Ensure no further code is executed
}
$val=$_SESSION['val'];
$val=$_GET['val'];
$data = mysqli_connect($servername, $username, $password, $dbname);
// Check if the session variable 'username' is set
if (!isset($_SESSION['username'])) {
    // If the session variable is not set, redirect to the login page or show an error
    header("location: index.php");
    exit(); // Ensure no further code is executed
}
echo "all good";
// Assuming the username of the logged-in user is stored in a session
$username = $_SESSION['username']; // Ensure this session variable is set
$groupIdResult=mysqli_query($conn,"select group_id from emp_id where username='$username'");
$groupIdRow=mysqli_fetch_assoc($groupIdResult);
$groupId=$groupIdRow['group_id'];
echo $groupId, $username;
$usernames=[];
// $val='EMPLOYEE';
if($val=='AD'){
    $ADidResult=mysqli_query($conn,"select gh_id from grps where group_id='$groupId'");
    $ADidRow=mysqli_fetch_assoc($ADidResult);
    $ADid=$ADidRow['gh_id'];
    echo "in ad" .$ADid;
    $usernameResult=mysqli_query($conn,"select id, username from emp_id where id='$ADid'");
    while($row=mysqli_fetch_assoc($usernameResult)){
        $usernames[]=['id'=>$row['id'],'username'=>$row['username']];
        echo $row['username'];
    }
}elseif($val=='EMPLOYEE'){
    echo "in emp";
    $usernameResult=mysqli_query($conn,"select id, username from emp_id where group_id='$groupId'");
    while($row=mysqli_fetch_assoc($usernameResult)){
        $usernames[]=['id'=>$row['id'],'username'=>$row['username']];
    }
}
mysqli_close($conn);
echo json_encode($usernames);
echo "the end";
?>