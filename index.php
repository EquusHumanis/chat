<?php

	session_start();
	$db = mysqli_connect("192.168.1.95", "tchat", "tchat", "tchat");
	
	$empty = "";
	// Url autoload : http://fr2.php.net/manual/fr/function.autoload.php
	function __autoload($className)
	{
		require('models/'.$className.'.class.php');
	}
	
	$error = '';
	$page = "home";
	$access = ["home","register", "login"];
	$accessIn = [];
	
	if(isset($_GET['page']))
	{
		if(isset($_SESSION['id']))
		{
			if (in_array($_GET['page'], $accessIn))
			{
				$page = $_GET['page'];
			}
		}
		else if(in_array($_GET['page'], $access))
		{
			$page = $_GET['page'];
		}
	}
	
	$traitementList = [
		"register" => "users", "login" => "users", "logout" => "users",
	];
	
	if(isset($_GET['page'], $traitementList[$_GET['page']]))
		require("controllers/traitement_".$traitementList[$_GET['page']].".php");
	else
		require('controllers/skel.php');
?>