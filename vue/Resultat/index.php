<main>
	
	<section id="mainView">
	<?php 
	if (isset($_SESSION['type']) && ($_SESSION['type'] == 3 || $_SESSION['type'] == 4)) {
		foreach ($categories as $key => $categorie) {
			if ($_SESSION['lang'] == $categorie->getLang()) {
				echo "<article>
						<div><h3>".$categorie->getNom();
					echo "</h3>
						<p>".$categorie->getDescription()."</p></div>";
						

						echo "<div class='cat'>";
						foreach ($questionnaires as $key => $questionnaire) {
							if ($categorie->getId() == $questionnaire->getCategorie()) {
								echo "<a href='".WEBROOT."Resultat/view/". $questionnaire->getId()."'><div class='quest'>
									<h4>".$questionnaire->getNom()."</h4>
									<p>".$questionnaire->getIntro()."</p>
								</div></a>";	
							}
						}	
						echo "</div>
					</article>";
			}
		}
	}

	 ?>
	 </section>
</main>