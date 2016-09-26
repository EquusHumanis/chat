<?php
if (isset($_POST['action']))
{
	$action = $_POST['action'];
	if ($action == 'login' && isset($_POST['login'], $_POST['password']))
	{
		$manager = new UserManager($db);
		$user = $manager->findByLogin($_POST['login']);
		if ($user)
		{
			if ($user->verifPassword($_POST['password']))
			{
				$_SESSION['id'] = $user->getId();
				$_SESSION['user'] = $user->getLogin();

				header('Location: index.php?page=home');
				exit;
			}
			else
				$_SESSION['error'] = 'Wrong password';
		}
		else
			$_SESSION['error'] = 'User not found';
	}
	else if ($action == 'register' && isset($_POST['login'], $_POST['password1'], $_POST['password2']))
	{
		$manager = new UserManager($db);
		try
		{
			$user = $manager->create($_POST['login'], $_POST['password1'], $_POST['password2']);
			header('Location: index.php?page=login');
			exit;
		}
		catch (Exception $e)
		{
			$_SESSION['error'] = $e->getMessage();
		}
	}
}
else if (isset($_GET['page']) && $_GET['page'] == 'logout')
{
	session_destroy();
	header('Location: index.php');
	exit;
}
?>