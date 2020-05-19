<?php 
include 'base.php';
include 'auth.php';
$config = new \Flow\Config();
$config->setTempDir('./cache');
$request = new \Flow\Request();
$uploadFolder = './file/'; // Folder where the file will be stored
$uploadFileName = $_GET['kunci']."_".$request->getFileName(); // The name the file will have on the server
$uploadPath = $uploadFolder.$uploadFileName;
if (\Flow\Basic::save($uploadPath, $config, $request)) {
  // file saved successfully and can be accessed at $uploadPath
	echo 'File diupload';
} else {
  // This is not a final chunk or request is invalid, continue to upload.
	echo 'File gagal diupload';
}