<?php
/**
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
 * Date: 04.09.2016
 * Time: 15:29
 */



/*********************************************     SETTINGS     *********************************************\




/**
 * Don't do anything here!
 */
$info = array();


$info['steam_api_key'] = '<a href="http://steamcommunity.com/dev/apikey" target="_blank">[STEAM_API_KEY]<br>* Needs to be set, if u want to get the user informations to be shown!<br>* Get it here: http://steamcommunity.com/dev/apikey</a>';


$info['server_ip'] = '[SERVER_IP]<br>* Needs to be set, is used for e.g. user count.';


$info['server_port'] = '[SERVER_PORT]<br>* Needs to be set to work properly with the SERVER_IP.';


$info['logo'] = '[LOGO]<br>* If not set, there\'ll be no Logo on the top.<br>* Logo need to be located in \'img/logo\'!';


$info['logo_dark'] = '[LOGO_DARK]<br>* If set to "true", the background-box of the Logo will be white instead of black!<br>* Possible variables:<br>*      true        - White background<br>*      false       - Black background<br>*      \'disable\'   - No background';


$info['demo'] = '[DEMO]<br>* Plays a demo on the loading screen.<br>* Possible variables:<br>*      true        - Demo on<br>*      false       - Demo off';


$info['copyright'] = '[COPYRIGHT]<br>* Copyright<br>* Set to what you want or leave blank.';


$info['audio_source'] = '[AUDIO_SOURCE]<br>* Possible AUDIO_SOURCE variables:<br>*      \'youtube\'   - Plays a youtube video (hidden) for music!<br>*      \'locale\'    - Plays a .ogg file!';


$info['background_source'] = '[BACKGROUND_SOURCE]<br>* Possible BACKGROUND_SOURCE variables:<br>*      \'youtube\'   - Plays a youtube video as background!<br>*      \'locale\'    - Shows defined background images!<br>ATTENTION - YOUTUBE - EXTREME EXPERIMENTAL';


$info['audio_volume'] = '[AUDIO_VOLUME]<br>* Defines the audio volume!<br>* Possible volume settings:<br>*      100% = 1.0<br>*      1% = 0.01<br>*      1% = .01';


$info['youtube_music_background_ids'] = '<a href="http://puu.sh/qYxHX/ee88144bac.png" target="_blank">[YOUTUBE_MUSIC_BACKGROUND_IDS]<br>* Need to be set, if you\'ve set "AUDIO_SOURCE" to "youtube"!<br>* Uses the Youtube-ID, it\'s shown behind the "watch?v=" in the URL.<br>* Example: http://puu.sh/qYxHX/ee88144bac.png</a>';


$info['youtube_video_background_id'] = '<a href="http://puu.sh/qYxHX/ee88144bac.png" target="_blank">[YOUTUBE_VIDEO_BACKGROUND_ID]<br>* Need to be set, if you\'ve set "BACKGROUND_SOURCE" to "youtube"!<br>* Uses the Youtube-ID, it\'s shown behind the "watch?v=" in the URL.<br>* Example: http://puu.sh/qYxHX/ee88144bac.png<br>* ATTENTION - EXTREME EXPERIMENTAL</a>';


$info['random_audio'] = '[RANDOM_AUDIO]<br>* Defines to play random Audio-Files!<br>* Is only used if "AUDIO_SOURCE" is set to "locale"!';


$info['visualize_audio'] = '[VISUALIZE_AUDIO]<br>* Defines if the the music should be visualized.';


$info['visualize_color'] = '[VISUALIZE_COLOR]<br>* Defines the color of the visualized audio.';


$info['audios'] = '[AUDIOS]<br>* Need to be set, if you\'ve set "AUDIO_SOURCE" to "locale"!<br>* Music-Files needs to be located in \'audios\'!<br>* Only first audio will be played, if "RANDOM_AUDIO" is set to "false"!';


$info['background_slider'] = '[BACKGROUND_SLIDER]<br>* Defines sliding Background-Images!<br>* Possible variables:<br>*      true        - Slider on<br>*      false       - Slider off';


$info['background_images'] = '[BACKGROUND_IMAGES]<br>* Need to be set, if you\'ve set "BACKGROUND_SOURCE" to "locale"!<br>* Images needs to be located in \'img/background\'!<br>* Only first image will be shown, if "BACKGROUND_SLIDER" is set to "false"!';


$info['background_image_stretch'] = '[BACKGROUND_IMAGE_STRETCH]<br>* If you want to stretch the image, set this to true!';


$info['rules'] = '[RULES]<br>* Rules, which are shown on the left on the screen!';


$info['show_newsbox'] = '[SHOW_NEWSBOX]<br>* Defines to show the Newsbox.<br>* Possible variables:<br>*      true        - Newsbox on<br>*      false       - Newsbox off';


$info['news'] = '[NEWS]<br>* Defines the News-Texts.';


$info['theme_color'] = '[THEME_COLOR]<br>* Defines the color of the theme.';


$info['progress_color'] = '[PROGRESS_COLOR]<br>* Defines the color of the progressbar.';


$info['center_boxes'] = '[CENTER_BOXES]<br>* Sets all boxes to the center of the screen.';


$info['language'] = '[LANGUAGE]<br>* Defines the language.<br>* Attention! You need to create a translation file for this!';


$info['theme'] = '[THEME]<br>* Defines the theme you want to use!<br>* ATTENTION! THERE AREN\'T ANY NEW THEMES AT THE MOMENT!';