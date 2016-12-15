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
 * Time: 14:13
 */

session_start();

require_once('inc/basics.inc.php');
require_once('inc/functions.inc.php');

$admin_logged_in = false;
$admin_isset = false;
$preview = false;
$edit_config = false;

if(file_exists('assets/temp/admin.txt')){ //Check if admin-login exists
    $admin_isset = true;
}else{
    unset($_SESSION['user']);
    unset($_SESSION['password']);
}

if(isset($_POST['create_admin']) && $admin_isset === false){ //Check if admin-login doesn't exists & if the admin should be created
    $p = $_POST;
    //print_r($p);
    if(!empty($p['admin_login']) && !empty($p['admin_password'])){
        $user = md5(trim($p['admin_login']));
        $password = md5(trim($p['admin_password']));
        $txt = $user.'|||_(*,*)_|||'.$password;
        $admin = fopen($admintxt, 'w') or die('Unable to create Admin-Account! Please contact an admin!');
        fwrite($admin, $txt);
        fclose($admin);
        if(isset($p['save_cleartext']) && $p['save_cleartext'] == 'on'){
            $txt = 'Username: '.$p['admin_login'].'   Password: '.$p['admin_password'];
            $admin = fopen('assets/temp/admin_cleartext.txt', 'w') or die('Unable to create Admin-Account! Please contact an admin!');
            fwrite($admin, $txt);
            fclose($admin);
        }
        $_SESSION['user'] = $user;
        $_SESSION['password'] = $password;
        $admin_isset = true;
    }
}

if(isset($_POST['login'])){
    $p = $_POST;
    if(!empty($p['admin_login']) && !empty($p['admin_password'])){
        $userdata = array();
        $user = md5($p['admin_login']);
        $password = md5($p['admin_password']);
        $admin = fopen($admintxt, 'r') or die('Something went badly wrong! Please reload or contact an admin!');
        $userdata = explode('|||_(*,*)_|||', fread($admin, filesize($admintxt)));
        if($user == $userdata[0] && $password == $userdata[1]){
            $_SESSION['user'] = $user;
            $_SESSION['password'] = $password;
        }
    }
}

if(isset($_SESSION['user']) && isset($_SESSION['password'])){
    $user = $_SESSION['user'];
    $password = $_SESSION['password'];
    $admin = fopen($admintxt, 'r') or die('Something went badly wrong! Please reload or contact an admin!');
    $userdata = explode('|||_(*,*)_|||', fread($admin, filesize($admintxt)));
    if($user == $userdata[0] && $password == $userdata[1]){
        $admin_logged_in = true;
    }else{
        unset($_SESSION['user']);
        unset($_SESSION['password']);
    }
}

if(isset($_GET['logout'])){
    $admin_logged_in = false;
    $_SESSION['user'] = false;
    $_SESSION['password'] = false;
    session_destroy();
}

if($admin_isset === true && $admin_logged_in === true){
    $edit_config = true;

    require_once('inc/config.inc.php');
    if(file_exists('inc/my_config.inc.php')){
        require_once('inc/my_config.inc.php');
    }
    require_once('inc/info.inc.php');
    require_once('inc/colors.inc.php');

    if(isset($_POST['submit'])){

        $p = array();
        $p = $_POST;
        foreach($p as $key => $post){
            if($post === 'on' || $post === 'true'){
                $p[$key] = 'true';
            }
            if($post === 'off' || $post == 'false'){
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
     * User: D3
     */



    /*********************************************     SETTINGS     *********************************************\


    /* This file is generated automatically! */


    $settings[\'steam_api_key\'] = \''.$p['steam_api_key'].'\';

    $settings[\'server_ip\'] = \''.$p['server_ip'].'\';

    $settings[\'server_port\'] = \''.$p['server_port'].'\';

    $settings[\'logo\'] = \''.$p['logo'].'\';

    $settings[\'logo_dark\'] = '.$p['logo_dark'].';

    $settings[\'demo\'] = '.$p['demo'].';

    $settings[\'copyright\'] = \''.$p['copyright'].'\';

    $settings[\'audio_source\'] = \''.$p['audio_source'].'\';

    $settings[\'background_source\'] = \''.$p['background_source'].'\';  //ATTENTION - YOUTUBE - EXTREME EXPERIMENTAL

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

    $settings[\'theme_color\'] = \''.$p['theme_color'].'\';

    $settings[\'progress_color\'] = \''.$p['progress_color'].'\';

    $settings[\'center_boxes\'] = '.$p['center_boxes'].';

    $settings[\'language\'] = \''.$p['language'].'\';

    $settings[\'theme\'] = \''.$p['theme'].'\';

    $settings[\'news\'] = '.var_export($p['news'], true).';
        ';

        $configFile = fopen("inc/my_config.inc.php", "w") or die("Unable to create file! Please contact an admin!");
        fwrite($configFile, $txt);
        fclose($configFile);
    }else{
        $preview = true;
    }
    
}

?>



<!DOCTYPE html>
<html>
    <head>
        <!--Import Google Icon Font-->
        <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="libs/materialize/css/materialize.min.css"  media="screen,projection"/>

        <link type="text/css" rel="stylesheet" href="assets/css/install.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="assets/css/animate.css"  media="screen,projection"/>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body class="grey lighten-3">

        <div class="row">
            <div class="col m12 l3"></div>
            <div class="col m12 l6">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Installation/Config
                            <?php if($admin_logged_in === true){ ?><span class="right"><a href="install.php?logout" id="logout" class="waves-effect waves-light btn red">Logout</a></span><?php } ?>
                            <?php if($preview === true){ ?><span class="right" style="margin-right: 5px;"><a id="preview" class="waves-effect waves-light btn">Preview</a></span><?php } ?>
                        </span>
                        <hr>
                        <br>
                        <div class="row">
                            <?php if(!isset($p['submit']) && $edit_config === true){ //if logged in and not submitted ?>
                                <form id="configuration" class="col s12" method="post" action="install.php">
                                    <?php

                                        $array = array();
                                        $counter = 0;
                                        foreach($settings as $key => $setting){
                                            if(!is_array($setting)){
                                                $counter++;
                                                $value = $setting;

                                                $type = 'text';
                                                if($value === true || $value === false){
                                                    $type = 'switch';
                                                }
                                                if(is_numeric($value) && $key != 'server_port'){
                                                    $type = 'number';
                                                    $value = $value*100;
                                                }

                                                if($value === true){
                                                    $value = 'checked';
                                                }
                                                if($value === false){
                                                    $value = '';
                                                }

                                                if($value === 'locale' || $value === 'youtube'){
                                                    $type = 'select';
                                                    if($value === 'locale'){
                                                        $locale = 'selected';
                                                        $youtube = '';
                                                    }else{
                                                        $locale = '';
                                                        $youtube = 'selected';
                                                    }
                                                }

                                                if($key === 'progress_color' || $key === 'theme_color' || $key === 'visualize_color'){
                                                    $color_selected = $value;
                                                    $type = 'select_color';
                                                }

                                                $infos = str_replace("'", "\'", htmlspecialchars($info[$key]));
                                                $id = $key;
                                                $label = strtoupper($key);
                                                if($type == 'text'){
                                                    echo '<div class="input-field col s6">';
                                                    echo '<input name="'.$id.'" onclick="Materialize.toast(\''.$infos.'\', 4000)" value="'.$value.'" id="'.$id.'" type="'.$type.'" class="validate">';
                                                    echo '<label for="'.$id.'">'.$label.'</label>';
                                                    echo '</div>';
                                                }elseif($type == 'switch'){
                                                    echo '<div class="col s6" style="margin-bottom: 38px;">';
                                                    echo '<label for="'.$id.'">'.$label.'</label>';
                                                    echo '<div class="switch">';
                                                    echo '<label>Off';
                                                    echo '<input name="'.$id.'" onclick="Materialize.toast(\''.$infos.'\', 4000)" id="'.$id.'" type="checkbox" '.$value.' />';
                                                    echo '<span class="lever"></span>';
                                                    echo 'On</label>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                }elseif($type == 'number'){
                                                    echo '<div class="range-field col s6">';
                                                    echo '<label for="'.$id.'">'.$label.' (%)</label>';
                                                    echo '<input name="'.$id.'" type="range" id="'.$id.'" min="0" max="100" value="'.$value.'" />';
                                                    echo '</div>';
                                                }elseif($type == 'select'){
                                                    echo '<div class="input-field col s6">';
                                                    echo '<select name="'.$id.'" id="'.$id.'" onclick="Materialize.toast(\''.$infos.'\', 4000)">';
                                                    echo '<option value="locale" '.$locale.'>Locale</option>';
                                                    echo '<option value="youtube" '.$youtube.'>Youtube</option>';
                                                    echo '</select>';
                                                    echo '<label for="'.$id.'">'.$label.'</label>';
                                                    echo '</div>';
                                                }elseif($type == 'select_color'){
                                                    echo '<div class="input-field col s6">';
                                                    echo '<select name="'.$id.'" id="'.$id.'" onclick="Materialize.toast(\''.$infos.'\', 4000)">';
                                                    foreach($colors[$id] as $color){
                                                        if($color === $color_selected){
                                                            $selected = 'selected';
                                                        }else{
                                                            $selected = '';
                                                        }
                                                        echo '<option value="'.$color.'" '.$selected.'>'.$color.'</option>';
                                                    }
                                                    echo '</select>';
                                                    echo '<label for="'.$id.'">'.$label.'</label>';
                                                    echo '</div>';
                                                }
                                                if($counter % 2 == 0){
                                                    echo '<div class="clearfix"></div>';
                                                }
                                            }else{
                                                //$counter++;
                                                $array[$key] = $setting;
                                            }
                                        }
                                        echo '<div class="clearfix"></div><hr>';
                                        $counter = 0;
                                        $_counter = 0;
                                        foreach($array as $key => $value){
                                            $id = $key;
                                            $label = strtoupper($key);
                                            $infos = str_replace("'", "\'", htmlspecialchars($info[$key]));
                                            $first = true;
                                            $do_hr = false;
                                            $items = count($value);
                                            $style = 'padding-bottom: 30px;';
                                            foreach($value as $_key => $_value){
                                                if(!is_array($_value)){
                                                    if($first){
                                                        echo '<div class="input_wrapper" style="position: relative; '.$style.'"><div id="'.$id.'" style=""><h6 onclick="Materialize.toast(\''.$infos.'\', 4000)" for="'.$id.'" style="color: #9e9e9e; font-size: 0.8rem; margin-bottom: 0; margin-top: 20px;">'.$label.'</h6>';
                                                    }
                                                    $first = false;
                                                    $do_hr = true;
                                                    $counter++;

                                                    /*if($id == 'audios'){
                                                        echo '<div class="file-field input-field col s6">';
                                                        echo '<div class="btn"><span>Browse</span><input type="file"></div>';
                                                        echo '<div class="file-path-wrapper"><input class="file-path validate" type="text" name="'.$id.'[]" value="'.$value2.'" id="'.$id.$counter.'" /></div>';
                                                        echo '</div>';
                                                    }else{*/
                                                        echo '<div class="input-field col s6">';
                                                        echo '<input name="'.$id.'[]" value="'.$_value.'" id="'.$id.$counter.'" type="text" class="validate" />';
                                                        echo '</div>';
                                                    //}

                                                }else{
                                                    foreach($_value as $__key => $__value){
                                                        if($first){
                                                            echo '<div class="input_wrapper" style="position: relative; '.$style.'"><div class="specialfield" id="'.$id.'"><h6 onclick="Materialize.toast(\''.$infos.'\', 4000)" for="'.$id.'" style="color: #9e9e9e; font-size: 0.8rem; margin-bottom: 0; margin-top: 20px;">'.$label.'</h6>';
                                                        }
                                                        $first = false;
                                                        $do_hr = true;
                                                        $counter++;
                                                        if($counter%2 == 0){
                                                            $field = 'text';
                                                        }else{
                                                            $field = 'date';
                                                            $_counter++;
                                                        }
                                                        echo '<div class="input-field col s6">';
                                                        echo '<input name="'.$id.'['.$_counter.']['.$field.']" value="'.$__value.'" id="'.$id.$counter.'" type="text" class="validate" />';
                                                        echo '</div>';
                                                    }
                                                }
                                            }
                                            if($do_hr){
                                                echo '</div><div class="clearfix"></div>
                                                        <div class="input-field" style="position: absolute; right: 0; bottom: 0;">
                                                            <a data-id="'.$id.'" data-number="'.$_counter.'" class="add_item btn-floating btn waves-effect waves-light blue darken-4" style="margin-right: 5px;">
                                                                <i class="material-icons">add</i>
                                                            </a>
                                                            <a data-id="'.$id.'" class="remove_item btn-floating btn waves-effect waves-light red darken-4">
                                                                <i class="material-icons">remove</i>
                                                            </a>
                                                        </div>
                                                        </div><hr>';
                                            }
                                        }

                                    ?>
                                    <div class="clearfix"></div>
                                    <br>
                                    <div class="col s6">
                                        <button class="waves-effect waves-light btn blue col s12" name="submit" value="true" type="submit">Finish</button>
                                    </div>
                                    <div class="col s6">
                                        <button class="waves-effect waves-light btn red darken-2 col s12" type="reset">Reset</button>
                                    </div>
                                </form>
                            <?php }elseif(isset($p['submit']) && $edit_config === true){ //if logged in and form submitted ?> 
                                <div class="card-panel teal lighten-2 center">Installation complete! Your loading screen is ready now!</div>
                                <div class="card-panel blue lighten-2 center">"News" need to be set seperatly in the "config.inc.php".</div>
                                <div class="card-panel blue-grey lighten-1 center">You'll find it in the "inc"-Folder.</div>
								<div class="card-action">
                                    <div class="col s4">
                                        <a class="waves-effect waves-light btn col s12 orange" href="javascript:history.back()">Back</a>
                                    </div>
									<div class="col s8">
										<a class="waves-effect waves-light btn col s12" href="./">Take me to my Loadingscreen!</a>
									</div>
								</div>
                            <?php }elseif($admin_isset === false){ //if no admin is set (First installation) ?>
                                <h6>Please create an admin account!</h6>
                                <br>
                                <div class="row">
                                    <form id="admin_account" class="col s12" method="post" action="install.php">
                                        <div class="input-field col s6">
                                            <input name="admin_login" id="admin_login" type="text" class="validate">
                                            <label for="admin_login">Username</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input name="admin_password" id="admin_password" type="password" class="validate">
                                            <label for="admin_password">Password</label>
                                        </div>
                                        <div class="col s12">
                                            <input name="save_cleartext" id="save_cleartext" type="checkbox">
                                            <label for="save_cleartext">Save Username and Password in clear text (WARNING! VERY DANGEROUS!)</label>
                                        </div>
                                        <div class="clearfix"></div>
                                        <br>
                                        <div class="col s6">
                                            <button class="waves-effect waves-light btn blue col s12" name="create_admin" value="true" type="submit">Submit</button>
                                        </div>
                                        <div class="col s6">
                                            <button class="waves-effect waves-light btn red darken-2 col s12" type="reset">Reset</button>
                                        </div>
                                    </form>
                                </div>
                            <?php }else{ //if not logged in ?>
                                <h6>Admin login</h6>
                                <br>
                                <div class="row">
                                    <form id="admin_account" class="col s12" method="post" action="install.php">
                                        <div class="input-field col s6">
                                            <input name="admin_login" id="admin_login" type="text" class="validate">
                                            <label for="admin_login">Username</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input name="admin_password" id="admin_password" type="password" class="validate">
                                            <label for="admin_password">Password</label>
                                        </div>
                                        <div class="clearfix"></div>
                                        <br>
                                        <div class="col s6">
                                            <button class="waves-effect waves-light btn blue col s12" name="login" value="true" type="submit">Login</button>
                                        </div>
                                        <div class="col s6">
                                            <button class="waves-effect waves-light btn red darken-2 col s12" type="reset">Reset</button>
                                        </div>
                                    </form>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col m12 l3">
                <?php if(!isset($p['submit']) && $edit_config === true){ //if logged in and not submitted ?>
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Language-Overview</span>
                        <hr>
                        <br>
                        <form id="sub_settings" class="col s12">
                            <div class="input-field col s12">
                                <select name="language" id="language_field">
                                    <?php
                                        $translations = listAllFolderFiles('translation');

                                        foreach($translations as $key => $value){
                                            $file = str_replace('.inc.php', '', $value);
                                            $file = str_replace('translation_', '', $file);
                                            echo '<option value="'.$file.'">'.$file.'</option>';
                                        }
                                    ?>
                                </select>
                                <label for="language">Language</label>
                                <div class="collection">
                                    <?php
                                        $translation = array();
                                        $counter = 0;
                                        $style = '';
                                        foreach($translations as $key => $value){
                                            $file = str_replace('.inc.php', '', $value);
                                            $file = str_replace('translation_', '', $file);
                                            include_once('translation/'.$value);
                                            if($counter != 0){
                                                $style = 'display: none';
                                            }
                                            echo '<div id="__'.$file.'" class="language_overview" style="'.$style.'">';
                                            foreach($translation as $_key => $_value){
                                                echo '<a href="javascript:void()" class="collection-item">'.$_key.'<span class="badge">'.$_value.'</span></a>';
                                            }
                                            echo '</div>';
                                            $counter++;
                                        }
                                    ?>
                                </div>
                                <div class="chip left" style="height: auto;">Here you can see which languages are available and which words are used in it!</div>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <div id="user_ip" class="hiddendiv"><?=$ip?></div>

        <div class="iframe_background"></div>
        <div class="iframe_container">
            <div class="iframe">
                <div class="iframe_content">
                    <a class="btn-floating btn-large waves-effect waves-light red close_tab" style="position: absolute; top: 25px; right: 25px;"><i class="material-icons">close</i></a>
                </div>
            </div>
        </div>


        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="assets/js/d3s4st3r.plugin.animate.js"></script>
        <script type="text/javascript" src="assets/js/d3s4st3r.plugin.iframe.js"></script>
        <script type="text/javascript" src="libs/materialize/js/materialize.min.js"></script>
        <script type="text/javascript" src="assets/js/install.js"></script>
    </body>
</html>
