<?php 

class CtrlQuestion extends Controller {

	function update() {
		$this->loadDao('Question');
		$this->loadDao('Reponse');

		$dossier = ROOT.'upload/';
		$fichier = basename($this->files['img']['name']);
	

     if (move_uploaded_file($this->files['img']['tmp_name'], $dossier . $fichier)) {
     	$this->log = "upload OK";
     } else {
     	$this->log = "upload KOKO";
     }
      //Si la fonction renvoie TRUE, c'est que ça a fonctionné...

     var_dump( $this->input['nbR']);

		$this->question = $this->Question->read($this->input['qId']);

		if (isset($this->files) && $this->files['img']['name'] != "") {
			$this->question->setImg($fichier);
		}
	



		$this->question->setQuestion($this->input['question']);
		$this->question->setAide($this->input['aide']);

		$this->Question->update($this->question);

		$this->listReponses = $this->Reponse->readAll();

		$this->tabReponses = array();
		$this->tabReponsesUp = array();

		foreach ($this->listReponses as $key => $reponse) {
			if ($reponse->getQuestion() == $this->question->getId()) {
				array_push($this->tabReponses, $reponse->getId());
			}
		}


		for ($i = 0; $i < (int) $this->input['nbR']; $i++) {
			if (isset($this->input['nbR'])) {
			
				if ($this->Reponse->read($this->input['idR'.$i])) {
					$this->reponse = $this->Reponse->read($this->input['idR'.$i]);

					
					$this->reponse->setReponse($this->input['R'.$i]);
					if (isset($this->input['C'.$i])) {
						$this->reponse->setValid($this->input['C'.$i]);
					} else {
						$this->reponse->setValid(0);
					}

					$this->Reponse->update($this->reponse);
					
					array_push($this->tabReponsesUp, $this->reponse->getId());

				} else {
					$this->reponse = new Reponse("","","");

					$this->reponse->setQuestion($this->question->getId());

					$this->reponse->setReponse($this->input['R'.$i]);
					if (isset($this->input['C'.$i])) {
						$this->reponse->setValid($this->input['C'.$i]);
					} else {
						$this->reponse->setValid(0);
					}

					$this->Reponse->create($this->reponse);

					array_push($this->tabReponsesUp, DB::lastId());
					
				}
			}
		}

		$this->tabRepRemove = array_diff($this->tabReponses,$this->tabReponsesUp);

		foreach ($this->tabRepRemove as $key => $repId) {
			$this->Reponse->delete($repId);
		}

	 	header('Location:'.WEBROOT.'Questionnaire/view/'.$this->input['questId']);

	}

	function delete($id) {
		$this->loadDao('Question');

		$this->Question->delete($id);
		// header('Location:'.WEBROOT.'Questionnaire/view/'.$this->input['questId']);
	}

}
 ?>