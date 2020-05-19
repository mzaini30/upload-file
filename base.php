<?php 
include 'vendor/autoload.php';
session_start();
$beranda = $_SERVER["DOCUMENT_ROOT"];
$db = (new \Pecee\Pixie\Connection('sqlite', [
    'driver'   => 'sqlite',
    'database' => $beranda . '/database.sqlite'
]))->getQueryBuilder();