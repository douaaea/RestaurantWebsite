<?php

$dayValue = "";
$hourValue = "";
$phoneValue = "";
$fnameValue = "";

$errorMesage = "";
$successMesage = "";

include('connection.php');
   

//create in instance of class Connection
$connection = new Connection();


//call the selectDatabase method
$connection->selectDatabase('dorsiaDB1');

    //include the client file
include('reservation.php');
if($_SERVER['REQUEST_METHOD']=='GET'){

    $id = $_GET['id'];

//call the staticbselectClientById method and store the result of the method in $row
$row=Reservation::selectReservationById('Reservation',$connection->conn,$id);

$dayValue = $row["resday"];
$hourValue = $row["reshour"];
$fnameValue = $row["fullname"];
$phoneValue = $row["phone"];

}

else if(isset($_POST["submit"])){

    $dayValue = $_POST["day"];
    $hourValue = $_POST["hour"];
    $fnameValue = $_POST["fullname"];
    $phoneValue = $_POST["phone"];

    if(empty($dayValue) || empty($fnameValue) || empty($hourValue) || empty($phoneValue) ){

            $errorMesage = "all fileds must be filed out!";

    }else{

        
        //create a new instance of reservation ($reservation) with inputs values
        $reservation = new Reservation($dayValue,$hourValue,$fnameValue,$phoneValue,'');

        //call the static updateReservation method and give $reservation in the parameters
        Reservation::updateReservation($reservation,'Reservation',$connection->conn, $_GET['id']);
            
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Reservation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="forms.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-3S9AojtYehBATPwj1rYStCVvz9bhKDopz4K0r53LxtsIw9d1GhFVBLLOyev7CAfa" crossorigin="anonymous">
    <link rel="icon" href="images/logo3.png" />
</head>
<body>
    
    <section class="sub-header">
        <div><img src="images/logopng.png" id="logo"></div>
        <nav>
            <div class="nav-links">
                <ul>
                    <li><a href="formworkers.html">WORKERS</a></li>
                    <li><a href="Listofworkers.html">DATA</a></li>
                    <li><a href="formclients.html">CLIENTS</a></li>
                    <li><a href="reservationManagement.html">RESERVATIONS</a></li>
                    <li><a href="contact.html">SUPPORT</a></li>
                    <li><a href="employeelogin.html">LOG OUT</a></li>
                </ul>
            </div>
        </nav>
    </section>

    <div class="container my-6 ">
        <h2>Update Reservation informations</h2>
        <br>
      
        <form method="post">

            <div class="row mb-3 ">
                <label class="col-form-label col-sm-1" for="day">Day</label>
                <div class="col-sm-6">
                    <select class="form-select"  value="<?php echo $dayValue ?>" id="day" name="day">
                        <option value="day-select">Select Day</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                    </select>
                </div>
        </div>
        <div class="row mb-3 ">
            <label class="col-form-label col-sm-1" for="hour">Hour</label>
            <div class="col-sm-6">
                <select class="form-select" id="hour" value="<?php echo $hourValue ?>" name="hour">
                    <option value="hour-select">Select Hour</option>
                    <option value="12">12:00pm</option>
                    <option value="14">14:00pm</option>
                    <option value="16">16:00pm</option>
                    <option value="20">20:00pm</option>
                    <option value="22">22:00pm</option>
                    <option value="00">00:00pm</option>
                </select>
            </div>
    </div>

            <div class="row mb-3 ">
                <label class="col-form-label col-sm-1" for="name">Full name</label>
                <div class="col-sm-6">
                    <input class="form-control" value="<?php echo $fnameValue ?>" type="name" id="name" name="fullname" >
                </div>
        </div>
        <div class="row mb-3 ">
                <label class="col-form-label col-sm-1" for="phone">Phone</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" id="phone" name="phone" value="<?php echo $phoneValue ?>">
                </div>
        </div>

       
        </div>
    </div>
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
    <div class="d-grid gap-2 col-6 mx-auto">
  <button class="btn btn-primary" type="submit" name="submit">Update Reservation</button>

</div>
        </form>