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

        $source=$_POST['source'];

        $item=$_POST['item'];
        $size=$_POST['size'];
        $min=$_POST['min'];
        if($min==null){$min=0;}
        $max=$_POST['max'];
        if($max==null){$max=0;}
        $quantity=$_POST['quantity'];
        if($quantity==null){$quantity=0;}
        $purchase_source=$_POST['purchase_source'];
        $warningquantity=$_POST['warningquantity'];
        if($warningquantity==null){$warningquantity=0;}

        $conn = mysqli_connect("localhost", "pi", "Sanguine045");
        $db = mysqli_select_db($conn, "Exotics");
        $query = mysqli_query($conn, "INSERT INTO Feeders (`Item`, `Size`, `Quantity`, `Min_Weight`, `Max_Weight`, `Source`, `Warning_Quantity`) VALUES ('$item', '$size', '$quantity', '$min', '$max', '$purchase_source', '$warningquantity')");
        $error = mysqli_error($conn);

        mysqli_close($conn); // Closing connection
    
echo('<body style="background-color:black;"><div style="text-align:center;padding-top: 10%; color:red;font-size:20px;">Error: '.$error.'</div><br>');
echo('<a href="./index.php"><button style="margin-left:48%;margin-right:48%;" class="cancelbtn">Back</button></a></body>');
header("Location: $source");
?>