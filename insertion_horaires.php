<?php
// Vérification si le formulaire a été soumis
if (isset($_POST["submit_horaires"])) {
    // Récupération des horaires soumis dans le formulaire
    foreach (['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'] as $jour) {
        $heure_ouverture_midi = $_POST[$jour . '_ouverture_midi'];
        $heure_fermeture_midi = $_POST[$jour . '_fermeture_midi'];
        $heure_ouverture_soir = $_POST[$jour . '_ouverture_soir'];
        $heure_fermeture_soir = $_POST[$jour . '_fermeture_soir'];

        // Conversion des chaînes de caractères en objets DateTime
$date_ouverture_midi = DateTime::createFromFormat('H:i', $heure_ouverture_midi);
$date_fermeture_midi = DateTime::createFromFormat('H:i', $heure_fermeture_midi);
$date_ouverture_soir = DateTime::createFromFormat('H:i', $heure_ouverture_soir);
$date_fermeture_soir = DateTime::createFromFormat('H:i', $heure_fermeture_soir);

        // Vérification si des horaires existent déjà pour le jour en question
        $sql = "SELECT * FROM horaires WHERE jour_de_la_semaine = '$jour'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            // Les horaires existent, donc mise à jour des valeurs existantes
            $sql = "UPDATE horaires SET heure_ouverture_midi = '$heure_ouverture_midi', heure_fermeture_midi = '$heure_fermeture_midi', heure_ouverture_soir = '$heure_ouverture_soir', heure_fermeture_soir = '$heure_fermeture_soir' WHERE jour_de_la_semaine = '$jour'";
        } else {
            // Les horaires n'existent pas encore, donc insertion de nouvelles valeurs
            $sql = "INSERT INTO horaires (jour_de_la_semaine, heure_ouverture_midi, heure_fermeture_midi, heure_ouverture_soir, heure_fermeture_soir) VALUES ('$jour', '$heure_ouverture_midi', '$heure_fermeture_midi', '$heure_ouverture_soir', '$heure_fermeture_soir')";
        }

        // Exécution de la requête
        if (mysqli_query($conn, $sql)) {
        } else {
            echo "Erreur lors de la modification des horaires pour le $jour: " . mysqli_error($conn) . "<br>";
        }
    }
}

?>
