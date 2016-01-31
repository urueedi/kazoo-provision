<?php

//
// Copyright (C) 2014-2065 FreePBX-Swiss Urs Rueedi
//

// handle som restrictions about kazoo
$headers = getallheaders();
header('Content-Type: text/html; charset=UTF-8');

$path = explode("?",$_SERVER['REQUEST_URI']);$f_path = explode("/",$path[0]);
unset($f_path[0]);unset($f_path[1]);// unset / and /prov
// disable debug if user_agent %=% snom
if(preg_match("/snom/i",$_SERVER["HTTP_USER_AGENT"])) @define('DEBUG_FUNCTION' , '');
require_once('../../config.php');
if($_REQUEST["phonetyp"] && $_REQUEST["pass"] && $_REQUEST["mac"])
{
      $remote_ip=$_SERVER['REMOTE_ADDR'];
      $extension=$_REQUEST["extension"];
      $password=$_REQUEST["pass"];
      if($_REQUEST["mac"]) $mac=str_replace(":","",$_REQUEST["mac"]);
      global $debug; $debug[] = array(level=>'d',status=>'info',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '." rem_ip=$remote_ip, ext=$extension, pass=$password, mac=$mac");
}
else
{
      // correct problem snom delimiter ?
      if (preg_match("/\?/",$mac)) {
        $value=preg_split("/\?/",$mac);
        $mac = strtoupper($value[0]);
        $val=preg_split("/\=/",$value[1]);
        $extension = $val[1];
        $val=preg_split("/=/",$value[2]);
        $password = $val[1];
     }
      if (preg_match("/\?/",$extension)) {
        $value=preg_split("/\?/",$extension);
        $extension = $value[0];
        $val=preg_split("/\=/",$value[1]);
        $password = $val[1];
        define(DEBUG_VIEW, false);
      }
      if($_REQUEST['mac']) $mac = $_REQUEST['mac'];
      global $debug; $debug[] = array(level=>'d',status=>'info',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '."rem_ip=$remote_ip, ext=$extension, pass=$password, mac=$mac");
}

$mac = strtoupper(trim($mac));
$value = snom_decode_HTTP_header();

if($_REQUEST['user_agent'] != false) $agent = $_REQUEST['user_agent'];
else $agent = $_SERVER['HTTP_USER_AGENT'];

if($_REQUEST['phonetyp'] != '') {
    $phone_type = $_REQUEST['phonetyp'];
} else {
    $phone_type = check_snomphone_type($agent);
    define(DEBUG_VIEW,false);
}

global $debug; $debug[] = array(level=>'d',status=>'info',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '."type=$phone_type mac=$mac pass=".$_REQUEST['pass']);
switch(strtolower($phone_type)) {
  case "snom300":
  case "snom320":
  case "snom360":
  case "snom370":
  case "snom720":
  case "snom760":
  case "snom820":
  case "snom870":
  case "snomm3":
  case "snomm9":
  case "snomm9r":
    if($phone_type == 'snomm3') {
        $agent = $_SERVER['HTTP_USER_AGENT'];
        $qpass = $_REQUEST['pass'];
        global $debug; $debug[] = array(level=>'d',status=>'info',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '."type=$phone_type mac=$mac pass=".$qpass);
        if(stristr($agent,"snom")) {
            list ($model,$type,$protocol,$firmware,$e,$mac) = split('-|\/| \(|=|;', $agent);
            global $debug; $debug[] = array(level=>'d',status=>'info',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '."type=$phone_type mac=$mac pass=".$qpass);
        }
    } else {
        $qpass = $_REQUEST['pass'];
    }
    global $debug; $debug[] = array(level=>'d',status=>'info',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '."qpass=".$qpass. filemtime("/tmp/phone-".$mac));
    if(preg_match("/^00041/i",$mac) && filemtime("/tmp/phone-".strtoupper($mac)) < (time()-6) ) {
        if(stristr("snomm9r",$phone_type)) {$phone_type = 'snomm9';}
            touch("/tmp/phone-".strtoupper($mac));
            $host = get_dbhost($hosts);
            $sag = new Sag($host, $dbport);
            $myip4 = get_ip(4);
            $phone_data = get_phone_data($mac, $qpass);
            $phone_data['device'] = strtolower($phone_type);
            // Upgrade Firmware if customers.firmwareupgrade is on
//print_r($phone_data['account']);exit;
//echo "$agent, $phone_type";
            if($phone_data['account'][0]['provision']['firmware_enabled'] == '1') check_snom_firmware($agent, $phone_type);
            else {global $debug; $debug[] = array(level=>'d',status=>'problem',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '."firmwareupdate is not supported from account:".$phone_data['account'][0]['provision']['firmware_enabled']);}
            if(DEBUG_FUNCTION == 'all' || DEBUG_FUNCTION == 'snom' || $phone_data['prov'][0]['mac'] == true) {
                get_provisioning($phone_data);
                global $debug; $debug[] = array(level=>'d',status=>'info',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '." MAC=$mac, ".$phone_data[$i]['device'].", mac_count(".($i).")");
            } else {global $debug; $debug[] = array(level=>'d',status=>'problem',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '. "provision is not supported from phone provisioned=".$phone_data['provisioned']);}
    } else {global $debug; $debug[] = array(level=>'d',status=>'problem',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '."provision failed mac=".strtoupper($mac)." && Timediff:".filemtime("/tmp/phone-".strtoupper($mac)).">".(time()-60));}
    if(filemtime("/tmp/phone-".strtoupper($mac)) == false && $mac) touch("/tmp/phone-".strtoupper($mac));
  break;
}
show_debug();
include("debug_footer.php");
?>