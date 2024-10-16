<?php
$message = ''; // Message Variable
$form_submitted = false; // submitte or not

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_submitted = true; // Form submitted
    $nic = $_POST['nic'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $tel_no = $_POST['tel_no'];
    $course = $_POST['course'];

    
    $conn = new mysqli("localhost", "root", "", "private_campus"); // connect to the database

    // Checking errors with database
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Inserting students details to the database
    $sql = "INSERT INTO students (nic, name, address, tel_no, course) VALUES ('$nic', '$name', '$address', '$tel_no', '$course')";
    
    if ($conn->query($sql) === TRUE) {
        $message = "Registration successful! Welcome to Spectrum Private Campus!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <title>Register Student</title>
    <style>
        body {
            background-color: #d4edda;
            font-family: Arial, sans-serif;
        }
        .form-container {
            width: 350px;
            margin: 100px auto;
            padding: 20px;
            background-color:  rgb(158, 220, 168);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: rgb(22, 112, 80);
        }
        h2 {
            color: rgb(18, 86, 29);
            margin-bottom: 20px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            background-color: rgb(22, 112, 80);
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        button:hover {
            background-color: rgb(18, 86, 29);
        }
        .message-box {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
            color: white;
            background-color: #28a745; /* Green for success */
        }
        .error-box {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
            color: white;
            background-color: #dc3545;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Spectrum Private Campus</h1>
        <h2>Student Registration</h2>

        <form action="" method="POST">
            <input type="text" name="nic" placeholder="NIC" required><br>
            <input type="text" name="name" placeholder="Name" required><br>
            <input type="text" name="address" placeholder="Address" required><br>
            <input type="text" name="tel_no" placeholder="Phone Number" required><br>
            <input type="text" name="course" placeholder="Course" required><br>
            <button type="submit">Register</button>
        </form>

        <?php if ($form_submitted && $message): ?>
            <div class="<?= strpos($message, 'Error') === false ? 'message-box' : 'error-box' ?>">
                <?= $message; ?>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>
