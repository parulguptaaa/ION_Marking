<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connect.php';
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

// $letter_id= $_GET['letter_id'];
if (isset($_GET['letter_id']) && isset($_GET['mark_id'])) {
    $marked_letter_id = $_GET['letter_id'];
    $letter_id=$marked_letter_id;
    $mark_id = $_GET['mark_id'];
    $_SESSION['mark_id']=$mark_id;
    // $sql_select = "SELECT * FROM marked_letters WHERE mark_id = '$mark_id'";
    // $result_select = mysqli_query($data, $sql_select);
    // $row = mysqli_fetch_array($result_select);

    // // Update query to set mark_status to 1
    // $sql_update = "UPDATE marked_letters SET mark_status = 1 WHERE mark_id = '$mark_id'";
    // if (mysqli_query($data, $sql_update)) {
    //     echo "Record updated successfully";
    // } else {
    //     echo "Error updating record: " . mysqli_error($data);
    // }
}
if (isset($letter_id)) {
    // If the session variable is not set, redirect to the login page or show an error
    $_SESSION['letter_id']=$letter_id;

    // exit(); // Ensure no further code is executed
}
// Assuming the username of the logged-in user is stored in a session
$username = $_SESSION['username']; // Ensure this session variable is set
// Fetch the user's id and group_id
$sql = "SELECT * FROM emp_id WHERE username = '$username'";
$result = mysqli_query($data, $sql);
$row = mysqli_fetch_array($result);

// if ($result->num_rows > 0) {
//     $row = $result->fetch_assoc();
//     $id = $row['id'];
//     $group_id = $row['group_id'];

// } else {
//     echo "No user found with the given username.";
// }

if ($row && $row["user_type"]=="User"){
    $id = $row['id'];
    $group_id = $row['group_id'];
    $_SESSION['group_id'] = $group_id;
}else{
    echo "No user found with the given username.";
}
// if(isset($letter_id)){
//     echo "To be marked letter id:" .htmlspecialchars($letter_id)."<br>";
// }
if (isset($id) && isset($group_id)) {
    $_SESSION['group_id'] = $group_id;
} else {
    echo "ID and Group ID are not set.";
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

    .display-table{
        width: 90%;
        max-width: 800px;
        padding: 20px 100px;
        border-radius: 10px;
        background: linear-gradient(135deg,#00509e,#c7e4d9 );

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


td{
    padding:15px;
}
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
        </div>
        <nav class="navigation-bar">
            <ul>
                <li><a href="dashboard.php">DASHBOARD</a></li>
                <li><a href="inbox.php">INBOX</a></li>
                <li><a href="outbox.php">OUTBOX</a></li>
                <?php 
                $id=$row['id'];
                $_SESSION["logged_in_emp_id"]=$id;
        
                $query = "SELECT * FROM adgh WHERE emp_id='$id'";
            $result1 = mysqli_query($data, $query);
        
            if ($result1) {
                $row1 = mysqli_fetch_array($result1);
                if (isset($row1['adgh_id'])) {
                    echo'<li><a href="upload.php">UPLOAD</a></li>';
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

    <div class="container">
        <table class="display-table">
            <tbody>
            <?php
            // PHP code to fetch data from the database
            // Ensure PHP is configured correctly
            if(!isset($_SESSION['$letter_id'])){
                $letter_id=$_SESSION['letter_id'];
            }
            $letters_sql = "SELECT * FROM letters where letter_id='$letter_id'";
            $letters_result = mysqli_query($data, $letters_sql);

            if($letters_result) {
                while($row = mysqli_fetch_assoc($letters_result)) {
                    echo '
                    <tr><td>Letter Number:</td><td>'.$row['letter_number'].'</td></tr>
                    <tr><td>Subject:</td><td>'.$row['subject'].'</td></tr>
                    <tr><td>Uploaded date & time :</td><td>'.$row['uploaded_date'].'</td></tr>
                    <tr><td>Remarks:</td><td>'.$row['remarks'].'</td></tr>';
                }
            }
            
            ?>
            </tbody>
        </table>

        
            <table >
                <tr>
                    <td colspan="2"><label>Mark To:</label></td>
                </tr>
                <tr>
                    <!-- <td><input type="radio" id="AD" name="select_mark_to" value="AD"><label for="AD">WHOLE GROUP</label></td> -->
                    <td><input type="radio" id="AD" name="select_mark_to" value="AD"><label for="AD">AD/HEAD</label></td>

                    <td><input type="radio" id="EMPLOYEES" name="select_mark_to" value="EMPLOYEES"><label for="EMPLOYEES">INDIVIDUAL EMPLOYEE</label></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div id="groupDropdownContainer" style="display:none;">
                            <label for="groupSelect">Select Group:</label>
                            <select id="groupSelect"></select>
                        </div>
                    </td>
                </tr>
                <form class="mark-form" id="mark-form" method="POST" ></form>
                <tr>
                    <td colspan="2">
                        <div id="checkboxContainer"></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <!-- <button type="submit" class= "submit-btn" onclick="submitForm()" >SUBMIT</button></td> -->
                    <button type="submit" id="wholeSubmitButton" class= "submit-btn" style="display:none;" onclick="submitForm('submit_whole_ad.php');">SUBMIT</button>
                    <button type="submit" id="employeesSubmitButton" class= "submit-btn" style="display:none;" onclick="submitForm('submit_employees.php');">SUBMIT</button>                
                </tr>
            </table>
        </form>
        <DIV id="selectedGroups"></DIV>
        <div id="selectedEmployees"></div>
        <script src="v1_adgh.js"></script>
    </div>
</body>
</html>
