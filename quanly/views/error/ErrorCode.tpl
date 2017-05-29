<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Lỗi hệ thống - <?php echo DEFAULT_TITLE; ?></title>
		<link rel="stylesheet" href="css/error/reset.css" type="text/css">   
		<link rel="stylesheet" href="css/error/style.css" type="text/css">     	
	</head>
	<body>
		<div id="wrapper">		
			<div id="main">
				<div id="leftcolumn">			
					<center><h1>!<small>Lỗi hệ thống</small></center></h1>           
			</div>        
			<div id="rightcolumn">
				
				
				<h3>
					Miêu tả lỗi như sau:
				</h3>
				
				<p><?php echo $this->messageContent; ?>. Đã thực hiện ghi event log trên server.</p>
				<h3><a href="<?php echo HOME_PAGE_LINK ?>">Trở về trang chủ</a></h3>
				<h3><a href="<?php echo CONTACT_PAGE_LINK ?>">Liên hệ với quản trị</a></h3>            
				
			</div>
			
				<br class="clear">        
				<div id="footer">
					<div id="copyright">Copyright © <?php echo date("Y");?> <?php echo MAIN_DOMAIN; ?>. All rights reserved.</div>            
				</div>
			</div>
		</div>    
	</body>
</html>