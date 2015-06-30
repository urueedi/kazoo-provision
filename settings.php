<?php

//
// Copyright (C) 2014-2065 FreePBX-Swiss Urs Rueedi
//

header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Origin: *');

//Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-Http-Method-Override, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-control, X-Auth-Token, If-Match');
//header('Access-Control-Expose-Headers: Content-Type, X-Auth-Token, X-Request-ID, Location, Etag, ETag');

// handle som restrictions about kazoo
$headers = getallheaders();
if($headers['Access-Control-Request-Headers']) {
    header('Content-Type: text/html; charset=UTF-8');
    header('access-control-allow-headers: content-type,x-auth-token');
    header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS, HEAD');
    header('Allow: GET');
} else {
    header('Content-Type: application/json');
    header('Access-Control-Allow-Headers: content-type,x-auth-token');
    header('Vary: Accept');
}

$path = explode("?",$_SERVER['REQUEST_URI']);$f_path = explode("/",$path[0]);
unset($f_path[0]);unset($f_path[1]);// unset / and /prov

// disable debug if user_agent %=% snom
if(preg_match("/snom/i",$_SERVER["HTTP_USER_AGENT"])) @define('DEBUG_FUNCTION' , '');
require_once('config.php');

$host = get_dbhost($hosts);
$sag = new Sag($host);
$myip4 = get_ip(4);

//show_debug();
get_groundsettings($f_path);

include("debug_footer.php");

?>