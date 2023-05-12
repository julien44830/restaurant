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
            $sql = "SELECT heure_ouverture_midi, heure_fermeture_midi, heure_ouverture_soir, heure_fermeture_soir,ferme_midi, ferme_soir FROM horaires WHERE jour_de_la_semaine = '$jour'";
            $result = mysqli_query($conn, $sql);
            $horaires = mysqli_fetch_assoc($result);
            

if ($result) {
    // Création du tableau associatif des horaires
    $infos = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $jour = $row['jour_de_la_semaine'];
        $horaires = array(
            'ouverture_midi' => $row['heure_ouverture_midi'],
            'fermeture_midi' => $row['heure_fermeture_midi'],
            'ouverture_soir' => $row['heure_ouverture_soir'],
            'fermeture_soir' => $row['heure_fermeture_soir'],
            'ferme' => $row['ferme']
        );
        $infos[$jour] = $horaires;
        $restaurantFerme = isset($_POST['restaurant_ferme']) ? 1 : 0;

    }
}
?>

            <tr>
            <td><?php echo ucfirst($jour); ?></td>
                <td>
                    <select name="<?php echo $jour; ?>_ouverture_midi">
                    <option value="<?php echo $horaires['heure_ouverture_midi'] ?>"><?php echo substr($horaires['heure_ouverture_midi'], 0, 5) ?></option>
                        <?php for ($heure = 11; $heure <= 15; $heure++): ?>
                            <?php for ($minute = 0; $minute <= 45; $minute += 15): ?>
                                <?php $heure_affichee = sprintf("%02d", $heure) . ':' . sprintf("%02d", $minute); ?>
                                <option value="<?php echo $heure_affichee; ?>" <?php if ($horaires['heure_ouverture_midi'] == $heure_affichee) { echo 'selected'; } ?>>
                                    <?php echo $heure_affichee; ?>
                                </option>
                            <?php endfor; ?>
                        <?php endfor; ?>
                    </select>
                </td>
                <td>
                    <select name="<?php echo $jour; ?>_fermeture_midi">
                    <option value="<?php echo $horaires['heure_fermeture_midi'] ?>"><?php echo substr($horaires['heure_fermeture_midi'], 0, 5) ?></option>
                        <?php for ($heure = 11; $heure <= 15; $heure++): ?>
                            <?php for ($minute = 0; $minute <= 45; $minute += 15): ?>
                                <?php $heure_affichee = sprintf("%02d", $heure) . ':' . sprintf("%02d", $minute); ?>
                                <option value="<?php echo $heure_affichee; ?>" <?php if ($horaires['heure_fermeture_midi'] == $heure_affichee) { echo 'selected'; } ?>>
                                    <?php echo $heure_affichee; ?>
                                </option>
                            <?php endfor; ?>
                        <?php endfor; ?>
                    </select>
                </td>
                <td>
                    <select name="<?php echo $jour; ?>_ouverture_soir">
                    <option value="<?php echo $horaires['heure_ouverture_soir'] ?>"><?php echo substr($horaires['heure_ouverture_soir'], 0, 5) ?></option>
                        <?php for ($heure = 18; $heure <= 23; $heure++): ?>
                            <?php for ($minute = 0; $minute <= 45; $minute += 15): ?>
                                <?php $heure_affichee = sprintf("%02d", $heure) . ':' . sprintf("%02d", $minute); ?>
                                <option value="<?php echo $heure_affichee; ?>" <?php if ($horaires['heure_ouverture_soir'] == $heure_affichee) { echo 'selected'; } ?>>
                                    <?php echo $heure_affichee; ?>
                                </option>
                            <?php endfor; ?>
                        <?php endfor; ?>
                    </select>
                </td>
                <td>
                    <select name="<?php echo $jour; ?>_fermeture_soir">
                    <option value="<?php echo $horaires['heure_fermeture_soir'] ?>"><?php echo substr($horaires['heure_fermeture_soir'], 0, 5) ?></option>
                        <?php for ($heure = 18; $heure <= 23; $heure++): ?>
                            <?php for ($minute = 0; $minute <= 45; $minute += 15): ?>
                                <?php $heure_affichee = sprintf("%02d", $heure) . ':' . sprintf("%02d", $minute); ?>
                                <option value="<?php echo $heure_affichee; ?>" <?php if ($horaires['heure_fermeture_soir'] == $heure_affichee) { echo 'selected'; } ?>>
                                    <?php echo $heure_affichee; ?>
                                </option>
                            <?php endfor; ?>
                        <?php endfor; ?>
                    </select>
                </td>
            </tr>
            <tr>
            <td colspan="4">
    <label>
    <input type="checkbox" name="<?php echo $jour; ?>_restaurant_ferme_midi" <?php if ($horaires['ferme_midi']) { echo 'checked'; } ?>>
        Restaurant fermé midi
    </label>
</td>
<td colspan="4">
    <label>
    <input type="checkbox" name="<?php echo $jour; ?>_restaurant_ferme_soir" <?php if ($horaires['ferme_soir']) { echo 'checked'; } ?>>
        Restaurant fermé soir
    </label>
</td>


                    </tr>
                    <?php endforeach; ?>
                </table>
    <button type="submit" name="submit_horaires">Enregistrer les horaires</button>
</form>


  
</div>

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
