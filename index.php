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
 * Time: 15:36
 */

    if($_SERVER['SERVER_ADDR'] === '127.0.0.1'){ // Just for Debugging
        error_reporting(E_ALL);
    }else{
        error_reporting(0);
    }

    require_once('inc/basics.inc.php');

    if(!file_exists($admintxt)){ // Check if admin.txt is missing - If missing, go to the install.php
        //$txt = 'Loaded!';
        //$tempfile = fopen("assets/temp/dont_delete_me.mp4", "w") or die("Unable to create file! Please contact an admin!");
        //fwrite($tempfile, $txt);
        //fclose($tempfile);
        unset($_SESSION['user']);
        unset($_SESSION['password']);
        header("Location:install.php");
    }

    require_once('inc/functions.inc.php');

    require_once('inc/config.inc.php');
    if(file_exists('inc/my_config.inc.php')){ // Checks if own config is set. If it's set, it'll load it.
        require_once('inc/my_config.inc.php');
    }

    $plname = 'UNKNOWN';
    $avatar = 'img/placeholder/placehold.gif';
    $preview = false;
    $play_audio = '';
    $steamid_manual_set = false;

    if(isset($_GET['override_settings'])){
        if(file_exists('assets/temp/previews/config_preview_'.$ip.'.inc.php')){ // Preview-Mode
            require_once('assets/temp/previews/config_preview_'.$ip.'.inc.php');
            $preview = true;
        }
    }

    if(!isset($_GET['steamid']) && $settings['demo']){ // For Preview/Demo
        $_GET['steamid'] = '76561198013473990';
        $steamid_manual_set = true;
    }

    if (isset($_GET['mapname'])){ // Prefers the given mapname if it comes as a GET-Parameter
        $map = $_GET['mapname'];
    }
    if(isset($settings['steam_api_key']) && $settings['steam_api_key'] != '' && $settings['steam_api_key'] != 'CHANGE_ME'){ // Steam-API use for player-informations
        if (isset($_GET['steamid'])) {
            $data = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key='.$settings['steam_api_key'].'&steamids='.$_GET['steamid'];
            $f = file_get_contents($data);
            $arr = json_decode($f, true);
            if (isset($arr['response']['players'][0]['personaname']))
                $plname = $arr['response']['players'][0]['personaname'];
            if (isset($arr['response']['players'][0]['avatarfull']))
                $avatar = $arr['response']['players'][0]['avatarfull'];
        }
    }

    $mtop = 0;
    if($settings['logo']){ // Sets space if a logo is set
        $mtop = 10;
    }else{
        $mtop = 2;
    }

    $valign = '';
    $hb = '';
    if($settings['center_boxes'] === true){ // Sets variables to center the boxes vertically, if it's set
        $valign = 'valign';
        $hb = 'hard-bot';
    }

    $translation = array();
    require_once('translation/translation_en.inc.php'); // Fallback english translation
    $t = array();
    if(isset($settings['language']) && strtolower($settings['language']) != 'en'){
        if(file_exists('translation/translation_'.$settings['language'].'.inc.php')){
            include_once('translation/translation_'.$settings['language'].'.inc.php'); // Sets the requested translation, if it exists
        }
    }
    $t = $translation;

    $server_infos = '';
    if(isset($settings['server_ip']) && isset($settings['server_port']) && $settings['server_ip'] != 'CHANGE_ME' && is_numeric($settings['server_port'])){ // Use source_query if server-ip & server-port is set
        $server_infos = source_query($settings['server_ip'], $settings['server_port']);
        $use_source_query = true;
    }

    if(!empty($server_infos) && $use_source_query === true){ // If using source_query
        $current_player = $server_infos['players'].' / '.$server_infos['max'];
        $current_map = $server_infos['map'];
        $current_name = $server_infos['name'];
        $current_gamemode = $server_infos['description'];
    }else{ // Sets everything to unknown, if not using source_query (Will be filled via javascript instead)
        $use_source_query = false;
        $current_player = 'UNKNOWN';
        $current_map = 'UNKNOWN';
        $current_name = 'UNKNOWN';
        $current_gamemode = 'UNKNOWN';
        if($settings['demo'] && $preview === true){
            $current_player = '404';
            $current_gamemode = 'DemoRP';
        }
    }

    if(empty($map)){ // If the map isn't set via GET-Parameter, it's overwritten by source_query or UNKNOWN
        $map = $current_map;
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <!--Import Google Icon Font-->
        <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="libs/materialize/css/materialize.min.css"  media="screen,projection"/>
        <!--Import base.css-->
        <link type="text/css" rel="stylesheet" href="assets/css/base.css"/>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>

        <?php if($preview === true){ // Preview-Banner ?>
            <div class="preview_label red"><h5><?=$t['preview']?></h5></div>
        <?php }elseif(!isset($_GET['steamid']) || $steamid_manual_set === true){ ?>
            <div class="installation_button">
                <a href="install.php" class="waves-effect waves-light btn-large right"><i class="material-icons left">settings</i>Setup</a>
                <div class="chip black white-text left">If you see this ingame, your loadingscreen isn't configured correct!</div>
            </div>
        <?php } ?>

        <?php
            // Check if theme exists
            if($settings['theme'] && file_exists('themes/theme_'.$settings['theme'].'.php')){
                // Theme include
                include_once('themes/theme_'.$settings['theme'].'.php');
            }else{
                // Theme fallback to default
                include_once('themes/theme_default.php');
            }
        ?>

        <div id="background">
            <?php if($settings['background_source'] == 'youtube'){ // Youtube-Background Video ?>
                <div class="youtube_background_player">
                    <iframe id="youtube_background_player" type="text/html" width="100%" height="100%" src="//www.youtube.com/embed/<?=$settings['youtube_video_background_id']?>?autoplay=1&loop=1&rel=0&autohide=1&controls=0&showinfo=0&playlist=<?=$settings['youtube_video_background_id']?>" frameborder="0"></iframe>
                </div>
            <?php }else{
                    if($settings['background_image_stretch'] === true){
                        $stretch = 'stretch';
                    }else{
                        $stretch = '';
                    }
                    if($settings['background_slider']){ // Slider-Background
                        echo '<div class="carousel carousel-slider center">';
                        foreach($settings['background_images'] as $img){
                            echo '<div class="carousel-item"><img class="'.$stretch.'" src="img/background/'.$img.'"/></div>';
                        }
                        echo '</div>';
                    }else{ // Static Image-Background
                        echo '<img class="background_image '.$stretch.'" src="img/background/'.$settings['background_images'][0].'"/>';
                    }
                } ?>
        </div>

        <?php if($settings['audio_source'] == 'youtube'){ // Youtube backgroud music ?>
            <div id="youtube_music_player"></div>
            <?php
                if($settings['random_audio']){ // Random youtube title
                    $count = (count($settings['youtube_music_background_ids'])-1);
                    $rand = rand(0, $count);
                    if($rand <= 0){
                        $rand = 0;
                    }
                    $rand_youtube_music = $settings['youtube_music_background_ids'][$rand];
                }else{ // First youtube title
                    $rand_youtube_music = $settings['youtube_music_background_ids'][0];
                }
                // Volume-Setting
                $volume = $settings['audio_volume']*100;
            }else{
                if($settings['random_audio']){ // Random music local
                    $count = (count($settings['audios'])-1);
                    $rand = rand(0, $count);
                    $play_audio = $settings['audios'][$rand];
                }else{ // First music local
                    $play_audio = $settings['audios'][0];
                }
            } ?>

        <div id="mp3_player">
            <div id="audio_box"></div>
            <canvas id="analyser_render"></canvas>
        </div>

        <div id="player"></div>

        <script>
        </script>

        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="libs/materialize/js/materialize.min.js"></script>
        <script type="text/javascript" src="assets/js/garrysmod.js"></script>
        <script type="text/javascript" src="assets/js/layout.js"></script>
        <script type="text/javascript" src="assets/js/contentloaded.js"></script>
        <?php
            if($settings['demo'] && $preview === true){
                echo '<script type="text/javascript" src="assets/js/demo.js"></script>';
            }
            if($settings['visualize_audio']){
                echo '<script type="text/javascript" src="assets/js/audiovisualizer.js"></script>';
            }
        ?>

        <script>

            <?php if($settings['audio_source'] != 'youtube' && $settings['visualize_audio'] === true){ ?>
                create_visualaudio('audios/<?=$play_audio?>', 'audio_box', 'analyser_render', '<?=$settings['visualize_color']?>', <?=$settings['audio_volume']?>, <?=$settings['visualize_audio']?>);
            <?php }elseif($settings['audio_source'] != 'youtube'){ ?>
                var audio = new Audio();
                audio.src = 'audios/<?=$play_audio?>';
                audio.volume = <?=$settings['audio_volume']?>;
                audio.play();
            <?php } ?>

            <?php if($settings['audio_source'] == 'youtube' && isset($rand_youtube_music) && isset($volume)){ ?>
                var tag = document.createElement('script');

                tag.src = "//www.youtube.com/iframe_api";
                var firstScriptTag = document.getElementsByTagName('script')[0];
                firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

                var player;

                function onYouTubeIframeAPIReady() {
                    player = new YT.Player('youtube_music_player', {
                        height: '0',
                        width: '0',
                        playerVars: {
                            autoplay: 1,
                            loop: 1,
                            controls: 0,
                            showinfo: 0,
                            autohide: 1,
                            modestbranding: 1,
                            playlist: '<?=$rand_youtube_music?>'
                        },
                        videoId: '<?=$rand_youtube_music?>',
                        events: {
                            'onReady': onPlayerReady,
                            'onStateChange': onPlayerStateChange
                        }
                    });
                }

                function onPlayerReady(event) {
                    event.target.playVideo();
                    player.setVolume(<?=$volume?>);
                }

                var done = false;

                function onPlayerStateChange(event) {

                }

                function stopVideo() {
                    player.stopVideo();
                }
            <?php } ?>
        </script>
    </body>
</html>
