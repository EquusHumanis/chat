<?php
class UserManager
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}
	public function findById($id)
	{
		$id = intval($id);
		$query = "SELECT * FROM user WHERE id='".$id."'";
		$res = $this->db->query($query, PDO::FETCH_CLASS, "User");
		if ($res)
		{
			$user = $res->fetch();
			return $user;
		}
		else
			throw new Exception("Internal Server Error > ".$this->db->errorInfo()[2]);
	}
	public function create($login, $password1, $password2)
	{
		$user = new User();
		$user->setLogin($login);
		$user->initPassword($password1, $password2);
		$login = $this->db->quote($user->getLogin());
		$hash = $this->db->quote($user->getHash());
		$query = "INSERT INTO user (login, password) VALUES('".$login."', '".$hash."')";
		$res = $this->db->exec($query);
		if ($res)
			return $this->findById($this->db->lastInsertId());
		else
			throw new Exception("Internal Server Error > ".$this->db->errorInfo()[2]);
	}
	public function findAll()
	{
		$query = "SELECT * FROM user ORDER BY date";
		$res = $this->db->query($query, PDO::FETCH_CLASS, "User");
		if ($res)
		{
			$users = $res->fetchAll();
			return $users;
		}
		else
			throw new Exception("Internal Server Error > ".$this->db->errorInfo()[2]);
	}
}
?>