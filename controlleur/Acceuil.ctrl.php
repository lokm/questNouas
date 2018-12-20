<?php 
class CtrlAcceuil extends Controller {
 	function index() {

		
		$this->render('index');
	}

	function view($id) {
		
		$this->render('view');
	}
}
 ?>
