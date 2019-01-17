<header>
	<a href="<?php echo WEBROOT ?>Questionnaire/index"><img src="<?php echo WEBROOT ?>img/logo-nouas.png" alt=""></a>
		<?php 
		if (isset($userSession)) {
			echo "<p>Bienvenue ".$userSession->getPrenom()." ".$userSession->getNom()." ";
			if ($userSession->getType() == 'Admin') {
				$statut = 'Administrateur';
			} elseif ($userSession->getType() == 'Member') {
				$statut = 'Stagiaire';
			} else {
				$statut = 'Candidat';
			}
			echo "(".$statut.")</p>";

		}
		 ?>
		 <br><a href="<?php echo WEBROOT ?>Questionnaire/index">Acceuil</a>
</header>