<?php
 
require_once("modele/Reponse.class.php");
class DaoReponse {
	public function create() {
		//TODO: methode DB::save
	}
	public function read($id) {
		$donnee = DB::select("SELECT id, reponse, valid, fk_question FROM reponses 
                                WHERE id = ?", array($id));
		if(!empty($donnee)) {
			$reponse = new Reponse($donnee[0]['reponse'],$donnee[0]['valid'],$donnee[0]['question']);
			$reponse->setId($donnee[0]['id']);
		} else {
			return null;
		}

		return $reponse;
	}
	public function readAll() {
		//TODO: methode DB::save
	}
	public function update($reponse) {
		DB::select("UPDATE reponses SET reponse = ?, valid = ?,  fk_question = ?  WHERE id = ?",array($reponse->getReponse(),$reponse->getValid(),$reponse->getQuestion()));
	}
	public function delete() {

	}
}

?>


