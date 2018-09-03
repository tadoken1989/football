
var bStandalonePlayer = false;
var isReSizeLoading = false;
var StreamingStatusIsLogin = GetIBC_IsLogin();
var isPlaySuccess = false;

var ImgServURL = '';
var CurrentHorseChannelID = '';
var CurrentLeagueID = '';
var CurrentRaceNumber = '';
var fFrame = getParent(window);

var mainplayer_Width = "";
var mainplayer_Height = "";
var singleplayer_Width = "";
var singleplayer_Height = "";

var OpenStreamingFlag = false;
var setOpenStreamingTimer = null;

function ChkOpener() {
    if (window.opener == null) {
        window.open('', '_self', '');
        window.opener = null;
        window.close();
    }
}
function CloseWindow() {
    window.opener = null;
    window.close();
}

function getParent(cFrame) {
    var aFrame = cFrame;
    for (var i = 0; i < 4; i++) {
        if (aFrame.SiteMode != null) {
            return aFrame;
        } else {
            if (aFrame.parent != null) {
                aFrame = aFrame.parent;
            } else {
                return null;
            }
        }
    }
    return null;
}

function StandalonePlayer() {

    window.moveTo(0, 0);
    var bIsLogin = GetIBC_IsLogin();

    if ((!bIsLogin && SiteID != "4200800") ||
      (!bIsLogin && SiteID == "4200800" && ScheduleType != '161')) {
        alert(err_mainWindowClosed);
        if (fFrame != null && fFrame.IsCssControl) {
            window.FrameValidation.location.href = ImgServURL + TVImagePath;
        }
        else {
            window.FrameValidation.location.href = ImgServURL + SkinPath + 'images/tv_image.jpg';
        }

        window.opener = null;
        window.open("", "_self");
        window.close();
        return;
    }
    var iMin = document.getElementById('mintxtdiv');
    var iMax = document.getElementById('maxtxtdiv');
    iMin.disabled = true;
    iMax.disabled = true;

    if (document.getElementById('containerhead').style.display == "block") {
        bStandalonePlayer = true;

        document.getElementById('containerhead').style.display = "none";
        document.getElementById('containerhead').style.visibility = "hidden";
        document.getElementById('containerleft').style.display = "none";
        document.getElementById('containerleft').style.visibility = "hidden";
        var FooterElement = document.getElementById('footer');
        if (typeof (FooterElement) != 'undefined' && FooterElement != null) {
            document.getElementById('footer').style.display = "none";
            document.getElementById('footer').style.visibility = "hidden";
        }

        // Change the image in the control
        document.getElementById('minimgdiv').style.display = "none";
        document.getElementById('minimgdiv').style.visibility = "hidden";
        document.getElementById('maximgdiv').style.display = "block";
        document.getElementById('maximgdiv').style.visibility = "visible";
        document.getElementById('mintxtdiv').style.display = "none";
        document.getElementById('mintxtdiv').style.visibility = "hidden";
        document.getElementById('maxtxtdiv').style.display = "block";
        document.getElementById('maxtxtdiv').style.visibility = "visible";
        document.getElementById('blueArea').style.display = "none"; 
    }else{
        bStandalonePlayer = false;
        document.getElementById('containerhead').style.display = "block";
        document.getElementById('containerhead').style.visibility = "visible";
        document.getElementById('containerleft').style.display = "";
        document.getElementById('containerleft').style.visibility = "visible";
        var FooterElement = document.getElementById('footer');
        if (typeof (FooterElement) != 'undefined' && FooterElement != null) {
            document.getElementById('footer').style.display = "block";
            document.getElementById('footer').style.visibility = "visible";
        }
        // Change the image in the control
        document.getElementById('minimgdiv').style.display = "block";
        document.getElementById('minimgdiv').style.visibility = "visible";
        document.getElementById('maximgdiv').style.display = "none";
        document.getElementById('maximgdiv').style.visibility = "hidden";
        document.getElementById('mintxtdiv').style.display = "block";
        document.getElementById('mintxtdiv').style.visibility = "visible";
        document.getElementById('maxtxtdiv').style.display = "none";
        document.getElementById('maxtxtdiv').style.visibility = "hidden";
        document.getElementById('blueArea').style.display = "block";

        if (ScheduleType != undefined) {
            if (ScheduleType == "151" || ScheduleType == "152" || ScheduleType == "153") {
                document.getElementById("leftcont").src = "StreamingSchedule.aspx?Type=" + ScheduleType;
                window.leftcont.location.href = 'StreamingSchedule.aspx?Type=' + ScheduleType;
            } else if (ScheduleType == "161") {
                document.getElementById("leftcont").src = "StreamingSchedule.aspx?Type=161";
                window.leftcont.location.href = 'StreamingSchedule.aspx?Type=161';
            } else {
                document.getElementById("leftcont").src = "StreamingSchedule.aspx?Type=1";
                window.leftcont.location.href = 'StreamingSchedule.aspx?Type=1';
            }
        }
    }

    if (mainplayer_Width != "" && mainplayer_Height != "" && singleplayer_Width != "" && singleplayer_Height != "") {
        ResizeByXY(bStandalonePlayer, singleplayer_Width, singleplayer_Height, mainplayer_Width, mainplayer_Height);
    } else {
        Resize(bStandalonePlayer);
    }
    iMin.disabled = false;
    iMax.disabled = false;
}

function Resize(bSmall) {
    try {

        //window.scroll(0,0);
        var bIsLogin = GetIBC_IsLogin();

        if (!isReSizeLoading && bIsLogin) {
            var fFrame = getParent(window.opener);
            ImgServURL = fFrame.imgServerURL;
        }

        if ((!bIsLogin && SiteID != "4200800") ||
            (!bIsLogin && SiteID == "4200800" && ScheduleType != '161')) {
            if (fFrame != null && fFrame.IsCssControl) {
                window.FrameValidation.location.href = ImgServURL + TVImagePath;
            } else {
                window.FrameValidation.location.href = ImgServURL + SkinPath + 'images/tv_image.jpg';
            }
        } else {
            document.DataForm.submit();
        }

        AdjustSize(bSmall);
        document.getElementById('containerMain').style.width = "100%";
        document.getElementById('containerMain').style.height = "100%";
        //resetSlidePosition();
        isReSizeLoading = true;
    } catch (err) {

    }
}

function AdjustSize(bSmall) {
    if (document.getElementById("HorseChannelID").value == "5") {
        $("body").removeClass('maxWin');
        $("body").removeClass('miniWin');


        if (bSmall == true) {

            $("body").addClass('double miniWin');
			try{
				window.resizeTo(1070, 590)
				window.outerWidth = 1085;
				window.outerHeight = 590;
			}catch(e){
				setTimeout("ResizeIE(1070,590,1085,590)", 1000);
			}
        } else {
            $("body").addClass('double');
            //window.moveTo(0, window.screenY);
            try {
                window.resizeTo(1340, 710)
                window.outerWidth = 1355;
                window.outerHeight = 710;
            } catch (e) {
                setTimeout("ResizeIE(1345,710,1355,710)", 1000);
            }
        }
    } else if (document.getElementById("StreamingSrc").value == "3" && document.getElementById("HorseChannelID").value != "5") {
        $("body").removeClass('maxWin');
        $("body").removeClass('miniWin');
		$("body").removeClass('double');
		document.getElementById("FrameValidation").width = 484;
		if (bSmall == true) {
				$("body").addClass('miniWin');
				try{
					window.resizeTo(550, 590) //euro 590 chg to 570
					window.outerWidth = 565;
					window.outerHeight = 590;  //euro 590 chg to 570
				}catch(e){
					setTimeout("ResizeIE(550,590,565,590)", 1000);
				}
		} else {
			try {
					window.resizeTo(820, 700)
					window.outerWidth = 825;
					window.outerHeight = 700;
				}catch (e) {
					setTimeout("ResizeIE(820,700,825,700)", 1000);
				}
		}		
    }else {
        $("body").removeClass('double');
        $("body").removeClass('double miniWin');
        $("body").removeClass('maxWin');
        $("body").removeClass('maxWin miniWin');
        if (document.getElementById("StreamingSrc").value == "8" && document.getElementById("FrameValidation").width != 484) {
            if (bSmall == true) {
                $("body").addClass('maxWin miniWin');
                try {
                    window.resizeTo(750, 590);
                    window.outerWidth = 765;
                    window.outerHeight = 590;
                }
                catch (e) {
                    setTimeout("ResizeIE(750,590,765,590)", 1000);
                }
            }
            else {
                $("body").addClass('maxWin');
                try {
                    window.resizeTo(1005, 700);
                    window.outerWidth = 1010;
                    window.outerHeight = 700;
                }
                catch (e) {
                    setTimeout("ResizeIE(1005,700,1010,700)", 1000);
                }
            }
    } else if (document.getElementById("StreamingSrc").value == "9" && document.getElementById("FrameValidation").width != 484) {
        if (bSmall == true) {
            $("body").addClass('wbWin miniWin');
            try {
                window.resizeTo(665, 650);
                window.outerWidth = 675;
                window.outerHeight = 650;
            } catch (e) {
                setTimeout("ResizeIE(665,650,675,650)", 1000);
            }
        }
        else {
            $("body").addClass('wbWin');
            try {
                window.resizeTo(930, 740);
                window.outerWidth = 945;
                window.outerHeight = 740;
            } catch (e) {
                setTimeout("ResizeIE(930,740,945,740)", 1000);
            }
        }	

        } else {
            if (bSmall == true) {
                $("body").addClass('miniWin');
				   var winWidth = 500;
				   var winouterWidth = 505;
				   if (document.getElementById("bingoMode").value == "true" && document.getElementById("StreamingSrc").value == "5" ) {
					   winWidth = 1030;
					   winouterWidth = 1045;
				   }
                try{
					window.resizeTo(winWidth, 590) //euro 590 chg to 570
					window.outerWidth = winouterWidth;
					window.outerHeight = 590;  //euro 590 chg to 570
				}catch(e){
					setTimeout("ResizeIE(550,590,565,590)", 1000);
				}
            } else {
				var MainWidth = 820;
				var MainouterWidth = 825;
				if (document.getElementById("bingoMode").value == "true" && document.getElementById("StreamingSrc").value == "5") {
					$("body").addClass('double');
					MainWidth = 1340;
					MainouterWidth = 1355;
				}
                try {
                    window.resizeTo(MainWidth, 700)
                    window.outerWidth = MainouterWidth;
                    window.outerHeight = 700;
                } catch (e) { 
					setTimeout("ResizeIE(" + MainWidth + ",700," + MainouterWidth + ",700)", 1000);
                }
            }
        }
    }
}

function ResizeByXY(bSmall, sW, sH, mW, mH) {
    try {

        //window.scroll(0,0);
        var bIsLogin = GetIBC_IsLogin();

        if (!isReSizeLoading && bIsLogin) {
            var fFrame = getParent(window.opener);
            ImgServURL = fFrame.imgServerURL;
        }

        if ((!bIsLogin && SiteID != "4200800") ||
            (!bIsLogin && SiteID == "4200800" && ScheduleType != '161')) {
            if (fFrame != null && fFrame.IsCssControl) {
                window.FrameValidation.location.href = ImgServURL + TVImagePath;
            } else {
                window.FrameValidation.location.href = ImgServURL + SkinPath + 'images/tv_image.jpg';
            }
        } else {
            document.DataForm.submit();
        }

        singleplayer_Width = sW;
        singleplayer_Height = sH;
        mainplayer_Width = mW;
        mainplayer_Height = mH;

        if (bSmall == true) {
            window.resizeTo(sW, sH);
            window.outerWidth = sW;
            window.outerHeight = sH;
        } else {
            window.resizeTo(mW, mH);
            window.outerWidth = mW;
            window.outerHeight = mH;
        }
        document.getElementById('containerMain').style.width = "100%";
        document.getElementById('containerMain').style.height = "100%";

        //resetSlidePosition();
        isReSizeLoading = true;
    } catch (err) {

    }
}

function ResizeIE(x, y, w, h) {
    try {
        window.resizeTo(x, y);
        window.outerWidth = w;
        window.outerHeight = h;
    }
    catch (e) { }
}

function Resize1(bSmall) {
    if ((bSmall == false && document.getElementById('containerhead').style.display != "block") || (bSmall == true && document.getElementById('containerhead').style.display == "block")) {
        StandalonePlayer()
    }
}

function SetTitle(LinkType, TitleTxt) {

    document.getElementById("GreyhoundsContainer").style.display = "none";
    document.getElementById("SportsContainer").style.display = "block";
    document.getElementById('left_title').innerHTML = TitleTxt;
    document.getElementById('Button1').style.display = (LinkType == '0' ? '' : 'none')
}

function Refresh_List() {
    var bIsLogin = GetIBC_IsLogin();
    if (StreamingStatusIsLogin != bIsLogin){
       // window.location.href=parentUrl;
       CloseWindow();
    } else {
        if (ScheduleType == "151" || ScheduleType == "152" || ScheduleType == "153") {
            window.leftcont.location.href = 'StreamingSchedule.aspx?Type=' + ScheduleType;
        } else if (ScheduleType == "161") {
            window.leftcont.location.href = 'StreamingSchedule.aspx?Type=161';
        } else {
            window.leftcont.location.href = 'StreamingSchedule.aspx?Type=1';
        }
    }
    StreamingStatusIsLogin = bIsLogin;
    //window.leftcont.location.href='StreamingSchedule.aspx' + (GetIBC_IsLogin() ? '' : '?MainIsClose=1');
}

function AutoRefreshLoginCheckin() {
    var bIsLogin = GetIBC_IsLogin();

    if ((StreamingStatusIsLogin != bIsLogin && SiteID != "4200800") ||
        (StreamingStatusIsLogin != bIsLogin && SiteID == "4200800" && ScheduleType != '161')) {
        if (!bIsLogin) {
            alert(err_mainWindowClosed);

            if (fFrame != null && fFrame.IsCssControl) {
                window.FrameValidation.location.href = ImgServURL + TVImagePath;
            }
            else {
                window.FrameValidation.location.href = ImgServURL + SkinPath + 'images/tv_image.jpg';
            }
            window.opener = null;
            window.open("", "_self");
            window.close();
        }
    } else {
        var obj = document.getElementById('containerleft');
        if (obj != null && obj.style.display == 'block') {
            var scheduleFrame = document.getElementById("leftcont");
            if (scheduleFrame != null) {
                document.getElementById("leftcont").contentWindow.location.reload(true);
            }
        }
    }
    StreamingStatusIsLogin = bIsLogin;
}

function GetIBC_IsLogin() {
    try {
        if (mainWindowIsClosed()) {
            return false;
        }
	
//window.opener.IsUserStreaming use for non-deposit but login can see streaming function
        return (window.opener.IsLogin || window.opener.IsUserStreaming);
    }
    catch (e) {
        return false;
    }
}

function mainWindowIsClosed() {
    return window.opener == null || window.opener.closed;
}

function swapHorseStreaming(HorseChannelID, LeagueID, RaceNumber) {
    if (CurrentHorseChannelID != "2" && CurrentHorseChannelID != "3") {
        if (isHorseStreaming && CurrentHorseChannelID != HorseChannelID) {
            SetLoadVideoLocation("9999", "3", HorseChannelID, LeagueID, RaceNumber);
        }
    } else {
        if (isHorseStreaming && (CurrentLeagueID != LeagueID || CurrentRaceNumber != RaceNumber)) {
            SetLoadVideoLocation("9999", "3", HorseChannelID, LeagueID, RaceNumber);
        }
    }
}

var hTVbuttonPush = false;

function hTVbuttonTimmerCheck() {
    if (hTVbuttonPush == false) {
        hTVbuttonPush = true;
        setTimeout(function () { if (hTVbuttonPush == true) { hTVbuttonPush = false }; }, 5000);
        return true;
    }
    else {
        return false;
    }
}

function OpenHorseStreaming() {
    CloseTVBox();

    if (!hTVbuttonTimmerCheck()) {
        return;
    }

    var obj = document.getElementById("HorseChannelID");
    if (obj != null) {
        openRacingStreaming("151");
       //fFrame.StreamingFrame.focus();
    }
}

var hTV_euroButtonPush = false;

function hTV_euroButtonTimmerCheck() {
    if (hTV_euroButtonPush == false) {
        hTV_euroButtonPush = true;
        setTimeout(function () { if (hTV_euroButtonPush == true) { hTV_euroButtonPush = false }; }, 5000);
        return true;
    }
    else {
        return false;
    }
}

function EuroOpenGreyhoundsStreaming() {
    CloseTVBox();
    if (!GreyTV_ButtonTimmerCheck()) {
        return;
    }

    var obj = document.getElementById("HorseChannelID");
    if (obj != null) {
        if (obj.value == "5") {
            EuroOpenRacingStreaming("152");
        } else {
            if (fFrame.StreamingFrame != null && !fFrame.StreamingFrame.closed) {
                EuroSwitchGreyhoundsStreaming();
            } else {
                fFrame.StreamingFrame = fFrame.window.open("../StreamingFrame.aspx", "StreamingFrame", "top=20,left=20,height=680,width=810,status=no,toolbar=no,menubar=no,resizable=yes,location=no,scrollbars=no");
                setTimeout("fFrame.StreamingFrame.ShowGreyhoundsContainer()", 1000);
                setTimeout("EuroSwitchGreyhoundsStreaming()", 1500);
            }
        }
        //	  var HorseChannelID = obj.value;
        //	  var StreamingSrc ="7";
        //	  if(HorseChannelID == 5)
        //      StreamingSrc = "3";
        //	  if (window.top.StreamingFrame == null || window.top.StreamingFrame.closed)
        //	  {
        //	    window.top.StreamingFrame = window.open("../StreamingFrame.aspx?Matchid=9999&StreamingSrc=" + StreamingSrc + "&HorseChannelID="+HorseChannelID, "StreamingFrame", "top=200,left=300,height=485,width=525,status=no,toolbar=no,menubar=no,resizable=yes,location=no");
        //	  }

    }
}

function EuroOpenHorseStreaming() {
    CloseTVBox();

    if (!hTVbuttonTimmerCheck()) {
        return;
    }

    var HorseChannelID = document.getElementById("HorseChannelID");
    var LeagueID = document.getElementById("RacingLeagueID");
    var RaceNumber = document.getElementById("RacingRaceNumber");
    if (HorseChannelID != null) {
        var StreamingSrc = "3";
        if (window.top.StreamingFrame == null || window.top.StreamingFrame.closed) {
            window.top.StreamingFrame = window.open("../StreamingFrame.aspx?Matchid=9999&StreamingSrc=" + StreamingSrc + "&HorseChannelID=" + HorseChannelID.value + "&RacingLeagueID=" + LeagueID.value + "&RacingRaceNumber=" + RaceNumber.value
            , "StreamingFrame", "top=200,left=300,height=485,width=525,status=no,toolbar=no,menubar=no,resizable=yes,location=no");
        } else {
            window.top.StreamingFrame.isHorseStreaming = true;
            window.top.StreamingFrame.swapHorseStreaming(HorseChannelID, LeagueID, RaceNumber);
        }
        window.top.StreamingFrame.focus();
    }
}

function EuroOpenHarnessStreaming() {
    CloseTVBox();

    if (!hTVbuttonTimmerCheck()) {
        return;
    }

    var obj = document.getElementById("HorseChannelID");
    if (obj != null) {
        var HorseChannelID = obj.value;
        var StreamingSrc = "3";
        if (fFrame.StreamingFrame == null || fFrame.StreamingFrame.closed) {
            fFrame.StreamingFrame = window.open("../StreamingFrame.aspx?Matchid=9999&StreamingSrc=" + StreamingSrc + "&HorseChannelID=" + HorseChannelID + "&RacingType=153", "StreamingFrame", GetEuroStreamingParameter(HorseChannelID));

        } else {
            fFrame.StreamingFrame.isHorseStreaming = true;
            fFrame.StreamingFrame.swapHorseStreaming(HorseChannelID);

        }
        fFrame.StreamingFrame.focus();
    }
}

function GetEuroStreamingParameter(HorseChannelID) {
    var Width = 525;
    var Height = GetEuroStreamingDefaultHeigth(HorseChannelID);

    if (HorseChannelID == "5") {
        switch (SiteId) {
            case "4200400": //alog
                Width = 1055;
                Height = 580;
                break;
            case "4201400": //Bodog
                Width = 1075;
                Height = 580;
                break;
            case "4201400": //12bet
                Width = 1065;
                Height = 580;
                break;
        }
    }
    return "top=20,left=20,height=" + Height + ",width=" + Width + ",status=no,toolbar=no,menubar=no,resizable=yes,location=no,scrollbars=no";
}

function GetEuroStreamingDefaultHeigth(HorseChannelID) {
    if (HorseChannelID == "153") return 485;
    else return 520;
}

function ChagneHorseStream(strHorseChannelID, strLeagueID, strRaceNumber) {
    var RacingType = fFrame.LastSelectedSport;
    $('#HorseChannelID').val(strHorseChannelID);
    $('#RacingLeagueID').val(strLeagueID);
    $('#RacingRaceNumber').val(strRaceNumber);

    if (getStreamingFrameHandle() != null && !getStreamingFrameHandle().closed) {
        if (strHorseChannelID == "6") {
            if (getStreamingFrameHandle().CurrentHorseChannelID != strHorseChannelID) {
                switchGreyhoundsStreaming();
                getStreamingFrameHandle().CurrentHorseChannelID = strHorseChannelID;
            }
        } else {
            getStreamingFrameHandle().isHorseStreaming = true;
            getStreamingFrameHandle().ScheduleType = RacingType;
            getStreamingFrameHandle().swapHorseStreaming(strHorseChannelID, strLeagueID, strRaceNumber);    //add by stan
            getStreamingFrameHandle().ShowHorseRacingSchule(parseInt(RacingType,10));
        }
    }
}

function ChagneBingoStream() {
    if (getStreamingFrameHandle() != null && !getStreamingFrameHandle().closed) {
        getStreamingFrameHandle().isHorseStreaming = false;
        getStreamingFrameHandle().ScheduleType = "161";
        getStreamingFrameHandle().swapBingoStreaming();
        getStreamingFrameHandle().ShowNumberGameSchule();
    }
}

function EuroChagneHorseStream(strHorseChannelID, strLeagueID, strRaceNumber) {
    var obj = document.getElementById("HorseChannelID");
    var RacingType = fFrame.LastSelectedSport;

    if (obj != null) {
        obj.value = strHorseChannelID;
        $('#RacingLeagueID').val(strLeagueID);
        $('#RacingRaceNumber').val(strRaceNumber);
    } else {
        //update by stan setTimeout("EuroChagneHorseStream('" + strHorseChannelID + "',100)");
        setTimeout("EuroChagneHorseStream('" + strHorseChannelID + "','" + strLeagueID + "','" + strRaceNumber + "')", 100);    //add by stan
        return;
    }

    if (StreamingFrame != null && !StreamingFrame.closed) {
        StreamingFrame.swapHorseStreaming(strHorseChannelID, strLeagueID, strRaceNumber);
        StreamingFrame.ShowHorseRacingSchule(RacingType);
    }
}

function swapBingoStreaming() {
    SetLoadVideoLocation('9999', '5', '0', '0', '0');
}

function SetLoadVideoLocation(Matchid, StreamingSrc, HorseChannelID, RacingLeagueID, RacingRaceNumber) {
    HorseChannelID = HorseChannelID || "0";
    RacingLeagueID = RacingLeagueID || "0";
    RacingRaceNumber = RacingRaceNumber || "0";

    if ((StreamingSrc=="3" && HorseChannelID != "5")  || (StreamingSrc == "1" || StreamingSrc == "4" || StreamingSrc == "9")){
        document.getElementById("FrameValidation").width = 484;
    }
	
    if (StreamingSrc == "5") {
        if (document.getElementById("bingoMode").value == "true" ) {
            document.getElementById("FrameValidation").width = 978;
        }
        else {
            document.getElementById("FrameValidation").width = 484;
        }
	}

    if (HorseChannelID != "2" && HorseChannelID != "3") {
        if (isPlaySuccess && document.getElementById('Matchid').value == Matchid
       && document.getElementById('StreamingSrc').value == StreamingSrc
       && document.getElementById('HorseChannelID').value == HorseChannelID)
            return;
    } else {
        if (document.getElementById('StreamingSrc').value == StreamingSrc
       && document.getElementById('HorseChannelID').value == HorseChannelID
       && document.getElementById('RacingLeagueID').value == RacingLeagueID
       && document.getElementById('RacingRaceNumber').value == RacingRaceNumber)
            return;
    }

    if (document.getElementById('containerhead').style.display != "none") {
        bStandalonePlayer = false;
    } else { bStandalonePlayer = true; }

    if ((Matchid != '' && GetIBC_IsLogin()) ||
        (Matchid != '' && !GetIBC_IsLogin() && SiteID == "4200800" && ScheduleType == '161')) {
        if (document.getElementById('Matchid') != null
            && document.getElementById('StreamingSrc') != null
            && document.getElementById('HorseChannelID') != null) {
            document.getElementById('Matchid').value = Matchid;
            document.getElementById('StreamingSrc').value = StreamingSrc;
            document.getElementById('HorseChannelID').value = HorseChannelID;
            document.getElementById('RacingLeagueID').value = RacingLeagueID;
            document.getElementById('RacingRaceNumber').value = RacingRaceNumber;
            document.DataForm.submit();
            AdjustSize(bStandalonePlayer);
        }
    } else {
        //document.getElementById('ChannelCrl').style.display='none';
        if (fFrame != null && fFrame.IsCssControl) {
            window.FrameValidation.location.href = ImgServURL + TVImagePath;
        }
        else {
            window.FrameValidation.location.href = ImgServURL + SkinPath + 'images/tv_image.jpg';
        }
        AdjustSize(bStandalonePlayer);
    }
}
window.focus();
//OddsUtils.js START

function getStreamingHtml(pMatchid, pStreamingId, pIsLive) {
    if (!fFrame.CanSeeSportStreaming) {
        return "";
    }
    if (pStreamingId == 0) {
        return "";
    }

    if (fFrame.SiteMode == 1) {
        return "";
	}
    //var obj=document.getElementById("cm-nav");
    if (pIsLive && fFrame.IsUserStreaming) {
        return "<div class='icon displayOn'><span class='tv' onclick=openSingleStreaming(" + pMatchid + ",0)></span></div>";

    } else {
        if (fFrame.SiteId == "4200800") {
            return "<div class='icon displayOn'><span class='tv off' ></span></div>";
        } else if (fFrame.SiteId == "4200100") {//only shows tv icon
            return "<div class='icon displayOn'><span class='tv off' ></span></div>";
        } else if (fFrame.IsUserStreaming) {
            return "<div class='icon displayOn'><span class='tv off' ></span></div>";
        }
    }
}


function OpenStreamingMenu(pMatchid) {
    if (document.getElementById("tv" + pMatchid).innerHTML == "") {
        document.getElementById("tv" + pMatchid).innerHTML = getStreamingMenuHtml(pMatchid);
    }
    document.getElementById("tv" + pMatchid).style.display = "block";
}
function CloseStreamingMenu(pMatchid) {
    var obj = document.getElementById("cm-nav");
    if (obj != null) {
        var obj1 = document.getElementById("tv" + pMatchid);
        if (obj1 != null) {
            obj1.style.display = "none";
        }
    }
}
function getStreamingMenuHtml(pMatchid) {
    var obj = document.getElementById("cm-nav");
    if (obj != null) {
        var mHtml = obj.innerHTML;
        mHtml = mHtml.replace(/#L/, "javascript:openSingleStreaming(" + pMatchid + ",0);");
        mHtml = mHtml.replace(/#S/, "javascript:openSingleStreaming(" + pMatchid + ",1);");
        return mHtml;
    } else {
        return "";
    }
}
function getBingoStreamingHtml() {
    if (fFrame.SiteId == "4200800") {
        return "<a id='bTV' href='javascript:openBingoStreaming();'><img border='0' src='" + fFrame.imgServerURL + fFrame.SkinRootPath + "public/images/layout/tv_L.gif' hspace='1' /></a>";
    } else if (fFrame.IsCssControl) {
        return "<div class='icon displayOn'><span class='tv' onclick=openBingoStreaming()></span></div>";
    } else {
        return "<div class='icon displayOn'><span class='tv' onclick=openBingoStreaming()></span></div>";
    }
}
function ReflashSingleStreaming() {
    if (fFrame.leftFrame != null) {
        var obj1 = fFrame.leftFrame.document.getElementById("iTV");
        var url = obj1.src;
        obj1.src = "";
        obj1.src = url;
    }
}
function SwitchSingleStreaming() {
    if (fFrame.leftFrame != null) {
        var obj1 = fFrame.leftFrame.document.getElementById("iTV");
        var Matchid = obj1.src;
        Matchid = Matchid.substr(Matchid.indexOf("StreamingLV.aspx"));
        Matchid = Matchid.replace("StreamingLV.aspx?Matchid=", "");
        Matchid = Matchid.replace("&TVmode=small", "");
        CloseTVBox();
        openSingleStreaming(Matchid, 0);
    }
}

var SingleTV_ButtonPush = false;

function SingleTV_ButtonTimmerCheck() {
    if (SingleTV_ButtonPush == false) {
        SingleTV_ButtonPush = true;
        setTimeout(function () { if (SingleTV_ButtonPush == true) { SingleTV_ButtonPush = false }; }, 5000);
        return true;
    } else {
        return false;
    }
}

function openSingleStreaming(pMatchid, TVMode) {
    openSingleStreamingMain(pMatchid, TVMode);
}

function openSingleStreamingMain(pMatchid, TVMode) {
    //TVMode 0:Default(Single) 1:small 2:mini
    if (!SingleTV_ButtonTimmerCheck()) {
        return;
    }
    CloseStreamingMenu(pMatchid);
    switch (TVMode) {
        case 0:
             CloseTVBox();
             var callbackfunc=function(Handle,isNewOpen){
                if(Handle!=null && !isNewOpen){
					try	{
						Handle.SetLoadVideoLocation(pMatchid,'1','0','0','0');
					}catch(e)
					{}
                }
            };
            fFrame.openWindowsHandle("StreamingFrame",
                                    true,
                                    "",
                                    "StreamingFrame.aspx?Matchid=" + pMatchid ,
                                    "top=20,left=20,height=520,width=525,status=no,toolbar=no,menubar=no,resizable=yes,location=no,scrollbars=yes",
                                    false,
                                    callbackfunc
                                    );
            break;
        case 1:
            var Handle = fFrame.getOpenWindowsHandle("StreamingFrame");
            if (Handle != null && !Handle.closed) {
                Handle.CloseWindow();
            }
            CloseTVBox();
            if (fFrame.topFrame.document.getElementById("showhideleft").className == "show_left") {
                fFrame.topFrame.SwitchShowHidLeft();
                fFrame.topFrame.SwitchLefthideshow();
            }
            if (fFrame.leftFrame != null) {
                var obj1 = fFrame.leftFrame.document.getElementById("iTV");
                obj1.src = "StreamingLV.aspx?Matchid=" + pMatchid + "&TVmode=small";
            }
            break;
        case 2:
            break;
    }
}

var BingoTV_ButtonPush = false;

function BingoTV_ButtonTimmerCheck() {
    if (BingoTV_ButtonPush == false) {
        BingoTV_ButtonPush = true;
        setTimeout(function () { if (BingoTV_ButtonPush == true) { BingoTV_ButtonPush = false }; }, 5000);
        return true;
    } else {
        return false;
    }
}

function openBingoStreaming() {
    CloseTVBox();

    if (!BingoTV_ButtonTimmerCheck()) {
        return;
    }

    openBingoStreamingMain();
}

function openBingoStreamingMain() {

    if (CanOpenStreaming()) {
        CloseTVBox();
        var callbackfunc = function (Handle, isNewOpen) {
            if (Handle != null) {

                Handle.isHorseStreaming = false;
                Handle.ScheduleType = "161";
                if (!isNewOpen) {
                    Handle.ShowNumberGameSchule();
                    Handle.swapBingoStreaming();
                }
            }
        };
        fFrame.openWindowsHandle("StreamingFrame",
                                true,
                                "",
                                "StreamingFrame.aspx?Matchid=9999&StreamingSrc=5",
                                "top=20,left=20,height=520,width=1030,status=no,toolbar=no,menubar=no,resizable=yes,location=no,scrollbars=no",
                                false,
                                callbackfunc
                                );
    }
}

function CloseTVBox() {
    if (fFrame == null) {
        return;
	}

    if (fFrame.leftFrame != null) {
        var obj1 = fFrame.leftFrame.document.getElementById("iTV");
        if (obj1 != null) {
            obj1.src = "";
        }
        var obj2 = fFrame.leftFrame.document.getElementById("TVBox");
        if (obj2 != null) {
            obj2.style.display = "none";
        }
        var obj3 = fFrame.leftFrame.document.getElementById("div_Casino");
        if (obj3 != null) {
            obj3.style.display = "";
        }
    }
}
//OddsUtils.js END
//common.js START

var hTVHead_ButtonPush = false;

function hTVHead_ButtonTimmerCheck() {
    if (hTVHead_ButtonPush == false) {
        hTVHead_ButtonPush = true;
        setTimeout(function () { if (hTVHead_ButtonPush == true) { hTVHead_ButtonPush = false }; }, 5000);
        return true;
    } else {
        return false;
    }
}

function openStreaming(pStreamingId) {
    CloseTVBox();
    if (!hTVHead_ButtonTimmerCheck()) {
        return;
    }
    openStreamingMain();
}

function openStreamingMain() {
    CloseTVBox();
    var iTV = topFrame.document.getElementById("iTV");
    if (iTV != null) {
        iTV.disabled = true;
        iTV.href = "JavaScript:void(0);";
        var callbackfunc = function (Handle, isNewOpen) {
            if (Handle != null && !isNewOpen) {
                if (Handle.document.getElementById('containerhead') != null) {
                    if (Handle.document.getElementById('containerhead').style.display == "none") {
                        Handle.StandalonePlayer();
                    }
                }
                if (userBrowser() == "Chrome")
                    Handle.blur();
                else
                    Handle.focus();
            }
            iTV.href = "JavaScript:fFrame.openStreamingMain();";
            iTV.disabled = false;

        };
    }

    fFrame.openWindowsHandle("StreamingFrame",
                            true,
                            "",
                            "StreamingFrame.aspx",
                            "top=20,left=20,height=612,width=818,status=no,toolbar=no,menubar=no,resizable=yes,location=no,scrollbars=no",
                            false,
                            callbackfunc
                            );
}

//common.js END
//menu.js START
function CloseHorseInfoPopWindow() {
    try {
        if (HorseInfoPopWindow != null && HorseInfoPopWindow.open) {
            HorseInfoPopWindow.close();
            HorseInfoPopWindow = null;
        }

        if (getStreamingFrameHandle() != null || getStreamingFrameHandle().open) {
            getStreamingFrameHandle().close();
            fFrame.windowsHandle["StreamingFrame"] = null;
        }
    } catch (e) {
    }
}

var hTVBingo_ButtonPush = false;

function hTVBingo_ButtonTimmerCheck() {
    if (hTVBingo_ButtonPush == false) {
        hTVBingo_ButtonPush = true;
        setTimeout(function () { if (hTVBingo_ButtonPush == true) { hTVBingo_ButtonPush = false }; }, 5000);
        return true;
    } else {
        return false;
    }
}

function OpenNumberGameStreaming() {
    CloseTVBox();

    if (!hTVBingo_ButtonTimmerCheck()) {
        return;
    }
    openBingoStreamingMain();
}

//menu.js END
var GreyTV_ButtonPush = false;

function GreyTV_ButtonTimmerCheck() {
    if (GreyTV_ButtonPush == false) {
        GreyTV_ButtonPush = true;
        setTimeout(function () { if (GreyTV_ButtonPush == true) { GreyTV_ButtonPush = false }; }, 5000);
        return true;
    } else {
        return false;
    }
}

function OpenGreyhoundsStreaming() {
    CloseTVBox();

    if (!GreyTV_ButtonTimmerCheck()) {
        return;
    }

    fFrame = getParent(window);
    var obj = document.getElementById("HorseChannelID");
    if (obj != null) {
        if (obj.value == "5") {
            openRacingStreaming("152");
        } else {
            if (CanOpenStreaming()) {
                var callbackfunc = function (Handle, isNewOpen) {
                    if (Handle != null) {
                        if (isNewOpen) {
                            setTimeout("getStreamingFrameHandle().ShowGreyhoundsContainer();", 1000);
                            setTimeout("switchGreyhoundsStreaming();", 1500);
                        } else {
                            switchGreyhoundsStreaming();
                        }
                    }

                };

                fFrame.openWindowsHandle("StreamingFrame",
                                            true,
                                            "",
                                            "StreamingFrame.aspx",
                                            "top=20,left=20,height=680,width=825,status=no,toolbar=no,menubar=no,resizable=yes,location=no,scrollbars=yes",
                                            false,
                                            callbackfunc
                                            );
            }
        }
    }
}

function EuroOpenRacingStreaming(RacingType) {
    var StreamingSrc = "3";
    var obj = document.getElementById("HorseChannelID");
    var HorseChannelID = obj.value;

    if (fFrame.StreamingFrame == null || fFrame.StreamingFrame.closed) {
        fFrame.StreamingFrame = fFrame.window.open("../StreamingFrame.aspx?Matchid=9999&StreamingSrc=" + StreamingSrc + "&RacingType=" + RacingType + "&HorseChannelID=" + HorseChannelID, "StreamingFrame", GetEuroStreamingParameter(HorseChannelID));
        fFrame.StreamingFrame.isHorseStreaming = true;
        fFrame.StreamingFrame.ScheduleType = RacingType;
    } else {
        fFrame.StreamingFrame.isHorseStreaming = true;
        fFrame.StreamingFrame.ScheduleType = RacingType;
        fFrame.StreamingFrame.swapHorseStreaming(HorseChannelID);
    }
}

var HarnTV_ButtonPush = false;

function HarnTV_ButtonTimmerCheck() {
    if (HarnTV_ButtonPush == false) {
        HarnTV_ButtonPush = true;
        setTimeout(function () { if (HarnTV_ButtonPush == true) { HarnTV_ButtonPush = false }; }, 5000);
        return true;
    } else {
        return false;
    }
}

function OpenHarnessStreaming() {
    CloseTVBox();

    if (!HarnTV_ButtonTimmerCheck()) {
        return;
    }

    openRacingStreaming("153");
}

function CanOpenStreaming() {
    if (!OpenStreamingFlag) {
        OpenStreamingFlag = true;
        if (typeof (setOpenStreamingTimer) != "undefined") {
            clearTimeout(setOpenStreamingTimer);
		}
        setOpenStreamingTimer = setTimeout("ReSetStreamingFlag()", 3000);
        return true;
    } else {
        return false;
    }
}

function ReSetStreamingFlag() {
    OpenStreamingFlag = false;
}

function openRacingStreaming(RacingType) {
    if (CanOpenStreaming()) {
        var StreamingSrc = "3";
        var HorseChannelID = document.getElementById("HorseChannelID").value;
        var RacingLeagueID = document.getElementById("RacingLeagueID").value;
        var RacingRaceNumber = document.getElementById("RacingRaceNumber").value;
        fFrame = getParent(window);
        fFrame.openRacingStreamingMain(RacingType, HorseChannelID, RacingLeagueID, RacingRaceNumber);
    }
}

function openRacingStreamingMain(RacingType, HorseChannelID, LeagueID, RaceNumber) {
    var StreamingSrc = "3";
    var callbackfunc = function (Handle, isNewOpen) {
        if (Handle != null) {

            Handle.isHorseStreaming = true;
            Handle.ScheduleType = RacingType;
            if (!isNewOpen) {
                Handle.ShowHorseRacingSchule(RacingType);
                Handle.swapHorseStreaming(HorseChannelID, LeagueID, RaceNumber);
            }
        }

    };

    if(fFrame == null) {
        fFrame = getParent(window);	
    }
    fFrame.openWindowsHandle("StreamingFrame",
                            true,
                            "",
                            "StreamingFrame.aspx?Matchid=9999&StreamingSrc=" + StreamingSrc + "&RacingType=" + RacingType + "&HorseChannelID=" + HorseChannelID + "&RacingLeagueID=" + LeagueID + "&RacingRaceNumber=" + RaceNumber,
                            "top=20,left=20,height=520,width=525,status=no,toolbar=no,menubar=no,resizable=yes,location=no,scrollbars=yes",
                            false,
                            callbackfunc
                            );


    //setTimeout("fFrame.openRacingStreamingWindow('"+RacingType+"','"+HorseChannelID+"');",1);
}

function EuroSwitchGreyhoundsStreaming() {
    bStandalonePlayer = false;
    fFrame.StreamingFrame.document.getElementById('containerhead').style.display = "block";
    fFrame.StreamingFrame.document.getElementById('containerhead').style.visibility = "visible";
    fFrame.StreamingFrame.document.getElementById('containerleft').style.display = "";
    fFrame.StreamingFrame.document.getElementById('containerleft').style.visibility = "visible";
    fFrame.StreamingFrame.document.getElementById('footer').style.display = "block";
    fFrame.StreamingFrame.document.getElementById('footer').style.visibility = "visible";

    // Change the image in the control
    if (fFrame.StreamingFrame.document.getElementById('minimgdiv') != null) {
        fFrame.StreamingFrame.document.getElementById('minimgdiv').style.display = "block";
        fFrame.StreamingFrame.document.getElementById('minimgdiv').style.visibility = "visible";
        fFrame.StreamingFrame.document.getElementById('mintxtdiv').style.display = "block";
        fFrame.StreamingFrame.document.getElementById('mintxtdiv').style.visibility = "visible";
    }
    if (fFrame.StreamingFrame.document.getElementById('maximgdiv') != null) {
        fFrame.StreamingFrame.document.getElementById('maximgdiv').style.display = "none";
        fFrame.StreamingFrame.document.getElementById('maximgdiv').style.visibility = "hidden";
        fFrame.StreamingFrame.document.getElementById('maxtxtdiv').style.display = "none";
        fFrame.StreamingFrame.document.getElementById('maxtxtdiv').style.visibility = "hidden";
    }
    fFrame.StreamingFrame.window.resizeTo(820, 760)
    fFrame.StreamingFrame.window.outerWidth = 820;
    fFrame.StreamingFrame.window.outerHeight = 760;
    fFrame.StreamingFrame.document.getElementById('containerMain').style.width = "100%";
    fFrame.StreamingFrame.document.getElementById('containerMain').style.height = "100%";
    fFrame.StreamingFrame.isHorseStreaming = false;
    fFrame.StreamingFrame.ShowGreyhoundsContainer();
    //get current meeting name
    var stadium = "";
    var obj = document.getElementById("Stadium");
    var orgSrc = "";
    if (obj != null) {
        stadium = obj.value;
    }
    orgSrc = fFrame.StreamingFrame.document.getElementById("fgreyhounds").src;
    fFrame.StreamingFrame.document.getElementById("fgreyhounds").src = orgSrc + "&stadium=" + stadium;
}

function switchGreyhoundsStreaming() {
    bStandalonePlayer = false;
    getStreamingFrameHandle().document.getElementById('containerhead').style.display = "block";
    getStreamingFrameHandle().document.getElementById('containerhead').style.visibility = "visible";
    getStreamingFrameHandle().document.getElementById('containerleft').style.display = "";
    getStreamingFrameHandle().document.getElementById('containerleft').style.visibility = "visible";

    var footerObj = getStreamingFrameHandle().document.getElementById('footer');
    if (footerObj != null) {
        footerObj.style.display = "block";
        footerObj.style.visibility = "visible";
    }

    // Change the image in the control
    if (getStreamingFrameHandle().document.getElementById('minimgdiv') != null) {
        getStreamingFrameHandle().document.getElementById('minimgdiv').style.display = "block";
        getStreamingFrameHandle().document.getElementById('minimgdiv').style.visibility = "visible";
        getStreamingFrameHandle().document.getElementById('mintxtdiv').style.display = "block";
        getStreamingFrameHandle().document.getElementById('mintxtdiv').style.visibility = "visible";
    }
    if (getStreamingFrameHandle().document.getElementById('maxtxtdiv') != null) {
        getStreamingFrameHandle().document.getElementById('maximgdiv').style.display = "none";
        getStreamingFrameHandle().document.getElementById('maximgdiv').style.visibility = "hidden";
        getStreamingFrameHandle().document.getElementById('maxtxtdiv').style.display = "none";
        getStreamingFrameHandle().document.getElementById('maxtxtdiv').style.visibility = "hidden";
    }
    getStreamingFrameHandle().window.resizeTo(820, 760)
    getStreamingFrameHandle().window.outerWidth = 820;
    getStreamingFrameHandle().window.outerHeight = 760;
    getStreamingFrameHandle().document.getElementById('containerMain').style.width = "100%";
    getStreamingFrameHandle().document.getElementById('containerMain').style.height = "100%";
    getStreamingFrameHandle().isHorseStreaming = false;
    getStreamingFrameHandle().CurrentHorseChannelID="6";
    getStreamingFrameHandle().ShowGreyhoundsContainer();
}

// open streaming window
function serviceOpenStreaming() {

    if (fFrame.StreamingFrame == null || fFrame.StreamingFrame.closed) {
        fFrame.StreamingFrame = fFrame.window.open("../StreamingFrame.aspx", "StreamingFrame", "top=200,left=300,height=630,width=800,status=no,toolbar=no,menubar=no,resizable=yes,location=no");
    } else {
        if (fFrame.StreamingFrame.height == 630) {
            fFrame.StreamingFrame.Resize(false);
            fFrame.StreamingFrame.focus();
        } else {
            fFrame.StreamingFrame.close();
            fFrame.StreamingFrame = fFrame.window.open("../StreamingFrame.aspx", "StreamingFrame", "top=200,left=300,height=630,width=800,status=no,toolbar=no,menubar=no,resizable=yes,location=no");
        }
    }
}

function openGreyhoundUKStreamingBySchedule() {
    fFrame = getParent(window);

    if (fFrame.StreamingFrame != null && !fFrame.StreamingFrame.closed) {
        switchGreyhoundsStreaming();
    } else {
        fFrame.StreamingFrame = fFrame.window.open("StreamingFrame.aspx", "StreamingFrame", "top=20,left=20,height=680,width=810,status=no,toolbar=no,menubar=no,resizable=yes,location=no,scrollbars=no");
        setTimeout("fFrame.StreamingFrame.ShowGreyhoundsContainer()", 1000);
        setTimeout("switchGreyhoundsStreaming()", 1500);
    }
    fFrame.StreamingFrame.focus();
}

function getStreamingFrameHandle() {
    if (fFrame.IsLogin) {
        return fFrame.getOpenWindowsHandle("StreamingFrame");
    } else {
        return null;
    }
}