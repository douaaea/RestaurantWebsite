<?php
//include connection file
include('connection.php');
session_start();

//create in instance of class Connection
$connection = new Connection();


//call the selectDatabase method
$connection->selectDatabase('dorsiaDB1');
$dayValue = "";
$hourValue = "";
$fnameValue = "";
$phoneValue = "";
$errorMesage = "";
$successMesage = "";
if(isset($_POST["submit"])){

    $dayValue = $_POST["day"];
    $hourValue = $_POST["hour"];
    $fnameValue = $_POST["fullName"];
    $phoneValue=$_POST["phone"];
    $idClientValue=$_SESSION['id'];

    if(empty($dayValue) || empty($fnameValue) || empty($hourValue) || empty($phoneValue)){

            $errorMesage = "all fileds must be filed out!";

    }else{
       
    
    //include the resrvation file
    include('reservation.php');

    //create new instance of reservation class with the values of the inputs
    $reservation = new Reservation($dayValue,$hourValue,$fnameValue,$phoneValue,$idClientValue);

//call the insertReservation method
$reservation->insertReservation('Reservation',$connection->conn);

//give the $successMesage the value of the static $successMsg of the class
$successMesage = Reservation::$successMsg;

//give the $errorMesage the value of the static $errorMsg of the class
$errorMesage = Reservation::$errorMsg;


$fnameValue = "";
$phoneValue="";   
      
    }
}

?>
<!DOCTYPE html>

<html>
<head>
    <title>Dorsia</title>
    <link rel="icon" href="images/logo3.png" />
    <link rel="stylesheet" href="stylereser.css" />
</head>
<body>
    <section class="sub-header">
        <div><img src="images/logopng.png" id="logo"></div>
        <nav>
          
          <div class="nav-links">
            <ul>
            <li><a href="mainPage.php">HOME</a></li>
                <li><a href="AboutUs.php">ABOUT US</a></li>
                <li><a href="createRes.php">RESERVATIONS</a></li>
                <li><a href="menu.php">MENU</a></li>
                <li><a href="createDec.php">CONTACT</a></li>
                <li><a href="loginClient.php">LOG OUT</a></li>
            </ul>
          </div>
        </nav>
<section class="banner">
<h2>BOOK YOUR TABLE NOW</h2>
<div class="contenucard">
    <div class="imagecard">
    </div>
    <div class="content">
        <h3>Reservation</h3>
        
        <form  method="post">>
            <div class="formrow">
                <select name="day">
                    <option value="day-select">Select Day</option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                </select>
                <select name="hour">
                    <option value="hour-select">Select Hour</option>
                    <option value="12">12:00pm</option>
                    <option value="14">14:00pm</option>
                    <option value="16">16:00pm</option>
                    <option value="20">20:00pm</option>
                    <option value="22">22:00pm</option>
                    <option value="00">00:00pm</option>
                </select>
                <div class="formrow">
                    <input type="text" placeholder="Full Name" name="fullName">
                    <input type="text" placeholder="Phone Number" name="phone">
                    <input type="number" placeholder="How many person" min="1" max="6">
<?php

if(!empty($errorMesage)){
echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
<strong>$errorMesage</strong>
</div>";
}
if(!empty($successMesage)){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>$successMesage</strong>
    </div>";
                }
   ?>
                    <input type="submit" class="submit" value="BOOK TABLE" name="submit">
        
        </form>
    </div>
</div>
</section>

</body>
</html>