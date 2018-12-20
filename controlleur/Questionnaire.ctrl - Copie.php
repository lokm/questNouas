<?php 

class CtrlQuestionnaire extends Controller {
	
	function index() {
		$this->loadDao('User');
		$this->loadDao('Categorie');
		$this->loadDao('Questionnaire');
		
		$d['users'] = $this->User->readAll();
		$d['categories'] = $this->Categorie->readAll();
		$d['questionnaires'] = $this->Questionnaire->readAll();

		$this->set($d);
		$this->render('index');
	}

	function view($id) {
		$this->loadDao('Questionnaire');
		$d['questionnaire'] = $this->Questionnaire->read($id);
		
		$this->set($d);
		$this->render('view');
	}

	function create(AbstractEntity $questionnaire) {
		$this->loadDao('Questionnaire');
		$this->Questionnaire->create($questionnaire);
	}

	function addQuestionnaire() {
		$this->loadDao('Categorie');
		$this->loadDao('Questionnaire');
		$this->log = "Vous devez renseigner ";
		$this->cat = new Categorie("","");
		$this->quest = new Questionnaire("","","","");
		
		if (!empty($data['catId'])) {
			$this->quest->setCategorie($data['catId']);
		} elseif (!empty($data['catNom']) && !empty($data['catDesc'])) {
			$this->cat->setNom($data['catNom']);
			$this->cat->setDescription($data['catNom']);
			$this->cat->create($this->cat);
			$this->quest->setCategorie($this->cat->getId());
		} else {
			$this->log .= "une catégorie, ";
		}

		if (!empty($data['questNom'])) {
			$this->quest->setNom($data['questNom']);
		} else {
			$this->log .= "un nom au questionnaire, ";
		}

		if (!empty($data['questDesc'])) {
			$this->quest->setIntro($data['questDesc']);
		} else {
			$this->log .= "une description au questionnaire, ";
		}

		if (!empty($data['questUser'])) {
			$this->quest->setFormateur($data['questUser']);
		} else {
			$this->log .= "un utilisateur, ";
		}
		
		if ($this->create($this->quest)) {
			$this->log = "Questionnaire ajouté !";
		}

		$d['log'] = $this->log;
		$this->set($d);
		$this->render('create');
		
	}

}
 ?>
