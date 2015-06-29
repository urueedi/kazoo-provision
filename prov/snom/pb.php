<?php

//
// Copyright (C) 2009-2065 FreePBX-Swiss Urs Rueedi
//

require_once('../../modules/phoneprovision/functions.inc.php');
require_once('include/config.inc.php');
require_once('include/backend.inc.php');
require_once('../../functions.inc.php');
require_once('../../common/php-asmanager.php');

// get settings
$amp_conf       = parse_amportal_conf("/etc/amportal.conf");
$asterisk_conf  = parse_asterisk_conf(rtrim($amp_conf["ASTETCDIR"],"/")."/asterisk.conf");
$astman         = new AGI_AsteriskManager();
if (! $res = $astman->connect("127.0.0.1", $amp_conf["AMPMGRUSER"] , $amp_conf["AMPMGRPASS"])) {
    unset( $astman );
}

// get MAC address and type of phone
$value = snom_decode_HTTP_header();
$ip = $value[3];

// adding portnumer
if($ip) {
    if(!preg_match("#:#",$ip))
        $ip = $ip.":80";
}

$provdata = get_prov_data();
foreach($provdata as $key => $value) {
  if ($value['ip'] == $ip)
    $exten = $key;
}
	      
if (! isset($exten))
    exit;

// Change to Userlanguage
$sip_array = change_language($exten);
		
function snom_menu() {

	print("<SnomIPPhoneMenu>");
	printf("<Title>%s</Title>", _("Phonebook Switch"));

	// Privat Phonebook
	printf("<MenuItem>");
	printf("<Name>%s</Name>", _("Privat Phonebook"));
	printf("<URL>http://%s%s?action=privat</URL>", $_SERVER['HTTP_HOST'], $_SERVER['PHP_SELF']);
	printf("</MenuItem>");

	// Global Phonebook
	printf("<MenuItem>");
	printf("<Name>%s</Name>", _("Global Phonebook"));
	printf("<URL>http://%s%s?action=global</URL>", $_SERVER['HTTP_HOST'], $_SERVER['PHP_SELF']);
	printf("</MenuItem>");

	// Company/Internal Directory
	printf("<MenuItem>");
	printf("<Name>%s</Name>", _("Internal Phonebook"));
	printf("<URL>http://%s%s?action=internal</URL>", $_SERVER['HTTP_HOST'], $_SERVER['PHP_SELF']);
	printf("</MenuItem>");

	print("</SnomIPPhoneMenu>");
}

function snom_phonebook($search,$exten,$title) {
	print("<SnomIPPhoneDirectory>");
	print("\t<Title>$title</Title>");

	$numbers = phonebook_look($search,$exten);

	// Phonebook
	if (is_array($numbers)) {
		foreach ($numbers as $number => $values) {
		    $values['name'] = ereg_replace(" & ", "&", $values['name']);
		    $values['name'] = ereg_replace("&", " &amp; ", $values['name']);
//		    $values['name'] = ereg_replace(" & ", "&amp;", $values['name']);
		    if($values['name'] == '')
			continue;

		    printf("\t<DirectoryEntry>");
		    printf("\t<Name>%s</Name>", $values['name']);
		    printf("\t<Telephone>%s</Telephone>", $number);
		    printf("\t<Email>%s</Email>", $values['email']);
		    printf("\t</DirectoryEntry>");
		}
	}

	print("\t</SnomIPPhoneDirectory>");
}

function snom_internal($exten,$extension) {
	print("<SnomIPPhoneDirectory>");
	printf("<Title>%s</Title>", _("Internal Phonebook"));

	$numbers = phonebook_look('AMPUSER',$exten);
	$numbers["Meetme-".$extension][name] = _("private conference");
	$numbers["Meetme-".$extension][email] = $numbers[$extension]['email'];
	$numbers["Meetme-".$extension][outcid] = $numbers[$extension]['outcid'];


	// Phonebook
	if (is_array($numbers)) {
		foreach ($numbers as $number => $values) {
		    if($values['name'] == '')
			continue;
		    printf("\t<DirectoryEntry>");
		    printf("\t<Name>%s</Name>", $values['name']);
		    printf("\t<Telephone>%s</Telephone>", $number);
		    printf("\t<Email>%s</Email>", $values['email']);
		    printf("\t<Outcid>%s</Outcid>", $values['outcid']);
		    printf("\t</DirectoryEntry>");
		}
	}

	print("\t</SnomIPPhoneDirectory>");

}

	header("Content-Type: text/xml");
	print('<?xml version="1.0" encoding="UTF-8"?>');

	switch ($_REQUEST['action']) {
		case "menu":
			snom_menu();
			die();
		break;
		case "global":
			snom_phonebook('cidname',$exten,_("Global Phonebook"));
			die();
		break;
		case "privat":
			snom_phonebook('pb',$exten,_("Privat Phonebook"));
			die();
		break;
	        case "internal":
			snom_internal('AMPUSER',$exten);
			die();
	        break;
	}
?>