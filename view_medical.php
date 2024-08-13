<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Medical Records</title>
    <link href="./style.css" rel="stylesheet" type="text/css" />
</head>
<body>



    <div class="container">
        <?php
            include 'db.php';
            session_start();

            if ($_SESSION['role'] === 'doctor') {
                $userid = $_SESSION['userid'];
                $sql = "SELECT * FROM medical_records WHERE doctor_id='$userid'";
            } elseif ($_SESSION['role'] === 'patient') {
                $userid = $_SESSION['userid'];
                $sql = "SELECT * FROM medical_records WHERE patient_id='$userid'";
            } else {
                echo "Access denied!";
                exit();
            }

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "Paitent id ".$row["patient_id"]." : " . $row["record"]  . " By Doctor ID: " . $row["doctor_id"] . "<br>";
                }
            } else {
                echo "No medical_records found!";
            }

            $conn->close();
        ?>
    </div>

    
</body>
</html>