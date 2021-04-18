<?php
session_start();

        $schedule=$_POST['schedule'];

        $conn = mysqli_connect("localhost", "pi", "Sanguine045");
        $db = mysqli_select_db($conn, "Exotics");
        $query = mysqli_query($conn, "SELECT MAX(Job_ID) AS 'Job_ID' FROM Jobs WHERE Schedule_ID = '$schedule'");
        $error = mysqli_error($conn);

        
    
echo('<body style="background-color:black;"><div style="text-align:center;padding-top: 10%; color:red;font-size:20px;">Error: '.$error.'</div><br>');
echo('<br><br><div style="text-align:center;padding-top: 10%; color:red;font-size:20px;">Schedule_ID: '.$schedule.'</div><br>');

echo('<a href="./index.php"><button style="margin-left:48%;margin-right:48%;" class="cancelbtn">Back</button></a></body>');
while($row = $query->fetch_assoc()){
echo('<br><br><div style="text-align:center;padding-top: 10%; color:red;font-size:20px;">Job_ID: '.$row['Job_ID'].'</div><br>');
?>

<td><form method="post" name="auto_submit" action="/Reptiserver/Functions/action_job.php" style="margin:auto;"><input type="hidden" id="job" name="job" value="<?php echo $row['Job_ID']?>"><button type="submit" class="btn"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button></form></td>

<?php } mysqli_close($conn); // Closing connection?>
<script>
window.onload = function(){
  document.forms['auto_submit'].submit();
}
</script>