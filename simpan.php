<?php 
include 'base.php';
include 'auth.php';
if ($_GET){
	$db->table('file')->insert(array(
		'nama_file' => $_GET['nama-file'],
		'kunci' => $_GET['kunci']
	));
}
header('Content-Type: application/json');
$data = $db->table('file')->orderBy('id', 'DESC')->get();
echo json_encode($data);