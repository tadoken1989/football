$(function(){
    var url = window.location.pathname,
        urlRegExp = new RegExp(url.replace(/\/$/,'') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
    // now grab every link from the navigation
    $('.webmenu li a').each(function(){
        var current = window.location.href;
        if(current != $('input[name="url"]').val() ) {
            // and test its normalized href against the url pathname regexp
            if(urlRegExp.test(this.href.replace(/\/$/,''))){
                $(this).parent().addClass('active');
            }
        }

    });

});
var App = {

};
$(document).ready(function () {
    $('#ajax-loadform .LS_1_web').click('a',function(){return false;});
    $('#ajax-loadform').find('script').closest('td').remove();
    $('#ajax-loadform').find('ins').remove();
    $('#ajax-loadform').find('script').remove();

});

