<?php

class Worker{

public $id;
public $firstname;
public $lastname;
public $idOccupation;
public $reg_date; 

public $idCity;
public $idRestaurant;

public static $errorMsg = "";

public static $successMsg="";


public function __construct($id,$firstname,$lastname,$idOccupation,$idCity,$idRestaurant){

    //initialize the attributs of the class with the parameters
    $this->id=$id;
    $this->firstname = $firstname;
    $this->lastname = $lastname;
    $this->idOccupation=$idOccupation;
    $this->idRestaurant = $idRestaurant;
    $this->idCity=$idCity;

}

public function insertWorker($tableName,$conn){

//insert a worker in the database, and give a message to $successMsg and $errorMsg
$sql = "INSERT INTO $tableName (id,firstname, lastname,idOccupation,idCity,idRestaurant)
VALUES ('$this->id','$this->firstname', '$this->lastname','$this->idOccupation', '$this->idCity','$this->idRestaurant')";
if (mysqli_query($conn, $sql)) {
self::$successMsg= "New record created successfully";

} else {
    self::$errorMsg ="Error: " . $sql . "<br>" . mysqli_error($conn);
}



}

public static function  selectAllWorkers($tableName,$conn){

//select all the workers from database, and inset the rows results in an array $data[]
$sql = "SELECT id, firstname, lastname,reg_date,idOccupation,idCity,idRestaurant FROM $tableName ";
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

static function selectWorkerById($tableName,$conn,$id){
    //select a worker by id, and return the row result
    $sql = "SELECT id, firstname, lastname,reg_date,idOccupation,idCity,idRestaurant FROM $tableName  WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $row = mysqli_fetch_assoc($result);
    
    }
    return $row;
}

static function updateWorker($worker,$tableName,$conn,$id){
    //update a worker of $id, with the values of $worker in parameter
    //and send the user to read.php
    $sql = "UPDATE $tableName SET lastname='$worker->lastname',firstname='$worker->firstname',idOccupation='$worker->idOccupation' WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
        self::$successMsg= "New record updated successfully";
header("Location:readWorker.php");
        } else {
            self::$errorMsg= "Error updating record: " . mysqli_error($conn);
        }


}

static function deleteWorker($tableName,$conn,$id){
    //delet a worker by his id, and send the user to read.php
    $sql = "DELETE FROM $tableName WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    self::$successMsg= "Record deleted successfully";
    header("Location:readWorker.php");
} else {
    self::$errorMsg= "Error deleting record: " . mysqli_error($conn);
}

  
    }


    public static function selectWorkerByCityId($tableName,$conn,$idCity){
    
        $sql = "SELECT id, firstname, lastname,idOccupation,idCity,idRestaurant FROM $tableName  WHERE idCity='$idCity'";
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
    public static function selectWorkersByRestaurantId($tableName,$conn,$idRestaurant){
    
        $sql = "SELECT id, firstname, lastname,idOccupation,idCity,idRestaurant FROM $tableName  WHERE idRestaurant='$idRestaurant'";
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

    public static function selectWorkerByOccupation($tableName,$conn,$idOccupation){
    
        $sql = "SELECT id, firstname, lastname,idOccupation,idCity,idRestaurant FROM $tableName  WHERE idOccupation='$idOccupation'";
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

    static function selectWorkerByLogin($tableName,$conn,$id,$password,$idRestaurant){
     $row=Worker::selectWorkerById('Workers',$conn,$id);
           if($row['id']===$id && $row['idRestaurant']===$idRestaurant && $password==="admin123" ){
            header("location: createWorker.php");
           }
           else{
                self::$errorMsg ="incorrect id or password or departement";
            
           }
        
        }
       
    
    }


?>
