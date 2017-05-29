<?php

// @ Tên file : Cms.cs ver 1.0
// @ Ngày tạo : TuanNA
class Cms {
	private $CmsID;
	private $Module;
	private $MetaTitle;
	private $MetaDescription;
	private $MetaKeyword;
	private $Slug;
	private $Title;
	private $Avatar;
	private $SimpleContent;
	private $Content;
	private $Status;
	private $Star;
	private $Event;
	private $ViewedCount;
	private $DateUpdated;
	private $MemberID;
	public function Cms($CmsID = null) {
		$this->CmsID = $CmsID;
	}
	public function set($CategoryID, $MetaTitle, $MetaDescription, $MetaKeyword, $Slug, $Title, $Avatar, $SimpleContent, $Content, $Status, $Star, $Event, $ViewedCount, $DateUpdated, $MemberID) {
		$this->CategoryID = $CategoryID;
		$this->MetaTitle = $MetaTitle;
		$this->MetaDescription = $MetaDescription;
		$this->MetaKeyword = $MetaKeyword;
		$this->Slug = $Slug;
		$this->Title = $Title;
		$this->Avatar = $Avatar;
		$this->SimpleContent = $SimpleContent;
		$this->Content = $Content;
		$this->Status = $Status;
		$this->Star = $Star;
		$this->Event = $Event;
		$this->ViewedCount = $ViewedCount;
		$this->DateUpdated = $DateUpdated;
		$this->MemberID = $MemberID;
	}
	public function getAllType() {
		global $db, $account;
		
		$strQuery = "SELECT Module, Title FROM `cms` GROUP BY Module";
		
		$query = $db->query ( $strQuery );
		
		try {
			if ($db->numRows ( $query ) > 0) {
				$gets = array ();
				
				while ( $row = $db->fetchArray ( $query ) ) {
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
			$error = new Error ( "db", "Có lỗi thao tác dữ liệu! <br/>$e->getMessage()" );
			$error->show ();
			return;
		}
	}
	public function getAllDaoTao($slug) {
		global $db, $account;
		$strQuery = "SELECT a.Title, a.Content, a.Slug FROM cms AS a, cms_categories AS b WHERE a.CategoryID = b.CategoryID AND b.Slug like '$slug'";
		
		// die($strQuery);
		$query = $db->query ( $strQuery );
		
		try {
			if ($db->numRows ( $query ) > 0) {
				$gets = array ();
				
				while ( $row = $db->fetchArray ( $query ) ) {
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
			$error = new Error ( "db", "Có lỗi thao tác dữ liệu! <br/>$e->getMessage()" );
			$error->show ();
			return;
		}
	}
	public function getAllCms($type = null, $status = null, $orderby = null) {
		global $db, $account;
		
		if ($type != null) {
			$bonus = " AND (b.Slug LIKE '$type')";
		}
		
		if ($status != null) {
			$bonus2 = "AND `Status` = 1";
		}
		
		if ($orderby != null) {
			$orderby = " ORDER BY  $orderby DESC";
		} else {
			$orderby = " ORDER BY  DateUpdated DESC";
		}
		
		$strQuery = "SELECT a.*, b.Slug AS cSlug, c.Slug AS dSlug  FROM `cms` AS a, `cms_categories` AS b, `cms_categories` AS c WHERE a.CategoryID = b.CategoryID AND b.ParentID = c.CategoryID " . $bonus . $bonus2 . $orderby;
		
		// die($strQuery);
		$query = $db->query ( $strQuery );
		
		try {
			if ($db->numRows ( $query ) > 0) {
				$gets = array ();
				
				while ( $row = $db->fetchArray ( $query ) ) {
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
			$error = new Error ( "db", "Có lỗi thao tác dữ liệu! <br/>$e->getMessage()" );
			$error->show ();
			return;
		}
	}
	public function getAllCmsSitemap() {
		global $db, $account;
		
		if ($type != null) {
			$bonus = " AND (b.Slug LIKE '$type')";
		}
		
		if ($status != null) {
			$bonus2 = "AND `Status` = 1";
		}
		
		if ($orderby != null) {
			$orderby = " ORDER BY  $orderby DESC";
		} else {
			$orderby = " ORDER BY  DateUpdated DESC";
		}
		
		$strQuery = "SELECT a.*, b.Slug AS cSlug, '' AS dSlug FROM `cms` AS a, `cms_categories` AS b WHERE a.CategoryID = b.CategoryID AND b.ParentID = 0 ";
		$strQuery .= "UNION ALL (SELECT a.*, b.Slug AS cSlug, c.Slug As dSlug FROM `cms` AS a, `cms_categories` AS b, `cms_categories` AS c WHERE ";
		$strQuery .= "a.CategoryID = b.CategoryID AND b.ParentID = c.CategoryID)";
		
		// die($strQuery);
		$query = $db->query ( $strQuery );
		
		try {
			if ($db->numRows ( $query ) > 0) {
				$gets = array ();
				
				while ( $row = $db->fetchArray ( $query ) ) {
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
			$error = new Error ( "db", "Có lỗi thao tác dữ liệu! <br/>$e->getMessage()" );
			$error->show ();
			return;
		}
	}
	public function getPagingCms($totalDisplay, $currentPage, $orderby, $desc = null, $type = null, $parentID = null, $keyword = null) {
		global $db, $account;
		
		$limit = $totalDisplay * ($currentPage - 1);
		$limitSize = $totalDisplay;
		
		if ($parentID != null) {
			if (is_numeric ( trim ( $parentID ) )) {
				$parentID = " AND (b.ParentID =" . $parentID . " OR b.CategoryID =" . $parentID . ")";
			} else {
				$parentID = "";
			}
		}
		if ($type != null) {
			$type = " AND (c.Slug LIKE '" . $type . "') AND c.CategoryID = b.ParentID";
		} else {
			$type2 = "AND c.CategoryID = b.CategoryID ";
		}
		
		if ($keyword != null) {
			
			$type = " AND (a.Content LIKE '%" . $keyword . "%')";
		}
		
		$strQuery = "SELECT a.*, b.Slug AS cSlug, c.Slug AS dSlug, c.Name AS cCategoryName, b.Name AS CmsTitle, c.ParentID  FROM `cms` AS a, `cms_categories` AS b, `cms_categories` AS c WHERE a.CategoryID = b.CategoryID $parentID $type $type2 ORDER BY $orderby $desc LIMIT $limit, $limitSize";
		
		//die($strQuery);
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
	public function getPagingCmsParent($totalDisplay, $currentPage, $orderby, $desc = null, $type = null, $slug2 = null) {
		global $db, $account;
		
		$limit = $totalDisplay * ($currentPage - 1);
		$limitSize = $totalDisplay;
		
		if ($slug2 != null) {
			$slug2 = " AND (b.Slug LIKE '" . $slug2 . "')";
		}
		
		$strQuery = "SELECT a.*, b.Slug AS cSlug, b.Name AS CmsTitle FROM `cms` AS a, `cms_categories` AS b WHERE a.CategoryID = b.CategoryID AND Status = 1 $slug2 ORDER BY $orderby $desc LIMIT $limit, $limitSize";
		
		// die($strQuery);
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
	public function getAllStarCms($type = null, $number, $ASC = null) {
		global $db, $account;
		
		if ($type != null) {
			$bonus = " AND b.Slug LIKE '$type'";
		}
		
		$order = "DESC";
		if ($ASC != null) {
			$order = "ASC";
		}
		
		$strQuery = "SELECT a.*, b.Slug AS cSlug FROM `cms` AS a, `cms_categories` AS b WHERE a.CategoryID = b.CategoryID AND Status = 1 AND Star = 1 " . $bonus . " ORDER BY DateUpdated $order LIMIT 0," . $number;
		
		// die($strQuery);
		$query = @$db->query ( $strQuery );
		
		try {
			if ($db->numRows ( $query ) > 0) {
				$gets = array ();
				
				while ( $row = $db->fetchArray ( $query ) ) {
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
			$error = new Error ( "db", "Có lỗi thao tác dữ liệu! <br/>$e->getMessage()" );
			$error->show ();
			return;
		}
	}
	public function getAllEventCms($number, $ASC = null) {
		global $db, $account;
		
		$order = "DESC";
		if ($ASC != null) {
			$order = "ASC";
		}
		
		$strQuery = "SELECT a.*, b.Slug AS cSlug  ";
		$strQuery .= "FROM `cms` AS a, `cms_categories` AS b ";
		$strQuery .= "WHERE  ";
		$strQuery .= "a.CategoryID = b.CategoryID  ";
		// $strQuery .= "AND ";
		// $strQuery .= "( b.ParentID = 59 || b.ParentID = 62) ";
		
		$strQuery .= "AND a.Status = 1  ";
		$strQuery .= "AND a.Event = 1  ";
		
		$strQuery .= "ORDER BY DateUpdated DESC LIMIT 0,100";
		
		// die($strQuery);
		$query = @$db->query ( $strQuery );
		
		try {
			if ($db->numRows ( $query ) > 0) {
				$gets = array ();
				
				while ( $row = $db->fetchArray ( $query ) ) {
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
			$error = new Error ( "db", "Có lỗi thao tác dữ liệu! <br/>$e->getMessage()" );
			$error->show ();
			return;
		}
	}
	public function getAllMathCms($number, $ASC = null) {
		global $db, $account;
		
		$order = "DESC";
		if ($ASC != null) {
			$order = "ASC";
		}
		
		$strQuery = "SELECT a.*, b.Slug AS cSlug  ";
		$strQuery .= "FROM `cms` AS a, `cms_categories` AS b ";
		$strQuery .= "WHERE  ";
		$strQuery .= "a.CategoryID = b.CategoryID  ";
		// $strQuery .= "AND ";
		// $strQuery .= "( b.ParentID = 59 || b.ParentID = 62) ";
		
		$strQuery .= "AND a.Status = 1 AND b.Slug LIKE 'ket-qua-hoc-tap' ";
		
		$strQuery .= "ORDER BY DateUpdated DESC LIMIT 0,100";
		
		// die($strQuery);
		$query = @$db->query ( $strQuery );
		
		try {
			if ($db->numRows ( $query ) > 0) {
				$gets = array ();
				
				while ( $row = $db->fetchArray ( $query ) ) {
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
			$error = new Error ( "db", "Có lỗi thao tác dữ liệu! <br/>$e->getMessage()" );
			$error->show ();
			return;
		}
	}
	public function getAllLatestActiveCms($type = null, $from = 0, $number = 10, $ASC = null, $star = null, $event = null) {
		global $db, $account;
		
		if ($type != null) {
			$bonus = " AND b.Slug LIKE '$type'";
		}
		
		$order = "DESC";
		if ($ASC != null) {
			$order = "ASC";
		}
		
		if ($star != null) {
			$star = " AND a.Star = 1 ";
		}
		
		if ($event != null) {
			$star .= " AND a.Event = 0 ";
		}
		
		$strQuery = "SELECT a.*, b.Slug AS cSlug FROM `cms` AS a, `cms_categories` AS b WHERE a.CategoryID = b.CategoryID AND a.Status = 1 " . $star . $bonus . " ORDER BY DateUpdated $order LIMIT $from," . $number;
		
		
		$query = @$db->query ( $strQuery );
		
		try {
			if ($db->numRows ( $query ) > 0) {
				$gets = array ();
				
				while ( $row = $db->fetchArray ( $query ) ) {
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
			$error = new Error ( "db", "Có lỗi thao tác dữ liệu! <br/>$e->getMessage()" );
			$error->show ();
			return;
		}
	}
	public function getAllLatestActiveHomeCms($type = null, $from = 0, $number = 10, $ASC = null, $star = null, $event = null, $subtract = null) {
		global $db, $account;
		
		if ($type != null) {
			$bonus = " AND b.Slug LIKE '$type'";
		}
		
		 
		$order = "DESC";
		if ($ASC != null) {
			$order = "DESC";
		} else {
			$order = "ASC";
		}
		
		if ($star != null) {
			$star = " AND a.Star = 1 ";
		}
		
		
		if ($event != null) {
			$star .= " AND a.Event = 0 ";
		}
		
		if ($subtract != null) {
			$bonus .= " AND b.Slug NOT LIKE '$subtract' ";
		}
		
		$strQuery = "SELECT a.*, b.Slug AS cSlug FROM `cms` AS a, `cms_categories` AS b, `cms_categories` AS c WHERE a.CategoryID = b.CategoryID AND b.ParentID = c.CategoryID AND a.Status = 1 " . $star . $bonus . " ORDER BY DateUpdated $order LIMIT $from," . $number;

		
		$query = @$db->query ( $strQuery );
		
		try {
			if ($db->numRows ( $query ) > 0) {
				$gets = array ();
				
				while ( $row = $db->fetchArray ( $query ) ) {
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
			$error = new Error ( "db", "Có lỗi thao tác dữ liệu! <br/>$e->getMessage()" );
			$error->show ();
			return;
		}
	}
	public function getAllLatestActiveCmsSub($type = null, $number = 10, $ASC = null, $CmsID = null) {
		global $db, $account;
		
		if ($type != null) {
			$bonus = " AND b.Slug LIKE '$type'";
		}
		
		$order = "DESC";
		if ($ASC != null) {
			$order = "ASC";
		}
		
		$strQuery = "SELECT a.*, b.Slug AS cSlug FROM `cms` AS a, `cms_categories` AS b WHERE a.CategoryID = b.CategoryID AND CmsID <> " . $CmsID . " AND Status = 1 " . $bonus . " ORDER BY DateUpdated $order LIMIT 0," . $number;
		
		// die($strQuery);
		$query = @$db->query ( $strQuery );
		
		try {
			if ($db->numRows ( $query ) > 0) {
				$gets = array ();
				
				while ( $row = $db->fetchArray ( $query ) ) {
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
			$error = new Error ( "db", "Có lỗi thao tác dữ liệu! <br/>$e->getMessage()" );
			$error->show ();
			return;
		}
	}
	function getCms($CmsID) {
		global $db, $account;
		
		try {
			$strQuery = "SELECT a.*, b.Slug AS cSlug FROM cms AS a, cms_categories AS b WHERE a.CategoryID = b.CategoryID AND CmsID = $CmsID";
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
				return;
			}
		} catch ( Exception $e ) {
			$error = new Error ( "db", "Có lỗi thao tác dữ liệu! <br/>$e->getMessage()" );
			$error->show ();
		}
	}
	function getCmsFront($type, $slug) {
		global $db, $account;
		
		try {
			$strQuery = "SELECT a.*, b.Slug AS cSlug FROM cms AS a, cms_categories AS b WHERE a.CategoryID = b.CategoryID AND a.Slug like '$slug'";
			// die($strQuery);
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
				return;
			}
		} catch ( Exception $e ) {
			$error = new Error ( "db", "Có lỗi thao tác dữ liệu! <br/>$e->getMessage()" );
			$error->show ();
		}
	}
	function insert($type = null) {
		global $db, $account;
		
		if ($type == null) {
			$bonus = " $type ";
		}
		
		try {
			$strQuery = "INSERT INTO cms(CategoryID, MemberID, MetaTitle, MetaDescription, MetaKeyword, Slug, Title, Avatar, SimpleContent, Content, Status, Star, Event, ViewedCount, DateUpdated) VALUES($this->CategoryID, $this->MemberID, '$this->MetaTitle', '$this->MetaDescription', '$this->MetaKeyword', '$this->Slug', '$this->Title', '$this->Avatar', '$this->SimpleContent', '$this->Content', $this->Status, $this->Star, $this->Event, $this->ViewedCount, " . time () . ")";
			// die($strQuery);
			$db->query ( $strQuery );

			$info = array (
					'Action' => str_replace("::", "", str_replace(get_called_class(), "",__METHOD__)),
					'Controller' => get_called_class(),
					'MemberID' => $account->memberID,
					'Username' => $account->username
			);
			
			Log::ExecuteLog ( Log::INFO, $info );
			
		} catch ( Exception $e ) {
			//$error = new Error ( "db", "Có lỗi thao tác dữ liệu! <br/>Bài viết này đã được tạo, bạn không thẻ tạo thêm 1 bài cùng nội dung nữa" );
			//$error->show ();
		}
		
	}
	function delete() {
		global $db, $account;
		
		try {
			$strQuery = "DELETE FROM cms WHERE CmsID = $this->CmsID";
			
			$db->query ( $strQuery );
			
                $info = array (
                		'Action' => str_replace("::", "", str_replace(get_called_class(), "",__METHOD__)),
                		'Controller' => get_called_class(),
                		'MemberID' => $account->memberID,
                		'Username' => $account->username
                );
                
                Log::ExecuteLog ( Log::INFO, $info );
                
		} catch ( Exception $e ) {
			$error = new Error ( "db", "Có lỗi thao tác dữ liệu! <br/>$e->getMessage()" );
			$error->show ();
		}
	}
	function update($OverwriteDateUpdate = null, $time = null) {
		global $db, $account;
		
		if ($OverwriteDateUpdate != null) {
			
			if ($time == null) {
				
				$DateUpdated = ", DateUpdated = " . time ();
			} else {
				
				$DateUpdated = ", DateUpdated = " . $time;
			}
		}
		try {
			$strQuery = "UPDATE cms SET CategoryID = $this->CategoryID,MetaTitle = '$this->MetaTitle',MetaDescription = '$this->MetaDescription',MetaKeyword = '$this->MetaKeyword',Slug = '$this->Slug',Title = '$this->Title',Avatar = '$this->Avatar',SimpleContent = '$this->SimpleContent',Content = '$this->Content',Status = $this->Status, Star = $this->Star, Event = $this->Event, ViewedCount = $this->ViewedCount $DateUpdated WHERE CmsID = $this->CmsID";
			// die($strQuery);
			$db->query ( $strQuery );
			
                $info = array (
                		'Action' => str_replace("::", "", str_replace(get_called_class(), "",__METHOD__)),
                		'Controller' => get_called_class(),
                		'MemberID' => $account->memberID,
                		'Username' => $account->username
                );
                
                Log::ExecuteLog ( Log::INFO, $info );
                
		} catch ( Exception $e ) {
			$error = new Error ( "db", "Có lỗi thao tác dữ liệu! <br/>Bài viết này đã được tạo, bạn không thẻ update thêm 1 bài cùng nội dung nữa" );
			$error->show ();
		}
	}
	function getLastNews($number) {
		global $db, $account;
		
		$query = $db->query ( "SELECT a.*, b.Slug AS cSlug FROM cms AS a, cms_categories AS b WHERE a.CategoryID = b.CategoryID AND a.Status = 1 ORDER BY a.DateUpdated DESC LIMIT 0, $number" );
		
		if ($db->numRows ( $query ) > 0) {
			$pages = array ();
			
			while ( $row = $db->fetchArray ( $query ) ) {
				$pages [] = $row;
			}

			$info = array (
					'Action' => str_replace("::", "", str_replace(get_called_class(), "",__METHOD__)),
					'Controller' => get_called_class(),
					'MemberID' => $account->memberID,
					'Username' => $account->username
			);
			
			Log::ExecuteLog ( Log::INFO, $info );
			
			return $pages;
		} else {
			return null;
		}
	}
	function getAnotherCms($type, $CmsID, $number = null) {
		global $db, $account;
		
		
		$number = $number == null ? 10 : $number;
		$order = $number == null ? "DateUpdated": "ViewedCount";
		
		$strQuery = "SELECT a.*, b.Slug AS cSlug FROM cms AS a, cms_categories AS b WHERE a.CategoryID = b.CategoryID AND a.Status = 1 AND b.Slug Like '$type' AND CmsID <> $CmsID ORDER BY $order DESC LIMIT 0, $number";
		$query = $db->query ( $strQuery );
		
		// die($strQuery);
		if ($db->numRows ( $query ) > 0) {
			$pages = array ();
			
			while ( $row = $db->fetchArray ( $query ) ) {
				$pages [] = $row;
			}

			$info = array (
					'Action' => str_replace("::", "", str_replace(get_called_class(), "",__METHOD__)),
					'Controller' => get_called_class(),
					'MemberID' => $account->memberID,
					'Username' => $account->username
			);
			
			Log::ExecuteLog ( Log::INFO, $info );
			
			return $pages;
		} else {
			return null;
		}
	}
	function increaseView($CmsID) {
		global $db, $account;
		
		$query = $db->query ( "UPDATE cms SET ViewedCount = ViewedCount+1 WHERE CmsID=" . $CmsID );

		$info = array (
				'Action' => str_replace("::", "", str_replace(get_called_class(), "",__METHOD__)),
				'Controller' => get_called_class(),
				'MemberID' => $account->memberID,
				'Username' => $account->username
		);
		
		Log::ExecuteLog ( Log::INFO, $info );
		
	}
}
?>