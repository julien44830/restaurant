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
              echo '<div class="card anim h-100">';
              echo '<div class="photo-container">';
              echo '</div>';
              echo '<div class="card-body menu text-center">';
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
<<<<<<< HEAD
=======

	<div class="container height pt-5">
	<h2 class="text-center">Menus existants</h2>
	<div class="table-responsive">
		<table class="table">
			<thead>
					<tr>
							<th>Nom</th>
							<th>Description</th>
							<th>Prix</th>
							<th>Actions</th>
					</tr>
			</thead>
			<tbody>
				<?php
					if ($result_menu->num_rows > 0) {
						while($row = $result_menu->fetch_assoc()) {
							echo '<tr>';
							echo '<td>' . $row['nom'] . '</td>';
							echo '<td>' . $row['description'] . '</td>';
							echo '<td>' . $row['prix'] . '€</td>';
							echo '<td>';
							echo '<form method="POST">';
							echo '<input type="hidden" name="menu_id" value="' . $row['id'] . '">';
							echo '<button type="submit" name="delete_menu" class="btn btn-danger">Supprimer</button>';
							echo '</form>';
							echo '</td>';
							echo '</tr>';
						}
					}
				?>
			</tbody>
		</table>
	</div>

	<hr>
	<br>

	<h2 class="text-center">Plats existants</h2>
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th>type</th>
					<th>Nom</th>
					<th>Description</th>
					<th>Prix</th>
					<th>image</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php
					if ($result_plat->num_rows > 0) {
						while($row = $result_plat->fetch_assoc()) {
							echo '<tr>';
							echo '<td>' . $row['categorie'] . '</td>';
							echo '<td>' . $row['nom'] . '</td>';
							echo '<td>' . $row['description'] . '</td>';
							echo '<td>' . $row['prix'] . '€</td>';
							echo '<td><img src="assets/img/' . $row['image'] . '" class="img-thumbnail img-fluid max-width-1" style="max-width : 100px"></td>';
							echo '<td>';
							echo '<form method="POST">';
							echo '<input type="hidden" name="plat_id" value="' . $row['id'] . '">';
							echo '<button type="submit" name="delete_plat" class="btn btn-danger">Supprimer</button>';
							echo '</form>';
							echo '</td>';
							echo '</tr>';
						}
					}
					?>

			</tbody>
		</table>
	</div>

		<hr>

			<h2>Ajouter un menu</h2>
			<form method="POST" action="traitement_carte.php" >
				<div class="form-group">
					<label for="nom">Nom</label>
					<input type="text" class="form-control" name="nom" required>
				</div>
				<div class="form-group">
					<label for="description">Description</label>
					<input type="text" class="form-control" name="description" required>
				</div>
				<div class="form-group">
					<label for="prix">Prix</label>
					<input type="text" class="form-control" name="prix" required>
				</div>
				<button type="submit" name="add_menu" class="btn btn-primary">Ajouter</button>
			</form>
				
			<hr>

    	<h2>Ajouter un plat</h2>
    	<form method="POST" action="traitement_carte.php" enctype="multipart/form-data">
			
			<div class="form-group">
				<label for="categorie">type</label>
				<select name="categorie" id="categorie">
					<option value="entrée">entrée</option>
					<option value="plat">plat</option>
					<option value="dessert">dessert</option>
				</select>        
			</div>

        <div class="form-group">
          <label for="nom">Nom</label>
          <input type="text" class="form-control" name="nom" required>
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <input type="text" class="form-control" name="description" required>
        </div>
        <div class="form-group">
          <label for="prix">Prix</label>
          <input type="text" class="form-control" name="prix" required>
        </div>
        <div class="form-group">
          <label for="image">Image</label>
          <input type="file" class="form-control-file" name="image">
        </div>
        <button type="submit" name="add_plat" class="btn btn-primary">Ajouter</button>
    </form>
	</div>

	<?php
include 'templates/footer.php';
	?>










>>>>>>> 6f731976dc3980e4a846dc6d2df58519df220440
