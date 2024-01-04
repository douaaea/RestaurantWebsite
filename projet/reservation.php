<?php

class Reservation{

public $id;
public $resday;
public $reshour;
public $fullname;
public $phone;

public $idClient;

public static $errorMsg = "";

public static $successMsg="";


public function __construct($resday,$reshour,$fullname,$phone,$idClient){

    //initialize the attributs of the class with the parameters
    $this->resday = $resday;
    $this->reshour = $reshour;
    $this->fullname = $fullname;
    $this->phone = $phone;
    $this->idClient=$idClient;

}

public function insertReservation($tableName,$conn){

//insert a reservation in the database, and give a message to $successMsg and $errorMsg
$sql = "INSERT INTO $tableName (resday, reshour, fullname, phone, idClient)
VALUES ('$this->resday', '$this->reshour', '$this->fullname','$this->phone','$this->idClient')";
if (mysqli_query($conn, $sql)) {
self::$successMsg= "Thank you for choosing Dorsia";

} else {
    self::$errorMsg ="Error: " . $sql . "<br>" . mysqli_error($conn);
}



}

public static function  selectAllReservations($tableName,$conn){

//select all the reservations from database, and inset the rows results in an array $data[]
$sql = "SELECT id, resday, reshour, fullname, phone, idClient FROM $tableName ";
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

static function selectReservationByName($tableName,$conn,$fullname){
    //select a reservation by id, and return the row result
    $sql = "SELECT id,resday, reshour, fullname, phone, idClient FROM $tableName  WHERE fullname='$fullname'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $row = mysqli_fetch_assoc($result);
    
    }
    return $row;
}
static function selectReservationById($tableName,$conn,$id){
    //select a reservation by id, and return the row result
    $sql = "SELECT id,resday, reshour, fullname, phone, idClient FROM $tableName  WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $row = mysqli_fetch_assoc($result);
    
    }
    return $row;
}

static function updateReservation($reservation,$tableName,$conn,$id){
    //update a reservation of $id, with the values of $reservation in parameter
    //and send the user to read.php
    $sql = "UPDATE $tableName SET resday='$reservation->resday',reshour='$reservation->reshour',fullname='$reservation->fullname',phone='$reservation->phone' WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
        self::$successMsg= "New record updated successfully";
header("Location:readRes.php");
        } else {
            self::$errorMsg= "Error updating record: " . mysqli_error($conn);
        }


}

static function deleteReservation($tableName,$conn,$id){
    //delete a reservation by its id, and send the user to read.php
    $sql = "DELETE FROM $tableName WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    self::$successMsg= "Record deleted successfully";
    header("Location:readRes.php");
} else {
    self::$errorMsg= "Error deleting record: " . mysqli_error($conn);
}

  
    }


    public static function selectReservationByDay($tableName,$conn,$resday){
    
        $sql = "SELECT id, resday,reshour, fullname,phone,idClient FROM $tableName  WHERE resday='$resday'";
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
