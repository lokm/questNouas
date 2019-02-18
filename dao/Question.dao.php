<?php
 
require_once("modele/Question.class.php");
class DaoQuestion {
	
	public function create(AbstractEntity $question) {
		DB::select("INSERT INTO questions (type, question, reponse, aide, lien, idquest) VALUES (?,?,?,?,?,?)", array($question->getType(),$question->getQuestion(),$question->getReponse(), $question->getAide(), $question->getImg(), $question->getQuestionnaire()));
		return $question->setId(DB::lastId());
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

	public function readAll($questionnaire) {
		$donnee = DB::select("SELECT id, type, question, reponse, aide, lien, idquest FROM questions WHERE idquest = ?", array($questionnaire));
		$tabQuestions = array();
		if(!empty($donnee)) {
			foreach ($donnee as $key => $value) {
				$tabQuestions[$key] = new Question($donnee[$key]['type'],$donnee[$key]['question'],$donnee[$key]['reponse'],$donnee[$key]['aide'],$donnee[$key]['lien'],$donnee[$key]['idquest']);
				$tabQuestions[$key]->setId($donnee[$key]['id']);
			}
		} else {
			return null;
		}
		return $tabQuestions;
	}

	public function update($question) {
		DB::select("UPDATE questions SET type = ?, question = ?, reponse = ?, aide = ?, lien = ?, idquest = ?  WHERE id = ?",array($question->getType(),$question->getQuestion(),$question->getReponse(),$question->getAide(),$question->getImg(),$question->getQuestionnaire(),$question->getId()));
	}
	public function delete($id) {
		DB::select("DELETE FROM questions WHERE id = ?",array($id));
	}

}

?>


