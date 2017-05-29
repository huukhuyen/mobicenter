<?php

class MysqlDatabase
{
	var $host;
	var $user;
	var $passwd;
	var $databaseName;
	
	var $conn;
	
	
	function MysqlDatabase($host = null, $user = null, $passwd = null, $databaseName = null)
	{
		if($host != null && $user != null && $databaseName != null)
		{
			$this->set($host, $user, $passwd, $databaseName);		
		}
		
	}
	
	function set($host, $user, $passwd , $databaseName)
	{
		$this->host = $host;
		$this->user = $user;
		$this->passwd = $passwd;
		$this->databaseName = $databaseName;
	}
	
	function connect($host = null, $user = null, $passwd = null, $databaseName = null)
	{
		if($host != null && $user != null && $passwd != null && $databaseName != null)
		{
			$this->set($host, $user, $passwd, $databaseName);
		}
		

		
		$this->conn = mysql_connect($this->host, $this->user, $this->passwd);
				
		@mysql_query("SET NAMES utf8", $this->conn);
		
		if(!$this->conn)
		{
			$error = new Error("Could not connect Mysql Database!");
			$error->displayAndExit();
		}
		
		if(!mysql_select_db($this->databaseName, $this->conn))
		{
			$error = new Error("Could not select Mysql Database!");	
			$error->displayAndExit();
		}
	}
	
	function close()
	{
		if($this->conn)
		{
			mysql_close($this->conn);
		}
	}
	
	function query($sql)
	{				
		$query = mysql_query($sql, $this->conn);
		
		if($query)
		{
			return $query;
		}
		else 
		{
		}
		
	}
	
	function fetchArray($query)
	{
		return stripslashes_deep(mysql_fetch_array($query));	
	}
	
	function resultArray($query)
	{
		return stripslashes_deep(mysql_result($query));	
	}
	
	function numRows($query)
	{		
		return mysql_num_rows($query);
	}
	
	function getID()
	{
		return mysql_insert_id();
	}
	
	function fetch_array($query){
		return mysql_fetch_assoc($query);
	}
	
	function result_array($query){
		$arr = array();
		while ($row = mysql_fetch_assoc($query)) 
			$arr[] = $row;
		return $arr;
	}
}