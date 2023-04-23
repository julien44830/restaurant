<?php


if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
?>

<div class="container admin">

		
    <div class="row  gx-3">
        <?php
						$sql = "SELECT id, file_path, legend FROM images";
						$result = $conn->query($sql);
						
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								$legend = $row['legend'];
								echo '<div class="col-md-6 col-lg-4 pb-3">';
								echo '<img src="' . $row["file_path"] . '" alt="'.$legend.'" title="'.$legend.'" name="" class="img-fluid img-thumbnail custom-image">';
								echo '<a class="btn btn-danger" href="delete_img.php?id=' . $row["id"] . '">Supprimer</a>';
								echo '</div>';
							}
            }
        ?>
    </div>
		<br>
		<form class=" pb-5" action="upload.php" method="post" enctype="multipart/form-data">
			<input type="file" name="image">
			<label for="legend">Légende :</label>
			<input type="text" name="legend" id="legend">
			<input type="submit" name="submit" value="Upload">
		</form>
</div>

<?php

if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
?>

<div class="container admin">

    <!-- Ajout du formulaire pour les horaires d'ouverture et de fermeture -->
    <h2>Horaires d'ouverture et de fermeture</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <table>
        <tr>
          <th>Jour</th>
          <th>Ouverture</th>
          <th>Fermeture</th>
        </tr>
        <!-- Remplacez "jour" par le nom du jour de la semaine -->
        <!-- Répétez ce bloc pour chaque jour -->
        <?php foreach (['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'] as $jour): ?>
        <tr>
          <td><?php echo ucfirst($jour); ?></td>
          <td>
							<input type="time" name="" id="">
            </select>
          </td>
          <td>
          	<input type="time" name="" id="">
          </td>
        </tr>
        <?php endforeach; ?>
        <!-- Fin du bloc pour un jour -->
      </table>
      <button type="submit" name="submit_horaires">Enregistrer les horaires</button>
    </form>
    <br>
    
    <!-- Suite du code existant -->
    <div class="row  gx-3">
        <?php
            $sql = "SELECT id, file_path, legend FROM images";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $legend = $row['legend'];
                    echo '<div class="col-md-6 col-lg-4 pb-3">';
                    echo '<img src="' . $row["file_path"] . '" alt="'.$legend.'" title="'.$legend.'" name="" class="img-fluid img-thumbnail custom-image">';
                    echo '<a class="btn btn-danger" href="delete_img.php?id=' . $row["id"] . '">Supprimer</a>';
                    echo '</div>';
                }
            }
        ?>
    </div>
    <br>
		<form class="pb-5" action="upload.php" method="post" enctype="multipart/form-data">
      <input type="file" name="image">
      <label for="legend">Légende :</label>
      <input type="text" name="legend" id="legend">
      <input type="submit" name="submit" value="Upload">
    </form>
</div>

<?php
} else {
  header("Location: index.php");
}

?>






<?php
}else{
	header("Location: index.php");
}

?>