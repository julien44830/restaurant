<?php
include("insertion_horaires.php"); 



if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
?>

<!-- Ajout du formulaire pour les horaires d'ouverture et de fermeture -->
<div class="container admin">

<!-- formulaire pour les horaires d'ouverture et de fermeture -->
<h2>Horaires d'ouverture et de fermeture</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <table>
        <tr>
            <th>Jour</th>
            <th>Ouverture midi</th>
            <th>Fermeture midi</th>
            <th>Ouverture soir</th>
            <th>Fermeture soir</th>
        </tr>
        <?php foreach (['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'] as $jour): ?>
            <?php
            // Récupération des horaires depuis la base de données pour le jour en cours
            $sql = "SELECT heure_ouverture_midi, heure_fermeture_midi, heure_ouverture_soir, heure_fermeture_soir FROM horaires WHERE jour_de_la_semaine = '$jour'";
            $result = mysqli_query($conn, $sql);
            $horaires = mysqli_fetch_assoc($result);
            ?>
            <tr>
                <td><?php echo ucfirst($jour); ?></td>
                <td>
                    <input type="time" name="<?php echo $jour; ?>_ouverture_midi" value="<?php echo $horaires['heure_ouverture_midi']; ?>">
                </td>
                <td>
                    <input type="time" name="<?php echo $jour; ?>_fermeture_midi" value="<?php echo $horaires['heure_fermeture_midi']; ?>">
                </td>
                <td>
                    <input type="time" name="<?php echo $jour; ?>_ouverture_soir" value="<?php echo $horaires['heure_ouverture_soir']; ?>">
                </td>
                <td>
                    <input type="time" name="<?php echo $jour; ?>_fermeture_soir" value="<?php echo $horaires['heure_fermeture_soir']; ?>">
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <button type="submit" name="submit_horaires">Enregistrer les horaires</button>
</form>
  
</div>

<?php

if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
?>

<div class="container admin">

    <br>
    

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