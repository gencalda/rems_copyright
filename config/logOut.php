<?php
session_start();
session_unset(); 
session_destroy(); 

$logout = md5('logout');
$home = md5('home');

header('location:../user/guest/logIn.php?action='.$logout.'&token='.$home.'');

?>