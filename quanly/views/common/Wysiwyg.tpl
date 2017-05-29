<link href="js/apprise.min.css" rel="stylesheet" type="text/css" />
<script src="js/apprise-1.5.min.js" type="text/javascript"></script> 

<script type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">

tinyMCE.init({

	// General options
    
    width  : "100%",

	height : "400",
editor_deselector: "tuan",

	// General options

	mode : "textareas",

	theme : "advanced",


	theme : "advanced",

	plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,imagemanager",

	// Theme options
	theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",

	theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",

	theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,visualchars,nonbreaking,template,blockquote,pagebreak",
	theme_advanced_buttons4 : "fullscreen,insertimage,insert_download_link",
	

	theme_advanced_toolbar_location : "top",

	theme_advanced_toolbar_align : "left",

	theme_advanced_statusbar_location : "bottom",

	theme_advanced_resizing : true,
	
	language : 'vi',


	skin : "o2k7",

	skin_variant : "silver",

	relative_urls : false,
		
remove_script_host : true,

	// Example content CSS (should be your site CSS)

	content_css : "css/table.css",


	// Drop lists for link/image/media/template dialogs

	template_external_list_url : "js/template_list.js",

	external_link_list_url : "js/link_list.js",

	external_image_list_url : "js/image_list.js",

	media_external_list_url : "js/media_list.js",



	// Replace values for the template plugin

	template_replace_values : {

		username : "Some User",

		staffid : "991234"

	},

	setup : function(ed) {
        // Add a custom button
        ed.addButton('insert_download_link', {
		title : 'Thêm link download',
		image : '<?php echo BASE_URL;?>admincp/images/down.png',
		onclick : function() {
			
				apprise('Nhập địa chỉ tải tệp file bên ngoài (VD: Mediafire.com...)', {'input':true, textOk:'Nhập', textCancel:'Hủy'}, function(r)
				{
				if(!r)
				{ 
					
				}
				else
				{ 
					ed.focus();
			ed.selection.setContent('<a href="'+r+'" target="_blank"><img src="http://img.thegioitruyenthong.vn/download-icon.png" width="75" height="32" /></a>');        
				}
				});
			}
		});
	},
		  
		  
		 

   

	autosave_ask_before_unload : false // Disable for example purposes

});

</script>