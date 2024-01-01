<?php

if($_SERVER['REQUEST_METHOD']=='GET'){

    $id=$_GET['id'];

include('connection.php');

$connection = new Connection();
$connection->selectDatabase('dorsiaDB1');

include('reservation.php');

Reservation::deleteReservation('Reservation',$connection->conn,$id);




}
?>