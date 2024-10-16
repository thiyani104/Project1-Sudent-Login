<?php
$message = '';
$form_updated = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nic = $_POST['nic'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $tel_no = $_POST['tel_no'];
    $course = $_POST['course'];

    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "private_campus");

    // Check for connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update student details in the database
    $sql = "UPDATE students SET name='$name', address='$address', tel_no='$tel_no', course='$course' WHERE nic='$nic'";
    
    if ($conn->query($sql) === TRUE) {
        $message = "Student details updated successfully!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }

    $form_updated = true; // Set the form update flag to true

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <title>Update Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e6ffee;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: rgb(158, 220, 168);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h1 {
            color:  rgb(22, 112, 80); 
            margin-bottom: 20px;
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
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: rgb(18, 86, 29);
        }

        .message-box {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
            color: white;
            background-color: #28a745;
        }
        .error-box {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
            color: white;
            background-color: #dc3545;
        }  

        .form-container {
            margin-top: 20px;
        }

        .form-container form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

    </style>
</head>
<body>
    <div class="form-container">
        <h1>Spectrum Private Campus</h1>
        <h2>Update Student Details</h2>

        <form action="update.php" method="POST">
            <input type="text" name="nic" placeholder="NIC" required><br>
            <input type="text" name="name" placeholder="Name" required><br>
            <input type="text" name="address" placeholder="Address" required><br>
            <input type="text" name="tel_no" placeholder="Phone Number" required><br>
            <input type="text" name="course" placeholder="Course" required><br>
            <button type="submit">Update</button>
        </form>

       
        <?php if ($form_updated && $message): ?> // Show message when details updated
            <div class="<?= strpos($message, 'Error') === false ? 'message-box' : 'error-box' ?>">
                <?= $message; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
