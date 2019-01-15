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
		<article>
			<form action="<?php echo WEBROOT ?>Questionnaire/addQuestion" method="post">
			<input type="radio" name="type" value="0"> Question simple <br>
			<input type="radio" name="type" value="1"> QCM <br>
			<input name="question" type="text" placeholder="Entrez voter question">
			<input name="aide" type="text" placeholder="Entrez une aide"><br>
			<input type="hidden" name="questId" value="<?php echo $quest->getId() ?>">
			<input type="hidden" name="nbRep" id="nbRep" value="">
			<div id="questQview"></div>
			<button type='button' id="btnRep" onclick="addRep()">Ajouter réponse</button><button type='button' id="btnRemoveRep" onclick="removeLastRep()">Enlever réponse</button> <br><br>
			<input type="submit" value="Save question" id="btnQuestion">
		</form>
		<a href="<?php echo WEBROOT ?>Questionnaire/view/<?php echo $quest->getId(); ?>">
		<button>finaliser</button></a>
		</article>
	</section>
</main>