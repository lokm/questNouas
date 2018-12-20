<?php
class Reponse extends AbstractEntity {
	private $reponse;
	private $valid;
	private $question;

	// Constructeur
	public function __construct($reponse, $valid, $question) {
		$this->reponse = $reponse;
		$this->valid = $valid;
		$this->question = $question;
	}

	// Getter & Setter
	public function getId() {
		return $this->id;
	}

	public function getReponse() {
		return $this->reponse;
	}

	public function setReponse($reponse) {
		$this->reponse = $reponse;
	}


	public function getValid() {
		return $this->valid;
	}

	public function setValid($valid) {
		$this->valid = $valid;	
	}

	public function getQuestion() {
		return $this->question;
	}

	public function setQuestion($question) {
		$this->question = $question;
	}

}
?>