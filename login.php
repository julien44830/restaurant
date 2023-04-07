<?php
include 'templates/head.php';
include 'templates/nav.php';
include 'templates/header.php';
include 'config/conn_bdd.php';
include 'config/start_session.php';
include 'config/ctrl_conn.php';
?>


<form action="login.php" method="post">
  Email du compte : <input type="email" name="email" require><br>
  Mot de passe : <input type="password" name="password" ><br>
  <input type="submit" value="Se connecter">
</form>
<br/>
<button disabled="disabled"><a href="register.php">inscription</a></button>

<?php
include 'templates/footer.php';
?>