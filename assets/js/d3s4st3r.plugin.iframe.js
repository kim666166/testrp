/**
 * Created by d3s4st3r - ezTools.
 *            _____           _
 *    ___ ___|_   _|__   ___ | |___
 *   / _ \_  / | |/ _ \ / _ \| / __|
 *  |  __// /  | | (_) | (_) | \__ \
 *   \___/___| |_|\___/ \___/|_|___/
 *
 * User: D3
 * Date: 14.08.2016
 * Time: 23:01
 */

;(function($){

    $.fn.iframe = function(options){

        var defaults = {
            id : 'iframe',
            url : '',
            width : '1016',
            height : '655',
            append : '.iframe_content',
            background : '.iframe_background',
            method : 'show'
        };

        var settings = $.extend({}, defaults, options);

        if(settings.method == 'show' || settings.method == 'create' || settings.method == 'init'){
            iframe_show(settings.url, '#'+settings.id, settings.append, settings.background);
        }else if(settings.method == 'refresh'){
            iframe_refresh('#'+settings.id);
        }else if(settings.method == 'close'){
            iframe_close('#'+settings.id, settings.append, settings.background);
        }else if(settings.method == 'destroy'){
            iframe_destroy('#'+settings.id);
        }

        function iframe_show(url, iframe, container, background){
            if(url != ''){
                $(settings.append).append('<iframe id="'+settings.id+'" src="'+url+'" width="'+settings.width+'" height="'+settings.height+'" frameborder="0"></iframe>');
                if($(container).is(':hidden')){
                    $(background).animateCss('fadeIn', 'show');
                    $(container).animateCss('bounceInUp', 'show');
                    $('body, html').css('overflow', 'hidden');
                }
            }else{
                console.log('iFrame has no Source!');
            }
        }

        function iframe_refresh(iframe){
            $(iframe).attr('src', $(iframe).attr('src'));
        }

        function iframe_close(iframe, container, background){
            if($(container).is(':visible')){
                $(background).animateCss('fadeOut', 'hide');
                $(container).animateCss('bounceOutDown', 'hide', function(){$(iframe).remove();});
                $('body, html').css('overflow', 'auto');
            }
        }

        function iframe_destroy(iframe){
            $(iframe).remove();
        }

    }

})(jQuery);