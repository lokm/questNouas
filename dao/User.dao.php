<?php
 
require_once("modele/User.class.php");
class DaoUser {
	/*public function create() {
		$donnee = DB::select("INSERT INTO quests (nomquest, intro, idmembre, cat_id) VALUES (?,?,?,?)", array($id));
	}*/
	public function read($id) {
		$donnee = DB::select("SELECT account.id, type, nom, prenom, formation FROM account 
                                INNER JOIN account_details ON account.id = account_details.account_id
                                WHERE account.id = ?", array($id));
		if(!empty($donnee)) {
			$user = new User($donnee[0]['type'],$donnee[0]['nom'],$donnee[0]['prenom'],$donnee[0]['formation']);
			$user->setId($donnee[0]['id']);
		} else {
			return null;
		}

		return $user;
	}
	public function readAll() {
		$donnee = DB::select("SELECT account.id, type, nom, prenom, formation FROM account 
                                INNER JOIN account_details ON account.id = account_details.account_id
                                ORDER BY nom");
		$tabUsers = array();
		if(!empty($donnee)) {
			foreach ($donnee as $key => $value) {
				$tabUsers[$key] = new User($donnee[$key]['type'],$donnee[$key]['nom'],$donnee[$key]['prenom'],$donnee[$key]['formation']);
				# code...
			}
		} else {
			return null;
		}
		return $tabUsers;
	}
	/*public function update($user) {
		DB::select("UPDATE account_details SET type = ?, nom = ?,  prenom = ?, formation = ?  WHERE account_id = ?",array($user->getType(),$user->getNom(),$user->getPrenom(),$user->getFormation(),$user->getId()));
	}
	public function delete() {

	}*/
}

?>


