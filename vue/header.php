<header>
	<a href="<?php echo WEBROOT ?>Questionnaire/index"><img src="<?php echo WEBROOT ?>img/logo-nouas.png" alt=""></a>
	<h1>e-Co.Web Form</h1>
		
		 <span>
		 <?php 
		if (isset($userSession)) {
			echo "Bienvenue ".$userSession->getPrenom()." ".$userSession->getNom()." ";
			if ($userSession->getType() == 'Admin') {
				$statut = 'Administrateur';
			} elseif ($userSession->getType() == 'Membre') {
				$statut = 'Stagiaire';
			} else {
				$statut = 'Candidat';
			}
			echo "<br>(".$statut.")";
			echo '<br><a href="'.WEBROOT.'User/logout"><button id="btnAcceuil">Déconnection</button></a>';
		} ?>
		 
		 </span>
</header>