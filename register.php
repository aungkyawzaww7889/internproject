<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link href="./style.css" rel="stylesheet" type="text/css" />
</head>
<body>


<div class="container">
    <form method="POST" action="">

        <div class="form-group">
            <label for="username">Username :</label>
            <input type="text" name="username" class="form-control" required />
        </div>

        <div class="form-group">
            <label for="password">Password: </label>
            <input type="password" name="password" class="form-control" required />
        </div> 

        <label for="" class="role">Role: </label>
        <select name="role"  required>
            <option value="doctor">Doctor</option>
            <option value="patient">Patient</option>
        </select><br>

        <input type="submit" class="btn" value="Register" />

    </form>
</div>

<?php

    include 'db.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $role = $_POST['role'];

        $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }


?>


    
</body>
</html>