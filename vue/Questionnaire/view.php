<main>
	<section>
		<h1>Questionnaire</h1>
		<article>
		<?php
			/*echo "<pre>";
			var_dump($listReponses);
			echo "</pre>";*/

			if (isset($quest) && $quest->getId() != 0) {
				echo "QUESTIONNAIRE<br>";
				echo "id : ".$quest->getId()."<br>"."nom : ".$quest->getNom()."<br>"."intro : ".$quest->getIntro()."<br>"."formateur : ".$quest->getFormateur()."<br>"."categorie : ".$quest->getCategorie()."<br><br>";
			} else {
				echo "questionnaire non crée";
		 	}
		
		 	
		 	if (!empty($listQuestions) && !empty($listReponses)) {
				echo "<br><br>LIST QUESTIONS<br>";
				foreach ($listQuestions as $key => $question) {
					echo "<hr>";
					echo "id : ".$question->getId()."<br>";
					echo "type : ".$question->getType()."<br>";
					echo "question : ".$question->getQuestion()."<br>";
					echo "questionnaire : ".$question->getQuestionnaire()."<br>";
					echo "aide : ".$question->getAide()."<br><br>";
					echo "réponses : "."<br>";

					foreach ($listReponses as $key => $reponse) {
						if ($question->getId() == $reponse->getQuestion()) {
							echo $reponse->getReponse()."<br>";
						}

					}
					echo "<br>";
				}
				echo "<hr>";
			}
		?>
		</article>

		<article>
		<?php
			/*TODO: début du if !empty($_SESSION))
			* if (!empty($_SESSION)) {
			* puis vérifie si $_SESSION['type'] existe
			* puis vue si le type de session est admin
			*/
	 		if (!empty($_SESSION['type'])) {
		 		if ($_SESSION['type'] == 'Admin') {
		?>
			<form action="<?php echo WEBROOT ?>Questionnaire/addQuestion" method="post">
				<input type="radio" name="type" value="0"> Question simple <br>
				<input type="radio" name="type" value="1"> QCM <br>
				<input name="question" type="text" placeholder="Entrez votre question">
				<input name="aide" type="text" placeholder="Entrez une aide"><br>
				<input type="hidden" name="questId" value="<?php echo $quest->getId() ?>">
				<input type="hidden" name="nbRep" id="nbRep" value="">
				<div id="questQview"></div>
				<button type='button' id="btnRep" onclick="addRep()">Ajouter réponse</button><button type='button' id="btnRemoveRep" onclick="removeLastRep()">Enlever réponse</button> <br><br>
				<input type="submit" value="Save question" id="btnQuestion">
			</form>
			<a href="<?php echo WEBROOT ?>Questionnaire/view/<?php echo $quest->getId(); ?>">
			<button>finaliser</button></a>
			<?php
				}

			// AFFICHAGE SI UTILISATEUR AUTRE QUE ADMINISTRATEUR
			} else {
			?>
			<form action="<?php echo WEBROOT ?>Questionnaire/sendQuestionnaire" method="post">
				<?php
				if (!empty($listQuestions) && !empty($listReponses)) {
					echo "<br><br>LIST QUESTIONS<br>";
					$i = 0;
					foreach ($listQuestions as $key => $question) {
						echo "<hr>";
						echo "questionnaire : ".$question->getQuestionnaire()."<br>";
						echo "id : ".$question->getId()."<br>";
						//hidden input storing each question's id
						echo '<input type="hidden" name="questionsId" value="' . $question->getId() . '">';
						echo "question : ".$question->getQuestion()."<br>";
						
						echo "aide : ".$question->getAide()."<br><br>";

						/*affichage au dépend de l'id du type de question à afficher
						* 0 = réponse simple
						* 1 = question à choix unique (radio)
						* 2 = question à choix multiples (checkbox)
						*/
						switch ($question->getType()) {
							case 0 :
								echo '<inpu type="text" name="reponse" placeholder="Veuillez entrez votre réponse">';
								break;
							/*Pour les radios et les checkboxes:
							* les labels sont liés aux input par un id créé
							*/
							case 1 :
								$j = 0;
								foreach ($listReponses as $key => $reponse) {
									$htmlId = "Q" . $i . "R" . $j;
									if ($question->getId() == $reponse->getQuestion()) {
										echo '<input id="' .
											$htmlId .
											'" type="radio" name="Q' . $i . 'reponse" value="' .
											$question->getId() .
											'">' .
											'<label for="'.
											$htmlId .
											'">'.
											$reponse->getReponse() .
											'</label>'.
											'<br>';
									}
									$j++;
								}
								break;
							case 2 :
								$j = 0;
								foreach ($listReponses as $key => $reponse) {
									$htmlId = "Q" . $i . "R" . $j;
									if ($question->getId() == $reponse->getQuestion()) {
										echo '<input id="' .
											$htmlId .
											'" type="checkbox" name="Q' . $i . 'reponse" value="' .
											$question->getId() .
											'">' .
											'<label for="' .
											$htmlId .
											'">'.
											$reponse->getReponse() .
											'</label>'.
											'<br>';
									}
									$j++;
								}
								break;
						}
						$i++;
					}
					?>
					
					<!-- TODO: input type="hidden" name="utilisateur" value="id de l'utilisateur" -->
					<input type="hidden" name="idQuest" value="<?php echo $quest->getId(); ?>">

					<input type="submit" value="Envoyer la réponse">
				</form>
				<?php
			}
		}
		/*TODO: end of if !empty($_SESSION)
		* }
		*/
		?>
		</article>
			
	</section>
</main>