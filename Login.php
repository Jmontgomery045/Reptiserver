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
#echo('User: '.$_POST['uname'].'<br>');
#echo('Pass: '.$_POST['psw'].'<br>');
    if(empty($_POST['uname']) || empty($_POST['psw'])){
        $error = "Username or Password is Invalid";
    } else {
        $user=$_POST['uname'];
        $pass=$_POST['psw'];
        $conn = mysqli_connect("localhost", "pi", "Sanguine045");
        $db = mysqli_select_db($conn, "Exotics");
        $query = mysqli_query($conn, "SELECT Username FROM Users WHERE `Password`='$pass' AND Username='$user'");
        $rows = mysqli_num_rows($query);
        if($rows == 1){
            $_SESSION["user"] = $user;
            header("Location: ./Welcome.php");
        } else if ($rows == 0) {
            $error = "Username or Password is Invalid";
        } else {
            $error = "More than one user appears to exist (Just tell Josh)";
        }
        mysqli_close($conn); // Closing connection
    }
echo('<body style="background-color:black;"><div style="text-align:center;padding-top: 10%; color:red;font-size:20px;">Error: '.$error.'</div><br>');
echo('<a href="./index.php"><button style="margin-left:48%;margin-right:48%;" class="cancelbtn">Back</button></a></body>');
?>