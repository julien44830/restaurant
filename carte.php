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


$selected_categorie = '';
  if ($conn === false) {
    die('Erreur de connexion à la base de données' . mysqli_connect_error());
  } else {
    if (isset($_POST['categorie'])) {
      $selected_categorie = $_POST['categorie'];
      if ($selected_categorie != '') {
        $sql = "SELECT * FROM carte_plat WHERE categorie = '$selected_categorie' ORDER BY nom ASC";
      } else {
        $sql = "SELECT * FROM carte_plat WHERE categorie IN ('entree', 'plat', 'dessert') ORDER BY categorie ASC, nom ASC";
      }
    } else {
      $sql = "SELECT * FROM carte_plat ORDER BY categorie ASC, nom ASC";
    }
    $resultat = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultat) > 0) {
      $categorie = '';
      while ($row = mysqli_fetch_assoc($resultat)) {
        if ($row['categorie'] != $categorie) {
          $categorie = $row['categorie'];
          echo '<h2>' . ucfirst($categorie) . '</h2>';
        } else if ($selected_categorie == $categorie && $categorie != '') {
          echo '<h2>' . ucfirst($categorie) . '</h2>';
        }
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
    } else {
      echo '<p>Aucun plat trouvé.</p>';
      echo '<br> ';
    }
  }
?>
<!-- Formulaire de sélection de catégorie -->
<form method="POST">
  <label for="categorie">Sélectionnez une catégorie :</label>
  <select name="categorie" id="categorie">
    <option value="">Toutes les catégories</option>
    <option value="entree">Entrée</option>
    <option value="plat">Plat</option>
    <option value="dessert">Dessert</option>
  </select>
  <button type="submit">Afficher</button>
</form>

</div> <!-- fermeture de la balise <div> contenant les éléments de la carte -->



  <?php
  }

  // include 'templates/footer.php';
?>
