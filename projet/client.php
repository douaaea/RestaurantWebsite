<?php

class Client{

public $id;
public $firstname;
public $lastname;
public $email;
public $password;
public $reg_date; 

public $idCity;

public static $errorMsg = "";

public static $successMsg="";


public function __construct($firstname,$lastname,$email,$password,$idCity){

    //initialize the attributs of the class with the parameters, and hash the password
    $this->firstname = $firstname;
    $this->lastname = $lastname;
    $this->email = $email;
    $this->password = password_hash($password,PASSWORD_DEFAULT);
    $this->idCity=$idCity;

}

public function insertClient($tableName,$conn){

//insert a client in the database, and give a message to $successMsg and $errorMsg
$sql = "INSERT INTO $tableName (firstname, lastname, email,password,reg_date,idCity)
VALUES ('$this->firstname', '$this->lastname', '$this->email','$this->password','$this->reg_date','$this->idCity')";
if (mysqli_query($conn, $sql)) {
self::$successMsg= "Welcome to our family";

} else {
    self::$errorMsg ="Error: " . $sql . "<br>" . mysqli_error($conn);
}



}

public static function  selectAllClients($tableName,$conn){

//select all the client from database, and inset the rows results in an array $data[]
$sql = "SELECT id, firstname, lastname,email,password,reg_date,idCity FROM $tableName ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $data=[];
        while($row = mysqli_fetch_assoc($result)) {
        
            $data[]=$row;
        }
        return $data;
    }

}

static function selectClientById($tableName,$conn,$id){
    //select a client by id, and return the row result
    $sql = "SELECT firstname, lastname,email FROM $tableName  WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $row = mysqli_fetch_assoc($result);
    
    }
    return $row;
}

static function updateClient($client,$tableName,$conn,$id){
    //update a client of $id, with the values of $client in parameter
    //and send the user to read.php
    $sql = "UPDATE $tableName SET lastname='$client->lastname',firstname='$client->firstname',email='$client->email' WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
        self::$successMsg= "New record updated successfully";
header("Location:readClient.php");
        } else {
            self::$errorMsg= "Error updating record: " . mysqli_error($conn);
        }


}

static function deleteClient($tableName,$conn,$id){
    //delet a client by his id, and send the user to read.php
    $sql = "DELETE FROM $tableName WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    self::$successMsg= "Record deleted successfully";
    header("Location:readClient.php");
} else {
    self::$errorMsg= "Error deleting record: " . mysqli_error($conn);
}

  
    }


    public static function selectClientByCityId($tableName,$conn,$idCity){
    
        $sql = "SELECT id, firstname, lastname,email,password,reg_date,idCity FROM $tableName  WHERE idCity='$idCity'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $data=[];
        while($row = mysqli_fetch_assoc($result)) {
        
            $data[]=$row;
        }
        return $data;
     
    }


    }

  static function selectClientByLogin($tableName,$conn,$email,$password){
    session_start();
    $sql = "SELECT * FROM $tableName  WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $row=mysqli_fetch_assoc($result);
       if($row['email']===$email && password_verify($password, $row['password'])){
        $_SESSION['id'] = $row['id'];
        header("location: mainPage.php");
       }
       else{
            self::$errorMsg ="incorrect password";
        
       }
    
    }
    else{
        self::$errorMsg ="incorrect email";  
    }

}

}





?>
