<?php 
// Controleur de Questionnaire
class CtrlQuestionnaire extends Controller {
	
	// Action index
	function index() {
		$this->loadDao('User');
		$this->loadDao('Categorie');
		$this->loadDao('Questionnaire');
		
		if (isset($_SESSION['id'])) {
			$d['userSession'] = $this->User->read($_SESSION['id']);
		}
		$d['users'] = $this->User->readAll();
		$d['categories'] = $this->Categorie->readAll();
		$d['questionnaires'] = $this->Questionnaire->readAll();

		$this->set($d);
		$this->render('index');
	}

	// Action view
	function view($id) {
		$this->loadDao('User');
		$this->loadDao('Categorie');
		$this->loadDao('Questionnaire');
		$this->loadDao('Question');
		$this->loadDao('Reponse');

		$d['quest'] = $this->Questionnaire->read($id);
		$d['listQuestions'] = $this->Question->readAll($id);
		$d['listReponses'] = $this->Reponse->readAll();
		$d['categories'] = $this->Categorie->readAll();
		if (isset($_SESSION['id'])) {
			$d['userSession'] = $this->User->read($_SESSION['id']);
		}
		
		$this->set($d);
		$this->render('view');
	}

	// Action create
	function create(AbstractEntity $questionnaire) {
		$this->loadDao('Questionnaire');
		$this->Questionnaire->create($questionnaire);
	}

	// Action update
	function update(AbstractEntity $questionnaire) {
		$this->loadDao('Questionnaire');
		$this->Questionnaire->update($questionnaire);
	}

	// Action delete
	function delete($id) {
		$this->loadDao('Questionnaire');
		$this->Questionnaire->delete($id);
		render('index');
	}

	function updateQuest() {
		$this->loadDao('Questionnaire');
		$this->quest = new Questionnaire("","",0,0);

		$this->quest->setId((int) $this->input['questId']);
		$this->quest->setNom($this->input['questNom']);
		$this->quest->setCategorie($this->input['catId']);
		$this->quest->setIntro($this->input['questDesc']);
		$this->quest->setFormateur((int) $this->input['questUser']);

		$this->update($this->quest);
	
		header('Location: view/'.(int) $this->input['questId']);
	}

	// Action addQuestionnaire
	function addQuestionnaire() {
        

		$this->loadDao('Categorie');
		$this->loadDao('Questionnaire');
		$this->loadDao('Question');
		$this->loadDao('Reponse');

		$this->log = "";
		$this->cat = new Categorie("","");
		$this->quest = new Questionnaire("","",0,0);
		$this->questId = 0;
		

		$d['categories'] = $this->Categorie->readAll();
		//TODO: enlever le cookie !
		
			
	
		
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

				$this->create($this->quest);
				
		$this->listQuestions = $this->Question->readAll($this->quest->getId());


		$d['log'] = $this->log;
		$d['quest'] = $this->quest;
		$d['listQuestions'] = $this->listQuestions;
		$this->set($d);
		header('Location: view/'.$this->quest->getId());
		
		
	}

	// Action addQuestion
	function addQuestion() {
		
		$this->loadDao('Question');
		$this->loadDao('Reponse');
		$this->loadDao('Questionnaire');
		
		$this->quest = $this->Questionnaire->read((int) $this->input["questId"]);
		$this->question = new Question("","","","","",0);
		$this->reponse = new Reponse("","","");
		$this->listQuestions = $this->Question->readAll((int) $this->input["questId"]);

		

		$this->question->setType($this->input["type"]);
		$this->question->setQuestion($this->input["question"]);
		$this->question->setAide($this->input["aide"]);
		$this->question->setQuestionnaire((int) $this->input["questId"]);
		$this->Question->create($this->question);
		$this->questionId = DB::lastId();
		$this->reponse->setQuestion($this->questionId);
		$d['azerty'] = $this->reponse->getQuestion();

		for ($i =0; $i < (int) $this->input["nbRep"]; $i++) {

			$this->reponse->setReponse($this->input["R".$i]);
			
			if (isset($this->input["C".$i]) && (int) $this->input["C".$i] == 1) {
				$this->reponse->setValid(1);
			} elseif (isset($this->input["C".$i])) {
				$this->reponse->setValid(0);
			}
			$this->Reponse->create($this->reponse);
		}

		$this->listReponses = $this->Reponse->readAll();
		$this->question->setReponse($this->listReponses);

		$this->listQuestions = $this->Question->readAll((int) $this->input["questId"]);

		
		$d['question'] = $this->question;
		$d['listReponses'] = $this->listReponses;
		$d['quest'] = $this->quest;
		$d['listQuestions'] = $this->listQuestions;
		$this->set($d);
		header('Location: view/'.$this->quest->getId());
	}

	function search() {
		$this->loadDao('Categorie');
		$this->loadDao('Questionnaire');
		$this->loadDao('User');

		if (isset($this->input["selectCat"]) && !empty($this->input["selectCat"])) {
			$d['categories'] = [$this->Categorie->read($this->input["selectCat"])];
			$d['questionnaires'] = $this->Questionnaire->readAllByCat($this->input["selectCat"]);
			$d['users'] = $this->User->readAll();
		} elseif (isset($this->input["selectQuest"]) && !empty($this->input["selectQuest"])) {
			$this->quest = $this->Questionnaire->read($this->input["selectQuest"]);
			$d['categories'] = [$this->Categorie->read($this->quest->getCategorie())];
			$d['questionnaires'] = [$this->quest];
			$d['users'] = $this->User->readAll();
		} else {
			$d['categories'] = $this->Categorie->readAll();
			$d['questionnaires'] = $this->Questionnaire->readAll();
			$d['users'] = $this->User->readAll();
		}



		$this->set($d);
		$this->render('index');
	}

	// action sendQuestionnaire
	function addRepStg() {
		$this->loadDao('Reponse');
		$this->questionCount = 0;
		$this->questions = array();
		foreach($this->input['questionsId'] as $value) {
			$this->newQuestion = [
				'id' => htmlspecialchars($value),
				'idReponse' => $this->input["Q" . $this->questionCount . "reponse"],
				//'idMembre' => $_POST["utilisateur"],
				//TODO: 'nbPass' => value,
				'iqQuest' => $this->input["idQuest"]
			];
			array_push($this->questions, $this->newQuestion);
			$this->questionCount++;
		}
		//TODO: continuer pour le rendre fonctionnel
		foreach($this->questions as $question) {
			$this->Reponse->reponseStagiaire($reponse, $idmembre, $idreponses, $nbpass, $idquest);
		}
	}

}
 ?>
