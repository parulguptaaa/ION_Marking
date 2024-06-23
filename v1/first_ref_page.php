<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Example</title>
    <!-- <link rel="stylesheet" href="styles2.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
    margin: 0;
    font-family: Arial, sans-serif;
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
}

.breadcrumb {
    background-color: #e9f0fa;
    color: #333;
    padding: 10px 20px;
}

.breadcrumb p {
    margin: 0;
    font-size: 14px;
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
                <li><a href="#">Lab Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Director</a></li>
                <li><a href="#">Area of Work</a></li>
                <li><a href="#">Products/Technologies</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
        </nav>
        <div class="breadcrumb">
            <p>Home » Labs and Establishment » Centre for Fire, Explosive and Environment Safety (CFEES) » Director</p>
        </div>
    </header>
</body>
</html>
