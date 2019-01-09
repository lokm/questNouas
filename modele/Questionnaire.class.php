<?php
//@TODO : faire un objet pour la couche BDD des setters


class Questionnaire extends AbstractEntity {
	private $nom;
	private $intro;
	private $formateur;
	private $categorie;

	// Construct
	public function __construct($nom, $intro, $formateur, $categorie) {
		$this->nom = $nom;
		$this->intro = $intro;
		$this->formateur = $formateur;
		$this->categorie = $categorie;
	
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

	public function getIntro() {
		return $this->intro;
	}

	public function setIntro($intro) {
		$this->intro = $intro;
	}

	public function getFormateur() {
		return $this->formateur;
	}

	public function setFormateur($formateur) {
		$this->formateur = $formateur;
	}

	public function getCategorie() {
		return $this->categorie;
	}

	public function setCategorie($categorie) {
		$this->categorie = $categorie;
	}

}
?>