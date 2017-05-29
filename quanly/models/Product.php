<?php

class Product
{
    private $ProductID;
    private $CategoryID;
    private $Slug;
    private $Name;
    private $ShortDescription;
    private $FullDescription;
    private $Image;
    private $Price;
    private $Promotion;
    private $Warranty;
    private $Status;
    private $Order;
    private $Featured;
    private $FeaturedDate;
    private $DateAdded;
    private $DateUpdated;
    
        
    public function Product($ProductID = null)
    {
        $this->ProductID = $ProductID;
    }
    
    public function set($CategoryID, $Slug, $Name, $ShortDescription, $FullDescription, $Image, $Price, $Promotion, $Warranty, $Status, $Order, $Featured, $FeaturedDate, $DateAdded, $DateUpdated)
    {
        $this->CategoryID = $CategoryID;
        $this->Slug = $Slug;
        $this->Name = $Name;
        $this->ShortDescription = $ShortDescription;
        $this->FullDescription = $FullDescription;
        $this->Image = $Image;
        $this->Price = $Price;
        $this->Promotion = $Promotion;
        $this->Warranty = $Warranty;
        $this->Status = $Status;
        $this->Order = $Order;
        $this->Featured = $Featured;
        $this->FeaturedDate = $FeaturedDate;
        $this->DateAdded = $DateAdded;
        $this->DateUpdated = $DateUpdated;        
    }
    
    public function getAllProduct()
    {
        global $db, $account;
        
        $strQuery = "SELECT a.*, b.Name As CategoryName FROM `product` AS a, `product_categories` AS b WHERE a.CategoryID = b.CategoryID ";
        
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
            $error = new Error("db", "Co loi thao tac db xay ra! <br/>$e->getMessage()");
            $error->show();
            return;
        }
    }
    
    public function getPagingProduct($totalDisplay, $currentPage, $orderby, $desc = null, $CategoryID = null)
    {
        global $db, $account;
                
        $limit = $totalDisplay * ($currentPage - 1);
        $limitSize = $totalDisplay;
        
		if ($CategoryID != null)
		{
			$bonus = " AND b.CategoryID = ".$CategoryID." ";
		}
		
        $strQuery = "SELECT a.*, b.Name As CategoryName, b.Slug AS CategorySlug FROM `product` AS a, `product_categories` AS b WHERE a.CategoryID = b.CategoryID $bonus ORDER BY $orderby $desc LIMIT $limit, $limitSize";
        
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
            $error = new Error("db", "Co loi thao tac db xay ra! <br/>$e->getMessage()");
            $error->show();
            return;
        }
    }
    
    function getProduct($ProductID)
    {
        global $db, $account;
    
        try
        {
            $strQuery = "SELECT * FROM product WHERE ProductID = $ProductID";
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
            $error = new Error("db", "Co loi thao tac db xay ra! <br/>$e->getMessage()");
            $error->show();            
        }
    }
    
    function insert()
    {
        global $db, $account;

        try
        {            
            $strQuery = "INSERT INTO product(CategoryID, Slug, Name, ShortDescription, FullDescription, Image, Price, Promotion, Warranty, `Status`, `Order`, Featured, FeaturedDate, DateAdded, DateUpdated) VALUES($this->CategoryID, '$this->Slug', '$this->Name', '$this->ShortDescription', '$this->FullDescription', '$this->Image', '$this->Price', '$this->Promotion', '$this->Warranty', $this->Status, $this->Order, $this->Featured, $this->FeaturedDate, ".time().", ".time().")";
            
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
            $error = new Error("db", "Co loi thao tac xay ra! <br/>$e->getMessage()");
            $error->show();            
        };        
    }
    
    function delete()
    {
        global $db, $account;
        
        try
        {            
            $strQuery = "DELETE FROM product WHERE ProductID = $this->ProductID";
            
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
            $error = new Error("db", "Co loi thao tac xay ra! <br/>$e->getMessage()");
            $error->show();            
        }        
    }
    
    function update()
    {
        global $db, $account;
        try
        {            
            $strQuery = "UPDATE product SET CategoryID = $this->CategoryID,Slug = '$this->Slug',Name = '$this->Name',ShortDescription = '$this->ShortDescription',FullDescription = '$this->FullDescription',Image = '$this->Image',Price = '$this->Price',Promotion = '$this->Promotion',Warranty = '$this->Warranty',`Status` = $this->Status,`Order` = $this->Order,Featured = $this->Featured,FeaturedDate = $this->FeaturedDate,DateAdded = ".time().",DateUpdated = ".time()." WHERE ProductID = $this->ProductID";
            
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
            $error = new Error("db", "Co loi thao tac xay ra! <br/>$e->getMessage()");
            $error->show();            
        }        
    }
    
}

?>

