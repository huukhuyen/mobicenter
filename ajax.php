<?php 
	require_once ("config.php");
	
	if (isset($_POST)) {
		session_start();
		if ($_POST['id']) {
			$mang  = array();
			$mangsp = json_decode($_SESSION['cart']); // lay ra mang san pham
			foreach ($mangsp as $k => $v) {
				$sp = explode("_", $v); // tach thong tin san pham
				if ($sp[0] == $_POST['id']) { // neu id san pham trong gio bang id truyen vao thi bo qua san pham do cho lap tiep
					continue;
				}
				$mang[] = $v; // dua thong tin san pham khong bi xoa vao mang
			}
			$_SESSION['cart'] = json_encode($mang); // gan lai $_SESSION['cart'] = mang json cua san pham con lai trong gio
			$_SESSION['sosp'] = count(json_decode($_SESSION['cart'])); // tra ve so luong san pham con trong gio
		}
		else{
			unset($_SESSION['cart']);
			$_SESSION['sosp'] = 0;
		}
	}
?>

