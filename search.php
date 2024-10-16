<?php
$student = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nic = $_POST['nic'];

    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "private_campus");

    // Check for connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get student details from the database
    $sql = "SELECT * FROM students WHERE nic='$nic'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
    } else {
        echo "No student found with NIC $nic.";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <title>Search Student</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body style="background-color:#d4edda; font-family: Arial, sans-serif; height: 100vh; margin: 0; display: flex; justify-content: center; align-items: center;" >

<div style="background-color: rgb(158, 220, 168); padding: 50px; border-radius: 10px; box-shadow: 0px 0px 0px rgba(0, 0, 0, 0); text-align: center; width: 130%; max-width: 300px;">


        <div class="form-container">
        <h1 style="color: rgb(22, 112, 80);text-align:center;">Spectrum Private Campus</h1>
        <h2 style="color: rgb(18, 86, 29);text-align:center;">Search Student by NIC</h2>
        <form action="search.php" method="POST">
            <input type="text" name="nic" placeholder="NIC" required style="width: 100%; padding: 10px; margin: 10px 0; border: 0px solid #ccc; border-radius: 5px; box-shadow: 0px 0px 5px rgba(0, 0, 0, 0);">


            <button type="submit" style="width: 105%; padding: 10px; background-color: rgb(22, 112, 80); color: white; border: none; border-radius: 8px; cursor:        pointer;">Search</button>

        </form>
        
        <?php if ($student) { ?>
        <h3>Student Details</h3>
        <p>Name: <?php echo $student['name']; ?></p>
        <p>Address: <?php echo $student['address']; ?></p>
        <p>Phone: <?php echo $student['tel_no']; ?></p>
        <p>Course: <?php echo $student['course']; ?></p>
        <?php } ?>
    </div>
</body>
</html>
