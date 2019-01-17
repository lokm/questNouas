<main>
	<section>
	 
		

		<h1>Créer</h1>
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
						<input type="hidden" name="questUser" value="<?php echo $_SESSION['id'] ?>">
						<input type="submit">
			</form>			
		</article>
		<h1>Voir</h1>
		
		<article>
			<form action="search" method="POST">
			Catégories
			<select name="selectCat" id="">
				<option disabled selected value>Selectionnez une catégorie</option>
				<?php 
				
						foreach ($categories as $key => $categorie) {
							echo "<option value=".$categorie->getId().">".$categorie->getNom()."</option>";
						}
				
				 ?>
			</select>
			Questionnaires
			<select name="selectQuest" id="">
				<option disabled selected value>Selectionnez un questionnaire</option>
				<?php 
					foreach ($questionnaires as $key => $questionnaire) {
						echo "<option value='".$questionnaire->getId()."'>".$questionnaire->getNom()."</option>";
					}
							
				 ?>

			</select>
			Stagiaires
			<select name="selectStag" id="">
				<option disabled selected value>Selectionnez un stagiaire</option>
				<?php 
					foreach ($users as $key => $user) {
						echo "<option value=".$user->getId().">".$user->getNom()." ".$user->getPrenom()."</option>";
					}
				 ?>
			</select>
			<input type="submit">
			<button><a href="<?php echo WEBROOT ?>Questionnaire/index">Reset</a></button>
		</form>
		</article>

		
		

	</section>
	
</main>