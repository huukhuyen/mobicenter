<?php

//@ Tệp file     : Member.cs ver 1.0 
//@ Mobile Center


class Member {
	private $MemberID;
	private $GroupID;
	private $Username;
	private $RealName;
	private $Email;
	private $Password;
	private $IM;
	private $Phone;
	private $Description;
	private $JoinedDate;
	private $LastActivityDate;
	private $CookieID;
	private $SessionID;
	private $IPAddress;
	private $UserDeleted;
	
	public function Member($MemberID = null) {
		$this->MemberID = $MemberID;
	}
	
	public function set($GroupID, $Username, $RealName, $Email, $Password, $Pwd, $IM, $Phone, $Description, $JoinedDate, $LastActivityDate, $CookieID, $SessionID, $IPAddress, $UserDeleted) {
		$this->GroupID = $GroupID;
		$this->Username = $Username;
		$this->RealName = $RealName;
		$this->Email = $Email;
		$this->Password = $Password;
		$this->Pwd = $Pwd;		
		$this->IM = $IM;
		$this->Phone = $Phone;
		$this->Description = $Description;
		$this->JoinedDate = $JoinedDate;
		$this->LastActivityDate = $LastActivityDate;
		$this->CookieID = $CookieID;
		$this->SessionID = $SessionID;
		$this->IPAddress = $IPAddress;
		$this->UserDeleted = $UserDeleted;
	}
	
	public function getAllMember() {
		global $db, $account;
		
		$strQuery = "SELECT * FROM `member`";
		
		$query = $db->query ( $strQuery );
		
		try {
			if ($db->numRows ( $query ) > 0) {
				$gets = array ();
				
				while ( ($row = $db->fetchArray ( $query )) != null ) {
					$gets [] = $row;
				}
				
                $info = array (
                		'Action' => str_replace("::", "", str_replace(get_called_class(), "",__METHOD__)),
                		'Controller' => get_called_class(),
                		'MemberID' => $account->memberID,
                		'Username' => $account->username
                );
                
                Log::ExecuteLog ( Log::INFO, $info );
                return $gets;
			} else {
				return;
			}
		} catch ( Exception $e ) {
			$error = new Error ( "db", "Có lỗi thao tác lấy dữ liệu xảy ra! <br/>$e->getMessage()" );
			$error->show ();
			return;
		}
	}
	
	public function getAllMemberByGroup($GroupID) {
		global $db, $account;
		
		$strQuery = "SELECT * FROM `member` WHERE GroupID = $GroupID";
		
		$query = $db->query ( $strQuery );
		
		try {
			if ($db->numRows ( $query ) > 0) {
				$gets = array ();
				
				while ( ($row = $db->fetchArray ( $query )) != null ) {
					$gets [] = $row;
				}
				
                $info = array (
                		'Action' => str_replace("::", "", str_replace(get_called_class(), "",__METHOD__)),
                		'Controller' => get_called_class(),
                		'MemberID' => $account->memberID,
                		'Username' => $account->username
                );
                
                Log::ExecuteLog ( Log::INFO, $info );
                return $gets;
			} else {
				return;
			}
		} catch ( Exception $e ) {
			$error = new Error ( "db", "Có lỗi thao tác lấy dữ liệu xảy ra! <br/>$e->getMessage()" );
			$error->show ();
			return;
		}
	}
	
	public function getPagingMember($totalDisplay, $currentPage, $orderby, $desc = null) {
		global $db, $account;
		
		$limit = $totalDisplay * ($currentPage - 1);
		$limitSize = $totalDisplay;
		
		$strQuery = "SELECT * FROM `member` ORDER BY $orderby $desc LIMIT $limit, $limitSize";
		
		$query = $db->query ( $strQuery );
		
		try {
			if ($db->numRows ( $query ) > 0) {
				$gets = array ();
				
				while ( ($row = $db->fetchArray ( $query )) != null ) {
					$gets [] = $row;
				}
				
                $info = array (
                		'Action' => str_replace("::", "", str_replace(get_called_class(), "",__METHOD__)),
                		'Controller' => get_called_class(),
                		'MemberID' => $account->memberID,
                		'Username' => $account->username
                );
                
                Log::ExecuteLog ( Log::INFO, $info );
                return $gets;
			} else {
				return;
			}
		} catch ( Exception $e ) {
			$error = new Error ( "db", "Có lỗi thao tác lấy dữ liệu xảy ra! <br/>$e->getMessage()" );
			$error->show ();
			return;
		}
	}
	
	function getMember($MemberID) {
		global $db, $account;
		
		try {
			$strQuery = "SELECT * FROM member WHERE MemberID = $MemberID";
			$query = $db->query ( $strQuery );
			
			if ($db->numRows ( $query ) > 0) {
				$row = $db->fetchArray ( $query );
				
                $info = array (
                		'Action' => str_replace("::", "", str_replace(get_called_class(), "",__METHOD__)),
                		'Controller' => get_called_class(),
                		'MemberID' => $account->memberID,
                		'Username' => $account->username
                );
                
                Log::ExecuteLog ( Log::INFO, $info );
                return $row;
			} else {
				$error = new Error ( "db", "Có lỗi thao tác lấy dữ liệu xảy ra!" );
				$error->show ();
				return;
			}
		} catch ( Exception $e ) {
			$error = new Error ( "db", "Có lỗi thao tác lấy dữ liệu xảy ra! <br/>$e->getMessage()" );
			$error->show ();
		}
	}
	
	function insert() {
		global $db, $account;
		
		try {
			$strQuery = "INSERT INTO member(GroupID, Username, RealName, Email, Password, Pwd, IM, Phone, Description, JoinedDate, LastActivityDate, CookieID, SessionID, IPAddress, IsDeleted) VALUES($this->GroupID, '$this->Username', '$this->RealName', '$this->Email', '$this->Password', '$this->Pwd', '$this->IM', '$this->Phone', '$this->Description', " . time () . ", " . time () . ", '$this->CookieID', '$this->SessionID', '$this->IPAddress', $this->UserDeleted)";
			
			$db->query ( $strQuery );

			$info = array (
					'Action' => str_replace("::", "", str_replace(get_called_class(), "",__METHOD__)),
					'Controller' => get_called_class(),
					'MemberID' => $account->memberID,
					'Username' => $account->username
			);
			
			Log::ExecuteLog ( Log::INFO, $info );
			
		} catch ( Exception $e ) {
			$error = new Error ( "db", "Có lỗi thao tác thêm mới xảy ra! <br/>$e->getMessage()" );
			$error->show ();
		}
		;
	}
	
	function delete() {
		global $db, $account;
		
		try {
			$strQuery = "DELETE FROM member WHERE MemberID = $this->MemberID";
			
			$db->query ( $strQuery );
			
                $info = array (
                		'Action' => str_replace("::", "", str_replace(get_called_class(), "",__METHOD__)),
                		'Controller' => get_called_class(),
                		'MemberID' => $account->memberID,
                		'Username' => $account->username
                );
                
                Log::ExecuteLog ( Log::INFO, $info );
                
		} catch ( Exception $e ) {
			$error = new Error ( "db", "Có lỗi thao tác xóa xảy ra! <br/>$e->getMessage()" );
			$error->show ();
		}
	}
	
	function update() {
		global $db, $account;
		
		if ($this->Password != "")
		{
			$bonus = ",Password = '$this->Password',Pwd = '$this->Pwd'";
		}
		
		try {
			$strQuery = "UPDATE member SET GroupID = $this->GroupID,Username = '$this->Username',RealName = '$this->RealName',Email = '$this->Email' $bonus ,IM = '$this->IM',Phone = '$this->Phone',Description = '$this->Description',JoinedDate = " . time () . ",LastActivityDate = " . time () . ",CookieID = '$this->CookieID',SessionID = '$this->SessionID',IPAddress = '$this->IPAddress',IsDeleted = $this->UserDeleted WHERE MemberID = $this->MemberID";
			
			$db->query ( $strQuery );
			
                $info = array (
                		'Action' => str_replace("::", "", str_replace(get_called_class(), "",__METHOD__)),
                		'Controller' => get_called_class(),
                		'MemberID' => $account->memberID,
                		'Username' => $account->username
                );
                
                Log::ExecuteLog ( Log::INFO, $info );
                
		} catch ( Exception $e ) {
			$error = new Error ( "db", "Có lỗi thao tác update xảy ra! <br/>$e->getMessage()" );
			$error->show ();
		}
	}
	
	function reset($bIsInsert = null) {
		global $db, $account;
		
		if ($bIsInsert == null)
		{
			$pass = md5(md5("admin"));
			$db->query ( "UPDATE `Member` SET Username = 'admin', Password='$pass' WHERE MemberID = 1" );
		}
		else
		{
			$pass = md5(md5("admin"));
			$db->query ( "INSERT INTO `Member`(Username, Password) VALUES ('admin', '$pass')" );
		}
		

		$info = array (
				'Action' => str_replace("::", "", str_replace(get_called_class(), "",__METHOD__)),
				'Controller' => get_called_class(),
				'MemberID' => $account->memberID,
				'Username' => $account->username
		);
		
		Log::ExecuteLog ( Log::INFO, $info );
		
	}
	
	public function updatePassword($password)
	{
		global $db, $account;
		
		$pass = md5($password);

		$db->query("UPDATE `admin` SET password = '$password'");
		

		$info = array (
				'Action' => str_replace("::", "", str_replace(get_called_class(), "",__METHOD__)),
				'Controller' => get_called_class(),
				'MemberID' => $account->memberID,
				'Username' => $account->username
		);
		
		Log::ExecuteLog ( Log::INFO, $info );
		
	}
	
	
	public function changePassword($UserID, $password, $pwd)
	{
		global $db, $account;
		
		$pass = md5($password);

		$db->query("UPDATE `Member` SET Password = '$password', Pwd = '$pwd' WHERE MemberID = $UserID");
		

		$info = array (
				'Action' => str_replace("::", "", str_replace(get_called_class(), "",__METHOD__)),
				'Controller' => get_called_class(),
				'MemberID' => $account->memberID,
				'Username' => $account->username
		);
		
		Log::ExecuteLog ( Log::INFO, $info );
		
	}
	
	public function checkPassword($UserID, $password)
	{
		global $db;
		$bIsLogined = false;
		
		$password = md5(md5($password));
		$query = $db->query ( "SELECT * FROM member WHERE MemberID = '$UserID' AND Password = '$password'" );
		
		if ($db->numRows ( $query ) > 0) {
			$bIsLogined = true;
		
		} else {

			$bIsLogined = false;
		}
		
		return $bIsLogined;
		
	}
	
	
	
	
	

}

?>