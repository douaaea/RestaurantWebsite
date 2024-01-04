<?php
//include connection file
include('connection.php');
   

//create in instance of class Connection
$connection = new Connection();


//call the selectDatabase method
$connection->selectDatabase('dorsiaDB1');
$emailValue = "";
$lnameValue = "";
$fnameValue = "";
$passwordValue = "";
$errorMesage = "";
$successMesage = "";
if(isset($_POST["submit"])){

    $emailValue = $_POST["email"];
    $lnameValue = $_POST["lastName"];
    $fnameValue = $_POST["firstName"];
    $passwordValue = $_POST["password"];
    $idCityValue=$_POST["cities"];

    if(empty($emailValue) || empty($fnameValue) || empty($lnameValue) || empty($passwordValue)){

            $errorMesage = "all fileds must be filed out!";

    }else if(strlen($passwordValue) < 8 ){
        $errorMesage = "password must contains at least 8 char";
    }else if(preg_match("/[A-Z]+/", $passwordValue)==0){
        $errorMesage = "password must contains  at least one capital letter!";
    }else{
       
    
    //include the client file
    include('client.php');

    //create new instance of client class with the values of the inputs
    $client = new Client($fnameValue,$lnameValue,$emailValue,$passwordValue,$idCityValue);

//call the insertClient method
$client->insertClient('Clients',$connection->conn);

//give the $successMesage the value of the static $successMsg of the class
$successMesage = Client::$successMsg;

//give the $errorMesage the value of the static $errorMsg of the class
$errorMesage = Client::$errorMsg;

$emailValue = "";
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
  <link rel="stylesheet" href="signup11.css">
  <link rel="icon" href="images/logo3.png" />
  <title>Signup Client</title>
</head>
<body>

  <div class="signup-container">
    <div class="signup-box">
      <h1>Create your account</h1>
      <form id="signup-form" action="#" method="post">
        <label for="fullname">First Name</label>
        <input type="text" id="firstname" name="firstName" value="<?php echo $fnameValue ?>">

        <label for="fullname">Last Name</label>
        <input type="text" id="lastname" name="lastName" value="<?php echo $lnameValue ?>" >

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value=" <?php echo $emailValue ?>" >

    
        <label for="city">Select a city</label>
        <select id="city" name="cities" >
          <option value="" disabled selected>Select a city</option>
          <?php
                        include('city.php');
                        $cities=City::selectAllcities('Cities',$connection->conn);
                        foreach($cities as $city){
                                echo "<option value='$city[id]' >$city[name]</option>";

                        }
                    ?>
        </select>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" >
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
        <button name="submit" type="submit" class=" btn btn-primary">Sign up</button>

        
      </form>
      <p class="signup-link">Are you an employee? <a href="loginWorker.php">Workers Interface</a></p>
      <p class="login-link">Already have an account? <a href="loginClient.php">Log in</a></p>
    </div>
  </div>

  
</body>
</html>