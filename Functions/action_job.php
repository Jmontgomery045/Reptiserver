<?php
session_start();
        $conn = mysqli_connect("localhost", "pi", "Sanguine045");
        $job = $_POST['job'];
        $db = mysqli_select_db($conn, "Exotics");
        $query = mysqli_query($conn, "SELECT * FROM To_Do WHERE Job_ID = '$job'");
        $feederquery = mysqli_query($conn, "SELECT * FROM Feeders");
        $row = $query->fetch_assoc(); 

        $datetime = new DateTime('2013-01-22');
        $datetime->modify('+1 day');
        $tomorrow = $datetime->format('Y-m-d');

        if(!$job){
            header("Location: /Reptiserver/Welcome.php");
        }

?>

<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
    background-image: url("https://upload.wikimedia.org/wikipedia/commons/8/83/Retic3.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    }

/* Full-width input fields */
input[type=text], input[type=password], select, input[type=date], input[type=number] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

.MainContainer {
    display: block;
    text-align:center;
    padding: 10px 0;
    position: relative;
    border: 3px solid green;
    border-radius: 15px;
    font-size: 40px;
    color: Black;
    text-decoration: none;
    background-color: white;
    margin: 3%;
}

.detail {
    margin: 2%;
    font-size: 20px;
}

.buttons {
    font-size: 20px;
    margin-bottom:20px;
}

.buttons a {
    padding: 10px;
    color:white;
    font-size: 30px;
    border-radius: 10px;
}

/* Style buttons */
.btn {
  background-color: DodgerBlue; /* Blue background */
  border: none; /* Remove borders */
  border-radius: 10px;
  color: white; /* White text */
  padding: 12px 16px; /* Some padding */
  font-size: 16px; /* Set a font size */
  cursor: pointer; /* Mouse pointer on hover */
}

#feed{
    background-color:#C51616;
    border:solid #C51616 3px;
}

#water{
    background-color:#007FCD;
    border:solid #007FCD 3px;
}

#clean{
    background-color:#1ADFCD;
    border:solid #1ADFCD 3px;
}

#weigh{
    background-color:#8B18FE;
    border:solid #8B18FE 3px;
}

#measure{
    background-color:#DFF21D;
    border:solid #DFF21D 3px;
}

#check{
    background-color:#0BB920;
    border:solid #0BB920 3px;
}



/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}

/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: 2px solid black;
  cursor: pointer;
  width: 100%;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}

</style>
<body>

    <div class="MainContainer">
    

        <div style="font-size:20px;">
        ID: <?php echo $row['Animal_ID'] ?>
        </div>
    
        <div>
        <h1 style="font-size: 40px;"><?php echo $row['Name']?></h1>
        </div>
        <hr> 
        <div class="detail">
        <b><u>Species</b></u><br><?php echo $row['Common_Name'] ?>
        </div>
        <hr> 
        <div class="detail">
        <b><u>Task</b></u><br><?php echo $row['Task'] ?>
        </div>
        <hr> 
        <div class="detail">
        <b><u>Due Date</b></u><br><?php echo $row['Due_Date'] ?>
        <hr>
        <form action="/Reptiserver/Functions/action_job_now.php" method="post" style="margin:auto;">
        <?php
        if(substr($row['Task'],0,5) === 'Weigh'){
        echo '<label for="suborder"><b>Weight (grams):</b></label>';
        echo '<input type="number" id="weight" name="weight" placeholder="Weight" style="width:100%;">';
        echo '<hr>';
        }else{
        echo '<input type="hidden" id="weight" name="weight" value="0">';
        }

        if(substr($row['Task'],0,4) === 'Feed'){
        echo '<label for="feeder"><b>Feeder Item:</b></label>';
        echo '<select name="feeder" id="feeder">';
        while($feederrow = $feederquery->fetch_assoc()){

          if($feederrow["Size"]!=""){
          echo '<option value="' . $feederrow['Feeder_ID'] . '">' . $feederrow['Item'] . ' - ' . $feederrow['Size'] . '</option>';
          } else {
          echo '<option value="' . $feederrow['Feeder_ID'] . '">' . $feederrow['Item'] . '</option>'; 
          }

        }
        echo '</select>';
        echo '<hr>';
        echo '<label for="quantity"><b>Quantity Given:</b></label>';
        echo '<input type="number" id="quantity" name="quantity" placeholder="Quantity" style="width:100%;">';
        echo '<hr>';
        echo '<label for="taken"><b>Taken:</b></label>';
        echo '<select name="taken" id="taken">';
        echo '<option value="y">Yes</option>';
        echo '<option value="n">No</option>';
        echo '<option value="l">Left In</option>';
        echo '</select>';
        echo '<hr>';
        }else{
        echo '<input type="hidden" id="feeder" name="feeder" value="0">';
        echo '<input type="hidden" id="taken" name="taken" value="0">';
        }
        ?>

        <input type="hidden" id="job" name="job" value="<?php echo $job?>">
        <label for="suborder"><b>Notes:</b></label>
        <textarea id="notes" name="notes" rows="4" cols="50" placeholder="Notes" style="width:100%;"></textarea>
        <button type="submit" style="width:40%;margin-left: 30%;margin-right:30%" id="btn1"><b>Action</b></button>
        </form>
        <button style="width:40%;margin-left: 30%;margin-right:30%;background-color:darkred;" id="btn1"><b>Cancel</b></button>
        </div>
    </div>

<script>

function clicked(e)
{
    if(!confirm('Are you sure you wish to delete this schedule?')) {
        e.preventDefault();
    }
}

</script>

</body>