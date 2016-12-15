
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
 * Date: 03.09.2016
 * Time: 16:45
 */



/*********************************************     SETTINGS     *********************************************\




/**
 * Don't do anything here!
 */
$settings = array();

/**
 * Needs to be set, if u want to get the user informations to be shown!
 * Get it here: http://steamcommunity.com/dev/apikey
 */
$settings['steam_api_key'] = 'CHANGE_ME';

/**
 * Needs to be set, is used for e.g. user count.
 */
$settings['server_ip'] = 'CHANGE_ME';

/**
 * Needs to be set to work properly with the SERVER_IP.
 */
$settings['server_port'] = 'CHANGE_ME';

/**
 * If not set, there'll be no Logo in the top.
 * Logo need to be located in 'img/logo'!
 */
$settings['logo'] = '';

/**
 * If set to "true", the background-box of the Logo will be white instead of black!
 * Possible variables:
 *      true        - White background
 *      false       - Black background
 *      'disable'   - No background
 */
$settings['logo_dark'] = false;

/**
 * Plays a demo on the loading screen.
 * Possible variables:
 *      true        - Demo on
 *      false       - Demo off
 */
$settings['demo'] = true;

/**
 * Copyright
 * Set to what you want or leave blank.
 */
$settings['copyright'] = 'Dennis (∂єѕαѕтєя)';

/**
 * Possible AUDIO_SOURCE variables:
 *      'youtube'   - Plays a youtube video (hidden) for music!
 *      'locale'    - Plays a .ogg file!
 *
 * Possible BACKGROUND_SOURCE variables:
 *      'youtube'   - Plays a youtube video as background!
 *      'locale'    - Shows defined background images!
 */
$settings['audio_source'] = 'locale';
$settings['background_source'] = 'youtube';  //ATTENTION - YOUTUBE - EXTREME EXPERIMENTAL

/**
 * Defines the audio volume!
 * Possible volume settings:
 *      100% = 1.0
 *      1% = 0.01
 *      1% = .01
 */
$settings['audio_volume'] = 0.1;

/**
 * Need to be set, if you've set "AUDIO_SOURCE" to "youtube"!
 * Uses the Youtube-ID, it's shown behind the "watch?v=" in the URL.
 * Example: http://puu.sh/qYxHX/ee88144bac.png
 */
$settings['youtube_music_background_ids'] = array (
    'T-uFPiYgwRM',
    '2DPIWH6nO2I'
);

/**
 * Need to be set, if you've set "BACKGROUND_SOURCE" to "youtube"!
 * Uses the Youtube-ID, it's shown behind the "watch?v=" in the URL.
 * Example: http://puu.sh/qYxHX/ee88144bac.png
 * ATTENTION - EXTREME EXPERIMENTAL
 */
$settings['youtube_video_background_id'] = 'XIXYk6xIhZs';

/**
 * Defines to play random Audio-Files!
 * Is only used if "AUDIO_SOURCE" is set to "locale"!
 * Possible variables:
 *      true         - Random Audio on
 *      false        - Random Audio off
 */
$settings['random_audio'] = true;

/**
 * Defines if the music should be visualized.
 * This doesn't work for Youtube-Music!
 * Possible Variables:
 *      true        - Visualization on
 *      false       - Visualization off
 */
$settings['visualize_audio'] = true;

/**
 * Defines the color of the audio bars from the audio visualisation.
 * Possible Colors:
 *      black
 *      white
 *      red
 *      blue
 *      lightblue
 *      green
 *      yellow
 *      violet
 *      gold
 */
$settings['visualize_color'] = 'red';

/**
 * Need to be set, if you've set "AUDIO_SOURCE" to "locale"!
 * Music-Files needs to be located in 'audios'!
 * Only first audio will be played, if "RANDOM_AUDIO" is set to "false"!
 */
$settings['audios'] = array (
    'nujabes-feather.ogg',
    'fall-out-boy-centuries.ogg',
);

/**
 * Defines sliding Background-Images!
 * Possible variables:
 *      true        - Slider on
 *      false       - Slider off
 */
$settings['background_slider'] = true;

/**
 * Need to be set, if you've set "BACKGROUND_SOURCE" to "locale"!
 * Images needs to be located in 'img/background'!
 * Only first image will be shown, if "BACKGROUND_SLIDER" is set to "false"!
 */
$settings['background_images'] = array (
    'background_1.jpg',
    'background_2.jpg',
    'background_3.jpg'
);

/**
 * If you want to stretch the image, set this to true!
 */
$settings['background_image_stretch'] = true;

/**
 * Rules, which are shown on the left on the screen!
 */
$settings['rules'] = array (
    'Don\'t piss off other player!',
    'Don\'t spam/micspam!',
    'Do what admins say!',
    'Don\'t be racist!',
    'Don\'t prop spam!',
    'Don\'t be toxic!',
    'Don\'t minge!',
);

/**
 * Defines to show the Newsbox.
 * Possible variables:
 *      true        - Newsbox on
 *      false       - Newsbox off
 */
$settings['show_newsbox'] = true;

/**
 * Defines the News-Texts.
 */
$settings['news'] = array(
    array(
        "date" => "04.09.2016",
        "text" => "New awesome Loading-Screen! If you like it, tell us!"
    ),
    array(
        "date" => "03.09.2016",
        "text" => "New Pets in the Pointshop! Check it out now! Such awesome!"
    ),
    array(
        "date" => "02.09.2016",
        "text" => "We got a new Car-Dealer-System! It's much better then the old one! Even your old cars got transferred to it!"
    ),
    array(
        "date" => "01.09.2016",
        "text" => "We're experiencing some trouble with our servers, we'll fix that as quick as possible!"
    )
);

/**
 * Defines the Color-Theme.
 * Possible Themes:
 *      black
 *      white
 *      red
 *      blue
 *      lightblue
 *      green
 *      yellow
 *      violet
 *      gold
 */
$settings['theme_color'] = 'black';

/**
 * Defines the Progressbar-Color.
 * Possible Colors:
 *      black
 *      white
 *      red
 *      blue
 *      lightblue
 *      green
 *      yellow
 *      violet
 *      gold
 */
$settings['progress_color'] = 'red';

/**
 * Sets all boxes to the center of the screen.
 */
$settings['center_boxes'] = false;

/**
 * Defines the language.
 * Attention! You need to create a translation file for this!
 */
$settings['language'] = 'en';

/**
 * Defines the theme you want to use.
 */
$settings['theme'] = 'default';
