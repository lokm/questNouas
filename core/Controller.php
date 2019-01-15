<?php 
// Controlleur principal, définie toute les méthodes communes aux autres controlleurs.
class Controller {

	var $vars = array();
	var $layout = 'default';


	function __construct() {
		// Récuparation des données du POST dans la variable input
		if (isset($_POST)) {
			$this->input = $_POST;
		}
	}

	// méthode pour affecter des données à la variable $d servant à transporter les données.
	function set($d) {
		$this->vars = array_merge($this->vars, $d);
	}

	// Méthode pour charger une vue
	function render($filename) {
		extract($this->vars);
		ob_start();
		$Controller = substr(get_class($this),4);
		require('vue/'.$Controller.'/'.$filename.'.php');
		$content = ob_get_clean();
		if ($this->layout == false) {
			echo $content;
		} else {
			require('vue/layout/'.$this->layout.'.php');
		}
	}

	// Méthode pour charger un objet DAO 
	function loadDao($name) {
		require_once('dao/'.$name.'.dao.php');
		$daoFile = 'Dao'.$name;
		$this->$name = new $daoFile();
	}
}

 ?>