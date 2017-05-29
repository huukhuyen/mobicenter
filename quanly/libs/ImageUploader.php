<?php

class ImageUploader {
	var $imageTypes = 'xcf|odg|gif|jpg|png|bmp|jpeg';
	var $arrayTypes = array ('xcf', 'odg', 'gif', 'jpg', 'png', 'bmp', 'jpeg' );
	var $fileUploaded;
	var $error;
	var $newName;
	
	function ImageUploader($file = null) {
		$this->fileUploaded = $file;
	}
	
	function isImage() {				
	
		return preg_match ( "/$this->imageTypes/i", $this->fileUploaded ['name'] );
	}
	
	function getAttachName($folderName) {
		return ( $folderName . '/' . $this->newName );
	}
	
	function getError() {
		return $this->error;
	}
	
	//--------------------
	// FOR UPLOAD FROM URL
	//--------------------
	function uploadURL($url, $folderName, $newName) {
		
		$suffix = rand ( 0, 10 );
		
		$name = basename ( $url );
		
		$names = explode ( ".", $name );
		$this->newName = $newName;
		
		if (! in_array ( $names [1], $this->arrayTypes )) {
			return false;
		} else {
			
			$fn = IMAGE_UPLOAD_PATH . $folderName . "/" . $this->newName;
			
			$fp = fopen ( $fn, "w" );
			
			$content = file_get_contents ( $url );
			
			fwrite ( $fp, $content, strlen ( $content ) );
			
			fclose ( $fp );
		}
		
		if (file_exists ( IMAGE_UPLOAD_PATH . $folderName . "/" . $this->newName )) {
			return true;
		} else {
			return false;
		}
	}
	
	function getStrongName($str)
	{
		$str = str_replace(" ", "", $str);
		$str = str_replace(".", "", $str);
		return $str;
	}
	//-----------------
	// FOR ATTACHMENT
	//-----------------
	function processAttach($folderName, $newName = null) {
		$suffix = rand ( 0, 10 );
		
		$pathInfo = pathinfo ( $this->fileUploaded ['name'] );

		$this->newName = $this->fileUploaded ['name'];



		$this->newName  = str_replace ( ".", "", $this->newName  );		

		$this->newName  = str_replace ( "JPG", ".JPG", $this->newName  );		
		$this->newName  = str_replace ( "jpg", ".jpg", $this->newName  );		
		$this->newName  = str_replace ( "gif", ".gif", $this->newName  );		
		$this->newName  = str_replace ( "GIF", ".GIF", $this->newName  );		
		$this->newName  = str_replace ( "PNG", ".PNG", $this->newName  );		
		$this->newName  = str_replace ( "png", ".png", $this->newName  );		
		$this->newName  = str_replace ( "JPEG", ".JPEG", $this->newName  );		
		$this->newName  = str_replace ( "jpeg", ".jpeg", $this->newName  );		
		$this->newName  = str_replace ( "%20", "", $this->newName  );		
		

		$this->newName = str_replace ( "-", "", $this->newName );


		
		if(is_dir(IMAGE_UPLOAD_PATH . $folderName) == false)
		{
			mkdir(IMAGE_UPLOAD_PATH . $folderName, 0777);
		}
		
		
		if (move_uploaded_file ( $this->fileUploaded ['tmp_name'], IMAGE_UPLOAD_PATH . $folderName . "/" . $this->newName )) {
			return true;
		} else {
			return false;
		}
	}
	
	//-------------------
	// FOR ALBUM PICTURE
	//-------------------
	function process() {
		$suffix = substr ( md5 ( rand ( 0, 10000 ) ), rand ( 0, 20 ), 10 );
		
		$pathInfo = pathinfo ( $this->fileUploaded ['name'] );
		
		$this->newName = basename ( $this->fileUploaded ['name'], '.' . $pathInfo ['extension'] ) . '_' . $suffix . '.' . $pathInfo ['extension'];
		
		if (move_uploaded_file ( $this->fileUploaded ['tmp_name'], IMAGE_UPLOAD_PATH . "album/" . $this->newName )) {
			return true;
		} else {
			return false;
		}
	}
	
	function checkUploadError() {
		if (! $this->fileUploaded ['error']) {
			
			if ($this->isImage ( $this->fileUploaded ['name'] )) {
				
				if ($this->fileUploaded ['size'] <= MAX_IMAGE_SIZE_UPLOAD) {
					return false;
				} else {				
					$this->error = "Kích thước ảnh quá lớn!";
					return true;
				}
			} else {
			
				$this->error = "File ảnh không đúng định dạng!";				
				return true;
			}
		} else {
		
			$this->error = "Đã có lỗi trong quá trình upload!";
			return true;
		}
	}
	
	function createThumb($name, $filename, $new_w, $new_h) {
		$system = explode ( ".", $name );
		if (preg_match ( "/jpg|jpeg/", $system [1] )) {
			$src_img = imagecreatefromjpeg ( $name );
		}
		if (preg_match ( "/png/", $system [1] )) {
			$src_img = imagecreatefrompng ( $name );
		}
		$old_x = imageSX ( $src_img );
		$old_y = imageSY ( $src_img );
		if ($old_x > $old_y) {
			$thumb_w = $new_w;
			$thumb_h = $old_y * ($new_h / $old_x);
		}
		if ($old_x < $old_y) {
			$thumb_w = $old_x * ($new_w / $old_y);
			$thumb_h = $new_h;
		}
		if ($old_x == $old_y) {
			$thumb_w = $new_w;
			$thumb_h = $new_h;
		}
		$dst_img = ImageCreateTrueColor ( $thumb_w, $thumb_h );
		imagecopyresampled ( $dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y );
		if (preg_match ( "/png/", $system [1] )) {
			imagepng ( $dst_img, $filename );
		} else {
			imagejpeg ( $dst_img, $filename );
		}
		imagedestroy ( $dst_img );
		imagedestroy ( $src_img );
	}
}
?>