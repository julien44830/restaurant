<?php

$username = isset($_POST['username']) ? $_POST['username'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";

if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        $username = $row['username'];
        $lastname = $row['lastname'];
        $tel = $row['tel'];
        $nb_user = 0; 
        
        session_start();
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['tel'] = $tel;
        $_SESSION['nb_user'] = $nb_user;
    
        header("Location: index.php");
        } else {
            echo "Mot de passe incorrect";
        }
    } else {
        echo "Nom d'utilisateur incorrect";
    }

?>