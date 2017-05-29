<?php

require_once ('../../Prepare.php');
$targetFolder = '';



if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	
	if (isset($_COOKIE['category']))
	{
		$cat =  $_COOKIE['category'];
	}
	if (isset($_GET['hoithao']))
	{
	$targetPath = WORKSHOP_LIBRARY_UPLOAD_PATH;
	}
	else if (isset($_GET['thuctap']))
	{
	$targetPath = PRACTICE_LIBRARY_UPLOAD_PATH;
	}
	else
	{
	$targetPath = LIBRARY_UPLOAD_PATH;
	}
	//$date = date("d-m-Y")."-".rand(1, 100);
	
	$date = date("d-m-Y");
	
	
	
	$targetFile = rtrim($targetPath,'/') . '/' . $date .'-'.preg_replace('/\s+/', '_', $_FILES['Filedata']['name']);
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'rar', 'zip', 'ppt', 'pptx'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo '1';
	} else {
		echo 'Invalid file type.';
	}
}
?>