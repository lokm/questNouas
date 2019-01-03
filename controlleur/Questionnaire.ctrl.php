<?php 
// Controleur de Questionnaire
class CtrlQuestionnaire extends Controller {
	
	// Action index
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

	// Action view
	function view($id) {
		$this->loadDao('Questionnaire');
		$d['questionnaire'] = $this->Questionnaire->read($id);
		
		$this->set($d);
		$this->render('view');
	}

	// Action create
	function create(AbstractEntity $questionnaire) {
		$this->loadDao('Questionnaire');
		$this->Questionnaire->create($questionnaire);
	}

	// Action addQuestionnaire
	function addQuestionnaire() {
		$this->loadDao('Categorie');
		$this->loadDao('Questionnaire');

		$this->log = "Vous devez renseigner ";
		$this->cat = new Categorie("","");
		$this->quest = new Questionnaire("","",0,0);

		$d['categories'] = $this->Categorie->readAll();

		if (!empty($this->input['catId'])) {
			$this->quest->setCategorie($this->input['catId']);
		} elseif (!empty($this->input['catNom']) && !empty($this->input['catDesc'])) {
			$this->cat->setNom($this->input['catNom']);
			$this->cat->setDescription($this->input['catNom']);
			$this->cat->create($this->cat);
			$this->quest->setCategorie($this->cat->getId());
		} else {
			$this->log .= "une catégorie, ";
		}

		if (!empty($this->input['questNom'])) {
			$this->quest->setNom($this->input['questNom']);
		} else {
			$this->log .= "un nom au questionnaire, ";
		}

		if (!empty($this->input['questDesc'])) {
			$this->quest->setIntro($this->input['questDesc']);
		} else {
			$this->log .= "une description au questionnaire, ";
		}

		if (!empty($this->input['questUser'])) {
			$this->quest->setFormateur($this->input['questUser']);
		} else {
			$this->log .= "un utilisateur, ";
		}
		
		if (!empty($this->input) && $this->create($this->quest)) {
			$this->log = "Questionnaire ajouté !";
		}


		$d['data'] = $this->input;
		$d['log'] = $this->log;
		$d['quest'] = $this->quest;
		$this->set($d);
		$this->render('create');
		
	}

}
 ?>
