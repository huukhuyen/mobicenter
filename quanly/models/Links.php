<?php

//@ Tên file     : Links.cs ver 1.0
//@ Mobile Center

class Links
{
    private $LinkID;
    private $LinkName;
    private $LinkUrl;
	private $Avatar;
    private $Status;
    private $DateUpdated;
    
        
    public function Links($LinkID = null)
    {
        $this->LinkID = $LinkID;
    }
    
    public function set($LinkName, $LinkUrl, $Avatar, $Status, $DateUpdated)
    {
        $this->LinkName = $LinkName;
        $this->LinkUrl = $LinkUrl;
        $this->Status = $Status;
		$this->Avatar = $Avatar;
        $this->DateUpdated = $DateUpdated;        
    }
    
    public function getAllLinks($Slug = null)
    {
        global $db, $account;
        
        
        
        $strQuery = "SELECT * FROM `links`";
        
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
	
	public function getAllActiveLinks($random = null)
    {
        global $db, $account;
        
		$random = $random == null ? "DateUpdated" : "RAND()";
		$strQuery = "SELECT * FROM `links` WHERE Status = 1 ORDER BY $random";
        
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
    
    function getLinks($LinkID)
    {
        global $db, $account;
    
        try
        {
            $strQuery = "SELECT * FROM links WHERE LinkID = $LinkID";
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
            $strQuery = "INSERT INTO links(LinkName, LinkUrl, Avatar, Status, DateUpdated) VALUES('$this->LinkName', '$this->LinkUrl', '$this->Avatar', $this->Status, ".time().")";
            
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
            $strQuery = "DELETE FROM links WHERE LinkID = $this->LinkID";
            
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
            $strQuery = "UPDATE links SET LinkName = '$this->LinkName',LinkUrl = '$this->LinkUrl',Avatar = '$this->Avatar',Status = $this->Status,DateUpdated = ".time()." WHERE LinkID = $this->LinkID";
            
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