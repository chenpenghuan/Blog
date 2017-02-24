<?php
/**
 * Created by PhpStorm.
 * User: cph
 * Date: 2017/2/23
 * Time: 22:55
 */
function p($var){
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}
function userAgent($ua)
{
    $iphone = strstr(strtolower($ua), 'mobile');
    $android = strstr(strtolower($ua), 'android');
    $windowsPhone = strstr(strtolower($ua), 'phone');

    function androidTablet($ua)
    {
        if (strstr(strtolower($ua), 'android')) if (!strstr(strtolower($ua), 'mobile')) return true;
    }

    $androidTablet = androidTablet($ua);
    $ipad = strstr(strtolower($ua), 'ipad');

    if ($androidTablet || $ipad) {
        return 'tablet';
    } elseif ($iphone && !$ipad || $android && !$androidTablet || $windowsPhone) {
        return 'mobile';
    } else {
        return 'desktop';
    }
}