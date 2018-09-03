/*******************************************************************************************
 * OddsUtils.js
 * Description: Javascript utility functions for Odds Display Framework
 * Author: Yai Chen
 *******************************************************************************************/

var REFRESH_GAP = true; // a flag to noted is odds display refreshing

var CLS_ODD = "UdrDogOddsClass";
var CLS_EVEN = "FavOddsClass";
//Scott 2008.5.15 for Deposit Select League DIV Width
var DEPOSIT_LEAGUE_WIDTH = 600;
var MEMBER_LEAGUE_WIDTH = 640;
var fFrame = getParent(window);
var bfLastSelectedSport = "";
var siteObj = new Object();
Set4HourColor();
SetSelectDateColor();
SetSpanTag();
SetCss();
siteObj._IsPhonebet = fFrame.SiteMode==1;
function Set4HourColor() {
  siteObj._4HourColor = fFrame.HourLinkColor;
}

function SetSelectDateColor() {
  siteObj._SelectDateColor_Def = fFrame.DateColor;
  if (fFrame.SiteId=="4200800" || fFrame.SiteId=="4200200") {
	  siteObj._SelectDateColor_Sel = "#0c5790";
  } else {
	  siteObj._SelectDateColor_Sel = "#9F0915";
  }
}

function SetSpanTag() {
    if (fFrame.SiteId =="4280" || fFrame.SiteId=="4200800") {
        siteObj._SpanTagS = "<span>";
        siteObj._SpanTagE = "</span>";
    } else {
        siteObj._SpanTagS = "";
        siteObj._SpanTagE = "";
    }
}

function go() {
    var b = document.getElementById("chkLFAll");
    var c = document.getElementsByName("LF");
    //var a = document.getElementById("chkSave");
    //var f = a.checked ? "1" : "0";
    //IsSaveLeague = a.checked ? true : false;
    if (b.checked) {
        for (i = 0; i < c.length; i++) {
            c[i].checked = false;
        }
        b.checked = true;
        arr_League = new Array("0");
    } else {
        arr_League = new Array();
        for (i = 0; i < c.length; i++) {
            if (c[i].value == "" || c[i].value == "0") {
                c[i].checked = false;
            }
            if (c[i].checked) {
                arr_League.push(c[i].value);
            }
        }
    }
    var d = LeaguePage + "_data.aspx";
    var e = new Object();
    e.market = fFrame.LastSelectedMArket.toLowerCase();
    e.gamemode = fFrame.LastSelectedMenu;
    e.sport = fFrame.LastSelectedSport;
    e.pagename = d.toLowerCase();
    e.selleague = arr_League.toString();
    e.mode = "league";
    e.writedb = 0;
    SelLeagueThreadId = "RecSelLeague";
    ExecAjax("RecSelData.aspx", e, "POST", SelLeagueThreadId, "RecSelLeague");
    PopLauncher.close();
    FinalpaintOddsTable();
}

function RecSelLeague(a) {
    if (arr_League.length == 1 && arr_League[0] == "0") {
        SelLeagueCnt = 0;
    } else {
        SelLeagueCnt = arr_League.length;
    }
    checkLeagueCount();
}

function SetCss() {
	    if (fFrame.SiteId=="4280" || fFrame.SiteId=="4200800") {
	        siteObj._t_Order_Css=" right";
	    } else {
	        siteObj._t_Order_Css="";
        }
}

function getParent(cFrame) {
  var aFrame = cFrame;
  for (var i = 0; i < 4; i++) {
    if(aFrame.SiteMode != null) {
      return aFrame;
    } else {
      aFrame = aFrame.parent;
    }
  }
  return null;
}

function getOddsClass(Odds) {
  return (Odds < 0) ? CLS_EVEN: CLS_ODD;
}

var bShowLoading = true;
var iRefreshCount = REFRESH_COUNTDOWN;
var RefresHandle;
var SoccerMore_ThreadId = null;
var Soccer_More_End = false;
var BasketballMore_ThreadId = null;
var Basketball_More_End = false;

function refreshData() {
    if (typeof (refreshMoreData)!="undefined"){
        refreshMoreData(1);
        refreshMoreData(2);
        refreshMoreData(5);
    }
	
  if (fFrame.IsLogin) {
      if (fFrame.leftFrame == null || fFrame.leftFrame.eObj == null) {
		    window.setTimeout("refreshData()", 500);
		    return;
      }
  }
  if (!REFRESH_GAP) { return; }

  btnstop();

  window.clearTimeout(RefresHandle);
  RefresHandle = window.setTimeout(refreshData, REFRESH_INTERVAL);

  if ( (g_OddsKeeper == null) || (iRefreshCount <= 0) ) {
    document.DataForm.RT.value = "W";
    iRefreshCount = REFRESH_COUNTDOWN;
  } else {
    iRefreshCount--;
  }

  if (bShowLoading){
    document.getElementById("BetList").style.display = "block";
    bShowLoading = false;
  }

  document.DataForm.submit();

  if (PopLauncher!=null) {
    if (sKeeper!=null && PopLauncher.isOpened) {
        if (ThreadId!=null && ThreadId!="") {
            recallAjax(ThreadId);
        }
    } else {
        ThreadId=null;
    }
  } else {
    ThreadId=null;
  }
}

function btnstop() {
  REFRESH_GAP = false;
  var aSel = document.getElementById("selOddsType"); 
  if (aSel !== null) {
    setSelecterDisable("selOddsType",true); 
  }

  var oBtn;
  var aDiv = document.getElementById("divSelectDate");
  if ((aDiv != null) && (aDiv.style.display != "none")) {
    for (var i = 0; i < aDiv.childNodes.length; i++) {
      oBtn = aDiv.childNodes[i];
      if ((oBtn.tagName != null) && (oBtn.tagName.toUpperCase() == "SPAN")) {
        oBtn.disabled = true;
      }
    }
  }
  
  var aSorter = document.getElementById("aSorter");
  if(aSorter !== null){
    setSelecterDisable('aSorter', true);
  }

  var arrBottons = document.getElementsByName("btnRefresh");
  for (var i = 0; i < arrBottons.length; i++) {
    arrBottons[i].disabled = true;
    arrBottons[i].innerHTML = "";
    if(fFrame.SiteId=="4280" || fFrame.SiteId=="4200800"){
        arrBottons[i].innerHTML = "<span><span>" + RES_PLEASE_WAIT + "</span></sapn>";
    }else{
        arrBottons[i].innerHTML = "<span>" + RES_PLEASE_WAIT + "</sapn>";
    }
    arrBottons[i].style.font.color = "gray";
    if (fFrame.IsNewDropdownList) {
        arrBottons[i].className = "buttons disabled";
    }
  }
  arrBottons = document.getElementsByName("btnRefresh_D");
  for (var i = 0; i < arrBottons.length; i++) {
    arrBottons[i].disabled = true;
    arrBottons[i].innerHTML = "";
    if(fFrame.SiteId=="4280" || fFrame.SiteId=="4200800"){
        arrBottons[i].innerHTML = "<span><span>" + RES_PLEASE_WAIT + "</span></sapn>";
    }else{
        arrBottons[i].innerHTML = "<span>" + RES_PLEASE_WAIT + "</sapn>";
    }
    arrBottons[i].style.font.color = "gray";
    if (fFrame.IsNewDropdownList) {
        arrBottons[i].className = "buttons disabled";
    }
  }
  arrBottons = document.getElementsByName("btnRefresh_L");
  for (var i = 0; i < arrBottons.length; i++) {
    arrBottons[i].disabled = true;
    arrBottons[i].innerHTML = "";
    if(fFrame.SiteId=="4280" || fFrame.SiteId=="4200800"){
        arrBottons[i].innerHTML = "<span><span>" + RES_PLEASE_WAIT + "</span></span>";
    }else{
        arrBottons[i].innerHTML = "<span>" + RES_PLEASE_WAIT + "</sapn>";
    }
    arrBottons[i].style.font.color = "gray";
    if (fFrame.IsNewDropdownList) {
        arrBottons[i].className = "buttons disabled";
    }
  }  
  var timer = setTimeout("btnstart()",15000);
}

function btnstart() {
    if (REFRESH_GAP) {
        return;
    }
    var oBtn;
    var aDiv = document.getElementById("divSelectDate");
    if ((aDiv != null) && (aDiv.style.display != "none")) {
      for (var i = 0; i < aDiv.childNodes.length; i++) {
        oBtn = aDiv.childNodes[i];
        if ((oBtn.tagName != null) && (oBtn.tagName.toUpperCase() == "SPAN")) {
          oBtn.disabled = false;
        }
      }
    }
    
	var refbtn_L = document.getElementById("btnRefresh_L");
    var refbtn_D = document.getElementById("btnRefresh_D");
    var IsEnableSelOddsType = false;
	
    if (IsRefresh_L && IsRefresh_D) {
        IsEnableSelOddsType = true;
    } else if (!IsRefresh_L && IsRefresh_D) {
        if (refbtn_L != null) {
            if (refbtn_L.style.display == 'none') {
                IsEnableSelOddsType = true;
            }
        }
    } else if (IsRefresh_L && (!IsRefresh_D)) {
        if (IsRefresh_D != null) {
            if (refbtn_D.style.display == 'none') {
                IsEnableSelOddsType = true;
            }
        }
    }

	if(typeof(PAGE_MARKET) != 'undefined'){
        if (IsEnableSelOddsType || PAGE_MARKET == 'l') {
            var aSel = document.getElementById("selOddsType");
            if (aSel !== null) {
                setSelecterDisable("selOddsType", false);
            }
        }
	}else{
	    var aSel = document.getElementById("selOddsType");
        if (aSel !== null) {
            setSelecterDisable("selOddsType", false);
        }
	}

    if (fFrame.IsNewDropdownList) {
        oBtn = document.getElementById("btnRefresh_L");
        if (oBtn != null) {
            oBtn.className = "buttons";
        }  
        oBtn = document.getElementById("btnRefresh_D");
        if (oBtn != null) {
            oBtn.className = "buttons";
        }  
    }
    var arrBottons = document.getElementsByName("btnRefresh");
    for (var i = 0; i < arrBottons.length; i++) {
        arrBottons[i].innerHTML = "";
        if(fFrame.SiteId=="4280" || fFrame.SiteId=="4200800"){
            arrBottons[i].innerHTML = "<span><span>" + RES_REFRESH + "</span></span>";
        }else{
            arrBottons[i].innerHTML = "<span>" + RES_REFRESH + "</span>";
        }
        arrBottons[i].disabled = false;
        arrBottons[i].style.font.color = "black";
        if (fFrame.IsNewDropdownList) {
            arrBottons[i].className = "buttons";
        }
    }
    arrBottons = document.getElementsByName("btnRefresh_L");
    for (var i = 0; i < arrBottons.length; i++) {
        arrBottons[i].innerHTML = "";
        if(fFrame.SiteId=="4280" || fFrame.SiteId=="4200800"){
            arrBottons[i].innerHTML = "<span><span>" + RES_REFRESH + "</span></span>";
        }else{
            arrBottons[i].innerHTML = "<span>" + RES_REFRESH + "</span>";
        }
        arrBottons[i].disabled = false;
        arrBottons[i].style.font.color = "black";
        if (fFrame.IsNewDropdownList) {
            arrBottons[i].className = "buttons";
        }
    }
    arrBottons = document.getElementsByName("btnRefresh_D");
    for (var i = 0; i < arrBottons.length; i++) {
        arrBottons[i].innerHTML = "";
        if(fFrame.SiteId=="4280" || fFrame.SiteId=="4200800"){
            arrBottons[i].innerHTML = "<span><span>" + RES_REFRESH + "</span></span>";
        }else{
            arrBottons[i].innerHTML = "<span>" + RES_REFRESH + "</span>";
        }
        arrBottons[i].disabled = false;
        arrBottons[i].style.font.color = "black";
        if (fFrame.IsNewDropdownList) {
        arrBottons[i].className = "buttons";
        }
    }
    REFRESH_GAP = true;

    var aSorter = document.getElementById("aSorter");
    if(aSorter !== null){
        setSelecterDisable('aSorter', false);
    }
}

/*
 * to control color of odds display row for mouseover and mouseout event
 */
function changeBGColor2(ObjName, Color) {
  var tr1 = document.getElementById(ObjName + "_1");
  var tr2 = document.getElementById(ObjName + "_2");
  tr1.style.backgroundColor = Color;
  if (tr2 != null) {
      tr2.style.backgroundColor = Color;
  }
}

function changeBGClass2(ObjName, clsname) {
	var tr1 = document.getElementById(ObjName + "_1");
	var tr2 = document.getElementById(ObjName + "_2");
	tr1.className = clsname;
	if (tr2 != null) {
	    tr2.className = clsname;
	}
}

function changeBGColor3(ObjName, Color) {
  var tr1 = document.getElementById(ObjName + "_1");
  var tr2 = document.getElementById(ObjName + "_2");
  var tr3 = document.getElementById(ObjName + "_3");
  if (tr1 != null) {
      tr1.style.backgroundColor = Color;
  }
  if (tr2 != null) {
      tr2.style.backgroundColor = Color;
  }
  if (tr3 != null) {
      tr3.style.backgroundColor = Color;
  }
}

function changeBGColorX(ObjName, Color, x) {
    for (var i = 1; i <= x; i++) {
        var tr1 = document.getElementById(ObjName + "_" + i);
        if (tr1 != null) {
            //tr1.style.backgroundColor = Color;
            tr1.className = Color;
        }
    }
}

/*
 * detect had the js template for odds display been loaded.
 * if loaded return true, else return false and load it
 */
function initialTmpl(frameId, url, TimeoutFunc) {
    if (fFrame.hash_TmplLoaded[frameId] == null ||
    (fFrame.LastSelectedSport >= 180 && fFrame.LastSelectedSport <= 186 && bfLastSelectedSport != fFrame.LastSelectedSport)) {
        bfLastSelectedSport = fFrame.LastSelectedSport;
        fFrame.document.getElementById(frameId).contentWindow.location.href = '/Livescore/UnderOver_tmpl';
        fFrame.hash_TmplLoaded[frameId] = true;
        window.setTimeout(TimeoutFunc, 500);
        return false;
    }

    if (fFrame.document.getElementById(frameId).contentWindow.document.getElementById("tmplEnd") == null) {
    window.setTimeout(TimeoutFunc, 500);
        return false;
    }
    return true;
}


var LOAD_TMPL_GAP = true;
/*
 * initial all odds display's js template
 * template is embed in main.html, fFrame.
 */
function loadAllTmpl() {
  var ARR_TMPL_DEF = new Array();
  ARR_TMPL_DEF["UnderOver_tmpl_1"] = "http://mkt.lucky88.com/UnderOver_tmpl.aspx?form=1";
  ARR_TMPL_DEF["UnderOver_tmpl_3"] = "http://mkt.lucky88.com/UnderOver_tmpl.aspx?form=3";
  ARR_TMPL_DEF["UnderOver_tmpl_1F"] = "http://mkt.lucky88.com/UnderOver_tmpl.aspx?form=1F";
  ARR_TMPL_DEF["UnderOver_tmpl_1H"] = "http://mkt.lucky88.com/UnderOver_tmpl.aspx?form=1H";

  ARR_TMPL_DEF["NBA_tmpl"] = "http://mkt.lucky88.com/NBA_tmpl.aspx";
  ARR_TMPL_DEF["Baseball_tmpl"] = "http://mkt.lucky88.com/Baseball_tmpl.aspx";
  ARR_TMPL_DEF["Tennis_tmpl"] = "http://mkt.lucky88.com/Tennis_tmpl.aspx";
  ARR_TMPL_DEF["Cricket_tmpl"] = "http://mkt.lucky88.com/Cricket_tmpl.aspx";

  ARR_TMPL_DEF["1X2_tmpl"] = "http://mkt.lucky88.com/1X2_tmpl.aspx";
  ARR_TMPL_DEF["CorrectScore_tmpl"] = "http://mkt.lucky88.com/CorrectScore_tmpl.aspx";
  ARR_TMPL_DEF["OeTg_tmpl"] = "http://mkt.lucky88.com/OeTg_tmpl.aspx";
  ARR_TMPL_DEF["HTFT_tmpl"] = "http://mkt.lucky88.com/HTFT_tmpl.aspx";
  ARR_TMPL_DEF["OeTg_tmpl"] = "http://mkt.lucky88.com/OeTg_tmpl.aspx";
  ARR_TMPL_DEF["FGLG_tmpl"] = "http://mkt.lucky88.com/FGLG_tmpl.aspx";

  ARR_TMPL_DEF["MixParlay_tmpl"] = "http://mkt.lucky88.com/MixParlay_tmpl.aspx?sport=1";
  ARR_TMPL_DEF["MixParlay_tmpl_NBA"] = "http://mkt.lucky88.com/MixParlay_tmpl.aspx?sport=2";
  ARR_TMPL_DEF["MixParlay_tmpl_Tennis"] = "http://mkt.lucky88.com/MixParlay_tmpl.aspx?sport=5";
  ARR_TMPL_DEF["MixParlay_tmpl_Baseball"] = "http://mkt.lucky88.com/MixParlay_tmpl.aspx?sport=8";
  ARR_TMPL_DEF["MixParlay_tmpl_Cricket"] = "http://mkt.lucky88.com/MixParlay_tmpl.aspx?sport=27";

  ARR_TMPL_DEF["Horse_tmpl"] = "http://mkt.lucky88.com/Horse_tmpl.aspx";
  ARR_TMPL_DEF["Horse_Fixed_tmpl"] = "http://mkt.lucky88.com/Horse_Fixed_tmpl.aspx";
  ARR_TMPL_DEF["Finance_tmpl"] = "http://mkt.lucky88.com/Finance_tmpl.aspx";
  ARR_TMPL_DEF["Outright_tmpl"] = "http://mkt.lucky88.com/Outright_tmpl.aspx";
  ARR_TMPL_DEF["Bingo_tmpl"] = "http://mkt.lucky88.com/Bingo_tmpl.aspx";
  ARR_TMPL_DEF["Greyhounds_tmpl"] = "http://mkt.lucky88.com/Greyhounds_tmpl.aspx";

  ARR_TMPL_DEF["League_tmpl"] = "http://mkt.lucky88.com/Match_tmpl.aspx?Scope=League";
  ARR_TMPL_DEF["Match_tmpl"] = "http://mkt.lucky88.com/Match_tmpl.aspx?Scope=Match";

  if (LOAD_TMPL_GAP) {
    for (var sKey in ARR_TMPL_DEF) {
      if (fFrame.hash_TmplLoaded[sKey] == null) {
        var oFrame = fFrame.document.getElementById(sKey);
        if (oFrame != null) {
          fFrame.document.getElementById(sKey).contentWindow.location.href = ARR_TMPL_DEF[sKey];
          fFrame.hash_TmplLoaded[sKey] = true;
        }
      }
    }
    LOAD_TMPL_GAP = false;
  }
}

/*
 * for Earlay Market date selection bar
 * to control choice "data" color
 */
function selectDate(pSender, pDate) {
    var DataForm;
    if (pDate != "") {
        if (document.DataForm != null) {
            if (!REFRESH_GAP) return;
            DataForm = document.DataForm;
        }
        else {
            if (!REFRESH_GAP_D) return;
            DataForm = document.DataForm_D;
        }
        DataForm.DT.value = pDate;
        var sDate = pDate.split("/");
        if (sDate[0].length == 1) {
            sDate[0] = "0" + sDate[0];
        }
        if (sDate[1].length == 1) {
            sDate[1] = "0" + sDate[1];
        }
        pDate = sDate[2] + sDate[0] + sDate[1];
    }
    else {
        if (document.DataForm != null) {
            DataForm = document.DataForm;
        }
        else {
            DataForm = document.DataForm_D;
        }
        DataForm.DT.value = "";
    }
    if (SelKickoffTime != pDate) {
        SelKickoffTime = pDate;

        if (fFrame.IsCssControl == true) {
            $("#divSelectDate").find("span").attr('class', "");
            pSender.className = "Current";
            pSender.style.color = "";
            
        }else{
            $("#divSelectDate").find("span").attr('class', fFrame.DateColor);
            pSender.style.color = "#9F0915";
        }

        if (g_OddsKeeper_D != null && typeof(g_OddsKeeper_D) == "object") {
            g_OddsKeeper_D.paintOddsTable();
        }
        else if (g_OddsKeeper != null && typeof(g_OddsKeeper) == "object") {
            g_OddsKeeper.paintOddsTable();
        }
    }
    btnstop();
    btnstart();
}

function getShowMatchHtml(MatchId, Sporttype, Market) {
  return "<a href='javascript:showMatchOdds(\"" + MatchId + "\", \"" + Sporttype + "\", \"" + Market + "\");'><img border='0' src='" + fFrame.imgServerURL + "template/public/images/more_game.gif' /></a>";
}

function getStatsHtml(MatchId) {
  if (!fFrame.CanSeeStatsInfo) {
     return "";
  }

  if (fFrame.unClickStatsInfo) {
      return "<div class='icon'><span class='statisticInformation off' title='" + fFrame.RES_StatisticInfo + "'/></div>";
  }
  else if (fFrame.IsNewDropdownList) {
      return "<div class='icon'><span class='statisticInformation' onclick='javascript:openStatsInfo(\"" + MatchId + "\");' title='" + fFrame.RES_StatisticInfo + "'></span></div>";
  } else {
    if(fFrame.IsLogin) {
        return "<div class='icon'><span class='statisticInformation' onclick='javascript:openStatsInfo(\"" + MatchId + "\");' title='" + fFrame.RES_StatisticInfo + "'></span></div>";
    } else {
        return "<div class='icon'><span class='statisticInformation' title='" + fFrame.RES_StatisticInfo + "'/></div>"
    }
  }
}

function getSportRadarHtml(MatchId, type) {
  if (MatchId == 0 || !fFrame.CanSeeSportRadar && ! fFrame.CanSeeLiveInfo) {
    return "";
  }
  
  var obj = document.getElementById("LiveInfoMenu");
 
    if (fFrame.CanSeeLiveInfo){
		if (fFrame.IsNewDropdownList) {
			if (type == "correctscore") {
				return getOpenLiveInfoHtml(true, MatchId, true);
			} else if (typeof RES_UNDER != "undefined" && RES_UNDER != null && obj != null){
				return getOpenLiveInfoMenuHtml(true, MatchId);
			} else { 
				return getOpenLiveInfoHtml(true, MatchId, false);
			}
		} else {
		if (type == "correctscore") {			
				return getOpenLiveInfoHtm(false, MatchId, true);
		} else if (typeof RES_UNDER != "undefined" && RES_UNDER != null && obj != null){
				return getOpenLiveInfoMenuHtml(false, MatchId);
		} else {		
				return getOpenLiveInfoHtml(false, MatchId, false);			
		}
	  }
    } else if (fFrame.unClickSportRadar) {
		if (type=="correctscore") {
			return "<img border='0' hspace='1' src='" + fFrame.imgServerURL + fFrame.SkinRootPath + "public/images/layout/Whistle_Dsb.gif' title='" + fFrame.RES_LiveInfo + "'/>";
		} else {
			return "<div class=\"icon\"><img border='0' hspace='1' src='" + fFrame.imgServerURL + fFrame.SkinRootPath + "public/images/layout/Whistle_Dsb.gif' title='" + fFrame.RES_LiveInfo + "'/></div>";
			}
    } else { 	
		if (fFrame.IsNewDropdownList) {
			if (type == "correctscore") {
				return getOpenLiveInfoHtml(true, MatchId, true);
			} else {
				return getOpenLiveInfoHtml(true, MatchId, false);				
			}
	  } else {
			if (type == "correctscore") {
				return getOpenLiveInfoHtml(false, MatchId, true);			
			} else {						
				return getOpenLiveInfoHtml(false, MatchId, false);	
			}
	  }
  }
}

function getOpenLiveInfoMenuHtml(isNewDropdownList,MatchId){

	if(isNewDropdownList) {
		return "<div class=\"icon\" onmouseover='OpenLiveInfoMenu(" + MatchId + ",this)' onmouseout='CloseLiveInfoMenu(" + MatchId + ",this)'><div class='icon displayOn'><span class='liveInformation'></span></div><div id=\"lf" + MatchId + "\" style=\"display:none\"></div></div></span>";
	} else {
		return "<div class=\"icon\" onmouseover='OpenLiveInfoMenu(" + MatchId + ",this)' onmouseout='CloseLiveInfoMenu(" + MatchId + ",this)'><div class='icon displayOn'><span class='liveInformation'></span></div><div id=\"lf" + MatchId + "\" style=\"display:none\"></div></div></span>";
	}	
}

function getOpenLiveInfoHtml(isNewDropdownList,MatchId,isCorrectScore){
	var image;
	if(isNewDropdownList) {
		image = "'" + fFrame.imgServerURL + fFrame.SkinRootPath + "public/images/layout/Whistle.gif'";
	} else {
		image = "'" + fFrame.imgServerURL + "template/public/images/Whistle2011.gif'"
	}
	
	if(isCorrectScore){
		return "<div class='icon displayOn'><span class='liveInformation' onclick='javascript:openLiveInfo(\"" + MatchId + "\");' title='" + fFrame.RES_LiveInfo + "'></span></div>";
	} else {
		return "<div style='display: inline;'><div class='icon displayOn'><span class='liveInformation' onclick='javascript:openLiveInfo(\"" + MatchId + "\");' title='" + fFrame.RES_LiveInfo + "'></span></span></div>";
	}
}

function openStatsInfo(MatchId) {
    window.open("StatsFrame.aspx?MatchId=" + MatchId);
}

function openBetRadarVSStatsInfo(sporttype, team1id, team2id, sessionid) {
    //window.open("StatsFrame.aspx?MatchId=" + MatchId, 'StatsInfo' + MatchId);
    if (sporttype == 191) {
        vf_iframe.openVfecStats(team1id, team2id, sessionid);
    }
    else {
        vf_iframe.openVfStats(team1id, team2id, sessionid);
    }
}

// function openLiveInfo(MatchId) {
    // window.open("LiveInfo.aspx?MatchId=" + MatchId);
// }

function OpenLiveInfoMenu(pMatchid, sender) {
    var obj = $(sender).find("#lf" + pMatchid);
    if (obj.length == 0) {
        obj = $(document.getElementById("lf" + pMatchid));
    }

    if (obj.html() == "") {
        obj.html(getLiveInfoMenuHtml(pMatchid));
    }
    obj.css('display', '');
}

function CloseLiveInfoMenu(pMatchid, sender) {
    var obj = $(sender).find("#lf" + pMatchid);
    if (obj.length == 0) {
        obj = $(document.getElementById("lf" + pMatchid));
    }
    if (obj.length > 0) {
        obj.css('display', 'none');
    }
}

function getLiveInfoMenuHtml(pMatchid) {
    var obj = document.getElementById("LiveInfoMenu");
    if (obj != null) {
        var mHtml = obj.innerHTML;
        mHtml = mHtml.replace(/#F/, "javascript:openLiveInfo(" + pMatchid + ");");
        mHtml = mHtml.replace(/#L/, "javascript:openLiveInfoMiddle(" + pMatchid + ",'1');");
        //mHtml = mHtml.replace(/#S/, "javascript:openLiveInfoSmall(" + pMatchid + ");");
        return mHtml;
    } else {
        return "";
    }
}
var LiveInfoWindowHandle=null;
function openLiveInfo(MatchId) {
	fFrame.IsShowLiveInfoSideView = false;
	closeMore();
    switchLiveInfoDisplay();
    FinalpaintOddsTable();
    LiveInfoWindowHandle = window.open("LiveInfo.aspx?MatchId=" + MatchId, 'LiveInfo' + MatchId);
}

function getRedCardHtml(CardCount) {
  var s = "";
  for (var i = 0; i < CardCount; i++) {
    s += "<img class='code' border='0' src='" + fFrame.imgServerURL + "/public/template/RedCard.gif' />";
  }
  return s;
}

function LiveInfoBackButton() {
	closeMore();
    switchLiveInfoDisplay();
	//CloseSmallLiveInfo();
    FinalpaintOddsTable();

    if ($('#AllSingleOdds').length != 0) {
        $('#oTableContainer_O').show();
        $('#SportsContainer').show();
        arr_ShowMixParlay["O"] = true;
    }
}
var haveParlay = false;
var haveSelectDate = false;

function openLiveInfoMiddle(MatchId, haveLiveInfo) {
    if ($('#btnSwitchBack').css('display') != "none"
	|| $('#selections').length != 0) {
        return;
    }
    //closeLiveInfoWindow();
    fFrame.IsShowLiveInfoSideView = false;
    arr_Match = new Array();
    arr_Match.push(MatchId);
    //CloseSmallLiveInfo();
    if (haveLiveInfo == '1') {
        getLiveInfoURL(MatchId, "M");
        CurrentLiveInfoMatchID = MatchId;
    }
    FinalpaintOddsTable();
    if ($('#b_SwitchToParlay').css('display') != "none") {
        $('#b_SwitchToParlay').hide();
        haveParlay = true;
    }
    else {
        haveParlay = false;
    }
	
	if ($('#divSelectDate').css('display') != "none") {
        $('#divSelectDate').hide();
		haveSelectDate = true;
    }
	else
	{
		haveSelectDate = false;
	}
	
    $('#selLeagueType_Div').hide();
    $('#aSorter_Div').hide();
    $('#b_SwitchToParlay').hide();
    $('#b_selectLeague').hide();
	$('#Tbl_TimeRange').hide();
    $('#btnSwitchBack').show();
    if ($('#AllSingleOdds').length != 0) {
        $('#oTableContainer_O').hide();
        arr_ShowMixParlay["O"] = false;
    }
	
    //OpenMore
    //Double Line  
    if ($('.en_Point ').not('.off').not('.displayOff').html() != null) {
        $('.en_Point ').not('.off').not('.displayOff').click();
    } else if ($('.ch_Point ').not('.off').not('.displayOff').html() != null) {
        $('.ch_Point ').not('.off').not('.displayOff').click();
    }
    //Single Line 
    if ($('.more') != null && $('.more').length > 0) {
        if ($('.more').not('.off').parent('span').html() != null) {
            $('.more').not('.off').parent('span').click();
        }
    }
    $(window).scrollTop(0);
}

function switchLiveInfoDisplay() {
    $('#MiddleLiveInfo').slideUp('slow');
    arr_Match = new Array("0");
    CurrentLiveInfoMatchID = "0";
    $('#selLeagueType_Div').show();
    $('#aSorter_Div').show();
    $('#b_selectLeague').show();
    if (haveParlay) {
        $('#b_SwitchToParlay').show();
    }
    if (haveSelectDate) {
        $('#divSelectDate').show();
    }
    $('#btnSwitchBack').hide();
}

function closeMore() {
    if ($('#btnSwitchBack').css('display') != "none") {
        //Double Line
        if ($('.en_Point.off').length > 0) {
            $('.en_Point.off').click();
        } else if ($('.ch_Point.off').length > 0) {
            $('.ch_Point.off').click();
        }

        //Single Line
        if ($('.more.off') != null && $('.more.off').length > 0) {
            if ($('.more.off').parent('a').html() != null) {
                $('.more.off').parent('a').click();
            }
        }
    }
}

function getSportRadarSupportLang(lang) {
    switch (lang) {
        case "ch":
            return "zht";
        case "zhcn":
        case "cs":
            return "zh";
        case "jp":
            return "ja";
        case "vn":
            return "vi";      
        default:
            return lang;
    }
}

//Sport Radar
function getLiveInfoURL(MatchId, URLType, callbackfun) {
  if(fFrame.CanSeeLiveInfo) {         	
    var sUrl;
    var language = parent.UserLang;
    var radarSupportLang = getSportRadarSupportLang(language);
    var TargetType = "full";
    var liveInfoUrl = fFrame.LiveInfoUrlSmallView;
    if (liveInfoUrl != "") {
      if (liveInfoUrl.indexOf("{lang") > -1) {
        sUrl = liveInfoUrl.replace(/{lang}/, radarSupportLang);
      } else {
        sUrl = liveInfoUrl;
      }

      if(liveInfoUrl.indexOf("{mid}") > -1) {
        sUrl = sUrl.replace(/{mid}/, MatchId);
      }
    } else {
      if (fFrame.IsNewCashSite) {
        sUrl = "http://mTracker.758824.com/";
      } else {
        sUrl = "http://mTracker.548872.com/";
      }
      if (language == "zhcn") {
        language = "cs";
      }
      sUrl = sUrl + "BetRadarLiveInfo.aspx?LiveInfoType=" + TargetType + "&LangType=" + language + "&MatchId=" + MatchId;        
    }
    
    switch (URLType) {
      case "M":
      	TargetType = "single";
      	break;
      default:
      	TargetType = "full";
      	break;
    }
  
    if ($('#MiddleLiveInfoFrame').attr("src") != sUrl) {
      $('#MiddleLiveInfoFrame').attr("src", sUrl);
      $('#MiddleLiveInfoFrame').ready(function () { $('#MiddleLiveInfo').slideDown('slow'); });
    } else {
      $('#MiddleLiveInfo').slideDown('slow');
    }
  }
}

function getFavoritesHtml(MUID, KeyValue, IsFavorites, IsLive) {
  var sClass = (IsFavorites) ? "favorite added" : "favorite";
  var sTitle =  (IsFavorites) ? fFrame.RES_RemoveFavorite : fFrame.RES_AddFavorite;

  if (fFrame.IsNewDropdownList == true) {
    return "<div id='fav_" + MUID + "'class='icon displayOn' ><span class='"+sClass+"' onclick='javascript:addMatchFavorites(\"" + MUID + "\",\"" + KeyValue + "\"," + IsFavorites+"," + IsLive +");' title='"+sTitle+"'></span></div>";
  } else {
    return "<div id='fav_" + MUID + "'class='icon displayOn' ><span class='"+sClass+"' onclick='javascript:addMatchFavorites(\"" + MUID + "\",\"" + KeyValue + "\"," + IsFavorites+"," + IsLive +");' title='"+sTitle+"'></span></div>";
  }
}

function getFavLeaguesHtml(SportType, KeyValue, IsFavorites, IsLive) {
    var ClsName = (IsFavorites) ? "favorite added" : "favorite";
    var strLink = "<div class='icon displayOn' onmouseover = 'javascript:$(this).css(\"cursor\",\"pointer\");' onmouseout = 'javascript:$(this).css(\"cursor\",\"default\");' onclick='javascript:addLeagueFavorites(event,\"" + SportType + "\",\"" + KeyValue + "\"," + IsFavorites + "," + IsLive + ",null);' title='" + (IsFavorites ? fFrame.RES_RemoveFavorite : fFrame.RES_AddFavorite) + "'><span id='fav_" + KeyValue + "' class='" + ClsName + "'></span></div>";
    return strLink;
}

function getScoreMapHtml(MatchID) {
  var SiteID=fFrame.SiteId;
  if (fFrame.SiteMode == 1) { return ""; }


  if (fFrame.IsNewDropdownList) {
      return "<div class='icon'><span class='scoreMap' onclick='popScoreMap(\"" + MatchID + "\");' title='" + fFrame.RES_ScoreMap + "'></span></div>";
  }else {
      return "<div class='icon'><span class='scoreMap' onclick='popScoreMap(\"" + MatchID + "\");' title='" + fFrame.RES_ScoreMap + "'></span></div>";
  }
}

function getScoreHtml(MUID, KeyValue) {
  if (fFrame.SiteMode == 1) {
    return "";
  }
  return "<div id='sco_" + MUID + "' style='display:inline'><a href='javascript:showScores(\"" + MUID + "\",\"" + KeyValue + "\");'>Score</a></div>";
}

function bet(isParlay, MatchId, OddsId, Team, Odds, BetType) {
    if (OddsId != '' && Odds != '') {
        if (!parseInt(isParlay, 10)) {
            fFrame.leftFrame.DoBetProcess(OddsId, Team, Odds, null, null, BetType);
        } else {
            if (typeof (betParlay) == "undefined") {
                parent.leftFrame.AddParlay(MatchId, OddsId, Team, Odds, fFrame.LastSelectedSport, BetType);
            } else {
                betParlay(MatchId, OddsId, Team, Odds);
            }            
        }
    }
}

/*
 * session of select league popup dialog controling
 */
var LeaguePage;
var more_mode;
var PopLauncher; // Select League popup controller
var MoreLauncher; // Select League popup controller for bingo
var sSportL = "";

function openLeague(Width, Title, Market, Sport, BetType, Mix, Page) {

  more_mode = "SL";
  LeaguePage = Page;
  nowsKeeper = null;
  document.getElementById("oPopContainer").innerHTML = "";
  var isParlay = false;
  var isOutright = false;
  
  if (!initialTmpl("League_tmpl", "League_tmpl.aspx", "openLeague(" + Width + ",'" + Title + "','" + Market + "','" + Sport + "','" + BetType + "','" + Mix + "','" + Page + "');")) {
        return;
  }

    if (Page == "SportsMixParlay") isParlay = true;
    if (Page == "Outright") isOutright = true;
    GetLeagueHTML(isParlay, isOutright);

    var oDiv = document.getElementById("PopDiv");
    //oDiv.style.height = 0;
    oDiv.style.width = Width + 'px';

    var oTitle = document.getElementById("PopTitleText");
    var oPage = document.getElementById("oPopContainer");
    //oTitle.style.width = Width+'px';
    oTitle.innerHTML = Title;
    oPage.innerHTML = sHTML.join("");

    if (PopLauncher == null) {
        var oDragger = document.getElementById("PopTitle");
        var oCloser = document.getElementById("PopCloser");
        PopLauncher = new DivLauncher(oDiv, oDragger, oCloser);
    }
    PopLauncher.open(50, 50, true);

//    var oSave = document.getElementById("chkSave");
//    if (IsSaveLeague) oSave.checked = true;

    if (isParlay) {
        var arrSport = sSportL.split(",");
        for (var i = 0; i < arrSport.length; i++) {
            var iSport = arrSport[i];
            checkLeagueBySport(iSport);
        }
    }
    else
        checkLeague();
}

function GetLeagueHTML(isParlay, isOutright) {
    var tmpLeague = fFrame.document.getElementById("League_tmpl").contentWindow;

    sHTML = new Array();
    sHTML.push("<div class='league-box popLegname'>");
    sHTML.push("<div class='pop_line'></div>");
    sHTML.push("<div class='selectArea'>");
    sHTML.push(tmpLeague.document.getElementById("League_Header").innerHTML);

    if (isOutright) {
        sHTML.push("<div class='league-box popLegname'>");
        genLeagueHeadTmpl(isOutright);

        if (typeof (LeagueListBySport["S0"]) == "undefined" || LeagueListBySport["S0"].length == 0){
            return;
        }

        for (var i = 0; i < LeagueListBySport["S0"].length; i++) {
            sHTML.push("<tr valign='top' align='left' style='line-height:16px;'>");

            for (var j = 0; j < 2; j++) {
                i += j;
                if (i < LeagueListBySport["S0"].length){
                    genLeagueTmpl(LeagueListBySport["S0"][i].SportId, LeagueListBySport["S0"][i].LeagueId, LeagueListBySport["S0"][i].LeagueName, isParlay, LeagueListBySport["S0"][i].Checked);
                } else {
                    genLeagueTmpl("", "", "", isParlay, false);
		}
            }
            sHTML.push("</tr>");
        }
        genLeagueFooterTmpl(isOutright);

        sHTML.push("</div>")
    }
    else {
        for (var s = 1; s < 162; s++) {
            if (typeof (LeagueListBySport["S" + s]) == "undefined" || LeagueListBySport["S" + s].length == 0) continue;
            if (sSportL == "")
                sSportL = s.toString();
            else
                sSportL = sSportL + "," + s.toString();

            genSportTmpl(LeagueListBySport["S" + s][0].SportId, LeagueListBySport["S" + s][0].SportName, isParlay);
            genLeagueHeadTmpl(isOutright);

            if (s == 1) {
                if (SelMainMarket == 1 && !isParlay) {
                    var MainMarketList = {};
                    MainMarketList = cloneMainLeague(LeagueListBySport["S" + s]);

                    for (var i = 0; i < MainMarketList.length; i++) {
                        sHTML.push("<tr valign='top' align='left' style='line-height:16px;'>");

                        for (var j = 0; j < 2; j++) {
                            i += j;
                            if (i < MainMarketList.length){
                                genLeagueTmpl(MainMarketList[i].SportId, MainMarketList[i].LeagueId, MainMarketList[i].LeagueName, isParlay, MainMarketList[i].Checked);
                            } else {
                                genLeagueTmpl("", "", "", isParlay, false);
			    }
                        }
                        sHTML.push("</tr>");
                    }
                }
                else {
                    for (var i = 0; i < LeagueListBySport["S" + s].length; i++) {
                        sHTML.push("<tr valign='top' align='left' style='line-height:16px;'>");

                        for (var j = 0; j < 2; j++) {
                            i += j;
                            if (i < LeagueListBySport["S" + s].length){
                                genLeagueTmpl(LeagueListBySport["S" + s][i].SportId, LeagueListBySport["S" + s][i].LeagueId, LeagueListBySport["S" + s][i].LeagueName, isParlay, LeagueListBySport["S" + s][i].Checked);
                            } else {
                                genLeagueTmpl("", "", "", isParlay, false);
			    }
                        }
                        sHTML.push("</tr>");
                    }
                }
            }
            else {
                for (var i = 0; i < LeagueListBySport["S" + s].length; i++) {
                    sHTML.push("<tr valign='top' align='left' style='line-height:16px;'>");

                    for (var j = 0; j < 2; j++) {
                        i += j;
                        if (i < LeagueListBySport["S" + s].length){
                            genLeagueTmpl(LeagueListBySport["S" + s][i].SportId, LeagueListBySport["S" + s][i].LeagueId, LeagueListBySport["S" + s][i].LeagueName, isParlay, LeagueListBySport["S" + s][i].Checked);
                        } else {
                            genLeagueTmpl("", "", "", isParlay, false);
			}
                    }
                    sHTML.push("</tr>");
                }
            }
            genLeagueFooterTmpl(isOutright);
        }
    }

    sHTML.push(tmpLeague.document.getElementById("League_Footer").innerHTML);
    sHTML.push("</div>");
    sHTML.push("</div>");
}

function genSportTmpl(SportId, SportName, IsParlay) {
    var sDisplay = "none";

    if (IsParlay) {
        sDisplay = "inline-block";
    }

    sHTML.push("<div id='SportArea_" + SportId + "' class='popodds selectType'>");
    sHTML.push("<div class='header'>");
    sHTML.push("<span class='icon_arrow' onclick='SportControl(" + SportId + ");' style='display:inline-block;'></span>");
    sHTML.push("<input id='chkSport_" + SportId + "' type='checkbox' style='display:" + sDisplay + ";' onclick='checkAllBySport(" + SportId + ");' name='chkSport_" + SportId + "'>");
    sHTML.push("<span class='title' onclick='SportControl(" + SportId + ");'>" + SportName + "</span>");
    sHTML.push("</div>");

}

function genLeagueTmpl(SportId, LeagueId, LeagueName, IsParlay, IsCheck) {
    var sCheck = "";
    var sDisplay = "block";
    var checkLeague = "checkLeague()";

    if (IsParlay) {
        checkLeague = "checkLeagueBySport(" + SportId + ")";
        SportId = LeagueId + "_" + SportId;
    }
    else
        SportId = LeagueId;

    if (IsCheck) {
        sCheck = "checked";
    }
    if (LeagueId == "") {
        sDisplay = "none";
    }

    sHTML.push("<div class='col'>");
    sHTML.push("<input id='" + SportId + "' type='checkbox' style='display:" + sDisplay + ";' value='" + LeagueId + "' onclick='" + checkLeague + ";' name='LF' " + sCheck + ">" + LeagueName + "<br>");
    sHTML.push("</div>");    

    //sHTML.push("<td width='23' style='vertical-align: top;'>")
    //sHTML.push("<input id='" + SportId + "' type='checkbox' style='margin:2px;padding:0; display:" + sDisplay + ";' value='" + LeagueId + "' onclick='" + checkLeague + ";' name='LF' " + sCheck + ">")
    //sHTML.push("</td>")
    //sHTML.push("<td width='270' style='vertical-align: top;'>")
    //sHTML.push(LeagueName + "<br></td>")
    //sHTML.push("<td width='1'> </td>")
}

function genLeagueHeadTmpl(IsOutright) {
    if (!IsOutright) {
        sHTML.push("<div class='eventArea'>");
        sHTML.push("<div class='line'></div>");
    }
    sHTML.push("<div class='selectLeagues'>");

    //sHTML.push("<table class='popWSelectTab' width='100%' border='0' cellspacing='0' cellpadding='0'>")
    //sHTML.push("<tbody>")
}

function genLeagueFooterTmpl(IsOutright) {
    sHTML.push("</div>");

    //sHTML.push("</tbody>")
    //sHTML.push("</table>")
    if (!IsOutright) {
        sHTML.push("</div>");
        sHTML.push("</div>");
    }
}

function checkLeagueBySport(Sport) {
    var chkSport = "chkSport_" + Sport;
    var elmChkSport = document.getElementById(chkSport);
    var elmChkAll = document.getElementById("chkLFAll");
    var fields = document.getElementsByName("LF");

    for (i = 0; i < fields.length; i++) {
        if (fields[i].value != '0') {
            var ChkId = fields[i].value + "_" + Sport;
            if (document.getElementById(ChkId) != null) {
                var elmChkLeague = document.getElementById(ChkId);
                if (!elmChkLeague.checked) {
                    elmChkSport.checked = false;
                    elmChkAll.checked = false;
                    return;
                }
            }
        }
    }

    if (elmChkSport != null) {
        elmChkSport.checked = true;
    }
    checkLeague();
}
function checkLeague() {
    var elmChkAll = document.getElementById("chkLFAll");
    var fields = document.getElementsByName("LF");

    for (i = 0; i < fields.length; i++) {
        if (fields[i].value != 0) {
            if (!fields[i].checked) {
                elmChkAll.checked = false;
                return;
            }
        }
    }
    elmChkAll.checked = true;
}

function checkAllBySport(Sport) {
    var fields = document.getElementsByName("LF");
    var chkSport = "chkSport_" + Sport;
    var elmChkSport = document.getElementById(chkSport);

    for (i = 0; i < fields.length; i++) {
        if (fields[i].value != 0) {
            var ChkId = fields[i].value + "_" + Sport;
            if (document.getElementById(ChkId) != null) {
                fields[i].checked = elmChkSport.checked;
            }
        }
    }
    checkLeague();
}
function checkAll() {
  var fields = document.getElementsByName("LF");
  var elmChkAll = document.getElementById("chkLFAll");

  for (i = 0; i < fields.length; i++){
    fields[i].checked = elmChkAll.checked;
  }
  for (i = 1; i < 100; i++) {
      var chkSport = "chkSport_" + i;
      if (document.getElementById(chkSport) != null) {
          document.getElementById(chkSport).checked = elmChkAll.checked;
      }
  }

}



//Get Odds GB color for different site
//SiteMode : 0:Member 1: Phone 2 : Deposit
function GetEventBGColor(Seq) {
    var ReturnColor = '';

    if (fFrame.IsCssControl) {
        if(Seq == '0') {
            ReturnColor = 'bgcpe';
        } else {
            ReturnColor = 'bgcpelight';
        }
    } else {
        if(Seq == '0') {
            ReturnColor = fFrame.EventBGColor_Odd;
        } else {
            ReturnColor = fFrame.EventBGColor_Even;
        }
    }

    return ReturnColor;
}

function GetLiveBGColor(Seq) {
    var ReturnColor = '';

    if (fFrame.IsCssControl) {
        if(Seq == '0') {
            ReturnColor = 'live';
        } else {
            ReturnColor = 'liveligh';
        }
    } else {
        if(Seq == '0') {
            ReturnColor = fFrame.LiveBGColor_Odd;
        } else {
            ReturnColor = fFrame.LiveBGColor_Even;
        }
    }

    return ReturnColor;
}

function changeOddsType(selValue) {
    var oSel = document.getElementById("selOddsType");
    if (typeof (sSport) != "undefined" && sSport != null && (sSport == "190" || sSport == "191")) {
        if (oSel.value != selValue) {
            oSel.value = selValue;
        }

        switch (selValue) {
            case 4:
                setOddsType(sSport, "my");
                break;
            case 2:
                setOddsType(sSport, "hk");
                break;
            case 1:
                setOddsType(sSport, "dec");
                break;
            case 3:
                setOddsType(sSport, "indo");
                break;
            default:
                setOddsType(sSport, "us");
                break;
        }
        //window.location.href = 'BetRadarVirtualSport.aspx?Sport=' + sSport + '&IsParlay=' + RES_IsParlay + '&Market=t';
        LoadOddsData(false);

    }
    else {
        if (PopLauncher != null) {
            PopLauncher.close();
        }
        var oSel = document.getElementById("selOddsType");
        if (oSel.value != selValue) {
            oSel.value = selValue;
        }

        try {
            document.DataForm_D.RT.value;

            document.DataForm_L.OddsType.value = selValue;
            document.DataForm_D.OddsType.value = selValue;
            document.DataForm_L.RT.value = "W";
            document.DataForm_D.RT.value = "W";
            refreshAll();
        }
        catch (e) {
            document.DataForm.OddsType.value = selValue;
            document.DataForm.RT.value = "W";
            refreshData();
        }
    }
}

function changeLeagueType(selValue) {
    if (PopLauncher != null) {
        PopLauncher.close();
    }
    //$('#ScoreMapDiv').css('visibility', 'hidden');
    //$('#PopDiv').css('visibility', 'hidden');

    SelMainMarket = selValue;
    //getLeagueList();
    var param = new Object();
    param["market"] = fFrame.LastSelectedMArket.toLowerCase();
    param["gamemode"] = fFrame.LastSelectedMenu;
    param["sport"] = fFrame.LastSelectedSport;
    if (typeof (fFrame.LastSelectedBettype) == "undefined") {
        param["pagename"] = "T";
    }
    else {
        param["pagename"] = fFrame.LastSelectedBettype;
    }
    param["selmainmarket"] = SelMainMarket.toString();
    param["mode"] = "mainmarket";
    SelLeagueThreadId = "RecSelMainMarket";
    ExecAjax("RecSelData.aspx", param, "POST", SelLeagueThreadId, "RecSelMainMarket");
    if (typeof (arr_OddsKeeper) == "object") {
        for (var iSport in arr_OddsKeeper) {
            var oddsKeeper = arr_OddsKeeper[iSport];
            oddsKeeper.paintOddsTable();
        }
    }
    else {
        if (typeof (g_OddsKeeper_D) == "object" && g_OddsKeeper_D != null) {
            g_OddsKeeper_D.paintOddsTable();
        }
        if (typeof (g_OddsKeeper_L) == "object" && g_OddsKeeper_L != null) {
            g_OddsKeeper_L.paintOddsTable();
        }
        if (typeof (g_OddsKeeper) == "object" && g_OddsKeeper != null) {
            g_OddsKeeper.paintOddsTable();
        }
    }
    btnstop();
    btnstart();
}

function showLeagueOdds(LeagueId, Sporttype, Market) {
  window.location.href = "Match.aspx?Scope=League&Id=" + LeagueId + "&Sport=" + Sporttype + "&Market="  + Market;
}

function showMatchOdds(MatchId, Sporttype, Market) {
  window.location.href = "Match.aspx?Scope=Match&Id=" + MatchId + "&Sport=" + Sporttype + "&Market=" + Market;
}

var btnStartHandle_L;
var btnStartHandle_D;
function afterRepaintTable(OddsTable) {
  var aOtherContainer;
  if (OddsTable.parentNode.id == "oTableContainer_L") {
    document.DataForm_L.RT.value = "U";
    aOtherContainer = document.getElementById("oTableContainer_D");
    window.clearTimeout(btnStartHandle_L);
    btnStartHandle_L = setTimeout("startButton('l');", 3000);
  } else {
    document.DataForm_D.RT.value = "U";
    aOtherContainer = document.getElementById("oTableContainer_L");
    window.clearTimeout(btnStartHandle_D);
    btnStartHandle_D = setTimeout("startButton('d');", 3000);
  }
  document.getElementById("BetList").style.display = "none";
  document.getElementById("OddsTr").style.display = "";
  var nRows=0;
  if (OddsTable.tBodies.length>0) {
    nRows=OddsTable.tBodies.length-1;
  }
  if (OddsTable.tBodies[nRows].rows.length <= 1) {
    OddsTable.parentNode.style.display = "none";
    if (aOtherContainer != null && aOtherContainer.style.display == "none") { 
	  $('#TrNoInfo').css("display","block");
    } else { 
	  $('#TrNoInfo').css("display","none");
    }

    if (OddsTable.parentNode.id == "oTableContainer_L") {
      document.getElementById("btnRefresh_L").style.display = "none";
      if (fFrame.SiteMode == 2) { // Use for control a88's underover subtitle
        if (fFrame.Deposit_SiteMode == 2) {
		  $('#RunningGames').hide();
        }
      }
    } else {
      document.getElementById("btnRefresh_D").style.display = "none";
      if (fFrame.SiteMode == 2) {// Use for control a88's underover subtitle
        if (fFrame.Deposit_SiteMode == 2) { 
		  $('#sub_title').hide();
        }
      }
    }
  } else {
    OddsTable.parentNode.style.display = "";
    document.getElementById("TrNoInfo").style.display = "none";

    if (OddsTable.parentNode.id == "oTableContainer_L") {
      document.getElementById("btnRefresh_L").style.display = "";
      if (fFrame.SiteMode == 2) { // Use for control a88's underover subtitle
        if (fFrame.Deposit_SiteMode == 2) { 
		  $('#RunningGames').show();
        }
      }
    } else {
      if (fFrame.SiteMode == 2) {// Use for control a88's underover subtitle
        if (fFrame.Deposit_SiteMode == 2) {
		  $('#sub_title').show();
        }
      }
      document.getElementById("btnRefresh_D").style.display = "";
    }
  }
}

function refreshAll() {
  if ((PAGE_MARKET == "t") && (fFrame.SiteMode != 1)) {
    refreshData_L();
    //document.getElementById("btnRefresh_L").style.display = "";
  } else {
    document.getElementById("oTableContainer_L").style.display = "none";
    if (fFrame.SiteMode == 2 ) {// Combine A88 under over sub title
        if (fFrame.Deposit_SiteMode == 2) {
          document.getElementById("RunningGames").style.display = "none";
        }
    }
  }
  refreshData_D();
}


var REFRESH_GAP_L = true; // a flag to noted is odds display refreshing
var bShowLoading_L = true;
var iRefreshCount_L = REFRESH_COUNTDOWN;
var RefresHandle_L;
var Soccer_More = false;
var Basketball_More = false;

function refreshData_L() {

    if (typeof (refreshMoreData) != "undefined") {
        refreshMoreData_L(1);
        refreshMoreData_L(2);
        refreshMoreData_L(5);
    }

    if (fFrame.IsLogin) {
	  if (fFrame.leftFrame==null || fFrame.leftFrame.eObj==null) {
			  window.setTimeout("refreshData_L()", 500);
			  return;
	  }
	}
	if (!REFRESH_GAP_L)
    {
        window.setTimeout("refreshData_L()", 500);
        return;
    }

  window.clearTimeout(CounterHandle_L);
  window.clearTimeout(RefresHandle_L);
  stopButton("l");

  //RefresHandle_L = window.setTimeout(refreshData_L, REFRESH_INTERVAL_L);

  if ( (g_OddsKeeper_L == null) || (iRefreshCount_L <= 0) ) {
    document.DataForm_L.RT.value = "W";
    iRefreshCount_L = REFRESH_COUNTDOWN;
  } else {
    iRefreshCount_L--;
  }

  if (bShowLoading_L){
    document.getElementById("BetList").style.display = "block";
    bShowLoading_L = false;
  }

  document.DataForm_L.submit();

  if (PopLauncher!=null) {
    if (sKeeper!=null && PopLauncher.isOpened) {
        if (sKeeper.Market=="L") {
            if (ThreadId!=null && ThreadId!="") {
                recallAjax(ThreadId)
            }
        }
    } else {
        ThreadId=null;
    }
  } else {
    ThreadId=null;
  }
}

var REFRESH_GAP_D = true; // a flag to noted is odds display refreshing
var bShowLoading_D = true;
var iRefreshCount_D = REFRESH_COUNTDOWN;
var RefresHandle_D;
var Soccer_More = false;
function refreshData_D() {

    if (typeof (refreshMoreData) != "undefined") {
        refreshMoreData_D(1);
        refreshMoreData_D(2);
        refreshMoreData_D(5);
    }

    if (fFrame.IsLogin) {
	  if (fFrame.leftFrame==null || fFrame.leftFrame.eObj==null) {
			  window.setTimeout("refreshData_D()", 500);
			  return;
	  }
	}

    if ((PAGE_MARKET == "l") && (fFrame.SiteMode ==  1)) {
       refreshData();
       return;
    }

    if (!REFRESH_GAP_D)
    {
        window.setTimeout("refreshData_D()", 500);
        return;
    }

    window.clearTimeout(CounterHandle_D);
    window.clearTimeout(RefresHandle_D);
    stopButton("d");

  //RefresHandle_D = window.setTimeout(refreshData_D, REFRESH_INTERVAL_D);

    if ( (g_OddsKeeper_D == null) || (iRefreshCount_D <= 0) ) {
      document.DataForm_D.RT.value = "W";
      iRefreshCount_D = REFRESH_COUNTDOWN;
    } else {
      iRefreshCount_D--;
    }

    if (bShowLoading_D){
      document.getElementById("BetList").style.display = "block";
      bShowLoading_D = false;
    }
	
    if (document.DataForm_D.RT.value == "W") g_OddsKeeper_D = null;

    document.DataForm_D.submit();

    if (PopLauncher!=null) {
      if (sKeeper!=null && PopLauncher.isOpened) {
        if (sKeeper.Market!="L") {
            if (ThreadId!=null && ThreadId!="") {
                recallAjax(ThreadId)
            }
        }
      } else {
        ThreadId=null;
      }
    } else {
      ThreadId=null;
    }
}

function stopButton(Market) {


  var aSorter = document.getElementById("aSorter");
  if (aSorter != null) {
    setSelecterDisable('aSorter', true);
  }

  var aDiv = document.getElementById("divSelectDate");
  if ((aDiv != null) && (aDiv.style.display != "none")) {
    for (var i = 0; i < aDiv.childNodes.length; i++) {
      var oBtn = aDiv.childNodes[i];
      if ((oBtn.tagName != null) && (oBtn.tagName.toUpperCase() == "SPAN")) {
        oBtn.disabled = true;
      }
    }
  }
  var arrBottons;
  var aBtn;

  if (Market == "l") {
    IsRefresh_L = false;
    REFRESH_GAP_L = false;
    arrBottons = document.getElementsByName("btnRefresh_L");
    aBtn = document.getElementById("btnRefresh_L");
  } else {
    var bDiv = document.getElementById("HourContainer");
    if ((bDiv  != null) && (bDiv.style.display != "none")) {
	    setSelecterDisable("HourContainer", true);
    }
	IsRefresh_D = false;
    REFRESH_GAP_D = false;
    arrBottons = document.getElementsByName("btnRefresh_D");
    aBtn = document.getElementById("btnRefresh_D");
  }

  if (aBtn != null) {
      aBtn.disabled = true;
      aBtn.innerHTML = "";
      aBtn.innerHTML = siteObj._SpanTagS + "<span>" + RES_PLEASE_WAIT + "</span>" + siteObj._SpanTagE;
      aBtn.style.font.color = "gray";
      if (fFrame.IsNewDropdownList)
          aBtn.className = "buttons disabled";
  }
  for (var i = 0; i < arrBottons.length; i++) {
    arrBottons[i].disabled = true;
    arrBottons[i].innerHTML = "";
	arrBottons[i].innerHTML = siteObj._SpanTagS + "<span>" + RES_PLEASE_WAIT + "</span>" + siteObj._SpanTagE;
	arrBottons[i].style.font.color = "gray";
	if (fFrame.IsNewDropdownList) {
	    arrBottons[i].className = "buttons disabled";
	}
  }

    var aSel = document.getElementById("selOddsType");
    if (aSel !== null) {
    	setSelecterDisable("selOddsType",true);
    }
  //Force button to be enable after 15 sec even the data still not received
    var timer = setTimeout("startButton('" + Market + "')",15000);
}

var IsRefresh_L = false;
var IsRefresh_D = false;
function startButton(Market) {
    if ((Market == "l") && (REFRESH_GAP_L)) {
        return;
    } else if ((Market == "d") && (REFRESH_GAP_D)) {
        return;
    }
  
    var aDiv = document.getElementById("divSelectDate");
    if ((aDiv != null) && (aDiv.style.display != "none")) {
      for (var i = 0; i < aDiv.childNodes.length; i++) {
        var oBtn = aDiv.childNodes[i];
        if ((oBtn.tagName != null) && (oBtn.tagName.toUpperCase() == "SPAN")) {
          oBtn.disabled = false;
        }
      }
    }

    var bDiv = document.getElementById("HourContainer");
    if ((bDiv  != null) && (bDiv .style.display != "none")) {
	    setSelecterDisable("HourContainer", false);
    }

    var arrBottons;
    var iCount;
    var sBtnLable;
    var oBtn;
    if (Market == "l") {
	  IsRefresh_L = true;
      REFRESH_GAP_L = true;
      oBtn = document.getElementById("btnRefresh_L");
      arrBottons = document.getElementsByName("btnRefresh_L");
      iCount = REFRESH_INTERVAL_L / 1000 - 1;
      sBtnLable = RES_LIVE;
      CounterHandle_L = setTimeout("countdown('l'," + iCount + ")", 1000);
    } else {
	  IsRefresh_D = true;
      REFRESH_GAP_D = true;
      oBtn = document.getElementById("btnRefresh_D");
      arrBottons = document.getElementsByName("btnRefresh_D");
      var iCount = REFRESH_INTERVAL_D / 1000 - 1;
      sBtnLable = RES_REFRESH;
      CounterHandle_D = setTimeout("countdown('d'," + iCount + ")", 1000);
    }
    
	var refbtn_L = document.getElementById("btnRefresh_L");
    var refbtn_D = document.getElementById("btnRefresh_D");
    var IsEnableSelOddsType = false;

    if (IsRefresh_L && IsRefresh_D) {
        IsEnableSelOddsType = true;
    } else if (!IsRefresh_L && IsRefresh_D) {
      if (refbtn_L != null) {
          if (refbtn_L.style.display == 'none') {
              IsEnableSelOddsType = true;
          }
      }      
    } else if (IsRefresh_L && (!IsRefresh_D)) {
      if (IsRefresh_D != null) {
          if (refbtn_D.style.display == 'none') {
              IsEnableSelOddsType = true;
          }
      }  
    }
	
	if(IsEnableSelOddsType){
	    var aSel = document.getElementById("selOddsType"); 
		if (aSel !== null) { 
			setSelecterDisable("selOddsType",false); 
		}
	}
	
  for (var i = 0; i < arrBottons.length; i++) {
    arrBottons[i].innerHTML = "";
    arrBottons[i].innerHTML = siteObj._SpanTagS + "<span>" + sBtnLable + "</span>" + siteObj._SpanTagE;
    arrBottons[i].disabled = false;
    arrBottons[i].style.font.color = "black";
    if (fFrame.IsNewDropdownList) {
        arrBottons[i].className = "buttons";
    }
  }
  if (oBtn != null) {
    oBtn.innerHTML = "";
    oBtn.innerHTML = siteObj._SpanTagS + "<span>" + sBtnLable + iCount + "</span>" + siteObj._SpanTagE;
    oBtn.disabled = false;
    oBtn.style.font.color = "black";
    if (fFrame.IsNewDropdownList)
      oBtn.className = "buttons";
  }

  //early haven't btnRefresh_L
  var aSorter = document.getElementById("aSorter");
  if (aSorter != null)
  {
    setSelecterDisable('aSorter', false);
  }
  
}

function countdown(sMarket, Count) {
  var oBtn;
  var sBtnLable;
  if (sMarket == "l") {
    if (!REFRESH_GAP_L) return;
    if (Count <= 0)
    {
        refreshData_L();
        return;
    }
	    document.getElementById("btnRefresh_L").innerHTML = siteObj._SpanTagS + "<span>" + RES_LIVE + Count + "</span>" + siteObj._SpanTagE;
    CounterHandle_L = setTimeout("countdown('" + sMarket +"'," + (Count - 1) + ")", 1000);
  } else {
    if (!REFRESH_GAP_D) return;
    if (Count <= 0) {
      refreshData_D();
      return;
    }
	    document.getElementById("btnRefresh_D").innerHTML = siteObj._SpanTagS + "<span>" + RES_REFRESH + Count + "</span>" +siteObj._SpanTagE;
    CounterHandle_D = setTimeout("countdown('" + sMarket +"'," + (Count - 1) + ")", 1000);
  }
}

function checkHasParlay(sMarket,sSport)
{
   try
   {
       var count=0;

       if(sMarket.toUpperCase() =="L")
       {
         count = fFrame.leftFrame.IsHaveLiveParlay() ? 1:0;
       }
       else
       {
         count=fFrame.leftFrame.GetParlayCount(sMarket,sSport);
       }

     var obj = document.getElementById("b_SwitchToParlay");
     if(obj!=null)
     {
       if(count>0 && arr_Match[0] == "0")
       {
         obj.style.display = "block";
       }
       else
       {
         obj.style.display = "none";
       }
       if (fFrame.IsCssControl)
         document.getElementById("a_SwitchToParlay").innerHTML = ParlayIconText;

       setTimeout("checkHasParlay('" + sMarket +"','" + sSport + "')", 2000);
     }
   }
   catch(e)
   {
       setTimeout("checkHasParlay('" + sMarket +"','" + sSport + "')", 1000);
   }
}

function SwitchToParlay(sSport)
{
  try
   {

       // sSport = 0 is live
       if(sSport=="0")       {
           //sMarket="LP";
           fFrame.leftFrame.SwitchSport('LP',sSport);
       }else{
           fFrame.leftFrame.ShowOdds('P',sSport);
       }

        fFrame.leftFrame.ReloadWaitingBetList('yes','no','1');

   }
   catch(e)
   {

   }
}

//1: ByDate  0:ByCode
function setRefreshSort(){
  var aSorter = document.getElementById("aSorter");
  if(aSorter !== null){
    setSelecterDisable('aSorter', true);
  }


  if (document.DataForm_L != null) {
    var OrderBy = document.DataForm_L.OrderBy.value;
    var sLang = (fFrame.UserLang =="it" || fFrame.UserLang =="jp")  ? "en" : fFrame.UserLang ;
    if(OrderBy == '1')
    {
        document.DataForm_L.OrderBy.value = "0";
        document.DataForm_D.OrderBy.value = "0";
        if (g_OddsKeeper_D != null)
        {
            g_OddsKeeper_D.SortType = 0;
        }
        g_OddsKeeper_L.SortType = 0;
    }
    else
    {
	    document.DataForm_L.OrderBy.value = "1";
	    document.DataForm_D.OrderBy.value = "1";
	    if (g_OddsKeeper_L != null) {
		    g_OddsKeeper_L.SortType = 1;
	    }
	    g_OddsKeeper_D.SortType = 1;
    }

    if ((PAGE_MARKET == "t") && (fFrame.SiteMode != 1)) {
	    document.DataForm_L.RT.value = "W";
	    //document.getElementById("btnRefresh_L").style.display = "";
	    refreshData_L();
    }
    document.DataForm_D.RT.value = "W";
    refreshData_D();
  }
  
  if (document.DataForm != null) {
    var OrderBy = document.DataForm.OrderBy.value;
    var sLang = (fFrame.UserLang =="it" || fFrame.UserLang =="jp")  ? "en" : fFrame.UserLang ;
    if(OrderBy == '1') {
	  document.DataForm.OrderBy.value = "0";
  	  g_OddsKeeper.SortType = 0;
    } else {
	  document.DataForm.OrderBy.value = "1";
	  g_OddsKeeper.SortType = 1;
    }
    document.DataForm.RT.value = "W";
    refreshData();
  }	
}

function changeButtonStatus(buttonName, isStop, sec, title) {

    var classdisable = "";
    var title2 = (title == "" ? RES_REFRESH : title);
    var sec2 = (sec == "" ? "":sec);
    var arrButtons;
    var oBtn;
    
    if (isStop) {
        classdisable = " disable";
        title2 = RES_PLEASE_WAIT;
    }
    else if ((parent.mainFrame.document.body.id == "AllSingleOdds") && (typeof sec == "undefined") && (fFrame.isAllSingleFirstLoad) && (buttonName == "btnRefresh_D")) {
        return;
    }
    else if ((parent.mainFrame.document.body.id == "AllSingleOdds") && (typeof sec == "undefined")) {
        if ((buttonName == "btnRefresh_D") && (document.DataForm_D.ChangeOddsType.value != "")) {
            return;
        }
        else if ((buttonName == "btnRefresh_L") && (document.DataForm_L.ChangeOddsType.value != "")) {
            return;
        }
    }
    else if (buttonName == "btnRefresh_D") {
        fFrame.isAllSingleFirstLoad = false;
	}


    oBtn = document.getElementById(buttonName);
    arrButtons = document.getElementsByName(buttonName);

    for (var i = 0; i < arrButtons.length; i++) {
        arrButtons[i].innerHTML = "";
        arrButtons[i].innerHTML = siteObj._SpanTagS + "<span>" + title2 + "</span>" + siteObj._SpanTagE;
        arrButtons[i].disabled = isStop;
        arrButtons[i].style.font.color = "black";
        arrButtons[i].className = "buttons" + classdisable;
    }

    if (oBtn != null) {
        oBtn.innerHTML = "";
        oBtn.innerHTML = siteObj._SpanTagS + "<span>" + title2 + sec2 + "</span>" + siteObj._SpanTagE;
        oBtn.disabled = isStop;
        oBtn.style.font.color = "black";
        oBtn.className = "buttons" + classdisable;
    }
}

function paintRefreshBtn(Market) {

    var Names = ["btnRefresh", "btnRefresh_L", "btnRefresh_D"];
    for (var j = 0; j < Names.length; j++) {
        changeButtonStatus(Names[j], false, "", "");
    }
}

var CountDownList = new Array();
function GameCountDown()
{
    for(key in CountDownList)
    {
        var obj=document.getElementById(key);
        if (obj != null)
        {
            CountDownList[key] = parseInt(CountDownList[key],10)-1;
            if (CountDownList[key] <= 0)
            {
                CountDownList[key] = 0;
                obj.innerHTML = RES_NOMOREBET;

                if($(obj).parent().prevAll("span:first")[0] != null)
                {
                    $(obj).parent().prevAll("span:first")[0].style.display = "none";    
                }
            }
            else
            {
                obj.innerHTML = CountDownList[key];

                if($(obj).parent().prevAll("span:first")[0] != null)
                {
                    $(obj).parent().prevAll("span:first")[0].style.display = "";
                }
            }
        }
    }
}

function BingoMouseMove(Sender)
{
    //market_hdp_group
    var group = Sender.id.split("_");
    var group2 = parseInt(group[2],10);
    var matchid="";
    if (group.length==4)
    {
        matchid="_"+group[3];
    }
    switch (group[1])
    {
        case "1":
                for (var i=5*group2-4;i<=5*group2;i++)
                {
                    if (document.getElementById(group[0] + "_5_" + i + matchid).className.indexOf("trbgov") == -1)
                        document.getElementById(group[0] + "_5_" + i + matchid).className = document.getElementById(group[0] + "_5_" + i + matchid).className + " trbgov";
                }
            break;
        case "2":
                for (var i=15*group2-14;i<=15*group2;i++)
                {
                    if (document.getElementById(group[0] + "_5_" + i + matchid).className.indexOf("trbgov") == -1)
                        document.getElementById(group[0] + "_5_" + i + matchid).className = document.getElementById(group[0] + "_5_" + i + matchid).className + " trbgov";
                }
            break;
        case "3":
                for (var i=25*group2-24;i<=25*group2;i++)
                {
                    if (document.getElementById(group[0] + "_5_" + i + matchid).className.indexOf("trbgov") == -1)
                        document.getElementById(group[0] + "_5_" + i + matchid).className = document.getElementById(group[0] + "_5_" + i + matchid).className + " trbgov";
                }
            break;
        case "4":
                for (var i=0;i<=14;i++)
                {
        	        var j=i*5+group2;
        	        if (document.getElementById(group[0] + "_5_" + j + matchid).className.indexOf("trbgov") == -1)
        	            document.getElementById(group[0] + "_5_" + j + matchid).className = document.getElementById(group[0] + "_5_" + j + matchid).className + " trbgov";
                }
            break;

    }
    if (Sender.className.indexOf("trbgov")==-1)
            Sender.className = Sender.className + " trbgov";
}

function BingoMouseOut(Sender)
{
    //market_hdp_group
    var group = Sender.id.split("_");
    var group2 = parseInt(group[2],10);
    var matchid="";
    if (group.length==4)
    {
        matchid="_"+group[3];
    }
    switch (group[1])
    {
        case "1":
                for (var i=5*group2-4;i<=5*group2;i++)
                {
                    document.getElementById(group[0] + "_5_" + i + matchid).className = document.getElementById(group[0] + "_5_" + i + matchid).className.replace("trbgov", "").replace(/(^\s*)|(\s*$)/g, "");
                }
            break;
        case "2":
                for (var i=15*group2-14;i<=15*group2;i++)
                {
                    document.getElementById(group[0] + "_5_" + i + matchid).className = document.getElementById(group[0] + "_5_" + i + matchid).className.replace("trbgov", "").replace(/(^\s*)|(\s*$)/g, "");
                }
            break;
        case "3":
                for (var i=25*group2-24;i<=25*group2;i++)
                {
                    document.getElementById(group[0] + "_5_" + i + matchid).className = document.getElementById(group[0] + "_5_" + i + matchid).className.replace("trbgov", "").replace(/(^\s*)|(\s*$)/g, "");
                }
            break;
        case "4":
                for (var i=0;i<=14;i++)
                {
        	        var j=i*5+group2;
        	        document.getElementById(group[0] + "_5_" + j + matchid).className = document.getElementById(group[0] + "_5_" + j + matchid).className.replace("trbgov", "").replace(/(^\s*)|(\s*$)/g, "");
                }
            break;

    }
    Sender.className = Sender.className.replace("trbgov","").replace(/(^\s*)|(\s*$)/g, "");
}

var sKeeper = null;
function DivPopMore(Width, MatchId, LeagueName, HomeName, AwayName, isParlay,isLive,MUID,tag) {
  if (PopLauncher != null) {
    PopLauncher.close();
    PopLauncher = null;
  }
  if (MoreLauncher != null) {
    MoreLauncher.close();
    MoreLauncher = null;
  }
  if (!initialTmpl("MorePop_tmpl", "MorePop_tmpl.aspx", "DivPopMore('" + Width + "','" + MatchId + "','" + LeagueName + "','" + HomeName+ "','" + AwayName+ "','" + isParlay+ "','" + isLive + "','" + MUID + "','" + tag+ "');")) {
    return;
  }
  var market="D";
  if (isLive=="true")
    market="L";
	document.getElementById("oPopContainer").innerHTML = fFrame.document.getElementById("MorePop_tmpl").contentWindow.document.getElementById(tag+market).innerHTML;

	sKeeper = new SimpleOddsKeeper();
	sKeeper.MUID = MUID;
	sKeeper.MatchId = MatchId;
  sKeeper.TableContainer = document.getElementById("oPopContainer");
  sKeeper.DivTmpl=fFrame.document.getElementById("MorePop_tmpl").contentWindow.document.getElementById(tag+market).innerHTML;
  sKeeper.isParlay=isParlay;
  sKeeper.Market=market;
	var oDiv = document.getElementById("PopDiv");
	oDiv.style.height = 0;
	oDiv.style.width = 0;

	var oTitle = document.getElementById("PopTitleText");
	oTitle.style.width = Width+'px';

	if (PopLauncher == null) {
		var oDragger = document.getElementById("PopTitle");
		var oCloser = document.getElementById("PopCloser");
		PopLauncher = new DivLauncher(oDiv, oDragger, oCloser);
	}
    var param = new Object();
  param["matchid"]=MatchId;
  param["Market"]=market;
  param["tag"]=tag;
  param["isparlay"]=isParlay;
  ThreadId=tag;
  switch (tag)
  {
      case "UnderOver_MoreDiv":
          more_mode = "OU";
          oTitle.innerHTML = HomeName + " -vs- " + AwayName;
          ExecAjax("MorePop_data.aspx",param,"GET",tag,"OpenUnderOverPopDiv");
      break;
    case "Bingo_MoreDiv":
    default:
          more_mode = "NG";
          oTitle.innerHTML = RES_B90 + " - " + HomeName;
          ExecAjax("MorePop_data.aspx",param,"GET",tag,"OpenBingoPopDiv");
      break;
  }
}

function OpenBingoPopDiv(Response)
{
	eval(Response);
	/*if (ajaxData.length==0)
	{
        ThreadId=null;
        sKeeper=null;
        PopLauncher.close();
        return;
	}*/
	sKeeper.setDatas(ajaxData, MultiSportODDS_DEF[90]);
    for (var i = 1;i<=15;i++)
    {
        sKeeper.newHash["Odds_90_1_" + i + "_Cls"] = getOddsClass(sKeeper.oHash["Odds_90_1_" + i]);

        if (fFrame.EnableArrowOddsChange) {
            if (sKeeper.oHash["Odds_90_1_" + i] != "") {
                sKeeper.newHash["Odds_90_1_" + i + "_Cls"] += " OddsBtn";
            } 
        }
    }
    for (var i = 1;i<=5;i++)
    {
        sKeeper.newHash["Odds_90_2_"+i+"_Cls"] = getOddsClass(sKeeper.oHash["Odds_90_2_"+i]);
        sKeeper.newHash["Odds_90_4_" + i + "_Cls"] = getOddsClass(sKeeper.oHash["Odds_90_4_" + i]);

        if (fFrame.EnableArrowOddsChange) {
            if (sKeeper.oHash["Odds_90_2_" + i] != "") {
                sKeeper.newHash["Odds_90_2_" + i + "_Cls"] += " OddsBtn";
            }
            if (sKeeper.oHash["Odds_90_4_" + i] != "") {
                sKeeper.newHash["Odds_90_4_" + i + "_Cls"] += " OddsBtn";
            } 
        }
    }
    for (var i = 1;i<=3;i++)
    {
        sKeeper.newHash["Odds_90_3_" + i + "_Cls"] = getOddsClass(sKeeper.oHash["Odds_90_3_" + i]);

        if (fFrame.EnableArrowOddsChange) {
            if (sKeeper.oHash["Odds_90_3_" + i] != "") {
                sKeeper.newHash["Odds_90_3_" + i + "_Cls"] += " OddsBtn";
            }
        }
    }

    for (var i = 1; i <= 75; i++) {
        sKeeper.newHash["Odds_90_5_" + i + "_Cls"] = getOddsClass(sKeeper.oHash["Odds_90_5_" + i]);

        if (fFrame.EnableArrowOddsChange) {
            if (sKeeper.oHash["Odds_90_5_" + i] != "") {
                sKeeper.newHash["Odds_90_5_" + i + "_Cls"] += " OddsBtn";
            }
        }
    }

	sKeeper.oHash["MatchId"]=sKeeper.MatchId;
	sKeeper.newHash["isParlay"]=sKeeper.isParlay;
	sKeeper.paintOddsTable();

	if (ThreadId!=null && ThreadId!="")
	{
	    PopLauncher.open(60, 120);
	}
}

function Rechkskeeper_5_15()
{
    if (sKeeper != null && more_mode == "OU")
    {
        if (fFrame.DisplayMode == 3)
        {
	        sKeeper.newHash["SHOW5_15"]=CLS_LS_OFF;
	    }
	    else
        {
            if (sKeeper.oHash["OddsId_5"] != null || sKeeper.oHash["OddsId_15"] != null)
            {
	            sKeeper.newHash["SHOW5_15"]=CLS_LS_ON;
	        }
	        else
	        {
    	        sKeeper.newHash["SHOW5_15"]=CLS_LS_OFF;
	        }
	    }
	    sKeeper.paintOddsTable();
	}
}
function OpenUnderOverPopDiv(Response)
{
	eval(Response);
	if (ajaxData.length==0)
	{
        ThreadId=null;
        sKeeper=null;
        PopLauncher.close();
        return;
	}
	var oldHash = new Object();
    for (var o in sKeeper.oHash) oldHash[o] = sKeeper.oHash[o];
    var betType = new Array("5", "15", "24", "25", "26", "27", "13", "28", "121", "122", "123", "2", "12", "6", "14", "16", "4", "30", "126", "127");
	for (var i=0;i<betType.length;i++)
	{
	    if (ajaxData[betType[i]] != null)
	    {
	        sKeeper.setDatas(ajaxData[betType[i]], MultiSportODDS_DEF[parseInt(betType[i],10)]);

	        var oddsName;
	        for (var j=1;j<MultiSportODDS_DEF[parseInt(betType[i],10)].length;j++)
	        {
	            oddsName = MultiSportODDS_DEF[parseInt(betType[i],10)][j];
	            if (oddsName.substr(0,5)=="Odds_")
	            {
	                sKeeper.newHash[oddsName + "_Cls"] = getOddsClass(sKeeper.oHash[oddsName]);
	                if (fFrame.EnableArrowOddsChange) {
	                    if (sKeeper.oHash[oddsName] != "") {
	                        sKeeper.newHash[oddsName + "_Cls"] += " OddsBtn";
                        }
                    }
	            }
            }
	    }

	}
	if (oldHash["MatchId"] != null)
	{
	    sKeeper.oHash = sKeeper.updateOdds(oldHash, sKeeper.oHash, betType);
	}
	if (fFrame.DisplayMode == 3 || sKeeper.isParlay == 1)
    {
	    sKeeper.newHash["SHOW5_15"]=CLS_LS_OFF;
	}
	else
    {
        if (ajaxData["5"] != null || ajaxData["15"] != null)
        {
	        sKeeper.newHash["SHOW5_15"]=CLS_LS_ON;
	    }
	    else
	    {
    	    sKeeper.newHash["SHOW5_15"]=CLS_LS_OFF;
	    }
	}

    if (ajaxData["121"] != null || ajaxData["122"] != null)
    {
        sKeeper.newHash["SHOW121_122"]=CLS_LS_ON;
    }
    else
    {
	    sKeeper.newHash["SHOW121_122"]=CLS_LS_OFF;
    }
    if (ajaxData["123"] != null || ajaxData["25"] != null)
    {
        sKeeper.newHash["SHOW123_25"]=CLS_LS_ON;
    }
    else
    {
	    sKeeper.newHash["SHOW123_25"]=CLS_LS_OFF;
    }

    if (ajaxData["24"] != null)
    {
        sKeeper.newHash["SHOW24"]=CLS_LS_ON;
    }
    else
    {
	    sKeeper.newHash["SHOW24"]=CLS_LS_OFF;
    }
    if (ajaxData["26"] != null || ajaxData["27"] != null)
    {
        sKeeper.newHash["SHOW26_27"]=CLS_LS_ON;
    }
    else
    {
	    sKeeper.newHash["SHOW26_27"]=CLS_LS_OFF;
    }
    if (ajaxData["13"] != null)
    {
        sKeeper.newHash["SHOW13"]=CLS_LS_ON;
    }
    else
    {
	    sKeeper.newHash["SHOW13"]=CLS_LS_OFF;
    }
    if (ajaxData["28"] != null)
    {
        sKeeper.newHash["SHOW28"]=CLS_LS_ON;
    }
    else
    {
	    sKeeper.newHash["SHOW28"]=CLS_LS_OFF;
	}
	if (ajaxData["2"] != null || ajaxData["12"] != null) {
	    sKeeper.newHash["SHOW2_12"] = CLS_LS_ON;
	}
	else {
	    sKeeper.newHash["SHOW2_12"] = CLS_LS_OFF;
	}
//    if (ajaxData["6"] != null || ajaxData["2"] != null)
//    {
//        sKeeper.newHash["SHOW6_2"]=CLS_LS_ON;
//    }
//    else
//    {
//	    sKeeper.newHash["SHOW6_2"]=CLS_LS_OFF;
//	}
	if (ajaxData["6"] != null) {
	    sKeeper.newHash["SHOW6"] = CLS_LS_ON;
	}
	else {
	    sKeeper.newHash["SHOW6"] = CLS_LS_OFF;
	}
	if (ajaxData["126"] != null) {
	    sKeeper.newHash["SHOW126"] = CLS_LS_ON;
	}
	else {
	    sKeeper.newHash["SHOW126"] = CLS_LS_OFF;
	}

	if (ajaxData["127"] != null) {
	    sKeeper.newHash["SHOW127"] = CLS_LS_ON;
	}
	else {
	    sKeeper.newHash["SHOW127"] = CLS_LS_OFF;
	}

    if (ajaxData["14"] != null)
    {
        sKeeper.newHash["SHOW14"]=CLS_LS_ON;
    }
    else
    {
	    sKeeper.newHash["SHOW14"]=CLS_LS_OFF;
    }
    if (ajaxData["16"] != null)
    {
        sKeeper.newHash["SHOW16"]=CLS_LS_ON;
    }
    else
    {
	    sKeeper.newHash["SHOW16"]=CLS_LS_OFF;
    }
    if (ajaxData["4"] != null)
    {
        sKeeper.newHash["SHOW4"]=CLS_LS_ON;
    }
    else
    {
	    sKeeper.newHash["SHOW4"]=CLS_LS_OFF;
    }
    if (ajaxData["30"] != null)
    {
        sKeeper.newHash["SHOW30"]=CLS_LS_ON;
    }
    else
    {
	    sKeeper.newHash["SHOW30"]=CLS_LS_OFF;
    }
	sKeeper.oHash["MatchId"]=sKeeper.MatchId;
	sKeeper.newHash["isParlay"]=sKeeper.isParlay;
	sKeeper.paintOddsTable();
	if (ThreadId!=null && ThreadId!="")
	{
	    PopLauncher.open(30, 120);
	}
}

function ConvertArrayIndex(arr, key){
    for (var i = 0; i < arr.length; i++) {
        if (arr[i] == key) {
            return i;
        }
    }
    return -1;
}

function SwpA(ArrSrc, IndexA, IndexB) {
    var tmp = ArrSrc[IndexA];
    ArrSrc[IndexA] = ArrSrc[IndexB];
    ArrSrc[IndexB] = tmp;
}


var ARR_FIELDS_ORG = null;
var ARR_FIELDS_ORG1 = null;

var SwpDEF_FLAG = false;
function SwpD(arrIndex) {
    if (SwpDEF_FLAG) return;
    SwpDEF_FLAG = true;
    /*for(var key in ARR_FIELDS_DEF) {
    SwpA(ARR_FIELDS_DEF[key], IndexA, IndexB);
    }
    for(var key in ARR_FIELDS_DEF1) {
    SwpA(ARR_FIELDS_DEF1[key], IndexA, IndexB);
    }*/
    if (ARR_FIELDS_ORG == null) {
        ARR_FIELDS_ORG = ARR_FIELDS_DEF["1"].slice(0, ARR_FIELDS_DEF["1"].length - 1);
    }
    if (ARR_FIELDS_ORG1 == null) {
        ARR_FIELDS_ORG1 = ARR_FIELDS_DEF1["1"].slice(0, ARR_FIELDS_DEF1["1"].length - 1);
    }
    for (var i = 1; i < arrIndex.length; i++) {
        SwpA(ARR_FIELDS_DEF["1"], arrIndex[i - 1], arrIndex[i]);
        SwpA(ARR_FIELDS_DEF1["1"], arrIndex[i - 1], arrIndex[i]);
    }
}

var InsDEF_FLAG = false;
function InsD(arrIndex) {
    if (InsDEF_FLAG) return;
    InsDEF_FLAG = true;
    /*for(var key in ARR_FIELDS_DEF) {
    if (typeof(ARR_FIELDS_DEF[key]) != "function") {
    ARR_FIELDS_DEF[key] = arrayInsert(ARR_FIELDS_DEF[key], Index, ['XIBCX']);
    }
    }
    for(var key in ARR_FIELDS_DEF1) {
    if (typeof(ARR_FIELDS_DEF1[key]) != "function") {
    ARR_FIELDS_DEF1[key] = arrayInsert(ARR_FIELDS_DEF1[key], Index, ['XIBCX']);
    }
    }*/
    if (ARR_FIELDS_ORG == null) {
        ARR_FIELDS_ORG = ARR_FIELDS_DEF["1"].slice(0, ARR_FIELDS_DEF["1"].length - 1);
    }
    if (ARR_FIELDS_ORG1 == null) {
        ARR_FIELDS_ORG1 = ARR_FIELDS_DEF1["1"].slice(0, ARR_FIELDS_DEF1["1"].length - 1);
    }
    for (var i = 0; i < arrIndex.length; i++) {
        ARR_FIELDS_DEF["1"] = arrayInsert(ARR_FIELDS_DEF["1"], arrIndex[i], ['XIBCX']);
        ARR_FIELDS_DEF1["1"] = arrayInsert(ARR_FIELDS_DEF1["1"], arrIndex[i], ['XIBCX']);
    }
}

function RstrD() {
    SwpDEF_FLAG = false;
    InsDEF_FLAG = false;
    if (ARR_FIELDS_ORG != null) {
        ARR_FIELDS_DEF["1"] = ARR_FIELDS_ORG;
        ARR_FIELDS_ORG = null;
    }
    if (ARR_FIELDS_ORG1 != null) {
        ARR_FIELDS_DEF1["1"] = ARR_FIELDS_ORG1;
        ARR_FIELDS_ORG1 = null;
    }
}

//odds change new style
function setOdssChangeClassToHashObject(newHash, oHash, aryBetTypes) {

	if( aryBetTypes == null ) {
		return;
	}
    for (var i = 0; i < aryBetTypes.length; i++) {
        if (oHash["Changed_" + aryBetTypes[i]] != undefined) {

            if (newHash[aryBetTypes[i] + "_Cls"] != undefined) {
                newHash[aryBetTypes[i] + "_Cls"] += " " + oHash["Changed_" + aryBetTypes[i]];
            } else {
                newHash[aryBetTypes[i] + "_Cls"] = oHash["Changed_" + aryBetTypes[i]];
            }
        }
    }
}

function getOddsChangeStatus(status) {

    switch (status) {
        case "Bad":
            return "BadOdds";
            break;
        case "Best":
            return "BestOdds";
            break;
        default:
            return "";
            break;
    }
}

function ChangeCursor(Sender) {
    // $(Sender).
    // $(":first-child", Sender).Html()
    //if(trim(Sender.firstChild.innerHTML).length > 0)

    if (trim($(":first-child", Sender).html()).length > 0) {
        Sender.style.cursor = "pointer";

    } else {

        Sender.style.cursor = "auto";
    }
}

function SingleNumberWheelMouseMove(Sender, tdid) {
    if (fFrame.IsLogin) {
        ChangeCursor(Sender);
    }
    var std = tdid;
    if (document.getElementById(tdid).className.indexOf("trbgov") == -1)
        document.getElementById(tdid).className = document.getElementById(tdid).className + " trbgov";

    if (Sender.className.indexOf("trbgov") == -1)
        Sender.className = Sender.className + " trbgov";
}

function SingleNumberWheelMouseOut(Sender, tdid) {
    document.getElementById(tdid).className = document.getElementById(tdid).className.replace("trbgov", "").replace(/(^\s*)|(\s*$)/g, "");

    Sender.className = Sender.className.replace("trbgov", "").replace(/(^\s*)|(\s*$)/g, "");
}

function FinalpaintOddsTable() {
    if (typeof (arr_ShowMixParlay) == "object") {
        var arr_OddsKeeper_L = new Array();
        var arr_OddsKeeper_D = new Array();
        if (g_OddsKeeper_L != null)
            arr_OddsKeeper_L = g_OddsKeeper_L.getOddsKeeperArray();
        if (g_OddsKeeper_D != null)
            arr_OddsKeeper_D = g_OddsKeeper_D.getOddsKeeperArray();

        for (var iSport in arr_ShowMixParlay) {
            if (arr_ShowMixParlay[iSport] && arr_OddsKeeper_L[iSport] != null) {
                var oddsKeeper = arr_OddsKeeper_L[iSport];
                oddsKeeper.paintOddsTable();
            }

            if (arr_ShowMixParlay[iSport] && arr_OddsKeeper_D[iSport] != null) {
                var oddsKeeper = arr_OddsKeeper_D[iSport];
                oddsKeeper.paintOddsTable();
            }
        }
    }
    else if (typeof (arr_OddsKeeper) == "object") {
        for (var iSport in arr_OddsKeeper) {
            var oddsKeeper = arr_OddsKeeper[iSport];
            if (oddsKeeper != null) {
                oddsKeeper.paintOddsTable();
            }
        }
    }
    else {
        if (typeof (g_OddsKeeper_D) == "object" && g_OddsKeeper_D != null) {
            g_OddsKeeper_D.paintOddsTable();
        }
        if (typeof (g_OddsKeeper_L) == "object" && g_OddsKeeper_L != null) {
            g_OddsKeeper_L.paintOddsTable();
        }
        if (typeof (g_OddsKeeper) == "object" && g_OddsKeeper != null) {
            g_OddsKeeper.paintOddsTable();
        }
    }
    btnstop();
    btnstart();
}

function checkLeagueCount() {    
    var l_Cnt = SelMainMarket == 1 ? TotlaMainLeagueCnt : TotlaLeagueCnt;
    if (document.getElementById("League_New")) {
        if (typeof (l_Cnt) == "undefined" || l_Cnt == "0") {
            document.getElementById("League_New").className = "displayOff";
            document.getElementById("League_Old").className = "";
            return;
        }
        document.getElementById("League_New").className = "";
        document.getElementById("League_Old").className = "displayOff";
        if (TotlaSelLeagueCnt == 0) {
            document.getElementById("SelLeagueIcon").className = "displayOff";
            document.getElementById("CustSelL").className = "selected displayOff";
            document.getElementById("AllSelL").className = "displayOn";
        }
        else {
            document.getElementById("SelLeagueIcon").className = "displayOn";
            document.getElementById("CustSelL").className = "selected displayOn";
            document.getElementById("AllSelL").className = "displayOff";
        }
        if (parseInt(TotlaSelLeagueCnt, 10) > parseInt(l_Cnt, 10)) {
            document.getElementById("CustSelL").innerHTML = l_Cnt;
        }
        else {
            document.getElementById("CustSelL").innerHTML = TotlaSelLeagueCnt;
        }

        //        if (parseInt(SelLeagueCnt, 10) > parseInt(l_Cnt, 10))
        //        {
        //            document.getElementById("CustSelL").innerHTML = l_Cnt;
        //        }
        //        else
        //        {
        //            document.getElementById("CustSelL").innerHTML = SelLeagueCnt;
        //        }
        document.getElementById("AllSelL").innerHTML = l_Cnt;
        document.getElementById("TotalLeagueCnt").innerHTML = l_Cnt;
    }
}
function RecSelMainMarket(Response) {
    /*
    //alert(Response);
    if (Response != "OK")
    {
    if (SelLeagueThreadIdThreadId != "")
    {
    recallAjax(SelLeagueThreadId);
    }
    }
    */
}

function CheckCursorStyle(type, matchid) {
    if (type == 1) {
        if ($('#selections').length != 0) {
            $('.' + matchid).css('cursor', 'text');
        }
        else {
            $('.' + matchid).css('cursor', 'pointer');
        }
    }
    else {
        $('.' + matchid).css('cursor', 'default');
    }
}
function addLeagueFavorites(e,SportType, LeagueID, IsFavorites, isLive, MatchID) {
    var obj = document.getElementById("fav_" + LeagueID);
	if (MatchID==null)MatchID="";
		
    if (IsFavorites) {
        //obj.parentElement.href = String.format("javascript:addLeagueFavorites(event,'{0}', '{1}', 0, {2},null);", SportType, LeagueID, isLive);
		$(obj).click(function() {
			addLeagueFavorites(event,SportType,LeagueID, 0,isLive,null);
		});
        obj.parentElement.title = fFrame.RES_AddFavorite;
        obj.className = "favorite";
        addFavoritesQuery(SportType, LeagueID, MatchID, 'DelL', '');
        if (RES_PageType != null) {
            document.DataForm_L.RT.value = "W";
            document.DataForm_D.RT.value = "W";
            document.DataForm_L.CT.value = "";
            document.DataForm_D.CT.value = "";
            if ($('#btnSwitchBack').css('display') != "none") {
                LiveInfoBackButton();
            }
            //g_OddsKeeper_D = null;
            //g_OddsKeeper_L = null;
        }
		if (MatchID == "") {
			checkOddsKeeperLeague(SportType, LeagueID, "");
		}
    }
    else {
        //obj.parentElement.href = String.format("javascript:addLeagueFavorites(event,'{0}', '{1}', 1, {2},null);", SportType, LeagueID, isLive);
		$(obj).click(function() {
			addLeagueFavorites(event,SportType,LeagueID,1,isLive,null);
		});
        obj.parentElement.title = fFrame.RES_RemoveFavorite;
        obj.className = "favorite added";
        addFavoritesQuery(SportType, LeagueID, '', 'AddL', '');
        if (MatchID == "") {
            checkOddsKeeperLeague(SportType, LeagueID, "1");
        }
    }

    if (typeof e != "undefined") {
        var evn = e || window.event;
        if (typeof evn != "undefined" && evn != null) {
            if (typeof evn.cancelBubble != "undefined")
                evn.cancelBubble = true;
            else
                evn.cancel = true;
            if (evn.stopPropagation) evn.stopPropagation();
        }
    }
}

function addMatchFavorites(MUID, KeyValue, IsFavorites, isLive) {
    var sMatchId = MUID.substr(2, MUID.length - 2);
    var obj = document.getElementById("fav_" + MUID);

    var aKeeper = getOddsKeeper(MUID, isLive);
    var idx;
    var iSorter = (document.body.id == "AllSingleOdds" || document.body.id == "Live") ? 0 : (document.getElementById("aSorter")==null ? 0 :document.getElementById("aSorter").value);

    if (iSorter == 1) {
        idx = aKeeper.findIndex("KickoffTime", KeyValue);
        idx = aKeeper.adjustIndex1st(idx, "KickoffTime", KeyValue, MUID);
    } else {
        idx = aKeeper.findIndex("MatchCode", KeyValue);
        idx = aKeeper.adjustIndex1st(idx, "MatchCode", KeyValue, MUID);
    }

    var KickoffTime = aKeeper.EventList[idx]["KickoffTime"];
    var L_IsFavorite = aKeeper.EventList[idx]["FavLeague"]; 

    if (IsFavorites) {
		
       // obj.parentElement.href = String.format("javascript:addMatchFavorites('{0}','{1}',0,{2});", MUID, KeyValue, isLive);
        //obj.parentElement.title = fFrame.RES_AddFavorite;
        //obj.className =  "iconOdds favorite";
		$(obj).find("span").attr( 'onclick', String.format("javascript:addMatchFavorites('{0}','{1}',0,{2});", MUID, KeyValue, isLive));
		$(obj).find("span").attr( 'title', fFrame.RES_AddFavorite);
		$(obj).find("span").attr( 'class', "favorite");
        addFavoritesQuery('', aKeeper.EventList[idx]["LeagueId"], sMatchId, 'DelM', KickoffTime);

        if (aKeeper.EventList[idx]["MUID"] == MUID) {
            aKeeper.EventList[idx]["Favorite"] = "";
        }

        if (RES_PageType != null) {
            document.DataForm_L.RT.value = "W";
            document.DataForm_D.RT.value = "W";
            document.DataForm_L.CT.value = "";
            document.DataForm_D.CT.value = "";
            //g_OddsKeeper_D = null;
            //g_OddsKeeper_L = null;
        }
        if (L_IsFavorite) {
            addLeagueFavorites(null, aKeeper.EventList[idx]["SportType"], aKeeper.EventList[idx]["LeagueId"], "1", isLive, sMatchId);
            checkOddsKeeperLeague(aKeeper.EventList[idx]["SportType"], aKeeper.EventList[idx]["LeagueId"], "2");
        }
		
    } else {
        //obj.parentElement.href = String.format("javascript:addMatchFavorites('{0}','{1}',1,{2});", MUID, KeyValue, isLive);
        //obj.parentElement.title = fFrame.RES_RemoveFavorite;
        //obj.className = "iconOdds favoriteAdd";
		//title='" + (IsFavorites ? fFrame.RES_RemoveFavorite : fFrame.RES_AddFavorite) + "'
		$(obj).find("span").attr( 'onclick', String.format("javascript:addMatchFavorites('{0}','{1}',1,{2});", MUID, KeyValue, isLive));
		$(obj).find("span").attr( 'title', fFrame.RES_RemoveFavorite);
		$(obj).find("span").attr( 'class', "favorite added");
		
        addFavoritesQuery('', aKeeper.EventList[idx]["LeagueId"], sMatchId, 'AddM', KickoffTime);

        if (aKeeper.EventList[idx]["MUID"] == MUID) {
            aKeeper.EventList[idx]["Favorite"] = "1";
        }
    }
}


function addFavoritesQuery(SportType, LeagueID, MatchId, Action, Time) {
    $.ajax
    (
        {
            type: 'post',
            url: 'addFavorites.aspx',
            data: { SportType: SportType,
                    LeagueID: LeagueID,
                    MatchId: MatchId,
                    Action: Action,
                    Time:Time
                },
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            cache: false,
            asyncBoolean: false,
            error: function (err) {
            },
            success: function (result) {
            }
        }
    );

}

function checkOddsKeeperLeague(SportType, LeagueID, FavLeague) {
    if (typeof (arr_ShowMixParlay) == "object") {
        if (arr_ShowMixParlay[SportType.toString()] != null) {
            var arr_OddsKeeper_L = new Array();
            var arr_OddsKeeper_D = new Array();
            if (g_OddsKeeper_L != null)
                arr_OddsKeeper_L = g_OddsKeeper_L.getOddsKeeperArray();
            if (g_OddsKeeper_D != null)
                arr_OddsKeeper_D = g_OddsKeeper_D.getOddsKeeperArray();
            if (arr_ShowMixParlay[SportType.toString()] && arr_OddsKeeper_L[SportType.toString()] != null) {
                var oddsKeeper = arr_OddsKeeper_L[SportType.toString()];
                for (var i = 0; i < oddsKeeper.EventList.length; i++) {
                    if (oddsKeeper.EventList[i].LeagueId.toLowerCase() == LeagueID) {
                        if (FavLeague == "2") {
                            oddsKeeper.EventList[i]["FavLeague"] = "";
                        }
                        else {
                            oddsKeeper.EventList[i]["FavLeague"] = FavLeague;
                            oddsKeeper.EventList[i]["Favorite"] = FavLeague;
                        }
                    }
                }
            }

            if (arr_ShowMixParlay[SportType.toString()] && arr_OddsKeeper_D[SportType.toString()] != null) {
                var oddsKeeper = arr_OddsKeeper_D[SportType.toString()];
                for (var i = 0; i < oddsKeeper.EventList.length; i++) {
                    if (oddsKeeper.EventList[i].LeagueId.toLowerCase() == LeagueID) {
                        if (FavLeague == "2") {
                            oddsKeeper.EventList[i]["FavLeague"] = "";
                        }
                        else {
                            oddsKeeper.EventList[i]["FavLeague"] = FavLeague;
                            oddsKeeper.EventList[i]["Favorite"] = FavLeague;
                        }	
                    }
                }
            }

            if (arr_ShowMixParlay["O"] && g_OddsKeeper_Outright != null) {
                var oddsKeeper = g_OddsKeeper_Outright;
                for (var i = 0; i < oddsKeeper.EventList.length; i++) {
                    if (oddsKeeper.EventList[i].LeagueId.toLowerCase() == LeagueID) {
                        if (FavLeague == "2") {
                            oddsKeeper.EventList[i]["FavLeague"] = "";
                        }
                        else {
                            oddsKeeper.EventList[i]["FavLeague"] = FavLeague;
                            oddsKeeper.EventList[i]["Favorite"] = FavLeague;
                        }			
                    }
                }
            }
        }
    }
    else if (typeof (arr_OddsKeeper) == "object") {
        if (arr_OddsKeeper[SportType] != null) {
            var oddsKeeper = arr_OddsKeeper[SportType];
            for (var i = 0; i < oddsKeeper.EventList.length; i++) {
                if (oddsKeeper.EventList[i].LeagueId.toLowerCase() == LeagueID) {
                    if (FavLeague == "2") {
                        oddsKeeper.EventList[i]["FavLeague"] = "";
                    }
                    else {
                        oddsKeeper.EventList[i]["FavLeague"] = FavLeague;
                        oddsKeeper.EventList[i]["Favorite"] = FavLeague;
                    }
                }
            }
        }
    }
    else {
        if (typeof g_OddsKeeper_L != "undefined" && g_OddsKeeper_L != null) {
            for (var i = 0; i < g_OddsKeeper_L.EventList.length; i++) {
                if (g_OddsKeeper_L.EventList[i].LeagueId.toLowerCase() == LeagueID) {
                    if (FavLeague == "2") {
                        g_OddsKeeper_L.EventList[i]["FavLeague"] = "";
                    }
                    else {
                        g_OddsKeeper_L.EventList[i]["FavLeague"] = FavLeague;
                        g_OddsKeeper_L.EventList[i]["Favorite"] = FavLeague;
                    }
                }
            }
        }
        if (typeof g_OddsKeeper_D != "undefined" && g_OddsKeeper_D != null) {
            for (var i = 0; i < g_OddsKeeper_D.EventList.length; i++) {
                if (g_OddsKeeper_D.EventList[i].LeagueId.toLowerCase() == LeagueID) {
                    if (FavLeague == "2") {
                        g_OddsKeeper_D.EventList[i]["FavLeague"] = "";
                    }
                    else {
                        g_OddsKeeper_D.EventList[i]["FavLeague"] = FavLeague;
                        g_OddsKeeper_D.EventList[i]["Favorite"] = FavLeague;
                    }				
                }
            }
        }
        if (typeof g_OddsKeeper != "undefined" && g_OddsKeeper != null) {
            for (var i = 0; i < g_OddsKeeper.EventList.length; i++) {
                if (g_OddsKeeper.EventList[i].LeagueId.toLowerCase() == LeagueID) {
                    if (FavLeague == "2") {
                        g_OddsKeeper.EventList[i]["FavLeague"] = "";
                    }
                    else {
                        g_OddsKeeper.EventList[i]["FavLeague"] = FavLeague;
                        g_OddsKeeper.EventList[i]["Favorite"] = FavLeague;
                    }				
                }
            }
        }
    }
	FinalpaintOddsTable();
}

function getBettradeIconHtml(MatchId) {
    return "<div class=\"icon displayOn\"><span class='betTrade' onclick=\"fFrame.leftFrame.ReloadBetTradeMini('no', 'no', '" + MatchId + "');\" title='" + fFrame.MSG_ReferBetTradeGuide + "' onmouseover=\"showBetTradeTip();\"></span></div>";
}

function getCashOutIconHtml(MatchId) {
    return "<div class=\"icon displayOn\"><i class='icon icon-cashout' onclick=\"fFrame.leftFrame.ONEbook.CashOut.filter('" + MatchId + "');\" title='" + fFrame.MSG_CashOut + "';\"></i></div>";
}

function getOddsKeeper(MUID, IsLive) {
    var temp_OddsKeeper;
    if (typeof (arr_ShowMixParlay) == "object") {
        for (var i = 1; i < 100; i++) {
            if (arr_ShowMixParlay[i.toString()] != null) {
                var arr_OddsKeeper_L = new Array();
                var arr_OddsKeeper_D = new Array();
                if (g_OddsKeeper_L != null)
                    arr_OddsKeeper_L = g_OddsKeeper_L.getOddsKeeperArray();
                if (g_OddsKeeper_D != null)
                    arr_OddsKeeper_D = g_OddsKeeper_D.getOddsKeeperArray();
                if (arr_ShowMixParlay[i.toString()] && arr_OddsKeeper_L[i.toString()] != null && IsLive) {
                    for (var j = 0; j < arr_OddsKeeper_L[i.toString()].EventList.length; j++) {
                        if (arr_OddsKeeper_L[i.toString()].EventList[j].MUID.toLowerCase() == MUID) {
                            return arr_OddsKeeper_L[i.toString()];
                        }
                    }
                }

                if (arr_ShowMixParlay[i.toString()] && arr_OddsKeeper_D[i.toString()] != null && !IsLive) {
                    for (var j = 0; j < arr_OddsKeeper_D[i.toString()].EventList.length; j++) {
                        if (arr_OddsKeeper_D[i.toString()].EventList[j].MUID.toLowerCase() == MUID) {
                            return arr_OddsKeeper_D[i.toString()];
                        }
                    }
                }
            }
        }
    }
    else if (typeof (arr_OddsKeeper) == "object") {
        for (var i = 1; i < 100; i++) {
            if (arr_OddsKeeper[i.toString()] != null && IsLive) {
                for (var j = 0; j < arr_OddsKeeper[i.toString()].EventList.length; j++) {
                    if (arr_OddsKeeper[i.toString()].EventList[j].MUID.toLowerCase() == MUID) {
                        return arr_OddsKeeper[i.toString()];
                    }
                }
            }
        }
    }
    else {
        if (g_OddsKeeper_L != null && IsLive) {
            for (var j = 0; j < g_OddsKeeper_L.EventList.length; j++) {
                if (g_OddsKeeper_L.EventList[j].MUID.toLowerCase() == MUID) {
                    return g_OddsKeeper_L;
                }
            }
        }
        if (g_OddsKeeper_D != null && !IsLive) {
            for (var j = 0; j < g_OddsKeeper_D.EventList.length; j++) {
                if (g_OddsKeeper_D.EventList[j].MUID.toLowerCase() == MUID) {
                    return g_OddsKeeper_D;
                }
            }
        }
        if (g_OddsKeeper != null) {
            for (var j = 0; j < g_OddsKeeper.EventList.length; j++) {
                if (g_OddsKeeper.EventList[j].MUID.toLowerCase() == MUID) {
                    return g_OddsKeeper;
                }
            }
        }
    }
}

function replaceDecimalSeperator(formattedRate) {
    var _defaultDecimalSeperator = '.';
    var _decimalSeperator = '';

    return formattedRate.toString().replace(_defaultDecimalSeperator, _decimalSeperator);
}

function DecToUS(odds) {
    return (odds < 2 && odds > 1) ? (-100 / (odds - 1)).toFixed(0) : ('+' + (100 * (odds - 1)).toFixed(0));
}

function DecToHK(odds) {
    //return replaceDecimalSeperator((odds - 1).toFixed(2));
    return (odds - 1).toFixed(2);
}

function DecToMY(odds) {
    var hkOdds = odds - 1;
    //return replaceDecimalSeperator((hkOdds <= 1) ? hkOdds.toFixed(2) : (-1 / hkOdds).toFixed(2));
    return (hkOdds <= 1) ? hkOdds.toFixed(2) : (-1 / hkOdds).toFixed(2);
}

function DecToIndo(odds) {
    var hkOdds = odds - 1;
    //return replaceDecimalSeperator((hkOdds < 1 && hkOdds > 0) ? (-1 / hkOdds).toFixed(2) : hkOdds.toFixed(2));
    return (hkOdds < 1 && hkOdds > 0) ? (-1 / hkOdds).toFixed(2) : hkOdds.toFixed(2);
}

function ConvertOdds(OddsType, Odds, IsParlay) {
    if (Odds == 0) {
        return "";
    }

    if (IsParlay == "1") {
        return Odds;
    }

    switch (OddsType) {
        case "2":
            return DecToHK(Odds);
        case "3":
            return DecToIndo(Odds);
        case "4":
            return DecToMY(Odds);
        case "5":
            return DecToUS(Odds);
        default:
            return Odds;

    }
}