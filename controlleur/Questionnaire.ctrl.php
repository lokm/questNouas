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
		$this->loadDao('ReponseStg');

		// $this->listQuestions = $this->Question->readAll($id);
		$this->allQuestions = $this->Question->readAll($id);
		$this->listQuestions = [];
		foreach ($this->allQuestions as $key => $this->question) {
			if ($this->ReponseStg->read($_SESSION['id'], $this->question->getId()) == null) {
				array_push($this->listQuestions, $this->question);
			}
			continue;
		}

		$d['quest'] = $this->Questionnaire->read($id);
		$d['listQuestions'] = $this->listQuestions;
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
		$this->loadDao('Categorie');
		$this->loadDao('User');

		$this->Questionnaire->delete($id);
		
		$d['categories'] = $this->Categorie->readAll();
		$d['questionnaires'] = $this->Questionnaire->readAll();
		$d['users'] = $this->User->readAll();
		$this->set($d);
		$this->render('index');
	}

	function updateQuest() {
		$this->loadDao('Questionnaire');
		$this->quest = new Questionnaire("","",0,0,0);

		$this->quest->setId((int) $this->input['questId']);
		$this->quest->setNom($this->input['questNom']);
		$this->quest->setCategorie($this->input['catId']);
		$this->quest->setIntro($this->input['questDesc']);
		$this->quest->setFormateur((int) $this->input['questUser']);
		$this->quest->setType((int) $this->input['type']);

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
		$this->cat = new Categorie("","","");
		$this->quest = new Questionnaire("","",0,0,0);
		$this->questId = 0;
		

		$d['categories'] = $this->Categorie->readAll();
		//TODO: enlever le cookie !
		
			
	
		
			if (!empty($this->input['catNom']) && !empty($this->input['catDesc'])) {
				$this->cat->setNom($this->input['catNom']);
				$this->cat->setDescription($this->input['catDesc']);
				$this->cat->setLang($this->input['lang']);
				$this->Categorie->create($this->cat);
				$this->cat->setId(DB::lastId());
				$this->quest->setCategorie($this->cat->getId());
			} elseif (!empty($this->input['catId'])) {
				$this->quest->setCategorie($this->input['catId']);
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

				$this->quest->setType((int) $this->input['type']);
				$this->create($this->quest);
				
		$this->listQuestions = $this->Question->readAll($this->quest->getId());


		$d['log'] = $this->log;
		$d['quest'] = $this->quest;
		$d['listQuestions'] = $this->listQuestions;
		$this->set($d);
		//$this->view($this->quest->getId());
		 header('Location: view/'.$this->quest->getId());
		
		
	}

	// Action addQuestion
	function addQuestion() {
		
		$this->loadDao('Question');
		$this->loadDao('Reponse');
		$this->loadDao('Questionnaire');
		$this->log = "log";	
		
		$this->quest = $this->Questionnaire->read((int) $this->input["questId"]);
		$this->question = new Question("","","","","",0);
		$this->reponse = new Reponse("","","");
		$this->listQuestions = $this->Question->readAll((int) $this->input["questId"]);

		     $dossier = ROOT.'upload/';
		     $fichier = basename($this->files['img']['name']);
		     if (move_uploaded_file($this->files['img']['tmp_name'], $dossier . $fichier)) {
		     	$this->log = "upload OK";
		     } else {
		     	$this->log = "upload KOKO";
		     }
		      //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
		    
		    $this->question->setImg($this->files['img']['name']);
		    

		$this->question->setType($this->input["type"]);
		$this->question->setQuestion(htmlspecialchars($this->input["question"]));
		$this->question->setAide(htmlspecialchars($this->input["aide"]));
		$this->question->setQuestionnaire((int) $this->input["questId"]);
		
		$this->Question->create($this->question);
		$this->questionId = DB::lastId();
		$this->reponse->setQuestion($this->questionId);

		for ($i =0; $i < (int) $this->input["nbRep"]; $i++) {

			$this->reponse->setReponse(htmlspecialchars($this->input["R".$i]));
			
			if (isset($this->input["C".$i])) {
				$this->reponse->setValid($this->input["C".$i]);
			}
			
			$this->Reponse->create($this->reponse);
		}

		$this->listReponses = $this->Reponse->readAll();
		$this->question->setReponse($this->listReponses);

		$this->listQuestions = $this->Question->readAll((int) $this->input["questId"]);

		$d['log'] = $this->log;

		$d['listReponses'] = $this->listReponses;
		$d['quest'] = $this->quest;
		$d['listQuestions'] = $this->listQuestions;
		$this->set($d);
		// $this->view($this->quest->getId());
		header('Location: view/'.$this->quest->getId().'/#bottomAdmin');
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
		$this->loadDao('ReponseStg');
		$this->loadDao('Questionnaire');

		$this->reponse = new Reponse("","","");
		$this->reponseStg = new ReponseStg(0,0,0,0);
		$this->quest = $this->Questionnaire->read($this->input["questId"]);

		var_dump($this->input["vide"]);

		if (!isset($this->input["vide"])) {
			if (!isset($this->input["nbR"])) {

				if ($this->ReponseStg->read($this->input["userId"],$this->input["questionId"]) == null) {
					$this->reponse->setQuestion($this->input["questionId"]);
					$this->reponse->setReponse( $this->input["R"]);
					$this->Reponse->create($this->reponse);
					$this->reponseId = DB::lastId();

					$this->reponseStg->setMembreId($this->input["userId"]);
					$this->reponseStg->setReponseId($this->reponseId);
					$this->reponseStg->setNbPass(1);
					$this->reponseStg->setQuestId($this->input["questionId"]);

					$this->ReponseStg->create($this->reponseStg);
				} else {
					// TODO: reponse vue déjà enregistré
				}
				

			} else {
				for ($i = 0; $i < (int) $this->input["nbR"]; $i++) {
					if (isset($this->input["C".$i]) && (int) $this->input["C".$i] == 1) {
						
						if ($this->ReponseStg->read((int) $this->input["userId"],(int) $this->input["questionId"]) == null) {
							$this->reponseStg->setMembreId($this->input["userId"]);
							$this->reponseStg->setReponseId($this->input["R".$i]);

							echo 'Rid : '.$this->input["R".$i];

							$this->reponseStg->setNbPass(1);
							$this->reponseStg->setQuestId($this->input["questionId"]);

							$this->ReponseStg->create($this->reponseStg);
							
							$this->lastRep = $this->reponseStg->getReponseId();
							var_dump($this->lastRep."<br>");
							
						} elseif (isset($this->lastRep) && $this->lastRep != $this->input["R".$i]) {
							$this->reponseStg->setMembreId($this->input["userId"]);
							$this->reponseStg->setReponseId($this->input["R".$i]);
							$this->reponseStg->setNbPass(1);
							$this->reponseStg->setQuestId($this->input["questionId"]);

							$this->ReponseStg->create($this->reponseStg);
						} else {
							echo 'déjà inscript<br>';
						}
					}
				}
			}
		} else {
			

					$this->reponseStg->setMembreId($this->input["userId"]);
					$this->reponseStg->setReponseId(0);
					$this->reponseStg->setNbPass(1);
					$this->reponseStg->setQuestId($this->input["questionId"]);

					$this->ReponseStg->create($this->reponseStg);
		}

		$d['quest'] = $this->quest;
		$this->set($d);
		 // $this->render('view');
		   header('Location: view/'.$this->quest->getId());
	}

}
 ?>
