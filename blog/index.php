<?php
	session_start();
	define('WEBROOT',str_replace('index.php',"",$_SERVER['SCRIPT_NAME']));
	define('ROOT',str_replace('index.php',"",$_SERVER['SCRIPT_FILENAME']));

	

	$params = explode('/',$_GET['p']);
	$controller = $params[0];
	$action = isset($params[1]) ? $params[1] : 'index';
	if(!empty($params[0]))
	{
		require(ROOT.'core/controller.php');
		require('controllers/'.$controller.'.php');
		$controller = new $controller();
		
		if(method_exists($controller, $action))
		{
			unset($params[0]);
			unset($params[1]);
			call_user_func_array(array($controller,$action),$params);
		}
		else
		{
			echo 'erreur 404';
		}
	}
	else
	{
		header('Location: '.WEBROOT.'blog/index/1');
	}
	
?>