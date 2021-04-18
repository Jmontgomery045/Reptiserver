<?php
session_start();
        $conn = mysqli_connect("localhost", "pi", "Sanguine045");
        $db = mysqli_select_db($conn, "Exotics");
        $query = mysqli_query($conn, "SELECT Animal_ID, Job_ID, Due_Date, Common_Name, `Name`, Task FROM To_Do WHERE Completed <> 1 AND `Name` IS NOT NULL"); 
        $speciesquery = mysqli_query($conn, "SELECT Species_ID, Common_Name FROM Species");
        $speciesquery2 = mysqli_query($conn, "SELECT Species_ID, Common_Name FROM Species");
        $animalquery = mysqli_query($conn, "SELECT Animal_ID, `Name` FROM Animals WHERE Deceased <> 1");
        mysqli_close($conn); // Closing connection
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

    ul {
  list-style-type: none;
  margin: auto;
  width: 98%;
  padding: 1%;
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

/* Darker background on mouse-over */
.btn:hover {
  background-color: RoyalBlue;
}

li {
  display: block;
  text-align:center;
  padding: 10px 0;
  height:auto;
  position: relative;
  border: 3px solid green;
  border-radius: 15px;
  font-size: 40px;
  color: Black;
  text-decoration: none;
  background-color: white;
  margin: 3%;
}

.contents {
  font-size: 20px;
  padding: 10px 0;
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

/* Full-width input fields */
input[type=text], input[type=password], input[type=number], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
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

button:hover {
  opacity: 0.8;
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

}
</style>
<body>

 <!-- ###################################### View Animal ###################################### -->

<div id="animal_view_modal" class="modal">
  
  <form class="modal-content animate" action="/Reptiserver/Functions/view_animal.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('animal_view_modal').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="/Reptiserver/Rescources/Logo.png" alt="Avatar" style="width:40%">
    </div>

    <div class="container">
    <label for="animal"><b>Animal:</b></label>
      <select name="animal" id="animal">
        <?php while($row = $animalquery->fetch_assoc()){?>
          <option value="<?php echo $row["Animal_ID"]; ?>"><?php echo $row["Animal_ID"] . " - " . $row["Name"]; ?></option>
        <?php } ?>
      </select>
        
      <button type="submit">View</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('animal_view_modal').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

<!-- ########################################################################################## -->

<!-- ###################################### View Species ###################################### -->

 <div id="species_view_modal" class="modal">
  
  <form class="modal-content animate" action="/Reptiserver/Functions/view_species.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('species_view_modal').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="./Rescources/Logo.png" alt="Avatar" style="width:40%">
    </div>

    <div class="container">
    <label for="species"><b>Species:</b></label>
      <select name="species" id="species">
        <?php while($row = $speciesquery->fetch_assoc()){?>
          <option value="<?php echo $row["Species_ID"]; ?>"><?php echo $row["Common_Name"]; ?></option>
        <?php } ?>
      </select>
        
      <button type="submit">View</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('species_view_modal').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

<!-- ########################################################################################## -->

<!-- ###################################### Create Animal ###################################### -->

<div id="animal_create_modal" class="modal">
  
  <form class="modal-content animate" action="/Reptiserver/Functions/create_animal.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('animal_create_modal').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="./Rescources/Logo.png" alt="Avatar" style="width:40%">
    </div>

    <div class="container">
    <label for="species"><b>Species:</b></label>
      <select name="species" id="species">
        <?php while($row = $speciesquery2->fetch_assoc()){?>
          <option value="<?php echo $row["Species_ID"]; ?>"><?php echo $row["Common_Name"]; ?></option>
        <?php } ?>
      </select>

      <label for="name"><b>Name:</b></label>
      <input type="text" placeholder="insert name here" name="name" required>

      <label for="gender"><b>Gender:</b></label>
      <select name="gender" id="gender">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Female">Unknown</option>
      </select>
      
      <button type="submit">Create</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('animal_create_modal').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

<!-- ########################################################################################## -->

<!-- ###################################### Create Species ###################################### -->

<div id="species_create_modal" class="modal">
  
  <form class="modal-content animate" action="/Reptiserver/Functions/create_species.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('species_create_modal').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="./Rescources/Logo.png" alt="Avatar" style="width:40%">
    </div>

    <div class="container">
      <label for="class"><b>Class:</b></label>
      <input type="text" placeholder="class" name="class" required>

      <label for="order"><b>Order:</b></label>
      <input type="text" placeholder="order" name="order" required>

      <label for="suborder"><b>Suborder:</b></label>
      <input type="text" placeholder="suborder" name="suborder" required>

      <label for="family"><b>Family:</b></label>
      <input type="text" placeholder="family" name="family" required>

      <label for="genus"><b>Genus:</b></label>
      <input type="text" placeholder="genus" name="genus" required>

      <label for="species"><b>Species:</b></label>
      <input type="text" placeholder="species" name="species" required>

      <label for="common_name"><b>Common name:</b></label>
      <input type="text" placeholder="common name" name="common_name" required>
      
      <button type="submit">Create</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('species_create_modal').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

<!-- ########################################################################################## -->

<!-- ###################################### Create Feeder ##################################### -->

<div id="feeder_create_modal" class="modal">
  
  <form class="modal-content animate" action="/Reptiserver/Functions/create_feeder.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('feeder_create_modal').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="./Rescources/Logo.png" alt="Avatar" style="width:40%">
    </div>

    <div class="container">
      <input type="hidden" id="source" name="source" value="/Reptiserver/Welcome.php">

      <label for="item"><b>Item:</b></label>
      <input type="text" placeholder="item" name="item" required>

      <label for="size"><b>Size:</b></label>
      <input type="text" placeholder="size" name="size" >

      <label for="min"><b>Min Weight (grams):</b></label>
      <input type="number" placeholder="min" name="min" >

      <label for="max"><b>Max Weight (grams):</b></label>
      <input type="number" placeholder="max" name="max" >

      <label for="quantity"><b>Quantity:</b></label>
      <input type="text" placeholder="quantity" name="quantity" >

      <label for="purchase_source"><b>Source:</b></label>
      <input type="text" placeholder="source" name="purchase_source" required>
      
      <button type="submit">Create</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('feeder_create_modal').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

<!-- ########################################################################################## -->

<!-- ###################################### Create Rack ###################################### -->

<div id="rack_create_modal" class="modal">
  
  <form class="modal-content animate" action="/Reptiserver/Functions/create_rack.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('rack_create_modal').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="./Rescources/Logo.png" alt="Avatar" style="width:40%">
    </div>

    <div class="container">
      <input type="hidden" id="source" name="source" value="/Reptiserver/Welcome.php">
      <label for="class"><b>Number of Tubs:</b></label>
      <select name="tubs" id="tubs">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
      </select>
      <br>
      <label for="order"><b>Tub size (Litres):</b></label>
      <input type="number" placeholder="size" name="size" required>
      <button type="submit">Create</button>
    </div>
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('rack_create_modal').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

<!-- ########################################################################################## -->

<div class="navbar"><ul>
  <li style="margin: auto;font-size:20px; width:95%; float:middle;"><i class="fa fa-user"></i><br><?php echo(" &nbsp;".$_SESSION["user"]." ");?></li>
  <li style="margin-top:5%"><i class="fa fa-fw fa-eye"></i> View <br>
    <div class="contents">
      <button onclick="document.getElementById('animal_view_modal').style.display='block'" style="width:40%;margin-left: 30%;margin-right:30%" id="btn1"><b>Animal</b></button>
      <button onclick="gotoracks();" style="width:40%;margin-left: 30%;margin-right:30%" id="btn1"><b>Racks</b></button>
      <button onclick="gotofeeders();" style="width:40%;margin-left: 30%;margin-right:30%" id="btn1"><b>Feeders</b></button>
    </div></li> 

    <li><i class="fa fa-fw fa-plus"></i> Create <br>
    <div class="contents">
      <button onclick="document.getElementById('species_create_modal').style.display='block'" style="width:40%;margin-left: 30%;margin-right:30%" id="btn1"><b>Species</b></button>
      <button onclick="document.getElementById('animal_create_modal').style.display='block'" style="width:40%;margin-left: 30%;margin-right:30%" id="btn1"><b>Animal</b></button>
      <button onclick="document.getElementById('rack_create_modal').style.display='block'" style="width:40%;margin-left: 30%;margin-right:30%" id="btn1"><b>Rack</b></button>
      <button onclick="document.getElementById('feeder_create_modal').style.display='block'" style="width:40%;margin-left: 30%;margin-right:30%" id="btn1"><b>Feeder</b></button>
    </div></li>
  <li style="margin-top: 6%;font-size:20px; width:90%; float:centre;">
  <div>
    <table id="customers">
    <thead>
      <tr>
        <td>Name</td>
        <td>Task</td>
        <td>Action</td>
      </tr>
    </thead>
    <tbody>
    <?php while($row = $query->fetch_assoc()){?>
      <tr>
        <td><?php echo $row["Name"]; ?></td>
        <td><?php echo $row["Task"]; ?></td>
        <td><form method="post" action="/Reptiserver/Functions/action_job.php" style="margin:auto;"><input type="hidden" id="job" name="job" value="<?php echo $row["Job_ID"]?>"><button type="submit" class="btn"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button></form></td>
      </tr>
    <?php } ?>
    </tbody>
    </table>
  </div>
  </li> 
</ul></div>

</div>

<script>

function gotoracks() {
  window.location.href = './Functions/view_racks.php';
}

function gotofeeders() {
  window.location.href = './Functions/view_feeders.php';
}

</script>

</body>