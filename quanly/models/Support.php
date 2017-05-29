<?php

//@ Tên file     : Support.cs ver 1.0
//@ Mobile Center

class Support
{
    private $SupportID;
    private $YM;
    private $Skype;
    private $FullName;
    private $Phone;
    private $Message;
    private $DateUpdated;
    
        
    public function Support($SupportID = null)
    {
        $this->SupportID = $SupportID;
    }
    
    public function set($YM, $Skype, $FullName, $Phone, $Message, $DateUpdated)
    {
        $this->YM = $YM;
        $this->Skype = $Skype;
        $this->FullName = $FullName;
        $this->Phone = $Phone;
        $this->Message = $Message;
        $this->DateUpdated = $DateUpdated;        
    }
    
    public function getAllSupport()
    {
        global $db, $account;
        
        $strQuery = "SELECT * FROM `support`";
        
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
    
    function getSupport($SupportID)
    {
        global $db, $account;
    
        try
        {
            $strQuery = "SELECT * FROM support WHERE SupportID = $SupportID";
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
            $strQuery = "INSERT INTO support(YM, Skype, FullName, Phone, Message, DateUpdated) VALUES('$this->YM', '$this->Skype', '$this->FullName', '$this->Phone', '$this->Message', ".time().")";
            
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
            $strQuery = "DELETE FROM support WHERE SupportID = $this->SupportID";
            
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
            $strQuery = "UPDATE support SET YM = '$this->YM',Skype = '$this->Skype',FullName = '$this->FullName',Phone = '$this->Phone',Message = '$this->Message',DateUpdated = ".time()." WHERE SupportID = $this->SupportID";
            
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
            $error = new Error("db", "Có lỗi thao tác xảy ra! <br/>$e->getMessage()");
            $error->show();            
        }        
    }
    
}
?>