function viewSubmenu() {
	document.getElementById("submenu_main").style.display = "block";
	document.getElementById("view_submenu").style.display = "none";
	document.getElementById("hide_submenu").style.display = "block";
}
function hideSubmenu() {
	document.getElementById("submenu_main").style.display = "none";
	document.getElementById("view_submenu").style.display = "block";
	document.getElementById("hide_submenu").style.display = "none";
}
function view_dropdown_menu() {
	document.getElementById("dropdownmenu").style.display = "block";
	document.getElementById("dropdownmenu").style.zIndex = "1";
	document.getElementById("view_menu").style.display = "none";
	document.getElementById("hid_menu").style.display = "block";
}
function hidden_dropdown_menu() {
	document.getElementById("dropdownmenu").style.display = "none";
	document.getElementById("view_menu").style.display = "block";
	document.getElementById("hid_menu").style.display = "none";
}

function sendSMSQC (param2, serviceNumber) {
	var uagent = navigator.userAgent.toLowerCase();
	if(uagent.indexOf('iphone') != -1 || uagent.indexOf('ipad') != -1) {
		window.location.href = "sms:"+serviceNumber+";body=BD "+param2;
	} else {
		window.location.href = "sms:"+serviceNumber+"?body=BD "+param2;
	}
}
function sendSMSTV (param2, serviceNumber) {
	var uagent = navigator.userAgent.toLowerCase();
	if(uagent.indexOf('iphone') != -1 || uagent.indexOf('ipad') != -1) {
		window.location.href = "sms:"+serviceNumber+";body="+param2;
	} else {
		window.location.href = "sms:"+serviceNumber+"?body="+param2;
	}
}
function ShowDivAds(n, id){
	for (var i = 1; i <= n; i++) {
		if(i == id){
			if(document.getElementById('ads_topmenu_'+id) != null){
				document.getElementById('ads_topmenu_'+id).style.display = 'block'; }
		}else{
			if(document.getElementById('ads_topmenu_'+i) != null) {
				document.getElementById('ads_topmenu_'+i).style.display = 'none';
			}
		}
	}
}
var c = 0;
function ChangeImage(){
	c = c + 1;
	if(c > 2){
		c = 1;
	}
	ShowDivAds(2, c);
	setTimeout("ChangeImage()",20000);
}