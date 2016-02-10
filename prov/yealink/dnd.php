<?php

//
// Copyright (C) 2009 FreePBX-Swiss Urs Rueedi
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

function Aastra_manage_dnd($extension,$action) {
    global $amp_conf;
    global $astman;

    if ($astman) {
    // DND GET

	$dnd = $astman->database_get("DND",$extension);
	if ($dnd != '1')
	    $dnd = '0';

	// Change current value
	if($action == 'change') {
	    // change DND status
	    if($dnd == '0') 
		{
		$astman->database_put('DND',$extension,'1');
		$channel = "Local/$extension@fopon-DND";
		$exten = "26*0";
		$dnd=1;
		}
	    else 
		{
		$astman->database_del('DND',$extension);
		$channel = "Local/$extension@fopoff-DND";
		$exten = "26**0";
		$dnd=0;
		}
	    $application = "hangup";
	    $callerid = $extension;
	    $astman->Originate($channel, $exten, NULL, NULL, NULL,  $callerid, NULL, NULL, $application, NULL);
	}
	return($dnd);
    }
}

// Global parameters
$Server = "http://".$amp_conf["AMPPROVSERVER"].$_SERVER['SCRIPT_NAME'];
$dnd=0;

// Retrieve parameters
$action=$_GET['action'];
$status=$_GET['status'];
$key=$_GET['key'];

// Force default action
if($action=="") $action="change";

// Get header info
$header=Aastra_decode_HTTP_header();

if (! is_file($amp_conf["AMPWEBROOT"]."/modules/phoneprovision/aastra/".$header[1].".cfg"))
    exit;

$user = get_userdata($header[1]);

// Setup header type
header("Content-Type: text/xml");

// Depending on action
switch($action)
	{
	case 'display':
		$output = "<AastraIPPhoneFormattedTextScreen destroyOnExit=\"yes\" Timeout=\"2\">\n";
		$output .= "<Line/>\n";
		$output .= "<Line/>\n";
		if ($status==1) $output .= "<Line Size=\"double\" Align=\"center\">". _("DND activated")."</Line>\n";
		else $output .= "<Line Size=\"double\" Align=\"center\">". _("DND deactivated")."</Line>\n";
		$output .= "<SoftKey index=\"6\">\n";
		$output .= "<Label> </Label>\n";
		$output .= "<URI>SoftKey:Exit</URI>\n";
		$output .= "</SoftKey>\n";
		$output .= "</AastraIPPhoneFormattedTextScreen>\n";
		break;

	case 'msg':
		$output = "<AastraIPPhoneStatus>\n";
		$output .= "<Session>CFDND</Session>\n";
		if ($status==1) $output .= "<Message index=\"0\">". _("DND activated")."</Message>\n";
		else $output .= "<Message index=\"0\"></Message>\n";
		$output .= "</AastraIPPhoneStatus>\n";
		break;

	case 'change':
	case 'check':
		$dnd=Aastra_manage_dnd($user,$action);
		$output = "<AastraIPPhoneExecute>\n";
		$output .= "<ExecuteItem URI=\"".$Server."?action=msg&amp;status=".$dnd."\"/>\n";
		if($key!='')
			{
			if ($dnd==1) $output .= "<ExecuteItem URI=\"Led: topsoftkey".$key."=on\"/>\n";
			else $output .= "<ExecuteItem URI=\"Led: topsoftkey".$key."=off\"/>\n";
			}
		switch($header[0])
			{
			case "Aastra51i":
			case "Aastra53i":
				break;
			default:
				if($action=='change') $output .= "<ExecuteItem URI=\"".$Server."?action=display&amp;status=".$dnd."\"/>\n";
				break;
			}
		$output .= "</AastraIPPhoneExecute>\n";
		break;
	}	

// Display XML object
header("Content-Length: ".strlen($output));
echo $output;
?>
