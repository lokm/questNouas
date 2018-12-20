<?php
// @TODO : faire un objet pour la couche BDD des setters


class User extends AbstractEntity {
	private $type;
	private $nom;
	private $prenom;
	private $formation;

	// Constructeur
	public function __construct($type,$nom,$prenom,$formation) {
		$this->type = $type;
		$this->nom = $nom;
		$this->prenom = $prenom;
		$this->formation = $formation;
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
}
?>