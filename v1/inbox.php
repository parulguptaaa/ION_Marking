<?php
include 'connect.php';
session_start();
$data = mysqli_connect($servername, $username, $password, $dbname);
// Check if the session variable 'username' is set
if (!isset($_SESSION['username'])) {
    // If the session variable is not set, redirect to the login page or show an error
    header("location: index.php");
    exit(); // Ensure no further code is executed
}

// Assuming the username of the logged-in user is stored in a session
$username = $_SESSION['username']; // Ensure this session variable is set
// $marked_letter_id= $_SESSION['letter_id'];

// Fetch the user's id and group_id
$sql = "SELECT * FROM emp_id WHERE username = '$username'";
$result = mysqli_query($data, $sql);
$row = mysqli_fetch_array($result);
$id=$row['id'];
// $user_full_name = trim($row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Example</title>
    <!-- <link rel="stylesheet" href="styles2.css"> -->
<!-- <style>
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

        /* .search-container {
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
            padding: 10px 100px;
        }

        .navigation-bar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        .navigation-bar li {
            margin: 0 15px;
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

        .breadcrumb {
            background-color: #00509e;
            color: white;
            padding: 40px;
            width: 80%;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .breadcrumb p {
            margin: 0;
            font-size: 22px;
            font-weight: bold;
        }

        .container {
            width: 80%;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .message-box {
            background-color: #ff9a9e;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table th, table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #00509e;
            color: white;
            font-size: 14px;
        }

        table td {
            background-color: #f9f9f9;
            font-size: 14px;
        }

        table tr:nth-child(even) {
            background-color: #f1f1f1;
        }

        table a {
            color: #00509e;
            text-decoration: none;
        }

        table a:hover {
            text-decoration: underline;
        }

        button a {
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        button {
            background: linear-gradient(45deg, #00509e, #003366);
            border: none;
            border-radius: 5px;
            color: white;
            padding: 10px 15px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: linear-gradient(45deg, #003366, #00509e);
        }
</style> -->
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

        /* .search-container {
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
            margin: 0 15px;
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

        .breadcrumb {
            background-color: #00509e;
            color: white;
            padding: 40px;
            width: 80%;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .breadcrumb p {
            margin: 0;
            font-size: 22px;
            font-weight: bold;
        }

        .container {
            width: 80%;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .message-box {
            background-color: #ff9a9e;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table th, table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #00509e;
            color: white;
            font-size: 14px;
        }

        table td {
            background-color: #f9f9f9;
            font-size: 14px;
        }

        table tr:nth-child(even) {
            background-color: #f1f1f1;
        }

        table a {
            color: #00509e;
            text-decoration: none;
        }

        table a:hover {
            text-decoration: underline;
        }

        button a {
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        button {
            background: linear-gradient(45deg, #00509e, #003366);
            border: none;
            border-radius: 5px;
            color: white;
            padding: 10px 15px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: linear-gradient(45deg, #003366, #00509e);
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
                <li><a href="inbox.php" style="color: #ff9a9e" >INBOX </a></li>
                <li><a href="outbox.php">OUTBOX </a></li>
                <!-- <li><a href="upload.php">UPLOAD LETTER </a></li> -->
                <?php 
                $id=$row['id'];
        
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
<!--php echo $_SESSION["username"] ?> -->
    <div class="container">
    <?php
            if(isset($_SESSION['message'])) {
                echo '<div class="message-box">'.$_SESSION['message'].'</div>';
                unset($_SESSION['message']);
            }
    ?>
    
    <table class="input-group" border="4">
        <thead>
            <tr>
                <th scope="col"><div align="center"><h2>S.No.</h2></div></th>
                <th scope="col"><div align="center"><h2>Marked ION Number</h2></div></th>
                <th scope="col"><div align="center"><h2>Marked By</h2></div></th>
                <th scope="col"><div align="center"><h2>Marked Date & Time</h2></div></th>
                <!-- <th scope="col"><div align="center"><h2>Remarks</h2></div></th> -->
                <th scope="col" colspan="3"><div align="center"><h2>Action</h2></div></th>
                <!-- <th scope="col"><div align="center"><h2>visibility</h2></div></th> -->

                
            </tr>
        </thead>
        <tbody>
    <?php
        $sql="Select * from marked_letters where marked_to='$id' AND mark_status IS NULL";
        $result=mysqli_query($conn, $sql);
        if($result){
            $totalRows = mysqli_num_rows($result);  
            // $row=mysqli_fetch_assoc($result);
            // echo $row['name'];
            // $row=mysqli_fetch_assoc($result);
            // echo $row['name'];
            $sno=1;
            while($row=mysqli_fetch_assoc($result)){
                $mark_id=$row['mark_id'];
                $marked_letter_id=$row['marked_letter_id'];
                $marked_letter_number=$row['marked_letter_number'];
                $marked_by=$row['marked_by'];
                $q="Select * from adgh where emp_id='$marked_by'";
                $r=mysqli_query($conn, $q);
                $new_row=mysqli_fetch_assoc($r);

                if($new_row){
                    $full_name=$new_row['display_name'];
                }else{
                    $q="Select * from emp_id where id='$marked_by'";
                    $r=mysqli_query($conn, $q);
                    $new_row=mysqli_fetch_assoc($r);
                    $full_name = trim($new_row['first_name'] . " " . $new_row['middle_name'] . " " . $new_row['last_name']);
                }

                // $q="Select * from emp_id where id='$marked_by'";
                // $r=mysqli_query($conn, $q);
                // $new_row=mysqli_fetch_assoc($r);
                // $full_name = trim($new_row['first_name'] . " " . $new_row['middle_name'] . " " . $new_row['last_name']);
                $marked_by_name=$full_name;
                $marked_timestamp=$row['marked_timestamp'];
                // $remarks=$row['remarks'];
                // $visibility=$row['visibility'];
                // $fileDestination = 'Uploads/' . $fileName;
                // $file_path = substr($filename, strrpos($filename, '/') + 1);
                echo '<tr>
                <td scope="row">'.$sno.'</td> 
                <td scope="row">'.$marked_letter_number.'</td> 
                <td>'.$marked_by_name.'</td>
                <td>'.$marked_timestamp.'</td>';
                // <td>'.$remarks.'</td>';
                $sno+=1;
                if (isset($_SESSION['adgh_id'])&&isset($id)) {
                    $adgh_id = $_SESSION['adgh_id'];
                $query = "SELECT * FROM adgh WHERE emp_id='$id'";
            $result1 = mysqli_query($data, $query);
        
            if ($result1) {
                $row1 = mysqli_fetch_array($result1);
                if (isset($row1['adgh_id'])) {
                    $_SESSION['$adgh_id']=$adgh_id;
                    echo'<td><button><a href="mark.php?letter_id=' . $marked_letter_id . '&mark_id=' . $mark_id . '" onclick="return confirm(\'Are you sure you want to MARK this item?\')">MARK</a></button></td>';
                }
            }
        }else {
            echo '<td><button><a href="mark_normal_user.php?letter_id='.$marked_letter_id.'&mark_id=' . $mark_id . '" onclick="return confirm(\'Are you sure you want to MARK this item?\')">MARK</a></button></td>';
        }   
        $letter_sql="Select * from letters where letter_id='$marked_letter_id'";
        $letter_result=mysqli_query($conn, $letter_sql);
        $letter_row=mysqli_fetch_assoc($letter_result);
        $filename=$letter_row['filename'];
                echo'
                <td>
                <button><a href="'.$filename.'" target="Uploads/.'.$filename.'">VIEW</a></button></td>
                <td>
                <button><a href="reply.php" onclick="return confirm(\'Are you sure you want to REPLY to this item?\')">REPLY</a></button>
                </td>
                
              </tr>';
            //   <button><a href="reply.php?orig_letter_id='.$letter_id.'" onclick="return confirm(\'Are you sure you want to REPLY to this item?\')">REPLY</a></button>
            }
        }
    ?>
 
        </tbody>
    </table>
    

    </div>

    
</body>
</html>
