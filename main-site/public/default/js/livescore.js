/**
 * 
 */
var flash_sound = Array(1);
flash_sound[0] = "http://static.bongda.wap.vn/media/goal.swf";
var soundid = 0;
var soundCheck = getCookie("Sound");

$( document ).ready(function() {
    if(soundCheck == 0) {
        document.getElementById("icon_sound").src = "http://static.bongda.wap.vn/images/ico_soundoff.gif";
    }
});

function CheckSound(n) {
    soundid = n;
    document.getElementById("sound").innerHTML = "<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0' width='1' height='1' id='image1'><param name='movie' value='" + flash_sound[soundid] + "'><param name='quality' value='high'><param name='wmode' value='transparent'><embed src='" + flash_sound[soundid] + "' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' width='1' height='1'></embed></object>";
}
function SoundOnSelect(obj) {
    if(soundCheck == 0) {
        obj.src = "http://static.bongda.wap.vn/images/ico_soundon.gif";
        soundCheck = 1;
        writeCookie("Sound", 1);
    } else {
        obj.src = "http://static.bongda.wap.vn/images/ico_soundoff.gif";
        soundCheck = 0;
        writeCookie("Sound", 0);
    }
}
function ShowFlash(id, mstatus) {
    try {
        if (soundCheck == 1 && mstatus >= 1) {
            if (document.getElementById("trs_" + id).style.display != "none") {
                document.getElementById("sound").innerHTML = "<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0' width='1' height='1' id='image1'><param name='movie' value='" + flash_sound[soundid] + "'><param name='quality' value='high'><param name='wmode' value='transparent'><embed src='" + flash_sound[soundid] + "' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' width='1' height='1'></embed></object>";
            }
        }
    } catch (e) {
    };
}


function refresh_content1() {
    $.ajax({
        dataType: "json",
        Type: 'POST',
        url: 'http://210.211.127.161/',
        data: {
            name: 'livescore_push'
        },
        success: function (data) {
            if (data == 'null' || data == '') {
                return
            }
            ;
            jQuery.each(data.LIST, function (i, match) {
                if ($("#trs_" + match['MID']).length <= 0 && match['STATUS'] != 5) {
                    // reload lai table
                    startRefreshing();
                    return;
                }
                // team1
                $('#fred_' + match['MID']).html(match['F_RED'] != 0 ? match['F_RED'] : '');
                $('#fyellow_' + match['MID']).html(match['F_YELLOW'] != 0 ? match['F_YELLOW'] : '');
                // team2
                $('#sred_' + match['MID']).html(match['S_RED'] != 0 ? match['S_RED'] : '');
                $('#syellow_' + match['MID']).html(match['S_YELLOW'] != 0 ? match['S_YELLOW'] : '');
                // ts
                var old_first_goal = jQuery('#ts1_' + match['MID']).html();
                var old_second_goal = jQuery('#ts2_' + match['MID']).html();
                if (old_first_goal != null && old_first_goal < match['F_GOALS']) {
                    $('#fteam_' + match['MID']).addClass('change-score');
                } else {
                    $('#fteam_' + match['MID']).removeClass('change-score');
                }
                if (old_second_goal != null && old_second_goal < match['S_GOALS']) {
                    $('#steam_' + match['MID']).addClass('change-score');
                } else {
                    $('#steam_' + match['MID']).removeClass('change-score');
                }
                if (match['KQ_HIEP1'] === 'undefined') {
                    match['KQ_HIEP1'] = '';
                }
                $('#ts_' + match['MID']).html('<span id="ts1_' + match['MID'] + '">' + match['F_GOALS'] + '</span> - <span id="ts2_' + match['MID'] + '">' + match['S_GOALS'] + '</span>');
                $('#tsh1_' + match['MID']).html('<strong>' + match['KQ_HIEP1'] + '</strong>');
                if (match['STATUS'] == 1 || match['STATUS'] == 3) {
                    $('#cols1_' + match['MID']).html('<img src="http://static.bongda.wap.vn/images/flash.gif"> ' + match['LIVE_TIME'] + '\'');
                } else if (match['STATUS'] == 2) {
                    $('#cols1_' + match['MID']).html('HT');
                } else if (match['STATUS'] == 4 || match['STATUS'] == 6) {
                    $('#cols1_' + match['MID']).html('ET');
                } else if (match['STATUS'] == 5) {
                    $('#cols1_' + match['MID']).html('FT');
                    //$('#trs_'+ match['MID']).remove();
                } else if (match['STATUS'] == 7) {
                    $('#cols1_' + match['MID']).html('PEN');
                }
            });
        }
    });
}
function refresh_content(is_mobile) {
    $.ajax({
        Type: 'GET',
        url: $('input[name="url"]').val()+'ajax.html',
        data: {},
        success: function (json) {
            var data = $.parseJSON(json);
            if (data == 'null' || data == '') {return};
            jQuery.each(data.content, function (i, match) {
                if (is_mobile) {
                    if ($("#livescore #trs_" + match['mid']).length <= 0 && match['status'] != 5) {
                        // reload lai table
                        startRefreshing();
                        return;
                    }
                }
                // team1
                $('#livescore #fred_' + match['mid']).html(match['fred'] != 0 ? match['fred'] : '');
                $('#fyellow_' + match['mid']).html(match['fyellow'] != 0 ? match['fyellow'] : '');
                // team2
                $('#livescore #sred_' + match['mid']).html(match['sred'] != 0 ? match['sred'] : '');
                $('#livescore #syellow_' + match['mid']).html(match['syellow'] != 0 ? match['syellow'] : '');
                // ts
                var old_first_goal = jQuery('#livescore #ts1_' + match['mid']).html();
                var old_second_goal = jQuery('#livescore #ts2_' + match['mid']).html();
                var changescore = false;
                if (old_first_goal != null && old_first_goal < match['fgoal']) {
                    $('#livescore #fteam_' + match['mid']).addClass('change-score');
                    changescore = true;
                } else {
                    $('#livescore #fteam_' + match['mid']).removeClass('change-score');
                }
                if (old_second_goal != null && old_second_goal < match['sgoal']) {
                    $('#livescore #steam_' + match['mid']).addClass('change-score');
                    changescore = true;
                } else {
                    $('#livescore #steam_' + match['mid']).removeClass('change-score');
                }
                if(changescore) {
                    ShowFlash(match['mid'], match['status']);
                }
                
                var tsh1 = '-';
                if (match['tsh1'] == null || match['tsh1'] === 'undefined') {
                    tsh1 = '-';
                } else {
                    tsh1 = match['tsh1'];
                }
                $('#livescore #ts_' + match['mid']).html('<span id="ts1_' + match['mid'] + '">' + match['fgoal'] + '</span> - <span id="ts2_' + match['mid'] + '">' + match['sgoal'] + '</span>');
                $('#livescore #tsh1_' + match['mid']).html('<strong>' + tsh1 + '</strong>');
                if (match['status'] == 1 || match['status'] == 3) {
                    $('#livescore #cols1_' + match['mid']).html('<img src="http://static.bongda.wap.vn/images/flash.gif"> ' + match['ltime'] + '\'');
                } else if (match['status'] == 2) {
                    $('#livescore #cols1_' + match['mid']).html('HT');
                } else if (match['status'] == 4 || match['status'] == 6) {
                    $('#livescore #cols1_' + match['mid']).html('ET');
                } else if (match['status'] == 5) {
                    $('#livescore #cols1_' + match['mid']).html('FT');
                    //$('#trs_'+ match['mid']).remove();
                } else if (match['status'] == 7) {
                    $('#livescore #cols1_' + match['mid']).html('PEN');
                }
            });
        },
        error : function () {
                console.log('error');
        }
    });
}