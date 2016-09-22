<?php
class UserManager
{
	private $db;

	public function __construct($db)
	{
		$this -> db = $db;
	}

	public function findById($id)
	{
		$id = intval($id);
		$query = "SELECT * FROM users WHERE id='".$id."'";
		$res = mysqli_query($this -> db, $query);
		$user = mysqli_fetch_object($res, "User", [$this -> db]);
		return $user;
	}
	public function findByLogin($login)
	{
		$login = mysqli_real_escape_string($this->db, $login);
		$query = "SELECT * FROM users WHERE login='".$login."'";
		$res = mysqli_query($this -> db, $query);
		$user = mysqli_fetch_object($res, "User", [$this -> db]);
		return $user;
	}

	public function find($id)
	{
		return $this -> findById($id);
	}


	public function create($login, $password, $firstname, $lastname, $address, $zip, $city, $phone, $email, $birthdate, $gender)
	{
		$user = new User($this -> db);
		$user -> setLogin($login);
		$user -> setPassword($password);

		$login 		= mysqli_real_escape_string($this -> db, $user -> getLogin());
		$hash 		= $user -> getPassword();


		$query = "INSERT INTO users (login, password) VALUES('".$login."', '".$hash."')";
		$res = mysqli_query($this->db, $query);
		if (!$res)
				throw new Exception("Erreur interne > ".mysqli_error($this->db));
		$id = mysqli_insert_id($this->db);
		return $this->findById($id);
	}
}
?>