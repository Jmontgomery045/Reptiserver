<?php
session_start();

        $schedule=$_POST['schedule'];

        $conn = mysqli_connect("localhost", "pi", "Sanguine045");
        $db = mysqli_select_db($conn, "Exotics");
        $query = mysqli_query($conn, "DELETE FROM Schedules WHERE Schedule_ID = '$schedule'");
        $error = mysqli_error($conn);

        mysqli_close($conn); // Closing connection
    
echo('<body style="background-color:black;"><div style="text-align:center;padding-top: 10%; color:red;font-size:20px;">Error: '.$error.'</div><br>');
echo('<br><br><div style="text-align:center;padding-top: 10%; color:red;font-size:20px;">Schedule_ID: '.$schedule.'</div><br>');
echo('<a href="./index.php"><button style="margin-left:48%;margin-right:48%;" class="cancelbtn">Back</button></a></body>');
header("Location: /Reptiserver/Functions/view_room_schedules.php");
?>