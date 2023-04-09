<?php

$email = isset($_POST['email']) ? $_POST['email'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";

if (!empty($email) && !empty($password)) {
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        $username = $row['username'];
        $lastname = $row['lastname'];
        $tel = $row['tel'];
        $nb_default_user = $row['nb_default_user'];
        $user_allergy = $row['user_allergy'];
        $is_admin = $row['is_admin'];

        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['tel'] = $tel;
            $_SESSION['nb_default_user'] = $nb_default_user;
            $_SESSION['user_allergy'] = $user_allergy;
            $_SESSION['is_admin'] = $is_admin;

            header("Location: index.php");
        } else {
            echo '<script>alert("mot de passe incorrecte.");</script>'; 
        }
    } else {
        echo '<script>alert("adresse email inconue");</script>';
    }
}
?>