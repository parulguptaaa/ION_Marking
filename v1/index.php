<?php
include 'connect.php';
session_start();
$data = mysqli_connect($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD" ] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // if ($username == "admin" && $password == "admin@123") {
    //     // header("location:admin_login.php");
    //     echo "Log in to ADMIN LOGIN !";
    // } else {
        $sql = "select * from emp_id where username='".$username."' AND password='".$password."'";
        $result = mysqli_query($data, $sql);
        $row = mysqli_fetch_array($result);
        

    // if ($result1) {
    //     $row1 = mysqli_fetch_array($result1);
    //     if (isset($row1['adgh_id'])) {
    //         header("Location: adgh_page.php");
    //         exit(); // Always call exit after a header redirect
    //     }
    // }
        if ($row && $row["user_type"]=="Admin"){
            echo "Log in to ADMIN LOGIN !";
        }else{
        if ($row && $row["desig_id"] <= 12) {
            $_SESSION["username"]=$username;
            header("location:dashboard.php");
        } else{
            echo "<script>alert('username or password incorrect')</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ION Marking</title>
    <!-- <link rel="stylesheet" href="styles2.css"> -->
    
    
<style>
    html, body {
            font-family: 'Arial', Helvetica, sans-serif;
            background: linear-gradient(135deg,#d498c6,#1294a7,#c7e4d9 );
            height: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .main-header {
            background: linear-gradient(45deg, #00509e, #003366);
            color: white;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding-bottom: 0px;
            margin-bottom: 20px;
            border-radius:10px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 250px;
            
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo {
            height: 60px;
            margin-right: 20px;
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
            /* background-color: #00509e;
             */
            background: linear-gradient(45deg, #00509e, #003366);
             color: white;
            padding: 40px;
            width: 80%;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .breadcrumb form {
            margin: 0;
            font-size: 16px;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 50px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
        }

        .input-group label {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }

        .input-group input {
            padding: 10px;
            font-size: 16px;
            border: 2px solid #00509e;
            border-radius: 5px;
            outline: none;
            margin-bottom: 20px;
            width: 80%;
        }

        .input-group button {
            padding: 10px 20px;
            background: linear-gradient(45deg, #00509e, #003366);
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .input-group button:hover {
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
            <!-- <div class="search-container">
                <input type="text" placeholder="Search">
                <button type="submit"><i>GO</i></button>
            </div> -->
        </div>
    
        <nav class="navigation-bar">
            <ul class="right-aligned">
                <!-- <li><a href="#">Lab Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Director</a></li>
                <li><a href="#">Area of Work</a></li>
                <li><a href="#">Products/Technologies</a></li> -->
                <li><a href="admin_login.php">Admin Login</a></li>
            </ul>
        </nav>
        </header>
        

        <header class="breadcrumb">
            <!-- <p>Home » Labs and Establishment » Centre for Fire, Explosive and Environment Safety (CFEES) » Director</p> -->
            
            <form action="#" method="post">
            <table class="input-group" >
            <tr >
                <td>
                <label for="username">Username:</label>
                </td>
                <td>
                <input type="text" id="username" name="username" required>
                </td>
            </tr>
            <tr>
                <td>
                <label for="password">Password:</label>
                </td>
                <td>
                <input type="password" id="password" name="password" required>
                </td>
            </tr>
            </table>
            <button type="submit">Login</button>
        </form>
    
        </header>
    
</body>
</html>
