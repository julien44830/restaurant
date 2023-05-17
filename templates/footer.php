	<?php
include 'config/conn_bdd.php';
$sql = "SELECT * FROM horaires ORDER BY FIELD(jour_de_la_semaine, 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche')";
$result = mysqli_query($conn, $sql);
$horaires = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<footer class="footer-basic">

	<div class="marquee">
	<span>
    <?php foreach ($horaires as $horaire): ?>
        <?php $jour = ucfirst($horaire['jour_de_la_semaine']); ?>
        <?php $ouvertureMidi = substr($horaire['heure_ouverture_midi'], 0, 5); ?>
        <?php $fermetureMidi = substr($horaire['heure_fermeture_midi'], 0, 5); ?>
        <?php $ouvertureSoir = substr($horaire['heure_ouverture_soir'], 0, 5); ?>
        <?php $fermetureSoir = substr($horaire['heure_fermeture_soir'], 0, 5); ?>

        <?php if ($horaire['ferme_midi'] && $horaire['ferme_soir']): ?>
            <span><?php echo $jour . ' : Fermé toute la journée'; ?></span>
        <?php elseif ($horaire['ferme_midi']): ?>
            <span><?php echo $jour . ' : Fermé le midi ' . $ouvertureSoir . '-' . $fermetureSoir . ''; ?></span>
        <?php elseif ($horaire['ferme_soir']): ?>
            <span><?php echo $jour . ' :  ' . $ouvertureMidi . '-' . $fermetureMidi . ' Fermé le soir'; ?></span>
        <?php else: ?>
            <span><?php echo $jour . ' ' . $ouvertureMidi . '-' . $fermetureMidi; ?><?php if ($ouvertureSoir && $fermetureSoir) { echo ' ' . $ouvertureSoir . '-' . $fermetureSoir; } ?></span>
        <?php endif; ?>
    <?php endforeach; ?>
</span>



		
	</div>

	<div>
		<div>
			<div class="social">
				<a href="https://www.instagram.com/"><i class="icon ion-social-instagram fa fa-instagram"></i></a>
				<a href="https://www.snapchat.com/fr-FR"><i class="icon ion-social-snapchat fa fa-snapchat"></i></a>
				<a href="https://www.twitter.com"><i class="icon ion-social-twitter fa fa-twitter"></i></a>
				<a href="https://www.facebook.com/"><i class="icon ion-social-facebook fa fa-facebook"></i></a>
			</div>
			<ul class="list-inline">
				<li class="list-inline-item"><a href="index.php">Accueil</a></li>
				<li class="list-inline-item"><a href="reservation.php">Réservation</a></li>
				<li class="list-inline-item"><a href="mention_legales.php">Mention légales</a></li>
			</ul>
			<p class="copyright">LE QUAI ANTIQUE © 2023</p>
		</div>		
	</div>
	
</footer>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	</body>
</html>