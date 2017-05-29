<?php 
	public function  sanphamnoibat()
	{
		$query = "SELECT * FROM product ORDER BY rand() LIMIT 10";
		return mysql_query($query);
	}
	
	public function tinmoinhat() {
		$sql = "SELECT * FROM cms ORDER By DateUpdated DESC LIMIT 5";
		return $db->query($sql);
	}


 ?>