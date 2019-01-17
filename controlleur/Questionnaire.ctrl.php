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
		$this->loadDao('Question');
		$this->loadDao('Reponse');
		$d['quest'] = $this->Questionnaire->read($id);
		$d['listQuestions'] = $this->Question->readAll($id);
		$d['listReponses'] = $this->Reponse->readAll();
		
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
		$this->loadDao('Question');
		$this->loadDao('Reponse');

		$this->log = "";
		$this->cat = new Categorie("","");
		$this->quest = new Questionnaire("","",0,0);
		$this->questId = 0;
		

		$d['categories'] = $this->Categorie->readAll();

		if (isset($_COOKIE["questId"])) {
			$this->quest = $this->Questionnaire->read($_COOKIE["questId"]);
			$this->listQuestions = $this->Question->readAll($_COOKIE['questId']);
	
		} else {
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
				
		}
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

	// action sendQuestionnaire
	function sendQuestionnaire() {
		$this->loadDao('Reponse');

		var $questionCount = 0;
		var $questions = array();
		foreach($_POST['questionsId'] as $value) {
			var $newQuestion = [
				'id' => htmlspecialchars($value),
				'idReponse' => $_POST["Q" . $questionCount . "reponse"],
				'idMembre' => null,
				'nbPass' => null,
				'iqQuest' => $_POST["idQuest"]
			];

			array_push($questions, $newQuestion);
			$questionCount++;
		}

		//TODO: continuer pour le rendre fonctionnel
		foreach($questions as $question) {
			$this->Reponse->reponseStagiaire($question['id'], $question['idMembre'], $question['idReponse'], $question['nbPass'], $question['idQuest']);
		}
	}

	function search() {
		$this->loadDao('Categorie');
		$this->loadDao('Questionnaire');
		$this->loadDao('User');

		$this->cat = new Categorie("","");
		$this->quest = new Questionnaire("","",0,0);
		$this->user = new User("","","","");

		if (!empty($this->input["selectCat"])) {
			
		}
	}

}
 ?>
