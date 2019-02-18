<?php 
	
	class CtrlResultat extends Controller {
		function index() {
		$this->loadDao('User');
		$this->loadDao('Categorie');
		$this->loadDao('Questionnaire');
		$this->loadDao('ReponseStg');
		
		if (isset($_SESSION['id'])) {
			$d['userSession'] = $this->User->read($_SESSION['id']);
		}
		$d['users'] = $this->User->readAll();
		$d['categories'] = $this->Categorie->readAll();
		$d['questionnaires'] = $this->Questionnaire->readAll();

		$this->set($d);
		$this->render('index');
	}

		function view($id) {
			$this->loadDao('User');
			$this->loadDao('Categorie');
			$this->loadDao('Questionnaire');
			$this->loadDao('Question');
			$this->loadDao('Reponse');
			$this->loadDao('ReponseStg');

			$this->allQuestions = $this->Question->readAll($id);
			$this->listQuestions = [];
			$this->listResponseStg = [];

			foreach ($this->allQuestions as $key => $this->question) {
		
					array_push($this->listQuestions, $this->question);
					if ($_SESSION['type'] == 0) {
						if (isset($this->input['userId'])) {
						array_push($this->listResponseStg, $this->ReponseStg->read($this->input['userId'], $this->question->getId()));
						}
					} else {
						if (isset($_SESSION['id'])) {

						array_push($this->listResponseStg, $this->ReponseStg->read($_SESSION['id'], $this->question->getId()));
						}
					}
					
				
			}
			/*echo '<pre>';
			var_dump($this->User->readAll());
			echo '</pre>';*/

			$d['users'] = $this->User->readAll();
			$d['quest'] = $this->Questionnaire->read($id);
			$d['listQuestions'] = $this->listQuestions;
			$d['listReponseStg'] = $this->listResponseStg;
			$d['listReponses'] = $this->Reponse->readAll();
			
			if (isset($_SESSION['id'])) {
				$d['userSession'] = $this->User->read($_SESSION['id']);
			}
		
			$this->set($d);
			 $this->render('view');
		}

		function search() {
			$this->loadDao('Question');
			$this->loadDao('ReponseStg');
			
			$this->allQuestions = $this->Question->readAll($id);
			$this->listQuestions = [];
			$this->listResponseStg = [];

			foreach ($this->allQuestions as $key => $this->question) {
					array_push($this->listQuestions, $this->question);
					if (isset($this->input['userId'])) {
					array_push($this->listResponseStg, $this->ReponseStg->read($this->input['userId'], $this->question->getId()));	
					}	
			}
			


		}

	}

 ?>