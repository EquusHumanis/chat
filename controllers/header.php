<?php
//Ajax
$search = '';
if (isset($_GET['search']))
	$search = $_GET['search'];
//

if (isset($_SESSION['id']))
	require('views/header_in.phtml');
else
	require('views/header.phtml');
?>