<?php

//include the connection file
include('connection.php');

//create an instance of Connection class
$connection = new Connection();

//call the createDatabase methods to create database "chap4Db"
$connection->createDatabase('dorsiaDB1');
$query0 = "
CREATE TABLE Cities (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL
    )
";
$query1 = "
CREATE TABLE Clients (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50) UNIQUE,
password VARCHAR(80),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
idCity INT(6) UNSIGNED NOT NULL,
FOREIGN KEY (idCity) REFERENCES Cities(id)
)
";

$query2 = "
CREATE TABLE Reservation (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
resday VARCHAR(30) NOT NULL,
reshour VARCHAR(30) NOT NULL,
fullname VARCHAR(50) NOT NULL,
phone VARCHAR(30),
idClient INT(6) UNSIGNED NOT NULL,
FOREIGN KEY (idClient) REFERENCES Clients(id)
)
";

$query3 = "
CREATE TABLE Workers (
id INT(6) UNSIGNED PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
idCity INT(6) UNSIGNED NOT NULL,
idRestaurant INT(6) UNSIGNED NOT NULL,
idOccupation INT(6) UNSIGNED NOT NULL,
FOREIGN KEY (idCity) REFERENCES Cities(id),
FOREIGN KEY (idRestaurant) REFERENCES Restaurants(id),
FOREIGN KEY (idOccupation) REFERENCES Occupations(id)

)
";

$query4 = "
CREATE TABLE Declarations (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
phone VARCHAR(30) NOT NULL,
email VARCHAR(50) NOT NULL,
subject VARCHAR(80) NOT NULL,
message VARCHAR(100) NOT NULL,
idClient INT(6) UNSIGNED NOT NULL,
FOREIGN KEY (idClient) REFERENCES Clients(id)
)
";

$query5 = "
CREATE TABLE Restaurants (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
nbrTables INT(6) NOT NULL,
nbrWorkers INT(6) NOT NULL,
turnover DOUBLE PRECISION(10,4),
idCity INT(6) UNSIGNED NOT NULL,
FOREIGN KEY (idCity) REFERENCES Cities(id)
)
";
$query6 = "
CREATE TABLE Occupations (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL
    )
";

//call the selectDatabase method to select the chap4Db
$connection->selectDatabase('dorsiaDB1');

//call the createTable method to create table with the $query
$connection->createTable($query0);
$connection->createTable($query1);
$connection->createTable($query2);
$connection->createTable($query3);
$connection->createTable($query4);
$connection->createTable($query5);
$connection->createTable($query6);


?>

