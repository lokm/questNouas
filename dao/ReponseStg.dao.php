<?php
 
require_once("modele/ReponseStg.class.php");
class DaoReponseStg {

	public function create(AbstractEntity $reponseStg) {
			DB::select("INSERT INTO reponsestg (idmembre, idreponses, nbpass, idquest) VALUES ( ?, ?, ?, ?)", array($reponseStg->getmembreId(),$reponseStg->getreponseId(),$reponseStg->getnbPass(),$reponseStg->getquestId()));
			$reponseStg->setId(DB::lastId());
	}

	public function read($idmembre, $idquest) {
		$donnee = DB::select("SELECT id, idmembre, idreponses, nbpass, idquest FROM reponsestg 
                                WHERE idmembre = ? AND idquest = ?", array($idmembre, $idquest));
		if(!empty($donnee)) {
			$reponse = new ReponseStg($donnee[0]['idmembre'],$donnee[0]['idreponses'],$donnee[0]['nbpass'], $donnee[0]['idquest']);
			$reponse->setId($donnee[0]['id']);
		} else {
			return null;
		}

		return $reponse;
	}

	public function readAll() {
		$donnee = DB::select("SELECT idmembre, idreponses, nbpass, idquest FROM reponsestg ");
		$tabReponses = array();
		if(!empty($donnee)) {
			foreach ($donnee as $key => $value) {
				$tabReponses[$key] = new Reponse($donnee[$key]['idmembre'],$donnee[$key]['idreponses'],$donnee[$key]['nbpass'], $donnee[$key]['idquest']);
				$tabReponses[$key]->setId($donnee[$key]['id']);
			}
		} else {
			return null;
		}
		return $tabReponses;
	}

	public function update($reponseStg) {
		DB::select("UPDATE reponsestg SET idmembre = ?, idreponses = ?,  nbpass = ?, idquest = ?  WHERE id = ?",array($reponseStg->getmembreId(),$reponseStg->getreponseId(),$reponseStg->getnbPass(),$reponseStg->getquestId(),$reponseStg->getId()));
	}

	public function delete() {

	}
	
	/*TODO: transformer les paramètres récupérés procédural en objet
	* transformer les paramètres de post en objet ReponseStagiairepeut-être
	*/
}

?>


