<meta charset="UTF-8">
<?php 
	session_start();
	var_dump($email_title);
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
			$_SESSION['cart'] = "";
			header("Location: index.php");        			            	
		}
	}
?>