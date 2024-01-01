<?php
//include connection file
include('connection.php');
   

//create in instance of class Connection
$connection = new Connection();


//call the selectDatabase method
$connection->selectDatabase('dorsiaDB1');
$idValue = "";
$lnameValue = "";
$fnameValue = "";
$errorMesage = "";
$successMesage = "";
if(isset($_POST["submit"])){

    $idValue = $_POST["id"];
    $lnameValue = $_POST["lastName"];
    $fnameValue = $_POST["firstName"];
    $idCityValue=$_POST["city"];
    $idRestaurantValue=$_POST["restaurant"];
    $idOccupationValue=$_POST["occupation"];

    if(empty($idValue) || empty($fnameValue) || empty($lnameValue)){

            $errorMesage = "all fileds must be filed out!";

    }else{
       
    
    //include the client file
    include('worker.php');

    //create new instance of client class with the values of the inputs
    $worker = new Worker($idValue,$fnameValue,$lnameValue,$idOccupationValue,$idCityValue,$idRestaurantValue);

//call the insertClient method
$worker->insertWorker('Workers',$connection->conn);

//give the $successMesage the value of the static $successMsg of the class
$successMesage = Worker::$successMsg;

//give the $errorMesage the value of the static $errorMsg of the class
$errorMesage = Worker::$errorMsg;

$idValue = "";
$lnameValue = "";
$fnameValue = "";   
      
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workers Interface</title>
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
                    <li><a href="createWorker.php">WORKERS</a></li>
                    <li><a href="readWorker.php">DATA</a></li>
                    <li><a href="readClient.php">CLIENTS</a></li>
                    <li><a href="readRes.php">RESERVATIONS</a></li>
                    <li><a href="readDec.php">SUPPORT</a></li>
                    <li><a href="loginWorker.php">LOG OUT</a></li>
                </ul>
            </div>
        </nav>
    </section>

    <div class="container my-6 ">
        <h2>Add Worker</h2>
        <br>
      
        <form method="post">
            <div class="row mb-3">
                <label class="col-form-label col-sm-1" for="name">Id</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" id="name" name="id" >
                </div>
            </div>
            <div class="row mb-3 ">
                <label class="col-form-label col-sm-1" for="name">First name</label>
                <div class="col-sm-6">
                    <input class="form-control" type="name" id="name" name="firstName" >
                </div>
        </div>
        <div class="row mb-3 ">
                <label class="col-form-label col-sm-1" for="name">Last name</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" id="name" name="lastName">
                </div>
        </div>
        <div class="row mb-3 ">
                <label class="col-form-label col-sm-1" for="city">City</label>
                <div class="col-sm-6">
                <select class="form-select" id="city" name="city">
                <option value="" disabled selected>Select a city</option>
          <?php
                        include('city.php');
                        $cities=City::selectAllCities('Cities',$connection->conn);
                        foreach($cities as $city){
                                echo "<option value='$city[id]' >$city[name]</option>";

                        }
                    ?>
                </select>
                </div>
        </div>

        <div class="row mb-3 ">
            <label class="col-form-label col-sm-1" for="restaurant">Restaurant</label>
            <div class="col-sm-6">
            <select class="form-select" id="restaurant" name="restaurant">
                <option value="" disabled selected>Select a restaurant</option>
          <?php
                        include('restaurant.php');
                        $restaurants=Restaurant::selectAllRestaurants('Restaurants',$connection->conn);
                        foreach($restaurants as $restaurant){
                                echo "<option value='$restaurant[id]' >$restaurant[name]</option>";

                        }
                    ?>
                </select>
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
  <button class="btn btn-primary" type="submit" name="submit">Add Worker</button>

</div>
            
        </form>