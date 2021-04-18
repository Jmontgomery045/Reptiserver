<?php
session_start();
        $conn = mysqli_connect("localhost", "pi", "Sanguine045");
        $animalid = $_POST['animal'] . $_GET['animal'];
        $db = mysqli_select_db($conn, "Exotics");
        $animalquerymale = mysqli_query($conn, "SELECT Animal_ID, `Name` FROM Animals WHERE Deceased <> 1 AND Gender = 'Male'");
        $animalqueryfemale = mysqli_query($conn, "SELECT Animal_ID, `Name` FROM Animals WHERE Deceased <> 1 AND Gender = 'Female'");

        $datetime = new DateTime('2013-01-22');
        $datetime->modify('+1 day');
        $tomorrow = $datetime->format('Y-m-d');

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

<!-- ################################## Create Breeding Plan ################################## -->

<div id="breeding_plan_create_modal" class="modal">
  
  <form class="modal-content animate" action="/Reptiserver/Functions/create_breeding_plan.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('breeding_plan_create_modal').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="../Rescources/Logo.png" alt="Avatar" style="width:40%">
    </div>

    <div class="container">

      <input type="hidden" id="source" name="source" value="/Reptiserver/Functions/view_breeding_plans.php">

      <label for="class"><b>Male:</b></label>
      <select name="male" id="male">
      <?php while($row = $animalquerymale->fetch_assoc()){?>
        <option value="<?php echo $row['Animal_ID']; ?>"><?php echo $row['Animal_ID']; ?> - <?php echo $row['Name']; ?></option>
      <?php } ?>
      </select>
      <br>

      <label for="class"><b>Female:</b></label>
      <select name="female" id="female">
      <?php while($row = $animalqueryfemale->fetch_assoc()){?>
        <option value="<?php echo $row['Animal_ID']; ?>"><?php echo $row['Animal_ID']; ?> - <?php echo $row['Name']; ?></option>
      <?php } ?>
      </select>

      <button type="submit">Create</button>
    </div>
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('breeding_plan_create_modal').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

<!-- ########################################################################################## -->

    <div class="MainContainer">

        <?php

        $breedingquery = mysqli_query($conn, "SELECT BP.Plan_ID, S.Common_Name AS 'Species', AF.`Name` AS 'Female', AM.`Name` AS 'Male', AF.Genetics AS 'Female_Genes', AM.Genetics AS 'Male_Genes' FROM Breeding_Plans BP JOIN Animals AM ON BP.Male = AM.Animal_ID JOIN Animals AF ON BP.Female = AF.Animal_ID JOIN Species S ON AM.Species_ID = S.Species_ID");

        ?>

        <div style="font-size:20px;">
        <b><u>Breeding Plans</u></b><br><br>
        </div>

        <table id="customers">
            <thead>
            <tr>
                <td>Species</td>
                <td>Participants</td>
                <td style="text-align:center;">Calc</td>
                <td>Delete</td>
            </tr>
            </thead>
            <tbody>
            <?php while($row = $breedingquery->fetch_assoc()){
                $species = $row['Species'];
                if (substr($species, -6)=="Python") {$subarea = "pythons";}
                else if (substr($species, -6)=="Gecko") {$subarea = "lizards";}

                if($species == "Royal Python"){$species = "ball-pythons";}
                else if($species == "Reticulated Python"){$species = "reticulated-pythons";}
                
                $malegenes = str_replace(',', '%2C', $row['Male_Genes']);
                $femalegenes = str_replace(',', '%2C', $row['Female_Genes']);
                ?>
            <tr>
                <td style="text-align: center;"><?php echo $row["Species"]; ?></td>
                <td style="text-align: center;"><?php echo $row["Male"]; ?> + <?php echo $row["Female"]; ?></td>
                <td><a href="https://www.morphmarket.com/c/reptiles/<?php echo $subarea; ?>/<?php echo $species; ?>/genetic-calculator/?s1=<?php echo $malegenes; ?>&s2=<?php echo $femalegenes; ?>"><div class="btn" style="background-color:green;"><i style="padding-left:3px;" class="fa fa-calculator" aria-hidden="true"></i></div></div></a></td>
                <td><form action="/Reptiserver/Functions/delete_breeding_plan.php" method="post"><input type="hidden" id="plan" name="plan" value="<?php echo $row["Plan_ID"]; ?>"><input type="hidden" id="source" name="source" value="/Reptiserver/Functions/view_breeding_plans.php"><button onclick="return clicked();" type="submit" class="btn" style="background-color:darkred;"><i class="fa fa-trash" aria-hidden="true"></i></button></form></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>

        <hr>

        <button onclick="document.getElementById('breeding_plan_create_modal').style.display='block'" style="width:40%;margin-left: 30%;margin-right:30%" id="btn1"><b>New Plan</b></button>
        </div>
    </div>

<script>

function clicked(e)
{
    if(!confirm('Are you sure you wish to delete this plan?')) {
        e.preventDefault();
    }
}

</script>

</body>