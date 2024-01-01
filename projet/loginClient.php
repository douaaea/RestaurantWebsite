<?php 
//include connection file
include('connection.php');

//create in instance of class Connection
$connection = new Connection();


//call the selectDatabase method
$connection->selectDatabase('dorsiaDB1');
$emailValue = "";
$passwordValue = "";
$errorMesage = "";

if(isset($_POST["submit"])){

  $emailValue = $_POST["email"];
  $passwordValue = $_POST["password"];

  if(empty($emailValue) || empty($passwordValue)){

          $errorMesage = "all fileds must be filed out!";

  }else{
       //include the client file
       include('client.php');
    //call the static selectAllClients method and store the result of the method in $clients
  $clients = Client::selectClientByLogin('Clients',$connection->conn,$emailValue,$passwordValue);  
  //give the $errorMesage the value of the static $errorMsg of the class
 $errorMesage = Client::$errorMsg;
 $emailValue = ""; 
 } 
  
}

      
    
     
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="logclient.css">
  <title>Log In Client</title>
</head>
<body>

  <div class="login-container">
    <div class="login-box">
      <h1>Welcome to Dorsia</h1>
      <form method="post">
        <label for="username">email:</label>
        <input type="email" id="username" name="email" >

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <?php

    if(!empty($errorMesage)){
  echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <strong>$errorMesage</strong>
  </div>";
    }
       ?>
        <button name="submit" type="submit">Log in</button>
      </form>
      <p class="signup-link">Are you an employee? <a href="loginWorker.php">Workers Interface</a></p>
      <p class="signup-link">Don't have an account? <a href="createclient.php">Sign up</a></p>
    </div>
  </div>

</body>
</html>