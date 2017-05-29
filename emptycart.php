<?php 
	session_start();
	$id = $_GET['ProductID'];
	//$xoa_cart = $_GET['xoa_cart'];
	if($ProductID==0){
		$_SESSION['cart'] = "";
	}
	else{
		unset($_SESSION['cart'][$ProductID]);
	}
	// $_SESSION['cart'] = "";
	header("Location: index.php");
 ?>