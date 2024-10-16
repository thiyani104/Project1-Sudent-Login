<?php
session_start();
$conn = new mysqli("localhost", "root", "", "private_campus"); // Setting up credentials to access to the database


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];  // This will be the NIC

    // check if the username and NIC match
    $sql = "SELECT * FROM students WHERE name = ? AND nic = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $username, $password);  // Binding name (username) and nic (password)
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Credentials are correct
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit;
    } else {
        // Invalid credentials
        $error = "Invalid Username or NIC!";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
<style>
    body {
        background-color: #e6ffee; 
        font-family: Arial, sans-serif;
        height:100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
    }
    .login-container {
        text-align: center;
        padding: 40px;
        margin: 0 auto;
        width: 400px;
        background-color: rgb(158, 220, 168);
        border-radius: 20px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    .login-container input[type="text"], .login-container input[type="password"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .login-container button {
        width: 100%;
        padding: 10px;
        background-color: rgb(22, 112, 80);
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .login-container button:hover {
        background-color: #45a049;
    }
</style>

<div class="login-container">
    <h1 style="color: rgb(22, 112, 80);">Spectrum Private Campus</h1>
    <h2 style="color: rgb(18, 86, 29);">Student Login</h2>

    
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?> // Display error message

    
    <form action="login.php" method="POST">
        <input type="text" name="username" placeholder="Enter Name (Username)" required><br>
        <input type="password" name="password" placeholder="Enter NIC (Password)" required><br>
        <button type="submit">Login</button>
    </form>
</div>
    
</body>
</html>
