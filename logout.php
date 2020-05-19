<?php 
include 'base.php';
session_destroy();
header('Location: /login.php');