<?php 
	
	class CtrlUser extends Controller {
		function login() {
			$this->loadDao('User');

			$salt = "m33GT9*PH12*";

			if ($this->User->checkUser($this->input['email'],sha1($this->input['pass'].$salt))) {
				$this->user = $this->User->read($this->User->checkUser($this->input['email'],sha1($this->input['pass'].$salt)));
				
				var_dump($this->user->getType());
				$_SESSION['id'] = $this->user->getId();
				$_SESSION['type'] = $this->user->getType();
				$_SESSION['lang'] = $this->user->getLang();
				$_SESSION['formation'] = $this->user->getFormation();

			} else {
				$d['log'] = "Email ou mot de passe incorrect, veuillez réessayer";
				header('Location:'.WEBROOT.'Questionnaire/index/');
			}

			

			if ($this->user != null && $this->user->getType() == 4 && $this->User->isCandidatSave($this->user->getId()) == false) {
				header('Location:'.WEBROOT.'Acceuil/index/');
			} else {

				header('Location:'.WEBROOT.'Questionnaire/index/');
			}


		}

		function logout() {
			session_start();
			unset($_SESSION);
			session_destroy();
			session_write_close();
			header('Location:'.WEBROOT.'Questionnaire/index/');
		}

		function subscribe() {
			$this->loadDao('User');


			$this->User->addCandidat($this->input['formation'], $this->input['lieux'], $this->input['nom'], $this->input['prenom'], $this->input['adresse'], $this->input['birth'], $this->input['tel'], $this->input['formationLvl'], $this->input['salarie'], $this->input['societe'], $this->input['cpf'], $this->input['pe'], $this->input['peId'], $this->input['activite'], $this->input['revenu'], $this->input['rsa'], "", $this->input['userId']);

			header('Location:'.WEBROOT.'Questionnaire/index/');
		}
	}
 ?>