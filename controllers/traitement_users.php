<?php
var_dump("ok");

if(isset($_POST["action"]))
{
	if(isset($_GET['page']) && $_GET['page'] == 'logout') {
		session_destroy();
		header('Location: index.php');
		exit;
	}

	if(isset($_POST['action'])) {

		$manager = new UserManager($db);
		$action = $_POST['action'];
		
		if ($action == 'register' && isset($_POST['login'], $_POST['password'])) {
			
			try {
				$user = $manager -> create($_POST['login'], $_POST['password']);
				header('Location: index.php?page=login');
				exit;
			} catch (Exception $e) {
				$error = $e -> getMessage();
			}

		} else if ($action == 'login' && isset($_POST['login'], $_POST['password'])) {
			$login = mysqli_real_escape_string($db, $_POST['login']);
			$password = $_POST['password'];
			$query = "SELECT * FROM users WHERE email ='".$login."' OR login='".$login."'";
			$res = mysqli_query($db, $query);
			$user = mysqli_fetch_assoc($res);
			if ($user) {

				if (password_verify($password, $user['password'])) {

					$_SESSION['id'] = $user['id'];
					$_SESSION['login'] = $user['login'];
					header('Location: index.php');
					exit; 
				} else {
					$error = 'Password incorrect';
				}
			}
		}
	}	
}
var_dump("ok");
?>