<?php 
class Controller {

	var $vars = array();
	var $layout = 'default';

	function __construct() {
		if (isset($_POST)) {
			$this->data = $_POST;
		}
		if (isset($_GET)) {
			$this->data = $_GET;
		}
	}

	function set($d) {
		$this->vars = array_merge($this->vars, $d);
	}

	function render($filename) {
		extract($this->vars);
		ob_start();
		$Controller = substr(get_class($this),4);
		require(ROOT.'vue/'.$Controller.'/'.$filename.'.php');
		$content = ob_get_clean();
		if ($this->layout == false) {
			echo $content;
		} else {
			require(ROOT.'vue/layout/'.$this->layout.'.php');
		}
	}

	function loadDao($name) {
		require_once(ROOT.'dao/'.$name.'.dao.php');
		$daoFile = 'Dao'.$name;
		$this->$name = new $daoFile();
	}
}

 ?>