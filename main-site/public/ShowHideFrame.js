/***********************************************
* Collapsible Frames script- c Dynamic Drive (www.dynamicdrive.com)
* This notice must stay intact for use
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

var columntype=""
var defaultsetting=""

function intval(v)
{
v = parseInt(v,10);
return isNaN(v) ? 0 : v;
}

function getPos(e) {
	var l = 0;
	var t  = 0;
	var w = intval(e.style.width);
	var h = intval(e.style.height);
	var wb = e.offsetWidth;
	var hb = e.offsetHeight;
	while (e.offsetParent){
		l += e.offsetLeft + (e.currentStyle?intval(e.currentStyle.borderLeftWidth):0);
		t += e.offsetTop  + (e.currentStyle?intval(e.currentStyle.borderTopWidth):0);
		e = e.offsetParent;
	}
	l += e.offsetLeft + (e.currentStyle?intval(e.currentStyle.borderLeftWidth):0);
	t += e.offsetTop  + (e.currentStyle?intval(e.currentStyle.borderTopWidth):0);
	return {x:l, y:t, w:w, h:h, wb:wb, hb:hb};
}

function getScroll()  {
var t, l, w, h;
if (document.documentElement && document.documentElement.scrollTop) {
t = document.documentElement.scrollTop;
l = document.documentElement.scrollLeft;
w = document.documentElement.scrollWidth;
h = document.documentElement.scrollHeight;
} else if (document.body) {
t = document.body.scrollTop;
l = document.body.scrollLeft;
w = document.body.scrollWidth;
h = document.body.scrollHeight;
}
return { t: t, l: l, w: w, h: h };
}

function scroller(el, duration) {
	if(typeof el != 'object') {
		el = document.getElementById(el);
	}
	if(!el) return;
	var z = this;
	z.el = el;
	z.p = getPos(el);
	z.s = getScroll();
	z.clear = function(){
		window.clearInterval(z.timer);
		z.timer = null;
	};
	z.t=(new Date).getTime();
	z.step = function() {
		var t = (new Date).getTime();
		var p = (t - z.t) / duration;
		if (t >= duration + z.t) {
			z.clear();
			window.setTimeout(function(){z.scroll(z.p.y, z.p.x)},13);
		} else {
			st = ((-Math.cos(p*Math.PI)/2) + 0.5) * (z.p.y-z.s.t) + z.s.t;
			sl = ((-Math.cos(p*Math.PI)/2) + 0.5) * (z.p.x-z.s.l) + z.s.l;
			z.scroll(st, sl);
		}
	};
	z.scroll = function (t, l){
		window.scrollTo(l, t)
	};
	z.timer = window.setInterval(function(){z.step();},13);
}

function getCurrentSetting(){
if (document.body)
return (document.body.rows)? document.body.rows : document.body.cols
}

function setframevalue(coltype, settingvalue){
if (coltype=="rows")
document.body.rows=settingvalue
else if (coltype=="cols")
document.body.cols=settingvalue
}

function resizeFrame(contractsetting){
var head = document.getElementById("topFrame").src;

    if (getCurrentSetting()!=defaultsetting)
    {
        setframevalue(columntype, defaultsetting)
        topFrame.location= head + '#top';
    }
    else
    {
        setframevalue(columntype, contractsetting)
        topFrame.location=head + '#collapse';
    }
}
function SwitchLefthideshow()
{
	parent.document.getElementById("frameset1").cols=parent.document.getElementById("frameset1").cols=="0,*" ? "198,*":"0,*";
}

function init(){
if (!document.all && !document.getElementById) return
if (document.body!=null){
columntype=(document.body.rows)? "rows" : "cols"
defaultsetting=(document.body.rows)? document.body.rows : document.body.cols
}
else
setTimeout("init()",100)
}

setTimeout("init()",100)
