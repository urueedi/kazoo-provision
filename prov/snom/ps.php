<?php

//
// Copyright (C) 2009-2065 FreePBX-Swiss Urs Rueedi
//

if(preg_match("/snom/i",$_SERVER["HTTP_USER_AGENT"]))
define('DEBUG_FUNCTION' , '');

include("config.php");

// get MAC address and type of phone
$value = snom_decode_HTTP_header();
$ip = $value[3];
$model = $value[2];

// adding portnumer
if($ip) {
    if(!preg_match("#:#",$ip))
        $ip = $ip.":80";
}
global $ip;

$provdata = get_prov_data();
foreach($provdata as $key => $value) {
  if ($value['ip'] == $ip) {
    $exten = $key;
    $mac = $value['mac'];
  }
}

if ($_REQUEST['ext']) {
    $exten = $_REQUEST['ext'];
    $ext = $exten;
} else
    $ext = false;

if (! isset($exten) || ! preg_match("/300|320|360|370|720|760|820|870|m3|m9|snom/",$model) || $_REQUEST['mac'] != $mac)
    exit;

// Change to Userlanguage
$sip_array = change_language($exten);
		
function snom_menu($mac) {

	print("<SnomIPPhoneMenu>");
	printf("<Title>%s</Title>", _("Presence Switch"));

	// online
	printf("<MenuItem>");
	printf("<Name>%s</Name>", _("Go online"));
	printf("<URL>http://%s%s?mac=%s&action=online</URL>", $_SERVER['HTTP_HOST'], $_SERVER['PHP_SELF'],$mac);
	printf("</MenuItem>");

	// offline
	printf("<MenuItem>");
	printf("<Name>%s</Name>", _("Go offline"));
	printf("<URL>http://%s%s?mac=%s&action=offline</URL>", $_SERVER['HTTP_HOST'], $_SERVER['PHP_SELF'],$mac);
	printf("</MenuItem>");

	printf("<MenuItem>");
	printf("<Name>%s</Name>", _("DND on"));
	printf("<URL>http://%s%s?mac=%s&action=dndon</URL>", $_SERVER['HTTP_HOST'], $_SERVER['PHP_SELF'],$mac);
	printf("</MenuItem>");

	printf("<MenuItem>");
	printf("<Name>%s</Name>", _("DND off"));
	printf("<URL>http://%s%s?mac=%s&action=dndoff</URL>", $_SERVER['HTTP_HOST'], $_SERVER['PHP_SELF'],$mac);
	printf("</MenuItem>");

	printf("<MenuItem>");
	printf("<Name>%s</Name>", _("Phonebook"));
	printf("<URL>http://%s/prov/snom/pb.php?mac=%s&action=menu</URL>", $_SERVER['HTTP_HOST'],$mac);
	printf("</MenuItem>");

	printf("<MenuItem>");
	printf("<Name>%s</Name>", _("Logout Phone"));
	printf("<URL>http://%s/prov/snom/logout.php?mac=%s</URL>", $_SERVER['HTTP_HOST'],$mac);
	printf("</MenuItem>");

	print("</SnomIPPhoneMenu>");
}

function ps_switch($mode,$exten,$ext) {
    global $ip;
    $extstate = get_extstate($exten);

    switch ($mode[0]) {
        case '0':
	    $ret = presence_switch($ip,'off',$ext);
	break;
        case '1':
	    $ret = presence_switch($ip,'on',$ext);
	break;
        case '2':
	    $ret = presence_switch($ip,'dndoff',$ext);
	break;
        case '3':
	        $ret = presence_switch($ip,'dndon',$ext);
	break;
        case '?':
	    if ($extstate[$exten]['devstate'] == 'offline') {
		$ret = presence_switch($ip,'on',$ext);
		$title = _("Online");
	    } else  {
		$ret = presence_switch($ip,'off',$ext);
		$title = _("Offline");
	    }
	break;
    }

    switch($mode[0]) {
	case '0':
	    $title = _("Offline");
	break;
	case '1':
	    $title = _("Online");
	break;
	case '2':
	    $title = _("DND off");
	break;
	case '3':
	    $title = _("DND on");
	break;
    }

//    ps_switch($mode[0],$exten);
    $output = "<SnomIPPhoneText>\n";
    $output .= "<Title>". _("Presence Switch")."</Title>\n";
    $output .= "<Prompt>Prompt Text</Prompt>\n";
    $output .= "<Text>".$title."</Text>\n";
    $output .= "</SnomIPPhoneText>\n";
    header("Content-Length: ".strlen($output));
    echo $output;
}

if(preg_match("/300|320|360|370|720|760|820|870|m3|m9|snom/",$model)) {

//error_log("$exten--$ext--$model--".$_REQUEST['action'],3,"error.log");
    if($_REQUEST['action']) {
	header("Content-Type: text/xml");
        print('<?xml version="1.0" encoding="UTF-8"?>');

	switch ($_REQUEST['action']) {
		case "menu":
			snom_menu($mac);
			die();
		break;
		case "offline":
			ps_switch('0',$exten,$ext);
			die();
		break;
	        case "online":
			ps_switch('1',$exten,$ext);
			die();
	        break;
		case "dndoff":
			ps_switch('2',$exten,$ext);
			die();
		break;
		case "dndon":
			ps_switch('3',$exten,$ext);
			die();
		break;
		case "ps":
			ps_switch('?',$exten,$ext);
			die();
		break;
	}
    }
}
?>
