<?php

require_once ('../../Prepare.php');
$targetFolder = '';

if (file_exists(LIBRARY_UPLOAD_PATH . $_POST['filename'])) {
	echo 1;
} else {
	echo 0;
}
?>