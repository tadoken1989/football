/*******************************************************************************************
 * Class: OddsKeeper
 * Description: Framework for processing Javascript Odds Data to HTML Table
 * Author: Yai Chen
 *******************************************************************************************/

/*	Constant Declaration ==================*/

var TMPL_TABLE_ID = "tmplTable";
var TMPL_COLGROUP_ID = "tmplColgroup";
var TMPL_HEADER_ID = "tmplHeader";
var TMPL_HEADER_LIVE_ID = "tmplHeader_L";
var TMPL_SUBTITLE_ID = "tmplSubTitle";
var TMPL_LEAGUE_ID = "tmplLeague";
var TMPL_LEAGUE_LIVE_ID = "tmplLeague_L";
var TMPL_LIVE_ID = "tmplLive";
var TMPL_LIVE_MASTER_ID = "tmplLiveMaster";
var TMPL_LIVE_FOOTER_ID = "tmplLiveFooter";
var TMPL_EVENT_ID = "tmplEvent";
var TMPL_EVENT_MASTER_ID = "tmplEventMaster";
var TMPL_EVENT_FOOTER_ID = "tmplEventFooter";

var CLS_UPD = "Odds_Upd";
var CLS_SAME = "Odds_Same";
var CLS_LS_OFF = "displayOff";
var CLS_LS_ON = "displayOn";
var LeagueListBySport = [];
var LeagueList = [];
var TotlaLeagueCnt = 0;
var TotlaMainLeagueCnt = 0;
var TotlaSelLeagueCnt = 0;
var arr_League = new Array("0");
var arr_Match = new Array("0");
var CurrentLiveInfoMatchID = "0";
/**
 * Constructor
 */
function OddsKeeper() {

    /**************************************************************
     * private members block
     **************************************************************/
    var _self = this;
    var _oTable = null; //Odds Table DHTML "Element"
    //	var _FuncTagsHash = new Hashtable();

    var _LeagueTmpl = undefined; // string; keep league TR template
    var _LeagueLiveTmpl = undefined; // string; keep live league TR template
    var _LiveTmpl = undefined; // string; keep live event TR template
    var _LiveMasterTmpl = undefined; // string; keep event master TR template
    var _LiveFooterTmpl = undefined; // string; keep event footer TR template
    var _EventTmpl = undefined; // string; keep event TR template
    var _EventMasterTmpl = undefined; // string; keep event master TR template
    var _EventFooterTmpl = undefined; // string; keep event footer TR template

    var _MatchMap = new Array(); // Hash Array; key: MUID, value: index of MUID
    var _DirtyMatch = new Array(); //Hash Array; key: MUID, value: del/srt/ins/updLive/updOdds
    var _DirtyOdds = new Array();	//Hash Array; key: MUID, value: MatchCode
    var _ScoreChangedMap = new Array();	//Hash Array; key: MUID, value: MatchCode
    var _LiveScoreChangedMap = new Array();	//Hash Array; key: MUID, value: MatchCode
    var BetTypesDeatil = new Array();

    /**************************************************************
     * public members block
     **************************************************************/

    this.DivBase = 2;

    this.HashHeader = null;	// Hashtable; Keep Odds Table Header's  Tag Name/ Display Name

    this.DataTags = null;	// Array of String; Keep Odds Data Array's Column Names by order

    this.EventList = null; // Array of Hashtable; Hashed Odds Data Array
    this.HtmlList = null;	// Array of string; HTML of odds event tr row

    this.TemplateFrame = null; // iFrame element;

    this.DataFrame = null; // iFrame element;

    this.TableContainer = null;	// element; a html element can contain <table> element, Odds Table will display over there

    this.BetTypes = null;	// Array of Integer;  array of bettype;

    this.SubTitleField = null;

    this.RegenEverytime = false;

    this.SortType = 0; //0: sort by matchcode; 1: sort by time

    this.SportType = null; // sporttype for LiveScore

    this.OddsType = "4";

    this.slowDelete = false;

    /**************************************************************
     * private methods block
     **************************************************************/

    function _getSubTmpl(templateFrame, id) {
        var oElement = templateFrame.document.getElementById(id);
        if (oElement != null && oElement.title != "") {
            return templateFrame.document.getElementById(oElement.title);
        }
        return oElement;
    }


    /**
	 * Params -
	 *	TmplId: String; id of template;
	 * Return: string;
	 *	template string be processed;
	 */
    function _initialTemplate(oElement) {
        var sTmpl = "";
        if (oElement != undefined) {
            sTmpl = oElement.innerHTML;
            sTmpl = sTmpl.replace(/%7B/g, "{");
            sTmpl = sTmpl.replace(/%7D/g, "}");
            sTmpl = sTmpl.replace(/[	\n]/g, "");
        }
        return sTmpl;
    }

    /*
	 * Return: string;
	 *	table start tag for Odds Table
	 */
    function _getTableTag() {
        var oTable = _self.TemplateFrame.document.getElementById(TMPL_TABLE_ID);
        if (oTable != null) {
            var s = oTable.parentNode.innerHTML;
            s = s.substring(0, s.indexOf(oTable.innerHTML));
            s = s.substr(s.lastIndexOf("<"));
            return s;
        }
        return "<table>";
    }

    /**
	 * Return: string;
	 *	table start tag for Odds Table
	 */
    function _getColgroup() {
        var oColgroup = _self.TemplateFrame.document.getElementById(TMPL_COLGROUP_ID);
        if (oColgroup != null) {
            var s = oColgroup.parentNode.innerHTML;
            s = s.substring(0, s.indexOf(oColgroup.innerHTML) - 1);
            s = s.substr(s.lastIndexOf("<"));
            return s + oColgroup.innerHTML + "</colgroup>";
        }
        return "";
    }

    /**
	 * Return: string;
	 *	generate html string for Odds Table Header
	 */
    function _genHeader() {
        var sHeaderTR = "";
        if (_self.EventList.length == 0) {
            return "";
        } else if (_self.EventList[0]["FlagLive"] == "True") {
            if (_self.SubTitleField == null) {
                if (_self.TemplateFrame.document.getElementById(TMPL_HEADER_LIVE_ID + "_" + _self.SportType) == null) {
                    sHeaderTR = (_self.TemplateFrame.document.getElementById(TMPL_HEADER_LIVE_ID) == null) ? _self.TemplateFrame.document.getElementById(TMPL_HEADER_ID).innerHTML : _self.TemplateFrame.document.getElementById(TMPL_HEADER_LIVE_ID).innerHTML;
                } else {
                    sHeaderTR = _self.TemplateFrame.document.getElementById(TMPL_HEADER_LIVE_ID + "_" + _self.SportType).innerHTML;
                }
            }
        } else {
            if (_self.TemplateFrame.document.getElementById(TMPL_HEADER_ID + "_" + _self.SportType) == null) {
                sHeaderTR = (_self.SubTitleField != null) ? "" : _self.TemplateFrame.document.getElementById(TMPL_HEADER_ID).innerHTML;
            } else {
                sHeaderTR = (_self.SubTitleField != null) ? "" : _self.TemplateFrame.document.getElementById(TMPL_HEADER_ID + "_" + _self.SportType).innerHTML;
            }
        }
        return sHeaderTR;
    }

    /**
	 * Return: string;
	 *	generate html string for Odds Table Header
	 */
    function _genSubTitle(Tag) {
        return (_self.SubTitleField == null) ? "" : _self.TemplateFrame.document.getElementById(TMPL_SUBTITLE_ID + "_" + Tag).innerHTML;
    }

    /**
	 * Params -
	 *	Idx: int; index of EventList
	 * Return: string;
	 *	generate league row html string for Odds Table
	 */
    function _genLeagueTR(Idx) {
        var sLeagueTR = (_self.EventList[Idx]["FlagLive"] == "True") ? _LeagueLiveTmpl : _LeagueTmpl;
        sLeagueTR = _replaceTags(_self.EventList[Idx], sLeagueTR);
        if (_self.afterNewLeague != null) {
            sLeagueTR = _self.afterNewLeague(_self.EventList, Idx, sLeagueTR);
        }
        return sLeagueTR;
    }

    /**
	 * Params -
	 *	Idx: int; index of EventList
	 * Return: string;
	 *	generate event html string for Odds Table
	 *
	 * Callback: afterNewEvent(EventList, Idx, sHTML, IsLive);
	 */
    function _genEventTR(Idx) {
        var isLive = (_self.EventList[Idx]["FlagLive"] == "True");
        var sHTML;
        if (isLive) {
            sHTML = _replaceTags(_self.EventList[Idx], _LiveTmpl);
            sHTML = _CheckIsLiveInfoMatch(sHTML, Idx);
        } else {
            sHTML = _replaceTags(_self.EventList[Idx], _EventTmpl);
        }

        if (_self.afterNewEvent != null) {
            sHTML = _self.afterNewEvent(_self.EventList, Idx, sHTML, isLive, BetTypesDeatil);
        }
        return sHTML;
    }

    /**
	 * Params -
	 *	Idx: int; index of EventList
	 * Return: string;
	 *	generate event html string for Odds Table
	 */
    function _genEventMasterTR(Idx) {
        var isLive = (_self.EventList[Idx]["FlagLive"] == "True");
        var sHTML;
        if (isLive) {
            sHTML = _replaceTags(_self.EventList[Idx], _LiveMasterTmpl);
            sHTML = _CheckIsLiveInfoMatch(sHTML, Idx);
        } else {
            sHTML = _replaceTags(_self.EventList[Idx], _EventMasterTmpl);
        }

        if (_self.afterNewEvent != null) {
            sHTML = _self.afterNewEvent(_self.EventList, Idx, sHTML, isLive, BetTypesDeatil);
        }
        return sHTML;
    }

    function _genEventFooterTR(Idx) {
        var isLive = (_self.EventList[Idx]["FlagLive"] == "True");
        var sHTML;
        if (isLive) {
            sHTML = _replaceTags(_self.EventList[Idx], _LiveFooterTmpl);
            sHTML = _CheckIsLiveInfoMatch(sHTML, Idx);
        } else {
            sHTML = _replaceTags(_self.EventList[Idx], _EventFooterTmpl);
        }

        if (_self.afterNewEvent != null) {
            sHTML = _self.afterNewEvent(_self.EventList, Idx, sHTML, isLive, BetTypesDeatil);
        }
        return sHTML;
    }

    function _CheckIsLiveInfoMatch(sHTML, Idx) {
        if (CurrentLiveInfoMatchID == _self.EventList[Idx]["MatchId"]) {
            var target = "";
            if (sHTML.indexOf("<td") == -1)
                target = sHTML.substring(sHTML.indexOf("<TD"), sHTML.indexOf("</TD>") + 5);
            else
                target = sHTML.substring(sHTML.indexOf("<td"), sHTML.indexOf("</td>") + 5);
            if (fFrame.DisplayMode == "3") {
                sHTML = sHTML.replace(target, "<td class='text_time' rowspan='2'><b class='IsLive'>" + _self.EventList[Idx]["ShowTime"] + "</b></td>");
            } else {
                sHTML = sHTML.replace(target, "<td class='text_time'><b class='IsLive'>" + _self.EventList[Idx]["ShowTime"] + "</b></td>");
            }
        }
        return sHTML;
    }
    /**************************************************************
     * public methods block
     **************************************************************/

    /**
	 * Return: Element; Odds Table DHTML Element
	 */
    this.getTable = function () {
        return _oTable;
    }



    /**
	 * Set Template into, Template will be formated over here.
	 * Params -
	 *	aTmpl: object; a window object contented template;
	 * Return: void;
	 */
    this.setTemplate = function (aTmpl) {
        this.TemplateFrame = aTmpl;

        var oElement = _getSubTmpl(this.TemplateFrame, TMPL_LEAGUE_ID + "_" + _self.SportType);
        if (oElement == null) {
            oElement = _getSubTmpl(this.TemplateFrame, TMPL_LEAGUE_ID);
        }

        _LeagueTmpl = _initialTemplate(oElement);
        _LeagueTmpl = _formatTemplate(_LeagueTmpl, "{%", "}");

        var oElement = _getSubTmpl(this.TemplateFrame, TMPL_LEAGUE_LIVE_ID + "_" + _self.SportType);
        if (oElement == null) {
            oElement = _getSubTmpl(this.TemplateFrame, TMPL_LEAGUE_LIVE_ID);
        }
        if (oElement == null) {
            _LeagueLiveTmpl = _LeagueTmpl;
        } else {
            _LeagueLiveTmpl = _initialTemplate(oElement);
            _LeagueLiveTmpl = _formatTemplate(_LeagueLiveTmpl, "{%", "}");
        }

        oElement = _getSubTmpl(this.TemplateFrame, TMPL_EVENT_ID + "_" + _self.SportType);
        if (oElement == null)
            oElement = _getSubTmpl(this.TemplateFrame, TMPL_EVENT_ID);
        _EventTmpl = _initialTemplate(oElement);
        _EventTmpl = _formatTemplate(_EventTmpl, "{%", "}");

        oElement = _getSubTmpl(this.TemplateFrame, TMPL_LIVE_ID + "_" + _self.SportType);
        if (oElement == null) {
            oElement = this.TemplateFrame.document.getElementById(TMPL_LIVE_ID);
            if (oElement == null) {
                _LiveTmpl = _EventTmpl;
            } else {
                _LiveTmpl = _initialTemplate(oElement);
                _LiveTmpl = _formatTemplate(_LiveTmpl, "{%", "}");
            }
        } else {
            _LiveTmpl = _initialTemplate(oElement);
            _LiveTmpl = _formatTemplate(_LiveTmpl, "{%", "}");
        }
        oElement = _getSubTmpl(this.TemplateFrame, TMPL_EVENT_MASTER_ID + "_" + _self.SportType);
        if (oElement == null) {
            oElement = _getSubTmpl(this.TemplateFrame, TMPL_EVENT_MASTER_ID);
            if (oElement == null) {
                _EventMasterTmpl = _EventTmpl;
            } else {
                _EventMasterTmpl = _initialTemplate(oElement);
                _EventMasterTmpl = _formatTemplate(_EventMasterTmpl, "{%", "}");
            }
        } else {
            _EventMasterTmpl = _initialTemplate(oElement);
            _EventMasterTmpl = _formatTemplate(_EventMasterTmpl, "{%", "}");
        }
        oElement = _getSubTmpl(this.TemplateFrame, TMPL_EVENT_FOOTER_ID + "_" + _self.SportType);
        if (oElement == null) {
            oElement = _getSubTmpl(this.TemplateFrame, TMPL_EVENT_FOOTER_ID);
            if (oElement == null) {
                _EventFooterTmpl = _EventMasterTmpl;
            } else {
                _EventFooterTmpl = _initialTemplate(oElement);
                _EventFooterTmpl = _formatTemplate(_EventFooterTmpl, "{%", "}");
            }
        } else {
            _EventFooterTmpl = _initialTemplate(oElement);
            _EventFooterTmpl = _formatTemplate(_EventFooterTmpl, "{%", "}");
        }
        oElement = _getSubTmpl(this.TemplateFrame, TMPL_LIVE_MASTER_ID + "_" + _self.SportType);
        if (oElement == null) {
            oElement = this.TemplateFrame.document.getElementById(TMPL_LIVE_MASTER_ID);
            if (oElement == null) {
                _LiveMasterTmpl = _LiveTmpl;
            } else {
                _LiveMasterTmpl = _initialTemplate(oElement);
                _LiveMasterTmpl = _formatTemplate(_LiveMasterTmpl, "{%", "}");
            }
        } else {
            _LiveMasterTmpl = _initialTemplate(oElement);
            _LiveMasterTmpl = _formatTemplate(_LiveMasterTmpl, "{%", "}");
        }

        oElement = _getSubTmpl(this.TemplateFrame, TMPL_LIVE_FOOTER_ID + "_" + _self.SportType);
        if (oElement == null) {
            oElement = this.TemplateFrame.document.getElementById(TMPL_LIVE_FOOTER_ID);
            if (oElement == null) {
                _LiveFooterTmpl = _LiveMasterTmpl;
            } else {
                _LiveFooterTmpl = _initialTemplate(oElement);
                _LiveFooterTmpl = _formatTemplate(_LiveFooterTmpl, "{%", "}");
            }
        } else {
            _LiveFooterTmpl = _initialTemplate(oElement);
            _LiveFooterTmpl = _formatTemplate(_LiveFooterTmpl, "{%", "}");
        }
        /*var arrTags = oElement.innerHTML.match(/{@.+?}/g);
		_FuncTagsHash = new Hashtable();
		if (arrTags != null) {
			for (var i = 0; i < arrTags.length; i++) {
				var s = arrTags[i].substr(2, arrTags[i].length - 3);
				var f = window[s];
				if (typeof(f) == "function") {
					_FuncTagsHash.put(s, f);
				}
			}
		}*/
    }
    function getBettypesDetail_fromDataTags() {

        for (var i = 0; i < _self.DataTags.length; i++) {
            var idx = _self.DataTags[i].search("Odds_");
            if (idx != -1) {
                BetTypesDeatil.push(_self.DataTags[i]);
            }
        }
    }
    /**
	 * set data array into EvenList
	 *Params -
	 *	DataArrays: Array of Arrays of String, generated by Embed DataFrame
	 *	DataTags: array of string; Defined Data Tags by DataArray Sequence
	 */
    this.setDatas = function (DataArrays, DataTags) {
        this.DataTags = DataTags;
        getBettypesDetail_fromDataTags();
        //live score def field
        var oArray = new Array(DataArrays.length);
        var iMatchIndex = 0;
        for (var i = 0; i < DataArrays.length; i++) {
            var oHash = _hashData(DataArrays[i], DataTags);
            if (oHash["LeagueId"] == "") {
                var ooHash = oArray[i - 1];
                oHash["LeagueId"] = ooHash["LeagueId"];
                oHash["LeagueName"] = ooHash["LeagueName"];
            }
            if (oHash["MUID"] == "") {
                var ooHash = oArray[i - 1];
                oHash["MUID"] = ooHash["MUID"];
                oHash["MatchId"] = ooHash["MatchId"];
                oHash["MatchCode"] = ooHash["MatchCode"];
                oHash["HomeName"] = ooHash["HomeName"];
                oHash["AwayName"] = ooHash["AwayName"];
                oHash["KickoffTime"] = ooHash["KickoffTime"];
                oHash["ShowTime"] = ooHash["ShowTime"];
                oHash["StatsId"] = ooHash["StatsId"];
                oHash["SportRadar"] = ooHash["SportRadar"];
                oHash["StreamingId"] = ooHash["StreamingId"];
                oHash["Favorite"] = ooHash["Favorite"];
                oHash["TimerSuspend"] = ooHash["TimerSuspend"];
                oHash["ScoreH"] = ooHash["ScoreH"];
                oHash["ScoreA"] = ooHash["ScoreA"];
                oHash["MatchIndex"] = ooHash["MatchIndex"];
                //live score data parse
                if (typeof (LIVE_SCORE_DEF[_self.SportType]) != "undefined") {
                    var arrFieldDef = LIVE_SCORE_DEF[_self.SportType];
                    for (var j = 0; j < arrFieldDef.length; j++) {
                        if (typeof (ooHash[arrFieldDef[j]]) != "undefined") {
                            oHash[arrFieldDef[j]] = ooHash[arrFieldDef[j]];
                        }
                    }
                }
            } else {
                oHash["MatchIndex"] = iMatchIndex++;
            }
            oHash["Div"] = oHash["MatchIndex"] % this.DivBase;
            if (this.afterSetData != null) {
                this.afterSetData(i, oHash, oArray);
            }

            oArray[i] = oHash;
        }
        this.EventList = oArray;
    }

    /**
	 * rebuild a HTML Odds Table and Display
	 * Params -
	 *	DataArrays: Array contain string arrays from DataFrame generate
	 * Return: void;
	 *
	 * Callback -
	 *	afterNewLeague(this.EventList, i, sLeagueTR)
	 *	afterNewEvent = function(EventList, Index, HTML)
	 *	afterRepaintTable = function(_oTable)
	 */
    this.paintOddsTable = function () {
        getLeagueList();
        if (this.EventList == null) return;
        var arrHtml = new Array(this.EventList.length + 26);
        this.HtmlList = new Array(this.EventList.length);

        arrHtml.push(_getTableTag());
        arrHtml.push(_getColgroup());
        arrHtml.push("<THead>");
        arrHtml.push(_genHeader());
        arrHtml.push("</THead><TBody>");

        var sPreLeague, sPreMUID, sNexMUID, sEventTR, sPreSubTitle;
        for (var i = 0; i < this.EventList.length; i++) {
            if (this.SubTitleField != null) {
                var sSubTitle = this.EventList[i][this.SubTitleField];
                if (sPreSubTitle != sSubTitle) {
                    arrHtml.push(_genSubTitle(sSubTitle));
                    sPreSubTitle = sSubTitle;
                }
            }

            var IsMainMarket = true;
            if (typeof (this.EventList[i]["IsMainMarket"]) != "undefined") {
                IsMainMarket = isFilterMainMarket(this.EventList[i]["IsMainMarket"]);
            }

            var sLeague = this.EventList[i]["LeagueId"];
            var sMatch = this.EventList[i]["MatchId"];
            var sKickoffTime = this.EventList[i]["KickoffTime"];
            if (sLeague != sPreLeague && isFilterLeague(sLeague) && IsMainMarket && isFilterKickoffTime(sKickoffTime) && isFilterMatch(sMatch)) {
                var LeagueTR = _genLeagueTR(i);
                if (LeagueTR != "") {
                    sPreLeague = sLeague;
                    arrHtml.push(LeagueTR);
                }
            }

            var sMUID = this.EventList[i]["MUID"];
            if (i < this.EventList.length - 1) {
                sNexMUID = this.EventList[i + 1]["MUID"];
            }

            if (sPreMUID != sMUID) {
                //sPreMUID = sMUID;
                _MatchMap[sMUID] = i; //put data index into _MatchMap
            }

            if (sNexMUID != sMUID || i == this.EventList.length - 1) {
                sEventTR = _genEventFooterTR(i);
            } else {
                if (sPreMUID == sMUID) {
                    sEventTR = _genEventTR(i);
                } else {
                    sEventTR = _genEventMasterTR(i);
                }
            }
            sPreMUID = sMUID;

            this.HtmlList[i] = sEventTR;
            if (isFilterLeague(sLeague) && IsMainMarket && isFilterKickoffTime(sKickoffTime) && isFilterMatch(sMatch)) {
                arrHtml.push(sEventTR);
            }
        }

        arrHtml.push("</TBody></Table>");
        var s = arrHtml.join("");
        //arrTicks.push( new Date().getTime());
        //alert(s);
        this.TableContainer.innerHTML = s;

        _oTable = null;
        _oTable = this.TableContainer.childNodes[0];
        if (this.afterRepaintTable != null) {
            this.afterRepaintTable(_oTable, this.EventList);
        }
    }

    /**
	 * refresh Odds Table display value and style
	 * Params -
	 *	ArrDel: array of delete data.
	 *	ArrSrt: array of resort data.
	 *	ArrIns: array of insert data.
	 *	ArrUpdLive: array of update live showtime data.
	 *	ArrUpdShowtime: array of update non-live showtime data.
	 *	ArrUpdOdds: array of update odds value data.
	 *
	 * Return: void;
	 *
	 * Callback -
	 *	updateOddsTable = function(TableElement)
	 *	afterRepaintTable = function(TableElement)
	 */
    this.refreshOddsTable = function (ArrDel, ArrSrt, ArrIns, ArrUpdLive, ArrUpdMatch, ArrUpdOdds, ArrUpdAppend, ArrUpdLiveScore) {
        this.TableContainer.innerHTML = "";
        _DirtyMatch = new Array();

        _updateMatch(ArrUpdMatch);
        _updateLive(ArrUpdLive);
        _updateOdds(ArrUpdOdds);
        if (this.updateAppendFields != null) {
            this.updateAppendFields(ArrUpdAppend, this.EventList, _MatchMap, _DirtyMatch);
        }
        if (ArrUpdLiveScore != null) {
            _updateLiveScore(ArrUpdLiveScore);
        }

        _deleteEvents(ArrDel);
        _resortEvents(ArrSrt);
        _insertEvents(ArrIns);
        //arrTicks.push( new Date().getTime());

        this.regenTableHtml();
    }

    /**
     * live events showtime field update method
     * Params:
     *	ArrUpdLive: array of update live showtime data.
     * Return: void.
     */
    function _updateLive(ArrUpdLive) {
        for (var i = 0; i < ArrUpdLive.length; i++) {
            var sMUID = ArrUpdLive[i][0];
            var sShowtime = ArrUpdLive[i][1];
            var sCsStatus = ArrUpdLive[i][2];
            var sInjuryTime = ArrUpdLive[i][3];
            var sLivePeriod = ArrUpdLive[i][4];
            var sScoreH = ArrUpdLive[i][5];
            var sScoreA = ArrUpdLive[i][6];
            var sTimerSuspend = ArrUpdLive[i][7];
            var idx = _MatchMap[sMUID];
            if (idx == null) {
                continue;
            }
            var ScoreChanged = true;
            while ((idx < _self.EventList.length) && (_self.EventList[idx]["MUID"] == sMUID)) {
                var aEvent = _self.EventList[idx];
                aEvent["FlagLive"] = "True";
                aEvent["ShowTime"] = sShowtime;
                aEvent["LivePeriod"] = sLivePeriod;
                aEvent["CsStatus"] = sCsStatus;
                aEvent["InjuryTime"] = sInjuryTime;
                aEvent["TimerSuspend"] = sTimerSuspend;
                if ((aEvent["ScoreH"] != sScoreH) || (aEvent["ScoreA"] != sScoreA)) {
                    aEvent["ScoreH"] = sScoreH;
                    aEvent["ScoreA"] = sScoreA;
                    aEvent["Changed_Score"] = CLS_UPD;
                    if (_self.afterScoreChanged != null && ScoreChanged) {
                        _self.afterScoreChanged(_self.EventList, idx);
                        ScoreChanged = false;
                    }
                    _ScoreChangedMap[sMUID] = new Date().getTime();
                } else {
                    var preTime = _ScoreChangedMap[sMUID];
                    if (preTime != null) {
                        if ((new Date().getTime() - preTime) > 30 * 1000) {
                            _ScoreChangedMap[sMUID] = undefined;
                            for (var i = idx; i < _self.EventList.length; i++) {
                                var nEvent = _self.EventList[i];
                                if (nEvent["MUID"] != sMUID) {
                                    break;
                                }
                                nEvent["Changed_Score"] = "";
                            }
                        } else {
                            aEvent["Changed_Score"] = CLS_UPD;
                        }
                    }

                    preTime = _LiveScoreChangedMap[sMUID];
                    if (preTime != null) {
                        if ((new Date().getTime() - preTime) > 30 * 1000) {
                            _LiveScoreChangedMap[sMUID] = undefined;
                            for (var i = idx; i < _self.EventList.length; i++) {
                                var nEvent = _self.EventList[i];
                                if (nEvent["MUID"] != sMUID) {
                                    break;
                                }
                                switch (_self.SportType) {
                                    case "2":
                                        nEvent["Changed_Score_1Q"] = "";
                                        nEvent["Changed_Score_2Q"] = "";
                                        nEvent["Changed_Score_3Q"] = "";
                                        nEvent["Changed_Score_4Q"] = "";
                                        nEvent["Changed_Score_OT"] = "";
                                        //nEvent["Changed_ScoreTG"] = "";
                                        break;
                                    case "3":
                                        nEvent["Changed_Score_1Q"] = "";
                                        nEvent["Changed_Score_2Q"] = "";
                                        nEvent["Changed_Score_3Q"] = "";
                                        nEvent["Changed_Score_4Q"] = "";
                                        nEvent["Changed_Score_OT"] = "";
                                        nEvent["Changed_DOWN"] = "";
                                        nEvent["Changed_TOGO"] = "";
                                        break;
                                    case "4":
                                        nEvent["Changed_1s"] = "";
                                        nEvent["Changed_2s"] = "";
                                        nEvent["Changed_3s"] = "";
                                        nEvent["Changed_Score_OT"] = "";
                                        break;
                                    case "7":
                                        nEvent["Changed_1s"] = "";
                                        nEvent["Changed_Cfm"] = "";
                                        nEvent["Changed_Pt"] = "";
                                        break;
                                    case "5":
                                    case "6":
                                    case "9":
                                        nEvent["Changed_1s"] = "";
                                        nEvent["Changed_2s"] = "";
                                        nEvent["Changed_3s"] = "";
                                        nEvent["Changed_4s"] = "";
                                        nEvent["Changed_5s"] = "";
                                        nEvent["Changed_Set"] = "";
                                        //nEvent["Changed_Game"] = "";
                                        nEvent["Changed_Pt"] = "";
                                        //nEvent["Changed_TG"] = "";
                                        break;
                                    case "8":
                                        nEvent["Changed_1s"] = "";
                                        nEvent["Changed_2s"] = "";
                                        nEvent["Changed_3s"] = "";
                                        nEvent["Changed_4s"] = "";
                                        nEvent["Changed_5s"] = "";
                                        nEvent["Changed_6s"] = "";
                                        nEvent["Changed_7s"] = "";
                                        nEvent["Changed_8s"] = "";
                                        nEvent["Changed_9s"] = "";
                                        nEvent["Changed_OT"] = "";
                                        nEvent["Changed_1b"] = "";
                                        nEvent["Changed_2b"] = "";
                                        nEvent["Changed_3b"] = "";
                                        nEvent["Changed_out"] = "";
                                        break;
                                    default:
                                }
                            }
                        }
                    }
                }
                idx++;
            }
            _DirtyMatch[sMUID] = "live";
        }
    }

    /**
     * non-live events showtime field update method
     * Params:
     *	ArrUpdShowtime: array of update live showtime data.
     * Return: void.
     */
    function _updateMatch(ArrUpdMatch) {
        for (var i = 0; i < ArrUpdMatch.length; i++) {
            var sMUID = ArrUpdMatch[i][0];
            var idx = _MatchMap[sMUID];
            if (idx == null) {
                continue;
            }

            while ((idx < _self.EventList.length) && (_self.EventList[idx]["MUID"] == sMUID)) {
                var aEvent = _self.EventList[idx];
                if (aEvent["FlagLive"] != "True") {
                    aEvent["ShowTime"] = ArrUpdMatch[i][1];
                }
                aEvent["StatsId"] = ArrUpdMatch[i][2];
                aEvent["SportRadar"] = ArrUpdMatch[i][3];
                aEvent["StreamingId"] = ArrUpdMatch[i][4];
                aEvent["Favorite"] = ArrUpdMatch[i][5];
                aEvent["HomeName"] = ArrUpdMatch[i][6];
                aEvent["AwayName"] = ArrUpdMatch[i][7];
                aEvent["KickoffTime"] = ArrUpdMatch[i][8];
                idx++;
            }
            _DirtyMatch[sMUID] = "Match";
        }
    }


    /**
     * odds values update method
     * Params:
     *	ArrUpdOdds: array of odds value update data.
     * Return: void.
     */
    function _updateOdds(ArrUpdOdds) {
        //clear old odds changed flags
        for (var sMUID in _DirtyOdds) {
            var idx = _MatchMap[sMUID];
            if (idx == null) {
                continue;
            }

            while ((idx < _self.EventList.length) && (_self.EventList[idx]["MUID"] == sMUID)) {
                for (var i = 0; i < BetTypesDeatil.length; i++) {
                    _self.EventList[idx]["Changed_" + BetTypesDeatil[i]] = "";
                }
                for (var j = 0; j < _self.BetTypes.length; j++) {
                    _self.EventList[idx]["Changed_" + _self.BetTypes[j]] = "";
                }
                _DirtyMatch[sMUID] = "oddsClear";
                idx++;
            }
        }

        //add changed odds to this.EventList
        _DirtyOdds = new Array();
        for (var i = 0; i < ArrUpdOdds.length; i++) {
            var sMUID = ArrUpdOdds[i][0];
            var iBetType = ArrUpdOdds[i][1];
            var sOddsId = ArrUpdOdds[i][2];

            var idx = _MatchMap[sMUID];

            var bOddsFound = false;
            var oHash = _hashData(ArrUpdOdds[i], ODDS_DEF[iBetType]);

            var OddsUpdateClass;

            while ((idx < _self.EventList.length) && (_self.EventList[idx]["MUID"] == sMUID)) {
                OddsUpdateClass = '';
                if (_self.EventList[idx]["OddsId_" + iBetType] == sOddsId) {
                    bOddsFound = true;
                    _DirtyMatch[_self.EventList[idx]["MUID"]] = "oddsNew";
                    var iCount = 0;
                    var bChanged = false;
                    for (var sKey in oHash) {

                        if ((iCount >= 3) && (_self.EventList[idx][sKey] != oHash[sKey])) {
                            if (iBetType == 905) {
                                _self.EventList[idx][sKey.replace("Odds", "Changed")] = CLS_UPD;
                            }
                            if (sKey.indexOf('Odds_') != -1) {

                                if (oHash[sKey] > _self.EventList[idx][sKey]) {

                                    _self.EventList[idx]["Changed_" + sKey] = oHash[sKey] < 0 ? 'BadOdds' : 'BestOdds';
                                } else {

                                    _self.EventList[idx]["Changed_" + sKey] = _self.EventList[idx][sKey] < 0 ? 'BestOdds' : 'BadOdds';
                                }
                            }
                            _self.EventList[idx][sKey] = oHash[sKey];
                            bChanged = true;
                        }
                        iCount++;
                    }
                    if (bChanged) {
                        _self.EventList[idx]["Changed_" + iBetType] = CLS_UPD;
                        _DirtyOdds[_self.EventList[idx]["MUID"]] = 1;
                    }
                    break;
                }
                idx++;
            }
            //alert debug message, should be never in================
            /*if (!bOddsFound) {
				alert("update OddsId:" + sOddsId + " not found!\nMUID:" + sMUID);
			}*/
            //=======================================================
        }
    }
    function _updateLiveScoreChanged_Football(ArrUpdLiveScore) {
        _updateLiveScoreChanged_NBA(ArrUpdLiveScore);
        for (var i = 0; i < ArrUpdLiveScore.length; i++) {
            var sMUID = ArrUpdLiveScore[i][0];
            var idx = _MatchMap[sMUID];
            if (idx == null) {
                continue;
            }
            var bScoreChg = false;
            while ((idx < _self.EventList.length) && (_self.EventList[idx]["MUID"] == sMUID)) {
                var aEvent = _self.EventList[idx];
                bScoreChg = false;
                if (aEvent["DOWN"] != ArrUpdLiveScore[i][14]) {
                    aEvent["Changed_DOWN"] = CLS_UPD;
                    bScoreChg = true;
                }
                if (aEvent["TOGO"] != ArrUpdLiveScore[i][15]) {
                    aEvent["Changed_TOGO"] = CLS_UPD;
                    bScoreChg = true;
                }
                if (bScoreChg) {
                    _LiveScoreChangedMap[sMUID] = new Date().getTime();
                }
                idx++;
            }
        }

    }

    function _updateLiveScoreChanged_NBA(ArrUpdLiveScore) {
        for (var i = 0; i < ArrUpdLiveScore.length; i++) {
            var sMUID = ArrUpdLiveScore[i][0];
            var idx = _MatchMap[sMUID];
            if (idx == null) {
                continue;
            }
            var bScoreChg = false;
            while ((idx < _self.EventList.length) && (_self.EventList[idx]["MUID"] == sMUID)) {
                var aEvent = _self.EventList[idx];
                bScoreChg = false;
                if (aEvent["H1Q"] != ArrUpdLiveScore[i][3] || aEvent["A1Q"] != ArrUpdLiveScore[i][7]) {
                    aEvent["Changed_Score_1Q"] = CLS_UPD;
                    bScoreChg = true;
                }
                if (aEvent["H2Q"] != ArrUpdLiveScore[i][4] || aEvent["A2Q"] != ArrUpdLiveScore[i][8]) {
                    aEvent["Changed_Score_2Q"] = CLS_UPD;
                    bScoreChg = true;
                }
                if (aEvent["H3Q"] != ArrUpdLiveScore[i][5] || aEvent["A3Q"] != ArrUpdLiveScore[i][9]) {
                    aEvent["Changed_Score_3Q"] = CLS_UPD;
                    bScoreChg = true;
                }
                if (aEvent["H4Q"] != ArrUpdLiveScore[i][6] || aEvent["A4Q"] != ArrUpdLiveScore[i][10]) {
                    aEvent["Changed_Score_4Q"] = CLS_UPD;
                    bScoreChg = true;
                }
                if (aEvent["HOT"] != ArrUpdLiveScore[i][11] || aEvent["AOT"] != ArrUpdLiveScore[i][12]) {
                    aEvent["Changed_Score_OT"] = CLS_UPD;
                    bScoreChg = true;
                }
                if (bScoreChg) {
                    _LiveScoreChangedMap[sMUID] = new Date().getTime();
                }
                idx++;
            }
        }
    }

    function _updateLiveScoreChanged_Tennis(ArrUpdLiveScore) {
        for (var i = 0; i < ArrUpdLiveScore.length; i++) {
            var sMUID = ArrUpdLiveScore[i][0];
            var idx = _MatchMap[sMUID];
            if (idx == null) {
                continue;
            }
            var bScoreChg = false;
            while ((idx < _self.EventList.length) && (_self.EventList[idx]["MUID"] == sMUID)) {
                var aEvent = _self.EventList[idx];
                bScoreChg = false;
                if (aEvent["HS"] != ArrUpdLiveScore[i][15] || aEvent["AS"] != ArrUpdLiveScore[i][16]) {
                    aEvent["Changed_Set"] = CLS_UPD;
                    bScoreChg = true;
                }
                if (parseInt(ArrUpdLiveScore[i][2], 10) > 0) {
                    if (aEvent["H" + ArrUpdLiveScore[i][2] + "S"] != ArrUpdLiveScore[i][parseInt(ArrUpdLiveScore[i][2], 10) + 2] || aEvent["A" + ArrUpdLiveScore[i][2] + "S"] != ArrUpdLiveScore[i][parseInt(ArrUpdLiveScore[i][2], 10) + 7]) {
                        aEvent["Changed_" + ArrUpdLiveScore[i][2] + "s"] = CLS_UPD;
                        //aEvent["Changed_Game"] = CLS_UPD;
                        bScoreChg = true;
                    }
                }
                if (aEvent["HPT"] != ArrUpdLiveScore[i][13] || aEvent["APT"] != ArrUpdLiveScore[i][14]) {
                    if (ArrUpdLiveScore[i][13] == "0" && ArrUpdLiveScore[i][14] == "0") {
                        aEvent["Changed_Pt"] = "";
                    } else {
                        aEvent["Changed_Pt"] = CLS_UPD;
                    }
                    bScoreChg = true;
                }
                if (bScoreChg) {
                    _LiveScoreChangedMap[sMUID] = new Date().getTime();
                }
                idx++;
            }
        }
    }

    function _updateLiveScoreChanged_Billiard(ArrUpdLiveScore) {
        for (var i = 0; i < ArrUpdLiveScore.length; i++) {
            var sMUID = ArrUpdLiveScore[i][0];
            var idx = _MatchMap[sMUID];
            if (idx == null) {
                continue;
            }
            var bScoreChg = false;
            while ((idx < _self.EventList.length) && (_self.EventList[idx]["MUID"] == sMUID)) {
                var aEvent = _self.EventList[idx];
                bScoreChg = false;
                if (aEvent["HFM"] != ArrUpdLiveScore[i][2] || aEvent["AFM"] != ArrUpdLiveScore[i][3]) {
                    aEvent["Changed_1s"] = CLS_UPD;
                    bScoreChg = true;
                }
                if (aEvent["CFM"] != ArrUpdLiveScore[i][4]) {
                    aEvent["Changed_Cfm"] = CLS_UPD;
                    bScoreChg = true;
                }

                if (aEvent["HPT"] != ArrUpdLiveScore[i][5] || aEvent["APT"] != ArrUpdLiveScore[i][6]) {
                    if (ArrUpdLiveScore[i][5] == "0" && ArrUpdLiveScore[i][6] == "0") {
                        aEvent["Changed_Pt"] = "";
                    } else {
                        aEvent["Changed_Pt"] = CLS_UPD;
                    }
                    bScoreChg = true;
                }
                if (bScoreChg) {
                    _LiveScoreChangedMap[sMUID] = new Date().getTime();
                }
                idx++;
            }
        }
    }

    function _updateLiveScoreChanged_IceHockey(ArrUpdLiveScore) {
        for (var i = 0; i < ArrUpdLiveScore.length; i++) {
            var sMUID = ArrUpdLiveScore[i][0];
            var idx = _MatchMap[sMUID];
            if (idx == null) {
                continue;
            }
            var bScoreChg = false;
            while ((idx < _self.EventList.length) && (_self.EventList[idx]["MUID"] == sMUID)) {
                var aEvent = _self.EventList[idx];
                bScoreChg = false;
                if (parseInt(ArrUpdLiveScore[i][2], 10) > 0) {
                    if (aEvent["H" + ArrUpdLiveScore[i][2] + "S"] != ArrUpdLiveScore[i][parseInt(ArrUpdLiveScore[i][2], 10) + 2] || aEvent["A" + ArrUpdLiveScore[i][2] + "S"] != ArrUpdLiveScore[i][parseInt(ArrUpdLiveScore[i][2], 10) + 5]) {
                        aEvent["Changed_" + ArrUpdLiveScore[i][2] + "s"] = CLS_UPD;
                        bScoreChg = true;
                    }
                }
                if (aEvent["HOT"] != ArrUpdLiveScore[i][9] || aEvent["AOT"] != ArrUpdLiveScore[i][10]) {
                    aEvent["Changed_Score_OT"] = CLS_UPD;
                    bScoreChg = true;
                }
                if (bScoreChg) {
                    _LiveScoreChangedMap[sMUID] = new Date().getTime();
                }
                idx++;
            }
        }
    }

    function _updateLiveScoreChanged_Baseball(ArrUpdLiveScore) {
        for (var i = 0; i < ArrUpdLiveScore.length; i++) {
            var sMUID = ArrUpdLiveScore[i][0];
            var idx = _MatchMap[sMUID];
            if (idx == null) {
                continue;
            }
            var bScoreChg = false;
            while ((idx < _self.EventList.length) && (_self.EventList[idx]["MUID"] == sMUID)) {
                var aEvent = _self.EventList[idx];
                bScoreChg = false;
                for (j = 1; j <= 9; j++) {
                    if (aEvent["H" + j + "S"] != ArrUpdLiveScore[i][j + 2] || aEvent["A" + j + "S"] != ArrUpdLiveScore[i][j + 11]) {
                        aEvent["Changed_" + j + "s"] = CLS_UPD;
                        bScoreChg = true;
                    }
                }
                if (aEvent["HOT"] != ArrUpdLiveScore[i][21] || aEvent["AOT"] != ArrUpdLiveScore[i][22]) {
                    aEvent["Changed_OT"] = CLS_UPD;
                    bScoreChg = true;
                }
                if (aEvent["Battle"] != ArrUpdLiveScore[i][22]) {
                    if (ArrUpdLiveScore[i][24] == "0" && ArrUpdLiveScore[i][25] == "0" && ArrUpdLiveScore[i][26] == "0") {
                        for (j = 1; j <= 3; j++) {
                            aEvent["Changed_" + j + "b"] = "";
                        }
                    } else {
                        for (j = 1; j <= 3; j++) {
                            if (aEvent["B" + j] != ArrUpdLiveScore[i][23 + j]) {
                                aEvent["Changed_" + j + "b"] = CLS_UPD;
                                bScoreChg = true;
                            }
                        }
                    }
                    if (ArrUpdLiveScore[i][27] == "0") {
                        aEvent["Changed_out"] = "";
                    } else {
                        if (aEvent["Out"] != ArrUpdLiveScore[i][27]) {
                            aEvent["Changed_out"] = CLS_UPD;
                            bScoreChg = true;
                        }
                    }

                }
                if (bScoreChg) {
                    _LiveScoreChangedMap[sMUID] = new Date().getTime();
                }
                idx++;
            }
        }
    }


    function _updateLiveScore(ArrUpdLiveScore) {
        switch (_self.SportType) {
            case "2":
                _updateLiveScoreChanged_NBA(ArrUpdLiveScore);
                break;
            case "3":
                _updateLiveScoreChanged_Football(ArrUpdLiveScore);
                break;
            case "4":
                _updateLiveScoreChanged_IceHockey(ArrUpdLiveScore);
                break;
            case "7":
                _updateLiveScoreChanged_Billiard(ArrUpdLiveScore);
                break;
            case "5":
            case "6":
            case "9":
                _updateLiveScoreChanged_Tennis(ArrUpdLiveScore);
                break;
            case "8":
                _updateLiveScoreChanged_Baseball(ArrUpdLiveScore);
                break;
            default:
        }

        var arrFieldDef = LIVE_SCORE_DEF[_self.SportType];
        if (arrFieldDef instanceof Array) {
            for (var i = 0; i < ArrUpdLiveScore.length; i++) {
                var sMUID = ArrUpdLiveScore[i][0];
                var idx = _MatchMap[sMUID];
                if (idx == null) {
                    continue;
                }

                while ((idx < _self.EventList.length) && (_self.EventList[idx]["MUID"] == sMUID)) {
                    var aEvent = _self.EventList[idx];
                    for (var j = 1; j < arrFieldDef.length; j++) {
                        aEvent[arrFieldDef[j]] = ArrUpdLiveScore[i][j];
                    }
                    idx++;
                }
                _DirtyMatch[sMUID] = "LiveScore";
            }
        }
    }

    /**
	 * delete events method
	 * Params:
	 *	ArrMUIDs: array of odds value update data.
	 * Return: void.
	 */
    function _deleteEvents(ArrMUIDs) {
        if (!_self.slowDelete) {
            for (var i = 0; i < ArrMUIDs.length; i++) {
                var sMUID = ArrMUIDs[i];
                var iHead = _MatchMap[sMUID];
                var iTail = iHead + 1;
                while (iTail < _self.EventList.length) {
                    if (_self.EventList[iTail]["MUID"] != sMUID) {
                        iTail--;
                        break;
                    }
                    iTail++;
                }
                if (!isNaN(iTail) && !(typeof (iHead) == "undefined")) {
                    _self.EventList = arrayRemove(_self.EventList, iHead, iTail);
                    _self.HtmlList = arrayRemove(_self.HtmlList, iHead, iTail);

                    for (var j = _self.EventList.length - 1; j >= iHead; j--) {
                        _MatchMap[_self.EventList[j]["MUID"]] = j;
                    }

                    _ScoreChangedMap[sMUID] = null;
                    _LiveScoreChangedMap[sMUID] = null;
                }
            }
        }
        else {
            for (var i = 0; i < ArrMUIDs.length; i++) {
                var sMUID = ArrMUIDs[i];
                for (var j = _self.EventList.length - 1; j >= 0; j--) {
                    if (_self.EventList[j]["MUID"] == sMUID) {
                        _self.EventList = arrayRemove(_self.EventList, j, j);
                        _self.HtmlList = arrayRemove(_self.HtmlList, j, j);
                    }
                }

                for (var j = _self.EventList.length - 1; j >= 0; j--) {
                    _MatchMap[_self.EventList[j]["MUID"]] = j;
                }
                _ScoreChangedMap[sMUID] = null;
                _LiveScoreChangedMap[sMUID] = null;
            }
        }
    }

    /**
	 * insert events method
	 * Params:
	 *	InsDatas: array of odds value update data.
	 * Return: void.
	 */
    function _insertEvents(InsDatas) {
        var oHash, nHash;
        for (var i = 0; i < InsDatas.length; i++) {
            nHash = _hashData(InsDatas[i], _self.DataTags);
            if (nHash["LeagueId"] == "") {
                nHash["LeagueId"] = oHash["LeagueId"];
                nHash["LeagueName"] = oHash["LeagueName"];
            }
            if (nHash["MUID"] == "") {
                nHash["MUID"] = oHash["MUID"];
                nHash["MatchId"] = oHash["MatchId"];
                nHash["MatchCode"] = oHash["MatchCode"];
                nHash["HomeName"] = oHash["HomeName"];
                nHash["AwayName"] = oHash["AwayName"];
                nHash["KickoffTime"] = oHash["KickoffTime"];
                nHash["ShowTime"] = oHash["ShowTime"];
                nHash["StatsId"] = oHash["StatsId"];
                nHash["SportRadar"] = oHash["SportRadar"];
                nHash["StreamingId"] = oHash["StreamingId"];
                nHash["Favorite"] = oHash["Favorite"];
                nHash["ScoreH"] = oHash["ScoreH"];
                nHash["ScoreA"] = oHash["ScoreA"];
                nHash["TimerSuspend"] = oHash["TimerSuspend"];
                //live score data parse
                if (typeof (LIVE_SCORE_DEF[_self.SportType]) != "undefined") {
                    var arrFieldDef = LIVE_SCORE_DEF[_self.SportType];
                    for (var j = 0; j < arrFieldDef.length; j++) {
                        if (typeof (oHash[arrFieldDef[j]]) != "undefined") {
                            nHash[arrFieldDef[j]] = oHash[arrFieldDef[j]];
                        }
                    }
                }
            }
            var idx;

            if (_self.CustomIdx != null) {
                idx = _self.CustomIdx(_self.EventList, nHash);
            } else {
                if (_self.SortType == 1) {
                    idx = _self.findIndex("KickoffTime", nHash["KickoffTime"]);
                    idx = _self.adjustIndex1(idx, "KickoffTime", nHash["KickoffTime"], nHash["MatchCode"]);
                } else {
                    idx = _self.findIndex("MatchCode", nHash["MatchCode"]);
                    idx = _self.adjustIndex0(idx, "MatchCode", nHash["MatchCode"], nHash["MUID"]);
                }
            }

            oHash = nHash;

            _self.EventList = arrayInsert(_self.EventList, idx, new Array(nHash));
            _self.HtmlList = arrayInsert(_self.HtmlList, idx, new Array(""));
            _DirtyMatch[nHash["MUID"]] = "ins";
        }
    }

    /**
	 * resort events method
	 * Params:
	 *	ArrMatchCodes: array of odds value update data.
	 * Return: void.
	 */
    function _resortEvents(ArrIdxValues) {
        for (var sMUID in ArrIdxValues) {
            _DirtyMatch[sMUID] = "srt";

            var sNewValue = ArrIdxValues[sMUID];
            var iHead = _MatchMap[sMUID];
            var iTail = iHead + 1;
            while (iTail < _self.EventList.length) {
                if (_self.EventList[iTail]["MUID"] != sMUID) {
                    iTail--;
                    break;
                }
                iTail++;
            }

            var sMatchCode = _self.EventList[iHead]["MatchCode"];
            var arrNewEvent = _self.EventList.slice(iHead, iTail + 1);
            var arrNewHtml = _self.HtmlList.slice(iHead, iTail + 1);
            var sSortColumn = (_self.SortType == 1) ? "KickoffTime" : "MatchCode";
            for (var i = 0; i < arrNewEvent.length; i++) {
                arrNewEvent[i][sSortColumn] = sNewValue;
            }
            _self.EventList = arrayRemove(_self.EventList, iHead, iTail);
            _self.HtmlList = arrayRemove(_self.HtmlList, iHead, iTail);

            var idx;
            if (_self.SortType == 1) {
                idx = _self.findIndex("KickoffTime", sNewValue);
                idx = _self.adjustIndex1(idx, "KickoffTime", sNewValue, sMatchCode);
            } else {
                idx = _self.findIndex("MatchCode", sNewValue);
                idx = _self.adjustIndex0(idx, "MatchCode", sNewValue, sMUID);
            }
            _self.EventList = arrayInsert(_self.EventList, idx, arrNewEvent);
            _self.HtmlList = arrayInsert(_self.HtmlList, idx, arrNewHtml);

            var iBound = (iHead < idx) ? iHead : idx;
            for (var i = _self.EventList.length - 1; i >= iBound; i--) {
                _MatchMap[_self.EventList[i]["MUID"]] = i;
            }
        }
    }
    this.findDataIndex = function (FieldName, Value) {
        for (var i = 0; i < this.EventList.length; i++) {
            if (this.EventList[i][FieldName] == Value) {
                return i;
            }
        }
        return -1;
    }
    /**
	 * find the location for inserting by MatchCode.
	 * Params:
	 *	FieldName: string. "MatchCode" when normal sort or "KickoffTime" when sort by time
	 *  Value: value of filed that want to be find
	 * Return: int; index.
	 */
    this.findIndex = function (FieldName, Value) {
        var iL = 0;
        var iR = this.EventList.length - 1;
        var iM;

        if (this.EventList.length == 0) {
            return 0;
        } else if (Value >= this.EventList[iR][FieldName]) {
            return iR + 1;
        } else if (Value < this.EventList[iL][FieldName]) {
            return iL;
        }

        while (iL <= iR) {
            iM = Math.ceil((iL + iR) / 2);
            var aCode = this.EventList[iM][FieldName];
            if (aCode < Value) {
                iL = iM + 1;
            } else if (aCode > Value) {
                iR = iM - 1;
            } else {
                // loop to adjust location index
                for (iM = iM + 1; iM < this.EventList.length; iM++) {
                    if (this.EventList[iM][FieldName] != Value) {
                        return iM;
                    }
                }
            }
        }

        // loop to adjust location index
        if (iM + 1 >= this.EventList.length) {
            iM = this.EventList.length - 2;
        }
        for (iM = iM + 1; iM >= 0; iM--) {
            if (this.EventList[iM][FieldName] <= Value) {
                return iM + 1;
            }
        }
        return 0;
    }

    /**
	 * adjust index after call this.findIndex() by MatchCode
	 * to find the index for insert
	 * Params:
	 *	index: int.
	 * Return: int; index.
	 */
    this.adjustIndex0 = function (Index, MatchCode, MUID) {
        for (var i = Index - 1; (i >= 0) && (this.EventList[i]["MatchCode"] == MatchCode) ; i--) {
            if (this.EventList[i]["MUID"] >= MUID) {
                return i + 1;
            }
        }
        return Index;
    }

    /**
	 * adjust index after call this.findIndex() by KickoffTime
	 * to find the index for insert
	 * Params:
	 *	index: int.
	 * Return: int; index.
	 */
    this.adjustIndex1 = function (Index, KickoffTime, MatchCode) {
        for (var i = Index - 1; (i >= 0) && (this.EventList[i]["KickoffTime"] == KickoffTime) ; i--) {
            if (this.EventList[i]["MatchCode"] >= MatchCode) {
                return i + 1;
            }
        }
        return Index;
    }

    /**
	 * adjust index after call this.findIndex()
	 * to find the first index of MUID
	 * Params:
	 *	index: int.
	 * Return: int; index.
	 */
    this.adjustIndex1st = function (Index, FieldName, Value, MUID) {
        var i;
        for (i = Index - 1; (i >= 0) && (this.EventList[i][FieldName] == Value) ; i--) {
            if (this.EventList[i]["MUID"] == MUID) {
                break;
            }
        }

        var j;
        for (j = i; (j >= 0) && (this.EventList[j][FieldName] == Value) ; j--) {
            if (this.EventList[j]["MUID"] != MUID) {
                break;
            }
        }
        return j + 1;
    }

    /**
	 * re-generate odds table after refresh
	 * Return: void.
	 */
    this.regenTableHtml = function () {
        getLeagueList();
        _MatchMap = new Array();
        var arrHtml = new Array();

        arrHtml.push(_getTableTag());
        arrHtml.push(_getColgroup());
        arrHtml.push("<THead>" + _genHeader() + "</THead><TBody>");

        var sLeague, sPreLeague, sPreMUID, sPreSubTitle, sMatch;
        var iMatchIndex = "-1";
        for (var i = 0; i < this.EventList.length; i++) {
            if (this.SubTitleField != null) {
                var sSubTitle = this.EventList[i][this.SubTitleField];
                if (sPreSubTitle != sSubTitle) {
                    arrHtml.push(_genSubTitle(sSubTitle));
                    sPreSubTitle = sSubTitle;
                }
            }

            var oHash = this.EventList[i];

            var IsMainMarket = true;
            if (typeof (this.EventList[i]["IsMainMarket"]) != "undefined") {
                IsMainMarket = isFilterMainMarket(this.EventList[i]["IsMainMarket"]);
            }

            sLeague = oHash["LeagueId"];
            sMatch = oHash["MatchId"];
            var sKickoffTime = this.EventList[i]["KickoffTime"];
            if (sLeague != sPreLeague && isFilterLeague(sLeague) && IsMainMarket && isFilterKickoffTime(sKickoffTime) && isFilterMatch(sMatch)) {
                var LeagueTR = _genLeagueTR(i);
                if (LeagueTR != "") {
                    sPreLeague = sLeague;
                    arrHtml.push(LeagueTR);
                }
            }

            var sMUID = this.EventList[i]["MUID"];
            var sNexMUID;
            if (i < this.EventList.length - 1) {
                sNexMUID = this.EventList[i + 1]["MUID"];
            }
            //put data index into _MatchMap
            if ((sPreMUID != sMUID)) {
                _MatchMap[sMUID] = i;
                oHash["MatchIndex"] = ++iMatchIndex;
            } else {
                oHash["MatchIndex"] = iMatchIndex;
            }
            var iDiv = oHash["MatchIndex"] % this.DivBase;

            if ((_self.RegenEverytime) || (_DirtyMatch[oHash["MUID"]] != null) || (oHash["Div"] != iDiv)) {
                oHash["Div"] = iDiv;
                if (sNexMUID != sMUID || i == this.EventList.length - 1) {
                    this.HtmlList[i] = _genEventFooterTR(i);
                } else {
                    this.HtmlList[i] = (sPreMUID != sMUID) ? _genEventMasterTR(i) : _genEventTR(i);
                }
            }
            sPreMUID = sMUID;

            if (isFilterLeague(sLeague) && IsMainMarket && isFilterKickoffTime(sKickoffTime) && isFilterMatch(sMatch)) {
                arrHtml.push(this.HtmlList[i]);
            }
        }

        arrHtml.push("</TBody></Table>");
        this.TableContainer.innerHTML = arrHtml.join("");

        //arrTicks.push( new Date().getTime());

        _oTable = null;
        _oTable = this.TableContainer.childNodes[0];
        if (this.afterRepaintTable != null) {
            this.afterRepaintTable(_oTable, this.EventList);
        }
    }

}

/*===========================================================
							Function Utility
============================================================*/

/**
 * Params -
 *	aHash: Hashtable; contain name & values
 *	sTmpl: string; template string
 * Return: string;
 *	string finished tag replacing;
 */
/*function _replaceTags(aHash, sTmpl, aKeys) {
	for (var i = 0; i < aKeys.length; i++) {
		sTmpl = sTmpl.replace(new RegExp("{%" + aKeys[i] + "}", "g"), aHash.hash[aKeys[i]]);
	}
	return sTmpl;
}*/

/**
 * Params -
 *	aHash: Hashtable; contain name & values
 *	sTmpl: string; template string
 * Return: string;
 *	string finished tag replacing;
 */
function _replaceTags(aHash, arrTmpl) {
    var arrS = new Array(arrTmpl.length * 2 - 1);
    arrS[0] = arrTmpl[0];
    var idx;
    for (var i = 1; i < arrTmpl.length; i++) {
        idx = i * 2;
        arrS[idx - 1] = aHash[arrTmpl[i][0]];
        arrS[idx] = arrTmpl[i][1];
    }
    return (arrS.join("")).replace(/td>\s+<td/g, 'td><td');
}

function replaceTags(aHash, sTmpl) {
    return _replaceTags(aHash, _formatTemplate(sTmpl, "{%", "}"));
}

/**
 * set template string into parser( _replaceTag() ) format
 * Params -
 *	aHash: Hashtable; contain name & values
 *	sTmpl: string; template string
 *	sHead: string; head of tag quote
 *	sTail: string; tail of tag quote
 * Return: array of array of string (string[1..n][0..1]);
 */
function _formatTemplate(sTmpl, sHead, sTail) {
    var arrTmp = sTmpl.split(sHead);

    for (var i = 1; i < arrTmp.length; i++) {
        var iIdx = arrTmp[i].indexOf(sTail);
        arrTmp[i] = [arrTmp[i].substr(0, iIdx), arrTmp[i].substr(iIdx + 1, arrTmp[i].length - iIdx)];
    }
    return arrTmp;
}


/**
 * no use in current framework
 * Params -
 *	Template: string; template string;
 * Return: Array of String;
 *	Tags in the template
 */
/*
function _initialTags(Template) {
   var arrTags = Template.match(/{%.+?}/g);
   var oHash = new Hashtable();
   for (var i = 0; i < arrTags.length; i++) {
       var sTag = arrTags[i].substr(2, arrTags[i].length - 3);
       oHash.put(sTag, sTag);
   }
   return oHash.getValues();
}*/

/**
 * transfer raw data array to hash array with lable
 * Params -
 *	ArrDatas: Array; array of Data;
 *	ArrTags: Array; array of string to define data label
 * Return: Hash Array; combine datas with lable into Hashtable
 */
function _hashData(ArrDatas, ArrTags) {
    var oHash = new Array();
    var iLength = Math.min(ArrDatas.length, ArrTags.length);
    for (var j = 0; j < iLength; j++) {
        oHash[ArrTags[j]] = ArrDatas[j];
    }
    if (location.pathname == '/UnderOver.aspx')
    {
        var oneX2Keys = ["Odds_5_1", "Odds_5_2", "Odds_5_X", "Odds_15_1", "Odds_15_2", "Odds_15_X", "Odds_301_H", "Odds_301_A", "Odds_302_O", "Odds_302_U", "Odds_303_H", "Odds_303_A", "Odds_304_O", "Odds_304_U"];
        for (var i = 0; i < oneX2Keys.length; i++)
        {
            if (oHash[oneX2Keys[i]] && oHash[oneX2Keys[i]] != '')
            {
                oHash[oneX2Keys[i]] = parseFloat(oHash[oneX2Keys[i]]).toFixed(2);
            }
        }
    }
    return oHash;
}

/**
 * Array Object Utility Function
 *	remove elements from array by range
 * Params -
 *	arrSrc: Array; source array;
 *	Begin: int; index of begin being removed
 *	End: int; index of end being removed
 * Return: Array; a new Array Instance after be removed elements
 */
function arrayRemove(arrSrc, Begin, End) {
    if (End == null) {
        End = Begin;
    }
    if (Begin > End) {
        return arrSrc.concat([]);
    }
    if (Begin < 0) {
        Begin = 0;
    }
    if (End >= arrSrc.length) {
        End = arrSrc.length - 1;
    }

    var arrTmp1 = arrSrc.slice(0, Begin);
    var arrTmp2 = arrSrc.slice(End + 1);
    return arrTmp1.concat(arrTmp2);
}

/**
 * Array Object Utility Function
 *	insert elements(sub-array) to array
 * Params -
 *	arrSrc: Array; source array;
 *	index: int; index of begin insert
 *	arrStuff: Array; an array contant elements will be inserted to source array
 * Return: Array; a new Array Instance after be inserted elements
 */
function arrayInsert(arrSrc, index, arrStuff) {
    if (index <= 0) {
        return arrStuff.concat(arrSrc);
    } else if (index >= arrSrc.length) {
        return arrSrc.concat(arrStuff);
    } else {
        var arrTmp1 = arrSrc.slice(0, index);
        var arrTmp2 = arrSrc.slice(index);
        arrTmp1 = arrTmp1.concat(arrStuff);
        return arrTmp1.concat(arrTmp2);
    }
}

var sKeeperUpdateOddsTime = null;

function SimpleOddsKeeper() {
    this.TableContainer = null;
    this.DivTmpl = null;
    this.newHash = new Array();
    this.oHash = new Array();
    this.MUID = null;
    this.MatchId = null;
    this.isParlay = "false";
    this.Market = "";
    this.OddsHTML = "";
    this.setDatas = function (ArrDatas, ArrTags) {
        this.oHash = _hashData(ArrDatas, ArrTags, this.oHash);
    }

    function _hashData(ArrDatas, ArrTags, oHash) {
        var iLength = Math.min(ArrDatas.length, ArrTags.length);
        for (var j = 0; j < iLength; j++) {
            oHash[ArrTags[j]] = ArrDatas[j];
        }
        return oHash;
    }

    function _replaceAllTags(aHash, arrTmpl) {
        var arrS = new Array(arrTmpl.length * 2 - 1);
        arrS[0] = arrTmpl[0];
        var idx;
        for (var i = 1; i < arrTmpl.length; i++) {
            idx = i * 2;
            arrS[idx - 1] = aHash[arrTmpl[i][0]];
            arrS[idx] = arrTmpl[i][1];
        }
        return (arrS.join(""));
    }


    this.AppendOddsTable = function () {
        var DivTmplArr;
        var TmpStr = this.DivTmpl;
        if (this.oHash != null) {
            DivTmplArr = _formatTemplate(TmpStr, "{%", "}");
            TmpStr = _replaceAllTags(this.oHash, DivTmplArr);
        }
        if (this.newHash != null) {
            DivTmplArr = _formatTemplate(TmpStr, "{@", "}");
            TmpStr = _replaceAllTags(this.newHash, DivTmplArr);
        }
        this.OddsHTML = this.OddsHTML + TmpStr;
        //this.TableContainer.innerHTML = this.TableContainer.innerHTML + TmpStr;
    }
    this.paintOddsTable = function () {
        var DivTmplArr;
        this.TableContainer.innerHTML = this.DivTmpl;
        if (this.oHash != null) {
            DivTmplArr = _formatTemplate(this.TableContainer.innerHTML, "{%", "}");
            this.TableContainer.innerHTML = _replaceAllTags(this.oHash, DivTmplArr);
        }
        if (this.newHash != null) {
            DivTmplArr = _formatTemplate(this.TableContainer.innerHTML, "{@", "}");
            this.TableContainer.innerHTML = _replaceAllTags(this.newHash, DivTmplArr);
        }
        //this.TableContainer.innerHTML = this.DivTmpl;
    }

    this.updateOdds = function (oEvent, nEnent, betType) {
        var chg = false;
        for (var i = 0; i < betType.length; i++) {
            for (var j = 1; j < MultiSportODDS_DEF[parseInt(betType[i], 10)].length; j++) {
                if (oEvent[MultiSportODDS_DEF[parseInt(betType[i], 10)][j]] != nEnent[MultiSportODDS_DEF[parseInt(betType[i], 10)][j]]) {
                    nEnent["Changed_" + betType[i]] = CLS_UPD;
                    chg = true;
                    break;
                } else {
                    if ((new Date().getTime() - sKeeperUpdateOddsTime) > 30 * 1000) {
                        nEnent["Changed_" + betType[i]] = "";
                    } else {
                        nEnent["Changed_" + betType[i]] = CLS_UPD;
                    }
                }
            }
        }
        if (chg) {
            sKeeperUpdateOddsTime = new Date().getTime();
        }
        return nEnent;
    }


}
function getLeagueName(name) {
    var m = name.split("/");
    m[0] = "";
    return trim(m.join(""));
}
function getSelLeagueCnt(list) {
    var iCnt = 0;
    var jCnt = 0;
    var kCnt = 0;
    var arr = [];
    for (var i = 0; i < list.length; i++) {
        if (list[i]["Checked"]) {
            iCnt++;
        }
        if (typeof (list[i]["IsMainMarket"]) == "undefined") {
            jCnt++;
        } else
            if (list[i]["IsMainMarket"] == "True") {
                jCnt++;
                if (list[i]["Checked"]) {
                    kCnt++;
                }
            }
    }
    arr[0] = SelMainMarket == 1 ? kCnt : iCnt;
    arr[1] = jCnt;
    arr[2] = iCnt;
    return arr;
}
function getLeagueList() {
    if (fFrame.LastSelectedMenu == 2) {
        SelMainMarket = 0;
    }
    LeagueListBySport = [];
    TotlaLeagueCnt = 0;
    TotlaMainLeagueCnt = 0;
    TotlaSelLeagueCnt = 0;
    if (typeof (arr_ShowMixParlay) == "object") {
        var arr_OddsKeeper_L = new Array();
        var arr_OddsKeeper_D = new Array();
        if (g_OddsKeeper_L != null)
            arr_OddsKeeper_L = g_OddsKeeper_L.getOddsKeeperArray();
        if (g_OddsKeeper_D != null)
            arr_OddsKeeper_D = g_OddsKeeper_D.getOddsKeeperArray();

        for (var iSport in arr_ShowMixParlay) {
            LeagueList = [];
            if (arr_ShowMixParlay[iSport] && arr_OddsKeeper_L[iSport] != null) {
                var oddsKeeper = arr_OddsKeeper_L[iSport];
                makeLeagueList(oddsKeeper.EventList, iSport.toString(), false);
            }
            LeagueList = [];
            if (arr_ShowMixParlay[iSport] && arr_OddsKeeper_D[iSport] != null) {
                var oddsKeeper = arr_OddsKeeper_D[iSport];
                makeLeagueList(oddsKeeper.EventList, iSport.toString(), false);
            }
            if (typeof (LeagueListBySport["S" + iSport]) != "undefined") {
                TotlaLeagueCnt = TotlaLeagueCnt + LeagueListBySport["S" + iSport].length;
                var arr = getSelLeagueCnt(LeagueListBySport["S" + iSport]);
                TotlaMainLeagueCnt = TotlaLeagueCnt;
                TotlaSelLeagueCnt = TotlaSelLeagueCnt + arr[2];
            }
        }

    } else if (typeof (arr_OddsKeeper) == "object") {
        for (var iSport in arr_OddsKeeper) {
            LeagueList = [];
            var oddsKeeper = arr_OddsKeeper[iSport];
            if (oddsKeeper != null) {
                makeLeagueList(oddsKeeper.EventList, iSport.toString(), true);
            }
            if (typeof (LeagueListBySport["S" + iSport]) != "undefined") {
                TotlaLeagueCnt = TotlaLeagueCnt + LeagueListBySport["S" + iSport].length;
                var arr = getSelLeagueCnt(LeagueListBySport["S" + iSport]);
                if (iSport == "1") {
                    TotlaMainLeagueCnt = TotlaMainLeagueCnt + arr[1];
                    TotlaSelLeagueCnt = TotlaSelLeagueCnt + arr[0];
                } else {
                    TotlaMainLeagueCnt = TotlaMainLeagueCnt + LeagueListBySport["S" + iSport].length;
                    TotlaSelLeagueCnt = TotlaSelLeagueCnt + arr[2];
                }
            }
        }
    } else {
        var iSport = null;
        var iTotlaLeagueCnt_D = 0;
        var iTotlaLeagueCnt_L = 0;
        var iTotlaLeagueCnt = 0;
        LeagueList = [];
        if (typeof (g_OddsKeeper_D) == "object" && g_OddsKeeper_D != null) {
            iSport = g_OddsKeeper_D.SportType;
            makeLeagueList(g_OddsKeeper_D.EventList, iSport, false);
        }
        LeagueList = [];
        if (typeof (g_OddsKeeper_L) == "object" && g_OddsKeeper_L != null) {
            iSport = g_OddsKeeper_L.SportType;
            makeLeagueList(g_OddsKeeper_L.EventList, iSport, false);
        }
        LeagueList = [];
        if (typeof (g_OddsKeeper) == "object" && g_OddsKeeper != null) {
            iSport = g_OddsKeeper.SportType;
            makeLeagueList(g_OddsKeeper.EventList, iSport, false);
        }
        if (iSport != null) {
            TotlaLeagueCnt = LeagueListBySport["S" + iSport].length;
            var arr = getSelLeagueCnt(LeagueListBySport["S" + iSport]);
            if (iSport == "1") {
                TotlaMainLeagueCnt = arr[1];
            } else {
                TotlaMainLeagueCnt = LeagueListBySport["S" + iSport].length;
            }
            TotlaSelLeagueCnt = arr[0];
        }
    }
    checkLeagueCount();
}

function makeLeagueList(list, sport, convertName) {
    if (list == null) return;
    var j = 0;
    for (var i = 0; i < list.length; i++) {
        if (!ExistLeague(sport, list[i]["LeagueId"])) {
            LeagueList[j] = {};
            LeagueList[j]["LeagueId"] = list[i]["LeagueId"];
            LeagueList[j]["LeagueName"] = convertName ? getLeagueName(list[i]["LeagueName"]) : list[i]["LeagueName"];
            LeagueList[j]["SportId"] = sport;
            LeagueList[j]["SportName"] = fFrame.RES_SPORTS[parseInt(sport, 10)];
            if (typeof (list[i]["IsMainMarket"]) == "undefined") {
                LeagueList[j]["IsMainMarket"] = "False";
            } else {
                LeagueList[j]["IsMainMarket"] = list[i]["IsMainMarket"];
            }
            if (indexOf(arr_League, list[i]["LeagueId"]) != -1) {
                LeagueList[j]["Checked"] = true;
            } else {
                LeagueList[j]["Checked"] = false;
            }
            j++;
        }
    }
    if (typeof (LeagueListBySport["S" + sport]) == "object") {
        LeagueListBySport["S" + sport] = LeagueListBySport["S" + sport].concat(LeagueList);
    } else {
        LeagueListBySport["S" + sport] = {};
        LeagueListBySport["S" + sport] = jQuery.extend(true, [], LeagueList);
    }
    LeagueListBySport["S" + sport].sort(function (a, b) {
        return a.LeagueName.localeCompare(b.LeagueName);
    });
}
function ExistLeague(sport, id) {
    for (var i = 0; i < LeagueList.length; i++) {
        if (LeagueList[i]["LeagueId"] == id) {
            return true;
        }
    }
    if (typeof (LeagueListBySport["S" + sport]) == "object") {
        for (var i = 0; i < LeagueListBySport["S" + sport].length; i++) {
            if (LeagueListBySport["S" + sport][i]["LeagueId"] == id) {
                return true;
            }
        }

    }
    return false;
}

function isFilterLeague(LeagueId) {
    if (indexOf(arr_League, "0") != -1 || TotlaSelLeagueCnt == 0) {
        return true;
    }
    if (indexOf(arr_League, LeagueId) != -1) {
        return true;
    }
    return false;
}

function isFilterMatch(MatchId) {
    if (indexOf(arr_Match, "0") != -1) {
        return true;
    }
    if (indexOf(arr_Match, MatchId) != -1) {
        return true;
    }
    return false;
}
var SelMainMarket = 0;
function isFilterMainMarket(MainMarket) {
    if (SelMainMarket == 0) {
        return true;
    } else {
        if (MainMarket == "True") {
            return true;
        }
    }
    return false;
}
var SelKickoffTime = "";
function isFilterKickoffTime(KickoffTime) {
    if (SelKickoffTime == "") {
        return true;
    } else {
        if (SelKickoffTime == KickoffTime.substr(0, 8)) {
            return true;
        }
    }
    return false;
}
function cloneMainLeague(list) {
    var nlist = [];
    for (var i = 0; i < list.length; i++) {
        if (list[i]["IsMainMarket"] == "True") {
            nlist = nlist.concat(list[i]);
        }
    }
    return nlist;
}

var spreadCalculation = function (Hdp, Type, Odds, OtherOdds, OddsType) {
    if (Odds == 0) return '0.00';

    var NewOdds = Odds - fFrame.FSiteSpread;

    if (Odds > 0 && NewOdds < 0.01) {
        NewOdds = 0.01;
    }
    if (NewOdds < -1) {
        NewOdds += 2;
    }

    Odds = NewOdds;
    if (typeof (Hdp) == 'number') {
        if ((Hdp > 0 && Odds < 0) || (Hdp < 0 && Odds > 0)) {
            NewOdds = Floor(NewOdds);
        }
        if ((Hdp > 0 && Odds > 0) || (Hdp < 0 && Odds < 0)) {
            NewOdds = MidpointRoundingAwayFromZero(NewOdds);
        }
        if (Hdp == 0) {
            if (Odds > 0 && OtherOdds > 0) {
                if (Odds > OtherOdds) {
                    NewOdds = Floor(NewOdds);
                }
                else if (Odds < OtherOdds) {
                    NewOdds = MidpointRoundingAwayFromZero(NewOdds);
                }
                else {
                    if (Type == 'h') {
                        NewOdds = MidpointRoundingAwayFromZero(NewOdds);
                    }
                    else {
                        NewOdds = Floor(NewOdds);
                    }
                }
            } else {
                NewOdds = MidpointRoundingAwayFromZero(NewOdds);
            }
        }
    } else {
        if ((Type == 'h' && Odds < 0) || (Type == 'a' && Odds > 0)) {
            NewOdds = Floor(NewOdds);
        }
        if ((Type == 'h' && Odds > 0) || (Type == 'a' && Odds < 0)) {
            NewOdds = MidpointRoundingAwayFromZero(NewOdds);
        }
    }

    return oddsTypeFormula(NewOdds, '4', (OddsType) ? OddsType : fFrame.OddsType);
}

var Floor = function (Odds) {
    // prevent the situation as follow: 0.58*100=57.99999999999999 , 0.29*100=28.999999999999996
    return Odds >= 0 ? Math.floor(Odds * 100 + 0.0001) / 100 : -(Math.floor(Math.abs(Odds) * 100 + 0.0001) / 100);
}

var MidpointRoundingAwayFromZero = function (Odds) {
    // prevent the situation as follow: 0.58*100=57.99999999999999 , 0.29*100=28.999999999999996
    return Odds >= 0 ? Math.round(Odds * 100 + 0.0001) / 100 : -(Math.round(Math.abs(Odds) * 100 + 0.0001) / 100);
}

var oddsTypeFormula = function (rawOddsValue, oOddsType, nOddsType) {
    var updatedOddsValue = parseFloat(rawOddsValue);

    if (oOddsType == '1') { //Dec
        if (nOddsType == '2') { //Dec->HK
            updatedOddsValue -= 1;
        } else if (nOddsType == '4') { //Dec->MY
            updatedOddsValue = parseFloat(oddsTypeFormula(updatedOddsValue - 1, '2', '4'));
        }
    } else if (oOddsType == '2') { //HK
        if (nOddsType == '1') { //HK->Dec
            updatedOddsValue += 1;
        } else if (nOddsType == '4') { //HK->MY
            updatedOddsValue = updatedOddsValue > 1 ? -Math.floor((1 / updatedOddsValue) * 100) / 100 : updatedOddsValue;
        }
    } else if (oOddsType == '4') { //MY
        if (nOddsType == '1') { //MY->Dec
            updatedOddsValue = updatedOddsValue < 0 ? Math.floor((-1 / updatedOddsValue + 1) * 100) / 100 : updatedOddsValue + 1;
        } else if (nOddsType == '2') { //MY->HK
            updatedOddsValue = updatedOddsValue < 0 ? Math.floor((-1 / updatedOddsValue) * 100) / 100 : updatedOddsValue;
        } else if (nOddsType == '3') { //MY->Indo            
            return ConvertIndoOdds(updatedOddsValue);
        } else if (nOddsType == '5') { //MY->US (MY->US)
            return ConvertUsOdds(updatedOddsValue);
        }
    }

    return updatedOddsValue.toFixed(2);
}

function ConvertIndoOdds(updatedOddsValue) {
    if (updatedOddsValue > 0) {
        if (updatedOddsValue > 0.79) {
            updatedOddsValue = Math.floor(((1 / updatedOddsValue) * 100)) / 100;
        }
        else {
            updatedOddsValue = Math.ceil(((1 / updatedOddsValue) * 100)) / 100;
        }
        return (-updatedOddsValue).toFixed(2);
    }
    else {
        if (updatedOddsValue < -0.79) {
            updatedOddsValue = Math.round(Math.floor(Math.abs(1 / updatedOddsValue) * 100)) / 100;
            return updatedOddsValue.toFixed(2);;
        }
        else {
            updatedOddsValue = Math.round(((Math.ceil(Math.abs((1 / updatedOddsValue)) * 100) + 0.01) / 100) * 100) / 100;
            return updatedOddsValue.toFixed(2);;
        }
    }
}

function ConvertUsOdds(updatedOddsValue) {
    if (updatedOddsValue > 0) {
        if (updatedOddsValue > 0.79) {
            updatedOddsValue = Math.floor(((1 / updatedOddsValue) * 100));
        }
        else {
            updatedOddsValue = Math.ceil(((1 / updatedOddsValue) * 100));
        }
        return (-updatedOddsValue);
    }
    else {
        if (updatedOddsValue < -0.79) {
            updatedOddsValue = Math.round(Math.floor(Math.abs(1 / updatedOddsValue) * 100));
            return updatedOddsValue;
        }
        else {
            updatedOddsValue = Math.round(((Math.ceil(Math.abs((1 / updatedOddsValue)) * 100) + 0.01) / 100) * 100);
            return updatedOddsValue;
        }
    }
}



