<?php


class Categorie extends AbstractEntity {
	private $nom;
	private $description;
	private $lang;

	// Constructeur
	public function __construct($nom, $description, $lang) {
		$this->id = 0;
		$this->nom = $nom;
		$this->description = $description;
		$this->lang = $lang;
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

	public function getLang() {
		return $this->lang;
	}

	public function setLang($lang) {
		$this->lang = $lang;	
	}
}
?>