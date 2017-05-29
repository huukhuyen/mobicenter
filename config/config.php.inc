<?php


//Path
if (! defined ( 'TGTT_PATH' )) {
	define ( "TGTT_PATH", '/shopmobi/' );
}

require_once ('path_config.php.inc');


//Database information
define ( "DATABASE_HOST", "localhost" );
define ( "DATABASE_USER", "root" );
define ( "DATABASE_PASSWD", "" );
define ( "DATABASE_NAME", "web" );



//@Smtp Mail
define ( "SMTP_HOST", "smtp.gmail.com" );
define ( "SMTP_PORT", 465 );
define ( "SMTP_SECURE", "ssl" );
define ( "SMTP_USERNAME", "php.cit.2015@gmail.com" );
define ( "SMTP_PASSWORD", "cntt2015");
define ( "SMTP_TO", "nguyenhuukhuyenudn@gmail.com" );

$url['home'] = BASE_URL;
$url['admin'] = ADMIN_URL;

//ABOUT
if (! defined ( 'HOME_PAGE_LINK' )) {
	define ( "HOME_PAGE_LINK", BASE_URL );
}

if (! defined ( 'CONTACT_PAGE_LINK' )) {
	define ( "CONTACT_PAGE_LINK", BASE_URL . 'lien-he/' );
}


//SEO
if (! defined ( 'DEFAULT_TITLE' )) {
	define ( "DEFAULT_TITLE", 'AUTO POSTER CLOUD' );
}

if (! defined ( 'MAIN_DOMAIN' )) {
	$mainDomain = str_replace ( 'http://', '', BASE_URL );
	$mainDomain = substr ( $mainDomain, 0, strlen ( $mainDomain ) - 1 );
	define ( "MAIN_DOMAIN", $mainDomain );
}

//TIME_VN
if (! defined ( 'TIME_BONUS' )) {
	$h = "7";
	$hm = $h * 60;
	$ms = $hm * 60;
	define ( "TIME_BONUS", $ms );
}


//IMAGE UPLOAD
define("IMAGE_UPLOAD_PATH", ROOT_PATH.'uploads/');


//3MB
define("MAX_IMAGE_SIZE_UPLOAD", 3000000);




