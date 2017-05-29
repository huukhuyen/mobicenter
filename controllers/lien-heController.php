<?php

require_once (LIBS_PATH . "Email/class.phpmailer.php"); 
require_once (LIBS_PATH . "Email/class.smtp.php");
require_once (MODELS_PATH . "Page.php");

new LienHeController ();

class LienHeController {
	
	function LienHeController() {
			
		global $url, $head;
				
		$head['HEADER_DESCRIPTION'] = "Liên hệ với công ty, ".$head['HEADER_DESCRIPTION'];
		$head['HEADER_KEYWORD'] = "Liên hệ với công ty, ".$head['HEADER_KEYWORD'];
		$head['HEADER_TITLE'] = "Liên hệ với công ty, ".$head['HEADER_TITLE'];
		$head['HEADER_ABSOLUTE'] = "Liên hệ với ".$head['HEADER_ABSOLUTE'];
		
		
		getJS("lienhe.js");
		getJS("jquery.alerts.js");
		getCSS("jquery.alerts.css");
		
		$objHandle = new Page ();
		$fields = $objHandle->getPageSlug("lien-he");
		
		if (isset ( $_POST ['lien-he'] )) {
			 
			
            $name = getFormInput('name');
            $address = getFormInput('address');
            $phone = getFormInput('phone');
            $email = getFormInput('email');
            $title = getFormInput('title');
            $content = getFormInput('content');
            $captchar = getFormInput('captchar');

            if ($name == "" || $email == "" || 
            	$title == "" || $content == "")
            	{
            		$_SESSION['messageType'] = "error";
            		$_SESSION['message'] = "Bạn đã điền thiếu thông tin cần gửi. Vui lòng hoàn thành các mục trên.";            		
            		$_SESSION['messageTitle'] = "Thông báo từ hệ thống";
            	}
            	else if (is_valid_email($email) == false)
            	{
            		$_SESSION['messageType'] = "error";
            		$_SESSION['message'] = "Email của bạn không hợp lệ. Vui lòng nhập lại.";
            		$_SESSION['messageTitle'] = "Thông báo từ hệ thống";            		
            	}
            	else {
            		
            		
            		//------------------------------------
					//Begin SEND MAIL
					//------------------------------------
					//FROM EMAIL
					$from = $email;
					
					//TO EMAIL (DEFAULT)
					$to = SMTP_TO;
					
					//DATE
					$dateIn = date("d-m-y");
		
					//TITLE O EMAIL		
					$title_email = "[Liên hệ - ".$dateIn."] $name";
					
					//CONTENT OF EMAIL
					$content_email =<<<EOF
					Xin chào,<br/><br/>Đây là hệ thống thông báo của công ty.
					Thông tin <b>liên hệ</b> như sau:<br/><br/>
		
					Name: <b>{$name} </b> 				
					<br/><br/>Địa chỉ: <b>{$address}</b>
					<br/><br/>Điện thoại: <b>{$phone}</b>
					<br/><br/>Email: <b>{$email}</b>
					<hr/>
					<br/><br/>Tiêu đề gửi: <b>{$title}</b>				
					<br/><br/>Nội dung gửi: <b>{$content}</b>
	
					<br/>
EOF;
					$mail = new PHPMailer();
					
					$from = $email;						
					$mail->From = $from;
					$mail->FromName = "$name ($email)";				
					$mail->AddAddress($to,$name);
					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					$mail->Subject = $title_email;
					$mail->Body = "$content_email";
					$mail->AltBody = "$content_email";
					
					if(!$mail->Send())
					{
						$_SESSION['messageType'] = "error";
	            		$_SESSION['message'] = "Hệ thống hiện không thể gửi email được, bạn vui lòng thực hiện lại thao tác.";
	            		$_SESSION['messageTitle'] = "Thông báo từ hệ thống";            		
	            	}
	            	else {
	            		$_SESSION['messageType'] = "success";
	            		$_SESSION['message'] = "<p>Cảm ơn bạn đã quan tâm, góp ý hỏi hỏi đáp cho hệ thống <br/>công ty.</p><p>Chúng tôi sẽ liên hệ lại ngay khi nhận được thông tin của bạn.</p>";
	            		$_SESSION['messageTitle'] = "Gửi thông tin liên hệ thành công";	            			            	
					}   
            	}         			            
		}   
		
		require_once (VIEWS_COMMON_PATH . 'header.tpl');
		require_once (VIEWS_PATH . 'lien-he.tpl');		
		require_once (VIEWS_COMMON_PATH . 'footer.tpl');
	}
	
}

?>