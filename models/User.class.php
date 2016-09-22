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
	public function getPassword()
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
	public function setPassword($password)
	{
		$this->password = $password;
	}
}
?>