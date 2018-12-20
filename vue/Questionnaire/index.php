<main>
	<section>
		<h1>Creation</h1>
		<article>
			<h2>Catégorie</h2>
			<form action="addQuestionnaire" method="POST">
				<input type="text" name="catNom" placeholder="Nom">
				<input type="text" name="catDesc" placeholder="Description">
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