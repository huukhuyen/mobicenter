<?php
class Log {
	const EMERG = 0;
	const ALERT = 1;
	const CRIT = 2;
	const ERR = 3;
	const WARN = 4;
	const NOTICE = 5;
	const INFO = 6;
	const DEBUG = 7;
	function ExecuteLog($type, $info) {
		if ($info ['Action'] == "insert" || $info ['Action'] == "update" || $info ['Action'] == "delete") {
			Log::insert_log_file ( $type, $info );
			Log::insert_log_db ( $type, $info );
		}
	}
	function insert_log_file($type, $info) {
		require_once LIBS_PATH . 'KLogger.php';
		
		$log = KLogger::instance ( LOG_PATH, KLogger::DEBUG );
		
		$Username = $info ['Username'] ? $info ['Username'] : $_SESSION ["username"];
		$Username = $Username ? $Username : "";
		
		$dateNow = gmdate ( "d-m-Y H:i:s A", intval ( time () ) );
		
		$text .= $dateNow . ", " . getenv ( "REMOTE_ADDR" ) . ", " . $info ['Controller'] . ", " . $info ['Action'] . ", " . $Username;
		
		switch ($type) {
			
			case Log::INFO :
				$log->logInfo ( $text );
				break;
			
			case Log::NOTICE :
				$log->logNotice ( $text );
				break;
			
			case Log::WARN :
				$log->logWarn ( $text );
				break;
			
			case Log::ERR :
				$log->logError ( $text );
				break;
			
			case Log::FATAL :
				$log->logFatal ( $text );
				break;
			
			case Log::ALERT :
				$log->logAlert ( $text );
				break;
			
			case Log::CRIT :
				$log->logCrit ( $text );
				break;
			
			case Log::EMERG :
				$log->logEmerg ( $text );
				break;
			
			default :
			case Log::INFO :
				$log->logInfo ( $text );
				break;
		}
	}
	function insert_log_db($type, $info) {
		if ($info ['Action'] == "getAll") {
			$data = "Lấy tất cả dữ liệu từ " + $info ['Controller'];
		}
		
		if ($info ['Action'] == "get") {
			$data = "Lấy 1 record dữ liệu từ " + $info ['Controller'];
		}
		
		if ($info ['Action'] == "getPaging") {
			$data = "Lấy danh sách dữ liệu phân trang từ " + $info ['Controller'];
		}
		
		if ($info ['Action'] == "insert") {
			$data = "Thêm dữ liệu từ " + $info ['Controller'];
		}
		
		if ($info ['Action'] == "update") {
			$data = "Cập nhật dữ liệu từ " + $info ['Controller'];
		}
		
		if ($info ['Action'] == "delete") {
			$data = "Xóa dữ liệu từ " + $info ['Controller'];
		}
		
		global $db;
		try {
			$strQuery = "INSERT INTO  logs(LogType, Time, IPAddress, ";
			$strQuery .= "Content, Controller, Action, MemberID, Username) VALUES(";
			$strQuery .= "{$type}, " . time () . ",  '" . getenv ( "REMOTE_ADDR" ) . "', ";
			
			$MemberID = $info ['MemberID'] ? $info ['MemberID'] : $_SESSION ["memberID"];
			$MemberID = $MemberID ? $MemberID : "0";
			$Username = $info ['Username'] ? $info ['Username'] : $_SESSION ["username"];
			$Username = $Username ? $Username : "";
			
			$strQuery .= "'" . filterFormInput ( $data ) . "', '" . $info ['Controller'] . "',  '" . $info ['Action'] . "',  " . $MemberID . ", '" . $Username . "')";
			
			$db->query ( $strQuery );
		} catch ( Exception $e ) {
			$error = new Error ( "db", "Có lỗi xảy ra khi thao tác thêm vào LOG hệ thống ! <br/>$e->getMessage()" );
			$error->show ();
		}
	}
}

?>