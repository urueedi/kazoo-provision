<?php

//
// Copyright (C) 2009-2035 FreePBX-Swiss Urs Rueedi
//

// /provisioner/prov/yealink/001577885533.cfg HTTP/1.1" 200 - "-" "Yealink SIP-T48G 35.80.0.70 00:15:77:88:33:55"
// /provisioner/prov/yealink/001577885533.cfg?mac={mac}&pass=urlpass HTTP/1.1" 200 - "-" "Yealink SIP-T48G 35.80.0.70 00:15:77:88:33:55"

if(preg_match("/yealink/i",$_SERVER["HTTP_USER_AGENT"]))
define('DEBUG_FUNCTION', '');

include("../../config.php");

$header=Yealink_decode_HTTP_header();
global $debug; $debug['yealink/dheader'][] = "(yealink 1) ".$header[0]."-".$header[1]."-".$header[2];
$remote_ip=$_SERVER['REMOTE_ADDR'];
$file = $_SERVER['REQUEST_URI'];

if(DEBUG_FUNCTION == 'd' || DEBUG_FUNCTION == 'yealink' && ($_REQUEST['model'] && $_REQUEST['mac'] && $_REQUEST['qpass'] && $_REQUEST['firmware']))
{
    $model = $_REQUEST['model'];
    $mac = $_REQUEST['mac'];
    $firmware = $_REQUEST['firmware'];
    $qpass = $_REQUEST['qpass'];
    global $debug; $debug[] = array(level=>'d',status=>'info',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '."rem_ip=$remote_ip, pass=$qpass, mac=$mac");

} else {
    $nonepass = false;
    $model = strtolower($header[0].$header[1]);
    $mac = strtoupper(str_replace(":","",$header[3]));
    $firmware = $header[2];
    define(DEBUG_VIEW, false);
    if($_REQUEST['pass']) $qpass = $_REQUEST['pass'];
    global $debug; $debug[] = array(level=>'d',status=>'info',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '."rem_ip=$remote_ip, pass=$qpass, mac=$mac");
    if(strtoupper(str_replace(":","",$_REQUEST['mac'])) !== $mac) $model = false;
}
$mac = strtoupper(str_replace(":","",$mac));
global $debug; $debug['yealink/dheader'][] = "(yealink 2) model=$model, mac=$mac firmware=$firmware, remote_ip=$remote_ip, file=$file";

switch($model) {
    case 'yealinksip-t19p':
    case 'yealinksip-t21p':
    case 'yealinksip-t22p':
    case 'yealinksip-t23p':
    case 'yealinksip-t26p':
    case 'yealinksip-t28p':
    case 'yealinksip-t32g':
    case 'yealinksip-t38g':
    case 'yealinksip-t41g':
    case 'yealinksip-t42g':
    case 'yealinksip-t46g':
    case 'yealinksip-t46g-1':
    case 'yealinksip-t46g-2':
    case 'yealinksip-t48g':
    case 'yealinksip-t48g-1':
    case 'yealinksip-t48g-2':
    case 'yealinksip-w52p':
    if (stristr($file,"yealink.cfg")) {
        if(function_exists("get_yealink_cfg"))
        $host = get_dbhost($hosts);
        $sag = new Sag($host, $dbport);
        get_yealink_cfg($mac);
    } else {
        if(preg_match("/^001565/i",$mac)) {
            global $debug; $debug['yealink/mswitch'][] = "(yealink) OK model=$model file=$file";
            $host = get_dbhost($hosts);
            $sag = new Sag($host, $dbport);
            if(preg_match("/^001565/",$mac) && filemtime("/tmp/phone-".$mac) <= (time()-6)){
                    touch("/tmp/phone-".strtoupper($mac));
                    $phone_data = get_phone_data($mac, $qpass, $nonepass);
                    if($phone_data == false) exit;
                    $phone_data['device'] = strtolower($model);
//print_r($phone_data);
                    if($phone_data['account'][0]['provision']['firmware_enabled'] == '1') check_yealink_firmware($agent, $phone_type);
                    else {global $debug; $debug[] = array(level=>'d',status=>'problem',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '."firmwareupdate is not supported from account:".$phone_data['account'][0]['provision']['firmware_enabled']);}
                    if(DEBUG_FUNCTION == 'all' || DEBUG_FUNCTION == 'yealink' || $phone_data['prov'][0]['mac'] == true) {
                        get_provisioning($phone_data);
                        global $debug; $debug['yealink/getprov'][] = " (get_provision) MAC=$mac, $model".$phone_data['callerid']." $add";
                    } else {global $debug; $debug['yealink/getprov'][] = " (get_provision) is not supported from phone provisioned=".$phone_data['provisioned'];}
            } else {global $debug; $debug['yealink/prov'][] = "(provision failed) mac=".strtoupper($mac)." && Timediff:".filemtime("/tmp/phone-".strtoupper($mac));}
        }
    }
//print_r($debug);
    break;
    if(function_exists(debug_log) && $debug) {
        foreach($debug as $k1 => $deb) {
            foreach($deb as $k2 => $detail) {
             debug_log('['.$k1.']['.$k2.'] '.$detail.']',$k1);
            }
        }
    }
}

function Yealink_decode_HTTP_header()
{
 if($_REQUEST['user_agent'] != false)
    $user_agent = $_REQUEST['user_agent'];
 else
  $user_agent=$_SERVER["HTTP_USER_AGENT"];

 if(stristr($user_agent,"Yealink"))
 {
    $value=explode(" ",$user_agent);
 } else {
    $value[0]="MSIE";
    $value[1]="NA";
    $value[2]="NA";
 }
 $value[]=$_SERVER["REMOTE_ADDR"];
 return($value);
}

function get_yealink_cfg($mac)
{
    $phone_data = get_phone_data($mac, false, true);
    $durl = parse_url($_SERVER['REQUEST_URI']);

    $search = array(
    '{{HOST_PROVSERVER}}',
    '{{HOST_TIMESERVER}}',
    '{{PROV_PASSWORD}}',
    '{{NEW_LOGIN}}',
    '{{Phone_Reregister_Prov}}',
    );

    $replace = array(
    $durl['host'],
    $durl['host'],
    'provpass',
    _("Logout"),
    '360',
    );

    // make slower for security
    sleep(4.5);
    $generator = $phone_data['template']->pvt_generator;
    $read = $generator($phone_data['template']->cfg_base,'settings');
    if($read)
        echo preg_replace($search, $replace, $read);
}

show_debug();
include("../snom/debug_footer.php");
?>