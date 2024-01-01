<?php
include('client.php');
//include connection file
include('connection.php');
   

//create in instance of class Connection
$connection = new Connection();


//call the selectDatabase method
$connection->selectDatabase('dorsiaDB1'); 

 //include the client file
 include('declaration.php');

 
  //call the static selectAllClients method and store the result of the method in $clients
  $declarations = Declaration::selectAllDeclarations('Declarations',$connection->conn);

  if(isset($_POST['submit'])){
    $declarations = Declaration::selectDeclarationByRestaurantId('Declarations',$connection->conn,$_POST['restaurant']);

  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Messages</title>
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
                    <li><a href="supportmanagement.html">SUPPORT</a></li>
                    <li><a href="employeelogin.html">LOG OUT</a></li>
                </ul>
            </div>
        </nav>
    </section>
<h3>Clients Requests and Messages </h3>
</div>

<div class="search-box-container">
    <i class="fas fa-search search-icon"></i>
    <select class="search-box" id="searchByRestaurant" name="restaurant">
        <option value="" disabled selected>Search by Restaurant</option>
        <?php
                        include('restaurant.php');
                        $restaurants=Restaurant::selectAllRestaurants('Restaurants',$connection->conn);
                        foreach($restaurants as $restaurant){
                                echo "<option value='$restaurant[id]' >$restaurant[name]</option>";

                        }
                    ?>
    </select>
    <button class="search-button" type="submit" name="submit">Search</button>
</div>
<table class="table" id="table">
    <thead>
        <tr> 
            <th>Client Id</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Subject</th>
            <th>Main Message</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

<?php





foreach($declarations as $row) {
    
   echo " <tr>
    <td>$row[idClient]</td>
    <td>$row[email]</td>
    <td>$row[phone]</td>
    <td>$row[subject]</td>
    <td>$row[message]</td>
    <td>
    <a class ='btn btn-danger btn-sm' href='deleteDec.php?id=$row[id]'>delete</a>
    </td>
</tr>";
}

?>
</tbody>
</table>
</div>
</body>
</html>