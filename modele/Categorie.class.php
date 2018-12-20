<?php


class Categorie extends AbstractEntity {
	private $nom;
	private $description;

	// Constructeur
	public function __construct($nom, $description) {
		$this->id = 0;
		$this->nom = $nom;
		$this->description = $description;
	}


	// Getter & Setter
	public function getId() {
		return $this->id;
	}

	public function getNom() {
		return $this->nom;
	}

	public function setNom($nom) {
		$this->nom = $nom;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setDescription($description) {
		$this->description = $description;	
	}
}
?>