<?php
include('city.php');
include('occupation.php');
include('restaurant.php');
//include connection file
include('connection.php');
   

//create in instance of class Connection
$connection = new Connection();


//call the selectDatabase method
$connection->selectDatabase('dorsiaDB1'); 

 //include the client file
 include('worker.php');

 
  //call the static selectAllClients method and store the result of the method in $clients
  $workers = Worker::selectAllWorkers('Workers',$connection->conn);
  if(isset($_POST['submit2'])){
    $workers = Worker::selectWorkerByCityId('Workers',$connection->conn,$_POST['city']);

  }
  else if(isset($_POST['submit3'])){
    $workers = Worker::selectWorkersByRestaurantId('Workers',$connection->conn,$_POST['restaurant']);

  }
   else if(isset($_POST['submit4'])){
    $workers = Worker::selectWorkerByOccupation('Workers',$connection->conn,$_POST['occupation']);

  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workers Interface</title>
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
                <li><a href="createWorker.php">WORKERS</a></li>
                    <li><a href="readWorker.php">DATA</a></li>
                    <li><a href="readClient.php">CLIENTS</a></li>
                    <li><a href="readRes.php">RESERVATIONS</a></li>
                    <li><a href="readDec.php">SUPPORT</a></li>
                    <li><a href="loginWorker.php">LOG OUT</a></li>
                </ul>
            </div>
        </nav>
    </section>
<h3>List of workers from database </h3>
<form method="post">
<div class="search-container">
    <div class="search-box-container">
        <i class="fas fa-search search-icon"></i>
        <select class="search-box" id="searchByCity" name="city">
            <option value="" disabled selected>Search by City</option>
            <?php
                        $cities=City::selectAllCities('Cities',$connection->conn);
                        foreach($cities as $city){
                                echo "<option value='$city[id]' >$city[name]</option>";

                        }
                    ?>
        </select>
        <button class="search-button" type="submit" name="submit2">Search</button>
    </div>
    <div class="search-box-container">
        <i class="fas fa-search search-icon"></i>
        <select class="search-box" id="searchByRestaurant" name="restaurant">
            <option value="" disabled selected>Search by Restaurant</option>
            <?php
                   
                        $restaurants=Restaurant::selectAllRestaurants('Restaurants',$connection->conn);
                        foreach($restaurants as $restaurant){
                                echo "<option value='$restaurant[id]' >$restaurant[name]</option>";

                        }
                    ?>
        </select>
        <button class="search-button" type="submit" name="submit3">Search</button>
    </div>
    <div class="search-box-container">
        <i class="fas fa-search search-icon"></i>
        <select class="search-box" id="searchByOccupation" name="occupation">
            <option value="" disabled selected>Search by occupation</option>
            <?php
              
                        $occupations=Occupation::selectAllOccupations('Occupations',$connection->conn);
                        foreach($occupations as $occupation){
                                echo "<option value='$occupation[id]' >$occupation[name]</option>";

                        }
                    ?>
        </select>
        <button class="search-button" type="submit" name="submit4">Search</button>
    </div>
</div>

</div>
                    </form>
<table class="table" id="table">
    <thead>
        <tr> 
            <th>Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>City</th>
            <th>Restaurant</th>
            <th>Occupation</th>
            <th>Registration Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

<?php





foreach($workers as $row) {
    
    $city = City::selectCityById('Cities',$connection->conn,$row['idCity']);
    $restaurant = Restaurant::selectRestaurantById('Restaurants',$connection->conn,$row['idRestaurant']);
    $occupation = Occupation::selectOccupationById('Occupations',$connection->conn,$row['idOccupation']);
   echo " <tr>
    <td>$row[id]</td>
    <td>$row[firstname]</td>
    <td>$row[lastname]</td>
    <td>$city[name]</td>
    <td>$restaurant[name]</td>
    <td>$occupation[name]</td>
    <td>$row[reg_date]</td>
    <td>
    <a class ='btn btn-success btn-sm' href='updateWorker.php?id=$row[id]'>edit</a>
    <a class ='btn btn-danger btn-sm' href='deleteWorker.php?id=$row[id]'>delete</a>
    </td>
</tr>";
}

?>
</tbody>
</table>
</div>
</body>
</html>