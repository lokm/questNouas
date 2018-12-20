<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Exercice en ligne</title>
	<link rel="stylesheet" href="/questionnaire/css/main.css">
</head>
<body>
	<?php 
	define('WEBROOT',str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
	define('ROOT',str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
	
	require_once(ROOT.'core/Config.php');
	require_once(ROOT.'core/Bdd.php');
	require_once(ROOT.'core/AbstractEntity.php');
	require_once(ROOT.'core/Controller.php'); 

	$params = explode('/', $_GET["p"]);
	$controller = $params[0];
	$controller = $controller.".ctrl.php";
	$action = isset($params[1]) ? $params[1] : 'index';

	require(ROOT.'controlleur/'.$controller);
	$controllerFct = explode('.',$controller);
	$controller = "Ctrl".$controllerFct[0];
	$controller = new $controller();

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