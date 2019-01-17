<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Exercice en ligne</title>
	<?php 
	define('WEBROOT',str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
	define('ROOT',str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
	?>
	<link rel="stylesheet" href="<?php echo WEBROOT ?>css/main.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo WEBROOT ?>js/quest.js"></script>
</head>
<body>


	<?php 
	
	
	//////////////// ROUTAGE ////////////// 
	

	// chargement des composants principaux du core
	require_once('core/Config.php');
	require_once('core/Bdd.php');
	require_once('core/AbstractEntity.php');
	require_once('core/Controller.php'); 

	// Récupération du controleur et de l'action par l'uri
	if ($_GET["p"] == "") {
		$_GET["p"] = "Acceuil/index";
	}
	$params = explode('/', $_GET["p"]);
	

	$controller = $params[0];
	$controller = $controller.".ctrl.php";

	$action = isset($params[1]) ? $params[1] : 'index';

	// Initialisation du controleur
	require('controlleur/'.$controller);
	$controllerFct = explode('.',$controller);
	$controller = "Ctrl".$controllerFct[0];
	$controller = new $controller();

	// Execution du controleur et de l'action avec paramètre (3ème param de l'uri)
	if (method_exists($controller,$action)) {
		unset($params[0]);
		unset($params[1]);
		call_user_func_array(array($controller,$action), $params);
	} else {
		echo 'erreur 404';
	}
	
	?>
	
</body>
</html>