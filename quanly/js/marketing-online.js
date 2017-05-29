function redirect(url)
{
	this.location.href = url;
}


var menuHidden = true;
function create_menu(obj) {
    var position = $(obj).offset();
    var posTop = position.top - 62;
    var posLeft = position.left - 10;
    $("#my_menu").css("left", posLeft + "px");
    $("#my_menu").css("top", posTop + "px");

    if (menuHidden == false) {
        $("#my_menu").hide();
        menuHidden = true;
    }
    else {
        $("#my_menu").show();
        menuHidden = false;
    }    
}