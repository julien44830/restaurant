<?php
include 'config/conn_bdd.php';

$username = $_POST['username'];
$email = $_POST['email'];
$lastname = $_POST['lastname'];
$tel = $_POST['tel'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if ($password !== $confirm_password) {
    echo "Les mots de passe ne correspondent pas.";
    exit;
}

$sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Nom d'utilisateur ou email déjà utilisé.";
    exit;
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, email, lastname, tel, password) VALUES ('$username', '$email', '$lastname', '$tel', '$hashed_password')";
if ($conn->query($sql) === TRUE) {
    session_start();
    $_SESSION['user_id'] = mysqli_insert_id($conn);
    $_SESSION['lastname'] = $lastname;

    header("Location: index.php");
    exit;
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
