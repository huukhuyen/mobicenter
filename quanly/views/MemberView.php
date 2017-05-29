<?php

//@ Tệp file     : MemberView.cs ver 1.0 
//@ Mobile Center

class MemberView
{
    function viewList($pages)
    {
        $header = 'List Member';
        
        if(Session::checkMessageSession())
        {
            $m = Session::getMessageSession();
            
            $message = $m['message'];
            $messageType = $m['type'];
        }
        
        require_once(VIEWS_COMMON_ADMIN_PATH.'header.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'TabBegin.tpl');
		
		if (($page['Username'] == $_SESSION['username']) ||
		($_SESSION['groupID'] == 1))
		{
		
echo <<<EOF
        <div><input type="button" class="button2" value="Thêm thành viên" style="margin-bottom:10px;"onclick="location.href='index.php?module=Member&act=Insert';"></div>
EOF;
		}
		echo <<<EOF
        <table class="adminlist">
            <thead>
                <tr>
                    <th width="20">#</th>                    
                    <th class="title" nowrap="nowrap">Username</th>
                    <th class="title" nowrap="nowrap">Tên</th>
					<th class="title" nowrap="nowrap">Quyền hạn</th>
                    <th class="title" nowrap="nowrap">Email</th>                    
                    <th class="title" nowrap="nowrap">Hỗ trợ</th>
					<th class="title" nowrap="nowrap">Điện thoại</th>
					<th class="title" nowrap="nowrap">Phiên làm việc</th>
                    <th class="title" nowrap="nowrap">IPAddress</th>
                    
                        
                    <th width="60">Chỉnh sửa</th>
                    <th width="60">Xóa</th>
                </tr>
            </thead>
            
            <tbody>
EOF;
if(is_array($pages) && sizeof($pages) > 0)
{
    foreach ($pages as $page)
    {        
        $editHref = 'index.php?module=Member&act=Update&MemberID='.$page['MemberID'];
        $removeHref = 'index.php?module=Member&act=Delete&MemberID='.$page['MemberID'];
        $permission = $page['GroupID'] == "1" ? "Quản trị viên" : "Nhân viên";
		
        echo <<<EOF
		
                <tr>
                    <td width="20"align="center"><!-- BEGIN MemberID -->{$page['MemberID']}<!-- END MemberID --></td>                    
                    <td><!-- BEGIN Username -->{$page['Username']}<!-- END Username --></td>
                    <td><!-- BEGIN RealName -->{$page['RealName']}<!-- END RealName --></td>
					<td><!-- BEGIN RealName -->{$permission}<!-- END RealName --></td>
                    <td><!-- BEGIN Email -->{$page['Email']}<!-- END Email --></td>                    
                    <td><!-- BEGIN IM -->{$page['IM']}<!-- END IM --></td>
                    <td><!-- BEGIN Phone -->{$page['Phone']}<!-- END Phone --></td>                    
                    <td><!-- BEGIN SessionID -->{$page['SessionID']}<!-- END SessionID --></td>
                    <td><!-- BEGIN IPAddress -->{$page['IPAddress']}<!-- END IPAddress --></td>
                    
                    
                    <td width="60"align="center"><a href="$editHref"><img src="images/edit.png" /></a></td>
	                <td width="60"align="center">
EOF;
					if ($page['Username'] != $_SESSION['username'] && $_SESSION['groupID'] == 1)
					{
					echo<<<EOF
					<a onclick="return confirm('Bạn có chắc chắn muốn xóa không ?');" href="$removeHref"><img src="images/delete.png" /></a>
EOF;
					}
			echo<<<EOF
					</td>                    
                </tr>
EOF;
    }
		
}

echo <<<EOF
            </tbody>
        </table>
EOF;
        require_once(VIEWS_COMMON_ADMIN_PATH.'TabEnd.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'footer.tpl');
    }
    
    function detail($message = null, $messageType = null, $fields = null)
    {        
        $header = $fields != null ? 'Chỉnh sửa' : 'Thêm mới';
                
        require_once(VIEWS_COMMON_ADMIN_PATH.'header.tpl');
        require_once(VIEWS_ADMIN_PATH.'Member.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'footer.tpl');
    }
	
	
	function changePassword($fields = null)
    {        
        $header = $fields != null ? 'Đổi mật khẩu' : 'Đổi mật khẩu';
                
        require_once(VIEWS_COMMON_ADMIN_PATH.'header.tpl');
        require_once(VIEWS_ADMIN_PATH.'MemberPassword.tpl');
        require_once(VIEWS_COMMON_ADMIN_PATH.'footer.tpl');
    }
}

?>