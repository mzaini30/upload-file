<?php 
include 'base.php';
if (!$_POST){
	include 'view/login.php';
} else {
	$cek = $db->table('login')->where('username', $_POST['username'])->where('password', $_POST['password'])->count();
	if ($cek > 0){
		$_SESSION['login'] = true;
		header('Location: /');
	} else {
		header('Location: /login.php');
	}
}