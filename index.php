<?php

session_start();
$db = new PDO('mysql:dbname=tchat;host=192.168.1.95', 'tchat', 'tchat');

function __autoload($className)
{
	require('models/'.$className.'.class.php');
}

$error = '';
$page = "home";
$access = ["home", "register", "login"];
$accessIn = ["logout", "chat"];

if(isset($_GET['page']))
{
	if(isset($_SESSION['id']) && in_array($_GET['page'], $accessIn))
	{
		$page = $_GET['page'];

	}

	else if(in_array($_GET['page'], $access))
	{
		$page = $_GET['page'];
	}
}

$traitementList = [
	"register" => "users", "login" => "users", "logout" => "users",
	"chat"=>"tchat"
];

if(isset($_GET['page'], $traitementList[$_GET['page']]))
	require("controllers/traitement_".$traitementList[$_GET['page']].".php");
else
	require('controllers/skel.php');
//Ajax
/*
if (isset($_GET['ajax']))
	require('controllers/recherche_res.php');
else
	require('controllers/skel.php');
*/
?>