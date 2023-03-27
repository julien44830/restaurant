<?php
include 'config/conn_bdd.php';

$username = $_POST['username'];
$email = $_POST['email'];
$lastname = $_POST['lastname'];
$tel = $_POST['tel'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$nb_default_user = $_POST['nb_default_user'];
$user_allergy = $_POST['user_allergy'];


if ($password !== $confirm_password) {
    echo "Les mots de passe ne correspondent pas.";
    exit;
}

$email = isset($_POST['email']) ? $_POST['email'] : "";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "L'email n'est pas valide.";
    exit;
}


$sql = "SELECT * FROM users WHERE email='$email '";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Un compte avec cet email existe déja !";
    exit;
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, email, lastname, tel, password, nb_default_user, user_allergy) VALUES ('$username', '$email', '$lastname', '$tel', '$hashed_password', '$nb_default_user', '$user_allergy')";
if ($conn->query($sql) === TRUE) {
    session_start();

    // Insérer l'utilisateur dans la base de données

// Récupérer l'id de l'utilisateur inscrit
$sql = "SELECT user_id FROM users WHERE email='$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row['user_id'];
}

    $_SESSION['username'] = $username;
    $_SESSION['lastname'] = $lastname;
    $_SESSION['nb_default_user'] = $nb_default_user;
    $_SESSION['user_allergy'] = $user_allergy;
    $_SESSION['tel'] = $tel;
    $_SESSION['user_id'] = $user_id;


    header("Location: index.php");
    exit;
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
