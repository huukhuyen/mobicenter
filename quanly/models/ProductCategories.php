<?php

//@ T盻㎝ file     : ProductCategories.cs ver 1.0 
//@ ﾄ脆ｰ盻｣c t蘯｡o lﾃｺc : 11.09.13 

class ProductCategories
{
    private $CategoryID;
    private $ParentID;
    private $Name;
    private $Slug;
    
        
    public function ProductCategories($CategoryID = null)
    {
        $this->CategoryID = $CategoryID;
    }
    
    public function set($ParentID, $Name, $Slug)
    {
        $this->ParentID = $ParentID;
        $this->Name = $Name;
        $this->Slug = $Slug;        
    }
    
    public function getAllProductCategories()
    {
        global $db, $account;
        
        $strQuery = "SELECT * FROM `product_categories`";
        
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
    
    public function getPagingProductCategories($totalDisplay, $currentPage, $orderby, $desc = null)
    {
        global $db, $account;
                
        $limit = $totalDisplay * ($currentPage - 1);
        $limitSize = $totalDisplay;
        
        $strQuery = "SELECT * FROM `product_categories` ORDER BY $orderby $desc LIMIT $limit, $limitSize";
        
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
    
    function getProductCategories($CategoryID)
    {
        global $db, $account;
    
        try
        {
            $strQuery = "SELECT * FROM product_categories WHERE CategoryID = $CategoryID";
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
            $strQuery = "INSERT INTO product_categories(ParentID, Name, Slug) VALUES($this->ParentID, '$this->Name', '$this->Slug')";
            
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
            $strQuery = "DELETE FROM product_categories WHERE CategoryID = $this->CategoryID";
            
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
            $strQuery = "UPDATE product_categories SET ParentID = $this->ParentID,Name = '$this->Name',Slug = '$this->Slug' WHERE CategoryID = $this->CategoryID";
            
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

