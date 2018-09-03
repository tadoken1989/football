<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>{{ load_configs('site_title') }}</title>
    <meta name="description"
          content="{{ load_configs('site_description') }}">
    <meta name="keywords" content="{{ load_configs('site_keywords') }}">

    <link rel="alternate" href="{{ base_url() }}" hreflang="vi-vn">
    <meta property="og:url" itemprop="url" content="{{  base_url() }}">
    <meta property="og:title" content="{{ load_configs('site_title') }}">
    <meta property="og:description"
          content="{{ load_configs('site_description') }}">
    <meta name="news_keywords"
          content="{{ load_configs('site_keywords') }}">
    <meta name="author" content="bongda">
    <meta name="generator" content="{{ str_replace(['http://','https://','/'], "", base_url()) }}">
    <meta name="abstract" content="{{ str_replace(['http://','https://','/'], "", base_url()) }}">
    <meta name="copyright" content="{{  load_configs('footer_description') }}">
    <meta name="robots" content="index,follow,noodp">
    <meta http-equiv="REFRESH" content="1200">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="content-language" content="vi">
    <meta name="revisit-after" content="1 days">
    <meta name="google-site-verification" content="UUHTHF1xvF_kK9Axndmhlg8xVVICrBpF59L3C9YrwoU">
    <meta property="fb:pages" content="590672034304448">

    <meta property="og:type" content="website">
    <meta property="og:locale" itemprop="inLanguage" content="vi_VN">
    <meta property="og:site_name" content="{{ load_configs('site_name') }}">
    <meta property="og:image" content="images/logo-bongdawap.png">

    <script type="text/javascript">
        //--------Site Const---------------
        var SiteMode = 2;
        var Deposit_SiteMode = 207; //Deposit site use only
        var DomainName = "lucky88.com";
        var IsLogin = false;
        var UserLang = "vn";
        var SkinRootPath = "template/lucky88/";
        var imgServerURL = "";
        var SiteId = "4220700";
        //----WebSkinType----
        var WebSkinType = "0"
        var preloadU3 = "/UnderOver_tmpl?form=3"
        var fixPreloadU3 = WebSkinType == 0 ? preloadU3 : 'fdfdf';
    </script>
    <script language="JavaScript" type="text/javascript" src="/public/commjs/jquery.min.js?v=201512290801"></script>
    <script language='JavaScript' type='text/javascript'
            src='/public/ShowHideFrame.js?v=201512290801'>

    </script>
    <script language='JavaScript' type='text/javascript' src='/public/commjs/common.js?v=201801240844'></script>
    <script language='JavaScript' type='text/javascript' src='/public/commjs/streaming.js?v=201512290801'></script>
    <script type='text/javascript' src='/public/cookie.js'></script>

    <script type="text/javascript">
        var SportType = '180';
        var OddsType = "4";
        var FSiteSpread = 0;
        //--------Odds Display---------------
        var DisplayMode = '3';
        var hash_TmplLoaded = new Array(); // hashtable for keeping template loaded flag (value: true / false)
        //--------Streaming ---------------
        var StreamingFrame = null; //streaming window handle
        var IsUserStreaming = false;
        //--------Menu---------------
        var deeplink = true;
        var LastSelectedSport = 1;//-1;
        var LastSelectedMArket = 'T';
        var LastSelectedBettype;
        var LastSelectedMenu = 0; // Default All = 0
        var LastSelectedOdds = '';
        //--------Racing---------------
        var CanSeeHorse = false;
        var CanSeeGreyhounds = false;
        var CanSeeHarness = false;
        var CanSeeHorseFixOdds = true;
        //-------------------------------
        var MenuData_topmenu = "";
        var ALogflag = false;
        var ScoreMsg = '';
        //--------Number Game---------------
        var CanSeeNumberGame = true;
        var CanBetNumberGame = false;
        //--------Virtual sport------------
        var CanSeeVirtualSports = true;
        var CanBetVirtualSports = false;
        var tmplHeader = null;
        var tmplEvent = null;
        var vsAct = "0";
        //-------AUS Racing Two Pools-----
        var SelectRacingCountry;
        //-------check turn to Mobile-----
        var checkMobile = 'false';
        var checkWindow = 'false';
        //-------title wording-------------
        var RES_StatisticInfo = 'Số liệu';
        var RES_LiveInfo = 'Live Information';
        var RES_ScoreMap = 'Bản đồ Điểm số';
        //----Keno----
        var KenoMsg = "Trước khi bạn trải nghiệm những giây phút hồi hộp cùng Keno, vui lòng gửi tiền vào tài khoản của bạn.";
        var KenoLotteryMsg = "Before you can experience the thrills of Lottery, please make a deposit into your account.";
        var CanBetKeno = false;
        //----UseNewTemplate----
        var UseNewTemplate = "";
        //--------SitePermission--------
        var unClickSportRadar = false;
        var unClickStatsInfo = false;
        var CanSeeSportStreaming = false;
        var CanSeeStatsInfo = false;
        var CanSeeSportRadar = false;
        var ShowPersonalMsgBtn = false;
        var IsPopWideMsgWin = true;
        var IsInnerFrame = true;
        var IsNewCashSite = false;
        var EventBGColor_Even = "#F5F5F5";
        var EventBGColor_Odd = "#E5E5E5";
        var LiveBGColor_Even = "#FBF0F0";
        var LiveBGColor_Odd = "#F9E6E6";
        var IsCssControl = true;
        var IsNewDropdownList = true;
        var IsShowHeader = false;
        var EnableVirtualSportList = "190,191,180,181,182,183,184,185,186";
        var SupportBonusSystem = false;
        var DateColor = "#003399";
        var HourLinkColor = "#003399";
        var EnableArrowOddsChange = false;
        var EnableGetClientIP = false;
        var EnableLAS = false;
        var CanSeeWordCupMenu = false;
        var CanSeeKeno = true;
        var CanSeeKenoLottery = true;
        var CanSeeWordCupBar = false;
        var CanSeeESport = true;
        var CanBetESport = true;
        var CanSeeLiveInfo = false;
        var EnableDoPlaceBetTransaction = false;
        var GetServiesIframeURL = "";
        var CanSeeEuroFooter = false;
        var IsCentralLocation = false;
        var IsSetleftMenuTooltip = false;
        var IsOlympicDay = false;
        var IsEuroCupDay = false;
        //--------Enable WebCentral.Config--------
        var BFCommonTracker = "UA-109526277-1";
        var AFCommonTracker = "UA-109526277-2";
        var LicGACode = "";
        var CanSeeCashOut = true;


        var basicFrame = null;

        function changeLocation() {
            if (IsNewCashSite && UseNewTemplate == "") {
                basicFrame = basicFrame || document.getElementById("basicFrame");
                var width = basicFrame.clientWidth;
                basicFrame.cols = (width - 1000) / 2 + "," + ((width - 1000) / 2 + 1000);// + width;
            }
        }

        var windowsHandle = new Array();

        function openWindowsHandle(winName, Condition, msg, url, winpara, iscallback, callbackfunc) {
            if (!iscallback && userBrowser() == "Firefox") {
                setTimeout(function () {
                    openWindowsHandle(winName, Condition, msg, url, winpara, true, callbackfunc)
                }, 1);
                return;
            }

            if (Condition) {
                var isNewOpen = false;
                if (windowsHandle[winName] == null || windowsHandle[winName].closed
                    || (userBrowser() == "Safari" && windowsHandle[winName].length == 0)) {
                    var strURL = url;
                    if (winpara == null) winpara = "";
                    windowsHandle[winName] = window.open(strURL, winName, winpara);
                    isNewOpen = true;
                    if (windowsHandle[winName] == null) alert(RES_BlockPopMsg);
                } else {
                    windowsHandle[winName].focus();
                }
                if (callbackfunc != null) callbackfunc(windowsHandle[winName], isNewOpen);

            } else {
                alert(msg);
            }
        }

        function closeAllWindows() {
            for (var key in windowsHandle) {
                if (windowsHandle[key] != null) {
                    windowsHandle[key].close();
                }
            }
        }

        function getOpenWindowsHandle(key) {
            return windowsHandle[key];
        }

        function checkMobileAgent() {
            var userAgentInfo = navigator.userAgent;
            var flag = false;
            if (userAgentInfo.match(/Android|iPhone|iPad|iPod/i)) {
                flag = true;
            }
            return flag;
        }

        function turntoMobile() {
            if (checkMobileAgent()) {
                var src = GetQueryString("src");
                if (src == null || src == 'undefined' || src != "m") {
                    location.replace("http://smart." + DomainName + "/");
                }
            }
        }

        if (checkMobile == "true") {
            turntoMobile();
        }

        function checkWindowInfo() {
            if (window.top !== window.self) {
                alert('Unauthorized Site (Situs Palsu)');
                window.top.location.href = document.URL;
            }
        }

        $(document).ready(function () {
            if (checkWindow == "true" && UseNewTemplate == "") {
                checkWindowInfo();
            }
            if (IsNewCashSite) {
                $('#leftFrame').load(function () {
                    mainFrame.location = "<?php echo base_url() ?>/Livescore/iframe";
                    $('#mainFrame').load(function () {
                        setTimeout(function () {
                            if (vsAct == 0) {
                                loadBetRadarVSTmpl();
                            }
                        }, 500);
                    });
                });
                leftFrame.location = "<?php echo base_url() ?>/Livescore/homeleft";
            }
            else {
                $("#topFrame").load(function () {
                    $('#leftFrame').load(function () {
                        mainFrame.location = "<?php echo base_url() ?>/Livescore/iframe";
                        $('#mainFrame').load(function () {
                            setTimeout(function () {
                                if (vsAct == 0) {
                                    loadBetRadarVSTmpl();
                                }
                            }, 500);
                        });
                    });
                    leftFrame.location = "<?php echo base_url() ?>/Livescore/homeleft";
                });
            }

            changeLocation();
            $(document).find("frame").each(function (index, domEle) {
                if ($(this).attr('id') == "basicFrame")
                    return false;
                if (this.attachEvent) {
                    this.attachEvent("onload",
                        function () {
                            $('body', window.frames[$(domEle).attr('id')].document).attr("lang", UserLang);
                        });
                } else if (WebSkinType == 0) {
                    this.onload = function () {
                        $('body', this.contentWindow.document).attr("lang", UserLang);
                    };
                }
                ;
            });
            document.getElementById('UnderOver_tmpl_3').src = fixPreloadU3;
        });

        function Loadframe() {
            $('#leftFrame').load(function () {
                $('#mainFrame').unbind('load');
                $('#mainFrame').bind('load', function () {
                    loadBetRadarVSTmpl();
                });
            });
        }

        function loadBetRadarVSTmpl() {
            return false;
        }

        function initialTmpl(frameId, url, TimeoutFunc) {
            if (fFrame.hash_TmplLoaded[frameId] == null) {
                fFrame.document.getElementById(frameId).contentWindow.location.href = url;
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

        var RES_SPORTS = new Array(162);
        RES_SPORTS[0] = "Tất Cả";
        RES_SPORTS[1] = "Bóng đá";
        RES_SPORTS[2] = "Bóng rổ";
        RES_SPORTS[3] = "Bóng bầu dục Mỹ";
        RES_SPORTS[4] = "Khúc côn cầu trên băng";
        RES_SPORTS[5] = "Quần vợt";
        RES_SPORTS[6] = "Bóng chuyền";
        RES_SPORTS[7] = "Snooker/Pool";
        RES_SPORTS[8] = "Bóng chày";
        RES_SPORTS[9] = "Cầu lông";
        RES_SPORTS[10] = "Đánh Golf";
        RES_SPORTS[11] = "Thể Thao Môtô";
        RES_SPORTS[12] = "Bơi lội";
        RES_SPORTS[13] = "Chính trị";
        RES_SPORTS[14] = "Bóng nước";
        RES_SPORTS[15] = "Lặn";
        RES_SPORTS[16] = "Quyền anh";
        RES_SPORTS[17] = "Bắn cung";
        RES_SPORTS[18] = "Bóng bàn";
        RES_SPORTS[19] = "Cử tạ";
        RES_SPORTS[20] = "Canoeing";
        RES_SPORTS[21] = "Thể dục";
        RES_SPORTS[22] = "Điền kinh";
        RES_SPORTS[23] = "Cưỡi ngựa";
        RES_SPORTS[24] = "Bóng ném";
        RES_SPORTS[25] = "Ném phi tiêu";
        RES_SPORTS[26] = "Bóng bầu dục";
        RES_SPORTS[27] = "Cricket";
        RES_SPORTS[28] = "Khúc côn cầu trên cỏ";
        RES_SPORTS[29] = "Winter Sports";
        RES_SPORTS[30] = "Squash";
        RES_SPORTS[31] = "Giải Trí";
        RES_SPORTS[32] = "Netball";
        RES_SPORTS[33] = "Đua xe đạp";
        RES_SPORTS[34] = "Đấu kiếm";
        RES_SPORTS[35] = "Judo";
        RES_SPORTS[36] = "M. Pentathlon";
        RES_SPORTS[37] = "Rowing";
        RES_SPORTS[38] = "Đua thuyền buồm";
        RES_SPORTS[39] = "Bắn súng";
        RES_SPORTS[40] = "Taekwondo";
        RES_SPORTS[41] = "Triathlon";
        RES_SPORTS[42] = "Đấu vật";
        RES_SPORTS[43] = "E-Sports";
        RES_SPORTS[44] = "Quyền Thái";
        RES_SPORTS[50] = "Cricket";
        RES_SPORTS[99] = "Môn thể thao khác";
        RES_SPORTS[154] = "Horse Racing Fixed Odds";
        RES_SPORTS[161] = "Number Game";
    </script>
</head>

<frameset cols="0,*" frameborder="no" id="basicFrame" border="0" framespacing="0" onload="changeLocation();"
          onresize="changeLocation();">
    <frame name="bodyleftFrame" scrolling="No" noresize="noresize" id="bodyleftFrame"/>
    <frameset cols="*, 0" frameborder="no" border="0" framespacing="0">
        <frameset name="2stframe" id="2stframe" rows="0,*,0" cols="*" framespacing="0" frameborder="no" border="0">
            <!-- Template Frame for Odds Display -->
            <frame src="<?php echo base_url() ?>Livescore/head" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="topFrame"/>
            <frameset name="3stframe" id="3stframe" cols="100,*,100" framespacing="0" frameborder="no" border="0">
                <frame name="leftFrame" width="1px" id="leftFrame"/>
                <frame src="about:blank" name="mainFrame" scrolling="auto" noresize="noresize" id="mainFrame"/>
            </frameset>
            <frame name='RoutineJobs' id='RoutineJobs' src="" scrolling="No"/>
        </frameset>
        <frameset rows="0,0, 0,0,0,0,0,0,0,0,0, 0,0,0,0,0,0,0, 0,0, 0,0,0,0,0,0,0,0,0,0,0">
            <frame id='UnderOver_tmpl_1'/>
            <frame id='UnderOver_tmpl_3'/>

            <frame id='UnderOver_tmpl_1F'/>
            <frame id='UnderOver_tmpl_1H'/>


            <frame id='1X2_tmpl'/>
            <frame id='CorrectScore_tmpl'/>
            <frame id='CorrectScore_tmpl_H'/>
            <frame id='HTFTOE_tmpl'/>
            <frame id='Oe_tmpl'/>
            <frame id='Tg_tmpl'/>
            <frame id='HTFT_tmpl'/>
            <frame id='FGLG_tmpl'/>


            <frame id='Menu_tmpl'/>

            <frame id='League_tmpl'/>
        </frameset>
    </frameset>
</frameset>
<noframes></noframes>
</html>
