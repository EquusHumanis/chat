<?php
class User
{
	private $id;
	private $login;
	private $password;
	private $date;

	public function getId()
	{
		return $this->id;
	}
	public function getLogin()
	{
		return $this->login;
	}
	public function getHash()
	{
		return $this->password;
	}
	public function getDate()
	{
		return $this->date;
	}
	public function setLogin($login)
	{
		$this->login = $login;
	}
	public function initPassword($password1, $password2)
	{
		if ($password1 != $password2)
			throw new Exception("Passwords don't match");
		$this->password = password_hash($password1, PASSWORD_BCRYPT);
	}
	public function verifPassword($password)
	{
		return password_verify($password, $this->password);
	}
}
?>