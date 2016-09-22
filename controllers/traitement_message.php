<?php
if(isset($_POST["action"]))
{
	if($_POST["action"] == "create")//isset($_SESSION["id"]) &&
	{
		if(isset($_POST["message"]) && !empty($_POST["message"]))
		{
			$userManager = new UserManager($db);
			$messageManager = new MessageManager($db);

			$user = $userManager->findById($_POST["user"]);
			var_dump($user);
			//try if (!$user) throw new Exception("Vous n'êtes plus connecté");

			$message = $messageManager->create(/*$user, */$_POST["message"]);
			var_dump($message);
			if(!$message)
				throw new Exception("Erreur interne");

			exit;
		}
	}
}
?>