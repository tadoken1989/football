function loadData(url, function_change) {
    if (window.XMLHttpRequest) { // Non-IE browsers
        req = new XMLHttpRequest();
        req.onreadystatechange = function_change;
        try {
            req.open("GET", url, true); //was get
        } catch (e) {
            //alert("Problem Communicating with Server\n"+e);
        }
        req.send(null);
    } else if (window.ActiveXObject) { // IE

        req = new ActiveXObject("Microsoft.XMLHTTP");
        if (req) {
            req.onreadystatechange = function_change;
            req.open("GET", url, true);
            req.send();
        }
    }
}
function processStateLoadData() {
    //alert(req.readyState);
    if (req.readyState == 4) { // Complete
        if (req.status == 200) { // OK response
            document.getElementById("ajax-loadform").innerHTML = req.responseText;
        } else {
            //alert("Problem with server response:\n " + req.statusText);
        }
    } else {
        //document.getElementById("ajax-loadform").innerHTML = "<center><div style='border: 1px solid #308900;width:200px;height:50px;'>Đang tải dữ liệu <br/><image src='<%=request.getContextPath() %>/images/loading.gif' /></div></center>";
    }
}
function isMobileDevice() {
    isMobile = false;
    var uagent = navigator.userAgent.toLowerCase();
    var arrMobi = new Array('midp', 'j2me', 'avantg', 'ipad', 'iphone', 'docomo', 'novarra', 'palmos', 'palmsource', '240x320', 'opwv', 'chtml', 'pda', 'windows ce', 'mmp/', 'mib/', 'symbian', 'wireless', 'nokia', 'hand', 'mobi', 'phone', 'cdm', 'up.b', 'audio', 'sie-', 'sec-', 'samsung', 'htc', 'mot-', 'mitsu', 'sagem', 'sony', 'alcatel', 'lg', 'erics', 'vx', 'nec', 'philips', 'mmm', 'xx', 'panasonic', 'sharp', 'wap', 'sch', 'rover', 'pocket', 'benq', 'java', 'pt', 'pg', 'vox', 'amoi', 'bird', 'compal', 'kg', 'voda', 'sany', 'kdd', 'dbt', 'sendo', 'sgh', 'gradi', 'jb', 'dddi', 'moto', 'opera mobi', 'opera mini', 'android');

    for (i = 0; i < arrMobi.length; i++) {
        if (uagent.indexOf(arrMobi[i]) != -1) {
            isMobile = true;
            break;
        }
    }
    return isMobile;
}

var milsecondsTillRepeat = 30000;
var isMobile = isMobileDevice();
function startRefreshing()
{
    //console.log(location.host);
    if (isMobile) {
        loadData('process-live.jsp', processStateLoadData);
    } else {
        loadData('process-web-live.jsp', processStateLoadData);
    }
    //setTimeout("startRefreshing()",milsecondsTillRepeat);
}

function loadData_Rate(url, function_change) {
    if (window.XMLHttpRequest) { // Non-IE browsers
        req = new XMLHttpRequest();
        req.onreadystatechange = function_change;
        try {
            req.open("GET", url, true); //was get
        } catch (e) {
            //alert("Problem Communicating with Server\n"+e);
        }
        req.send(null);
    } else if (window.ActiveXObject) { // IE

        req = new ActiveXObject("Microsoft.XMLHTTP");
        if (req) {
            req.onreadystatechange = function_change;
            req.open("GET", url, true);
            req.send();
        }
    }
}
function processStateLoadData_Rate() {
    //alert(req.readyState);
    if (req.readyState == 4) { // Complete
        if (req.status == 200) { // OK response
            document.getElementById("ajax-loadrate").innerHTML = req.responseText;
        } else {
            //alert("Problem with server response:\n " + req.statusText);
        }
    } else {
        //document.getElementById("ajax-loadrate").innerHTML = "<center><div style='border: 1px solid #308900;width:200px;height:50px;'>Đang tải dữ liệu <br/><image src='<%=request.getContextPath() %>/images/loading.gif' /></div></center>";
    }
}
var milsecondsTillRepeatRate = 30000;
function startRefreshingRate()
{
    setTimeout("startRefreshingRate()", milsecondsTillRepeatRate);
    loadData_Rate('process-rate-live.jsp', processStateLoadData_Rate);
}

function elementHideShow(elementToHideOrShow)
{
    var el = document.getElementById(elementToHideOrShow);
    el.style.display = "none";
}
function elementShow(elementToHideOrShow)
{
    var el = document.getElementById(elementToHideOrShow);
    el.style.display = "";
}
function isViewTLH1(isView, id) {
    var elBut = document.getElementById('showHiep1' + id);
    if (isView == 0) {
        elementShow('viewTyLeHiep1' + id);
        elBut.style.display = "none";
    } else {
        elementHideShow('viewTyLeHiep1' + id);
        elBut.style.display = "";
    }
}
function hideTab() {
    document.getElementById("livescore").style.display = "none";
    document.getElementById("livescore_col").style.display = "block";
    document.getElementById("livescore_exp").style.display = "none";
    document.getElementById("td_livescore_exp").style.display = "none";
    document.getElementById("td_livescore_col").style.display = "block";
}
function expandTab() {
    document.getElementById("livescore").style.display = "block";
    document.getElementById("livescore_col").style.display = "none";
    document.getElementById("livescore_exp").style.display = "block";
    document.getElementById("td_livescore_exp").style.display = "";
    document.getElementById("td_livescore_col").style.display = "none";
}
function hideLvsTab() {
    document.getElementById("lichvansu_tab").style.display = "none";
    document.getElementById("lvs_col").style.display = "none";
    document.getElementById("lvs_exp").style.display = "block";
    document.getElementById("lichvansu").removeAttribute("class");
    document.getElementById("lichvansu").setAttribute("class", "menubd_3");
}
function expandLvsTab() {
    document.getElementById("lichvansu_tab").style.display = "block";
    document.getElementById("lvs_col").style.display = "block";
    document.getElementById("lvs_exp").style.display = "none";

    document.getElementById("lichvansu").removeAttribute("class");
    document.getElementById("lichvansu").setAttribute("class", "menubd_2");
}

function getCookie(name) {
    var cname = name + "=";
    var dc = document.cookie;
    if (dc.length > 0) {
        begin = dc.indexOf(cname);
        if (begin != -1) {
            begin += cname.length;
            end = dc.indexOf(";", begin);
            if (end == -1)
                end = dc.length;
            return dc.substring(begin, end);
        }
    }
    return null;
}

function writeCookie(name, value)
{
    var expire = "";
    var hours = 365;
    expire = new Date((new Date()).getTime() + hours * 3600000);
    expire = ";path=/;expires=" + expire.toGMTString();
    document.cookie = name + "=" + escape(value) + expire;
}