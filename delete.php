<?php
$message = ''; // success or error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nic = $_POST['nic'];
    
    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "private_campus");

    // Check for connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Deleting Process
    $sql = "DELETE FROM students WHERE nic = '$nic'";
    
    if ($conn->query($sql) === TRUE && $conn->affected_rows > 0) {
        // If the deletion is successful and at least one row was affected
        $message = "Student's details deleted successfully!";
    } else {
        // In case of error or if no record was found for the NIC
        $message = "Error: No student found with NIC '$nic' or an error occurred.";
    }

    $conn->close(); // Close the database connection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <title>Delete Student</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body style="background-color:#d4edda; font-family: Arial, sans-serif; height: 100vh; margin: 0; display: flex; justify-content: center; align-items: center;" >

<div style="background-color: rgb(158, 220, 168); padding: 50px; border-radius: 10px; box-shadow: 0px 0px 0px rgba(0, 0, 0, 0); text-align: center; width: 130%; max-width: 300px;">

    <div class="form-container">
        <h1 style="color: rgb(22, 112, 80);text-align:center;">Spectrum Private Campus</h1>
        <h2 style="color: rgb(18, 86, 29);text-align:center;">Delete Student's Information by NIC</h2>

        <form action="delete.php" method="POST">
            <input type="text" name="nic" placeholder="NIC" required style="width: 100%; padding: 10px; margin: 10px 0; border: 0px solid #ccc; border-radius: 5px; box-shadow: 0px 0px 5px rgba(0, 0, 0, 0);">
            <button type="submit" style="width: 105%; padding: 10px; background-color: rgb(22, 112, 80); color: white; border: none; border-radius: 8px; cursor: pointer;">Delete</button>
        </form>

        <!-- Display the message only if deletion occurred -->
        <?php if (!empty($message)): ?>
            <div style="margin-top: 20px; padding: 10px; border-radius: 5px; background-color: rgb(22, 112, 80); color: white;">
                <?= $message; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
