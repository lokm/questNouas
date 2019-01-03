<main>
	<section>
		<h1>Creation</h1>
			<article>


				<form action="addQuestionnaire" method="POST">
					<select name="catId">
					<?php 
						foreach ($categories as $key => $categorie) {
							echo "<option value=".$categorie->getId().">".$categorie->getNom()."</option>";
						}
					 ?>
					</select>
					<input type="text" name="catNom" placeholder="Nom categorie">
					<input type="text" name="catDesc" placeholder="Description categorie"><br>
					<input type="text" name="questNom" placeholder="Nom questionnaire"><br>
					<textarea name="questDesc" id="" cols="30" rows="10" placeholder="Decription questionnaire"></textarea><br>
					<input type="hidden" name="questUser" value="30">

					

					<div id="questQview"></div><hr><button type='button' onclick="addQuest(0)">Ajouter question simple</button><button type='button' onclick="addQuest(1)">Ajouter QCM</button><br><button type='button' id="btnRep" onclick="addRep()">Ajouter réponse</button><button type='button' id="btnRemoveRep" onclick="removeLastRep()">Enlever réponse</button>
					

					<input type="submit">
				</form>
			</article>
		
		<?php
		echo $log."<br>";
		echo "id : ".$quest->getId()."<br>"."nom : ".$quest->getNom()."<br>"."intro : ".$quest->getIntro()."<br>"."formateur : ".$quest->getFormateur()."<br>"."categorie : ".$quest->getCategorie(); 
		 ?>
	</section>
</main>