<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// For inserting
include 'connect.php';
session_start();
$data = mysqli_connect($servername, $username, $password, $dbname);
if (!$data) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Check if the session variable 'username' is set
if (!isset($_SESSION['username'])) {
    // If the session variable is not set, redirect to the login page or show an error
    header("location: index.php");
    exit(); // Ensure no further code is executed
}
$username = $_SESSION['username'];

// Fetch the user's id and group_id
$sql = "SELECT * FROM emp_id WHERE username = '$username'";
$result = mysqli_query($data, $sql);
$row = mysqli_fetch_array($result);

if ($row && $row["user_type"] == "User") {
    $id = $row['id'];
    $_SESSION['id'] = $id;
    $group_id = $row['group_id'];
    $_SESSION['group_id'] = $group_id;
} else {
    echo "No user found with the given username.";
    exit();
}

if (isset($_POST['submit'])) {
    if (!isset($_SESSION['group_id'])) {
        echo "group_id not set";
        exit();
    }
    $group_id = $_SESSION['group_id'];

    // Fetch group name for letter number
    $group_query = "SELECT group_name FROM grps WHERE group_id = '$group_id'";
    $group_result = mysqli_query($data, $group_query);
    $group_row = mysqli_fetch_array($group_result);

    if ($group_row) {
        $group_name = $group_row['group_name'];
        $year = date('Y');
        $month = date('M');

        // Fetch the latest letter number
        $letter_query = "SELECT MAX(group_letter_no) AS max_letter_no FROM letters WHERE group_id = '$group_id'";
        $letter_result = mysqli_query($data, $letter_query);
        $letter_row = mysqli_fetch_array($letter_result);
        
        $group_letter_no = $letter_row['max_letter_no'] ? $letter_row['max_letter_no'] + 1 : 1;
        $letter_number = "CFEES/$group_name/$year/$month/$group_letter_no";
    } else {
        echo "Group not found.";
        exit();
    }

    // File upload logic
    $subject = $_POST['subject'];
    $remarks = $_POST['remarks'];
    $file = $_FILES['filename'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowed = array('jpg', 'jpeg', 'pdf', 'png', 'docx');

    if (!isset($_SESSION['id'])) {
        echo "id not set";
        exit();
    }
    $id = $_SESSION['id'];

    if (in_array($fileExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) { // Example: 1MB limit
                $fileNameNew = uniqid('', true) . "." . $fileExt;
                $fileDestination = 'Uploads/' . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);

                $sql = "INSERT INTO letters (letter_number, subject, remarks, filename, emp_id, group_id, group_letter_no) 
                        VALUES ('$letter_number', '$subject', '$remarks', '$fileDestination', '$id', '$group_id', '$group_letter_no')";
                $result = mysqli_query($data, $sql);
                if ($result) {
                    $_SESSION['message'] = 'This letter is uploaded successfully';
                    header('location: dashboard.php');
                } else {
                    die("Error inserting data: " . mysqli_error($data));
                }
            } else {
                echo "Your file is too big!";
            }
        } else {
            echo "There was an error uploading your file!";
        }
    } else {
        echo "You cannot upload files of this type!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ION Marking</title>
    
<style>
    html, body {
    font-family: Arial, Helvetica, sans-serif;
    /* background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
     */
    background: linear-gradient(135deg,#d498c6,#1294a7,#c7e4d9 );
    height: 170%;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    }
    .main-header {
            background: linear-gradient(45deg, #00509e, #003366);
            color: white;
            width: 139%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding-bottom: 0px;
            margin-bottom: 20px;
            display:block;
        }

        .top-bar {
            display: flex;
            justify-content:space-evenly;
            align-items: center;
            padding: 20px 40px;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo {
            height: 100px;
            margin-right: 5px;
            margin-left: 10px;;
        }
        
        .title-container h1, .title-container h2, .title-container h3 {
            margin: 0;
            line-height: 1.2;
        }

        .title-container h1 {
            font-size: 22px;
            margin-bottom: 5px;
        }

        .title-container h2 {
            font-size: 18px;
        }

        .title-container h3 {
            font-size: 16px;
            color: #cccccc;
        }
    /* 
    .search-container {
        display: flex;
        align-items: center;
        position: relative;
    }

    .search-container input {
        padding: 10px 15px;
        border: none;
        border-radius: 20px 0 0 20px;
        outline: none;
        font-size: 16px;
    }

    .search-container button {
        padding: 10px 15px;
        border: none;
        background-color: #ffffff;
        color: #00509e;
        border-radius: 0 20px 20px 0;
        cursor: pointer;
        font-size: 16px;
    } */

    .navigation-bar {
        background-color: #003366;
        padding: 10px 40px;
    }

    .navigation-bar ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
    }

    .navigation-bar li {
        margin: 0px 15px;
        padding: 0 50px;

    }

    .navigation-bar a {
        color: white;
        text-decoration: none;
        font-size: 16px;
        transition: color 0.3s ease;
    }

    .navigation-bar a:hover {
        color: #ff9a9e;
    }

    .container {
        width: 90%;
        max-width: 800px;
        background: white;
        padding: 20px 100px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        font-size: 16px;
        margin-bottom: 5px;
        color: #00509e;
    }

    .form-group input, .form-group select {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
        width: 100%;
        box-sizing: border-box;
        outline: none;
    }

    .form-group input[type="file"] {
        padding: 5px;
    }

    .form-group input:focus, .form-group select:focus {
        border-color: #00509e;
    }

    .submit-btn {
        background: linear-gradient(45deg, #00509e, #003366);
        border: none;
        border-radius: 5px;
        color: white;
        padding: 10px 15px;
        cursor: pointer;
        transition: background 0.3s ease;
        font-size: 16px;
        width: 100%;
        text-align: center;
    }

    .submit-btn:hover {
        background: linear-gradient(45deg, #003366, #00509e);
    }

    /* @media (max-width: 600px) { 
        .top-bar {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .logo {
            margin-bottom: 10px;
        }

        .navigation-bar ul {
            flex-direction: column;
            align-items: center;
        }

        .navigation-bar li {
            margin-bottom: 10px;
        }
    }
    */

</style>

</head>
<body>
    <header class="main-header">
        <div class="top-bar">
            <div class="logo-container">
                <img src="drdologo.jpg" alt="Logo" class="logo">
            </div>
            <div class="title-container">
                <h1>Centre for Fire, Explosive and Environment Safety (CFEES)</h1>
                <h2>DEFENCE RESEARCH & DEVELOPMENT ORGANISATION</h2>
                <h3>Ministry of Defence, Government of India</h3>
            </div>
            <div class="search-container">
                <!-- <input type="text" placeholder="Search">
                <button type="submit"><i class="fa fa-search"></i></button> -->
            </div>
        </div>
        <nav class="navigation-bar">
            <ul>
                <!-- <li><a href="#">Lab Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Director</a></li>
                <li><a href="#">Area of Work</a></li>-->
                <li><a href="dashboard.php">DASHBOARD</a></li>
                <li><a href="inbox.php">INBOX </a></li>
                <li><a href="outbox.php">OUTBOX </a></li>

                <?php 
                $id=$row['id'];
        
                $query = "SELECT * FROM adgh WHERE emp_id='$id'";
            $result1 = mysqli_query($data, $query);
        
            if ($result1) {
                $row1 = mysqli_fetch_array($result1);
                if (isset($row1['adgh_id'])) {
                    echo'<li><a href="upload.php" style="color: #ff9a9e" >UPLOAD</a></li>';
                }
            }?>

                <li><a href="logout.php">LOGOUT</a></li>
                <?php
                if (isset($row['id'])) {
                    $id=$row['id'];
                $q="Select * from adgh where emp_id='$id'";
                $r=mysqli_query($conn, $q);
                $new_row=mysqli_fetch_assoc($r);

                if($new_row){
                    $full_name=$new_row['display_name'];
                }else{
                    $q="Select * from emp_id where id='$id'";
                    $r=mysqli_query($conn, $q);
                    $new_row=mysqli_fetch_assoc($r);
                    $full_name = trim($new_row['first_name'] . " " . $new_row['middle_name'] . " " . $new_row['last_name']);
                }
                    echo '<li > Welcome '.$full_name.'</li>';
                }
                ?>
            </ul>
        </nav>
        </header>

        <!-- <header class="breadcrumb">
            <form action="#" method="post">
        </form>
    
        </header> -->
        <div class="container">
        <form action="#" method="post" enctype="multipart/form-data">
            
            <!-- <div class="form-group position-relative "  >
            <label>Letter Mode</label>
                <select name="letter_mode" class="form-control" >
                    <option value="Select Mode">--Select Letter Mode--</option>
                    <option value="Letter">Letter</option>
                    <option value="Image">Image</option>
                    <option value="Remark">Remark</option>
                </select>
                
            
            </div>
            <div class="form-group" autocomplete="off">
            <label>Docket Number</label>
                <input type="text" class="form-control" placeholder="Enter docket number " name="docket_number" autocomplete="off">
                
            </div>
            <div class="form-group" autocomplete="off">
            <label>Docket Date</label>
                <input type="date" class="form-control" placeholder="Enter docket date " name="docket_date" autocomplete="off">
                
            </div>
            <div class="form-group" autocomplete="off">
            <label>Category</label>
                <input type="text" class="form-control" placeholder="Enter category " name="category" autocomplete="off">
                
            </div> -->
            <div class="form-group" autocomplete="off">
               <label> UPLOAD ION </label>
        </div>
            <div class="form-group" autocomplete="off">
            <label>ION Number : </label>
                <!-- <input type="text" class="form-control" placeholder="Enter letter number" name="letter_number" autocomplete="off"> -->
                <?php
                    $group_id = $_SESSION['group_id'];

                    // Fetch group name for letter number
                    $group_query = "SELECT group_name FROM grps WHERE group_id = '$group_id'";
                    $group_result = mysqli_query($data, $group_query);
                    $group_row = mysqli_fetch_array($group_result);
                
                    if ($group_row) {
                        $group_name = $group_row['group_name'];
                        $year = date('Y');
                        $month = date('M');
                
                        // Fetch the latest letter number
                        $letter_query = "SELECT MAX(group_letter_no) AS max_letter_no FROM letters WHERE group_id = '$group_id'";
                        $letter_result = mysqli_query($data, $letter_query);
                        $letter_row = mysqli_fetch_array($letter_result);
                        
                        $group_letter_no = $letter_row['max_letter_no'] ? $letter_row['max_letter_no'] + 1 : 1;
                        $letter_number = "CFEES/$group_name/$year/$month/$group_letter_no";
                    } else {
                        echo "Group not found.";
                        exit();
                    }
                    if(isset($letter_number)){
                    // $group_letter_no+=1;
                    // $letter_number='CFEES/'.$group_name.'/'.$year.'/'.$month.'/'.$group_letter_no;
                    echo $letter_number;
                    }
                        
                ?>
                
            </div>
            <!-- <div class="form-group" autocomplete="off">
            <label>Letter Date</label>
                <input type="date" class="form-control" placeholder="Enter letter date " name="letter_date" autocomplete="off">
                
            </div>
            <div class="form-group" autocomplete="off">
            <label>Establishment Name</label>
                <input type="text" class="form-control" placeholder="Enter establishment name" name="establishment_name" autocomplete="off">
                
            </div> -->
            <div class="form-group" autocomplete="off">
            <label>ION Title</label>
                <input type="text" class="form-control" placeholder="Enter subject" name="subject" autocomplete="off">
                
            </div>
    <!-- $uploaded_letter=$_POST['uploaded_letter']; -->
            <div class="form-group">
            <label>Upload ION</label>
                <input type="file" class="form-control" name="filename" autocomplete="off">
            </div>
            <div class="form-group" autocomplete="off">
            <label>Remarks:</label>
                <input type="text" class="form-control" placeholder="Write remarks " name="remarks" autocomplete="off">
                
            </div>
            <input type="submit" value="Submit" id="login" name="submit" class="login"  onclick="return confirm(\'Are you sure you want to edit this item?\')">
        </form>
    </div>
