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

	public function save(User $user)
	{
		$login 		= mysqli_real_escape_string($this -> db, $user -> getLogin());
		$password 	= mysqli_real_escape_string($this -> db, $user -> getPassword());
		$address 	= mysqli_real_escape_string($this -> db, $user -> getAddress());
		$zip 		= mysqli_real_escape_string($this -> db, $user -> getZip());
		$city 		= mysqli_real_escape_string($this -> db, $user -> getCity());
		$phone 		= mysqli_real_escape_string($this -> db, $user -> getPhone());
		$email 		= mysqli_real_escape_string($this -> db, $user -> getEmail());
		$admin 		= mysqli_real_escape_string($this -> db, $user -> getAdmin());
		$id_user 	= $user -> getId();

		if((isset($_SESSION["id"]) && $id_user === $_SESSION["id"]) || (isset($_SESSION["admin"]) && $_SESSION["admin"] === true))
		{
			$query = "UPDATE users SET login='".$login."', password='".$password."', address='".$address."', zip='".$zip."', city='".$city."', phone='".$phone."', email='".$email."', admin='".$admin."' WHERE id='".$id_user."'";
			$res = mysqli_query($this->db, $query);
			if (!$res)
				throw new Exception("Erreur interne > ".mysqli_error($this->db));
			return $this->findById($id);

		}
	}

	public function remove(User $user)
	{
		$id_user = $user->getId();
		if((isset($_SESSION["id"]) && $id_user === $_SESSION["id"]) || (isset($_SESSION["admin"]) && $_SESSION["admin"] === true))
		{
			$query = "DELETE FROM users WHERE id='".$id_user."'";

			$res = mysqli_query($this->db, $query);
			if (!$res)
				throw new Exception("Erreur interne > ".mysqli_error($this->db));

		}
	}

	public function create($login, $password, $firstname, $lastname, $address, $zip, $city, $phone, $email, $birthdate, $gender)
	{
		$user = new User($this -> db);
		$user -> setLogin($login);
		$user -> setPassword($password);
		$user -> setFirstname($firstname);
		$user -> setLastname($lastname);
		$user -> setAddress($address);
		$user -> setZip($zip);
		$user -> setCity($city);
		$user -> setPhone($phone);
		$user -> setEmail($email);
		$user -> setBirthdate($birthdate);
		$user -> setGender($gender);

		$login 		= mysqli_real_escape_string($this -> db, $user -> getLogin());
		$firstname 	= mysqli_real_escape_string($this -> db, $user -> getFirstname());
		$lastname 	= mysqli_real_escape_string($this -> db, $user -> getLastname());
		$address 	= mysqli_real_escape_string($this -> db, $user -> getAddress());
		$zip 		= mysqli_real_escape_string($this -> db, $user -> getZip());
		$city 		= mysqli_real_escape_string($this -> db, $user -> getCity());
		$phone 		= mysqli_real_escape_string($this -> db, $user -> getPhone());
		$email 		= mysqli_real_escape_string($this -> db, $user -> getEmail());
		$birthdate 	= mysqli_real_escape_string($this -> db, $user -> getBirthdate());
		$gender 	= intval($user -> getGender());
		$hash 		= $user -> getPassword();


		$query = "INSERT INTO users (login, password, firstname, lastname, address, zip, city, phone, email, birthdate, gender) VALUES('".$login."', '".$hash."', '".$firstname."', '".$lastname."', '".$address."', '".$zip."', '".$city."', '".$phone."', '".$email."', '".$birthdate."', '".$gender."')";
		$res = mysqli_query($this->db, $query);
		if (!$res)
				throw new Exception("Erreur interne > ".mysqli_error($this->db));
		$id = mysqli_insert_id($this->db);
		return $this->findById($id);

	}
}
?>