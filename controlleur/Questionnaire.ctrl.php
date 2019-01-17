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

		//Préparation des variablespermettant l'itération
		$questionCount = 0;
		$questions = array();
		/*pour assurer que questionsId est un array
		* sinon force la variable à devenir un tableau à une seule valeur
		*/
		$questionsId = (gettype($this->input['questionsId']) == "array") ?
			$this->input['questionsId'] :
			[$this->input['questionsId']];

		/*Gestion du stockage des id des questions
		* itération et création d'un stockage formaté
		* pour chaque identifiant présent dans $questionsID
		* et renvois au questionnaire si aucune réponse
		* TODO: poster le type d'erreur pour permettre de le transmettre à la vue
		*/
		foreach($questionsId as $value) {
			$stringFormatee = "Q" . $questionCount . "reponse";
			if (isset($this->input[$stringFormatee])) {
				/*TODO: ajouter la gestion logique de la récupération de l'idMembre
				* et un autre pour la gestion du nbPass
				* laissé à 0 pour le moment
				*/
				$newQuestion = [
					'id' => htmlspecialchars($value),
					'idReponse' => $this->input[$stringFormatee],
					'idMembre' => 0,
					'nbPass' => 0,
					'idQuest' => $_POST['idQuest']
				];
			} else {
				echo "Pas de réponse renseignée";
				header('Location: view/'.$this->input['idQuest']);
			}

			array_push($questions, $newQuestion);
			$questionCount++;
		}

		//TODO: continuer pour le rendre fonctionnel
		foreach ($questions as $question) {
			/*pour assurer que $idReponse est un array
			* sinon force la variable à devenir un tableau à une seule valeur
			*/
			$idReponse = (gettype($question['idReponse']) == 'array') ?
				$question['idReponse'] :
				[$question['idReponse']];

			foreach ($idReponse as $idReponse) {
				$this->Reponse->reponseStagiaire(
					$question['idMembre'],
					$idReponse,
					$question['nbPass'],
					$question['idQuest']);
			}
		}

		/*TODO: ajouter une redirection en fonction du succès ou de l'échec de l'envois ?
		* renvois pour l'instant à la vue du questionnaire envoyé
		*/
		header('Location: view/'.$this->input['idQuest']);
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
