<meta charset="UTF-8">
<?php
	session_start();
	function sendEmail($email_title, $email_content){
		$from = "php.cit2015@gmail.com";
		$to = "nguyenhuukhuyenudn@gmail.com";	
		//@Smtp Mail
		define ( "SMTP_HOST", "smtp.gmail.com" );
		define ( "SMTP_PORT", 465 );
		define ( "SMTP_SECURE", "ssl" );
		define ( "SMTP_USERNAME", "php.cit.2015@gmail.com" );
		define ( "SMTP_PASSWORD", "cntt2015");
		define ( "SMTP_TO", "nguyenhuukhuyenudn@gmail.com" );

		require_once ("class.phpmailer.php"); 
		require_once ("class.smtp.php");
		$mail = new PHPMailer();

		$from = $email;						
		$mail->From = $from;
		$mail->SMTPDebug  = 2;

		$mail->AddAttachment($file);// up file
		$mail->FromName = "$name ($email)";				
		$mail->AddAddress($to,$name);
		$mail->WordWrap = 50;
		$mail->IsHTML(true);
		$mail->Subject = $email_title;
		$mail->Body = "$email_content";
		$mail->AltBody = "$email_content";
		
		if(!$mail->Send())
		{
			$_SESSION['message'] = "Hệ thống hiện không thể gửi email được, bạn vui lòng thực hiện lại thao tác.";
			header("Location: addcart.php");
			          		
		}
		else {
			$_SESSION['message'] = "<p>Cảm ơn bạn đã quan tâm, góp ý hỏi hỏi đáp cho hệ thống <br/>công ty.</p><p>Chúng tôi sẽ liên hệ lại ngay khi nhận được thông tin của bạn.</p>";
		}
	}
	// Lien he
	if (isset($_POST['lienhe-sm']))
	{
		$txtName = $_POST['txtName'];
		$email = $_POST['email'];
		$txtTel = $_POST['txtTel'];
		$txtTitle = $_POST['txtTitle'];
		$txtContent = $_POST['txtContent'];
		$time = date("d-m-Y");
		$email_title = "[Phản hồi - ".date("d-m-y")."] $fullname";
		$email_content =<<<EOF
		Khách hàng: {$txtName}<br/>Số điện thoại: {$txtTel}<br/>Tiêu đề: {$txtTitle}<br/>Nội dung: {$txtContent}<br/>Vào lúc: {$time}.<br/>
EOF;
		sendEmail($email_title, $email_content);
	}
// Xac nhan mua hang
	if (isset($_POST['submit']))
	{
		$fullname = $_POST['fullname'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$time = date("d-m-Y");
		$email_title = "[Mua hàng - ".date("d-m-y")."] $fullname";
		$email_content =<<<EOF
		Đã có khách hàng liên hệ mua hàng<br/>
		Cụ thể là:<br/>
		Khách hàng: {$fullname} ({$email})<br/>Địa chỉ: {$address}<br/>Số điện thoại: {$phone}<br/>Đã đặt giỏ hàng vào thời gian: {$time}.<br/>
		Thông tin giỏ hàng<br/>
		{$_SESSION['thongtingiohang']}
EOF;
		sendEmail($email_title, $email_content);
		$_SESSION['cart'] = "";
		header("Location: index.php");  
	}

?>