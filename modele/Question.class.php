<?php
class Question extends AbstractEntity {
	private $type;
	private $question;
	private $reponse;
	private $aide;
	private $img;
	private $questionnaire;

	// Constructeur
	public function __construct($type, $question, $reponse, $aide, $img, $questionnaire) {
		$this->type = $type;
		$this->question = $question;
		$this->reponse = $reponse;
		$this->aide = $aide;
		$this->img = $img;
		$this->questionnaire = $questionnaire;
	}

	// Getter & Setter
	public function getId() {
		return $this->id;
	}

	public function getType() {
		return $this->type;
	}

	public function setType($type) {
		$this->type = $type;
	}

	public function getQuestion() {
		return $this->question;
	}

	public function setQuestion($question) {
		$this->question = $question;
	}

	public function getReponse() {
		return $this->reponse;
	}

	public function setReponse($reponse) {
		$this->reponse = $reponse;
	}

	public function getAide() {
		return $this->aide;
	}

	public function setAide($aide) {
		$this->aide = $aide;	
	}

	public function getImg() {
		return $this->img;
	}

	public function setImg($img) {
		$this->img = $img;	
	}

	public function getQuestionnaire() {
		return $this->questionnaire;
	}

	public function setQuestionnaire($questionnaire) {
		$this->questionnaire = $questionnaire;	
	}
}
?>