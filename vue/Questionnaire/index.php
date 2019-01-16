<main>
	<section>
	 
		<?php var_dump($_SESSION['type']);
			if ($_SESSION['type'] == "Admin") {
		?>

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
			<form action="search">
			Catégories
			<select name="selectCat" id="">
				<option disabled selected value>Selectionnez un uestionnaire</option>
				<?php
					foreach ($categories as $key => $categorie) {
						echo "<option value=".$categorie->getId().">".$categorie->getNom()."</option>";
					}
				 ?>
			</select>
			Questionnaires
			<select name="selectQuest" id="">
				<?php
					foreach ($questionnaires as $key => $questionnaire) {
						echo "<option value='".$questionnaire->getId()."'>".$questionnaire->getNom()."</option>";
					}
				?>

			</select>
			Stagiaires
			<select name="selectStag" id="">
				<?php 
					foreach ($users as $key => $user) {
						echo "<option value=".$user->getId().">".$user->getNom()." ".$user->getPrenom()."</option>";
					}
				 ?>
			</select>
			</form>
		</article>

		<?php 			
			} //FIN if ($_SESSION['type'] == "Admin")

			if ($_SESSION['type'] == "Membre") {
				
			}
		?>
		

	</section>
	
</main>