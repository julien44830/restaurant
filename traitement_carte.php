<?php
include 'config/conn_bdd.php';
include 'config/start_session.php';

if (isset($_POST['add_plat'])) {
  $nom = $_POST['nom'];
  $description = $_POST['description'];
  $prix = $_POST['prix'];
  $image = '';
  $categorie = $_POST['categorie'];

  // Vérifier si un fichier a été téléchargé
  if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
      // Déplacer le fichier vers le dossier d'images
      $image_dir = 'assets/img/';
      $image = basename($_FILES['image']['name']);
      move_uploaded_file($_FILES['image']['tmp_name'], $image_dir . $image);
  }

  $sql = "INSERT INTO carte_plat (nom, description, prix, image, categorie) 
          VALUES ('$nom', '$description', '$prix', '$image', '$categorie')";

  if ($conn->query($sql) === TRUE) {
      header("Location: carte.php");
  } else {
      echo "Erreur : " . $sql . "<br>" . $conn->error;
  }
}

if (isset($_POST['add_menu'])) {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];


    $sql = "INSERT INTO carte_menu (nom, description, prix) 
            VALUES ('$nom', '$description', '$prix')";
  
    if ($conn->query($sql) === TRUE) {
        header("Location: carte.php");
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
  }
  


?>
