<?php

//
// Copyright (C) 2009-2035 FreePBX-Swiss Urs Rueedi
//

if(preg_match("/grandstream/i",$_SERVER["HTTP_USER_AGENT"]))
define('DEBUG_FUNCTION', '');

include("../../config.php");

$header=Aastra_decode_HTTP_header();
global $debug; $debug['grandstream/dheader'][] = "(grandstream 1) ".$header[0]."-".$header[1]."-".$header[2];
$remote_ip=$_SERVER['REMOTE_ADDR'];
$file = $_SERVER['REQUEST_URI'];

if(DEBUG_FUNCTION == 'd' || DEBUG_FUNCTION == 'grandstream' && ($_REQUEST['model'] && $_REQUEST['mac'] && $_REQUEST['firmware']))
{
    $model = $_REQUEST['model'];
    $mac = $_REQUEST['mac'];
    $firmware = $_REQUEST['firmware'];
    $qpass = $_REQUEST['qpass'];
} else {
    $nonepass = true;
    $model = $header[0];
    $mac = $header[1];
    $firmware = $header[2];
    define(DEBUG_VIEW, false);
}
$mac = strtoupper($mac);

global $debug; $debug['grandstream/dheader'][] = "(grandstream 2) model=$model, mac=$mac firmware=$firmware, remote_ip=$remote_ip, file=$file";
switch($model) {
  case "Aastra6730i":
  case "Aastra6731i":
  case "Aastra6753i":
  case "Aastra6755i":
  case "Aastra6757i":
  case "Aastra6739i":
  case "Aastra53i":
  case "Aastra55i":
  case "Aastra57i":
    $model = str_replace("Aastra5","Aastra675",$model);
    if (stristr($file,"grandstream.cfg")) {
        if(function_exists("get_grandstream_cfg"))
        $host = get_dbhost($hosts);
        $sag = new Sag($host);
        get_grandstream_cfg($mac);
    } else {
    if(preg_match("/^00085D/i",$mac)) {
        global $debug; $debug['grandstream/mswitch'][] = "(grandstream) OK model=$model file=$file";
        $host = get_dbhost($hosts);
        $sag = new Sag($host);
            if(preg_match("/^00085D/",$mac) && filemtime("/tmp/phone-".$mac) <= (time()-6)){
                    touch("/tmp/phone-".strtoupper($mac));

                    $phone_data = get_phone_data($mac, $qpass, $nonepass);
                    if($phone_data == false) exit;
                    $phone_data['device'] = strtolower($model);

                    // Upgrade Firmware if customers.firmwareupgrade is on (is not supported now)
//                    if(DEBUG_FUNCTION != 'all' && DEBUG_FUNCTION != 'grandstream' && $phone_data['firmwareupdate'] == '1') check_firmware($phone_type);
//                    else {global $debug; $debug['grandstream/prov'][] = "(grandstream) firmwareupdate is not supported from phone firmwareupdate=".$phone_data['firmwareupdate'];}
                    // Upgrade Firmware if customers.firmwareupgrade is on
                    if((DEBUG_FUNCTION != 'all' && DEBUG_FUNCTION != 'grandstream') || $phone_data['prov'][0]['mac'] == true ) {
                        get_provisioning($phone_data);
                        global $debug; $debug['grandstream/getprov'][] = " (get_provision) MAC=$mac, $model".$phone_data['callerid']." $add";
                    } else {global $debug; $debug['grandstream/getprov'][] = " (get_provision) is not supported from phone provisioned=".$phone_data['provisioned'];}
            } else {global $debug; $debug['grandstream/prov'][] = "(provision failed) mac=".strtoupper($mac)." && Timediff:".filemtime("/tmp/phone-".strtoupper($mac));}
    }
    }
    break;
    if(function_exists(debug_log) && $debug) {
        foreach($debug as $k1 => $deb) {
            foreach($deb as $k2 => $detail) {
             debug_log('['.$k1.']['.$k2.'] '.$detail.']',$k1);
            }
        }
    }
}

function Aastra_decode_HTTP_header()
{
 if($_REQUEST['user_agent'] != false)
    $user_agent = $_REQUEST['user_agent'];
 else
  $user_agent=$_SERVER["HTTP_USER_AGENT"];
  if(stristr($user_agent,"Aastra"))
  {
    $value=preg_split("/ MAC:/",$user_agent);
    $fin=preg_split("/ /",$value[1]);
    $value[1]=preg_replace("/\-/","",$fin[0]);
    $value[2]=preg_replace("/V:/","",$fin[1]);
  } else {
    $value[0]="MSIE";
    $value[1]="NA";
    $value[2]="NA";
  }
  $value[3]=$_SERVER["REMOTE_ADDR"];
  return($value);
}

function get_grandstream_cfg($mac)
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