<?php
include('restaurant.php');
//include connection file
include('connection.php');
   

//create in instance of class Connection
$connection = new Connection();


//call the selectDatabase method
$connection->selectDatabase('dorsiaDB1'); 

 //include the client file
 include('reservation.php');

 
  //call the static selectAllClients method and store the result of the method in $clients
  $reservations = reservation::selectAllReservations('Reservation',$connection->conn);

  if(isset($_POST['submit1'])){
    $reservations = Reservation::selectReservationByName('Reservation',$connection->conn,$_POST['name']);

  }
  if(isset($_POST['submit2'])){
    $reservations = Reservation::selectReservationByDay('Reservation',$connection->conn,$_POST['day']);

  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations Management</title>
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

        <h3>List of reservations from database </h3>
        <div class="search-container">
            <div class="search-box-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-box" id="searchByName" placeholder="Search by name" name="name">
                <button type="button" class="search-button" type="submit" name="submit1">Search</button>
            </div>
            <div class="search-box-container">
                <i class="fas fa-search search-icon"></i>
                <select class="search-box" id="searchByDay" name="day">
                    <option value="" disabled selected>Search by Day</option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                </select>
                <button  class="search-button" type="submit" name="submit2">Search</button>
            </div>

        </div>
    
        </div>
        <table class="table" id="table">
            <thead>
                <tr> 
                    <th>Resevation Id</th> 
                    <th>Day</th>
                    <th>Hour</th>
                    <th>Full Name</th>
                    <th>Phone Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            
            <tbody>


<?php





foreach($reservations as $row) {
    
   
   echo " <tr>
    <td>$row[id]</td>
    <td>$row[resday]</td>
    <td>$row[reshour]</td>
    <td>$row[fullname]</td>
    <td>$row[phone]</td>
  
    <td>
    <a class ='btn btn-success btn-sm' href='updateRes.php?id=$row[id]'>edit</a>
    <a class ='btn btn-danger btn-sm' href='deleteRes.php?id=$row[id]'>delete</a>
    </td>
</tr>";
}

?>
</tbody>
        </table>
    </div>
</body>
</html>