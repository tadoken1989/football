window.onebook = 'window.onebook';
var fFrame = getParent(window);
var EnableIPadStyle = true;
function getParent(cFrame) {
    var aFrame = cFrame;
    for (var i = 0; i < 4; i++) {
        if (aFrame.SiteMode != null) {
            return aFrame;
        } else {
            aFrame = aFrame.parent;
        }
    }
    return null;
}

if (!String.prototype.format) {
    String.prototype.format = function () {
        var args = arguments;
        return this.replace(/{(\d+)}/g, function (match, number) {
            return typeof args[number] != 'undefined'
              ? args[number]
              : match
            ;
        });
    };
}

//if(!Array.indexOf){
//  Array.prototype.indexOf = function(obj){
//   for(var i=0; i<this.length; i++){
// if(this[i]==obj){
//  return i;
// }
//   }
//   return -1;
//  }
//}
function indexOf(arr, key) {
    for (var i = 0; i < arr.length; i++) {
        if (arr[i] == key) {
            return i;
        }
    }
    return -1;
}

/* 正規表示式-加上 commas(",") 符號
 *
 * Author: Victor Chen
 * Date: 2007/05/06
 * Update Author: Victor Chen
 * Update 2007/05/06
 */
function addCommas(strValue) {
    var objRegExp = new RegExp('(-?[0-9]+)([0-9]{3})');
    while (objRegExp.test(strValue)) {
        strValue = strValue.replace(objRegExp, '$1,$2');
    }
    return strValue;
}

/* 正規表示式-移除 commas符號(",")
 *
 * Author: Victor Chen
 * Date: 2007/05/06
 * Update Author: Victor Chen
 * Update 2007/05/06
 */
function removeCommas(strValue) {
    var objRegExp = /,/g;
    return strValue.replace(objRegExp, '');
}

/* 正規表示式-移除所有空白字元及符號("\s", "\w", "\W", "\b")
 *
 * Author: Victor Chen
 * Date: 2007/05/06
 * Update Author: Victor Chen
 * Update 2007/05/06
 */
function trim(strValue) {
    var objRegExp = /^(\s*)$/;
    if (objRegExp.test(strValue)) {
        strValue = strValue.replace(objRegExp, '');
        if (strValue.length == 0)
            return strValue;
    }
    objRegExp = /^(\s*)([\W\w]*)(\b\s*$)/;
    if (objRegExp.test(strValue)) {
        strValue = strValue.replace(objRegExp, '$2');
    }
    return strValue;
}

/* onKeyDown event Escape Escape Illegal Input Value
 * Parameter: Form.[TagObject]
 *            Event
 *
 * Author: Victor Chen
 * Date: 2007/05/06
 * Update Author: Victor Chen
 * Update 2007/06/05
 */
function validateOnKD(fld, e) {
    var keyCode = (document.all) ? e.keyCode : e.which;

    //Escape Ctrl + V
    return (keyCode != 86);
}

/* 以 onKeyPress event Escape Illegal Input Value
 * Parameter: Form.[TagObject]
 *            Event
 *
 * Author: Victor Chen
 * Date: 2007/05/06
 * Update Author: Victor Chen
 * Update 2007/05/06
 */
function validateOnKP(fld, e, selster, EnterCallBack) {
    var keyCode = (document.all) ? e.keyCode : e.which;

    //判斷當有輸入資料且選擇開始的位置是最開頭 就不准輸入0
    if (fld.value.length > 0 && selster == 0) {
        if (keyCode == 48) return false;
    }

    //Permit Enter and BackSpace
    if (keyCode == 13) {
        if (EnterCallBack != null) {
            EnterCallBack(e);
            return false;
        }

        if (fld.id == 'Bingo_BPstake') {
            betSubmitBingo(e);
        }
        else {
            betSubmit(e);
        }
        return false
    };

    //Escape Prefix 0
    if (/^$/.test(removeCommas(fld.value)) && /0/.test(String.fromCharCode(keyCode))) {
        return false;
    }

    //Escape NaN Number
    if (/[^0-9]/.test(String.fromCharCode(keyCode))) {
        if (keyCode != 8 && keyCode != 0) {
            return false;
        }
    }

    return true;
}
function validateOnKPPhone(fld, e, from) {
    var keyCode = (document.all) ? e.keyCode : e.which;
    var fromWhich = from;

    //Permit Enter and BackSpace for stake and score
    if ((keyCode == 13 || keyCode == 8 || keyCode == 45) && (fromWhich == 'stakeField' || fromWhich == 'scoreField')) {
        return true;
    }
    //Permit Enter and BackSpace and decimal and left arrow and right arrow for odds and hdp
    if ((keyCode == 13 || keyCode == 8 || keyCode == 46 || keyCode == 45 || keyCode == 39 || keyCode == 37) && (fromWhich == 'oddsField' || fromWhich == 'hdpField')) {
        return true;
    }

    //Escape NaN Number
    if (/[^0-9]/.test(String.fromCharCode(keyCode))) {
        return false;
    }


    return true;
}
/* 以 onKeyUp event Count Current Payout
 * Parameter: Form.[TagObject]
 *            Event
 *
 * Author: Victor Chen
 * Date: 2007/05/06
 * Update Author: Victor Chen
 * Update 2007/05/06
 */
function payOutOnKU(fld, e) {
    fld.value = addCommas(removeCommas(fld.value));

    var s = fld.value;
    s = removeCommas(s);
    var z = "0123456789"
    for (var i = 0; i < s.length; i++) {
        tmp = s.substr(i, 1)
        if (z.indexOf(tmp) == -1) {
            if (/.*[\u4e00-\u9fa5]+.*$/.test(fld.value)) fld.value = '';
            return false;
        }
    }

    //Empty Input
    if (/^$/.test(removeCommas(fld.value))) {
        if (fFrame.siteMode == "1") {
            document.getElementById('payOut_P').innerHTML = '';
        }
        else if (fld.id == "HorseBPstake") {
            document.getElementById('hrspPayoutValue').innerHTML = '';
            document.getElementById('hrspMaxPayoutValue').innerHTML = '';
        }
        else {
            if (fld.id == "Bingo_BPstake") {
                document.getElementById('Bingo_payOut').innerHTML = '';
            }
            else {
                document.getElementById('payOut').innerHTML = '';
            }

        }
    } else {
        var bodds;
        var bettype;
        var sitetype;
        var oddstype;
        var bingobettype;
        var bingooddstype;
        if (fFrame.SiteMode == "1") {
            bettype = document.getElementById('bettype_P').value;
            sitetype = document.getElementById('siteType_P').value;
            oddstype = document.getElementById('oddsType_P').value;

            switch (bettype) {
                case '1':
                case '7':
                case '28':
                    bodds = document.getElementById("bp_odds3").value;
                    break;
                case "3":
                case "8":
                    bodds = document.getElementById("bp_odds2").value;
                    break;
                default:
                    bodds = document.getElementById("bp_odds1").value;
                    break;
            }
        }
        else {

            if (fld.id == "HorseBPstake") {
                if (parseInt(fFrame.LastSelectedSport, 10) >= 181 && parseInt(fFrame.LastSelectedSport, 10) <= 185) {
                    var oddsStr = document.getElementById('hrspOdds').innerHTML.replace("/", "+");
                    var oddsValue = eval(oddsStr);
                    document.getElementById('hrspPayoutValue').innerHTML = payOutCalculate(oddsValue, removeCommas(fld.value), false);
                    document.getElementById('hrspMaxPayoutValue').innerHTML = payOutCalculate(oddsValue, removeCommas(fld.value) / 2, false);
                }
            } else if (fld.id == "Bingo_BPstake") {
                bettype = "";
                sitetype = "";
                oddstype = "";
                bingobettype = document.getElementById('Bingo_bettype').value;
                bingooddstype = document.getElementById('Bingo_oddsType').value;
            }
            else {
                bettype = document.getElementById('bettype').value;
                sitetype = document.getElementById('siteType').value;
                oddstype = document.getElementById('oddsType').value;
                bingobettype = "";
                bingooddstype = "";
            }
        }

        var pairArray = ["1", "2", "3", "7", "8", "12", "20", "21", "153", "154", "155", "156", "1318", "1324", "18", "17", "184", "194", "197", "198", "203", "204", "205", "501", "401", "402", "403", "404", "603", "604", "605", "606", "607", "609", "610", "611", "612", "613", "615", "616", "617"];
        if ((indexOf(pairArray, bettype) != -1) && (oddstype != "1")) {
            if (oddstype == "5") {//American Odds
                document.getElementById('payOut').innerHTML = payOutCalculate(parseInt(removeCommas(document.getElementById('bodds').innerHTML), 10) / 100, removeCommas(fld.value), true);
            }
            else {
                if (fFrame.SiteMode == "1") {
                    document.getElementById('payOut_P').innerHTML = payOutCalculate(removeCommas(bodds), removeCommas(fld.value), true);
                }
                else {
                    document.getElementById('payOut').innerHTML = payOutCalculate(removeCommas(document.getElementById('bodds').innerHTML), removeCommas(fld.value), true);
                }
            }
        }
        else {
            var bingoArray = ["81", "82", "83", "84", "85", "86", "87", "88", "89", "90"];
            if (indexOf(bingoArray, bingobettype) != -1) {
                if (bingooddstype != 1) {
                    if ((bingooddstype == "5" && bingobettype != "89") && (bingooddstype == "5" && bingobettype != "90")) { //American Odds
                        document.getElementById('Bingo_payOut').innerHTML = payOutCalculate(parseInt(removeCommas(document.getElementById('Bingo_bodds').innerHTML), 10) / 100, removeCommas(fld.value), true);
                    }
                    else {
                        document.getElementById('Bingo_payOut').innerHTML = payOutCalculate(removeCommas(document.getElementById('Bingo_bodds').innerHTML), removeCommas(fld.value), bingobettype != "89" && bingobettype != "90");
                    }
                }
                else {
                    document.getElementById('Bingo_payOut').innerHTML = payOutCalculate(removeCommas(document.getElementById('Bingo_bodds').innerHTML), removeCommas(fld.value), false);
                }
            } else {
                var bettype = document.getElementById('bettype').value;

                if (fFrame.SiteMode == "1") {
                    document.getElementById('payOut_P').innerHTML = payOutCalculate(removeCommas(bodds), removeCommas(fld.value), false);
                }
                else {
                    document.getElementById('payOut').innerHTML = payOutCalculate(removeCommas(document.getElementById('bodds').innerHTML), removeCommas(fld.value), false);
                }
            }
        }
    }
}

function betSubmit(e) {
    var run = false;
    if (e == 'click') {
        run = true;
    } else {
        var keyCode = (document.all) ? e.keyCode : e.which;
        if (keyCode == 13)
            run = true;
    }
    if (run) {
        if (fFrame != null) {
            if (fFrame.SiteMode == "1") {
                return formvalidationP('fomConfirmBetPhone');
            }
            else {
                return formvalidation('fomConfirmBet');
            }
        }
    }
    else { return true; }
}

function betSubmitMP(e) {
    if (e != 'click') {
        e.preventDefault();
    }
    var run = false;
    if (e == 'click') {
        run = true;
    } else {
        var keyCode = (document.all) ? e.keyCode : e.which;
        if (keyCode == 13) {
            run = true;
        }
    }
    if (run) {
        return MPformvalidation('betform');
    }
    else { return true; }
}

function betSubmitBingo(e) {
    var run = false;
    if (e == 'click') {
        run = true;
    } else {
        var keyCode = (document.all) ? e.keyCode : e.which;
        if (keyCode == 13) {
            run = true;
        }
    }
    if (run) {
        return Bingoformvalidation('fomBingoConfirmBet');
    }
    else { return true; }
}


function OpenNumberGameresresult(leagueid) {
    switch (leagueid) {
        case 'NaN':
        case '':
            window.open('Result.aspx?sportType=161&mode=league&selectpop=1', 'popupwindow', 'width=810,height=600,scrollbars,resizable');
            break;
        default:
            window.open('Result.aspx?sportType=161&mode=league&selectpop=1&league=' + leagueid, 'popupwindow', 'width=810,height=600,scrollbars,resizable');
            break;
    }
}

function payOutOnKUOT(fld, e) {
    fld.value = addCommas(removeCommas(fld.value));
    //Empty Input
    if (/^$/.test(removeCommas(fld.value))) {
        if (fFrame.SiteMode == "1") {
            document.getElementById('payOut_P').innerHTML = '';
        }
        else {
            document.getElementById('payOut').innerHTML = '';
        }
    }
    else {
        // Other Payout = stake * odds;
        if (fFrame.SiteMode == "1") {
            document.getElementById('payOut_P').innerHTML = payOutCalculate(removeCommas(document.getElementById('odds').value), removeCommas(fld.value), false);
        }
        else {
            document.getElementById('payOut').innerHTML = payOutCalculate(removeCommas(document.getElementById('bodds').innerHTML), removeCommas(fld.value), false);
        }

    }
}

function payOutOnKUPhone(fld, e) {
    fld.value = addCommas(removeCommas(fld.value));

    //Empty Input
    if (/^$/.test(removeCommas(fld.value))) {
        document.getElementById('payOut').innerHTML = '';
    }
    else {
        if ((document.getElementById('bettype').value == 1 || document.getElementById('bettype').value == 2 || document.getElementById('bettype').value == 3 || document.getElementById('bettype').value == 7 || document.getElementById('bettype').value == 8 || document.getElementById('bettype').value == 20) && (document.getElementById('siteType').value != "DECIMAL" && document.getElementById('siteType').value != "DECIADD")) {
            // 2 choose 1 Payout = stake * (1 + odds)
            document.getElementById('payOut').innerHTML = payOutCalculate(removeCommas(document.getElementById('odds').innerHTML), removeCommas(fld.value), true);
        }
        else {
            // Other Payout = stake * odds;
            document.getElementById('payOut').innerHTML = payOutCalculate(removeCommas(document.getElementById('odds').innerHTML), removeCommas(fld.value), false);
        }
    }
}

function payOutCalculate(odds, stake, pair) {
    var tmpPayOut = "";

    if (pair) {
        tmpPayOut = addCommas((stake * (1 + Math.abs(odds))).toFixed(2));
    }
    else {
        tmpPayOut = addCommas((stake * Math.abs(odds)).toFixed(2));
    }

    return tmpPayOut;
}

/* 用來處理 Bet 的格式(###,###) , 要放在 OnKeyup事件上
 * 如果多傳 Odd 和 Payout 的 HTML Object ID , 會一併把Payout算出來，並寫在Payout的那一個Object上
 *
 * Author: David Wu
 * Date: 2007/05/09
 * Update Author: David Wu
 * Update 2007/05/09
 */

function checkValue(obj, oddsID, payoutID) {
    var strCheck = "0123456789";

    var strClean = "";
    var bFlag = true;
    for (var i = 0; i < obj.value.length; i++) {
        if (obj.value.charAt(i) == ".") {
            break;
        }

        if (obj.value.charAt(i) != "," && strCheck.indexOf(obj.value.charAt(i)) != -1) {
            strClean += obj.value.charAt(i);
        }
    }

    var strFormated = addCommas(strClean);
    obj.value = strFormated;

    if (oddsID != null && oddsID != "" && payoutID != null && payoutID != "") {
        var oddsObject = document.getElementById(oddsID);
        var payoutObject = document.getElementById(payoutID);

        var oddsValue;
        if (oddsObject.tagName == "INPUT") {
            oddsValue = oddsObject.value;
        }
        else {
            oddsValue = oddsObject.innerHTML;
        }

        if (!isNaN(oddsValue) && !isNaN(strClean)) {
            var dValue = parseFloat(oddsValue) * parseFloat(strClean);
            var sValue = String(dValue.toFixed(2));

            var dot = sValue.split(".");
            var sResult = addCommas(dot[0]) + "." + dot[1];

            if (!isNaN(dValue)) {
                if (payoutObject.tagName == "INPUT") {
                    payoutObject.value = sResult;
                }
                else {
                    payoutObject.innerHTML = sResult;
                }
            }
            else {
                if (payoutObject.tagName == "INPUT") {
                    payoutObject.value = "";
                }
                else {
                    payoutObject.innerHTML = "";
                }
            }
        }
        else {
            if (payoutObject.tagName == "INPUT") {
                payoutObject.value = "";
            }
            else {
                payoutObject.innerHTML = "";
            }
        }
    }
}

/* 用來處理輸入 Bet 的欄位的字元 , 不允許小數點的輸入 , 要放在 OnKeypress事件上
 *
 *
 * Author: David Wu
 * Date: 2007/05/09
 * Update Author: David Wu
 * Update 2007/05/09
 */

function checkKeyPress(obj, e, selster) {
    var keyCode = (document.all) ? e.keyCode : e.which;
    //判斷當有輸入資料且選擇開始的位置是最開頭 就不准輸入0
    if (obj.value.length > 0 && selster == 0) {
        if (keyCode == 48) return false;
    }
    if (keyCode == 9 || keyCode == 0) return true;

    var strCheck = '0123456789';

    var whichCode = (document.all) ? e.keyCode : e.which;
    if (whichCode == 13 || whichCode == 8) {
        return betSubmitMP(e);
        //return true;  // Enter
    }

    key = parseInt(String.fromCharCode(whichCode), 10);  // Get key value from key code
    if (strCheck.indexOf(key) == -1) {
        return false;  // Not a valid key
    }

    if (obj.value.length == 0 && key == "0") {
        return false;
    }

    return true;
}

// Check Email Fromat
//Author : Brian Yang  (Copy from Google)
//Date : 2007/10/17
//
function emailCheck(emailStr) {
    /* The following pattern is used to check if the entered e-mail address
      fits the user@domain format.  It also is used to separate the username
      from the domain. */
    var emailPat = /^(.+)@(.+)$/
    /* The following string represents the pattern for matching all special
      characters.  We don't want to allow special characters in the address.
      These characters include ( ) < > @ , ; : \ " . [ ]    */
    var specialChars = "\\(\\)<>@,;:\\\\\\\"\\.\\[\\]"
    /* The following string represents the range of characters allowed in a
      username or domainname.  It really states which chars aren't allowed. */
    var validChars = "\[^\\s" + specialChars + "\]"
    /* The following pattern applies if the "user" is a quoted string (in
      which case, there are no rules about which characters are allowed
      and which aren't; anything goes).  E.g. "jiminy cricket"@disney.com
      is a legal e-mail address. */
    var quotedUser = "(\"[^\"]*\")"
    /* The following pattern applies for domains that are IP addresses,
      rather than symbolic names.  E.g. joe@[123.124.233.4] is a legal
      e-mail address. NOTE: The square brackets are required. */
    var ipDomainPat = /^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/
    /* The following string represents an atom (basically a series of
      non-special characters.) */
    var atom = validChars + '+'
    /* The following string represents one word in the typical username.
      For example, in john.doe@somewhere.com, john and doe are words.
      Basically, a word is either an atom or quoted string. */
    var word = "(" + atom + "|" + quotedUser + ")"
    // The following pattern describes the structure of the user
    var userPat = new RegExp("^" + word + "(\\." + word + ")*$")
    /* The following pattern describes the structure of a normal symbolic
      domain, as opposed to ipDomainPat, shown above. */
    var domainPat = new RegExp("^" + atom + "(\\." + atom + ")*$")


    /* Finally, let's start trying to figure out if the supplied address is
      valid. */

    /* Begin with the coarse pattern to simply break up user@domain into
      different pieces that are easy to analyze. */
    var matchArray = emailStr.match(emailPat)
    if (matchArray == null) {
        /* Too many/few @'s or something; basically, this address doesn't
           even fit the general mould of a valid e-mail address. */
        //alert("Email address seems incorrect (check @ and .'s)")
        return false
    }
    var user = matchArray[1]
    var domain = matchArray[2]

    // See if "user" is valid
    if (user.match(userPat) == null) {
        // user is not valid
        //alert("The username doesn't seem to be valid.")
        return false
    }

    /* if the e-mail address is at an IP address (as opposed to a symbolic
      host name) make sure the IP address is valid. */
    var IPArray = domain.match(ipDomainPat)
    if (IPArray != null) {
        // this is an IP address
        for (var i = 1; i <= 4; i++) {
            if (IPArray[i] > 255) {
                //alert("Destination IP address is invalid!")
                return false
            }
        }
        return true
    }

    // Domain is symbolic name
    var domainArray = domain.match(domainPat)
    if (domainArray == null) {
        //alert("The domain name doesn't seem to be valid.")
        return false
    }

    /* domain name seems valid, but now make sure that it ends in a
      three-letter word (like com, edu, gov) or a two-letter word,
      representing country (uk, nl), and that there's a hostname preceding
      the domain or country. */

    /* Now we need to break up the domain to get a count of how many atoms
      it consists of. */
    var atomPat = new RegExp(atom, "g")
    var domArr = domain.match(atomPat)
    var len = domArr.length
    if (domArr[domArr.length - 1].length < 2 ||
       domArr[domArr.length - 1].length > 4) {
        // the address must end in a two letter or three letter word.
        //alert("The address must end in a three-letter domain, or two letter country.")
        return false
    }

    // Make sure there's a host name preceding the domain.
    if (len < 2) {
        var errStr = "This address is missing a hostname!"
        //alert(errStr)
        return false
    }

    // If we've gotten this far, everything's valid!
    return true;
}

function gotoSportsBookPage() {
    if (parent.top.LastSelectedMenu != null) {
        parent.top.LastSelectedMenu = 0;
        parent.top.LastSelectedSport = -1;
    }
    parent.leftFrame.location = "leftAllInOne.aspx";
    parent.mainFrame.location = "UnderOver.aspx?Market=t&DispVer=new";
}

// open streaming window
//function openStreaming(pStreamingId) {
//    /*if (window.top.StreamingFrame != null) {
//		window.top.StreamingFrame.close();
//	}
//    if (pStreamingId != null) {
//		window.top.StreamingFrame = window.top.window.open("StreamingFrame.aspx?StreamingId=" + pStreamingId, "StreamingFrame", "top=200,left=300,height=520,width=525,status=no,toolbar=no,menubar=no,resizable=yes,location=no");
//	} else {
//		window.top.StreamingFrame = window.top.window.open("StreamingFrame.aspx", "StreamingFrame", "top=200,left=300,height=630,width=800,status=no,toolbar=no,menubar=no,resizable=yes,location=no");
//	}*/
//	CloseTVBox();
//	if (fFrame.StreamingFrame == null || fFrame.StreamingFrame.closed)
//	{
//	    fFrame.StreamingFrame = fFrame.window.open("StreamingFrame.aspx", "StreamingFrame", "top=20,left=20,height=630,width=800,status=no,toolbar=no,menubar=no,resizable=yes,location=no,scrollbars=no");
//	}
//	else
//	{
//        fFrame.StreamingFrame.location.href="StreamingFrame.aspx";
//	    if(fFrame.StreamingFrame.document.getElementById('containerhead').style.display == "none")
//	    {
//	        fFrame.StreamingFrame.StandalonePlayer();
//	    }
//	    
//	    if(userBrowser()=="Chrome")
//	        fFrame.StreamingFrame.blur();
//	    else
//	        fFrame.StreamingFrame.focus();
//	    
//	}
//	fFrame.StreamingFrame.focus();
//}
//function CloseTVBox() {
//    if (fFrame.leftFrame!=null) {
//        var obj1=fFrame.leftFrame.document.getElementById("iTV");
//        if (obj1 != null) {
//            obj1.src="";
//        }
//        var obj2=fFrame.leftFrame.document.getElementById("TVBox");
//        if (obj2 != null) {
//            obj2.style.display="none";
//        }
//        var obj3=fFrame.leftFrame.document.getElementById("div_Casino");
//        if (obj3 != null) {
//            obj3.style.display="";
//        }
//    }
//}

//Scott JS Marquee
function SunPlus_Marquee() {
    var _this = this;
    this.marquee_mouse = 1;
    this.scroll_speed = 1;
    this.marquee_flag = true;
    this.scrollerwidth = 500;
    this.DivElm = null;

    this.Mymarquee_scroll = function () {
        marquee_scroll()
    }

    function marquee_scroll() {
        var tmp;
        tmp = _this.DivElm.style;
        if (_this.marquee_mouse && _this.marquee_flag) {
            tmp.left = parseInt(tmp.left, 10) - _this.scroll_speed;
            if (parseInt(tmp.left, 10) <= -_this.DivElm.offsetWidth) {
                tmp.left = _this.scrollerwidth;
            }
        }
        window.setTimeout(marquee_scroll, 100);
    }
}


function isNum(N) {
    numtype = "0123456789";
    for (i = 0; i < N.length; i++) { //檢討是否有不在 0123456789之內的字
        if (numtype.indexOf(N.substring(i, i + 1)) < 0) {
            return false;//是的話....結束迴圈;傳回false
        }
    }
    return true;
}

function check_email(email) {	//檢查email信箱的正確性
    var len = email.length;
    if (len == 0) {
        return false;
    }

    for (var i = 0; i < len; i++) {
        var c = email.charAt(i);
        if (!((c >= "A" && c <= "Z") || (c >= "a" && c <= "z") || (c >= "0" && c <= "9") || (c == "-") || (c == "_") || (c == ".") || (c == "@")))
            return false;
    }
    if ((email.indexOf("@") == -1) || (email.indexOf("@") == 0) || (email.indexOf("@") == (len - 1))) {
        return false;
    }
    if ((email.indexOf("@") != -1) && (email.substring(email.indexOf("@") + 1, len).indexOf("@") != -1)) {
        return false;
    }
    if ((email.indexOf(".") == -1) || (email.indexOf(".") == 0) || (email.lastIndexOf(".") == (len - 1))) {
        return false;
    }

    ///////////////////////////////////////

    var tail1, tail2;
    len = email.length;
    tail1 = email.substring(email.indexOf("@") + 1, len)
    var posi = tail1.indexOf(".");
    while (posi > 0) {
        tail2 = tail1.substring(0, tail1.indexOf("."))
        len = tail2.length;

        if (len < 2) {
            return false; // 不可過短
        }

        len = tail1.length;
        tail1 = tail1.substring(tail1.indexOf(".") + 1, len)

        posi = tail1.indexOf(".");

    }

    len = tail1.length;
    if (len < 2) {
        return false; // 不可過短
    }

    if (isNum(tail1)) {
        return false; // 最後一段 不可全為數字
    }


    ///////////////////////////////////////

    if ((email.indexOf('@.')) >= 0) {// 不可 為 abc@.com
        return false;
    }
    //alert(email);
    return true;
}


function replaceSubstring(inputString, fromString, toString) {
    // Goes through the inputString and replaces every occurrence of fromString with toString
    var temp = inputString;
    if (fromString == "") {
        return inputString;
    }
    if (toString.indexOf(fromString) == -1) { // If the string being replaced is not a part of the replacement string (normal situation)
        while (temp.indexOf(fromString) != -1) {
            var toTheLeft = temp.substring(0, temp.indexOf(fromString));
            var toTheRight = temp.substring(temp.indexOf(fromString) + fromString.length, temp.length);
            temp = toTheLeft + toString + toTheRight;
        }
    } else { // String being replaced is part of replacement string (like "+" being replaced with "++") - prevent an infinite loop
        var midStrings = new Array("~", "`", "_", "^", "#");
        var midStringLen = 1;
        var midString = "";
        // Find a string that doesn't exist in the inputString to be used
        // as an "inbetween" string
        while (midString == "") {
            for (var i = 0; i < midStrings.length; i++) {
                var tempMidString = "";
                for (var j = 0; j < midStringLen; j++) { tempMidString += midStrings[i]; }
                if (fromString.indexOf(tempMidString) == -1) {
                    midString = tempMidString;
                    i = midStrings.length + 1;
                }
            }
        } // Keep on going until we build an "inbetween" string that doesn't exist
        // Now go through and do two replaces - first, replace the "fromString" with the "inbetween" string
        while (temp.indexOf(fromString) != -1) {
            var toTheLeft = temp.substring(0, temp.indexOf(fromString));
            var toTheRight = temp.substring(temp.indexOf(fromString) + fromString.length, temp.length);
            temp = toTheLeft + midString + toTheRight;
        }
        // Next, replace the "inbetween" string with the "toString"
        while (temp.indexOf(midString) != -1) {
            var toTheLeft = temp.substring(0, temp.indexOf(midString));
            var toTheRight = temp.substring(temp.indexOf(midString) + midString.length, temp.length);
            temp = toTheLeft + toString + toTheRight;
        }
    } // Ends the check to see if the string being replaced is part of the replacement string or not
    return temp; // Send the updated string back to the user
}

function currencyFormat(fld, milSep, decSep, e) {
    var sep = 0;
    var key = '';
    var i = j = 0;
    var len = len2 = 0;
    var strCheck = '0123456789';
    var aux = aux2 = '';
    var whichCode = (document.all) ? e.keyCode : e.which;
    if (whichCode == 8) fld.value = '';
    if (whichCode == 13) return true;  // Enter

    key = parseInt(String.fromCharCode(whichCode), 10);  // Get key value from key code
    if (strCheck.indexOf(key) == -1) {
        return false;  // Not a valid key
    }

    len = fld.value.length;
    for (i = 0; i < len; i++)
        if ((fld.value.charAt(i) != '0') && (fld.value.charAt(i) != decSep)) {
            break;
        }
    aux = '';

    for (; i < len; i++) {
        if (strCheck.indexOf(fld.value.charAt(i)) != -1) {
            aux += fld.value.charAt(i);
        }
    }
    aux += key;
    len = aux.length;
    if (len == 0) fld.value = '';
    if (len > 0) {
        aux2 = '';
        for (j = 0, i = len - 1; i >= 0; i--) {
            if (j == 3) {
                aux2 += milSep;
                j = 0;
            }
            aux2 += aux.charAt(i);
            j++;
        }
        fld.value = '';
        len2 = aux2.length;
        for (i = len2 - 0 ; i >= 0; i--) {
            fld.value += aux2.charAt(i);
        }
        fld.value += aux.substr(len, len);
    }
    return false;
}

/*
 * Author: Victor Chen 
 * Date: 2007/05/06
 * Update Author: Victor Chen
 * Update 2007/05/06
 */
function countPayOut() {
    var stake = trim(removeCommas(document.getElementById('OTStake').value));
    var odds = trim(removeCommas(document.getElementById('ot_spOddsValue').innerHTML));
    if (stake.length != 0 && odds.length != 0) {
        document.getElementById('OTpayOut').innerHTML = addCommas((stake * odds).toFixed(2));
    }
    else {
        document.getElementById('OTpayOut').innerHTML = '';
    }
}

function onKeyDownFunc(whereTo, e) {
    var keyCode = (document.all) ? e.keyCode : e.which;
    if (keyCode == 9) {
        var destination = document.getElementById(whereTo);
        if (destination != null) {
            destination.focus();
            destination.select();
        }
    }
}

var MD5 = function (string) {

    function RotateLeft(lValue, iShiftBits) {
        return (lValue << iShiftBits) | (lValue >>> (32 - iShiftBits));
    }

    function AddUnsigned(lX, lY) {
        var lX4, lY4, lX8, lY8, lResult;
        lX8 = (lX & 0x80000000);
        lY8 = (lY & 0x80000000);
        lX4 = (lX & 0x40000000);
        lY4 = (lY & 0x40000000);
        lResult = (lX & 0x3FFFFFFF) + (lY & 0x3FFFFFFF);
        if (lX4 & lY4) {
            return (lResult ^ 0x80000000 ^ lX8 ^ lY8);
        }
        if (lX4 | lY4) {
            if (lResult & 0x40000000) {
                return (lResult ^ 0xC0000000 ^ lX8 ^ lY8);
            } else {
                return (lResult ^ 0x40000000 ^ lX8 ^ lY8);
            }
        } else {
            return (lResult ^ lX8 ^ lY8);
        }
    }

    function F(x, y, z) { return (x & y) | ((~x) & z); }
    function G(x, y, z) { return (x & z) | (y & (~z)); }
    function H(x, y, z) { return (x ^ y ^ z); }
    function I(x, y, z) { return (y ^ (x | (~z))); }

    function FF(a, b, c, d, x, s, ac) {
        a = AddUnsigned(a, AddUnsigned(AddUnsigned(F(b, c, d), x), ac));
        return AddUnsigned(RotateLeft(a, s), b);
    };

    function GG(a, b, c, d, x, s, ac) {
        a = AddUnsigned(a, AddUnsigned(AddUnsigned(G(b, c, d), x), ac));
        return AddUnsigned(RotateLeft(a, s), b);
    };

    function HH(a, b, c, d, x, s, ac) {
        a = AddUnsigned(a, AddUnsigned(AddUnsigned(H(b, c, d), x), ac));
        return AddUnsigned(RotateLeft(a, s), b);
    };

    function II(a, b, c, d, x, s, ac) {
        a = AddUnsigned(a, AddUnsigned(AddUnsigned(I(b, c, d), x), ac));
        return AddUnsigned(RotateLeft(a, s), b);
    };

    function ConvertToWordArray(string) {
        var lWordCount;
        var lMessageLength = string.length;
        var lNumberOfWords_temp1 = lMessageLength + 8;
        var lNumberOfWords_temp2 = (lNumberOfWords_temp1 - (lNumberOfWords_temp1 % 64)) / 64;
        var lNumberOfWords = (lNumberOfWords_temp2 + 1) * 16;
        var lWordArray = Array(lNumberOfWords - 1);
        var lBytePosition = 0;
        var lByteCount = 0;
        while (lByteCount < lMessageLength) {
            lWordCount = (lByteCount - (lByteCount % 4)) / 4;
            lBytePosition = (lByteCount % 4) * 8;
            lWordArray[lWordCount] = (lWordArray[lWordCount] | (string.charCodeAt(lByteCount) << lBytePosition));
            lByteCount++;
        }
        lWordCount = (lByteCount - (lByteCount % 4)) / 4;
        lBytePosition = (lByteCount % 4) * 8;
        lWordArray[lWordCount] = lWordArray[lWordCount] | (0x80 << lBytePosition);
        lWordArray[lNumberOfWords - 2] = lMessageLength << 3;
        lWordArray[lNumberOfWords - 1] = lMessageLength >>> 29;
        return lWordArray;
    };
    /*
       function WordToHex(lValue) {
           var WordToHexValue="",WordToHexValue_temp="",lByte,lCount;
           for (lCount = 0;lCount<=3;lCount++) {
               lByte = (lValue>>>(lCount*8)) & 255;
               WordToHexValue_temp = "0" + lByte.toString(16);
               WordToHexValue = WordToHexValue + WordToHexValue_temp.substr(WordToHexValue_temp.length-2,2);
           }
           return WordToHexValue;
       };
    */
    function Utf8Encode(string) {
        string = string.replace(/\r\n/g, "\n");
        var utftext = "";

        for (var n = 0; n < string.length; n++) {

            var c = string.charCodeAt(n);

            if (c < 128) {
                utftext += String.fromCharCode(c);
            }
            else if ((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            }
            else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }

        }

        return utftext;
    };

    var x = Array();
    var k, AA, BB, CC, DD, a, b, c, d;
    var S11 = 7, S12 = 12, S13 = 17, S14 = 22;
    var S21 = 5, S22 = 9, S23 = 14, S24 = 20;
    var S31 = 4, S32 = 11, S33 = 16, S34 = 23;
    var S41 = 6, S42 = 10, S43 = 15, S44 = 21;

    string = Utf8Encode(string);

    x = ConvertToWordArray(string);

    a = 0x67452301; b = 0xEFCDAB89; c = 0x98BADCFE; d = 0x10325476;

    for (k = 0; k < x.length; k += 16) {
        AA = a; BB = b; CC = c; DD = d;
        a = FF(a, b, c, d, x[k + 0], S11, 0xD76AA478);
        d = FF(d, a, b, c, x[k + 1], S12, 0xE8C7B756);
        c = FF(c, d, a, b, x[k + 2], S13, 0x242070DB);
        b = FF(b, c, d, a, x[k + 3], S14, 0xC1BDCEEE);
        a = FF(a, b, c, d, x[k + 4], S11, 0xF57C0FAF);
        d = FF(d, a, b, c, x[k + 5], S12, 0x4787C62A);
        c = FF(c, d, a, b, x[k + 6], S13, 0xA8304613);
        b = FF(b, c, d, a, x[k + 7], S14, 0xFD469501);
        a = FF(a, b, c, d, x[k + 8], S11, 0x698098D8);
        d = FF(d, a, b, c, x[k + 9], S12, 0x8B44F7AF);
        c = FF(c, d, a, b, x[k + 10], S13, 0xFFFF5BB1);
        b = FF(b, c, d, a, x[k + 11], S14, 0x895CD7BE);
        a = FF(a, b, c, d, x[k + 12], S11, 0x6B901122);
        d = FF(d, a, b, c, x[k + 13], S12, 0xFD987193);
        c = FF(c, d, a, b, x[k + 14], S13, 0xA679438E);
        b = FF(b, c, d, a, x[k + 15], S14, 0x49B40821);
        a = GG(a, b, c, d, x[k + 1], S21, 0xF61E2562);
        d = GG(d, a, b, c, x[k + 6], S22, 0xC040B340);
        c = GG(c, d, a, b, x[k + 11], S23, 0x265E5A51);
        b = GG(b, c, d, a, x[k + 0], S24, 0xE9B6C7AA);
        a = GG(a, b, c, d, x[k + 5], S21, 0xD62F105D);
        d = GG(d, a, b, c, x[k + 10], S22, 0x2441453);
        c = GG(c, d, a, b, x[k + 15], S23, 0xD8A1E681);
        b = GG(b, c, d, a, x[k + 4], S24, 0xE7D3FBC8);
        a = GG(a, b, c, d, x[k + 9], S21, 0x21E1CDE6);
        d = GG(d, a, b, c, x[k + 14], S22, 0xC33707D6);
        c = GG(c, d, a, b, x[k + 3], S23, 0xF4D50D87);
        b = GG(b, c, d, a, x[k + 8], S24, 0x455A14ED);
        a = GG(a, b, c, d, x[k + 13], S21, 0xA9E3E905);
        d = GG(d, a, b, c, x[k + 2], S22, 0xFCEFA3F8);
        c = GG(c, d, a, b, x[k + 7], S23, 0x676F02D9);
        b = GG(b, c, d, a, x[k + 12], S24, 0x8D2A4C8A);
        a = HH(a, b, c, d, x[k + 5], S31, 0xFFFA3942);
        d = HH(d, a, b, c, x[k + 8], S32, 0x8771F681);
        c = HH(c, d, a, b, x[k + 11], S33, 0x6D9D6122);
        b = HH(b, c, d, a, x[k + 14], S34, 0xFDE5380C);
        a = HH(a, b, c, d, x[k + 1], S31, 0xA4BEEA44);
        d = HH(d, a, b, c, x[k + 4], S32, 0x4BDECFA9);
        c = HH(c, d, a, b, x[k + 7], S33, 0xF6BB4B60);
        b = HH(b, c, d, a, x[k + 10], S34, 0xBEBFBC70);
        a = HH(a, b, c, d, x[k + 13], S31, 0x289B7EC6);
        d = HH(d, a, b, c, x[k + 0], S32, 0xEAA127FA);
        c = HH(c, d, a, b, x[k + 3], S33, 0xD4EF3085);
        b = HH(b, c, d, a, x[k + 6], S34, 0x4881D05);
        a = HH(a, b, c, d, x[k + 9], S31, 0xD9D4D039);
        d = HH(d, a, b, c, x[k + 12], S32, 0xE6DB99E5);
        c = HH(c, d, a, b, x[k + 15], S33, 0x1FA27CF8);
        b = HH(b, c, d, a, x[k + 2], S34, 0xC4AC5665);
        a = II(a, b, c, d, x[k + 0], S41, 0xF4292244);
        d = II(d, a, b, c, x[k + 7], S42, 0x432AFF97);
        c = II(c, d, a, b, x[k + 14], S43, 0xAB9423A7);
        b = II(b, c, d, a, x[k + 5], S44, 0xFC93A039);
        a = II(a, b, c, d, x[k + 12], S41, 0x655B59C3);
        d = II(d, a, b, c, x[k + 3], S42, 0x8F0CCC92);
        c = II(c, d, a, b, x[k + 10], S43, 0xFFEFF47D);
        b = II(b, c, d, a, x[k + 1], S44, 0x85845DD1);
        a = II(a, b, c, d, x[k + 8], S41, 0x6FA87E4F);
        d = II(d, a, b, c, x[k + 15], S42, 0xFE2CE6E0);
        c = II(c, d, a, b, x[k + 6], S43, 0xA3014314);
        b = II(b, c, d, a, x[k + 13], S44, 0x4E0811A1);
        a = II(a, b, c, d, x[k + 4], S41, 0xF7537E82);
        d = II(d, a, b, c, x[k + 11], S42, 0xBD3AF235);
        c = II(c, d, a, b, x[k + 2], S43, 0x2AD7D2BB);
        b = II(b, c, d, a, x[k + 9], S44, 0xEB86D391);
        a = AddUnsigned(a, AA);
        b = AddUnsigned(b, BB);
        c = AddUnsigned(c, CC);
        d = AddUnsigned(d, DD);
    }

    var temp = WordToHex(a) + WordToHex(b) + WordToHex(c) + WordToHex(d);

    return temp.toLowerCase();
}

function WordToHex(lValue) {
    var WordToHexValue = "", WordToHexValue_temp = "", lByte, lCount;
    for (lCount = 0; lCount <= 3; lCount++) {
        lByte = (lValue >>> (lCount * 8)) & 255;
        WordToHexValue_temp = "0" + lByte.toString(16);
        WordToHexValue = WordToHexValue + WordToHexValue_temp.substr(WordToHexValue_temp.length - 2, 2);
    }
    return WordToHexValue;
};

var CFS = function (codeStr) {
    function CfsCode(nWord) {
        var result = "";
        for (var cc = 1; cc <= nWord.length; cc++) {
            result += nWord.charAt(cc - 1).charCodeAt(0);
        }
        var DecimalValue = new Number(result);
        result = DecimalValue.toString(16);
        return result;
    };

    var CodeLen = 30, CodeSpace, Been;
    CodeSpace = CodeLen - codeStr.length;
    if (CodeSpace > 1) {
        for (var cecr = 1; cecr <= CodeSpace; cecr++) {
            codeStr = codeStr + String.fromCharCode(21);
        }
    }
    var NewCode = new Number(1);

    for (var cecb = 1; cecb <= CodeLen; cecb++) {
        Been = CodeLen + codeStr.charAt(cecb - 1).charCodeAt(0) * cecb;
        NewCode = NewCode * Been;
    }

    var tmpNewCode = new Number(NewCode.toPrecision(15));	//to convert to the same precision as c# code
    codeStr = tmpNewCode.toString().toUpperCase();
    var NewCode2 = "";

    for (var cec = 1; cec <= codeStr.length; cec++) {
        NewCode2 = NewCode2 + CfsCode(codeStr.substring(cec - 1, cec + 2));
    }

    var CfsEncodeStr = "";
    for (var cec = 20; cec <= NewCode2.length - 18; cec += 2) {
        CfsEncodeStr = CfsEncodeStr + NewCode2.charAt(cec - 1);
    }
    return CfsEncodeStr.toUpperCase();
}

function userBrowser() {
    var browserName = navigator.userAgent.toLowerCase();
    if (/msie/i.test(browserName) && !/opera/.test(browserName)) {
        return "IE";
    } else if (/firefox/i.test(browserName)) {
        return "Firefox";
    } else if (/chrome/i.test(browserName) && /webkit/i.test(browserName) && /mozilla/i.test(browserName)) {
        return "Chrome";
    } else if (/opera/i.test(browserName)) {
        return "Opera";
    } else if (/webkit/i.test(browserName) && !(/chrome/i.test(browserName) && /webkit/i.test(browserName) && /mozilla/i.test(browserName))) {
        return "Safari";
    } else {
        return "unKnow";
    }
}

function SwitchDispHidden(Control) {
    var Control = document.getElementById(Control);
    if (Control.style.display == 'none') {
        Control.style.display = '';
    }
    else {
        Control.style.display = 'none';
    }
}

var OptionListObj_DisStyle = null;
function SetHideDisStyleOptionList(event) {
    var wait = 3; //how long time the display list   (in seconds)

    if (OptionListObj_DisStyle == null) {
        OptionListObj_DisStyle = new DivOption(document.getElementById('disstyle'), wait);
    }
    OptionListObj_DisStyle.act(event, null, null); //set object position
}

var OptionListObj_OddsType = null;
function SetHideOddsTypeOptionList(event) {
    var wait = 3; //how long time the display list   (in seconds)

    if (OptionListObj_OddsType == null) {
        OptionListObj_OddsType = new DivOption(document.getElementById('selOddsType'), wait);
    }
    OptionListObj_OddsType.act(event, null, null); //set object position
}

var OptionListObj_SecurityQ = null;
function SetHideSecurityQOptionList(event) {
    var wait = 3; //how long time the display list   (in seconds)

    if (OptionListObj_OddsType == null) {
        OptionListObj_OddsType = new DivOption(document.getElementById('selSecurityQ'), wait);
    }
    OptionListObj_OddsType.act(event, null, null); //set object position
}

var OptionListObj_Other = null;
function SetHideOptionList(event) {
    var wait = 3; //how long time the display list   (in seconds)

    if (OptionListObj_Other == null) {
        // var Control = document.getElementById('selSecurityQ');
        OptionListObj_Other = new DivOption(document.getElementById('selSecurityQ'), wait);
    }
    OptionListObj_Other.act(event, null, null); //set object position
}

var LoginObj = null;
function SetHideLoginWindow(event) {
    var wait = 3; //how long time the display list   (in seconds)

    if (LoginObj == null) {
        LoginObj = new DivPop(document.getElementById('loginact'), wait);
    }
    LoginObj.act(event, null, null);
}

var BettingObj = null;
function SetHideBetWindow(event) {
    if (document.getElementById('BankingAct') != null) {
        document.getElementById('BankingAct').style.display = 'none';
    }

    //    if(BankingObj != null)
    //    { 
    //        //BankingObj.Div.closeDiv(event);
    //        alert('BankingObj not null');
    //    }

    var wait = 3; //how long time the display list   (in seconds)

    if (BettingObj == null) {
        BettingObj = new DivPop(document.getElementById('BettingAct'), wait);
    }
    BettingObj.act(event, null, null);
}

var BankingObj = null;
function SetHideBankingWindow(event) {
    //    if(BettingObj != null)
    //    { 
    //        //BettingObj.Div.closeDiv(event);
    //        alert('BettingObj not null');
    //    }

    if (document.getElementById('BettingAct') != null) {
        document.getElementById('BettingAct').style.display = 'none';
    }

    var wait = 3; //how long time the display list   (in seconds)

    if (BankingObj == null) {
        BankingObj = new DivPop(document.getElementById('BankingAct'), wait);
    }
    BankingObj.act(event, null, null);
}

function ShowPopWindow(id, mode) {
    if (mode == 1) {
        document.getElementById(id).style.display = 'block';
    }
    else {
        document.getElementById(id).style.display = 'none';
    }
}

// open Rule Info window
function openBingoRuleInfo() {
    if (fFrame.RuleInfo == null || fFrame.RuleInfo.closed) {
        fFrame.RuleInfo = fFrame.window.open("index_info.aspx?page=11", "RuleInfo");
    }
}

function switchAsia_Europe(type, httphost, isTestMode) {
    if (fFrame.SiteId == '4280' || fFrame.SiteId == '4200800' || fFrame.SiteId == '4200200') {//OneBook && fun88
        if (type == 1) {//asia --> europe  
            fFrame.location.href = "http://" + httphost + "/vender.aspx?webSkinType=1&lang=en_eu&iseuro=1";
        }
        if (type == 2) {//europe --> asia 
            fFrame.location.href = "http://" + httphost + "/vender.aspx?webSkinType=0&lang=en&iseuro=0";
        }
    }
}

/* Score Map Pop Window
 *
 * Author: Maggie
 * Date: 2011/6/4
 */
var ScoreInfoPopWindow;
var ScoreMapInfoUrl;
var strRefresh;
var strWaiting;
var preMatchId;
var TimetoWait = false;

function popScoreMap(MatchId, IsRefresh, strR, strW) {

    ScoreMapInfoUrl = 'TickScoreMapPop.aspx?MatchId=' + MatchId;
    if (IsRefresh) {
        if (!maprefresh) {
            return false;
        }
        strRefresh = strR;
        strWaiting = strW;

        if (window.opener == null || window.opener.closed) {
            ClosedWin();
        } else {
            //disableStyle();		
            if (!disableStyle()) {
                return false;
            } else {
                setTimeout("RefreshScoreMap('" + ScoreMapInfoUrl + "')", 1000);
            }

            return;
        }
    }
    else {
        if (!TimetoWait) {
            TimetoWait = true;
            setTimeout(function () { if (TimetoWait) { TimetoWait = false }; }, 5000);

            wx = 610;
            wy = 660;
            x = (screen.width - wx) / 2;
            y = x = (screen.height - wx) / 2;

            if (ScoreInfoPopWindow == null || ScoreInfoPopWindow.closed || (preMatchId != MatchId)) {
                ScoreInfoPopWindow = window.open(ScoreMapInfoUrl, 'subInfo', 'left=' + x + ',top=' + y + ',width=' + wx + ',height=' + wy);
                preMatchId = MatchId;
            }

            if (ScoreInfoPopWindow != null) {
                ScoreInfoPopWindow.focus();
            }
        }
        else {
            return false;
        }
    }
}

function RefreshScoreMap(url) {
    maprefresh = false;
    window.top.location.href = url;
}
/* Score Map Pop Window
 *
 * Author: Maggie
 * Date: 2011/7/20
 */
function ClosedWin() {
    window.open('', '_self', '');
    window.opener = null;
    window.close();
}
/* Score Map Pop Window
 *
 * Author: Maggie
 * Date: 2011/7/20
 */
function enableStyle() {
    var sp_1 = document.getElementById("sp_r1");
    var sp_2 = document.getElementById("sp_r2");
    var sp_3 = document.getElementById("sp_r3");
    var list = [sp_1, sp_2, sp_3];
    for (var i = list.length - 1; i >= 0; i--) {
        list[i].style.color = "#4B5D8F";
        list[i].style.cursor = "pointer";
        if (SiteId != "" && SiteId == '4200800') {
            list[i].innerHTML = "<span><span>" + strRefresh + "</span></span>";
        } else {
            list[i].innerHTML = "<span>" + strRefresh + "</span>";
        }
        list[i].disabled = false;
    }
}
/* Score Map Pop Window
 *
 * Author: Maggie
 * Date: 2011/7/20
 */
function disableStyle() {
    var sp_1 = document.getElementById("sp_r1");
    var sp_2 = document.getElementById("sp_r2");
    var sp_3 = document.getElementById("sp_r3");
    if (sp_1.disabled || sp_2.disabled || sp_3.disabled) {
        return false;
    }
    var list = [sp_1, sp_2, sp_3];

    for (var i = list.length - 1; i >= 0; i--) {
        var sp_temp = list[i].cloneNode(true);
        if (SiteId != "" && SiteId == '4202000') {
            sp_temp.style.color = "#000000";
            sp_temp.style.backgroundColor = "#CCCCCC";
        }
        else {
            sp_temp.style.color = "#ababab";
        }

        sp_temp.style.cursor = "";
        if (SiteId != "" && SiteId == '4200800') {
            sp_temp.innerHTML = "<span><span>" + strWaiting + "</span></span>";
        } else {
            sp_temp.innerHTML = "<span>" + strWaiting + "</span>";
        }
        sp_temp.disabled = true;
        list[i].className = list[i].className + " disabled";
        list[i].innerHTML = sp_temp.innerHTML;
    }
    return true;
}

function NumberGroupTitle(Sender, betType) {
    if (betType != null && betType != "undefined" && ((parseInt(betType) >= 221 && parseInt(betType) <= 225) || parseInt(betType) == 171 || parseInt(betType) == 426)) {
        Sender.title = Sender.innerHTML.replace("<br>", "");
    }
    else {
        //market_hdp_group
        var group = Sender.innerHTML.split(" ");
        if (group.length <= 1) {
            return;
        }
        var group1 = group[group.length - 1].split("-");
        if (group.length != 2) {
            return;
        }
        var group2 = parseInt(group1[1], 10);
        var TitleStr = "";
        switch (group1[0]) {
            case "1":
                for (var i = 5 * group2 - 4; i <= 5 * group2; i++) {
                    TitleStr = TitleStr + "," + i;
                }
                break;
            case "2":
                for (var i = 15 * group2 - 14; i <= 15 * group2; i++) {
                    TitleStr = TitleStr + "," + i;
                }
                break;
            case "3":
                for (var i = 25 * group2 - 24; i <= 25 * group2; i++) {
                    TitleStr = TitleStr + "," + i;
                }
                break;
            case "4":
                for (var i = 0; i <= 14; i++) {
                    var j = i * 5 + group2;
                    TitleStr = TitleStr + "," + j;
                }
                break;
        }
        Sender.title = TitleStr.substr(1);
    }
}

function onOver(e) {
    $('.submenu li').removeClass("selected");
    $(e).addClass("selected");
}

function onOut(e) {
    $(e).removeClass("selected");
}

function setSelecter(id, sender, value, isIconMode) {
    if (id == "selOddsType") {
        var oOddsType = $('#' + id).attr('value');
        var nOddsType = value;
        fFrame.OddsType = value;
    }

    if (isIconMode == null) {
        isIconMode = false;
    }
    var selectDiv = $("#" + id + "_Txt");

    if (isIconMode) {
        selectDiv.find('div')[0].className = $(sender).find('span')[0].className;
    } else {
        selectDiv.html($(sender).html());
    }
    selectDiv.attr('title', $(sender).attr('title'));
    $("#" + id).attr('value', value);
    //if(document.getElementById(id))document.getElementById(id).value=value;
    // document.getElementById(id+"_menu").style.visibility="hidden"; 
    if (id == "aSorter") {
        var DataForm;
        var refreshType = 'D';
        if (document.DataForm_L != null) {
            DataForm = document.DataForm_L;
            refreshType = 'L';
        } else {
            DataForm = document.DataForm;
            refreshType = 'D';
        }

        if (value != DataForm.OrderBy.value) {
            setRefreshSort();
        } else {
            if (refreshType != 'L') {
                refreshData();
            } else {
                refreshAll();
            }
        }
    }

    if (id == "selOddsType" && location.pathname == '/UnderOver.aspx') {
        if (oOddsType != nOddsType) {
            $.ajax({
                url: '/EuroSite/SetOddsType.ashx',
                data: { OddsType: nOddsType },
                dataType: "jsonp",
                jsonp: "jsoncallback",
                cache: false,
                success: function (e) {
                    console.log("sussess, " + e);
                },
                error: function (x, s, e) {
                    console.log("error, " + e);
                }
            });
        }
    }
}

function getSelecterValue(id) {
    return $("#" + id).attr('value'); //document.getElementById(id).value;
}

function onClickSelecter(id) {

    if (document.getElementById(id + '_Div').className.indexOf('disable') > -1) {
        return;
    }
    var obj = document.getElementById(id + '_menu');

    var onClickOutSelecter = function (e) {
        e = e || window.event;
        var dom = e.srcElement || e.target;
        if (dom.id != id + "_Div" && dom.id != id + "_Txt" && dom.id != id + "_menu" && dom.id != id + "_Icon") {
            if (obj != null) {
                obj.style.visibility = 'hidden';
            }
            $(document).unbind('click', onClickOutSelecter);
        }
    };


    if (obj != null) {
        $(document).unbind('click', onClickOutSelecter);
        if (obj.style.visibility == 'visible') {
            obj.style.visibility = 'hidden';
        }
        else {
            obj.style.visibility = 'visible';
            $(document).bind('click', onClickOutSelecter);
        }


    }
}

function setSelecterDisable(id, isDisable) {
    var obj = document.getElementById(id + "_Div");
    var isIconMode = $("#" + id + "_Txt").find('div').length > 0;
    var classname = isIconMode ? "dropDown icon" : "dropDown";

    if (obj != null) {
        if (isDisable == true) {
            obj.className = classname + " disabled";
        } else {
            obj.className = classname;
        }
    }
}

function isFlashSupported() {
    if (window.ActiveXObject) {
        try {
            if (new ActiveXObject('ShockwaveFlash.ShockwaveFlash'))
                return true;
        } catch (e) { }
    }

    return navigator.plugins['Shockwave Flash'] ? true : false;
}

function checkFlashSupport(saveObj) {
    if (saveObj == null) {
        saveObj = isFlashSupported();
    }

    return saveObj;
}
function switchNoSupportFlashTxt(txtId, switcId) {
    setTimeout(
      function () {
          if ($("#" + txtId)) {
              if (checkFlashSupport(fFrame.FlashSupport)) {
                  $("#" + txtId).hide();
                  if (switcId != null) $("#" + switcId).show();
              } else {
                  $("#" + txtId).show();
                  if (switcId != null) $("#" + switcId).hide();
              }
          }
      },
      1
    );
}

//可在Javascript中使用如同C#中的string.format
//使用方式 : var fullName = String.format('Hello. My name is {0} {1}.', 'FirstName', 'LastName');
String.format = function () {
    var s = arguments[0];
    if (s == null) {
        return "";
    }
    for (var i = 0; i < arguments.length - 1; i++) {
        var reg = getStringFormatPlaceHolderRegEx(i);
        s = s.replace(reg, (arguments[i + 1] == null ? "" : arguments[i + 1]));
    }
    return cleanStringFormatResult(s);
}
//可在Javascript中使用如同C#中的string.format (對jQuery String的擴充方法)
//使用方式 : var fullName = 'Hello. My name is {0} {1}.'.format('FirstName', 'LastName');
String.prototype.format = function () {
    var txt = this.toString();
    for (var i = 0; i < arguments.length; i++) {
        var exp = getStringFormatPlaceHolderRegEx(i);
        txt = txt.replace(exp, (arguments[i] == null ? "" : arguments[i]));
    }
    return cleanStringFormatResult(txt);
}
//讓輸入的字串可以包含{}
function getStringFormatPlaceHolderRegEx(placeHolderIndex) {
    return new RegExp('({)?\\{' + placeHolderIndex + '\\}(?!})', 'gm')
}
//當format格式有多餘的position時，就不會將多餘的position輸出
//ex:
// var fullName = 'Hello. My name is {0} {1} {2}.'.format('firstName', 'lastName');
// 輸出的 fullName 為 'firstName lastName', 而不會是 'firstName lastName {2}'
function cleanStringFormatResult(txt) {
    if (txt == null) {
        return "";
    }
    return txt.replace(getStringFormatPlaceHolderRegEx("\\d+"), "");
}

function GetKenoURL(cust, page, date, detail, VendorID, lan, offsettime) {
    var time = "";
    var param = "";
    var d = "";
    if (typeof date != "undefined") {
        time = "&date=" + date;
    }
    if (typeof detail != "undefined") {
        d = "&detail=" + detail.toUpperCase();
    }
    param = "action=" + page + "&siteID=" + VendorID + "&lang=" + lan + time + d + "&offSetTime=" + offsettime;

    var url = location.href;
    var ary = url.split("/");
    var redirectURL = "http://" + ary[2] + "/AuthorizationCustomer.ashx?cust=" + cust + "&" + param;

    return "AuthorizationCustomer.ashx?cust=" + cust + "&" + param + "&redirectURL=" + encodeURIComponent(redirectURL)
}

function OpenKenoWindow() {
    OpenKeno('M');
}

function OpenKeno(page, date, detail) {
    if (fFrame.CanBetKeno) {
        OpenKenoGame(page, date, detail, 'keno');
    } else {
        alert(fFrame.KenoMsg);
    }
}

function OpenKenoLottery(page, date, detail) {
    if (fFrame.CanBetKeno) {
        OpenKenoGame(page, date, detail, 'kenolottery');
    } else {
        alert(fFrame.KenoLotteryMsg);
    }
}
//// PM say: Can see Keno also can see Keno Lottery
function OpenKenoGame(page, date, detail, cust) {
    var time = "";
    var d = "";
    var lan = (fFrame.UserLang == "zhcn") ? "cs" : fFrame.UserLang;
    if (typeof date != "undefined" && date != null) {
        time = "&date=" + date;
    }
    if (typeof detail != "undefined" && detail != null) {
        d = "&detail=" + detail.toUpperCase();
    }
    var param = "action=" + page + "&siteID=" + fFrame.VendorSiteID + "&lang=" + lan + time + d + "&offSetTime=" + fFrame.OffsetTime + "&cust=" + cust;
    var url = location.href;
    var ary = url.split("/");
    var redirectURL = "http://" + ary[2] + "/AuthorizationCustomer.ashx?" + param;
    var source = "AuthorizationCustomer.ashx?" + param + "&redirectURL=" + encodeURIComponent(redirectURL);
    var msg = (cust == "keno" ? fFrame.KenoFlashMsg : fFrame.KenoLotteryFlashMsg);

    if (page != "M") {
        var callback = function (Handle, isNewOpen) {
            if (!isNewOpen) {
                Handle.location = source;
            }
        }
        fFrame.openWindowsHandle(cust + page, fFrame.CanSeeKeno, msg, source, "fullscreen=1,scrollbars=yes,resizable=yes", false, callback);
    } else {
        fFrame.openWindowsHandle(cust + page, fFrame.CanSeeKeno, msg, source, "fullscreen=1,scrollbars=yes,resizable=yes");
    }
}

function onKeyPressSelecter(id, e) {
    var selected = $('#' + id + '_menu > .selected');
    var c = String.fromCharCode(e.charCode).toUpperCase();
    $('.submenu li').removeClass("selected");
    if (e.keyCode == 13) {
        selected.click();
        return;
    }
    if (e.keyCode == 38) {
        if (selected.prev().length == 0) {
            $('#' + id + '_Div .submenu li').siblings().last().addClass("selected");
        } else {
            selected.prev().addClass("selected");
            if (CheckScrollMove(300, 22, selected.prev().position().top))
                $('#' + id + '_menu').scrollTop($('#' + id + '_menu').scrollTop() + selected.prev().position().top);
        }
    }
    if (e.keyCode == 40) {
        if (selected.next().length == 0) {
            $('#' + id + '_Div .submenu li').siblings().first().addClass("selected");
        } else {
            selected.next().addClass("selected");
            if (CheckScrollMove(300, 22, selected.next().position().top))
                $('#' + id + '_menu').scrollTop($('#' + id + '_menu').scrollTop() + selected.next().position().top);
        }
    }

    if (selected.length == 0) {
        $('#' + id + '_Div .submenu li').each(function () {
            if (c == $(this).text().substring(0, 1)) {
                SetScrollAndSelected(id, $(this));
                return false;
            }
        });
    }
    else {
        var isFindPrev = true;
        var isFindSelf = true;
        selected.nextAll().each(function () {
            if (c == $(this).text().substring(0, 1)) {
                SetScrollAndSelected(id, $(this));
                isFindPrev = false;
                isFindSelf = false;
                return false;
            }
        });

        if (isFindPrev) {
            if (c == selected.prevAll().last().text().substring(0, 1)) {
                SetScrollAndSelected(id, selected.prevAll().last());
                return false;
            }
            selected.prevAll().last().nextUntil($(this)).each(function () {
                if (c == $(this).text().substring(0, 1)) {
                    SetScrollAndSelected(id, $(this));
                    isFindSelf = false;
                    return false;
                }
            });
        }

        if (isFindSelf) {
            if (c == selected.text().substring(0, 1)) {
                SetScrollAndSelected(id, selected);
            }
        }
    }
}

var Sport_Area_CLOSE = "closeEvents";
var Sport_Area_OPEN = "selectType";

function SportControl(SportType) {
    var obj = document.getElementById("SportArea_" + SportType);
    if (obj.className.indexOf(Sport_Area_CLOSE) != -1) {
        obj.className = obj.className.replace(Sport_Area_CLOSE, "").replace(/(^\s*)|(\s*$)/g, "");
    } else {
        obj.className = obj.className.replace(Sport_Area_OPEN, Sport_Area_OPEN + " " + Sport_Area_CLOSE).replace(/(^\s*)|(\s*$)/g, "");
    }
}

function CheckIsIpad() {
    if (!EnableIPadStyle) return false;
    if (navigator.userAgent.match(/Android 4./i)
        || navigator.userAgent.toLowerCase().indexOf("android") != -1
        || navigator.userAgent.toLowerCase().indexOf("mobile") != -1
        || navigator.userAgent.match(/iPad/i)) return true;
    return false;
}

var btguideTimer;
function showBetTradeTip() {
    var elm = fFrame.leftFrame.document.getElementById("bettradeTips");
    if (elm != null) {
        elm.style.display = "";
        clearTimeout(btguideTimer);
        btguideTimer = setTimeout(function () {
            elm.style.display = "none";
        }, 5000);
    }
}

function openBetTradeGuide() {
    window.open("betTrade_guide.aspx", "", "width=700,height=600,location=0,scrollbars=yes,resizable=no");
}

//function switchAsiaSiteType(isLogin, skintype) {
//    var hostName = window.location.host;
//    var actstatus = '';
//    if (typeof fFrame.ActStatus != "undefined") {
//        actstatus = fFrame.ActStatus;
//    }

//    if (!isLogin) {
//        if (actstatus == '1') {
//            fFrame.location.href = "http://" + hostName + "/index.aspx?act=" + skintype;
//        } else {
//            fFrame.location.href = "http://" + hostName + "/vender.aspx?act=" + skintype;
//        }
//    } else {
//        fFrame.location.href = "http://" + hostName + "/main.aspx?act=" + skintype;
//    }
//}

function switchAsiaSiteType() {
	fFrame.location.href = "/onebook?WebSkinType=2&lang=" + fFrame.UserLang + location.hash;
}

function switchToNewMemberSite() {
    parent.parent.postMessage('ToNewView', "*");
}

function ComboDataDisplay(TicketID) {
    //// ComboClass attribute is comboParlay/comboParlay expand in licensee.
    var s = "#Detail_" + TicketID;
    if ($(s).hasClass('comboParlay expand')) {
        $(s).removeClass('comboParlay expand').addClass('comboParlay');
    }
    else {
        $(s).removeClass('comboParlay').addClass('comboParlay expand');
    }
}

var InputNumberOnly = function (obj) {
    try {
        obj.keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    }
    catch(e) {
        console.log(e);
    }
}


/* Promote
 * 2016/11/23
 */

var timerProm,
    isAuto = true;
function prevPromote() {
    var obj = $("#divPromote").find(".slides-control-item").filter(function () { return $(this).css("display") == "block" });
    obj.hide();
    if (obj.prev().length == 0) {
        $("#divPromote").find(".slides-control-item").last().show();
    }
    else {
        obj.prev().show();
    }
}
function nextPromote(isAuto) {
    var obj = $("#divPromote").find(".slides-control-item").filter(function () { return $(this).css("display") == "block" });
    obj.hide();
    if (obj.next().length == 0) {
        if (isAuto) {
            onoffPromote(true);
            clearInterval(timerProm);
        }
        else {
            $("#divPromote").find(".slides-control-item").first().show();
        }
    }
    else {
        obj.next().show();
    }
}
function timerPromote() {
    clearInterval(timerProm);
    timerProm = setInterval("nextPromote(true)", 4000);
}
function clearTimerPromote() {
    clearInterval(timerProm);
}

function onoffPromote(val) {
    var isshow = val ? val : $('#iPromoteTitle').hasClass("icon-arrow_up");

    if (isshow) {
        $('#iPromoteTitle').removeClass("icon-arrow_up").addClass("icon-arrow_down");
        $("#divPromoteContext").hide();
        $("#divEnhancePromote").show();
        $("#divPromote").find(".slides-control-item").hide();
        clearInterval(timerProm);
        if (typeof OpenGamePanelFirstTime !== 'undefined' && OpenGamePanelFirstTime === true) {
            setTimeout(function () {
                OpenMiniGame();
                OpenGamePanelFirstTime = false;
            }, 3000);
        }
    }
    else {
        $('#iPromoteTitle').removeClass("icon-arrow_down").addClass("icon-arrow_up");
        $("#divPromote").find(".slides-control-item").first().show();
        $("#divPromoteContext").show();
        $("#divEnhancePromote").hide();
        timerPromote();
    }
}

function GetQueryString(name, qurstring) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    if (!qurstring) {
        qurstring = window.location.search.substr(1);
    }
    var r = qurstring.match(reg);
    var context = "";
    if (r != null)
        context = r[2];
    reg = null;
    r = null;
    return context == null || context == "" || context == "undefined" ? "" : context;
}

function CashOutUpdatedAmountFormat(Phrase, OldBuyBackAmt, BuyBackAmt) {
    var formatedPhrase = Phrase.replace("OldBuyBackAmt", OldBuyBackAmt).replace("BuyBackAmt", BuyBackAmt);
    return formatedPhrase;
    //return Phrase.format(OldBuyBackAmt, BuyBackAmt);
}

var openBrWindow = null;
var MM_openBrWindow = function (theURL, winName, features) {
    if (!openBrWindow || openBrWindow.closed) {
        openBrWindow = window.open(theURL, winName, features);
    } else {
        openBrWindow.location.href = theURL;
        openBrWindow.focus();
    }
};
