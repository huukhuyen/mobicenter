<?php

//@ Tên file     : PictureCategories.cs ver 1.0
//@ Mobile Center

class PictureCategories
{
    private $PictureCategoryID;
    private $Name;
    private $Slug;
	private $Status;
	private $Year;
    private $DateUpdated;
    
        
    public function PictureCategories($PictureCategoryID = null)
    {
        $this->PictureCategoryID = $PictureCategoryID;
    }
    
    public function set($Name, $Slug, $Status, $Year)
    {
        $this->Name = $Name;
        $this->Slug = $Slug;
		$this->Status = $Status;        
		$this->Year = $Year;        
    }
    
    public function getAllPictureCategories()
    {
        global $db, $account;
        
        $strQuery = "SELECT * FROM `picture_categories`  ORDER BY DateUpdated DESC";
        
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
	
	public function getYearCategories()
    {
        global $db, $account;
        
		
        $strQuery = "SELECT * FROM picture_categories ORDER BY Year DESC";
        
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
    public function getAllPictureCategoriesFront()
    {
        global $db, $account;
        
        $strQuery = "SELECT * FROM `picture_categories` WHERE PictureCategoryID <> 0 AND Status = 1 ORDER BY DateUpdated DESC";
        
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
    function getPictureCategories($PictureCategoryID)
    {
        global $db, $account;
    
        try
        {
            $strQuery = "SELECT * FROM picture_categories WHERE PictureCategoryID = $PictureCategoryID";
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
    
	public function getPagingPictureCategory($totalDisplay, $currentPage, $orderby, $desc = null)
    {
        global $db, $account;
                
        $limit = $totalDisplay * ($currentPage - 1);
        $limitSize = $totalDisplay;
		
		
		
        $strQuery = "SELECT * FROM `picture_categories` ORDER BY $orderby $desc LIMIT $limit, $limitSize";
        
		
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
    
    function insert()
    {
        global $db, $account;

        try
        {            
            $strQuery = "INSERT INTO picture_categories(Name, Slug, Status, Year, DateUpdated) VALUES('$this->Name', '$this->Slug', $this->Status, $this->Year, ".time().")";
            
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
			if ($this->PictureCategoryID == "0") return;
            $strQuery = "DELETE FROM picture_categories WHERE PictureCategoryID = $this->PictureCategoryID";
            
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
            $strQuery = "UPDATE picture_categories SET Name = '$this->Name',Slug = '$this->Slug', Status = $this->Status, Year = $this->Year, DateUpdated = ".time()." WHERE PictureCategoryID = $this->PictureCategoryID";
            
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