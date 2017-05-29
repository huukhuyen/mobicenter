<?php
session_start();
require_once ("config.php");
require_once(VIEWS_PATH. 'header.tpl');
?>
<body>
<div id="wrapper">
	<div id="header">
	    <div class="header-top">
	        <div class="container">
	            <h1 style="padding-top: 2px;"><a href="trang-chu" class="logo"></a></h1>
	            <div class="searching">
	                <strong>Hotline: 0511 777 8888</strong>
	                <div class="form-control" style="border:none; box-shadow: none; background-color:transparent!important;">
	                    <form action="index.php" method="GET">
	                        <input name="keyword" style="font-style: italic; border-color: #fff; color:0d3058; height: 28px" type="text" class="ipt_key" placeholder="Bạn muốn mua gì..."/>
	                        <input type="hidden" name="p" value="find">
	                        <button type="submit" style="height:28px; top:6px; right: 44px " id="find">Search</button>
	                    </form>
	                </div>
           		</div>
	            <!-- end searching -->
	            <div class="clear"></div>
	        </div>
	    </div>
	    <!-- end header-top -->
	    <div class="header-bottom">
	        <div class="container">
	            <div class="menu">
	                <a href="#menu-mobile" class="menu-mobile"><span>Menu Mobile</span></a>
	                <ul>
	                    <li class="home"><a href="trang-chu">Home</a></li>
	                    <li><a href="#">Giới thiệu</a></li>
	                    <li><a href="index.php?p=dienthoai">Điện thoại</a>
	                        <ul>
	                            <li><a href="index.php?p=dienthoai&keyword=oppo">OPPO</a></li>
	                            <li><a href="index.php?p=dienthoai&keyword=nokia">NOKIA</a></li>
	                            <li><a href="index.php?p=dienthoai&keyword=htc">HTC</a></li>
	                            <li><a href="index.php?p=dienthoai&keyword=samsung">SAMSUNG</a></li>
	                            <li><a href="index.php?p=dienthoai&keyword=wing">WING</a></li>
	                            <li><a href="index.php?p=dienthoai&keyword=zenfone">ZENFONE</a></li>
	                            <li><a href="index.php?p=dienthoai&keyword=iphone">IPHONE</a></li>
	                        </ul>
	                    </li>
	                    <li><a href="index.php?p=ipad">Ipad</a></li>
	                    <li><a href="index.php?p=iphone">Iphone</a></li>
	                    <li><a href="index.php?p=laptop">Laptop</a></li>
	                    <li><a href="index.php?p=phukien">Phụ kiện</a>
	                        <ul>
	                            <li><a href="index.php?p=phukien&keyword=tainghe">Tai nghe</a></li>
	                            <li><a href="index.php?p=phukien&keyword=baoda">Bao da và ốp lưng</a></li>
	                            <li><a href="index.php?p=phukien&keyword=dmh">Miếng dán màn hình</a></li>
	                            <li><a href="index.php?p=phukien&keyword=sac">Sạc và cáp</a></li>
	                            <li><a href="index.php?p=phukien&keyword=sacdp">Sạc dự phòng</a></li>
	                        </ul>
	                    </li>
	                    <li><a href="#">Khuyến mãi</a></li>
	                    <li><a href="index.php?p=tintuc">Tin tức</a></li>
	                    <li><a href="#">Liên hệ</a></li>
	                </ul>
	                <div class="clear"></div>
	            </div>
	            <!-- end menu -->
	        </div>
	    </div>
	    <!-- end header-bottom -->
	</div>
<div class="container">
<?php

// LAY THONG TIN SAN PHAM CAN THEM
$ProductID = $_GET['ProductID'];
$Number = $_POST['Number'];
$array = array(); // Tạo mang? luu thong tin san pham
$check = false; // kiem tra co san pham cung loai hay khong
	/*echo "<pre>";
	var_dump($_POST);
	echo "<pre>";
	die;*/
if ($ProductID != "" && $Number != "")
{
	// LAY THONG TIN SESSION GIO HANG
	$giohang = $_SESSION['cart'];
	if ($giohang == ""){ /*Neu khong co san pham nao trong gio hang thi them san pham dau tien vao mang da tao*/
		$array[] = $ProductID."_".$Number;
	}
	else{
		/* Neu da co san pham trong gio hang thi dung ham json_decode de lay ra mang cac san pham
		*/
		$a = json_decode($_SESSION['cart']); 
		/*echo "<pre>";
		var_dump($a);
		echo "<pre>";
		die;*/

		$pr = $ProductID;
		// cho vong lap cac san pham trong mang $a vua lay ra nho json
		foreach ($a as $k => $v) {
			$sp = explode("_", $v); // tach thong tin san pham gom ID va so luong
			if ($sp[0] == $pr) { // neu id san pham trung voi id ma minh muon them moi vao thi thuc hien tang so luong san pham do len them
				$total = $Number + $sp[1]; // dung 1 bien de luu tong so so san pham ma minh can them vao gio
				$v = $pr."_".$total; // thiet lap lai thong tin gom id_soluong
				$check = true; // cho bien check bang true de xuong duoi no ko add them mot sp nua
			}
			$array[] = $v; // them lai san pham vao mang
		}
		if ($check == false) { // o day neu nhu khong co san pham cung loai thi moi lay thong tin cho vao mang du lieu de no la 1 san pham moi
			$array[] = $pr."_".$Number;
		}
	}
	$_SESSION['cart'] = json_encode($array); // cuoi cung cho thang $_SESSION['cart'] bang 1 mang du lieu dang json
	$check = false; // reset lai bien check de lan sau chay cho dung
}

$mangsp = json_decode($_SESSION['cart']); // doan nay dung de lay ra mang san pham

$sosp = count($mangsp);
$content.=<<<EOF
	<h2 style="font-size:20px; margin:20px 0px">Giỏ hàng hiện tại có: <span style="color:red;">{$sosp} mặt hàng</span></h2>
	<table style="border: 1px solid #d7d7d7; font-size:16px" class="table table-hover table-striped">
		<thead>
			<tr style="text-align: center; background:red; text-transform: uppercase; color:#fff;">
				<td>STT</td>
				<td>Mã sản phẩm</td>
				<td>Tên sản phẩm</td>
				<td>Giá thành</td>
				<td>Số lượng</td>
				<td>Thành tiền</td>
				<td>Hủy</td>
			</tr>
		</thead>

EOF;

$_SESSION['sosp'] = $sosp;

$i=0;
if (count($mangsp) > 0)
{
	/*echo '<pre>';
	var_dump($mangsp);
	echo '<pre>';
	die;*/
	foreach($mangsp as $row)
	{
		$i++; //if ($row=="") continue;
		$temp = explode("_", $row);
		$idsp = $temp[0];
		$number = $temp[1];
		
		require_once("config.php");
		$sql = "SELECT * FROM product WHERE ProductID = $idsp";
		$query = $db->query($sql);
		if($db->numRows($query)>0)
		{
			$chitiettungsp = $db->fetchArray($query);
			$giatien = str_replace(".", "", $chitiettungsp['Price']);
			$quythanhtien = $giatien * $number;
			$quythanhtienx = number_format($quythanhtien, 0, ',', '.');

			$content.=<<<EOF
			<tr style="text-align:center">
				<td>{$i}</td>
				<td>{$idsp}</td>
				<td style="text-align:left">{$chitiettungsp['Name']}</td>
				<td style="text-align:right">{$giatien} vnđ</td>
				<td>{$number}</td>
				<td style="text-align:right; font-weight:bold">{$quythanhtienx} vnđ</td>
				<td><a href="javascript:deleteCart($idsp)"><img src="images/delete.png" alt=""></a></td>
			</tr>
EOF;
			$tongsl += $number;
			$tongtien += $quythanhtien;
			// echo $tongtien." - ";
		}
	}
}
$tongtien = number_format($tongtien, 0, ',', '.');

// die;
echo $content;
$tongthanhtien.=<<<EOF
		<tr style="background:#FEFFDB">
			<td colspan="4" style="text-align:center; font-weight:bold; color:red">TỔNG</td>
			<td style="text-align:center; font-weight:bold; color:red;">$tongsl sp</td>
			<td colspan="2" style="text-align:center; font-weight:bold; color:red;">{$tongtien} vnđ</td>
		</tr>
	</table>
EOF;
echo $tongthanhtien;
$_SESSION['thongtingiohang'] = "$content"."$tongthanhtien";
echo<<<EOF
	<div class="">
		<button type="submit" style="float:right" class="btn btn-primary"><a href="javascript:deleteCart($masp)" style=" color:#FFF!important;">Hủy tất cả</a></button>
		<button type="button" style="float:right; margin-right:10px" class="btn btn-primary" data-toggle="modal" data-target="#datmua">Xác nhận mua</button>
	</div>
</div>
EOF;

?>
<div class="container">
  <div class="modal fade" id="datmua" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Thông tin khách hàng</h4>
        </div>
        <div class="modal-body">
          <form action="xacnhan.php" method="POST">
			<input style="margin:10px 0px; text-indent:5px;" class="form-control" type="text" name="fullname" placeholder="Họ và tên">
			<input style="margin:10px 0px; text-indent:5px;" class="form-control" type="text" name="address" placeholder="Địa chỉ nhận hàng">
			<input style="margin:10px 0px; text-indent:5px;" class="form-control" type="email" name="email" placeholder="Email">
			<input style="margin:10px 0px; text-indent:5px;" class="form-control" type="text" name="phone" placeholder="Số điện thoại">
			<p style="color: red"><i>Cám ơn quý khách đã ghé thăm cửa hàng, thông tin của quý khách sẽ được gửi về hệ thống sau vài giây. Chúng tôi sẽ liên hệ quý khách sau ít phút để xác nhận đơn hàng.</i></p>
			<button type="submit" name="submit" class="btn btn-primary">Xác nhận</button>
			<button type="reset" class="btn btn-primary">Viết lại</button>
			<button style="float:right" type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
		</form>
        </div>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" href="Content/css/bootstrap.min.css">
<script src="Content/js/jquery-1.10.2.min.js"></script>
<script src="Content/js/bootstrap.min.js"></script>
<?php require_once("views/footer.tpl"); ?>
</body>
</html>

<script>
	function deleteCart(id){
		$.ajax({
			type:'POST',
			url:"ajax.php",
			data:{id:id},
			success:function(data){
				$("li#gh a").html(data);
				window.location.href="index.php";
			}
		});
		return false;
	}
</script>