<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="./style.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="container">
    <form action="" method="POST">
        <div class="form-group">
            <label for="">Username: </label>
            <input type="text" name="username" class="form-control" required />
        </div>

        <div class="form-group">
            <label for=""> Password:</label>
            <input type="password" name="password" class="form-control" required />
        </div>

        <input type="submit" class="btn loginbtn" value="Login" />
    </form>
</div>



<?php
    include 'db.php';
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['userid'] = $row['id'];
                $_SESSION['role'] = $row['role'];

                if($_SESSION['role'] === 'doctor'){
                    header("Location: manage_records.php");
                }elseif($_SESSION['role'] === 'patient'){
                    header("Location: book_appointment.php");
                }
            } else {
                echo "Invalid password!";
            }
        } else {
            echo "No user found!";
        }
        $conn->close();
    }
?>



    
</body>
</html>