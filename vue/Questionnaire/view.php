<main>
	<section>
		<h1>Questionnaire</h1>
		<?php $_SESSION['type'] = 'Member' ?>
		<article>
			<form action="<?php echo WEBROOT ?>Questionnaire/updateQuest" method="post" id="formUpdateQuest">
				<input type="hidden" name="questId" value="<?php echo $quest->getId() ?>">
				<input type="hidden" name="questUser" value="<?php echo $quest->getFormateur() ?>" placeholder="<?php echo $quest->getFormateur() ?>">
				
				<p><label for="questNom">Nom : </label>
				<input type="text" name="questNom" id="questNom" value="<?php echo $quest->getNom() ?>" placeholder="<?php echo $quest->getNom() ?>"></p>
				
				<p><label for="questDesc">Description : </label>
				<input type="text" name="questDesc" id="questDesc" value="<?php echo $quest->getIntro() ?>" placeholder="<?php echo $quest->getIntro() ?>"></p>
				
				<p><label for="catId">Categorie : </label>
					<select name="catId" id="catId">
						<?php 
							
							foreach ($categories as $key => $categorie) {
								echo "<option value=".$categorie->getId().">".$categorie->getNom()."</option>";
							}
						 ?>
					</select>
				</p>
				<input type="submit">
			</form>
			<div id="questInfo">
			<?php 
		
				echo "id : ".$quest->getId()."<br>".
				"nom : ".$quest->getNom()."<br>".
				"intro : ".$quest->getIntro()."<br>".
				"formateur : ".$quest->getFormateur()."<br>".
				"categorie : ".$quest->getCategorie()."<br><br>"; 
					
			?>
			</div>
			<?php 
			if ($_SESSION['type'] == 'Admin') {
			 ?>
			<button id="btnUpdateQuest">modifier</button><a href="<?php echo WEBROOT ?>Questionnaire/delete/<?php echo $quest->getId(); ?>"><button>supprimer</button></a><br>
			 
			<?php } ?>
			

			<?php
				if ($_SESSION['type'] == 'Admin') {
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
				
				} else {
					if (!empty($listQuestions) && !empty($listReponses)) {
						echo "<br><br>LIST QUESTIONS<br>";
				
						foreach ($listQuestions as $key => $question) {
							echo '<form>';
							echo '<input type="hidden" name="userId" value="'.$_SESSION["id"].'">';
							echo "question : ".$question->getQuestion()."<br>";
							echo "aide : ".$question->getAide()."<br><br>";
							echo "<input type='hidden' name='questionId' value='".$question->getId()."'>";

							switch ($question->getType()) {
								
								case '0':
									echo "<input type='text' name='R' placeholder='Veuillez entrez une réponse'><br><br>";
								break;
								
								case '1':
									$i = 0;
									foreach ($listReponses as $key => $reponse) {
										if ($question->getId() == $reponse->getQuestion()) {
											echo "<input type='checkbox' name='R".$i."' value='".$reponse->getId()."'> ".$reponse->getReponse()."<br>";
											$i++;
										}
									}
									echo '<input type="hidden" name="nbR" value="'.$i.'">';	
								break;
							}
						echo '<input class="questionSendButton" type="submit"></form>';
						echo "<hr>";

						}
					}
				}

		?> 
		
		</article>
		<?php if ($_SESSION['type'] == 'Admin') {
			
		?>
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
		<?php } //FIN if ($_SESSION['type'] = 'Admin') ?>
		


	</section>
</main>