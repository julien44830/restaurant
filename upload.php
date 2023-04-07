<?php
include 'config/conn_bdd.php';
include 'config/start_session.php';

// Vérifier si le formulaire a été soumis
if(isset($_POST['submit'])){
    
  // Récupérer les informations sur le fichier téléchargé
  $file_name = $_FILES['image']['name'];
  $file_tmp = $_FILES['image']['tmp_name'];
  $file_type = $_FILES['image']['type'];
  $file_size = $_FILES['image']['size'];
  $legend = $_POST['legend'];
  
  // Définir le dossier de destination pour le fichier téléchargé
  $target_dir = "assets/img/";
  $target_file = $target_dir . basename($file_name);
  
  // Vérifier si le fichier est valide
  $uploadOk = 1;
  
  // Vérifier si le fichier existe déjà dans le dossier de destination
  if (file_exists($target_file)) {
      echo "Le fichier existe déjà.";
      $uploadOk = 0;
  }
  
  // Vérifier la taille du fichier
  if ($file_size > 500000) {
      echo "Le fichier est trop volumineux.";
      $uploadOk = 0;
  }
  
  // Vérifier le type de fichier
  if($file_type != "image/jpeg" && $file_type != "image/png" && $file_type != "image/jpg") {
      echo "Seuls les fichiers JPG, JPEG et PNG sont autorisés.";
      $uploadOk = 0;
  }
  
  // Si toutes les vérifications sont OK, déplacer le fichier téléchargé vers le dossier de destination
  if ($uploadOk == 1) {
      if (move_uploaded_file($file_tmp, $target_file)) {
          // Enregistrer les informations de l'image dans la base de données
          $sql = "INSERT INTO images (file_name, file_size, file_type, file_path, created_at, legend) VALUES ('$file_name', '$file_size', '$file_type', '$target_file', NOW(), '$legend')";
          $conn->query($sql);

          header("Location: index.php");
      } else {
          echo "Erreur lors du téléchargement du fichier.";
      }
  }
}
?>
