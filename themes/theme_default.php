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
 * Date: 19.09.2016
 * Time: 15:57
 */
?>


<?php if($settings['logo']){ ?>
    <?php
    if($settings['logo_dark'] !== 'disable'){
        if($settings['logo_dark'] === true){
            $logo_dark = 'white_theme';
        }else{
            $logo_dark = 'black_theme';
        }
    }else{
        $logo_dark = '';
    }
    ?>
    <div class="logo background">
        <img class="<?=$logo_dark?>" src="img/logo/<?=$settings['logo']?>" width="20%"/>
    </div>
<?php } ?>


<div class="full-width full-height fixed sticktop">




    <div class="row absolute stickleft rules <?=$valign?>" style="margin-left: 0; margin-top: <?=$mtop?>%;">
        <div class="card <?=$settings['theme_color']?>_theme" style="min-width: 200px; max-width: 300px; border-top-left-radius: 0; border-bottom-left-radius: 0;">
            <div class="card-content">
                <span class="card-title center" style="line-height: 0;">
                    <h3 style="-webkit-margin-after: 0;"><?=$t['rules_title']?></h3>
                </span>
                <hr>
                <br>
                <?php
                $counter = 0;
                foreach($settings['rules'] as $rule){
                    $counter++;
                    echo '<p><div class="chip">'.$counter.'</div> - '.$rule.'</p><br>';
                }
                ?>
            </div>
        </div>
    </div>

    <?php if($settings['show_newsbox'] === true){ ?>
        <div class="row absolute halign rules sticktop <?=$valign?>" style="max-width: 50%; -webkit-transform: translate(-50%); transform: translate(-50%); left: 50%; top: 0; margin-top: <?=$mtop?>%;">
            <div class="card news <?=$settings['theme_color']?>_theme">
                <div class="card-content">
                    <span class="card-title center" style="line-height: 0;">
                        <h3 style="-webkit-margin-after: 0;"><?=$t['news_title']?></h3>
                    </span>
                    <hr>
                    <br>
                    <?php
                    $counter = 0;
                    foreach($settings['news'] as $news){
                        $counter++;
                        if($news['date']){
                            echo '<p><div class="chip">'.$news['date'].'</div> - '.$news['text'].'</p><br>';
                        }else{
                            echo '<p>'.$news['text'].'</p><br>';
                        }
                    }
                    ?>
                </div>
                <div class="card-action center">
                    <?php if($settings['copyright'] != ''){ ?>
                        <a href="javascript:void(0)" style="margin-right: 0;">&copy by <?=$settings['copyright']?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="row absolute stickright userinfos <?=$valign?>" style="margin-right: 0; margin-top: <?=$mtop?>%;">
        <div class="card-panel <?=$settings['theme_color']?>_theme" style="min-width: 200px; max-width: 300px; border-top-right-radius: 0; border-bottom-right-radius: 0;">
            <div class="card-content">
                <div class="col s3"></div>
                <div class="col s6">
                    <img src="<?=$avatar?>" class="circle responsive-img"/>
                </div>
                <div class="clearfix"></div>
                <div class="col s12 center">
                    <?=$plname?>
                </div>
                <div class="clearfix"></div>
                <hr>
                <p>
                    <?=$t['map']?>:<br>
                    <strong> - <span id="mapname"><?=$map?></span></strong>
                </p>
                <p>
                    <?=$t['servername']?>:<br>
                    <strong> - <span id="servername"><?=$current_name?></span></strong>
                </p>
                <?php if($use_source_query === true){ ?>
                    <p>
                        <?=$t['current_player']?>:<br>
                        <strong> - <span id="playerslots"><?=$current_player?></span> <?=$t['player']?></strong>
                    </p>
                    <p>
                        <?=$t['gamemode']?>:<br>
                        <strong> - <span id="playerslots"><?=$current_gamemode?></span></strong>
                    </p>
                <?php } ?>
                <p<?php if($use_source_query === true){ ?> class="hide"<?php } ?>>
                    <?=$t['max_player']?>:<br>
                    <strong> - <span id="playerslots2"><?=$current_player?></span> <?=$t['player']?></strong>
                </p>
            </div>
            <div class="clearfix"></div>
            <div class="card-bottom-minicontent card-panel <?=$settings['theme_color']?>_theme">
                <?=$t['connecting']?> ...
            </div>
        </div>
    </div>

</div>

<div class="clearfix"></div>

<div class="row">
    <div class="stickbottom fixed loadingbar col s12 <?=$hb?>">
        <div class="background <?=$settings['theme_color']?>_theme">
            <h5 id="status" class="left"><?=$t['connecting']?> ...</h5>
            <h5 id="percentage" class="right">0%</h5>
            <div class="clearfix"></div>
        </div>
        <div class="progress blue lighten-5">
            <div id="progressbar" class="determinate <?=$settings['progress_color']?>" style="width: 0%"></div>
        </div>
    </div>
</div>
