<?php

//@ Tên file     : Option.cs ver 1.0
//@ Mobile Center

class Option
{
    private $OptionID;
    private $Name;
    private $Value1;
    private $Value2;
    private $Value3;
    private $Value4;
    private $Value5;
    private $DateUpdated;
    
        
    public function Option($OptionID = null)
    {
        $this->OptionID = $OptionID;
    }
    
    public function set($Name, $Value1, $Value2, $Value3, $Value4, $Value5, $DateUpdated)
    {
        $this->Name = $Name;
        $this->Value1 = $Value1;
        $this->Value2 = $Value2;
        $this->Value3 = $Value3;
        $this->Value4 = $Value4;
        $this->Value5 = $Value5;
        $this->DateUpdated = $DateUpdated;        
    }
    
    public function getAllOption()
    {
        global $db, $account;
        
        $strQuery = "SELECT * FROM `option`";
        
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
    
    function getOption($OptionID)
    {
        global $db, $account;
    
        try
        {
            $strQuery = "SELECT * FROM `option` WHERE OptionID = $OptionID";
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
            $error = new Error("db", "Có lỗi thao tác dữ liệu <br/>$e->getMessage()");
            $error->show();            
        }
    }
    
    function insert()
    {
        global $db, $account;

        try
        {            
            $strQuery = "INSERT INTO `option`(Name, Value1, Value2, Value3, Value4, Value5, DateUpdated) VALUES('$this->Name', '$this->Value1', '$this->Value2', '$this->Value3', '$this->Value4', '$this->Value5', ".time().")";
            
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
            $strQuery = "DELETE FROM `option` WHERE OptionID = $this->OptionID";
            
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
            $strQuery = "UPDATE `option` SET Name = '$this->Name',Value1 = '$this->Value1',Value2 = '$this->Value2',Value3 = '$this->Value3',Value4 = '$this->Value4',Value5 = '$this->Value5',DateUpdated = ".time()." WHERE OptionID = $this->OptionID";
            
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
	
	function updateViewCount()
	{
		global $db, $account;		
		//XU LY THONG KE
		$query	= $db->query("SELECT * FROM `option` WHERE OptionID=1");
		$row = $db->fetchArray($query);
		
		$number = $row['Value1'];											
		$number_update = intval($number+1);											
		
		$db->query("UPDATE `option` SET Value1='$number_update' WHERE OptionID=1");

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