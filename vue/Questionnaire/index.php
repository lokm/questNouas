<main>
	<?php 
		
		if (isset($_SESSION['type']) && $_SESSION['type'] == 0) {
 
		 ?>
	<section class="topAdmin">
		<a href="<?php echo WEBROOT ?>Acceuil/index"><button class="toto" type="button">Ajouter un candidat</button></a><br>

		<h1>Recherche de questionnaire</h1>
		
		<article>
			<form action="search" method="POST" name="searchQuest">
			<p>
			<select name="selectCat" id="selectCat">
				<option disabled selected value>Selectionnez une catégorie</option>
				<?php 
				
						foreach ($categories as $key => $categorie) {
							echo "<option value=".$categorie->getId().">".$categorie->getNom()."</option>";
						}
				
				 ?>
			</select></p>
			<p>
			<select name="selectQuest" id="selectQuest">
				<option disabled selected value>Selectionnez un questionnaire</option>
				<?php 
					foreach ($questionnaires as $key => $questionnaire) {
						echo "<option value='".$questionnaire->getId()."'>".$questionnaire->getNom()."</option>";
					}
							
				 ?>

			</select></p>
			<p>
			<select name="selectStag" id="selectStag">
				<option disabled selected value>Selectionnez un stagiaire</option>
				<?php 
					foreach ($users as $key => $user) {
						echo "<option value=".$user->getId().">".$user->getNom()." ".$user->getPrenom()."</option>";
					}
				 ?>
			</select></p>
			<p><input type="submit" value="Rechercher">
			<a href="<?php echo WEBROOT ?>Questionnaire/index"><button type="button">Reset</button></a></p>
		</form>
		</article>
		
		
		<h1>Création de questionnaire</h1>
		<article>
			<form action="addQuestionnaire" method="POST" name="addQuest" id="addQuest">
						<p id="selectCat2"><select name="catId">
						<?php 
						
							foreach ($categories as $key => $categorie) {
								echo "<option value=".$categorie->getId().">".$categorie->getNom()."</option>";
							}
						 ?>
						</select><button type="button" id="btnAddCat">Nouvelle catégorie</button></p>
						<p id="addCat"><input type="text" name="catNom" placeholder="Nom categorie"><br>
						<textarea type="text" name="catDesc" placeholder="Description categorie"></textarea></p>
						<p>Affichage : <br>
						<label for="questTypeC"><input id="questTypeC" type="radio" name="type" value="0">Toutes les questions</label> 
						<label for="questTypeQ"><input id="questTypeQ" type="radio" name="type" value="1">Question par questions </label><br>
						Formation : <br>
						<label for="lang0"><input id="lang0" type="radio" name="lang" value="0"> DV fr</label> 
						<label for="lang1"><input id="lang1" type="radio" name="lang" value="1"> DV eng</label>
						<label for="lang2"><input id="lang2" type="radio" name="lang" value="2"> TAI fr</label>
						<label for="lang3"><input id="lang3" type="radio" name="lang" value="3"> TAI eng</label><br>
						<input type="text" name="questNom" placeholder="Nom questionnaire"><br>
						<textarea name="questDesc" placeholder="Decription questionnaire"></textarea><br>
						<input type="hidden" name="questUser" value="<?php echo $_SESSION['id'] ?>"></p>
						<p><input id="btnAddQuest" type="submit" value="Créer"></p>
			</form>			
		</article>
		
		

	</section>
	<?php } ?>
	<section id="mainView">
		<?php 
		$nbC = 0;
			if (isset($categories) && isset($_SESSION['id'])) {
				foreach ($categories as $key => $categorie) {
					if (isset($_SESSION['type']) && $_SESSION['type'] == 0) {
						echo "<article>
						<div><h3>".$categorie->getNom();
						if (isset($_SESSION['type']) && $_SESSION['type'] == 0) {
							echo "<span><a href='".WEBROOT."Categorie/delete/".$categorie->getId()."' onclick='return confirm(\"Etes-vous sûre de vouloir supprimer cette catégorie ?\")'><button title='Supprimer'><img src='".WEBROOT."img/delete.svg' alt='Supprimer'></button></a><button id='btnUpdateC".$nbC."' titre='Modifier'><img src='".WEBROOT."img/edit.svg' alt='Modifier'></button></span>";
						}
					echo "</h3>
						<p>".$categorie->getDescription()."</p></div>";

						
						echo '<form action="'.WEBROOT.'Categorie/update" method="post" class="formUpdateC categorie">
							<h3><input type="text" name="catNom" value="'.$categorie->getNom().'"></h3>
							<p><textarea name="catDesc">'.$categorie->getDescription().'</textarea></p>

							<input type="hidden" name="catId" value="'.$categorie->getId().'">
							<input type="submit" value="Modifier"><a href="'.WEBROOT.'Questionnaire/index"><input type="button" value="Annuler"></a>
						</form>';
						

						echo "<div class='cat'>";
						foreach ($questionnaires as $key => $questionnaire) {
							if ($categorie->getId() == $questionnaire->getCategorie()) {
								echo "<a href='".WEBROOT."Questionnaire/view/". $questionnaire->getId()."'><div class='quest'>
									<h4>".$questionnaire->getNom()."</h4>
									<p>".$questionnaire->getIntro()."</p>
								</div></a>";	
							}
						}	
						echo "</div>
					</article>";
					$nbC++;
					}elseif ($_SESSION['type'] != 0 && $_SESSION['lang'] == $categorie->getLang()) {
						
					
					echo "<article>
						<div><h3>".$categorie->getNom();
						if ((isset($_SESSION['type']) && $_SESSION['type'] == 0)) {
							echo "<span><a href='".WEBROOT."Categorie/delete/".$categorie->getId()."' onclick='return confirm(\"Etes-vous sûre de vouloir supprimer cette catégorie ?\")'><button title='Supprimer'><img src='".WEBROOT."img/delete.svg' alt='Supprimer'></button></a><button id='btnUpdateC".$nbC."' titre='Modifier'><img src='".WEBROOT."img/edit.svg' alt='Modifier'></button></span>";
						}
					echo "</h3>
						<p>".$categorie->getDescription()."</p></div>";

						
						echo '<form action="'.WEBROOT.'Categorie/update" method="post" class="formUpdateC categorie">
							<h3><input type="text" name="catNom" value="'.$categorie->getNom().'"></h3>
							<p><textarea name="catDesc">'.$categorie->getDescription().'</textarea></p>

							<input type="hidden" name="catId" value="'.$categorie->getId().'">
							<input type="submit" value="Modifier">
						</form>';
						

						echo "<div class='cat'>";
						foreach ($questionnaires as $key => $questionnaire) {
							if ($categorie->getId() == $questionnaire->getCategorie()) {
								echo "<a href='".WEBROOT."Questionnaire/view/". $questionnaire->getId()."'><div class='quest'>
									<h4>".$questionnaire->getNom()."</h4>
									<p>".$questionnaire->getIntro()."</p>
								</div></a>";	
							}
						}	
						echo "</div>
					</article>";
					$nbC++;
					}
				}
				echo '<input type="hidden" name="nbC" value="'.$nbC.'">';
			} else {
				echo '<article id="login">
					<form  action="'.WEBROOT.'User/login" method="post">
						<input type="email" name="email" placeholder="Email"><br>
						<input type="password" name="pass" placeholder="Mot de passe"><br>
						<input type="submit" value="connexion">
					</form>
				</article>';
			}	
		 ?>
	</section>
	
</main>