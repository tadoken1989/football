<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>UnderOver</title>
    <script language="JavaScript" type="text/javascript">
        var REFRESH_INTERVAL_L = 20000;
        var REFRESH_INTERVAL_D = 60000;
        var REFRESH_COUNTDOWN = 720; //60;
        var RES_REFRESH = "<div class='iconRefresh' title='Refresh'></div>";
        var RES_PLEASE_WAIT = "<div class='iconRefresh wait' title='Please Wait'></div>";
        var RES_UNDER = "u";
        var RES_LIVE = "<div class='iconRefresh live' title='Live'></div>";
        var PAGE_MARKET = "t";
        var RES_DRAW = "Draw";
        var RES_MORE = "More Bet Types";
        var RES_DOMAIN = "lucky88.com";
        var RES_NOW = "Now";
        var RES_SORTBYTIME = "20";
        var RES_NORMALSORT = "Normal Sorting";
        var ParlayIconText = "Parlay";
        var DisableCasino = "false";
        var SyncCasino = "false";
        var RES_PageType;

        function alertCasionMsg() {
            if (DisableCasino == "false" && SyncCasino == "true") {
                window.top.leftFrame.OpenCasino("");
            } else {
                alert("");
            }
        }

        //Live Chat
    </script>
    <script type='text/javascript'>
        if ("False".toLowerCase() === "false") {
            <!-- build:css -->
            document.write('<link href="/public/template/lucky88/public/css/table_w.css?v=20110106" rel="stylesheet" type="text/css" />');
            document.write('<link href="/public/template/lucky88/public/css/button.css?v=20081211" rel="stylesheet" type="text/css" />');
            document.write('<link href="/public/template/lucky88/public/css/oddsFamily.css?v=20081211" rel="stylesheet" type="text/css" />');
            <!-- endbuild -->
            <!-- build:js -->
            document.write('<script language="JavaScript" type="text/javascript" src="/public/commjs/jquery.min.js?v=201512290801">\x3C/script>');
            document.write('<script language="JavaScript" type="text/javascript" src="/public/commjs/getDataClass.js?v=201512290801">\x3C/script>');
            document.write('<script language="JavaScript" type="text/javascript" src="/public/commjs/ajaxData.js?v=201512290801">\x3C/script>');
            document.write('<script language="JavaScript" type="text/javascript" src="/public/commjs/odds/MultiSport_Def.js?v=201801310921">\x3C/script>');
            document.write('<script language="JavaScript" type="text/javascript" src="/public/commjs/cookie.js?v=201512290801">\x3C/script>');
            document.write('<script language="JavaScript" type="text/javascript" src="/public/commjs/OddsUtils.js?v=201707211152">\x3C/script>');
            document.write('<script language="JavaScript" type="text/javascript" src="/public/commjs/odds/more.js?v=201803230202">\x3C/script>');
            document.write('<script language="JavaScript" type="text/javascript" src="/public/commjs/OddsKeeper.js?v=201703240854">\x3C/script>');
            document.write('<script language="JavaScript" type="text/javascript" src="/public/commjs/odds/UnderOver.js?v=201705240315">\x3C/script>');
            document.write('<script language="JavaScript" type="text/javascript" src="/public/commjs/DivLauncher.js?v=201512290801">\x3C/script>');
            document.write('<script language="JavaScript" type="text/javascript" src="/public/commjs/ieupdate.js?v=201512290801">\x3C/script>');
            document.write('<script language="JavaScript" type="text/javascript" src="/public/commjs/common.js?v=201801240844">\x3C/script>');
            document.write('<script language="JavaScript" type="text/javascript" src="/public/commjs/streaming.js?v=201512290801">\x3C/script>');
            <!-- endbuild -->
        }
        else {
            document.write('<link href="http://y.img.akatx.net/Desktop/template/lucky88/public/css/M_UnderOver.css?v=20180331" rel="stylesheet" type="text/css" />');
            document.write('<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js">\x3C/script>');
            document.write('<script src="http://y.img.akatx.net/Desktop/commjs/main/M_UnderOverAll.js?v=20180331">\x3C/script>');
        }

        var footer_hight = "0";
        if (footer_hight > 0) {
            $(window).load(function () {
                window.frames["FooterFrame"].location = "";
                $("#FooterFrame").load(function () {
                    $("#FooterFrame").height(footer_hight);
                });
            });
        }

        SelMainMarket = parseInt("0", 10);
    </script>
    <style type="text/css">
        #Layer1 {
            position: absolute;
            left: 1px;
            top: 20px;
            width: 424px;
            height: 311px;
            z-index: 1;
        }
    </style>
</head>
<body id="UnderOver" onload="OverWriteFormSubmit();initialDisstyle('3');refreshAll();checkHasParlay('t','1');">
<iframe name='DataFrame_L' src="" style="display: none"></iframe>
<iframe name='DataFrame_D' src="" style="display: none"></iframe>
<iframe name='fav' id='fav' src="" style="display: none"></iframe>
<div class="title_border">
    <div id="column1" class="column3 titleSection">
        <div class="left">
            <div class="Soccer">Sự kiện hôm nay</div>
        </div>
        <div class="control right">
            <span id="tdSelPeriod" style="display:none">
                <select id="selPeriod" onchange="changePeriod(this.options[this.selectedIndex].value); parent.focus();"
                        class="select_Line">
                    <option value="0">All Matches</option>
                </select>
            </span>
            <a id="btnSwitchBack" href="javascript:LiveInfoBackButton();" class="buttons2" style="display:none"
               title="Back"><span>Back</span></a>
            <div id="b_SwitchToParlay" style="display:none">
                <a id="a_SwitchToParlay" href="javascript:SwitchToParlay('1');" class="buttons2"></a>
            </div>
            <div id="selLeagueType_Div" tabindex="6" hidefocus
                 onkeypress="onKeyPressSelecter('selLeagueType',event);return false;"
                 onclick="onClickSelecter('selLeagueType');" class="dropDown icon">
                <input type="hidden" name="selLeagueType" id="selLeagueType" value="0"/>
                <span id="selLeagueType_Txt" title='All Markets'><div id="selLeagueType_Icon"
                                                                      class="icon All"></div></span>
                <ul id="selLeagueType_menu" class="submenu">
                    <li title='All Markets' onmouseover="onOver(this)" onmouseout="onOut(this)"
                        onclick="setSelecter('selLeagueType',this,'0',true);changeLeagueType(0);"><span
                                class="icon All"></span>All Markets
                    </li>
                    <li title='Main Markets' onmouseover="onOver(this)" onmouseout="onOut(this)"
                        onclick="setSelecter('selLeagueType',this,'1',true);changeLeagueType(1);"><span
                                class="icon Main"></span>Main Markets
                    </li>
                </ul>
            </div>

            <div id="Tbl_TimeRange" style="display:block">
                <div id="HourContainer_Div" tabindex="6" hidefocus
                     onkeypress="onKeyPressSelecter('HourContainer',event);return false;"
                     onclick="onClickSelecter('HourContainer');" class="dropDown">
                    <input type="hidden" name="HourContainer" id="HourContainer" value=""/>
                    <span id="HourContainer_Txt" title='Time Range'>Time Range</span>
                    <ul id="HourContainer_menu" class="submenu">
                        <li id=HourSpan0 title='All' onmouseover="onOver(this)" onmouseout="onOut(this)"
                            onclick="setSelecter('HourContainer',this,'HourSpan0',false);HourLinkClick(this,0);">All
                        </li>
                        <li id=HourSpan3 title='12:00~16:00' onmouseover="onOver(this)" onmouseout="onOut(this)"
                            onclick="setSelecter('HourContainer',this,'HourSpan3',false);HourLinkClick(this,3);">
                            12:00~16:00
                        </li>
                        <li id=HourSpan7 title='16:00~20:00' onmouseover="onOver(this)" onmouseout="onOut(this)"
                            onclick="setSelecter('HourContainer',this,'HourSpan7',false);HourLinkClick(this,7);">
                            16:00~20:00
                        </li>
                        <li id=HourSpan11 title='20:00~00:00' onmouseover="onOver(this)" onmouseout="onOut(this)"
                            onclick="setSelecter('HourContainer',this,'HourSpan11',false);HourLinkClick(this,11);">
                            20:00~00:00
                        </li>
                        <li id=HourSpan15 title='00:00~04:00' onmouseover="onOver(this)" onmouseout="onOut(this)"
                            onclick="setSelecter('HourContainer',this,'HourSpan15',false);HourLinkClick(this,15);">
                            00:00~04:00
                        </li>
                        <li id=HourSpan19 title='04:00~08:00' onmouseover="onOver(this)" onmouseout="onOut(this)"
                            onclick="setSelecter('HourContainer',this,'HourSpan19',false);HourLinkClick(this,19);">
                            04:00~08:00
                        </li>
                        <li id=HourSpan23 title='08:00~12:00' onmouseover="onOver(this)" onmouseout="onOut(this)"
                            onclick="setSelecter('HourContainer',this,'HourSpan23',false);HourLinkClick(this,23);">
                            08:00~12:00
                        </li>
                    </ul>
                </div>

            </div>

            <div id="aSorter_Div" tabindex="6" hidefocus onkeypress="onKeyPressSelecter('aSorter',event);return false;"
                 onclick="onClickSelecter('aSorter');" class="dropDown icon">
                <input type="hidden" name="aSorter" id="aSorter" value="0"/>
                <span id="aSorter_Txt" title='Normal Sorting'><div id="aSorter_Icon" class="icon NO"></div></span>
                <ul id="aSorter_menu" class="submenu">
                    <li title='Sort By Time' onmouseover="onOver(this)" onmouseout="onOut(this)"
                        onclick="setSelecter('aSorter',this,'1',true);"><span class="icon ST"></span>Sort By Time
                    </li>
                    <li title='Normal Sorting' onmouseover="onOver(this)" onmouseout="onOut(this)"
                        onclick="setSelecter('aSorter',this,'0',true);"><span class="icon NO"></span>Normal Sorting
                    </li>
                </ul>
            </div>

            <a id="b_selectLeague"
               href="javascript:openLeague(640,'Select League','t','1','1,3,5,7,8,15','0','UnderOver');" class="buttons"
               style="display:none;"><span>Select League</span></a>
            <div id="disstyle_Div" tabindex="6" hidefocus
                 onkeypress="onKeyPressSelecter('disstyle',event);return false;" onclick="onClickSelecter('disstyle');"
                 class="dropDown icon">
                <input type="hidden" name="disstyle" id="disstyle" value="3"/>
                <span id="disstyle_Txt" title='Double Line'><div id="disstyle_Icon" class="icon DL"></div></span>
                <ul id="disstyle_menu" class="submenu">
                    <li title='Single Line' onmouseover="onOver(this)" onmouseout="onOut(this)"
                        onclick="setSelecter('disstyle',this,'1',true);changeDisplayMode('1','lucky88.com'); parent.focus();">
                        <span class="icon SL"></span>Single Line
                    </li>
                    <li title='Double Line' onmouseover="onOver(this)" onmouseout="onOut(this)"
                        onclick="setSelecter('disstyle',this,'3',true);changeDisplayMode('3','lucky88.com'); parent.focus();">
                        <span class="icon DL"></span>Double Line
                    </li>
                    <li title='Full Time' onmouseover="onOver(this)" onmouseout="onOut(this)"
                        onclick="setSelecter('disstyle',this,'1F',true);changeDisplayMode('1F','lucky88.com'); parent.focus();">
                        <span class="icon FT"></span>Full Time
                    </li>
                    <li title='Half Time' onmouseover="onOver(this)" onmouseout="onOut(this)"
                        onclick="setSelecter('disstyle',this,'1H',true);changeDisplayMode('1H','lucky88.com'); parent.focus();">
                        <span class="icon HT"></span>Half Time
                    </li>
                </ul>
            </div>


            <div id="selOddsType_Div" tabindex="6" hidefocus
                 onkeypress="onKeyPressSelecter('selOddsType',event);return false;"
                 onclick="onClickSelecter('selOddsType');" class="dropDown icon" style="display: none">
                <input type="hidden" name="selOddsType" id="selOddsType" value="4"/>
                <span id="selOddsType_Txt" title='Malay Odds'><div id="selOddsType_Icon" class="icon MY"></div></span>
                <ul id="selOddsType_menu" class="submenu">
                    <li title='Hong Kong Odds' onmouseover="onOver(this)" onmouseout="onOut(this)"
                        onclick="setSelecter('selOddsType',this,'2',true);changeOddsType_ou(2);"><span
                                class="icon HK"></span>Hong Kong Odds
                    </li>
                    <li title='Indonesian Odds' onmouseover="onOver(this)" onmouseout="onOut(this)"
                        onclick="setSelecter('selOddsType',this,'3',true);changeOddsType_ou(3);"><span
                                class="icon INDO"></span>Indonesian Odds
                    </li>
                    <li title='American Odds' onmouseover="onOver(this)" onmouseout="onOut(this)"
                        onclick="setSelecter('selOddsType',this,'5',true);changeOddsType_ou(5);"><span
                                class="icon US"></span>American Odds
                    </li>
                    <li title='Decimal Odds' onmouseover="onOver(this)" onmouseout="onOut(this)"
                        onclick="setSelecter('selOddsType',this,'1',true);changeOddsType_ou(1);"><span
                                class="icon DEC"></span>Decimal Odds
                    </li>
                    <li title='Malay Odds' onmouseover="onOver(this)" onmouseout="onOut(this)"
                        onclick="setSelecter('selOddsType',this,'4',true);changeOddsType_ou(4);"><span
                                class="icon MY"></span>Malay Odds
                    </li>
                </ul>
            </div>


            <a href="javascript:refreshData_D();" id="btnRefresh_D" name="btnRefresh_D" disabled class="buttons"><span><div
                            class='iconRefresh wait' title='Please Wait'></div></span></a>
            <a href="javascript:refreshData_L();" id="btnRefresh_L" name="btnRefresh_L" disabled class="buttons"
               style="display:none"><span><div class='iconRefresh wait' title='Please Wait'></div></span></a>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div id="MiddleLiveInfo" class="tmpl_border liveInfo" style="display: none">
    <iframe id="MiddleLiveInfoFrame" scrolling="no" frameborder="0"></iframe>
</div>
<div class="tmpl_border">
    <table class="column3" id="column2" border='0'>
        <tr id='OddsTr' style="display: none">
            <td>
                <div id="divSelectDate" class="EarlyMarket_top_bg" style="display:none">
                    <div class="mixparlay_line"><img src="/public/template/lucky88/public/images/layout/spacer.gif"
                                                     width="1" height="1"/></div>
                    <span class="Current" onclick="selectDate(this,'');" style="cursor:pointer;">All</span>
                    <span onclick="selectDate(this,'4//2018');" style="cursor:pointer;">1 Apr(Sun)</span>
                </div>
                <div id="HourContainer" class="EarlyMarket_top_bg" style="display:none"></div>
                <div class="tabbox" id="tabbox">
                    <div class="tabbox_F" id="oTableContainer_L"></div>
                    <div class="tabbox_F" id="oTableContainer_D"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div id="TrNoInfo" align="left" style="display: none">
                    <div class="tabbox">
                        <div class="tabbox_F">
                            <table width="100%" class="tabstyle02">
                                <tr>
                                    <td class="bgcpe" align="center">There are no games available at the moment.</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="BetList" align="center"><img src="/public/template/lucky88/public/images/layout/spacer.gif"
                                                      vspace="2" class="icon_loading"/></div>
            </td>
        </tr>
    </table>
</div>
<form action="http://odds.vdev.vn/odds.php" target="DataFrame_L" name="DataForm_L" style="display: none">
    <input type="hidden" name="Market" value="l"/>
    <input type="hidden" name="Sport" value="1"/>
    <input type="hidden" name="DT" value=""/>
    <input type="hidden" name="RT" value="W"/>
    <input type="hidden" name="CT" value=""/>
    <input type="hidden" name="Game" value="0"/>
    <input type="hidden" name="OrderBy" value="0"/>
    <input type="hidden" name="OddsType" value="4"/>
    <input type="hidden" name="MainLeague" value="0"/>
</form>
<form action="http://odds.vdev.vn/odds.php" target="DataFrame_D" name="DataForm_D" style="display: none">
    <input type="hidden" name="Market" value="t"/>
    <input type="hidden" name="Sport" value="1"/>
    <input type="hidden" name="DT" value=""/>
    <input type="hidden" name="RT" value="W"/>
    <input type="hidden" name="CT" value=""/>
    <input type="hidden" name="Game" value="0"/>
    <input type="hidden" name="OrderBy" value="0"/>
    <input type="hidden" name="OddsType" value="4"/>
    <input type="hidden" name="DispRang" value="3"/>
    <input type="hidden" name="MainLeague" value="0"/>
    <input type="hidden" name="k166076271" value="v166076679"/>
</form>
<form name="MoreForm" action="/Livescore/UnderOverPop" target="PopFrame" style="display: none">
    <input type="hidden" name="MatchId"/>
    <input type="hidden" name="LeagueName"/>
    <input type="hidden" name="HomeName"/>
    <input type="hidden" name="AwayName"/>
    <input type="hidden" name="isParlay"/>
    <input type="hidden" name="Market" value="t"/>
</form>
<div id="PopDiv" style="display:none">
    <table cellpadding="0" cellspacing="0" class="more-win">
        <tbody>
        <tr>
            <td>

                <div class="popTitle" id="PopTitle">
                    <div class="popContain b11_bl" id="PopTitleText"></div>
                    <div class="popc-ctrl" id="PopCloser"></div>
                </div>
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td><span id="oPopContainer"></span></td>
                    </tr>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<iframe name='PopFrame' id='PopFrame' src="" style="display: none"
        onload="document.getElementById('oPopContainer').innerHTML=this.contentWindow.document.body.innerHTML;OverWriteFormSubmit();"></iframe>
<iframe id="FooterFrame" name="FooterFrame" width="0" height="0" style="display:none" frameborder="0"
        allowtransparency="true" scrolling="no"></iframe>
<div id="LiveInfoMenu" style="display: none;">
    <ul class="cm-nav">
        <li><a href="#F">Full View</a></li>
        <li><a href="#L">Single View</a></li>
    </ul>
</div>
<div id="cm-nav" style="display:none">
    <ul class="cm-nav">
        <li><a href="#L">Large View</a></li>
        <li><a href="#S">Small View</a></li>
    </ul>
</div>
<div id="Soccer_More" style="display:none"></div>
</body>
<script type="text/javascript">
    function showHistory(home, away) {
        if (home && away) {
            $.ajax({
                url: "/Livescore/getUrl",
                type: "GET",
                data: {'home': home, 'away': away},
                success: function (b) {
                    var $_json = b;
                    if($_json != '#') {
                        window.open($_json);
                        return false;
                    }
                },
                error: function () {
                }
            });
        }

    }
</script>
</html>