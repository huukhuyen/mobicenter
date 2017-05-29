<?php

error_reporting(1);
ini_set('display_errors', 1);

//ini_set('open_basedir', '/var/zpanel/hostdata/zadmin/public_html/elearning_dba_edu_vn/:/var/zpanel/hostdata/zadmin/public_html/elearning_dba_edu_vn/moodledata/');
//ini_set('session.save_path','/var/tmp');
//ini_set('max_execution_time','600');
//ini_set('post_max_size','50MB');
//ini_set('upload_max_filesize','50MB');

session_start ();

//session_save_path('/var/zpanel/hostdata/zadmin/public_html/elearning_dba_edu_vn/temp);
//ini_set('session.gc_probability', 1);


//-------------------------
// INCLUDES FILE 
//-------------------------


require_once ('Prepare.php');

require_once (MODELS_PATH . 'Cms.php');
//-------------------------
// INCLUDES SQL PROVIDER
//-------------------------
try {

	$db = new MysqlDatabase ( DATABASE_HOST, DATABASE_USER, DATABASE_PASSWD, DATABASE_NAME );
	$db->connect ();
	
	if (!isset ( $_GET ['reset'] ))
	{
		$account = new Account("cp");
	
		//-------------------------
		// CALL CONTROLLER
		//-------------------------
		$controllers = array (	'Home', 'Login', 'Logs',
								'Member', 'MemberGroup','CmsCategories',
								'Page', 'Links', 'Video', 'VideoCategories', 'Picture', 'PictureCategories', 'Option', 'Support', 'Partner',
								'Cms', 'Product', 'ProductCategories', 'Products', 'PollQuestion', 'PollOption', 'PollVote',
								'Books', 'BooksCategories', 'BooksSubject',
								'Workshop','WorkshopCategories','WorkshopMember','WorkshopCms','WorkshopPermission','WorkshopPost', 'WorkshopTopic',
								'PracticeMember', 'PracticeCompany', 'PracticeMajor', 'Practice', 'PracticePost', 'PracticePermission');
		
		
		$controller = new Controller ( $controllers );
		
		$controller->setDefaultController ( "Home" );

		$controller->execute ('admin');


	}
	else
	{
		require_once ('controllers/MemberController.php');		
	}
	
	
} catch ( Exception $e ) {
	$error = new Error ( "db", "Có lỗi xảy ra! <br/>$e->getMessage()" );
	$error->show ();
	return;
}


?>