<header class="position-fixed w-100">
		<nav class="navbar navbar-light  ">
				<a class="navbar-brand" href="index.php">LE QUAI ANTIQUE</a>
				<div class="d-flex ml-auto">
					<?php
					include 'config/start_session.php';

					if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
						echo '<p class="nav-link" >droit admin</p>';
					} elseif (isset($_SESSION['lastname'])) {
						$lastname = $_SESSION['lastname'];
						echo '<p class="nav-link d-none d-md-inline" href="logout.php">Bienvenue '. htmlspecialchars($lastname) . '</p>';
					} else {
						echo '<a class="nav-link d-none d-md-inline" href="login.php" id="connexion">Connexion/inscription</a>';
					}
					?>
				</div>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
						<ul class="navbar-nav">
								<li class="nav-item">
										<a class="nav-link" href="carte.php">Notre carte</a>
								</li>
								<li class="nav-item">
										<a class="nav-link" href="reservation.php">Réservez votre table</a>
								</li>
								<li class="nav-item">
										<a class="nav-link" href="tout_sur_nous.php">Tout sur nous</a>
								</li>

								<li>
									
								</li>
								<?php
									if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
										echo '<p class="nav-link" >droit admin</p>';
									} elseif (isset($_SESSION['lastname'])) {
										$lastname = $_SESSION['lastname'];
									} else {
										echo '<a class="nav-link  d-md-none" href="login.php" id="connexion">Connexion/inscription</a>';
									}
								?>


                <li>
                    <?php
                    if (isset($_SESSION['lastname'])) {
                        echo '<a class="nav-link" href="config/session_logout.php">Déconnexion</a>';
                    }
                    ?>
                </li>
						</ul>
				</div>
		</nav>
</header>
