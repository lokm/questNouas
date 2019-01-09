<main>
	<section>
		<h1>Questionnaire</h1>
		<article>
			<<?php 
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
	</section>
</main>