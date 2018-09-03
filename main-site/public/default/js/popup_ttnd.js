/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
window.mobilecheck = function() {
  var check = false;
  (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
  return check;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}
function countCookie() {
    var currentCookie = getCookie('_click');
    // new cookie
    var newCookieVal = parseInt(currentCookie) + 1;
    setCookie('_click', newCookieVal, 12);
}

if (getCookie('_href') === '') {
    setCookie('_href', window.location.href, 12);
}

if (getCookie('_click') === '') {
    setCookie('_click', '1', 12);
} else {
    if (getCookie('_href') !== window.location.href) {
        setCookie('_href', window.location.href, 12);
        countCookie();
    }
}

function create(htmlStr) {
    var frag = document.createDocumentFragment(),
        temp = document.createElement('div');
    temp.innerHTML = htmlStr;
    while (temp.firstChild) {
        frag.appendChild(temp.firstChild);
    }
    return frag;
}

function popupScript() {
    var popup = '<style>.ads-box{display: none;height:100%;width:100%;background-color:rgba(0,0,0,0.8);left:0;position:fixed;top:0;z-index:10000}.ads-item{position:absolute;top:50px;left:511.5px;width:550px}.ads-banner{position:absolute;z-index:10000}.ads-banner img{width:550px}a.ads-close{cursor:pointer;position:absolute;right:0;top:20px;z-index:11000}.ads-item-m{position:absolute;width:100%;height:100%}.ads-banner-m img{width:100%;height:100%;position:absolute;z-index:10000}a.ads-close-m{cursor:pointer;position:absolute;right:0;top:60px;z-index:11000}</style>'
                +'<div id="ads-box" class="ads-box">'
                +'<div id="ads-item" class="ads-item">'
                +'<div id="ads-banner" class="ads-banner">'
                +'<a id="ads-link" target="_blank" rel="nofollow">'
                +'<img id="ads-img" alt="" />'
                +'</a>'
                +'</div>'
                +'<a id="ads-close" class="ads-close" href="javascript:;" title="Ðóng">'
                +'<img id="ads-c">'
                +'</a>'
                +'</div>'
                +'</div>';
    var fragment = create(popup);
    document.body.insertBefore(fragment, document.body.childNodes[0]);
}

$(document).ready(function (e) {
    // check cookie
    var visited = getCookie('visited');
    var ads = getCookie('ads');
    var hostname = window.location.hostname;
    var refer = '?utm_medium=popup_noibo&utm_campaingn=tangve&utm_source=';
    var destination_link;
    var image_link_m;
    var image_link_pc;
    
 //  Khi người dùng chuyển sang trang 2 mới hiển thị popup
//    if (visited === '') {
//    if (visited === '' && parseInt(getCookie('_click')) > 1) {
    if (false) {
        if(hostname === 'bongda.wap.vn' || hostname === 'lichthidau.com.vn' || hostname === 'm.lichthidau.com.vn') {
            popupScript();
        }
        destination_link = 'http://tipbong.net';
        if(mobilecheck()) {ads
            $('#ads-item').attr('class', 'ads-item-m');
            $('#ads-banner').attr('class', 'ads-banner-m');
            $('#ads-img').attr('src', 'http://static.bongda.wap.vn:81/images/ads/Banner_350x400.jpg');
            $('#ads-close').attr('class', 'ads-close-m');
            $('#ads-c').attr('src', 'http://static.bongda.wap.vn/images/ads/ads-close.png');
            $('#ads-link').attr('href', destination_link);
        } else {
            $('#ads-item').attr('class', 'ads-item');
            $('#ads-banner').attr('class', 'ads-banner');
            $('#ads-img').attr('src', 'http://static.bongda.wap.vn:81/images/ads/Banner_400x450.jpg');
            $('#ads-close').attr('class', 'ads-close');
            $('#ads-c').attr('src', 'http://static.bongda.wap.vn/images/ads/ads-close.png');
            $('#ads-link').attr('href', destination_link);
//        }
//        if(mobilecheck()) {
//            if(ads === '1') {
//                image_link_m = "http://static.bongda.wap.vn:81/images/ads/xem-tuoi-vc-m.jpg";
//                setCookie('ads', '2', 1);
//                $('#ads-item').attr('class', 'ads-item-m');
//                $('#ads-banner').attr('class', 'ads-banner-m');
//                $('#ads-img').attr('src', image_link_m);
//                $('#ads-close').attr('class', 'ads-close-m');
//                $('#ads-c').attr('src', 'http://static.bongda.wap.vn/images/ads/ads-close.png');
//                $('#ads-link').attr('href', 'http://lichvansu.wap.vn/boi-tinh-yeu.html');
//            } else {
//                image_link_m = "http://static.bongda.wap.vn:81/images/ads/xem-tuoi-vc-m.jpg";
//                setCookie('ads', '1', 1);
//                $('#ads-item').attr('class', 'ads-item-m');
//                $('#ads-banner').attr('class', 'ads-banner-m');
//                $('#ads-img').attr('src', image_link_m);
//                $('#ads-close').attr('class', 'ads-close-m');
//                $('#ads-c').attr('src', 'http://static.bongda.wap.vn/images/ads/ads-close.png');
//                $('#ads-link').attr('href', 'http://lichvansu.wap.vn/boi-tinh-yeu.html');
//            }
//        } else {
//            if(ads === '1') {
//                setCookie('ads', '2', 1);
//                $('#ads-item').attr('class', 'ads-item');
//                $('#ads-banner').attr('class', 'ads-banner');
//                $('#ads-img').attr('src', image_link_pc);
//                $('#ads-close').attr('class', 'ads-close');
//                $('#ads-c').attr('src', 'http://static.bongda.wap.vn/images/ads/ads-close.png');
//                $('#ads-link').attr('href', destination_link);
//                
//            } else {
//                setCookie('ads', '2', 1);
//                $('#ads-item').attr('class', 'ads-item');
//                $('#ads-banner').attr('class', 'ads-banner');
//                $('#ads-img').attr('src', image_link_pc);
//                $('#ads-close').attr('class', 'ads-close');
//                $('#ads-c').attr('src', 'http://static.bongda.wap.vn/images/ads/ads-close.png');
//                $('#ads-link').attr('href', destination_link);
//                setCookie('ads', '1', 1);
//                $('#ads-item').attr('class', 'ads-item');
//                $('#ads-banner').attr('class', 'ads-banner');
//                $('#ads-img').attr('src', image_link_pc);
//                $('#ads-close').attr('class', 'ads-close');
//                $('#ads-c').attr('src', 'http://static.bongda.wap.vn/images/ads/ads-close.png');
//                $('#ads-link').attr('href', 'http://xuhuongtin.com/ttnd/');
//            }
            
        }
        
        $('#ads-box').css('display', 'block');
        $('#ads-box').click(function(){
            $('#ads-box').css('display', 'none');
        });
        setCookie('visited', '1', 12);
        destroycookie();
    }
   
 /*
    setTimeout(
        function(){
//            if (visited === '') {
                popupScript();
                if(mobilecheck()) {
                    $('#img-popup').attr('class', 'img-popup-m');
                    $('#close-popup').attr('class', 'close-popup-m');
                } else {
                    $('#img-popup').attr('class', 'img-popup-pc');
                    $('#close-popup').attr('class', 'close-popup-pc');
                }
                $('.link-app').attr('href', 'http://mixi.vn');
                $('.link-app').attr('target', '_blank');
                $('.popup-app').css('display', 'block');
                
                $('.popup-app').click(function(){
                    $('.popup-app').css('display', 'none');
                });
//                setCookie('visited', '1', 24);
//            }
        }, 5000
    );
    */
});

function delete_cookie(name) {
    document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}
function destroycookie() {
    delete_cookie('_click');
    delete_cookie('_href');
}
window.onbeforeunload = function () {
    //destroycookie();
    return;
}
function closePopup() {
    $('.popup-app').css('display', 'none');
}