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


	/*public static function getListUser($id) {

		$mysql = new Mysql();
		$bdd = $mysql->connect();

		$requete = $bdd->prepare("SELECT DISTINCT idmembre FROM reponsestg 
                                WHERE idquest = ?");
		$requete->execute(array($id));
		$tabUser = array();
		while ($donnee = $requete->fetch()) {
			array_push($tabUser,$donnee["idmembre"]);
		}
		return $tabUser;

	}

	public static function getListQuestion($id) {

		$mysql = new Mysql();
		$bdd = $mysql->connect();

		$requete = $bdd->prepare("SELECT * FROM questions 
                                WHERE idquest = ?");
		$requete->execute(array($id));
		$tabQuestion = array();
		while ($donnee = $requete->fetch()) {
			$tabQuestion[$donnee["id"]] = $donnee["question"];
		}
		return $tabQuestion;

	}*/

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

	/*public function getListMemberDone() {
		return $this->listMemberDone;
	}

	public function setListMemberDone($member) {
		array_push($this->listMemberDone, $member);
	}*/
}
?>