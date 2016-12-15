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
 * Date: 15.09.2016
 * Time: 17:03
 */

function listAllFolderFiles($dir){
    $files = array();
    $ffs = scandir($dir);
    foreach($ffs as $ff){
        if($ff != '.' && $ff != '..'){
            $files[] = $ff;
        }
    }
    return $files;
}

function source_query($ip, $port){
    $info = array();
    $info['name'] = '';
    $info['map'] = '';
    $info['dir'] = '';
    $info['description'] = '';
    $info['version'] = '';

    $result = '';
    $HL2_stats = '';

    //$cut = explode(":", $ip);
    $HL2_address = $ip;
    $HL2_port = $port;

    $HL2_command = "\377\377\377\377TSource Engine Query\0";

    $HL2_socket = fsockopen("udp://".$HL2_address, $HL2_port, $errno, $errstr, 2); // 3 -> 2 Seconds timeout
    fwrite($HL2_socket, $HL2_command);
    $JunkHead = fread($HL2_socket,4);
    $CheckStatus = socket_get_status($HL2_socket);

    if($CheckStatus["unread_bytes"] == 0)return 0;

    $do = 1;
    while($do){
        $str = fread($HL2_socket,1);
        $HL2_stats.= $str;
        $status = socket_get_status($HL2_socket);
        if($status["unread_bytes"] == 0){
            $do = 0;
        }
    }
    fclose($HL2_socket);

    $x = 0;
    while ($x <= strlen($HL2_stats)){
        $x++;
        $result.= substr($HL2_stats, $x, 1);
    }

    // ord ( string $string );
    $result = str_split($result);
    $info['network'] = ord($result[0]);$char = 1;
    while(ord($result[$char]) != "%00"){$info['name'] .= $result[$char];$char++;}$char++;
    while(ord($result[$char]) != "%00"){$info['map'] .= $result[$char];$char++;}$char++;
    while(ord($result[$char]) != "%00"){$info['dir'] .= $result[$char];$char++;}$char++;
    while(ord($result[$char]) != "%00"){$info['description'] .= $result[$char];$char++;}$char++;
    $info['appid'] = ord($result[$char].$result[($char+1)]);$char += 2;
    $info['players'] = ord($result[$char]);$char++;
    $info['max'] = ord($result[$char]);$char++;
    $info['bots'] = ord($result[$char]);$char++;
    $info['dedicated'] = ord($result[$char]);$char++;
    $info['os'] = chr(ord($result[$char]));$char++;
    $info['password'] = ord($result[$char]);$char++;
    $info['secure'] = ord($result[$char]);$char++;
    while(ord($result[$char]) != "%00"){$info['version'] .= $result[$char];$char++;}

    return $info;
}