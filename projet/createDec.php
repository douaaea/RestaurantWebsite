<?php
//include connection file
include('connection.php');
session_start();

//create in instance of class Connection
$connection = new Connection();


//call the selectDatabase method
$connection->selectDatabase('dorsiaDB1');
$nameValue = "";
$phoneValue = "";
$emailValue = "";
$subjectValue = "";
$messageValue = "";
$errorMesage = "";
$successMesage = "";
if(isset($_POST["submit"])){

    $nameValue = $_POST["name"];
    $phoneValue = $_POST["phone"];
    $emailValue = $_POST["email"];
    $subjectValue = $_POST["subject"];
    $messageValue = $_POST["message"];
    $idClientValue=$_SESSION['id'];

    if(empty($nameValue) || empty($phoneValue) || empty($emailValue) || empty($subjectValue)|| empty($messageValue) ){

            $errorMesage = "all fileds must be filed out!";

    }else{
       
    
    //include the client file
    include('declaration.php');

    //create new instance of client class with the values of the inputs
    $declaration = new Declaration($nameValue,$phoneValue,$emailValue,$subjectValue,$messageValue,$idClientValue);

//call the insertClient method
$declaration->insertDeclaration('Declarations',$connection->conn);

//give the $successMesage the value of the static $successMsg of the class
$successMesage = Declaration::$successMsg;

//give the $errorMesage the value of the static $errorMsg of the class
$errorMesage = Declaration::$errorMsg;

$emailValue = "";
$nameValue = "";
$phoneValue = "";   
$subjectValue = "";   
$messageValue = "";   
      
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dorsia</title>
  <link rel="stylesheet" href="contact.css">
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
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
      
      </section>
    <div class="container">
        <h1>CONTACT US</h1>
        <p>We would love to respond to your queries.<br> Feel free to get in touch with us.</p>
     <div class="contact-box">
        <div class="contact-left">
           <h3>Send your request</h3>
            <form method="post">

                <div class="input-row">
                    <div class="input-group">
                       <label>Name</label>
                       <input type="text" placeholder="Aymane Douaa" name="name">
                    </div>
                    <div class="input-group">
                        <label>Phone</label>
                        <input type="text" placeholder="+212 624 835 942" name="phone">
                     </div>
                </div>
                <div class="input-row">
                    <div class="input-group">
                       <label>Email</label>
                       <input type="text" placeholder="Dorsia@gmail.com" name="email">
                    </div>
                    <div class="input-group">
                        <label>Subject</label>
                        <input type="text" placeholder="Your Message" name="subject">
                    </div>
                     </div>

                     <label>Message</label>
                     <textarea rows="5" placeholder="Your Message" name="message"></textarea>
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
                     <button type="submit" name="submit">SEND</button>
            </form>
        </div>
        <div class="contact-right">
            <h3>Reach Us</h3> 

            <table>
                <tr>
                    <td>Email</td>
                    <td>Dorsia@gmail.com</td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>+212 624 835 942</td>
                </tr>
                <tr>
                    <td>Adress</td>
                    <td>150 Piccadilly, London United Kingdom<br>
                        Bond Street ,Marrakesh<br>
                        Morocco  45500
                    </td>
                </tr>
            </table>

        </div>
     </div>
    </div>