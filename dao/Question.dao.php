<?php
 
require_once("modele/Question.class.php");
class DaoQuestion {
	public function create() {
		//TODO: methode DB::save
	}
	public function read($id) {
		$donnee = DB::select("SELECT id, type, question, reponse, aide, lien, idquest FROM questions 
                                WHERE id = ?", array($id));
		if(!empty($donnee)) {
			$question = new Question($donnee[0]['type'],$donnee[0]['question'],$donnee[0]['reponse'],$donnee[0]['aide'],$donnee[0]['lien'],$donnee[0]['idquest']);
			$question->setId($donnee[0]['id']);
		} else {
			return null;
		}

		return $question;
	}
	public function readAll() {
		//TODO: methode DB::save
	}
	public function update($question) {
		DB::select("UPDATE questions SET type = ?, question = ?, reponse = ?, aide = ?, lien = ?, idquest = ?  WHERE id = ?",array($question->getType(),$question->getQuestion(),$question->getReponse(),$question->getAide(),$question->getImg(),$question->getQuestionnaire(),$question->getId()));
	}
	public function delete() {

	}
}

?>


