<?php

class Declaration{

public $id;
public $name;
public $phone;
public $email;
public $subject;
public $message; 

public $idClient;

public static $errorMsg = "";

public static $successMsg="";


public function __construct($name,$phone,$email,$subject,$message,$idClient){

    //initialize the attributs of the class with the parameters
    $this->name = $name;
    $this->phone = $phone;
    $this->email = $email;
    $this->subject = $subject;
    $this->message=$message;
    $this->idClient=$idClient;

}

public function insertDeclaration($tableName,$conn){

//insert a declaration in the database, and give a message to $successMsg and $errorMsg
$sql = "INSERT INTO $tableName (name, phone, email,subject,message,idClient)
VALUES ('$this->name', '$this->phone', '$this->email','$this->subject','$this->message','$this->idClient')";
if (mysqli_query($conn, $sql)) {
self::$successMsg= "Thank You for Reaching Out!";

} else {
    self::$errorMsg ="Error: " . $sql . "<br>" . mysqli_error($conn);
}



}

public static function  selectAllDeclarations($tableName,$conn){

//select all the declarations from database, and inset the rows results in an array $data[]
$sql = "SELECT id, name, phone,email,subject,message,idClient FROM $tableName ";
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

static function selectDeclarationById($tableName,$conn,$id){
    //select a declaration by id, and return the row result
    $sql = "SELECT id,name, phone,email,subject,message,idClient FROM $tableName  WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $row = mysqli_fetch_assoc($result);
    
    }
    return $row;
}


static function deleteDeclaration($tableName,$conn,$id){
    //delet a declaration by his id, and send the user to read.php
    $sql = "DELETE FROM $tableName WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    self::$successMsg= "Record deleted successfully";
    header("Location:readDec.php");
} else {
    self::$errorMsg= "Error deleting record: " . mysqli_error($conn);
}

  
    }
    static function selectDeclarationByClientId($tableName,$conn,$idClient){
        //select a declaration by id, and return the row result
        $sql = "SELECT id,name, phone,email,subject,message,idClient FROM $tableName  WHERE idClient='$idClient'";
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



   
}

?>
