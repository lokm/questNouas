<main>
	<?php 
			/*echo '<pre>';
			var_dump($_SESSION);
			echo '</pre>';*/
	 ?>
<section class="topAdmin">
			<?php 
			if (isset($_SESSION['type']) && $_SESSION['type'] == 0) {
			echo '<form action="'.WEBROOT.'Resultat/view/'.$quest->getId().'" method="post">';
			echo '<select name="userId" id="">';
				foreach ($users as $key => $user) {
						echo "<option value=".$user->getId().">".$user->getNom()." ".$user->getPrenom()."</option>";
					}
			
			 ?>
		</select>
		<input type="submit">
	</form>
	<?php } ?>
</section>
<section id="quest">

	<?php
		/*echo '<pre>';
		var_dump($listReponseStg);
		echo '</pre>';*/

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
									if ($reponse->getValid() == 1 && $question->getId() == $reponse->getQuestion()) {		
										echo "<span class='repValid'>".htmlspecialchars($reponse->getReponse())."</span><br>";
									} elseif ($question->getId() == $reponse->getQuestion()) {
										echo htmlspecialchars($reponse->getReponse())."<br>";
									}

					}
					echo '<br>';
					foreach ($listReponses as $key => $reponse) {
						foreach ($listReponseStg as $key => $reponseStg) {
							/*echo $reponseStg->getQuestId().'<br>';
							if ($question->getId() == $reponseStg->getQuestId()) {
							echo '<br>questId : '.$question->getId().' = '.$reponseStg->getQuestId().'<br>';
								
							}
							if ($reponse->getId() == $reponseStg->getreponseId()) {
							echo 'reponseId : '.$reponse->getId().' = '.$reponseStg->getreponseId().'<br>';
							}*/
								if ($question->getId() == $reponseStg->getQuestId() && $reponse->getId() == $reponseStg->getreponseId()) {
									
										echo '<strong>'.htmlspecialchars($reponse->getReponse())."</strong>";
								}
										
							}
						
						
					}
					echo '</div>';
					}
				echo "</p>";
				echo '<input type="hidden" name="nbQ" value="'.$nbQ.'">';
				echo '<input type="hidden" name="userType" value="'.$_SESSION['type'].'">';
			} 

			} else { // fin Admin
				if (!empty($listQuestions) && !empty($listReponses)) {
				
					foreach ($listQuestions as $key => $question) {

						echo "<h2>".$question->getQuestion()."</h2>";
						if ($question->getAide() != "") {
							echo "<p class='aide'>".$question->getAide()."</p>";
						}
						if ($question->getImg() != "") {
							echo "<p class='img'><img src='".WEBROOT."upload/".$question->getImg()."' alt=''></p>";
						}
						
						foreach ($listReponses as $key => $reponse) {
							foreach ($listReponseStg as $key => $reponseStg) {
						
									if ($question->getId() == $reponseStg->getQuestId() && $reponse->getId() == $reponseStg->getreponseId()) {
										
											echo '<strong>'.htmlspecialchars($reponse->getReponse())."</strong>";
									}
											
								}
							
							
						}
						echo '</div>';
					}
				echo "</p>";
				} 
			}?>
</section>	

</main>