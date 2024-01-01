<?php

class Restaurant{

    public $id;
    public $name;
    public $nbrTables;
    public $nbrWorkers;
    public $turnover;

    public $idCity;



    public static function selectAllRestaurants($tableName,$conn){
        $sql = "SELECT id, name, nbrTables, nbrWorkers, turnover, idCity  FROM $tableName ";
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

    public static function selectRestaurantById($tableName,$conn,$id){
        
        $sql = "SELECT * FROM $tableName  WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $row = mysqli_fetch_assoc($result);
    
    }
    return $row;
    }
}



?>