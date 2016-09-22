<?php

	session_start();
<<<<<<< HEAD
	$db = mysqli_connect("192.168.1.95:1337", "tchat", "tchat", "tchat");
	
=======
	$db = mysqli_connect("192.168.1.95", "tchat", "tchat", "tchat");
	
	$empty = "";
	// Url autoload : http://fr2.php.net/manual/fr/function.autoload.php
>>>>>>> 340c8e4cb8291cb0d44283d0476ef9e4cfdea3f8
	function __autoload($className)
	{
		require('models/'.$className.'.class.php');
	}
	
	$error = '';
	$page = "home";
<<<<<<< HEAD
	$access = ["register", "login"];
	$accessIn = ["logout"];
	
	if(isset($_GET['page']))
	{
		if(isset($_SESSION['id']) && in_array($_GET['page'], $accessIn))
		{
			$page = $_GET['page'];
=======
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
>>>>>>> 340c8e4cb8291cb0d44283d0476ef9e4cfdea3f8
		}
		else if(in_array($_GET['page'], $access))
		{
			$page = $_GET['page'];
		}
	}
	
	$traitementList = [
<<<<<<< HEAD
		"register" => "users", "login" => "users", "logout" => "users"	
=======
		"register" => "users", "login" => "users", "logout" => "users",
>>>>>>> 340c8e4cb8291cb0d44283d0476ef9e4cfdea3f8
	];
	
	if(isset($_GET['page'], $traitementList[$_GET['page']]))
		require("controllers/traitement_".$traitementList[$_GET['page']].".php");
<<<<<<< HEAD

	//Ajax
	if (isset($_GET['ajax']))
		require('controllers/recherche_res.php');
=======
>>>>>>> 340c8e4cb8291cb0d44283d0476ef9e4cfdea3f8
	else
		require('controllers/skel.php');
?>