//=======================
// LOGIN AJAX
//=======================
function login_ajax() {
	var rand = randomString();

	var username = $("#username").val();
	var password = $("#password").val();
	var remember = $("input[@name=CheckPersist]:checked").val();

	if (username == "" || password == "") {
		alert("Vui lòng nhập username và password đầy đủ");
		return;
	}

	if (remember != 'on') {
		remember = 'off';
	}

	url_login = 'Controls/Ajaxlogin.aspx?Username=' + username + '&Password='
			+ password + '&CheckPersist=' + remember + '&rand=' + rand;
	Loading();

	$.ajax({
		url : url_login,
		type : 'GET',
		dataType : "html",
		error : function() {
			alert('Error loading XML document');
		},
		success : function(data) {
			Result(data);
		}
	});
}

function forget_ajax() {

	var rand = randomString();
	var email = $("#email").val();

	if (email == "") {
		alert("Vui lòng nhập địa chỉ email");
		return false;
	}

	if (validateEmail(email) == false) {
		alert("Vui lòng nhập đúng địa chỉ email");
		return false;
	}

	return true;
}

// =======================
// READY DOCUMENT
// =======================
$(document).ready(function() {
	// --------------------
	// FOCUS USERNAME
	// --------------------
	if ($('#username').length > 0) {
		$('#username').focus();
	}

	else if ($('#password').length > 0) {
		$('#password').focus();
	}

	else {
		
		$('#username').focus();
	}

})

function redirect(url)
{
	this.location.href = url;
}

function onclick_forget_password() {

	var isReturn = forget_ajax();
	return isReturn;
}
function loginHandle() {
	login_ajax();

	$('#username').val("");
	$('#password').val("");

	return false;
}

function validateEmail(elementValue) {
	var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	return emailPattern.test(elementValue);
}
