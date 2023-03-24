<header class="position-fixed w-100 top-0">
		<nav class="navbar navbar-light bg-light ">
				<a class="navbar-brand" href="index.php">Restaurant</a>
				<div class="d-flex ml-auto">
					<?php
					session_start();

					if (isset($_SESSION['user_id'])) {
						$lastname = $_SESSION['lastname'];
						echo '<p class="nav-link" href="logout.php">Bienvenue '. htmlspecialchars($lastname) . '</p>';
					} else {
						echo '<a class="nav-link" href="login.php" id="connexion">Connexion/inscription</a>';
					}
					?>
				</div>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
						<ul class="navbar-nav">
								<li class="nav-item">
										<a class="nav-link" href="#">Notre carte</a>
								</li>
								<li class="nav-item">
										<a class="nav-link" href="reservation.php">Réservez votre table</a>
								</li>
								<li class="nav-item">
										<a class="nav-link" href="tou_sur_nous.php">Tout sur nous</a>
								</li>
                <li>
                    <?php
                    if (isset($_SESSION['user_id'])) {
                        echo '<a class="nav-link" href="config/session_logout.php">Déconnexion</a>';
                    }
                    ?>
                </li>
						</ul>
				</div>
		</nav>
</header>

<?php
print_r($_SESSION)
?>