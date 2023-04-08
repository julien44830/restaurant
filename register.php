<?php
include 'templates/head.php';
include  'templates/nav.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
</head>
<body>
    <h2>Inscription</h2>
    <form action="register_action.php" method="post">
        <label for="username">Nom :</label>
        <input type="text" name="username" id="username" required><br><br>

        <label for="lastname">Prénom :</label>
        <input type="text" name="lastname" id="lastname" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="tel">téléphone:</label>
        <input type="phone" name="tel" id="phone" required><br><br>
        
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" id="password" required><br><br>
        
        <label for="confirm_password">Confirmer le mot de passe:</label>
        <input type="password" name="confirm_password" id="confirm_password" required><br><br>

        <label for="nb_default_user">nombre de personnes :</label>
        <input type="int" name="nb_default_user" id="nb_default_user" required><br><br>

        <label for="user_allergy">allergie :</label>
        <input type="text" name="user_allergy" id="user_allergy" required><br><br>

        
        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>

<?php
include 'templates/footer.php';
// include 'tamplates/ctrl_conn.php';
?>