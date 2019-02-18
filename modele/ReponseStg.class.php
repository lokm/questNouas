<?php
class ReponseStg extends AbstractEntity {
	private $membreId;
	private $reponseId;
	private $nbPass;
	private $questId;

	// Constructeur
	public function __construct($membreId, $reponseId, $nbPass, $questId) {
		$this->membreId = $membreId;
		$this->reponseId = $reponseId;
		$this->nbPass = $nbPass;
		$this->questId = $questId;
	}

	// Getter & Setter
	public function getId() {
		return $this->id;
	}

	public function getMembreId() {
		return $this->membreId;
	}

	public function setMembreId($membreId) {
		$this->membreId = $membreId;
	}


	public function getReponseId() {
		return $this->reponseId;
	}

	public function setReponseId($reponseId) {
		$this->reponseId = $reponseId;	
	}

	public function getNbPass() {
		return $this->nbPass;
	}

	public function setNbPass($nbPass) {
		$this->nbPass = $nbPass;
	}

	public function getQuestId() {
		return $this->questId;
	}

	public function setQuestId($questId) {
		$this->questId = $questId;
	}

}
?>