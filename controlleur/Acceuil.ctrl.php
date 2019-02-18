<?php 
class CtrlAcceuil extends Controller {
 	function index() {

		
		$this->render('index');
	}

	function view($id) {
		
		$this->render('view');
	}

	function addCandidat() {
		$this->loadDao('User');

		if ($this->input['lang'] == 0) {
			switch ($this->input['formation']) {
				case '0':
				$this->type = 2; 
				break;
				case '1':
				$this->type = 0;
				break;
				case '2':
				$this->type = 4;
				break;
				
				default:
					# code...
					break;
			}
		} else {
			switch ($this->input['formation']) {
				case '0':
				$this->type = 3; 
				break;
				case '1':
				$this->type = 1;
				break;
				case '2':
				$this->type = 5;
				break;
				
				default:
					# code...
					break;
			}
		}

		

		$this->User->create($this->input['email'],$this->input['pass'], 4, $this->input['lang']);


		$this->render('index');
	}
}
 ?>
