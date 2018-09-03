function getBrowserVer()
{
        var Sys = {};
       	var ua = navigator.userAgent.toLowerCase();
        var s;
        (s = ua.match(/msie ([\d.]+)/)) ? Sys.ie = s[1] :
        (s = ua.match(/firefox\/([\d.]+)/)) ? Sys.firefox = s[1] :
        (s = ua.match(/chrome\/([\d.]+)/)) ? Sys.chrome = s[1] :
        (s = ua.match(/opera.([\d.]+)/)) ? Sys.opera = s[1] :
        (s = ua.match(/version\/([\d.]+).*safari/)) ? Sys.safari = s[1] : 0;
        if (Sys.ie) return "IE" + Sys.ie;
        if (Sys.firefox) return "Firefox" + Sys.firefox;
        if (Sys.chrome) return "Chrome" + Sys.chrome;
        if (Sys.opera) return "Opera" + Sys.opera;
        if (Sys.safari) return "Safari" + Sys.safari;
}
function getEvent()
{
    if(document.all)
    {
        return window.event;
    }
    func=getEvent.caller;
    while(func!=null)
    {    
        var arg0=func.arguments[0];
        if(arg0)
        {
            if((arg0.constructor==Event || arg0.constructor ==MouseEvent) || (typeof(arg0)=="object" && arg0.preventDefault && arg0.stopPropagation))
            {    
                return arg0;
            }
        }
        func=func.caller;
    }
    return null;
}    
    
function getDivH(element) 
{   
    var display = element.style.display;   
    if (display != 'none' && display != null)
      return  element.offsetHeight;   
    var els = element.style;   
    var originalVisibility = els.visibility;   
    var originalPosition = els.position;   
    var originalDisplay = els.display;   
    els.visibility = 'hidden';   
    els.position = 'absolute';   
    els.display = 'block';   
    var originalHeight = element.clientHeight;   
    els.display = originalDisplay;   
    els.position = originalPosition;   
    els.visibility = originalVisibility;   
    return originalHeight;   
}  

function getDivW(element) 
{   
    var display = element.style.display;   
    if (display != 'none' && display != null)
      return  element.offsetWidth;   
    var els = element.style;   
    var originalVisibility = els.visibility;   
    var originalPosition = els.position;   
    var originalDisplay = els.display;   
    els.visibility = 'hidden';   
    els.position = 'absolute';   
    els.display = 'block';   
    var originalWidth = element.clientWidth;   
    els.display = originalDisplay;   
    els.position = originalPosition;   
    els.visibility = originalVisibility;   
    return originalWidth;   
}

function MsgBox(InnerData,CloseSec,Speed,MainID)
{
    var data=InnerData;
    var DataHeigth;
    var DataWidth;
    var Sec=CloseSec;
    var iTimeOut;
    var objTimer;
    var S=Speed;
    var ver=getBrowserVer();
    var bgObj=document.getElementById(MainID);
	if (bgObj== null)
	{
	    bgObj=document.createElement("div");
	    bgObj.id=MainID;
            if (ver.indexOf("IE6")!=-1)
            {
            	var bd=document.getElementsByTagName("body")[0];
                bd.style.height="100%";
                bd.style.overflowY="auto";
            	var ht=document.getElementsByTagName("html")[0];
                ht.style.overflowY="hidden";
                bgObj.style.cssText = "display:block;bottom:0px;right:1px!important;float: right;position:absolute;border:1px solid #fff;text-align:center;";
            }
	    else
            {
            	bgObj.style.cssText = "display:block;bottom:0px;right:1px!important;float: right;position:fixed;border:1px solid #fff;text-align:center;";
            }
	    document.body.appendChild(bgObj);
	}
	var msgObj=document.createElement("div");
	msgObj.style.display="none";
	msgObj.style.overflow="hidden";
	msgObj.innerHTML=InnerData;
	msgObj.onclick=function() 
    	{
		var evt=getEvent();
		var element=evt.srcElement || evt.target;
		if (element.style.cursor=="pointer")
		{
			objTimer=window.setInterval(function(){slideOff()},S);
		}
	}
	DataHeigth=getDivH(msgObj);
	DataWidth=getDivW(msgObj);
	bgObj.insertBefore(msgObj, bgObj.firstChild);
	DataHeigth=getDivH(msgObj);
	DataWidth=getDivW(msgObj);
	msgObj.style.width=DataWidth+"px";
    function slideOn()
    {
        if (msgObj.style.display=="none")
        {
            msgObj.style.height = "0px";
            msgObj.style.display = "block";
        }
        if (parseInt(msgObj.style.height.replace("px",""),10)<DataHeigth)
        {
		if (parseInt(msgObj.style.height.replace("px",""),10)+S<DataHeigth)
		{
			msgObj.style.height=(parseInt(msgObj.style.height.replace("px",""),10)+S)+"px";
		}
		else
		{
			msgObj.style.height=DataHeigth+"px";
		}
        }
        else
        {
            window.clearInterval(objTimer);
            iTimeOut=setTimeout(function() {objTimer=window.setInterval(function(){slideOff()},10);},Sec);
        }
    }
    function slideOff()
    {
        clearTimeout(iTimeOut);
        if (parseInt(msgObj.style.height.replace("px",""),10)>0)
        {
            	if (parseInt(msgObj.style.height.replace("px",""),10)-S>0)
		{
			msgObj.style.height=(parseInt(msgObj.style.height.replace("px",""),10)-S)+"px";
		}
		else
		{
			msgObj.style.height="0px";
		}
        }
        else
        {
            msgObj.style.display="none";
            window.clearInterval(objTimer);
            bgObj.removeChild(msgObj);
            if (bgObj.children.length==0)
            {
                document.body.removeChild(bgObj);
            }
        }
    }
    
	this.openMsg=function()
                {
                    objTimer=window.setInterval(function(){slideOn()},10);
                }
	this.closeMsg=function()
                {
                    objTimer=window.setInterval(function(){slideOff()},10);
                }
}

var DivLauncherCnt=0;
var DefDocMouseDown;
var DefDocMouseUp;
var DefDocMouseMove;
function DivLauncher(aDiv, aDragger, aCloser) {

var DEFAULT_X = 50; 
var DEFAULT_Y = 50;

/**************************************************************
 * private members block
 **************************************************************/
	var _ElmPopDiv = aDiv;
	var _ElmDragger = aDragger;
	var _ElmCloser = aCloser;
	
	var _Showed = false;
	var _EnableDnD = false;
	var _OffsetX;
	var _OffsetY;
	var _NowX;
	var _NowY;
	
	var _IsIE = document.all;
	var _IsNN = !document.all&&document.getElementById;
	
	
	var _this = this;
	//var isSafari = navigator.userAgent.search("Safari") > -1;
	
	
/**************************************************************
 * public members & events block
 **************************************************************/
	this.beforeOpen = null;		// function(elementDiv);
	this.afterOpen = null;		// function(elementDiv);
	this.beforeClose = null;	// function(elementDiv);
	this.afterClose = null;		// function(elementDiv);
	this.onDragging = null;		// function(elementDiv);
  this.isOpened = false;
  
/**************************************************************
 * constructor initialize
 **************************************************************/
	_ElmPopDiv.style.position = "absolute";
	_ElmPopDiv.style.display = "none";
	_ElmPopDiv.style.zIndex = 100;
	if (_ElmDragger != null) {
		_ElmDragger.style.cursor = "move";
	}


/**************************************************************
 * private methods block
 **************************************************************/

	/*
	 * function to control "onmouseddown" event for Drag & Drop action
	 * Params:
	 *	Elm: html object; the object 
	 */
	function dndDown(Elm){		
		var tagHit = _IsIE ? event.srcElement : Elm.target;  

		var iCount = 0;
		while ( (tagHit != _ElmDragger) && (tagHit != _ElmCloser) && (tagHit.tagName != _ElmPopDiv) ) {
			tagHit = tagHit.parentNode;
			if (tagHit == null) {
				return;
			}
			if (iCount >= 50) return;
			iCount++;
		}
		if (tagHit == _ElmDragger) {
			_OffsetX = _IsIE ? event.clientX : Elm.clientX;
			_OffsetY = _IsIE ? event.clientY : Elm.clientY;
			_NowX = parseInt(_ElmPopDiv.style.left);
			_NowY = parseInt(_ElmPopDiv.style.top);
			_EnableDnD = true;
		} else if (tagHit == _ElmCloser) {
			hide();
		}
	}
	
	function dndUp() {
		_EnableDnD = false;
	}

	function dndMove(Elm){
		if (!_EnableDnD) return;
		
		if (_IsIE) {
			_ElmPopDiv.style.left = parseInt(_NowX) + parseInt(event.clientX) - parseInt(_OffsetX) + "px";
			_ElmPopDiv.style.top = parseInt(_NowY) + parseInt(event.clientY) - parseInt(_OffsetY) + "px";
		} else {
			_ElmPopDiv.style.left = parseInt(_NowX) + parseInt(Elm.clientX) - parseInt(_OffsetX) + "px";
			_ElmPopDiv.style.top = parseInt(_NowY) + parseInt(Elm.clientY) - parseInt(_OffsetY) + "px";
		}
	}

	function hide(){
		if (!_Showed) {
			return;
		}
		
		if (_this.beforeClose != null) {
			if (!_this.beforeClose(_ElmPopDiv)) {
				return;
			}
		}
		DivLauncherCnt--;
		if (DivLauncherCnt<=0)
		{
		    document.onmousemove = DefDocMouseMove;
		    document.onmousedown = DefDocMouseDown;
		    document.onmouseup = DefDocMouseUp;
		    DivLauncherCnt=0;
		}
		_ElmPopDiv.style.display = "none";
		_EnableDnD = false;		
		_Showed = false;
		
		if (_this.afterClose != null) {
			_this.afterClose(_ElmPopDiv);
		}
		_this.isOpened = false;
	}
	
	function show(posX, posY){
		if (_this.beforeOpen != null) {
			if (!_this.beforeOpen(_ElmPopDiv)) {
				return;
			}
		}
		
		var iTop, iLeft;
		iTop = iLeft = 0;
		if (document.documentElement && document.documentElement.scrollTop) {
			iTop = document.documentElement.scrollTop;
			iLeft = document.documentElement.scrollLeft;
		} else if (document.body) {
			iTop = document.body.scrollTop;
			iLeft = document.body.scrollLeft;
		} 
	    _ElmPopDiv.style.top = parseInt(posY) + parseInt(iTop) + "px";
		_ElmPopDiv.style.left = parseInt(posX) + parseInt(iLeft) + "px";

		if (_Showed) {
			return;
		}
		if (DivLauncherCnt==0)
		{
		    DefDocMouseMove = document.onmousemove;
		    DefDocMouseDown = document.onmousedown;
		    DefDocMouseUp = document.onmouseup;
		}
        DivLauncherCnt++;
		document.onmousemove = dndMove;
		document.onmousedown = dndDown;
		document.onmouseup = dndUp;
		_ElmPopDiv.style.display = "inline";		
		_Showed = true;
		
		if (_this.afterOpen != null) {
			_this.afterOpen(_ElmPopDiv);
		}
		_this.isOpened = true;		
	}

/**************************************************************
 * public methods block
 **************************************************************/

	this.close = function() {
		hide();
	}
	
	this.open = function(posX, posY) {
		if (arguments.length < 2) {
			posX = DEFAULT_X;
			posY = DEFAULT_Y;
		}
		show(posX, posY);
	}
	
}


function DivOption(ADiv, AutoCloseSec) {

	var _IsIE = (window.ActiveXObject) ? true : false;
	var _self = this;
	var _HandleClose;
	var _Opened = false;

	this.Div = ADiv;
	this.Div.style.display = "none";
	this.AutoCloseSec = AutoCloseSec;

	function mouseOverDiv(AEvent) {
		window.clearTimeout(_HandleClose);
		//alert("mouseOver");
	}
	function mouseOutDiv(AEvent) {
		window.clearTimeout(_HandleClose);
		_HandleClose = window.setTimeout(closeDiv, _self.AutoCloseSec * 1000);
		//alert("mouseOut");
	}

	function closeDiv(AEvent) {
		if (!_Opened) return;

		window.clearTimeout(_HandleClose);
		if (_IsIE) {
			window.detachEvent("onblur", closeDiv);
			//document.detachEvent("onclick", closeDiv);
			_self.Div.detachEvent("onmouseover", mouseOverDiv);
			_self.Div.detachEvent("onmouseout", mouseOutDiv);
		} else {
			/*try {
				window.removeEventListener("blur", closeDiv, false); 
			} catch (err) { }*/
			document.removeEventListener("click", closeDiv, false);
			_self.Div.removeEventListener("mouseover", mouseOverDiv, false); 
			_self.Div.removeEventListener("mouseout", mouseOutDiv, false);
		}
		_Opened = false;
		_self.Div.style.display = "none";
		//alert("AEvent=" + AEvent + "; window.event=" + window.event);
	}

	this.isOpened = function () {
		return _Opened;
	}

	this.close = function(AEvent) {
		closeDiv(AEvent);
	}

	this.open = function(AEvent, posX, posY) {
		if (_Opened) return;

		if (window.event) {
			window.event.cancelBubble = true;
		} else if (AEvent) {
			AEvent.stopPropagation();
		}

		if (_IsIE) {
			//window.detachEvent("onblur", closeDiv);
			//window.attachEvent("onblur", closeDiv);
			document.detachEvent("onclick", closeDiv);
			document.attachEvent("onclick", closeDiv);
			this.Div.attachEvent("onmouseover", mouseOverDiv);
			this.Div.attachEvent("onmouseout", mouseOutDiv);
		} else {
			/*try {
				window.removeEventListener("blur", closeDiv, false); 
			} catch (err) { }
			window.addEventListener("blur", closeDiv, false);
			document.removeEventListener("click", closeDiv, false); 
			document.addEventListener("click", closeDiv, false);*/
			this.Div.removeEventListener("mouseover", mouseOverDiv, false); 
			this.Div.addEventListener("mouseover", mouseOverDiv, false);
			this.Div.removeEventListener("mouseout", mouseOutDiv, false); 
			this.Div.addEventListener("mouseout", mouseOutDiv, false);
		}

		window.clearTimeout(_HandleClose);
		if (this.AutoCloseSec != null) {
			_HandleClose = window.setTimeout(closeDiv, this.AutoCloseSec * 1000);
		}

		if(!fFrame.IsNewCashSite)
		    this.Div.style.position = "absolute";
		if (posX != null) {
			this.Div.style.left = posX;
		}
		if (posY != null) {
			this.Div.style.top = posY;
		}
		this.Div.style.display = "block";
		_Opened = true;
	}
	
	this.act = function(AEvent, posX, posY) {
		if (!_Opened) {
			this.open(AEvent, posX, posY);
		} else {
			this.close(AEvent);
		}
	}
}

function DivPop(ADiv, AutoCloseSec) {

	var _IsIE = (window.ActiveXObject) ? true : false;
	var _self = this;
	var _HandleClose;
	var _Opened = false;
	var _Focus = false;

	this.Div = ADiv;
	this.Div.style.display = "none";
	this.AutoCloseSec = AutoCloseSec;
	
	
	function getbyFocus(){
	    var getElementFocus = document.activeElement.name;
	    if (getElementFocus == 'txtUserName' || getElementFocus == 'txtPasswd' || getElementFocus == 'txtValidCode' || getElementFocus == 'txtID' || getElementFocus == 'txtPW' || getElementFocus == 'txtCode') {
	        this._Focus = true;
	    } else {
	        this._Focus = false;
	    }
	}


	function closeDiv() {

	    getbyFocus();
		if (!_Opened) return;
		if (this._Focus){
			_HandleClose = window.setTimeout(closeDiv, _self.AutoCloseSec * 1000);
			return;
		}

		window.clearTimeout(_HandleClose);
		if (_IsIE) {
		    window.detachEvent("onblur", closeDiv);

		} else {
			document.removeEventListener("click", closeDiv, false);
		}
		_Opened = false;
		_self.Div.style.display = "none";

	}

	this.isOpened = function () {
		return _Opened;
	}

	this.close = function() {
		closeDiv();
	}

	this.open = function( posX, posY) {
		if (_Opened) return;


		window.clearTimeout(_HandleClose);
		if (this.AutoCloseSec != null) {
			_HandleClose = window.setTimeout(closeDiv, this.AutoCloseSec * 1000);
		}

		this.Div.style.position = "absolute";

		this.Div.style.display = "block";
		_Opened = true;
	}
	
	this.act = function( posX, posY) {
		if (!_Opened) {
			this.open( posX, posY);
		} else {
			this.close();
		}
	}
}