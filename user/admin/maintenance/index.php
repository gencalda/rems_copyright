<?php
	$home = md5('index');
	header('Location: ../index.php?token=$home');
?>