<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Exercice en ligne</title>
	<link rel="stylesheet" href="/questionnaire/css/main.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
</head>
<body>
	<?php 
	//////////////// ROUTAGE ////////////// 
	define('WEBROOT',str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
	define('ROOT',str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
	
	// chargement des composants principaux du core
	require_once(ROOT.'core/Config.php');
	require_once(ROOT.'core/Bdd.php');
	require_once(ROOT.'core/AbstractEntity.php');
	require_once(ROOT.'core/Controller.php'); 

	// Récupération du controleur et de l'action par l'uri
	$params = explode('/', $_GET["p"]);
	$controller = $params[0];
	$controller = $controller.".ctrl.php";
	$action = isset($params[1]) ? $params[1] : 'index';

	// Initialisation du controleur
	require(ROOT.'controlleur/'.$controller);
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
	<script type="text/javascript" src="/questionnaire/js/quest.js"></script>
</body>
</html>