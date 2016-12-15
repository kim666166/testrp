/**
 * Created by d3s4st3r - ezTools.
 *            _____           _
 *    ___ ___|_   _|__   ___ | |___
 *   / _ \_  / | |/ _ \ / _ \| / __|
 *  |  __// /  | | (_) | (_) | \__ \
 *   \___/___| |_|\___/ \___/|_|___/
 *
 * User: D3
 * Date: 10.08.2016
 * Time: 21:02
 */

$.fn.extend({
    animateCss: function (animationName, toggle, callback) {
        if(!callback){
            callback = function(){};
        }
        if(!toggle){
            toggle = 'show';
        }
        if(toggle == 'show'){
            $(this).show();
        }
        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        $(this).addClass('animated ' + animationName).one(animationEnd, function() {
            $(this).removeClass('animated ' + animationName);
            if(toggle == 'hide'){
                $(this).hide();
            }
            callback.call(this);
        });
    }
});