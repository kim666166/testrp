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
 * Date: 07.09.2016
 * Time: 21:05
 */

function create_visualaudio(src, audiobox_id, canvas_id, color, volume, visualize){
// Create a new instance of an audio object and adjust some of its properties
    var audio = new Audio();
    audio.src = src;
    audio.controls = true;
    audio.loop = true;
    audio.autoplay = true;
    audio.volume = volume;
// Establish all variables that your Analyser will use
    var canvas, ctx, source, context, analyser, fbc_array, bars, bar_x, bar_width, bar_height;
// Initialize the MP3 player after the page loads all of its HTML into the window
    window.addEventListener("load", initMp3Player, false);
    function initMp3Player(){
        document.getElementById(audiobox_id).appendChild(audio);
        context = new webkitAudioContext(); // AudioContext object instance
        analyser = context.createAnalyser(); // AnalyserNode method
        canvas = document.getElementById(canvas_id);
        ctx = canvas.getContext('2d');
        // Re-route audio playback into the processing graph of the AudioContext
        source = context.createMediaElementSource(audio);
        source.connect(analyser);
        analyser.connect(context.destination);
        frameLooper();
    }
// frameLooper() animates any style of graphics you wish to the audio frequency
// Looping at the default frame rate that the browser provides(approx. 60 FPS)
    function frameLooper(){
        if(visualize){
            window.webkitRequestAnimationFrame(frameLooper);
            fbc_array = new Uint8Array(analyser.frequencyBinCount);
            analyser.getByteFrequencyData(fbc_array);
            ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear the canvas
            ctx.fillStyle = color; // Color of the bars
            bars = 100;
            for (var i = 0; i < bars; i++) {
                bar_x = i * 3;
                bar_width = 2;
                bar_height = -(fbc_array[i] / 2);
                //  fillRect( x, y, width, height ) // Explanation of the parameters below
                ctx.fillRect(bar_x, canvas.height, bar_width, bar_height);
            }
        }
    }
}