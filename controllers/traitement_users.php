<?php 

	if(isset($_GET['page']) && $_GET['page'] == 'logout') {
		session_destroy();
		header('Location: index.php');
		exit;
	}

	if(isset($_POST['action'])) {

		$manager = new UserManager($db);
		$action = $_POST['action'];
		
		if ($action == 'register' && isset($_POST['email'], $_POST['login'], $_POST['pwd'])) {
			
			try {
				$user = $manager -> create($_POST['login'], $_POST['pwd'], $_POST['firstname'], $_POST['lastname'], $_POST['address'], $_POST['zip'], $_POST['city'], $_POST['phone'], $_POST['email'], $_POST['birthdate'], $_POST['gender']);
				header('Location: index.php?page=login');
				exit;
			} catch (Exception $e) {
				$error = $e -> getMessage();
			}

		} else if ($action == 'login' && isset($_POST['login'], $_POST['pwd'])) {
			$login = mysqli_real_escape_string($db, $_POST['login']);
			$password = $_POST['pwd'];
			$query = "SELECT * FROM users WHERE email ='".$login."' OR login='".$login."'";
			$res = mysqli_query($db, $query);
			$user = mysqli_fetch_assoc($res);
			if ($user) {

				if (password_verify($password, $user['password'])) {

					$_SESSION['id'] = $user['id'];
					$_SESSION['login'] = $user['login'];
					$_SESSION['email'] = $user['email'];
					$_SESSION['admin'] = $user['admin'];
					header('Location: index.php');
					exit; 
				} else {
					$error = 'Password incorrect';
				}
			} else {
				$error = ' Email or Login incorrect';
			}
		}
	}	
?>