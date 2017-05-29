<?php

//@ Tên file     : Video.cs ver 1.0
//@ Mobile Center

class Video
{
    private $VideoID;
    private $VideoCategoryID;
    private $Slug;
    private $Name;
    private $Video;
    private $Description;
	private $DateUpdated;
    
        
    public function Video($VideoID = null)
    {
        $this->VideoID = $VideoID;
    }
    
    public function set($VideoCategoryID, $Slug, $Name, $Video, $Description,$DateUpdated)
    {
        $this->VideoCategoryID = $VideoCategoryID;
        $this->Slug = $Slug;
        $this->Name = $Name ? $Name : "DBA";
        $this->Video = $Video;
        $this->Description = $Description;
		$this->DateUpdated = $DateUpdated;        
    }
    
	
    public function getAllActiveVideo($VideoCategoryID = null, $random = null, $number = null)
    {
        global $db, $account;
        
		if ($VideoCategoryID != null)
		{
			$bonus = " AND VideoCategoryID = ".$VideoCategoryID." ";
		}
    	
		if ($random != null)
		{
			$bonus2 = " ORDER BY RAND() LIMIT 0,$number";
		}
		
        $strQuery = "SELECT * FROM `video` WHERE 1=1 $bonus $bonus2";
        
        $query = $db->query($strQuery);
        
		
        try
        {
            if($db->numRows($query) > 0)
            {
                $gets  = array();
                
                while($row = $db->fetchArray($query))
                {
                    $gets[] = $row;
                }
                
               
                $info = array (
                		'Action' => str_replace("::", "", str_replace(get_called_class(), "",__METHOD__)),
                		'Controller' => get_called_class(),
                		'MemberID' => $account->memberID,
                		'Username' => $account->username
                );
                
                Log::ExecuteLog ( Log::INFO, $info );
                
                return $gets;
            }
            else 
            {
                return;
            }    
        }
        catch(Exception $e)
        {
            $error = new Error("db", "Có lỗi thao tác dữ liệu! <br/>$e->getMessage()");
            $error->show();
            return;
        }
    }
	
	 public function getLatestVideo($VideoCategoryID = null, $random = null, $number = null, $latest = null)
    {
        global $db, $account;
        
		
		if ($VideoCategoryID != null)
		{
			$bonus = " AND VideoCategoryID = ".$VideoCategoryID." ";
		}
    	
		if ($random != null)
		{
			if ($latest == "")
			{
				$bonus2 = " ORDER BY RAND() LIMIT 0,$number";
			}
			else
			{
				$bonus2 = " ORDER BY DateUpdated DESC LIMIT 0,$number ";
			}
		}
		
        $strQuery = "SELECT * FROM `video` WHERE 1=1 $bonus $bonus2";
        
		//die($strQuery);
        $query = $db->query($strQuery);
        
		
        try
        {
            if($db->numRows($query) > 0)
            {
                $gets  = array();
                
                while($row = $db->fetchArray($query))
                {
                    $gets[] = $row;
                }
                
                $info = array (
                		'Action' => str_replace("::", "", str_replace(get_called_class(), "",__METHOD__)),
                		'Controller' => get_called_class(),
                		'MemberID' => $account->memberID,
                		'Username' => $account->username
                );
                
                Log::ExecuteLog ( Log::INFO, $info );
                return $gets;
            }
            else 
            {
                return;
            }    
        }
        catch(Exception $e)
        {
            $error = new Error("db", "Có lỗi thao tác dữ liệu! <br/>$e->getMessage()");
            $error->show();
            return;
        }
    }
	
	
	
	
	
	public function getAllVideoFront()
    {
        global $db, $account;
        		
        $strQuery = "SELECT * FROM `video` WHERE VideoCategoryID <> 0 ";
        
		//die($strQuery);
        $query = $db->query($strQuery);
        
        try
        {
            if($db->numRows($query) > 0)
            {
                $gets  = array();
                
                while($row = $db->fetchArray($query))
                {
                    $gets[] = $row;
                }
                
                $info = array (
                		'Action' => str_replace("::", "", str_replace(get_called_class(), "",__METHOD__)),
                		'Controller' => get_called_class(),
                		'MemberID' => $account->memberID,
                		'Username' => $account->username
                );
                
                Log::ExecuteLog ( Log::INFO, $info );
                return $gets;
            }
            else 
            {
                return;
            }    
        }
        catch(Exception $e)
        {
            $error = new Error("db", "Có lỗi thao tác dữ liệu! <br/>$e->getMessage()");
            $error->show();
            return;
        }
    }
	
	public function getVideoByCategory($Slug, $number = null)
    {
        global $db, $account;
        
		
        $strQuery = "SELECT a.*, b.Name, b.Year AS VideoCategoryName,b.Slug As SlugCat FROM `video` AS a, `video_categories` AS b WHERE a.VideoCategoryID = b.VideoCategoryID AND b.Slug LIKE '$Slug' ";
		
		if ($number != null)
		{
			$strQuery .= " ORDER BY RAND() LIMIT 0,$number ";
		}
        
		//die($strQuery);
        $query = $db->query($strQuery);
        
        try
        {
            if($db->numRows($query) > 0)
            {
                $gets  = array();
                
                while($row = $db->fetchArray($query))
                {
                    $gets[] = $row;
                }
                
                $info = array (
                		'Action' => str_replace("::", "", str_replace(get_called_class(), "",__METHOD__)),
                		'Controller' => get_called_class(),
                		'MemberID' => $account->memberID,
                		'Username' => $account->username
                );
                
                Log::ExecuteLog ( Log::INFO, $info );
                return $gets;
            }
            else 
            {
                return;
            }    
        }
        catch(Exception $e)
        {
            $error = new Error("db", "Có lỗi thao tác dữ liệu! <br/>$e->getMessage()");
            $error->show();
            return;
        }
    }
	
	
	public function getPagingVideo($totalDisplay, $currentPage, $orderby, $desc = null, $VideoCategoryID = null)
    {
        global $db, $account;
                
        $limit = $totalDisplay * ($currentPage - 1);
        $limitSize = $totalDisplay;
		
		
		
		if ($VideoCategoryID != null)
		{
			$bonus = " AND b.VideoCategoryID = ".$VideoCategoryID." ";
		}
        
        $strQuery = "SELECT a.*, b.Name AS PName FROM `video` AS a, `video_categories` AS b WHERE a.VideoCategoryID = b.VideoCategoryID $bonus ORDER BY $orderby $desc LIMIT $limit, $limitSize";
        
		
        $query = $db->query($strQuery);
        
        try
        {
            if($db->numRows($query) > 0)
            {
                $gets  = array();
                
                while(($row = $db->fetchArray($query)) != null)
                {
                    $gets[] = $row;
                }
                
                $info = array (
                		'Action' => str_replace("::", "", str_replace(get_called_class(), "",__METHOD__)),
                		'Controller' => get_called_class(),
                		'MemberID' => $account->memberID,
                		'Username' => $account->username
                );
                
                Log::ExecuteLog ( Log::INFO, $info );
                return $gets;
            }
            else 
            {
                return;
            }    
        }
        catch(Exception $e)
        {
            $error = new Error("db", "Có lỗi thao tác lấy dữ liệu xảy ra! <br/>$e->getMessage()");
            $error->show();
            return;
        }
    }
    
    
    function getVideo($VideoID)
    {
        global $db, $account;
    
        try
        {
            $strQuery = "SELECT * FROM video WHERE VideoID = $VideoID";
            $query = $db->query($strQuery);
            
            if($db->numRows($query) > 0)
            {
                $row = $db->fetchArray($query);
                
                $info = array (
                		'Action' => str_replace("::", "", str_replace(get_called_class(), "",__METHOD__)),
                		'Controller' => get_called_class(),
                		'MemberID' => $account->memberID,
                		'Username' => $account->username
                );
                
                Log::ExecuteLog ( Log::INFO, $info );
                return $row;
            }
            else 
            {                
                return;
            }
        }
        catch(Exception $e)
        {
            $error = new Error("db", "Có lỗi thao tác dữ liệu! <br/>$e->getMessage()");
            $error->show();            
        }
    }
    
    function insert()
    {
        global $db, $account;

        try
        {            
            $strQuery = "INSERT INTO video(VideoCategoryID, Slug, Name, Video, Description, DateUpdated) VALUES($this->VideoCategoryID, '$this->Slug', '$this->Name', '$this->Video', '$this->Description', ".time().")";
            
            $db->query($strQuery);
            
                $info = array (
                		'Action' => str_replace("::", "", str_replace(get_called_class(), "",__METHOD__)),
                		'Controller' => get_called_class(),
                		'MemberID' => $account->memberID,
                		'Username' => $account->username
                );
                
                Log::ExecuteLog ( Log::INFO, $info );
                
        }
        catch(Exception $e)
        {
            $error = new Error("db", "Có lỗi thao tác dữ liệu! <br/>$e->getMessage()");
            $error->show();            
        };        
    }
    
    function delete()
    {
        global $db, $account;
        
        try
        {            
            $strQuery = "DELETE FROM video WHERE VideoID = $this->VideoID";
            
            $db->query($strQuery);
            
                $info = array (
                		'Action' => str_replace("::", "", str_replace(get_called_class(), "",__METHOD__)),
                		'Controller' => get_called_class(),
                		'MemberID' => $account->memberID,
                		'Username' => $account->username
                );
                
                Log::ExecuteLog ( Log::INFO, $info );
                
        }
        catch(Exception $e)
        {
            $error = new Error("db", "Có lỗi thao tác dữ liệu! <br/>$e->getMessage()");
            $error->show();            
        }        
    }
    
    function update()
    {
        global $db, $account;
        try
        {            
            $strQuery = "UPDATE video SET VideoCategoryID = $this->VideoCategoryID,Description = '$this->Description',Slug = '$this->Slug',Name = '$this->Name',Video = '$this->Video',DateUpdated = ".time()." WHERE VideoID = $this->VideoID";
            
            $db->query($strQuery);
            
                $info = array (
                		'Action' => str_replace("::", "", str_replace(get_called_class(), "",__METHOD__)),
                		'Controller' => get_called_class(),
                		'MemberID' => $account->memberID,
                		'Username' => $account->username
                );
                
                Log::ExecuteLog ( Log::INFO, $info );
                
        }
        catch(Exception $e)
        {
            $error = new Error("db", "Có lỗi thao tác dữ liệu! <br/>$e->getMessage()");
            $error->show();            
        }        
    }
    
}
?>