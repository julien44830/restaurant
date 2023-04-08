<?php
include 'templates/head.php';
include 'templates/nav.php';
include 'config/conn_bdd.php';
include 'config/start_session.php';
include 'config/ctrl_conn.php';
?>

<main class="container  admin">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Connexion</h5>
          <form action="login.php" method="post">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
              <label for="password">Mot de passe</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Se connecter</button>
          </form>
          <div class="mt-3">
            <p>Vous n'avez pas de compte ? <a href="register.php" class="btn btn-success">Inscrivez-vous</a>.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php
include 'templates/footer.php';
?>