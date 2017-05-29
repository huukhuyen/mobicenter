<?php

require_once('../config/config.php.inc');
require_once(LIBS_PATH.'Mysql.php');
require_once(LIBS_PATH.'Controller.php');
require_once(LIBS_PATH.'Action.php');
require_once(LIBS_PATH.'Error.php');
require_once(LIBS_PATH.'Session.php');
require_once(LIBS_PATH.'Function.php');
require_once(LIBS_PATH.'Account.php');
require_once(LIBS_PATH.'Logs.php');

if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start('ob_gzhandler');
else ob_start();

start_page_load();
?>