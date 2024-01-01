<?php


$lnameValue = "";
$fnameValue = "";


$errorMesage = "";
$successMesage = "";

include('connection.php');
   

//create in instance of class Connection
$connection = new Connection();


//call the selectDatabase method
$connection->selectDatabase('dorsiaDB1');

    //include the worker file
include('worker.php');
if($_SERVER['REQUEST_METHOD']=='GET'){

    $id = $_GET['id'];

//call the staticbselectWorkerById method and store the result of the method in $row
$row=Worker::selectWorkerById('Workers',$connection->conn,$id);


$lnameValue = $row["lastname"];
$fnameValue = $row["firstname"];
$idOccupationValue=$row["idOccupation"];

}

else if(isset($_POST["submit"])){

 
    $lnameValue = $_POST["lastName"];
    $fnameValue = $_POST["firstName"];
    $idOccupationValue=$_POST["occupation"];
   

    if(empty($idOccupationValue) || empty($fnameValue) || empty($lnameValue) ){

            $errorMesage = "all fileds must be filed out!";

    }else{

        
        //create a new instance of worker ($worker) with inputs values
        $worker = new Worker('',$fnameValue,$lnameValue,$idOccupationValue,'','');

        //call the static updateWorker method and give $worker in the parameters
        Worker::updateWorker($worker,'Workers',$connection->conn, $_GET['id']);
            
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Workers</title>
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
        <h2>Update Workers informations</h2>
        <br>
      
        <form method="post">
            <div class="row mb-3 ">
                <label class="col-form-label col-sm-1" for="name">First name</label>
                <div class="col-sm-6">
                    <input class="form-control" type="name" id="name" name="firstName" value="<?php echo $fnameValue ?>">
                </div>
        </div>
        <div class="row mb-3 ">
                <label class="col-form-label col-sm-1" for="name">Last name</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" id="name" name="lastName" value="<?php echo $lnameValue ?>">
                </div>
        </div>

        <div class="row mb-3">
            <label class="col-form-label col-sm-1" for="occupation">Occupation</label>
            <div class="col-sm-6">
                <select class="form-select" id="occupation" name="occupation">
                <option value="" disabled selected>Select an occupation</option>
          <?php
                        include('occupation.php');
                        $occupations=Occupation::selectAllOccupations('Occupations',$connection->conn);
                        foreach($occupations as $occupation){
                                echo "<option value='$occupation[id]' >$occupation[name]</option>";

                        }
                    ?>
                </select>
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
  <button class="btn btn-primary" type="submit" name="submit">Update Worker</button>
  
</div>
        </form>