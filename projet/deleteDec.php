<?php

if($_SERVER['REQUEST_METHOD']=='GET'){

    $id=$_GET['id'];

include('connection.php');

$connection = new Connection();
$connection->selectDatabase('dorsiaDB1');

include('declaration.php');

Declaration::deleteDeclaration('Declarations',$connection->conn,$id);




}
?>