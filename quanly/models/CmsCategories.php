<?php


class CmsCategories
{
    private $CategoryID;
    private $ParentID;
    private $Name;
    private $Slug;
	private $Index;
    
        
    public function CmsCategories($CategoryID = null)
    {
        $this->CategoryID = $CategoryID;
    }
    
    public function set($ParentID, $Name, $Slug, $Index)
    {
        $this->ParentID = $ParentID;
        $this->Name = $Name;
        $this->Slug = $Slug;
		$this->Index = $Index ? $Index : 1;
    }
    
    public function getAllCmsCategories()
    {
        global $db, $account;
        
        $strQuery = "SELECT * FROM `cms_categories` ORDER BY `ParentID` ASC, `Index` DESC";
        
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
            $error = new Error("db", "Có lỗi thao tác lấy dữ liệu <br/>$e->getMessage()");
            $error->show();
            return;
        }
    }
	
	public function getAllCmsCategoriesByParent()
    {
        global $db, $account;
        
        $strQuery = "SELECT * FROM `cms_categories` WHERE ParentID = 0 ORDER BY `Index`";
		
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
            $error = new Error("db", "Có lỗi thao tác lấy dữ liệu <br/>$e->getMessage()");
            $error->show();
            return;
        }
    }
	
	public function getAllCmsCategoriesByGroup($parentIDs)
    {
        global $db, $account;
        
        try
        {
			$gets  = array();
			for ($i=0; $i<count($parentIDs); $i++)
			{				
				$gets[] = $parentIDs[$i];
				
				$strQuery = "SELECT * FROM `cms_categories` WHERE ParentID = ".$parentIDs[$i][0]." ORDER BY `Index`";
				//var_dump($parentIDs[$i]['CategoryID']);
				//echo("<hr/>");
				//echo ($strQuery);
				//echo("<hr/>");
                //die();
				$query = $db->query($strQuery);
				
				
				if($db->numRows($query) > 0)
				{
					while(($row = $db->fetchArray($query)) != null)
					{
					
					$gets[] = $row;
					}
					/*
					foreach($row as $r)
					{						
						$gets[] = $r;
					}
					*/
				}
			}	
        }
        catch(Exception $e)
        {
            $error = new Error("db", "Có lỗi thao tác lấy dữ liệu <br/>$e->getMessage()");
            $error->show();
            return;
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
	
	
	
    
    public function getPagingCmsCategories($totalDisplay, $currentPage, $orderby, $desc = null)
    {
        global $db, $account;
                
        $limit = $totalDisplay * ($currentPage - 1);
        $limitSize = $totalDisplay;
        
        $strQuery = "SELECT * FROM `cms_categories` ORDER BY Index DESC, $orderby $desc LIMIT $limit, $limitSize";
        
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
            $error = new Error("db", "Có lỗi thao tác lấy dữ liệu <br/>$e->getMessage()");
            $error->show();
            return;
        }
    }
	
	
	 public function getCategoriesByParent($ParentID = null, $Slug = null)
    {
        global $db, $account;

		if ($ParentID != null)
		{
			$bonus = " AND a.CategoryID = $ParentID ";
		}
		
		if ($Slug != null)
		{
			 $bonus = " AND a.Slug Like '$Slug' ";
		}
        
        $strQuery = "SELECT a.*, b.Name AS cName, b.CategoryID, b.Slug As cSlug FROM `cms_categories` AS a, `cms_categories` AS b Where a.CategoryID = b.ParentID  $bonus ORDER BY b.Index ASC";        
		//die($strQuery);
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
            $error = new Error("db", "Có lỗi thao tác lấy dữ liệu <br/>$e->getMessage()");
            $error->show();
            return;
        }
    }
    
    function getCmsCategories($CategoryID = null, $Slug = null)
    {
        global $db, $account;
    
        try
        {
			if ($CategoryID != null)
			{
				$bonus1 =  "CategoryID = $CategoryID";
			}
			if ($Slug != null)
			{
				$bonus2 =  "Slug = '$Slug'";
			}
			
            $strQuery = "SELECT * FROM cms_categories WHERE $bonus1 $bonus2";
			//die($strQuery);
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
                return null;
            }
        }
        catch(Exception $e)
        {
            $error = new Error("db", "Có lỗi thao tác lấy dữ liệu <br/>$e->getMessage()");
            $error->show();            
        }
    }
    
    function insert()
    {
        global $db, $account;

        try
        {            
            $strQuery = "INSERT INTO cms_categories(ParentID, Name, Slug, `Index`) VALUES($this->ParentID, '$this->Name', '$this->Slug', $this->Index)";
            
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
            $error = new Error("db", "Có lỗi thao tác thêm dữ liệu! <br/>$e->getMessage()");
            $error->show();            
        };        
    }
    
    function delete()
    {
        global $db, $account;
        
        try
        {            
            $strQuery = "DELETE FROM cms_categories WHERE CategoryID = $this->CategoryID";
            
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
            $error = new Error("db", "Có lỗi thao tác xóa dữ liệu! <br/>$e->getMessage()");
            $error->show();            
        }        
    }
    
    function update()
    {
        global $db, $account;
        try
        {            
            $strQuery = "UPDATE cms_categories SET ParentID = $this->ParentID,Name = '$this->Name',Slug = '$this->Slug',`Index` = $this->Index WHERE CategoryID = $this->CategoryID";
            //die($strQuery);
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
            $error = new Error("db", "Có lỗi thao tác cập nhật dữ liệu! <br/>$e->getMessage()");
            $error->show();            
        }        
    }
    
}

?>

