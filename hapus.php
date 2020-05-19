<?php 
include 'base.php';
include 'auth.php';
$data = $db->table('file')->where('id', $_GET['id'])->get()[0];
unlink('./file/' . $data->kunci . '_' . $data->nama_file);
$db->table('file')->where('id', $_GET['id'])->delete();
header('Content-Type: application/json');
$data = $db->table('file')->orderBy('id', 'DESC')->get();
echo json_encode($data);