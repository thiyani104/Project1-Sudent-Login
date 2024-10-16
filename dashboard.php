<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body style="background-color:#d4edda; font-family: Arial, sans-serif; height: 100vh; margin: 0; display: flex; justify-content: center; align-items: center;" >

    <div style="background-color: #f8f9fa; padding: 40px; border-radius: 15px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); text-align: center; width: 50%; max-width: 600px;">
        <h1 style="color: rgb(22, 112, 80);">Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <h2 style="color: rgb(18, 86, 29);">You are logged in.</h2>
    </div>

</body>


</html>
