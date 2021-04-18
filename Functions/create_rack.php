<?php
session_start();
?>
<style>
/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 30px 20px;
  margin: 8px 0;
  border: 2px solid black;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

    .cancelbtn {
  width: auto;
  padding: 15px 20px;
  background-color: #f44336;
}
}


</style>
<?php

        $tubs=$_POST['tubs'];
        $size=$_POST['size'];
        $source=$_POST['source'];

        $conn = mysqli_connect("localhost", "pi", "Sanguine045");
        $db = mysqli_select_db($conn, "Exotics");
        $query = mysqli_query($conn, "INSERT INTO Racks (`Tub_Count`, `Tub_Size`) VALUES ('$tubs', '$size')");
        $error = mysqli_error($conn);

        mysqli_close($conn); // Closing connection
    
echo('<body style="background-color:black;"><div style="text-align:center;padding-top: 10%; color:red;font-size:20px;">Error: '.$error.'</div><br>');
echo('<a href="./index.php"><button style="margin-left:48%;margin-right:48%;" class="cancelbtn">Back</button></a></body>');
header("Location: $source");
?>