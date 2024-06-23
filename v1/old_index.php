<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CFEES DRDO</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
<div class="top1row1">
            <img class="logoimage" src="drdologo.jpg" alt="logo" align="left">
            <h1>DEFENCE R&D ORGANISATION, CFEES</h1>
</div>
    <div class="topic">
        <h1>Letter Marking System</h1>
    </div>

    <!-- Login Page -->
    <?php if (!isset($_SESSION['username'])): ?>
    <div class="login-form">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <table class="input-group">
            <tr>
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
    </div>
    <?php endif; ?>

    <!-- Dashboard -->
    <?php if (isset($_SESSION['username'])): ?>
    <div class="dashboard">
        <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
        <a href="logout.php">Logout</a>
        <!-- <nav align="center">
        <ul>
            <li><a href="#about">About &nbsp; &nbsp;|</a></li>
            <li><a href="#portfolio">Portfolio &nbsp; &nbsp;|</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </nav> -->
        <?php if ($_SESSION['role'] == 'admin'): ?>
            <h3>Admin Dashboard</h3>
            <a href="view_users.php">View All Users</a>
        <?php else: ?>
            <h3>User Dashboard</h3>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- Letters Management -->
    <?php if (isset($_SESSION['username'])): ?>
    <div class="letters">
        <h2>Letters</h2>
        <?php
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM letters WHERE receiver='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>From: " . $row['sender'] . " - " . $row['subject'] . "</p>";
            }
        } else {
            echo "No letters received.";
        }
        ?>
    </div>
    <?php endif; ?>
</div>
</body>
</html>*/

