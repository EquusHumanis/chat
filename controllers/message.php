<?php
$userManager = new UserManager($db);
$messageManager = new MessageManager($db);
$messages = $messageManager->findAll();
for ($i=0; $i < sizeof($messages); $i++) {
	require("views/message.phtml");
}
?>