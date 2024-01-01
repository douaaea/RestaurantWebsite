<?php

$emailValue = "";
$lnameValue = "";
$fnameValue = "";

$errorMesage = "";
$successMesage = "";

include('connection.php');
   

//create in instance of class Connection
$connection = new Connection();


//call the selectDatabase method
$connection->selectDatabase('dorsiaDB1');

    //include the client file
include('client.php');
if($_SERVER['REQUEST_METHOD']=='GET'){

    $id = $_GET['id'];

//call the staticbselectClientById method and store the result of the method in $row
$row=Client::selectClientById('Clients',$connection->conn,$id);

$emailValue = $row["email"];
$lnameValue = $row["lastname"];
$fnameValue = $row["firstname"];

}

else if(isset($_POST["submit"])){

    $emailValue = $_POST["email"];
    $lnameValue = $_POST["lastName"];
    $fnameValue = $_POST["firstName"];
   

    if(empty($emailValue) || empty($fnameValue) || empty($lnameValue) ){

            $errorMesage = "all fileds must be filed out!";

    }else{

        
        //create a new instance of client ($client) with inputs values
        $client = new Client($fnameValue,$lnameValue,$emailValue,'','');

        //call the static updateClient method and give $client in the parameters
        Client::updateClient($client,'Clients',$connection->conn, $_GET['id']);
            
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Clients</title>
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
        <h2>Update clients informations</h2>
        <br>
      
        <form method="post">
            <div class="row mb-3 ">
                <label class="col-form-label col-sm-1" for="name">First name</label>
                <div class="col-sm-6">
                    <input class="form-control" value="<?php echo $fnameValue ?>" type="name" id="name" name="firstName" >
                </div>
        </div>
        <div class="row mb-3 ">
                <label class="col-form-label col-sm-1" for="name">Last name</label>
                <div class="col-sm-6">
                    <input class="form-control" value="<?php echo $lnameValue ?>" type="text" id="name" name="lastName">
                </div>
        </div>

        <div class="row mb-3 ">
                <label class="col-form-label col-sm-1" for="Email">Email</label>
                <div class="col-sm-6">
                    <input class="form-control" value="<?php echo $emailValue ?>" type="text" id="Email" name="email">
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
            <div class="row mb-3">
            <div class="d-grid gap-2 col-6 mx-auto">
  <button class="btn btn-primary" type="submit" name="submit" >Update Client</button>
</div>
            </div>
        </form>