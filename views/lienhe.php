<div class="content-new">
    <h3 style="font: bold 16px/normal Open Sans, Arial, sans-serif;text-transform: uppercase;margin-bottom: 10px;">Liên hệ</h3>
    <div class="lienhe_left">
        <div>
            <p>
                <span><strong>Địa chỉ : </strong>127 -129 Nguyễn Văn Linh ,Đà Nẵng</span></p>
            <p>
                <span><strong>Điện thoại:</strong> 0511 777 8888</span>&nbsp;<a href="index.html"><span style="color:#008080;">Apple Center Trung t&acirc;m bảo h&agrave;nh Apple</span></a><strong> </strong></p>
            <p>
                <span><strong>Email:</strong> </span><a href="index.html"><span style="color:#008080;">nguyenhuukhuyenudn@gmail.com</span></a></p>
        </div>
        <div class="bando">
            <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;language=vi"></script>
            <script type="text/javascript">
            var map;

            function initialize() {
                var myLatlng = new google.maps.LatLng(16.060130, 108.212731);
                var myOptions = {
                    zoom: 16,
                    center: myLatlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
                map = new google.maps.Map(document.getElementById("div_id"), myOptions);
                // Biến text chứa nội dung sẽ được hiển thị
                var text;
                text = "<b>Mobi Center</b> <br/> Địa chỉ: 129 Nguyễn Văn Linh - Đà Nẵng <br>Hotline: 0511 777 8888";
                var infowindow = new google.maps.InfoWindow({
                    content: text,
                    size: new google.maps.Size(100, 50),
                    position: myLatlng
                });
                infowindow.open(map);
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    title: ""
                });
            }
            </script>

            <body onLoad="initialize()">
                <div id="div_id" style="height:380px; width:400px;color: #333;"></div>
            </body>
        </div>
    </div>
    <div class="lienhe_right">
        <div class="wrapper_contact">
            <div class='form_lien_he'>
                <form method="POST" action="xacnhan.php">
                    <div class="clear">
                        <div class=error style='font-weight:bold;'>Phản hồi của bạn về chúng tôi !</div>
                    </div>
                    <fieldset>
                        <label>Họ và tên (*)</label>
                        <input  type="text"  value="" name="txtName" />
                    </fieldset>
                    <fieldset>
                        <label>Email(*)</label>
                        <input type="text"  value="" name="email" />
                    </fieldset>
                    <fieldset>
                        <label>Số điện thoại(*)</label>
                        <input type="text"  value="" name="txtTel" />
                    </fieldset>
                    <fieldset>
                        <label>Tiêu đề(*)</label>
                        <input style="width: 395px!important;" type="text" name="txtTitle" />
                    </fieldset>
                    <div class="clearfix"></div>
                    <div class="clearfix"></div>
                    <fieldset>
                        <label>Nội dung (*)</label>
                        <textarea rows="5" name="txtContent" cols="40"></textarea>
                    </fieldset>
                    <div class="clearfix"></div>
                    <input class="submit" type="submit" name="lienhe-sm"/>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>