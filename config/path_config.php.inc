<?php

//Url
if (! defined ( 'BASE_URL' )) {
	define ( "BASE_URL", 'http://' . $_SERVER ["HTTP_HOST"] . TGTT_PATH );
}



if (! defined ( 'DATA_URL' )) {
	define ( "BASE_URL", 'http://' . $_SERVER ["HTTP_HOST"] . TGTT_PATH );
}

if (! defined ( 'ADMIN_URL' )) {
	define ( "ADMIN_URL", BASE_URL . 'quanly/' );
}

//Path
if (! defined ( 'ROOT_PATH' )) {
	define ( "ROOT_PATH", $_SERVER ["DOCUMENT_ROOT"] . TGTT_PATH );
}

if (! defined ( 'ADMIN_PATH' )) {
	define ( "ADMIN_PATH", ROOT_PATH . "quanly/" );
}






//Log
if (! defined ( 'LOG_PATH' )) {
	define ( "LOG_PATH", ROOT_PATH . 'logs/' );
}

if (! defined ( 'IMG_URL' )) {
	define ( 'IMG_URL', BASE_URL . 'images/' );
}

if (! defined ( 'BASE_ADMIN_URL' )) {
	define ( 'BASE_ADMIN_URL', BASE_URL . 'quanly/' );
}


if (! defined ( 'IMG_ADMIN_URL' )) {
	define ( 'IMG_ADMIN_URL', BASE_ADMIN_URL . 'js/' );
}




if (! defined ( 'JS_URL' )) {
	define ( 'JS_URL', BASE_URL . 'js/' );
}

if (! defined ( 'JS_ADMIN_URL' )) {
	define ( 'JS_ADMIN_URL', BASE_ADMIN_URL . 'js/' );
}

if (! defined ( 'CSS_URL' )) {
	define ( 'CSS_URL', BASE_URL . 'css/' );
}

if (! defined ( 'CSS_ADMIN_URL' )) {
	define ( 'CSS_ADMIN_URL', BASE_ADMIN_URL . 'css/' );
}

if (! defined ( 'MODELS_PATH' )) {
	define ( "MODELS_PATH", ADMIN_PATH . 'models/' );
}

if (! defined ( 'VIEWS_PATH' )) {
	define ( "VIEWS_PATH", ROOT_PATH . 'views/' );
}

if (! defined ( 'VIEWS_ADMIN_PATH' )) {
	define ( "VIEWS_ADMIN_PATH", ADMIN_PATH . 'views/' );
}

if (! defined ( 'VIEWS_COMMON_ADMIN_PATH' )) {
	define ( "VIEWS_COMMON_ADMIN_PATH", VIEWS_ADMIN_PATH . 'common/' );
}

if (! defined ( 'VIEWS_COMMON_PATH' )) {
	define ( "VIEWS_COMMON_PATH", VIEWS_PATH . 'common/' );
}

if (! defined ( 'CONTROLLERS_PATH' )) {
	define ( "CONTROLLERS_PATH", ROOT_PATH . 'controllers/' );
}

if (! defined ( 'CONTROLLERS_ADMIN_PATH' )) {
	define ( "CONTROLLERS_ADMIN_PATH", ADMIN_PATH . 'controllers/' );
}

if (! defined ( 'LIBS_PATH' )) {
	define ( "LIBS_PATH", ADMIN_PATH . 'libs/' );
}

//IMAGE
if (! defined ( 'IMAGE_UPLOAD_URL' )) {
	define ( "IMAGE_UPLOAD_URL", BASE_URL . 'uploads/' );
}

// HEADER
$head['CSS'] =  "";
$head['HEADER_JS'] = "";
$head['HEADER_TITLE'] = 	" Website";
$head['HEADER_DESCRIPTION']  =  " Website";
$head['HEADER_KEYWORD'] 	= 	" Website";
$head['HEADER_ABSOLUTE'] 	= 	" Website";


?>