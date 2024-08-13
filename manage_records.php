<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Records</title>
    <link href="./style.css" rel="stylesheet" type="text/css" />
</head>
<body>




<?php
    include 'db.php';
    session_start();

    if ($_SESSION['role'] !== 'doctor') {
        echo "Access denied!";
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $patient_id = $_POST['patient_id'];
        $record = $_POST['record'];
        $doctor_id = $_SESSION['userid'];

        $sql = "INSERT INTO medical_records (patient_id, doctor_id, record) 
                VALUES ('$patient_id', '$doctor_id', '$record')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Record saved successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
?>



<div class="container">
    <form method="POST" action="">
        <label for="">Select Patient: </label>
        <select name="patient_id" required>
            <?php
                $sql = "SELECT id, username FROM users WHERE role='patient'";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['username'] . "</option>";
                }
            ?>
        </select>

        <div class="form-group">
            <label for="">Medical Record: </label> 
            <textarea name="record" class="form-control" required></textarea>
        </div>

        <input type="submit" class="btn" value="Save Record" />
    </form>
</div>
    
</body>
</html>