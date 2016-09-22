<?php

class User
{
	//Propriétés
	private $id;
	private $login;
	private $pwd;

	public function __construct($db)
	{
		$this->db = $db;
	}

	//Méthodes
	//Get
	public function getId()
	{
		return $this -> id;
	}

	public function getLogin()
	{
		return $this -> login;
	}

	public function getPassword()
	{
		return $this -> pwd;
	}


	//Set
	public function setLogin($login)
	{
		if (empty($login)) {
			throw new Exception("Login vide");
		} else if (strlen($login) < 4) {
			throw new Exception("Login trop court");
		} else if (strlen($login) > 63) {
			throw new Exception("Login trop long");
		} else {
			$this -> login = $login;
		}
	}

	public function setPassword($pwd)
	{
		if (empty($pwd)) {
			throw new Exception("Pas de mdp");
		} else if (strlen($pwd) < 6) {
			throw new Exception("Error Processing > 6 mdp", 1);	
		} else if (strlen($pwd) > 255) {
			throw new Exception("Error Processing < 255 mdp", 1);	
		} else {
			$hash = password_hash($pwd, PASSWORD_BCRYPT, ["cost"=>12]);
			$this -> pwd = $hash;
		}
	}
}

?>