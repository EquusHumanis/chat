<?php

class User
{
	//Propriétés
	private $id;
	private $login;
	private $pwd;
	private $firstname;
	private $lastname;
	private $address;
	private $zip;
	private $city;
	private $phone;
	private $email;
	private $admin;
	private $birthdate;
	private $gender;

	private $db;
	private $factures;
	private $facture;
	private $comments;


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

	public function getFactures()
	{
		if (!$this->factures)
		{
			$manager = new FactureManager($this->db);
			$this->factures = $manager->findByUser($this);
		}
		return $this->factures;
	}
	public function getCurrentFacture()
	{
		if (!$this->facture)
		{
			$manager = new FactureManager($this->db);
			$this->facture = $manager->findCurrentByUser($this);
		}
		return $this->facture;
	}

	public function getLogin()
	{
		return $this -> login;
	}

	public function getPassword()
	{
		return $this -> pwd;
	}

	public function getFirstname()
	{
		return $this -> firstname;
	}

	public function getLastname()
	{
		return $this -> lastname;
	}

	public function getAddress()
	{
		return $this -> address;
	}

	public function getZip()
	{
		return $this -> zip;
	}

	public function getCity()
	{
		return $this -> city;
	}

	public function getPhone()
	{
		return $this -> phone;
	}

	public function getEmail()
	{
		return $this -> email;
	}

	public function getAdmin()
	{
		return $this -> admin;
	}

	public function getBirthdate()
	{
		return $this -> birthdate;
	}

	public function getGender()
	{
		return $this -> gender;
	}
	public function displayGender()
	{
		if ($this -> gender == 0)
			return "Femme";
		else if ($this -> gender == 1)
			return "Homme";
		return "Autre";
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

	public function setFirstname($firstname)
	{
		if(empty($firstname) || strlen($firstname) < 2 || strlen($firstname) > 63)
			throw new Exception("Le prénom doit être compris entre 2 et 63 caractères");
		else
			$this->firstname = $firstname;
	}

	public function setLastname($lastname)
	{
		if(empty($lastname) || strlen($lastname) < 2 || strlen($lastname) > 63)
			throw new Exception("Le nom de famille doit être compris entre 2 et 63 caractères");
		else
			$this->lastname = $lastname;
	}

	public function setAddress($address)
	{
		if(empty($address) || strlen($address) > 255)
			throw new Exception("Saisissez votre numéro et votre rue");
		else
			$this->address = $address;
	}
	public function setZip($zip)
	{
		if(empty($zip) || strlen($zip) < 4 || strlen($zip) > 11)
			throw new Exception("Saisissez un code postal valide");
		else
			$this->zip = $zip;
	}
	public function setCity($city)
	{
		if (empty($city) || strlen($city) < 2 || strlen($city) > 63)
			throw new Exception("Le ville doit être comprise entre 2 et 63 caractères");
		else
			$this->city = $city;
	}
	public function setPhone($phone)
	{
		if (empty($phone) || strlen($phone) > 31 || !ctype_digit($phone))
			throw new Exception("Veuillez saisir un numéro de téléphone valide (pas d'espace, ni de points");
		else
			$this->phone = $phone;
	}
	public function setEmail($email)
	{
		if (empty($email) || strlen($email) > 63 || !filter_var($email, FILTER_VALIDATE_EMAIL))
			throw new Exception("Merci d'entrer une adresse email valide");
		else
			$this->email = $email;
	}
	public function setAdmin($admin)
	{
		if($gender < 0 || $gender > 1)
			throw new Exception("Erreur interne");
		else
			$this->admin = $admin;
	}
	public function setBirthdate($birthdate)
	{
		if (empty($birthdate))
			throw new Exception("Erreur interne");
		else
			$this->birthdate = $birthdate;
	}
	public function setGender($gender)
	{
		if($gender < 0 || $gender > 1)
			throw new Exception("Erreur interne");
		else
			$this->gender = $gender;
	}
}

?>