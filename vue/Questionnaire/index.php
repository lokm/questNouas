<main>
	<section>

		<h1>Recherche de questionnaire</h1>
		
		<article>
			<form action="search" method="POST" name="searchQuest">
			<p><label for="selectCat">Catégories :</label><br>
			<select name="selectCat" id="selectCat">
				<option disabled selected value>Selectionnez une catégorie</option>
				<?php 
				
						foreach ($categories as $key => $categorie) {
							echo "<option value=".$categorie->getId().">".$categorie->getNom()."</option>";
						}
				
				 ?>
			</select></p>
			<p><label for="selectQuest">Questionnaires :</label><br>
			<select name="selectQuest" id="selectQuest">
				<option disabled selected value>Selectionnez un questionnaire</option>
				<?php 
					foreach ($questionnaires as $key => $questionnaire) {
						echo "<option value='".$questionnaire->getId()."'>".$questionnaire->getNom()."</option>";
					}
							
				 ?>

			</select></p>
			<p><label for="selectStag">Stagiaires :</label><br>
			<select name="selectStag" id="selectStag">
				<option disabled selected value>Selectionnez un stagiaire</option>
				<?php 
					foreach ($users as $key => $user) {
						echo "<option value=".$user->getId().">".$user->getNom()." ".$user->getPrenom()."</option>";
					}
				 ?>
			</select></p>
			<p><input type="submit">
			<button><a href="<?php echo WEBROOT ?>Questionnaire/index">Reset</a></button></p>
		</form>
		</article>

		
		<h1>Création de questionnaire</h1>
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
		
		

	</section>
	
</main>