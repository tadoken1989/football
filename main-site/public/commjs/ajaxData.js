var ajaxDataObj = null;
try
{
    ajaxDataObj=new getDataClass();
}
catch(e)
{
    ajaxDataObj = null;
}

function OverWriteFormSubmit()
{
    if(ajaxDataObj!=null)
    {
        for (var i=0;i<document.forms.length;i++)
        {
            document.forms[i].submit=null;
            document.forms[i].submit = function ()
            {
                Submit(this, null);
            }
	    }
    }
}

var ThreadId = null;
var ThreadList = new Object();
function recallAjax(ThreadId)
{
    if (ThreadList[ThreadId] != null)
    {
        ajaxDataObj.AbortRequest(ThreadId);
        ajaxDataObj.GetDataCustomize(ThreadId,ThreadList[ThreadId]);
    }
}
function ExecAjax(url,param,type,ThreadId,FName_Success,FName_Timeout)
{
        ajaxDataObj.AbortRequest(ThreadId);
        var Options = new Object();
        Options["url"]=url;
        Options["data"]=param;
        Options["contentType"]="application/x-www-form-urlencoded";
        Options["dataType"]="text";
        switch (type.toUpperCase())
        {
            case "GET":
            case "POST":
                Options["type"]=type.toUpperCase();
                break;
            default :
                Options["type"]="GET";
        }
        Options["ifModified"]=true;
        Options["cache"]=false;
        Options["async"]=true;
        Options["timeout"]=20000;
        Options["beforeSend"]=null;
        Options["error"]=null;
        //"success", "notmodified", "error", "timeout", "abort", "parsererror"
        Options["complete"]=function(xhr, status) {
                                                    if (HTTPStatusOK(xhr.status) && status == "success") 
                                                    {
                                                        eval(FName_Success+"(xhr.responseText);");
                                                    }
                                                    else if  (status == "timeout")
                                                    {
                                                        //fail
                                                        if (FName_Timeout!=null && FName_Timeout!="" && FName_Timeout!="undefined")
                                                        {
                                                            eval(FName_Timeout+"();");
                                                        }
                                                    }
                                                  }
        ThreadList[ThreadId] = Options;
        ajaxDataObj.GetDataCustomize(ThreadId,Options);
}

function Submit(form,isasync)
{
  if(isasync==null) isasync=true;
  var ConfirmBet = "#fomConfirmBet#,#fomConfirmBetPhone#,#betform#,#fomBingoConfirmBet#";
  if (ConfirmBet.indexOf("#" + form.name + "#") > -1)
  {
      isasync = false;
  }

  ajaxDataObj.AbortRequest(form.name);
  var param = new Object();
  var ChkList = new Object();
  for (i=0;i<form.elements.length;i++)
  {
    switch (form.elements[i].type)
    {
	    case "text":
	    case "hidden":
	    case "select-one":
        param[form.elements[i].name]=form.elements[i].value;
		    break;
	    case "checkbox":
		    if (form.elements[i].checked)
		    {
                if (ChkList[form.elements[i].name]==undefined)
                {
                  ChkList[form.elements[i].name]=form.elements[i].value;
                }
                else
                {
                  ChkList[form.elements[i].name]=ChkList[form.elements[i].name]+","+form.elements[i].value;
                }
		    }
		    break;
    }
  }
  for (var i=0;i<Object.keys(ChkList).length;i++)
  {  
   var arry = ChkList[Object.keys(ChkList)[i]].split(",");  
   if($("[name='"+Object.keys(ChkList)[i]+"']").length>1){
      param[Object.keys(ChkList)[i]]=arry;
   }else{
      param[Object.keys(ChkList)[i]]=arry[0];
   }
  }     
  var Options = new Object();
  Options["url"]=form.action;
  Options["data"]=param;
  Options["contentType"]="application/x-www-form-urlencoded";
  Options["dataType"]="text";
  if (form.method=="")
  {
      Options["type"]="GET";
  }
  else
  {
      Options["type"]=form.method.toUpperCase();
  }
  Options["ifModified"]=true;
  Options["cache"]=false;
  Options["async"]=isasync;
  Options["timeout"]=20000;
  Options["beforeSend"]=null;
  Options["error"]=null;
  Options["complete"]=function(xhr, status) {
                                              if (HTTPStatusOK(xhr.status) && status == "success") 
                                              {
                                                  DataArrived(xhr,form.target);
                                              }
                                              else
                                              {
                                                  //fail
                                              }
                                            }
  ajaxDataObj.GetDataCustomize(form.name,Options);
}
function HTTPStatusOK(code) {

    return (code === 304 || (200 <= code && code <= 207));
}
function DataArrived(xhr,iFrame)
{
    
    var obj = document.getElementById(iFrame);
    if (obj==null)
    {
        obj = document.getElementsByName(iFrame)[0];
    }
    if (obj.tagName.toLowerCase()=="iframe") {
        putIFrameDocument(obj,xhr.responseText);
    }
    else
    {
        obj.innerHTML = xhr.responseText;
    }
}
var isIe = (window.ActiveXObject) ? true : false;
function putIFrameDocument(obj,data)
{
	if(!isIe)
	{ 
	        var ifrm = obj.contentWindow; 
		ifrm.document.open();
		ifrm.document.clear();
		ifrm.document.write(data); 
		ifrm.document.close();
	}
	else
	{
        	var ifrm = obj.contentWindow; 
		ifrm.document.designMode ="on"; 
		ifrm.document.open();
		//ifrm.document.clear();
		ifrm.document.write(data); 
		ifrm.document.designMode ="off"; 
		ifrm.document.close();
	}
}

if (!Object.keys) Object.keys = function(o) {
  if (o !== Object(o))
    throw new TypeError('Object.keys called on a non-object');
  var k=[],p;
  for (p in o) if (Object.prototype.hasOwnProperty.call(o,p)) k.push(p);
  return k;
}
