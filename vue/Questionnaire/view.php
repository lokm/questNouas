<main>
	<?php 

$time = date("m/d/Y h:i:s a", time() + 5);

 ?>
	
	<?php 
	
	if (isset($_SESSION['type']) && $_SESSION['type'] == 0) {

	 ?>
	<section class="topAdmin">
		<a href="<?php echo WEBROOT ?>Questionnaire/delete/<?php echo $quest->getId(); ?>" onclick='return confirm("Etes-vous sûre de vouloir supprimer ce questionnaire ?")'><button title="Supprimer"><img src="<?php echo WEBROOT ?>img/delete.svg" alt="Supprimer"></button></a><button id="btnUpdateQuest" titre="Modifier"><img src="<?php echo WEBROOT ?>img/edit.svg" alt="Modifier"></button><br>
		
		<article>
			
			<form action="<?php echo WEBROOT ?>Questionnaire/updateQuest" method="post" id="formUpdateQuest">
				<input type="hidden" name="questId" value="<?php echo $quest->getId() ?>">
				<input type="hidden" name="questUser" value="<?php echo $quest->getFormateur() ?>">
				
				<p><select name="catId" id="catId">
					<?php 
						
						foreach ($categories as $key => $categorie) {
							if ($quest->getCategorie() == $categorie->getId()) {
								echo "<option value=".$categorie->getId()." selected>".$categorie->getNom()."</option>";
							} else {
								echo "<option value=".$categorie->getId().">".$categorie->getNom()."</option>";
							}
						}
					 ?>
				</select></p>
				
				<p><input type="text" name="questNom" id="questNom" value="<?php echo $quest->getNom() ?>" placeholder="<?php echo $quest->getNom() ?>"></p>
				<input type="radio" name="type" value="0"> Questionnaire simple <br>
				<input type="radio" name="type" value="1"> Quiz <br>
				
				<p><textarea type="text" name="questDesc" id="questDesc" value="<?php echo $quest->getIntro() ?>"><?php echo $quest->getIntro() ?></textarea></p>
				
				<input type="submit" value="Modifier">

				<?php echo '<a href="'.WEBROOT.'Questionnaire/view/'.$quest->getId().'"><input type="button" value="Annuler"></a>' ?>
			</form>
				<?php } ?> <!-- fin if admin -->
			<div id="questInfo">
				<h1><?php echo $quest->getNom(); ?></h1>
			<?php 
		
				echo "<p>".$quest->getIntro()."</p>"; 
					
			?>
			<div id="clock"><div id="timer" data-timer="3" style="width: 20vw; margin:0 auto;"></div></div>
			</div>
			
			
			 
			</section>
			
				<section id="quest">
				<div id="message"></div>
			
			<?php
				if (isset($_SESSION['type']) && $_SESSION['type'] == 0) {
				 	if (!empty($listQuestions) && !empty($listReponses)) {

						$nbQ = 0;
						foreach ($listQuestions as $key => $question) {
				
							echo "<span><div class='Q' id='Q".$nbQ."'><h2><p>".$question->getQuestion()."</p><button name='".$question->getId()."' value='".$quest->getId()."' id='btnDelete".$nbQ."' title='Supprimer'><img src='".WEBROOT."img/delete.svg' alt='Supprimer'></button><button id='btnUpdateQ".$nbQ."' titre='Modifier'><img src='".WEBROOT."img/edit.svg' alt='Modifier'></button></h2>";
							if ($question->getAide() != "") {
								echo "<p class='aide'>".$question->getAide()."</p>";
							}
							if ($question->getImg() != "") {
								echo "<p class='img'><img src='".WEBROOT."upload/".$question->getImg()."' alt=''></p>";
							}
							
							

							echo "<p class='reponse'>";

							foreach ($listReponses as $key => $reponse) {
								if ($question->getId() == $reponse->getQuestion()) {
								
									if ($reponse->getValid() == 1) {		
										echo "<span class='repValid'>".htmlspecialchars($reponse->getReponse())."</span><br>";
									} else {
										echo htmlspecialchars($reponse->getReponse())."<br>";
									}
								}

							}
							echo '</div>';
							echo '<form action="'.WEBROOT.'Question/update" method="post" class="formUpdateQ question" id="formUpdateQ'.$nbQ.'" enctype="multipart/form-data">
							<input type="hidden" name="questId" value="'.$quest->getId().'">
							<input type="hidden" name="qId" value="'.$question->getId().'">
								<h2><input type="text" name="question" placeholder="Entrer une question" value="'.$question->getQuestion().'"></h2>
								<input type="text" name="aide" placeholder="Entrer une aide" value="'.$question->getAide().'"><br>';
								if ($question->getImg() != "") {
									echo '<p class="img"><img src="'.WEBROOT.'upload/'.$question->getImg().'"></p>';
								}
								echo '<input type="file" name="img" /><br>';
							$nbR = 0;

							echo '<div class="questQUp">
									<div id="questQviewUp'.$nbQ.'">';
							foreach ($listReponses as $key => $reponse) {
								if ($question->getId() == $reponse->getQuestion()) {
								
										echo "<span><input type='text' name='R".$nbR."' value='".htmlspecialchars($reponse->getReponse())."'>
										<input type='hidden' name='idR".$nbR."' value='".$reponse->getId()."'>
										<label class='container'>";

										if ( $reponse->getValid() == 1) {
											echo "<input class='checkRep' type='checkbox' name='C".$nbR."' value='1' checked><span class='checkmark' ></span></label></span>";
											
										} else {
											echo "<input class='checkRep' type='checkbox' name='C".$nbR."' value='0'><span class='checkmark'></span></label></span>";
											
										}
									
								$nbR++;
								}
							}

							echo '</div>
									<button type="button" id="btnRepUp'.$nbQ.'" onclick="addRepUp('.$nbQ.')">Ajouter réponse</button>
									<button type="button" id="btnRemoveRepUp'.$nbQ.'" onclick="removeLastRepUp('.$nbQ.')">Enlever réponse</button>';
							echo '</div>';
							echo '<input type="hidden" id="nbR'.$nbQ.'" name="nbR" value="'.$nbR.'">';	
							
							echo	'<input id="submitQ'.$nbQ.'" type="submit" value="Modifier"><a href="'.WEBROOT.'Questionnaire/view/'.$quest->getId().'"><input type="button" value="Annuler"></a>
							</form></span>';

							$nbQ++;
						}

						

						echo "</p>";
						echo '<input type="hidden" name="nbQ" value="'.$nbQ.'">';
						echo '<input type="hidden" name="userType" value="'.$_SESSION['type'].'">';
					} 
				
				} else { // fin if admin
					echo '<input type="hidden" name="questType" value="'.$quest->getType().'">';
					if (!empty($listQuestions) && !empty($listReponses)) {
				
							$nbQ = 0;
						foreach ($listQuestions as $key => $question) {
							
							echo '<form id="Q'.$nbQ.'" class="question" action="'.WEBROOT.'Questionnaire/addRepStg" method="post" >';
							echo '<input type="hidden" name="userId" value="';
							if (isset($_SESSION["id"])) {
								echo $_SESSION["id"].'">';
							} else {
								echo '0">';
							}
							echo '<input type="hidden" name="questId" value="'.$quest->getId().'">';
							echo "<h2>".$question->getQuestion()."</h2>";
							if ($question->getAide() != "") {
								echo "<p class='aide'>".$question->getAide()."</p>";
							}
							if ($question->getImg() != "") {
								echo "<p class='img'><img src='".WEBROOT."upload/".$question->getImg()."' alt=''></p>";
							}
							echo "<input type='hidden' name='questionId' value='".$question->getId()."'><p class='reponse'>";

							switch ($question->getType()) {
								
								case '0':
									$i = 0;
									echo "<textarea type='text' name='R' placeholder='Veuillez entrer une réponse'></textarea>";
								break;
								
								case '1':
									$i = 0;
									foreach ($listReponses as $key => $reponse) {
										if ($question->getId() == $reponse->getQuestion()) {
											echo "<label class='container'>".htmlspecialchars($reponse->getReponse())."<input class='checkRep' type='checkbox' name='C".$i."' value='0'><span class='checkmark'></span></label>
											<input type='hidden' name='R".$i."' value='".$reponse->getId()."'>" ;
											$i++;
										}
									
									}
									echo '<input type="hidden" name="nbR" value="'.$i.'">';	
								break;
							}
						echo '</p><input type="submit" class="btnSubmit" id="btnSubmit'.$nbQ.'" value="Valider"></form>';
				
						$nbQ++;
						}
						echo '<input type="hidden" name="nbQ" value="'.$nbQ.'">';
						
					}
					echo '<div style="display:none;">Questionnaire fini !<br><a href="'.WEBROOT.'Questionnaire/index">Retour à l\'accueil</a></div>';
				} 

		?> 
		
		</article>
		<?php if (isset($_SESSION['type']) && $_SESSION['type'] == 0) {
			
		?>
	</section>
		<section id="bottomAdmin">
		<article>
			<h1>Ajouter une question</h1>
			<form action="<?php echo WEBROOT ?>Questionnaire/addQuestion" method="post" enctype="multipart/form-data">
			<label for="qs">
				<input id="qs" type="radio" name="type" value="0"> Question simple
			</label>
			<label for="qcm">
				<input id="qcm" type="radio" name="type" value="1"> QCM 
			</label><br>
			<textarea name="question" type="text" placeholder="Entrez votre question"></textarea><br>
			<input name="aide" type="text" placeholder="Entrez une aide"><br>
			<input type="file" name="img" />
			<input type="hidden" name="questId" value="<?php echo $quest->getId() ?>">
			<input type="hidden" name="nbRep" id="nbRep" value="">
			<div id="questQview"></div>
			<button type='button' id="btnRep" onclick="addRep()">Ajouter réponse</button><button type='button' id="btnRemoveRep" onclick="removeLastRep()">Enlever réponse</button> <br><br>
			<input type="submit" value="Save question" id="btnQuestion">
		</form>
		</article>
		<?php } //FIN if ($_SESSION['type'] = 0) ?>
		


	</section>
</main>