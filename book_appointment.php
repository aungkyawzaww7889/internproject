<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link href="./style.css" rel="stylesheet" type="text/css" />

</head>
<body>




<?php
    include 'db.php';
    session_start();

    if ($_SESSION['role'] !== 'patient') {
        echo "Access denied!";
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $doctor_id = $_POST['doctor_id'];
        $appointment_date = $_POST['appointment_date'];
        $patient_id = $_SESSION['userid'];

        $sql = "INSERT INTO appointments (doctor_id, patient_id, appointment_date) 
                VALUES ('$doctor_id', '$patient_id', '$appointment_date')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Appointment booked successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
?>



<div class="container">
    <form method="POST" action="">
        <label for="">Select Doctor: </label>
        <select name="doctor_id" required>
            <?php
                $sql = "SELECT id, username FROM users WHERE role='doctor'";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['username'] . "</option>";
                }
            ?>
        </select>
        <div class="form-group">
            <label for="">Appointment Date: </label>
            <input type="datetime-local" name="appointment_date" class="form-control" required />
        </div>

        <input type="submit" class="btn" value="Book Appointment">

    </form>
</div>

    


</body>
</html>