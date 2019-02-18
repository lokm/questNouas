<?php
 
require_once("modele/User.class.php");
class DaoUser {
	public function create($email, $pass, $type, $lang) {
		$donnee = DB::select("INSERT INTO user (email, pass, type, lang) VALUES (?,?,?,?)", array($email, sha1($pass."m33GT9*PH12*"), $type, $lang));
	}
	public function read($id) {
		$donnee = DB::select("SELECT id, email, type, lang FROM user 
                                WHERE id = ?", array($id));
		
		if(!empty($donnee)) {

			if ($this->isCandidatSave($id)) {
			$infos = DB::select("SELECT id, nom, prenom, formation FROM candidat_info 
                                WHERE fk_user = ?", array($id));

				$user = new User($donnee[0]['type'],$infos[0]['nom'],$infos[0]['prenom'],$infos[0]['formation'],$donnee[0]['lang']);
			
				$user->setId($donnee[0]['id']);
			
			} else {
				$user = new User($donnee[0]['type'],"","","",$donnee[0]['lang']);
				$user->setId($donnee[0]['id']);
			}

			return $user;

		} else {
			return null;
		}

		
	}
	public function readAll() {
		$donnee = DB::select("SELECT user.id, type, lang, nom, prenom, formation FROM user 
                                INNER JOIN candidat_info ON user.id = candidat_info.fk_user
                                ORDER BY nom");
		$tabUsers = array();
		if(!empty($donnee)) {
			foreach ($donnee as $key => $value) {
		
				$tabUsers[$key] = new User($donnee[$key]['type'],$donnee[$key]['nom'],$donnee[$key]['prenom'],$donnee[$key]['formation'],$donnee[$key]['lang']);
				$tabUsers[$key]->setId($donnee[$key]['id']);
			}
		} else {
			return null;
		}
		return $tabUsers;
	}

	public function checkUser($email, $pass) {
		$donnee = DB::select("SELECT id FROM user WHERE email = ? AND pass = ?", array($email,$pass));
		if(!empty($donnee)) {
			foreach ($donnee as $key => $value) {
				return $donnee[$key]['id'];
			}
		} else {
			return false;
		}
	}
	
	public function addCandidat($formation, $lieux, $nom, $prenom, $adresse, $birth, $tel, $formationLvl, $salarie, $societe, $cpf, $pe, $peId, $activite, $revenu, $rsa, $sp, $id) {
		$donnee = DB::select("INSERT INTO candidat_info (formation, lieux, nom, prenom, adresse, birth, tel, formationLvl, salarie, societe, cpf, pe, peId, activite, revenu, rsa, sp, fk_user) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", array($formation, $lieux, $nom, $prenom, $adresse, $birth, $tel, $formationLvl, $salarie, $societe, $cpf, $pe, $peId, $activite, $revenu, $rsa, $sp,(int) $id));
	}
	
	public function isCandidatSave($id) {
		$donnee = DB::select("SELECT 1 FROM candidat_info WHERE fk_user = ?",array($id));
		if(!empty($donnee)) {
			foreach ($donnee as $key => $value) {
				return true;
			}
		} else {
			return false;
		}
	}
	/*public function update($user) {
		DB::select("UPDATE account_details SET type = ?, nom = ?,  prenom = ?, formation = ?  WHERE account_id = ?",array($user->getType(),$user->getNom(),$user->getPrenom(),$user->getFormation(),$user->getId()));
	}
	public function delete() {

	}*/
}

?>


