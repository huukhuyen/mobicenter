<?
//____________________________________UPLOAĐ FROM PC_____________________________________//
$upload = new uploadFromPC();
class uploadFromPC
{
	//THUOC TINH
	public $IMAGE_SIZE; // 5KB
	
	public $path_images;
	
	public $path_full;
	//CONTRUCTOR
	public function uploadFromPC()
	{
		$day = date("d");
		$month = date("m");
		$year = date("Y");

		if (!file_exists('../uploads/'.$year)) {
			mkdir('../uploads/'.$year, 0777, true);
		}

		if (!file_exists('../uploads/'.$year.'/'.$month)) {
			mkdir('../uploads/'.$year.'/'.$month, 0777, true);
		}

		if (!file_exists('../uploads/'.$year.'/'.$month.'/'.$day)) {
			mkdir('../uploads/'.$year.'/'.$month.'/'.$day, 0777, true);
		}

		$this->IMAGE_SIZE= 500000;
		
		$day = date("d");
		$month = date("m");
		$year = date("Y");
		
		$this->path_images = ROOT_PATH."/uploads/".$year."/".$month."/".$day."/";
		$this->path_full = BASE_URL."/uploads/".$year."/".$month."/".$day."/";
		
	}
	//PHUONG THUOC

	public function getExt($file)
	{
		return substr($file,strrpos($file,".")+1);
	}
	
	public function thongbao($str) {

		echo"<script>alert($str);</script>";
	
	}
	
	public function set_path($path)
	{
		//$this->path_images = $path;
	}
	public function upload($filename,$path)
	{
		try
		{
		
			$type_upload=explode(",","JPG,jpg,gif,BMP,PNG,png,jpeg,rar,pdf,doc,docx,xls,xlsx,ppt,pptx,zip");//return an array
		
		
			$ext=$this->getExt(basename($path));// return extension of filename
			$size=$_FILES[$filename]["size"];
			
			
			if(!in_array($ext,$type_upload) || (floatval($size/1024)>floatval($this->IMAGE_SIZE))){
				return "Dung lượng quá lớn > 500kb hoặc không đúng định dạng file. Vui lòng nén file lại hoặc liên hệ với quản trị viện (Tuấn)";
			}
			else{
			

				move_uploaded_file($_FILES[$filename]["tmp_name"],$path);
			}
			
			
		}
		catch (Exception $e) {
		
			return "Dung lượng quá lớn";
		}	
	}
}

$upload_url = new uploadFromurl();
class uploadFromurl
{
	//BIEN
	public $type_upload,$ext, $fn,$name,$fp, $content, $path_images, $path_full;
	public $save_to = NULL;
	
	//CONSTRUCTOR
	public function uploadFromurl()
	{
	
		$day = date("d");
		$month = date("m");
		$year = date("Y");

		if (!file_exists('../uploads/'.$year)) {
			mkdir('../uploads/'.$year, 0777, true);
		}

		if (!file_exists('../uploads/'.$year.'/'.$month)) {
			mkdir('../uploads/'.$year.'/'.$month, 0777, true);
		}

		//echo ('../uploads/'.$year.'/'.$month.'/'.$day);
		if (!file_exists('../uploads/'.$year.'/'.$month.'/'.$day)) {
		
			mkdir('../uploads/'.$year.'/'.$month.'/'.$day, 0777, true);
		}
		

		
		$this->path_images = "../uploads/".$year."/".$month."/".$day."/";
		$this->path_full = "http://".$_SERVER ["HTTP_HOST"]."/uploads/".$year."/".$month."/".$day."/";
	}
	
	//FUNCTION
	
	function get_file_extension($file_name) {
		return substr(strrchr($file_name,'.'),1);
	}

	public function uploadurl($url)
	{
	
		$name = basename($url);
		
	
		list($txt, $ext) = explode(".", $name);
		
	
		
		$name = time()."-".$txt;
		$name = $name.".".$ext;
		
		
		
		//check if the files are only image / document
		if($ext == "JPG" or $ext == "PNG" or $ext == "GIF" or $ext == "jpg" or $ext == "png" or $ext == "gif" or $ext == "doc" or $ext == "docx" or $ext == "pdf"or $ext == "zip" or $ext == "rar" or $ext == "xls" or $ext == "XLS" or $ext = "DOC" or $ext == "bmp" ){
		//here is the actual code to get the file from the url and save it to the uploads folder
		//get the file from the url using file_get_contents and put it into the folder using file_put_contents
		
			$day = date("d");
			$month = date("m");
			$year = date("Y");
			
			
			
			
			$upload = file_put_contents($_SERVER ["DOCUMENT_ROOT"]."uploads/".$year."/".$month."/".$day."/".str_replace(" ", "", urldecode($name)),file_get_contents($url));
				
				
			$this->path_images =  "../uploads/".$year."/".$month."/".$day."/".str_replace(" ", "", urldecode($name));
			
			
			$this->path_images = ROOT_PATH."/uploads/".$year."/".$month."/".$day."/";
			
		
			$this->path_full = BASE_URL."/uploads/".$year."/".$month."/".$day."/".str_replace(" ", "", urldecode($name));
			
			
			
			
			
		}
		
		//check success
		
	}
	
	public function set_path($path)
	{
		//$this->save_to = $path;
	}
}

/*



if ($_POST['kiemtra'] == "ok")
{
         $image=$_FILES['image']['name'];
         $path=$upload->path_images.$image;
		 $upload->upload('image',$path);
}

?>

<form action="" method="post" enctype="multipart/form-data">
   <input type="file" name="image" size="50"  />
   <input type="submit" value="Upload Now"  />
   <input type="hidden" name="kiemtra" value="ok">
 
</form>


*/

?>