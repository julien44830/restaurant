<?php
include 'templates/head.php';
include 'templates/nav.php';
?>


<main class="container admin">
	<h2 class="card-title">Inscription</h2>
  <div class="row justify-content-center">
    <div class="col-md-6  p-b-5">
      <div class="card">
        <div class="card-body">

          <form action="register_action.php" method="post">
            <div class="form-group">
              <label for="username">Nom :</label>
              <input type="text" class="form-control" name="username" id="username" required>
            </div>

            <div class="form-group">
              <label for="lastname">Prénom :</label>
              <input type="text" class="form-control" name="lastname" id="lastname" required>
            </div>

            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" name="email" id="email" required>
            </div>

            <div class="form-group">
              <label for="tel">Téléphone:</label>
              <input type="phone" class="form-control" name="tel" id="phone" required>
            </div>

            <div class="form-group">
              <label for="password">Mot de passe:</label>
              <input type="password" class="form-control" name="password" id="password" required>
            </div>

            <div class="form-group">
              <label for="confirm_password">Confirmer le mot de passe:</label>
              <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
            </div>

            <div class="form-group">
              <label for="nb_default_user">Nombre de personnes :</label>
              <input type="int" class="form-control" name="nb_default_user" id="nb_default_user" required>
            </div>

            <div class="form-group">
              <label for="user_allergy">Allergie :</label>
              <input type="text" class="form-control" name="user_allergy" id="user_allergy" required>
            </div>

            <div class="form-group">
              <input type="submit" class="btn btn-success" value="S'inscrire">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>


<?php
include 'templates/footer.php';
// include 'tamplates/ctrl_conn.php';
?>