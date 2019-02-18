<?php
 
require_once("modele/Reponse.class.php");
class DaoReponse {

	public function create(AbstractEntity $reponse) {
		DB::select("INSERT INTO reponses (reponse, valid, fk_question) VALUES (?,?,?)", array($reponse->getReponse(),$reponse->getValid(),$reponse->getQuestion()));
		$reponse->setId(DB::lastId());
	}

	public function read($id) {
		$donnee = DB::select("SELECT id, reponse, valid, fk_question FROM reponses 
                                WHERE id = ?", array($id));
		if(!empty($donnee)) {
			$reponse = new Reponse($donnee[0]['reponse'],$donnee[0]['valid'],$donnee[0]['fk_question']);
			$reponse->setId($donnee[0]['id']);
		} else {
			return null;
		}

		return $reponse;
	}

	public function readAll() {
		$donnee = DB::select("SELECT id, reponse, valid, fk_question FROM reponses ");
		$tabReponses = array();
		if(!empty($donnee)) {
			foreach ($donnee as $key => $value) {
				$tabReponses[$key] = new Reponse($donnee[$key]['reponse'],$donnee[$key]['valid'],$donnee[$key]['fk_question']);
				$tabReponses[$key]->setId($donnee[$key]['id']);
			}
		} else {
			return null;
		}
		return $tabReponses;
	}

	public function update($reponse) {
		DB::select("UPDATE reponses SET reponse = ?, valid = ?,  fk_question = ?  WHERE id = ?",array($reponse->getReponse(),$reponse->getValid(),$reponse->getQuestion(),$reponse->getId()));
	}

	public function delete($id) {
		DB::select("DELETE FROM reponses WHERE id = ?",array($id));
	}
	
	/*TODO: transformer les paramètres récupérés procédural en objet
	* transformer les paramètres de post en objet ReponseStagiairepeut-être
	*/
	public function reponseStagiaire($idmembre, $idreponses, $nbpass, $idquest) {
			DB::select("INSERT INTO reponsestg (idmembre, idreponses, nbpass, idquest) VALUES ( ?, ?, ?, ?)", array($idmembre, $idreponses, $nbpass, $idquest));
	}
}

?>


