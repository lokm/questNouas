<main>
	<?php var_dump($_SESSION['id']) ?>
	<section class="topAdmin addCandidat">
	<?php if ($_SESSION['type'] == 0) { ?>

	<?php 
		if (isset($log)) {
			echo $log;
		}
	 ?>

		<form action="addCandidat" method="post">
			<input type="text" name="email" placeholder="email" class="inputFormSub"> <br>
			<input type="text" name="pass" placeholder="Mot de passe" class="inputFormSub"><br><br>
			<label for="i0">Formation du candidat :<br>
				<label for="a0"><input id="a0" name="formation" type="radio" value="0">Technicien d'Assistance en Informatique</label>
				<label for="a1"><input id="a1" name="formation" type="radio" value="1">Développeur(se) Logiciel</label>
				<label for="a2"><input id="a2" name="formation" type="radio" value="2">Concepteur Développeur Informatique</label>
			</label><br>
			<label for="i0">Langue du candidat :<br>
				<label for="a3"><input id="a3" name="lang" type="radio" value="0">Français</label>
				<label for="a4"><input id="a4" name="lang" type="radio" value="1">Anglais</label>
			</label><br>
			<input id="btnAddQuest" type="submit" value="Enregistrer">
		</form>
		
		<?php  } else { ?>
	</section>
	<section id="mainView" class="subscribe">

	<?php 	if ($_SESSION['lang'] == 0 || $_SESSION['lang'] == 2) {
		# code...
	?>
		<form action="<?php echo WEBROOT ?>User/subscribe" method="post">
			<input type="hidden" name="userId" value="<?php echo $_SESSION['id'] ?>">
			<h3>Formation souhaitée</h3>
			<article>		
			<label for="i0">Je souhaite candidater à la formation :<br>
				<label for="r0"><input id="r0" name="formation" type="radio" value="taiFr">Technicien d'Assistance en Informatique</label><br>
				<label for="r1"><input id="r1" name="formation" type="radio" value="dvFr">Développeur(se) Logiciel</label><br>
				<label for="r2"><input id="r2" name="formation" type="radio" value="cdiFr">Concepteur Développeur Informatique</label>
			</label><br>
			</span>
			<span>	
			<label for="i1">Ville de formation :<br>
				<select class="inputFormSub" id="i1" name="lieux">
					<option value="Montpellier">Montpellier</option>
					<option value="Nîmes">Nîmes</option>
					<option value="Sète">Sète</option>
					<option value="Bèziers">Bèziers</option>
					<option value="Perpignan">Perpignan</option>
				</select>
			</label><br>
			
			</article>
			<h3>Etat Civil</h3>
			<article>
			<span>		
			<label for="i2">
				<input class="inputFormSub" id="i2" name="nom" type="text" placeholder="Nom">
			</label><br>
			<label for="i3">
				<input class="inputFormSub" id="i3" name="prenom" type="text" placeholder="Prénom">
			</label><br>
			<label for="i4">
				<input class="inputFormSub" id="i4" name="adresse" type="text" placeholder="Adresse">
			</label><br>
			</span>
			<span>	
			<label for="i5">
				<input class="inputFormSub" id="i5" name="birth" type="text" placeholder="Date de naissance (jj/mm/aaaa)">
			</label><br>
			<label for="i6">
				<input class="inputFormSub" id="i6" name="birthWhere" type="text" placeholder="Lieux de naissance">
			</label><br>
			<label for="i7">
				<input class="inputFormSub" id="i7" name="tel" type="text" placeholder="Téléphone">
			</label><br>
			</span>
			</article>

			<h3>Situation Professionnelle</h3>
			<article>
				<span>	
			<label for="i8">Niveau de formation :<br>
				<select class="inputFormSub" id="i1" name="formationLvl">
					<option value="Niveau 0">Non connu</option>
					<option value="Niveau 5">Niveau VI (Enseignement scolaire)</option>
					<option value="Niveau 5">Niveau V (Cap/Bep)</option>
					<option value="Niveau 4">Niveau IV (Bac)</option>
					<option value="Niveau 3">Niveau III (Bac+2)</option>
					<option value="Niveau 2">Niveau II (Bac+3 Bac+4)</option>
					<option value="Niveau 1">Niveau I (Bac+4 Bac+5)</option>
				</select>
			</label><br><br>
			<label for="i9">Je suis salarié(e) :<br>
				<label for="r3"><input id="r3" name="salarie" type="radio" value="1">Oui</label><br>
				<label for="r4"><input id="r4" name="salarie" type="radio" value="0">Non</label>
			</label><br>
			<label for="i17"><input class="inputFormSub" name="societe" id="i17" type="text" placeholder="Nom de la société"></label><br><br>
			<label for="i10">Je souhaite mobiliser le CPF : <br>
				<label for="r5"><input id="r5" name="cpf" type="radio" value="1">Oui</label><br>
				<label for="r6"><input id="r6" name="cpf" type="radio" value="0">Non</label>
			</label><br><br>
			</span>
			<span>	
			<label for="i11">Inscrit(e) à Pôle Emploi : <br>
				<label for="r7"><input id="r7" name="pe" type="radio" value="1">Oui</label><br>
				<label for="r8"><input id="r8" name="pe" type="radio" value="0">Non</label>
			</label><br>
			<label for="i12">
				<input class="inputFormSub" id="i12" name="peId" type="text" placeholder="N° d'identifiant Pôle Emploi">
			</label><br><br>
			<label for="i13">Sans activité depuis : <br>
				<label for="r11"><input id="r11" name="activite" type="radio" value="0">En activité</label><br>
				<label for="r12"><input id="r12" name="activite" type="radio" value="6">Moins de 6 mois</label><br>
				<label for="r13"><input id="r13" name="activite" type="radio" value="12">Moins de 12 mois</label><br>
				<label for="r14"><input id="r14" name="activite" type="radio" value="12-24">Entre 12 et 24 mois</label><br>
				<label for="r15"><input id="r15" name="activite" type="radio" value="24">Plus de 24 mois</label>
			</label><br><br>
			</span>
			<span>	
			<label for="i14">Indemnisation ou allocation :<br>
				<label for="r16"><input id="r16" name="revenu" type="radio" value="are">ARE</label><br>
				<label for="r17"><input id="r17" name="revenu" type="radio" value="ass">ASS</label><br>
				<label for="r18"><input id="r18" name="revenu" type="radio" value="aucune">Sans ressource</label><br>
				<label for="r19"><input id="r19" name="revenu" type="radio" value="autre">Autre</label>
			</label><br><br>
			<label for="i15">Bénéficiaire du RSA : <br>
				<label for="r20"><input id="r20" name="rsa" type="radio" value="1">Oui</label><br>
				<label for="r21"><input id="r21" name="rsa" type="radio" value="0">Non</label>	
			</label><br><br>
			</span>
			<span>
			<label for="i16">Situation particulières : <br>
				<label for="r22"><input id="r22" name="sp0" type="checkbox" value="QPV">Domicilié(e) en QPV (quartier prioritaire de la ville)</label><br>
				<label for="r23"><input id="r23" name="sp1" type="checkbox" value="RQTH">Reconnaissance RQTH ( Reconnaissance de la Qualité de Travailleur Handicapé)</label><br>
				<label for="r24"><input id="r24" name="sp2" type="checkbox" value="CIVIS">CIVIS / Garantie jeunes</label><br>
				<label for="r25"><input id="r25" name="sp3" type="checkbox" value="Autre">Autre</label>		
			</label><br>
			
			
				</span>
				</article>
				<input type="submit">
		</form>
	<?php 
	} else { ?>

	<form action="<?php echo WEBROOT ?>User/subscribe" method="post">
			<input type="hidden" name="userId" value="<?php echo $_SESSION['id'] ?>">
			<h3>Desired training</h3>
			<article>		
			<label for="i0">I wish to apply for the training :<br>
				<label for="r0"><input id="r0" name="formation" type="radio" value="taiEng">IT Support Technician</label><br>
				<label for="r1"><input id="r1" name="formation" type="radio" value="dvEng">Software Developer</label><br>
				<label for="r2"><input id="r2" name="formation" type="radio" value="cdiEng">Computer Designer Developer</label>
			</label><br>
			</span>
			<span>	
			<label for="i1">Training City :<br>
				<select class="inputFormSub" id="i1" name="lieux">
					<option value="Montpellier">Montpellier</option>
					<option value="Nîmes">Nîmes</option>
					<option value="Sète">Sète</option>
					<option value="Bèziers">Bèziers</option>
					<option value="Perpignan">Perpignan</option>
				</select>
			</label><br>
			
			</article>
			<h3>Civil status</h3>
			<article>
			<span>		
			<label for="i2">
				<input class="inputFormSub" id="i2" name="nom" type="text" placeholder="First name">
			</label><br>
			<label for="i3">
				<input class="inputFormSub" id="i3" name="prenom" type="text" placeholder="Last name">
			</label><br>
			<label for="i4">
				<input class="inputFormSub" id="i4" name="adresse" type="text" placeholder="Adress">
			</label><br>
			</span>
			<span>	
			<label for="i5">
				<input class="inputFormSub" id="i5" name="birth" type="text" placeholder="Birthday (jj/mm/aaaa)">
			</label><br>
			<label for="i6">
				<input class="inputFormSub" id="i6" name="birthWhere" type="text" placeholder="Birthplace">
			</label><br>
			<label for="i7">
				<input class="inputFormSub" id="i7" name="tel" type="text" placeholder="Phone">
			</label><br>
			</span>
			</article>

			<h3>Professional situation</h3>
			<article>
				<span>	
			<label for="i8">
				<input id="i8" type="text" class="inputFormSub" name="formationLvl" placeholder="Level of education">
			</label><br><br>
			<label for="i9">I am an employee :<br>
				<label for="r3"><input id="r3" name="salarie" type="radio" value="1">Yes</label><br>
				<label for="r4"><input id="r4" name="salarie" type="radio" value="0">No</label>
			</label><br>
			<label for="i17"><input class="inputFormSub" name="societe" id="i17" type="text" placeholder="Company Name"></label><br><br>
			<input type="hidden" name="cpf" value="99">
			</span>
			<span>	
			<label for="i11">Would you have accommodation in France ? : <br>
				<label for="r7"><input id="r7" name="pe" type="radio" value="1">Yes</label><br>
				<label for="r8"><input id="r8" name="pe" type="radio" value="0">No</label>
			</label><br>
			<label for="i12">
				<input class="inputFormSub" id="i12" name="peId" type="text" placeholder="Address of the accommodation">
			</label><br><br>

			<label for="i13">No activity since : <br>
				<label for="r11"><input id="r11" name="activite" type="radio" value="0">In activity</label><br>
				<label for="r12"><input id="r12" name="activite" type="radio" value="6">Less than 6 months</label><br>
				<label for="r13"><input id="r13" name="activite" type="radio" value="12">Less than 12 months</label><br>
				<label for="r14"><input id="r14" name="activite" type="radio" value="12-24">Between 12 and 24 months</label><br>
				<label for="r15"><input id="r15" name="activite" type="radio" value="24">More than 24 months</label>
			</label><br><br>
			</span>
			<span>
				<input type="hidden" name="revenu" value="99">
			<input type="hidden" name="rsa" value="99">
			</span>
			<span>
				<input type="hidden" name="rsa" value="99">
			<input type="hidden" name="sp0" value="99">
			
			
				</span>
				</article>
				<input type="submit">
		</form>

	<?php  } 
	} ?>  
	</section>
</main>