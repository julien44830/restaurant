<?php
include 'templates/head.php';
include 'templates/nav.php';
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
      
      <div class="row  ">
        <?php
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo '<div class="col-md-4 mb-4 carte">';
              echo '<div class="card">';
              echo '<div class="photo-container">';
              echo '</div>';
              echo '<div class="card-body menu">';
              echo '<h5 class="card-title">' . $row['nom'] . '</h5>';
              echo '<p class="card-text text-center">' . $row['description'] . '</p>';
              echo '<br>';
              echo '<p class="card-text">' . $row['prix'] . '€</p>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              
            }
          }
        ?>
      </div>
    </div>

    <div class="container pb-5">
      <div class="row justify-content-center">
        <div class="col-md-8 text-center">
          <h2 class="m-5">nos plats</h2>
        </div>
      </div>
    
      <div class="row pb-5">
        <?php
          if ($result_plat->num_rows > 0) {
            while($row = $result_plat->fetch_assoc()) {
              echo '<div class="col-md-4 mb-4 carte">';
              echo '<div class="card">';
              echo '<div class="photo-container">';
              echo '<img src="assets/img/' . $row['image'] . '" class="card-img-top" alt="...">';
              echo '</div>';
              echo '<div class="card-body menu">';
              echo '<h5 class="card-title">' . $row['nom'] . '</h5>';
              echo '<p class="card-text text-center">' . $row['description'] . '</p>';
              echo '<br>';
              echo '<p class="card-text">' . $row['prix'] . '€</p>';
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
