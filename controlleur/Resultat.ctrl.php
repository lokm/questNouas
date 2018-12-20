<?php 
	
	class CtrlResultat extends Controller {
		function index() {

		
		$this->render('index');
	}

	function view($id) {
		
		$this->render('view');
	}
	}

 ?>