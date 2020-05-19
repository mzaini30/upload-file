<?php 
if ($_SESSION['login'] != true){
	header('Location: /login.php');
}