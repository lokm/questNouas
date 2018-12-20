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

	function create($questionnaire) {
		$this->loadDao('Questionnaire');
		/*$this->Questionnaire->
*/		$d = $this->data;
		$this->set($d);
		$this->render('create');
	}


}
 ?>
