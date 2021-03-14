<?php
session_start();

        $task=$_POST['task'];
        $frequency=$_POST['frequency'];
        $first_date=$_POST['first_date'];
        $animal = $_POST["animal"];

        $conn = mysqli_connect("localhost", "pi", "Sanguine045");
        $db = mysqli_select_db($conn, "Exotics");
        $query = mysqli_query($conn, "INSERT INTO Schedules (`Animal_ID`, `Task`, `Frequency`, `Last_Date`) VALUES ('$animal', '$task', '$frequency', '$first_date')");
        $query2 = mysqli_query($conn, "INSERT INTO Jobs (`Schedule_ID`, `Due_Date`) VALUES ((SELECT MAX(Schedule_ID) FROM Schedules), '$first_date')");
        $error = mysqli_error($conn);

        mysqli_close($conn); // Closing connection
    
echo('<body style="background-color:black;"><div style="text-align:center;padding-top: 10%; color:red;font-size:20px;">Error: '.$error.'</div><br><br>');
echo('<div style="text-align:center;padding-top: 10%; color:red;font-size:20px;">Animal ID: '.$animal.'</div><br><br>');
echo('<div style="text-align:center;padding-top: 10%; color:red;font-size:20px;">task: '.$task.'</div><br><br>');
echo('<div style="text-align:center;padding-top: 10%; color:red;font-size:20px;">frequency: '.$frequency.'</div><br><br>');
echo('<div style="text-align:center;padding-top: 10%; color:red;font-size:20px;">first_date: '.$first_date.'</div><br><br>');
echo('<a href="./index.php"><button style="margin-left:48%;margin-right:48%;" class="cancelbtn">Back</button></a></body>');
header("Location: /Reptiserver/Functions/view_animal.php?animal=$animal");
?>