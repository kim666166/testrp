/*
 * @copyright Copyright (c) 2016-2016. Dennis (∂єѕαѕтєя) (https://steamcommunity.com/id/d3s4st3r/)
 */

/**
 * Created by d3s4st3r - ezTools.
 *            _____           _
 *    ___ ___|_   _|__   ___ | |___
 *   / _ \_  / | |/ _ \ / _ \| / __|
 *  |  __// /  | | (_) | (_) | \__ \
 *   \___/___| |_|\___/ \___/|_|___/
 *
 * User: D3
 * Date: 03.09.2016
 * Time: 15:38
 */


/**
 * Defines the time between the slides in milliseconds.
 * @type {number}
 */
var slidetime = 10000;














$(document).ready(function(){
    $('.carousel.carousel-slider').carousel({
        full_width: true,
        full_height: true
    });

    $('.close_tab').click(function(){
        close_tab();
    });

    setTimeout(autoplay, slidetime);

    function autoplay() {
        $('.carousel').carousel('next');
        setTimeout(autoplay, slidetime);
    }

    function close_tab(){
        close();
    }
});