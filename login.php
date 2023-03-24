<?php
include 'templates/head.php';
include 'templates/nav.php';
include 'templates/header.php';
include 'config/conn_bdd.php'
?>

<form action="login.php" method="post">
  Nom d'utilisateur: <input type="text" name="username"><br>
  Mot de passe: <input type="password" name="password"><br>
  <input type="submit" value="Se connecter">
</form>
<br/>
<button disabled="disabled"><a href="register.php">inscription</a></button>

<?php
include 'templates/footer.php';
include 'config/ctrl_conn.php';
?>