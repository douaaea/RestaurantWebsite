<?php
include('city.php');
//include connection file
include('connection.php');
   

//create in instance of class Connection
$connection = new Connection();


//call the selectDatabase method
$connection->selectDatabase('dorsiaDB1'); 

 //include the client file
 include('client.php');

 
  //call the static selectAllClients method and store the result of the method in $clients
  $clients = Client::selectAllClients('Clients',$connection->conn);

  if(isset($_POST['submit'])){
    $clients = Client::selectClientByCityId('Clients',$connection->conn,$_POST['cities']);
   
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients List</title>
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

        <h3>List of clients from database </h3>
        <div class="search-container">
            <div class="search-box-container">
                <i class="fas fa-search search-icon"></i>
                <select class="search-box" id="searchByCity" name="cities">
                    <option value="" disabled selected>Search by City</option>
                    <?php
                        $cities=City::selectAllCities('Cities',$connection->conn);
                        foreach($cities as $city){
                                echo "<option value='$city[id]' >$city[name]</option>";

                        }
                    ?>
                </select>
                <button class="search-button" type="submit" name="submit">Search</button>
            </div>

        </div>
    
        </div>
        <table class="table" id="table">
            <thead>
                <tr> 
                    <th>Client Id</th> 
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Registration Date</th>
                    <th>City</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

<?php





foreach($clients as $row) {
    
    $city = City::selectCityById('Cities',$connection->conn,$row['idCity']);
   echo " <tr>
    <td>$row[id]</td>
    <td>$row[firstname]</td>
    <td>$row[lastname]</td>
    <td>$row[email]</td>
    <td>$row[password]</td>
    <td>$row[reg_date]</td>
    <td>$city[name]</td>
    <td>
    <a class ='btn btn-success btn-sm' href='updateClient.php?id=$row[id]'>edit</a>
    <a class ='btn btn-danger btn-sm' href='deleteClient.php?id=$row[id]'>delete</a>
    </td>
</tr>";
}

?>
</tbody>
        </table>
    </div>
</body>
</html>