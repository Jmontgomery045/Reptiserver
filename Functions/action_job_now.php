<?php
session_start();

        $notes=$_POST['notes'];
        $job=$_POST['job'];

        $conn = mysqli_connect("localhost", "pi", "Sanguine045");
        $db = mysqli_select_db($conn, "Exotics");
        $query = mysqli_query($conn, "UPDATE Jobs SET Completed = 1, Notes = '$notes' WHERE Job_ID = '$job'");
        $error = mysqli_error($conn);

        // set next scheduled job
        $query2 = mysqli_query($conn, "SELECT j.Schedule_ID, s.Frequency FROM Jobs j JOIN Schedules s ON j.Schedule_ID = s.Schedule_ID WHERE Job_ID = '$job'");
        $row = $query2->fetch_assoc();
        $query3 = mysqli_query($conn, "INSERT INTO Jobs (`Schedule_ID`, `Due_Date`) VALUES ('$row[Schedule_ID]', (SELECT curdate() + interval $row[Frequency] DAY))");

        mysqli_close($conn); // Closing connection
    
echo('<body style="background-color:black;"><div style="text-align:center;padding-top: 10%; color:red;font-size:20px;">Error: '.$error.'</div><br><br>');
echo('<div style="text-align:center;padding-top: 10%; color:red;font-size:20px;">Animal ID: '.$notes.'</div><br><br>');
echo('<div style="text-align:center;padding-top: 10%; color:red;font-size:20px;">task: '.$job.'</div><br><br>');
echo('<a href="./index.php"><button style="margin-left:48%;margin-right:48%;" class="cancelbtn">Back</button></a></body>');
header("Location: /Reptiserver/Welcome.php");
?>