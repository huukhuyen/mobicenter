<?php
new HomeController ();

class HomeController {
	function HomeController() {
		$header = 'Trang chủ';
		require_once(VIEWS_COMMON_ADMIN_PATH.'header.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'TabBegin.tpl');
        echo <<<EOF
        <h4 style="text-transform: uppercase;">XIN CHÀO QUẢN TRỊ VIÊN <span style="color:red">{$_SESSION['username']}</span></h4>
        <h4>Chúc bạn một ngày làm việc hiệu quả</h4>
EOF;
		require_once(VIEWS_COMMON_ADMIN_PATH.'TabEnd.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'footer.tpl');

	}
}

?>