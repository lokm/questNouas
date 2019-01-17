<?php
 
require_once("modele/Questionnaire.class.php");
class DaoQuestionnaire {
	public function create(AbstractEntity $questionnaire) {
		DB::select("INSERT INTO quests (nomquest, intro, idmembre, cat_id) VALUES (?,?,?,?)", array($questionnaire->getNom(),$questionnaire->getIntro(),$questionnaire->getFormateur(), $questionnaire->getCategorie()));
		$questionnaire->setId(DB::lastId());
	}

	public function read($id) {
		$donnee = DB::select("SELECT id, nomquest, intro, idmembre, cat_id FROM quests 
                                WHERE id = ?", array($id));
		if(!empty($donnee)) {
			$questionnaire = new Questionnaire($donnee[0]['nomquest'],$donnee[0]['intro'],$donnee[0]['idmembre'],$donnee[0]['cat_id']);
			$questionnaire->setId($donnee[0]['id']);

		} else {
			return null;
		}

		return $questionnaire;
	}

	public function readAll() {
		$donnee = DB::select("SELECT id, nomquest, intro, idmembre, cat_id FROM quests");
		$tabQuests = array();
		if(!empty($donnee)) {
			foreach ($donnee as $key => $value) {
				$tabQuests[$key] = new Questionnaire($donnee[$key]['nomquest'],$donnee[$key]['intro'],$donnee[$key]['idmembre'],$donnee[$key]['cat_id']);
				$tabQuests[$key]->setId($donnee[$key]['id']);
			}
		} else {
			return null;
		}
		return $tabQuests;
	}

	public function readAllByCat($id) {
		$donnee = DB::select("SELECT id, nomquest, intro, idmembre, cat_id FROM quests WHERE cat_id = ?", array($id));
		$tabQuests = array();
		if(!empty($donnee)) {
			foreach ($donnee as $key => $value) {
				$tabQuests[$key] = new Questionnaire($donnee[$key]['nomquest'],$donnee[$key]['intro'],$donnee[$key]['idmembre'],$donnee[$key]['cat_id']);
				$tabQuests[$key]->setId($donnee[$key]['id']);
			}
		} else {
			return null;
		}
		return $tabQuests;
	}

	public function update($questionnaire) {
		DB::select("UPDATE quests SET nomquest = ?,  intro = ?, idmembre = ?, cat_id = ? WHERE id = ?",array($questionnaire->getNom(),$questionnaire->getIntro(),$questionnaire->getFormateur(), $questionnaire->getCategorie(), $questionnaire->getId()));
	}
	public function delete($id) {
		DB::select("DELETE FROM quests WHERE id = ?",array($id));
	}

	
}

?>


