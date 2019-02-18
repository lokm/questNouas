<?php
// @TODO : faire un objet pour la couche BDD des setters


class User extends AbstractEntity {
	private $type;
	private $nom;
	private $prenom;
	private $formation;
	private $lang;

	// Constructeur
	public function __construct($type,$nom,$prenom,$formation, $lang) {
		$this->type = $type;
		$this->nom = $nom;
		$this->prenom = $prenom;
		$this->formation = $formation;
		$this->lang = $lang;
	}


	// Getters et Setters
	public function getId() {
		return $this->id;
	}

	public function getType() {
		return $this->type;
	}

	public function setType($type) {
		$this->type = $type;
	}

	public function getNom() {
		return $this->nom;
	}

	public function setNom($nom) {
		$this->nom = $nom;
		
	}

	public function getPrenom() {
		return $this->prenom;
	}

	public function setPrenom($prenom) {
		$this->prenom = $prenom;
	}

	public function getFormation() {
		return $this->formation;
	}

	public function setFormation($formation) {
		$this->formation = $formation;
	}

	public function getLang() {
		return $this->lang;
	}

	public function setLang($lang) {
		$this->lang = $lang;
	}
}
?>