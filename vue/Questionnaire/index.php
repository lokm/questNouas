<main>
	<section>
		<h1>Créer</h1>
		<article>
			<!-- <a href="<?php //echo WEBROOT ?>Questionnaire/addQuestionnaire"><button>Creation</button></a> -->
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
						<input type="submit">
			</form>			
		</article>
		<h1>Voir</h1>
		<article>
			<h2>Questionnaire</h2>
			Catégories
			<select name="" id="">
				<?php 
					foreach ($categories as $key => $categorie) {
						echo "<option value=".$categorie->getId().">".$categorie->getNom()."</option>";
					}
				 ?>
			</select>
			Questionnaires
			<select name="" id="">
				<?php 
					foreach ($questionnaires as $key => $questionnaire) {
						echo "<option value='".$questionnaire->getId()."'>".$questionnaire->getNom()."</option>";
					}
				 ?>

			</select>
			Stagiaires
			<select name="" id="">
				<?php 
					foreach ($users as $key => $user) {
						echo "<option value=".$user->getId().">".$user->getNom()." ".$user->getPrenom()."</option>";
					}
				 ?>
			</select>
		</article>

	</section>
	
</main>