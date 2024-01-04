<?php 
include('restaurant.php');
//include connection file
include('connection.php');
   

//create in instance of class Connection
$connection = new Connection();


//call the selectDatabase method
$connection->selectDatabase('dorsiaDB1');
$idValue = "";
$passwordValue = "";
$errorMesage = "";

if(isset($_POST["submit"])){

  $idValue = $_POST["id"];
  $passwordValue = $_POST["password"];
  $restaurantValue=$_POST['restaurants'];

  if(empty($idValue) || empty($passwordValue)){

          $errorMesage = "all fileds must be filed out!";

  }else{
       //include the worker file
       include('worker.php');
    //call the static selectAllWorkerByLogin method and store the result of the method in $workers
  $workers = Worker::selectWorkerByLogin('Workers',$connection->conn,$idValue,$passwordValue,$restaurantValue);  
  //give the $errorMesage the value of the static $errorMsg of the class
 $errorMesage = Worker::$errorMsg;

 $emailValue = ""; 
 } 
  
}

      
    
     
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="logWorker.css">
  <title>Company Login</title>
  <link rel="icon" href="images/logo3.png" />
</head>
<body>

  <div class="login-container">
    <div class="login-box">
      <img src="images\logopng.png" alt="logopng" class="logo">
      <h1>Employee Login</h1>
      <form id="login-form"  method="post">
        <label for="employeeId">Employee ID:</label>
        <input type="text" id="employeeId" name="id" >

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="city">Departement</label>
        <select id="city" name="restaurants" required>
          <option value="" disabled selected>Select your work place</option>
          <?php
                        
            $restaurants=Restaurant::selectAllRestaurants('Restaurants',$connection->conn);
                 foreach($restaurants as $restaurant){
                   echo "<option value='$restaurant[id]' >$restaurant[name]</option>";

                        }
                    ?>
        </select>
        <?php

if(!empty($errorMesage)){
echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
<strong>$errorMesage</strong>
</div>";
}
   ?>

        <div class="remember-me">
          <input type="checkbox" id="rememberMe" name="rememberMe">
          <label for="rememberMe">Remember me</label>
        </div>

        <button type="submit" name="submit">Log in</button>

        <span id="error-message" class="error-message"></span>
      </form>
      <p class="signup-link">Are you a client? <a href="loginClient.php">Log In</a></p>
    </div>
  </div>

  
</body>
</html>