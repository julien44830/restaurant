<?php
include 'templates/head.php';
include 'templates/nav.php';
include 'templates/header.php';
include 'config/start_session.php';
include 'config/conn_bdd.php';

$sql = "SELECT * FROM carte_menu";
$result = $conn->query($sql);

$sql_plat = "SELECT * FROM carte_plat";
$result_plat = $conn->query($sql_plat);

if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
  include 'carte_admin.php';
  
  }else{

    ?>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8 text-center">
          <h2 class="m-5">nos menus</h2>
          <p>Il y en a pour toutes les faims</p>
        </div>
      </div>
      
      <div class="row">
        <?php
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo '<div class="col-md-4 mb-4">';
              echo '<div class="card">';
              echo '<div class="card-body">';
              echo '<h5 class="card-title">' . $row['nom'] . '</h5>';
              echo '<p class="card-text">' . $row['description'] . '</p>';
              echo '<p class="card-text">' . $row['prix'] . '€</p>';
              echo '</div>';
              echo '</div>';
              echo '</div>';                
            }
          }
        ?>
      </div>
    </div>

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8 text-center">
          <h2 class="m-5">nos plats</h2>
        </div>
      </div>
    
      <div class="row">
        <?php
          if ($result_plat->num_rows > 0) {
            while($row = $result_plat->fetch_assoc()) {
              echo '<div class="col-md-6 col-lg-4 my-4 ">';
              echo '<div class="wood card h-100">';
              echo '<h5 class="card-title text-center p-3">' . $row['nom'] . '</h5>';
              echo '<img src="assets/img/' . $row['image'] . '" class="card-img-top p-3 custom-image custom-image">';
              echo '<div class="card-body">';
              echo '<p class="card-text">' . $row['description'] . '</p>';
              echo '<p class="card-text text-right">' . $row['prix'] . '€</p>';
              echo '</div>';
              echo '</div>';
              echo '</div>';     
            }
          }
        ?>
      </div>
    </div>
  <?php
  }

  include 'templates/footer.php';
?>