<?php

//@ Tên file     : Picture.cs ver 1.0
//@ Mobile Center

class Picture
{
    private $PictureID;
    private $PictureCategoryID;
    private $Slug;
    private $Name;
    private $Image;
    private $Description;
	private $DateUpdated;
    
        
    public function Picture($PictureID = null)
    {
        $this->PictureID = $PictureID;
    }
    
    public function set($PictureCategoryID, $Slug, $Name, $Image, $Description,$DateUpdated)
    {
        $this->PictureCategoryID = $PictureCategoryID;
        $this->Slug = $Slug;
        $this->Name = $Name ? $Name : "DBA";
        $this->Image = $Image;
        $this->Description = $Description;
		$this->DateUpdated = $DateUpdated;        
    }
    
	
    public function getAllPicture($PictureCategoryID = null, $random = null, $number = null)
    {
        global $db, $account;
        
		if ($PictureCategoryID != null)
		{
			$bonus = " AND PictureCategoryID = ".$PictureCategoryID." ";
		}
    	
		if ($random != null)
		{
			$bonus2 = " ORDER BY RAND() LIMIT 0,$number";
		}
		
        $strQuery = "SELECT * FROM `picture` WHERE 1=1 $bonus $bonus2";
        
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
	
	 public function getLatestPicture($PictureCategoryID = null, $random = null, $number = null, $latest = null)
    {
        global $db, $account;
        
		
		if ($PictureCategoryID != null)
		{
			$bonus = " AND PictureCategoryID = ".$PictureCategoryID." ";
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
		
        $strQuery = "SELECT * FROM `picture` WHERE 1=1 $bonus $bonus2";
        
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
	
	
	
	
	
	public function getAllPictureFront()
    {
        global $db, $account;
        		
        $strQuery = "SELECT * FROM `picture` WHERE PictureCategoryID <> 0 ";
        
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
	
	public function getPictureByCategory($Slug, $number = null)
    {
        global $db, $account;
        
		
        $strQuery = "SELECT a.*, b.Name AS PictureCategoryName,b.Slug As SlugCat FROM `picture` AS a, `picture_categories` AS b WHERE a.PictureCategoryID = b.PictureCategoryID AND b.Slug LIKE '$Slug' ";
		
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
	
	
	public function getPagingPicture($totalDisplay, $currentPage, $orderby, $desc = null, $PictureCategoryID = null)
    {
        global $db, $account;
                
        $limit = $totalDisplay * ($currentPage - 1);
        $limitSize = $totalDisplay;
		
		
		
		if ($PictureCategoryID != null)
		{
			$bonus = " AND b.PictureCategoryID = ".$PictureCategoryID." ";
		}
        
        $strQuery = "SELECT a.*, b.Name AS PName FROM `picture` AS a, `picture_categories` AS b WHERE a.PictureCategoryID = b.PictureCategoryID $bonus ORDER BY $orderby $desc LIMIT $limit, $limitSize";
        
		
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
    
    
    function getPicture($PictureID)
    {
        global $db, $account;
    
        try
        {
            $strQuery = "SELECT * FROM picture WHERE PictureID = $PictureID";
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
            $strQuery = "INSERT INTO picture(PictureCategoryID, Slug, Name, Image, Description, DateUpdated) VALUES($this->PictureCategoryID, '$this->Slug', '$this->Name', '$this->Image', '$this->Description', ".time().")";
            
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
            $strQuery = "DELETE FROM picture WHERE PictureID = $this->PictureID";
            
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
            $strQuery = "UPDATE picture SET PictureCategoryID = $this->PictureCategoryID,Description = '$this->Description',Slug = '$this->Slug',Name = '$this->Name',Image = '$this->Image',DateUpdated = ".time()." WHERE PictureID = $this->PictureID";
            
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