<?php
if(!isset($_SESSION['login_user'])){
header('Location: ../../index.php'); // Redirecting To Home Page
}
?>