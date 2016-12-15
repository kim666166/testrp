<?php
/**
 * Created by d3s4st3r - ezTools.
 *            _____           _
 *    ___ ___|_   _|__   ___ | |___
 *   / _ \_  / | |/ _ \ / _ \| / __|
 *  |  __// /  | | (_) | (_) | \__ \
 *   \___/___| |_|\___/ \___/|_|___/
 *
 * User: D3
 * Date: 06.09.2016
 * Time: 19:05
 */



if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {

    //exit script outputting json data
    $output = json_encode(
        array(
            'type' => 'error',
            'text' => 'Request must come from Ajax'
        ));

    die($output);
}else{

    $p = $_POST;
    $root = '../../';

    if($p['method'] == 'preview'){

        require_once($root.'inc/config.inc.php');

        $ip = $p['ip'];

        foreach($p as $key => $post){
            if($post === 'on'){
                $p[$key] = 'true';
            }
            if($post === 'off'){
                $p[$key] = 'false';
            }
        }
        foreach($settings as $key => $value){
            if(!isset($p[$key])){
                $p[$key] = 'false';
            }
        }
        $p['audio_volume'] = ($p['audio_volume']/100);

        $txt = '
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
 */



/*********************************************     PREVIEW-SETTINGS     *********************************************\

/**
 * You can delete this file at any time!
 */

$ip = \''.$ip.'\';

$settings = array();

$settings[\'steam_api_key\'] = \''.$p['steam_api_key'].'\';

$settings[\'server_ip\'] = \''.$p['server_ip'].'\';

$settings[\'server_port\'] = \''.$p['server_port'].'\';

$settings[\'logo\'] = \''.$p['logo'].'\';

$settings[\'logo_dark\'] = '.$p['logo_dark'].';

$settings[\'demo\'] = '.$p['demo'].';

$settings[\'copyright\'] = \''.$p['copyright'].'\';

$settings[\'audio_source\'] = \''.$p['audio_source'].'\';

$settings[\'background_source\'] = \''.$p['background_source'].'\';

$settings[\'audio_volume\'] = '.$p['audio_volume'].';

$settings[\'youtube_music_background_ids\'] = '.var_export($p['youtube_music_background_ids'], true).';

$settings[\'youtube_video_background_id\'] = \''.$p['youtube_video_background_id'].'\';

$settings[\'random_audio\'] = '.$p['random_audio'].';

$settings[\'visualize_audio\'] = '.$p['visualize_audio'].';

$settings[\'visualize_color\'] = \''.$p['visualize_color'].'\';

$settings[\'audios\'] = '.var_export($p['audios'], true).';

$settings[\'background_slider\'] = '.$p['background_slider'].';

$settings[\'background_images\'] = '.var_export($p['background_images'], true).';

$settings[\'background_image_stretch\'] = '.$p['background_image_stretch'].';

$settings[\'rules\'] = '.var_export($p['rules'], true).';

$settings[\'show_newsbox\'] = '.$p['show_newsbox'].';

$settings[\'news\'] = array(
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
        "text" => "We got a new Car-Dealer-System! It\'s much better then the old one! Even your old cars got transferred to it!"
    ),
    array(
        "date" => "01.09.2016",
        "text" => "We\'re experiencing some trouble with our servers, we\'ll fix that as quick as possible!"
    )
);

$settings[\'theme_color\'] = \''.$p['theme_color'].'\';

$settings[\'progress_color\'] = \''.$p['progress_color'].'\';

$settings[\'center_boxes\'] = '.$p['center_boxes'].';

$settings[\'language\'] = \''.$p['language'].'\';

$settings[\'theme\'] = \''.$p['theme'].'\';

$settings[\'news\'] = '.var_export($p['news'], true).';
    ';

        $previewFile = fopen($root.'assets/temp/previews/config_preview_'.$ip.'.inc.php', 'w') or die('Unable to create file! Please contact an admin!');
        fwrite($previewFile, $txt);
        fclose($previewFile);

        echo true;
    }

}

