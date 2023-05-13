<?php
include 'templates/head.php';
include 'templates/nav.php';
include 'config/conn_bdd.php';

$sql = "SELECT * FROM horaires ORDER BY FIELD(jour_de_la_semaine, 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche')";
$result = mysqli_query($conn, $sql);
$horaires = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>



<div class="container height_time pb">
    <div class="row">
        <div class="col-12">
            <h2 class="m-5">
                Nos horaires d'ouverture:
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-8 col-lg-6 mx-auto">
            <ul class="list-unstyled">

                <?php foreach ($horaires as $horaire): ?>
                    <li>
                        <div class="d-flex justify-content-between">
                            <span><?php echo ucfirst($horaire['jour_de_la_semaine']); ?></span>
                            <?php if ($horaire['ferme_midi'] && $horaire['ferme_soir']): ?>
                                <span>Fermé toute le journée</span>
                            <?php elseif ($horaire['ferme_midi']): ?>
                                <span>Fermé le midi et ouvert de <?php echo substr($horaire['heure_ouverture_soir'], 0, 5); ?> à <?php echo substr($horaire['heure_fermeture_soir'], 0, 5); ?></span>
                            <?php elseif ($horaire['ferme_soir']): ?>
                                <span>Ouvert de <?php echo substr($horaire['heure_ouverture_midi'], 0, 5); ?> à <?php echo substr($horaire['heure_fermeture_midi'], 0, 5); ?> et fermé le soir</span>
                            <?php else: ?>
                                <span>
                                    Ouvert de <?php echo substr($horaire['heure_ouverture_midi'], 0, 5); ?> à <?php echo substr($horaire['heure_fermeture_midi'], 0, 5); ?>
                                    et de <?php echo substr($horaire['heure_ouverture_soir'], 0, 5); ?> à <?php echo substr($horaire['heure_fermeture_soir'], 0, 5); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endforeach; ?>

            </ul>
        </div>
    </div>
</div>

		<br>
		<div class="text-center">
			<ul class="list-unstyled ">
				<li>
					<div class="d-flex justify-content-center">
						<span>téléphone : </span>
						<span>06 00 00 00 00</span>
					</div>
				</li>
				<br>
				<li>
					<div class="d-flex justify-content-center ">
						<span>adresse : </span>
						<span><p class="mb-1"> 6 rue du cahteau</p><p class="m-1">73000 chambéry</p></span>
					</div>
				</li>


			</ul>
		</div>
	</div >
<?php
include 'templates/footer.php'
?>