<?php

//
// Copyright 2009 (C) FreePBX-Swiss Urs Rueedi
//

require_once('../../modules/phoneprovision/functions.inc.php');
require_once('include/config.inc.php');
require_once('include/backend.inc.php');
require_once('../../functions.inc.php');
require_once('../../common/php-asmanager.php');

// global variables
$ASTERISK_LOCATION = "/etc/asterisk/";
$amp_conf       = parse_amportal_conf("/etc/amportal.conf");
$asterisk_conf  = parse_asterisk_conf(rtrim($amp_conf["ASTETCDIR"],"/")."/asterisk.conf");
$astman         = new AGI_AsteriskManager();

if (! $res = $astman->connect("127.0.0.1", $amp_conf["AMPMGRUSER"] , $amp_conf["AMPMGRPASS"])) {
    unset( $astman );
}

// Location of asterisk config files
$ASTERISK_LOCATION = "/etc/asterisk/";

// Global Variables
$Server = "http://".$amp_conf["AMPPROVSERVER"].$_SERVER['SCRIPT_NAME'];

// Init number of records
$index = 0;
$directory = array();
// Get header info
$header=Aastra_decode_HTTP_header();
$user = get_userdata($header[1]);
$extension = get_provision_state($header[1]);

// only registered connections allowed (macfile is there) 
if (! is_file($amp_conf["AMPWEBROOT"]."/modules/phoneprovision/aastra/".$header[1].".cfg"))
    exit;

$filename = ("pb-".$header[1].".cnt");
$mode = @file($filename);
if($mode[0]=='')
    $mode[0] = '0';

switch ($mode[0]) {
    case '1':
	$title = 'Privat';
	$numbers = phonebook_look('pb',$extension);
        if (is_array($numbers)) {
	    foreach ($numbers as $number => $values) {
                if($values['name'] == '')
                    continue;
		$directory[] = "<Prompt><![CDATA[".$values['name']."]]></Prompt>\n"."<URI>Dial:".$number."</URI>\n"."<Selection>".$number."</Selection>\n"."<Dial>".$number."</Dial>\n";
		$index++;
	    }
	}
    break;
    case '2':
	$title = 'Global';
	$numbers = phonebook_look('cidname',$extension);
        if (is_array($numbers)) {
	    foreach ($numbers as $number => $values) {
                if($values['name'] == '')
                    continue;
		$directory[] = "<Prompt><![CDATA[".$values['name']."]]></Prompt>\n"."<URI>Dial:".$number."</URI>\n"."<Selection>".$number."</Selection>\n"."<Dial>".$number."</Dial>\n";
		$index++;
	    }
	}
    break;
    default:
	$title = 'Internal';
	$users = get_allUsers('');
	foreach($users as $key => $value) {
	    if($key != '' && $key != 'dialstr' && $key != $user)
		{
		$directory[] = "<Prompt>".$users[$key]['cidname']."</Prompt>\n"."<URI>Dial:".$key."</URI>\n"."<Selection>".$key."</Selection>\n"."<Dial>".$key."</Dial>\n";
		$index++;
		}
	}
	$directory[] = "<Prompt><![CDATA[". _("private conference") ."]]></Prompt>\n"."<URI>Dial:Meetme-".$extension."</URI>\n"."<Selection>Meetme-".$extension."</Selection>\n"."<Dial>Meetme-".$extension."</Dial>\n";
}

if($mode[0] == '2')
    $mode[0]= '0';
else
    $mode[0] ++;

$fp = fopen($filename , "w");
fputs($fp , "$mode[0]");
fclose($fp);

// Sort Directory
sort($directory);

switch($header[0])
	{
	case 'Aastra51i':
	case 'Aastra53i':
		$MaxLines=28;
		break;
	default:
		$MaxLines=30;
		break;
	}

// Retrieve last page
$last=intval($index/$MaxLines);
if(($index-$last*$MaxLines) != 0) $last++;

// Retrieve current page
$page=$_GET['page'];
if (empty($page)) $page=1;

// Display Page
$output ="<AastraIPPhoneTextMenu destroyOnExit=\"yes\">";
$output .= "<Title>". _("$title") ." ($page/$last)</Title>\n";
$index=1;
foreach ($directory as $v) 
	{
	if(($index>=(($page-1)*$MaxLines+1)) and ($index<=$page*$MaxLines))
		{
  		$output .= "<MenuItem>\n";
  		$output .= $v;
  		$output .= "</MenuItem>\n";	
		}
	$index++;
	}

// Depending on the phone
switch($header[0])
	{
	case 'Aastra51i':
	case 'Aastra6751i':
	case 'Aastra53i':
	case 'Aastra6753i':
	case 'Aastra6730i':
	case 'Aastra6731i':
		// Previous button as a menu
		if($page!=1)
			{
			$previous=$page-1;
	  		$output .= "<MenuItem>\n";
  			$output .= "<Prompt>". _("Previous")."</Prompt>\n"."<URI>".$Server."?page=".$previous."</URI>\n";
  			$output .= "</MenuItem>\n";	
			}
		// Next button as a menu
		if($page!=$last)
			{
			$next=$page+1;
	  		$output .= "<MenuItem>\n";
 			$output .= "<Prompt>". _("Next")."</Prompt>\n";
 			$output .= "<URI>".$Server."?page=".$next."</URI>\n";
 			$output .= "</MenuItem>\n";	
			}
		break;
	default:
		// Dial button
		$output .= "<SoftKey index=\"1\">\n";
		$output .= "<Label>". _("Dial")."</Label>\n";
		$output .= "<URI>SoftKey:Select</URI>\n";
		$output .= "</SoftKey>\n";

		// Next button
		if($page!=$last)
			{
			$next=$page+1;
			$output .= "<SoftKey index=\"5\">\n";
			$output .= "<Label>". _("Next")."</Label>\n";
			$output .= "<URI>$Server?page=$next</URI>\n";
			$output .= "</SoftKey>\n";
			}

		// Previous button
		if($page!=1)
			{
			$previous=$page-1;
			$output .= "<SoftKey index=\"2\">\n";
			$output .= "<Label>". _("Previous")."</Label>\n";
			$output .= "<URI>$Server?page=$previous</URI>\n";
			$output .= "</SoftKey>\n";
			}

		// Exit Button
		$output .= "<SoftKey index=\"6\">\n";
		$output .= "<Label>". _("Exit")."</Label>\n";
		$output .= "<URI>SoftKey:Exit</URI>\n";
		$output .= "</SoftKey>\n";
		break;
	}

// End of the object
$output .= "</AastraIPPhoneTextMenu>\n";

// HTTP header and output
header("Content-Type: text/xml");
header("Content-Length: ".strlen($output));
echo $output;
?>
