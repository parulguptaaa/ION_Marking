<?php
include 'connect.php';
session_start();
$data = mysqli_connect($servername, $username, $password, $dbname);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Example</title>
    <!-- <link rel="stylesheet" href="styles2.css"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->
    <style>
        html, body {
            font-family: Arial, Helvetica, sans-serif;
            /* background-color: #e9f0fa; */
	        height: 100%;
	        margin: 0 !important;
	        padding: 0 !important;
			/*background:linear-gradient(300deg, #5fb0db, 0%, #17b598 68%, #86e9a4 100%);*/
        }
        

.main-header {
    background-color: #00509e;
    color: white;
}

.top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
}

.logo-container {
    display: flex;
    align-items: center;
}

.logo {
    height: 60px;
}

.title-container h1, .title-container h2, .title-container h3 {
    margin: 0;
    line-height: 1.2;
}

.title-container h1 {
    font-size: 18px;
    margin-bottom: 5px;
}

.title-container h2 {
    font-size: 16px;
}

.title-container h3 {
    font-size: 14px;
    color: #cccccc;
}

.search-container {
    display: flex;
    align-items: center;
}

.search-container input {
    padding: 5px;
    border: none;
    border-radius: 20px 0 0 20px;
}

.search-container button {
    padding: 5px 10px;
    border: none;
    background-color: white;
    color: #00509e;
    border-radius: 0 20px 20px 0;
    cursor: pointer;
}

.navigation-bar {
    background-color: #003366;
    padding: 10px 20px;
}

.navigation-bar ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: space-around;
    
}

.navigation-bar li {
    margin: 0;
    
}

.navigation-bar a {
    color: white;
    text-decoration: none;
    font-size: 14px;
    /* align-items: right; */
}

.breadcrumb {
    align-items: center;
    background-color: #e9f0fa;
    color: #333;
    padding: 5px ;
    
}

.breadcrumb form {
    margin: 0;
    font-size: 14px;
    text-align: center;
}
.input-group{
   margin: auto;
   font-size: 13px;
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
                <input type="text" placeholder="Search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <nav class="navigation-bar">
            <ul>
                <!-- <li><a href="#">Lab Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Director</a></li>
                <li><a href="#">Area of Work</a></li>-->
                <li><a href="upload.php">UPLOAD LETTER </a></li>
                <li><a href="logout.php">LOGOUT</a></li>
            </ul>
        </nav>
        </header>

        <header class="breadcrumb">
            <p>LETTER MARKING SYSTEM</p>
        </form>
    
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
                <th scope="col"><div align="center"><h2>Letter ID</h2></div></th>
                <th scope="col"><div align="center"><h2>Letter Mode</h2></div></th>
                <th scope="col"><div align="center"><h2>Docket Number</h2></div></th>
				<th scope="col"><div align="center"><h2>Docket Dated</h2></div></th>
				<th scope="col"><div align="center"><h2>Category</h2></div></th>
				<th scope="col"><div align="center"><h2>Letter Number</h2></div></th>
                <th scope="col"><div align="center"><h2>Letter Date</h2></div></th>
                <th scope="col"><div align="center"><h2>Establishment Name</h2></div></th>
                <th scope="col"><div align="center"><h2>Subject</h2></div></th>
                <!-- <th scope="col"><div align="center"><h2>Uploaded Letter</h2></div></th> -->

				
            </tr>
        </thead>
        <tbody>
    <?php
        $sql="Select * from letters ORDER BY letter_date DESC";
        $result=mysqli_query($conn, $sql);
        if($result){
			$totalRows = mysqli_num_rows($result);	
            // $row=mysqli_fetch_assoc($result);
            // echo $row['name'];
            // $row=mysqli_fetch_assoc($result);
            // echo $row['name'];
            while($row=mysqli_fetch_assoc($result)){
			
                $letter_id=$row['letter_id'];
                $letter_mode=$row['letter_mode'];
                $docket_number=$row['docket_number'];
				$docket_date=$row['docket_date'];
                $category=$row['category'];
                $letter_number=$row['letter_number'];
                $letter_date=$row['letter_date'];
                $establishment_name=$row['establishment_name'];
                $subject=$row['subject'];
                $uploaded_letter=$row['uploaded_letter'];
				// if($row['file_created_date'] !== null){
				// 	$file_created_date = $row['file_created_date'];
				// 	$formatted_date = date('d-m-Y', strtotime($file_created_date));
				// } else {
				// 	$formatted_date = 'Date not given';
				// }
				// $file_size = number_format($row['file_size'] / 1024, 2);
				$file_path = substr($uploaded_letter, strrpos($uploaded_letter, '/') + 1);
				$serialNo = $totalRows--;
                echo '<tr>
                <td scope="row">'.$letter_id.'</td> 
                <td>'.$letter_mode.'</td>
                <td>'.$docket_number.'</td>
                <td>'.$docket_date.'</td>
                <td>'.$category.'</td>
                <td>'.$letter_number.'</td>
                <td>'.$letter_date.'</td>
				<td>'.$establishment_name.'</td>
				<td>'.$subject.'</td>
                <td><a href="'.$uploaded_letter.'" target="_blank">'.$uploaded_letter.'</a></td>
                <td>
                <button><a href="mark.php?marked_letter_id='.$letter_id.'" onclick="return confirm(\'Are you sure you want to MARK this item?\')">MARK</a></button>
                <button><a href="reply.php?orig_letter_id='.$letter_id.'" onclick="return confirm(\'Are you sure you want to REPLY to this item?\')">REPLY</a></button>
                </td>
                
              </tr>';
            }
        }
    ?>
            
        </tbody>
    </table>
    

    </div>

    
</body>
</html>