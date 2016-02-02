<?php

//
// Copyright (C) 2009 FreePBX-Swiss Urs Rueedi
//

require_once('../../modules/phoneprovision/functions.inc.php');
require_once('include/config.inc.php');
require_once('include/backend.inc.php');
require_once('../../functions.inc.php');
require_once('../../common/php-asmanager.php');

$ASTERISK_LOCATION = "/etc/asterisk/";
$amp_conf       = parse_amportal_conf("/etc/amportal.conf");
$asterisk_conf  = parse_asterisk_conf(rtrim($amp_conf["ASTETCDIR"],"/")."/asterisk.conf");
$astman         = new AGI_AsteriskManager();

if (! $res = $astman->connect("127.0.0.1", $amp_conf["AMPMGRUSER"] , $amp_conf["AMPMGRPASS"])) {
    unset( $astman );
}

function Aastra_manage_cf($user,$action,$value) {
    // Connect to AGI
    $cf="";
    global $astman;

    // Depending on action
    switch($action)
	{
	// No more CFWD
	case 'cancel':
		$res = $astman->database_del("CF",$user);
	        $channel = "Local/$user@fopoff-CF";
    		$exten = "21**";
		break;

	// Set new CFWD
	case 'set':
	    if ($value != $user) {
		$res = $astman->database_put("CF",$user,$value);
		$cf=$value;
    		$channel = "Local/$user@fopon-CF";
    		$exten=$cf;
	    }
	    else
		$action = 'fail';
		break;

	// Default, Get current status
	default:
		$cf = $astman->database_get("CF",$user);
		break;
	}

    switch($action) {
	case 'cancel':
        case 'set':
    	    $application = "hangup";
	    $callerid = $user;
    	    $astman->Originate($channel, $exten, NULL, NULL, NULL,  $callerid, NULL, NULL, $application, NULL);
	break;
    }
    // Return current cfwd
    return($cf);
}

// Global parameters
$Server = "http://".$amp_conf["AMPPROVSERVER"].$_SERVER['SCRIPT_NAME'];
// Retrieve parameters
$user=$_GET['user'];
$action=$_GET['action'];
$value=$_GET['value'];
$key=$_GET['key'];

// Get header info
$header=Aastra_decode_HTTP_header();

if (! is_file($amp_conf["AMPWEBROOT"]."/modules/phoneprovision/aastra/".$header[1].".cfg"))
    exit;

$user = get_userdata($header[1]);

// Depending on action
switch($action)
	{
	case 'cancel':
	case 'set':
	case 'check':
		$cf=Aastra_manage_cf($user,$action,$value);
		$output = "<AastraIPPhoneExecute triggerDestroyOnExit=\"yes\">\n";
		$output .= "<ExecuteItem URI=\"".$Server."?action=msg&amp;user=".$user."\"/>\n";
		if($key!='')
			{
			if($cf=='') $output .= "<ExecuteItem URI=\"Led: topsoftkey".$key."=off\"/>\n";
			else $output .= "<ExecuteItem URI=\"Led: topsoftkey".$key."=on\"/>\n";
			}
		if($action!='check')
			{
			switch($header[0])
				{
				case "Aastra51i":
				case "Aastra53i":
					break;
				default:
					$output .= "<ExecuteItem URI=\"".$Server."?user=".$user."&amp;key=".$key."\"/>\n";
					break;
				}
			}
		$output .= "</AastraIPPhoneExecute>\n";
		break;

	case 'change':
		$cf=Aastra_manage_cf($user,$action,$value);
		$output = "<AastraIPPhoneInputScreen type=\"number\" destroyOnExit=\"yes\">\n";
		$output .= "<Title>". _("Call Forward")."</Title>\n";
		$output .= "<Prompt>". _("Enter destination")."</Prompt>\n";
		$output .= "<URL>".$Server."?user=$user&amp;action=set&amp;key=$key</URL>\n";
		$output .= "<Parameter>value</Parameter>\n";
		$output .= "<Default>$cf</Default>\n";
		$output .= "</AastraIPPhoneInputScreen>\n";
		break;

	case 'msg':
		$cf=Aastra_manage_cf($user,$action,$value);
		$output = "<AastraIPPhoneStatus>\n";
		$output .= "<Session>CFDND</Session>\n";
		if ($cf=="") $output .= "<Message index=\"1\"></Message>\n";
		else $output .= "<Message index=\"1\">". _("CFWD activated")."</Message>\n";
		$output .= "</AastraIPPhoneStatus>\n";
		break;

	default:
	    if (!isset($user) || $action == 'fail') {
		$output = "<AastraIPPhoneTextMenu destroyOnExit=\"yes\">\n";
		$output .= "<Title>". _("Service fail")."</Title>\n";
		$output .= "</AastraIPPhoneTextMenu>\n";
	    }
	    else {
		$cf=Aastra_manage_cf($user,$action,$value);
		switch($header[0])
			{
			case "Aastra51i":
			case "Aastra53i":
			case "Aastra6751i":
			case "Aastra6753i":
			case "Aastra6730i":
			case "Aastra6731i":
				$output = "<AastraIPPhoneTextMenu destroyOnExit=\"yes\">\n";
				if($cf=="") $output .= "<Title>". _("CFWD deactivated")."</Title>\n";
				else $output .= "<Title>". _("CFWD set")." (".$cf.")</Title>\n";
				if($cf!="")
					{
					$output .= "<MenuItem>\n";
					$output .= "<Prompt>". _("Cancel")."</Prompt>\n";
			  		$output .= "<URI>$Server/cfwd.php?action=cancel&amp;user=$user&amp;key=$key</URI>\n";
	  				$output .= "</MenuItem>\n";	
					}
				$output .= "<MenuItem>\n";
				$output .= "<Prompt>". _("Change")."</Prompt>\n";
	  			$output .= "<URI>$Server/cfwd.php?action=change&amp;user=$user&amp;key=$key</URI>\n";
  				$output .= "</MenuItem>\n";	
				$output .= "</AastraIPPhoneTextMenu>\n";
				break;

			default:
				$output = "<AastraIPPhoneTextScreen destroyOnExit=\"yes\">\n";
				$output .= "<Title>". _("Call Forward for")." $user</Title>\n";
				if ($cf=="") $output .= "<Text>". _("Call Forward is currently deactivated.")."</Text>\n";
				else $output .= "<Text>". _("Call Forward is currently set to")." $cf.</Text>\n";
				$output .= "<SoftKey index=\"1\">\n";
				$output .= "<Label>". _("Change")."</Label>\n";
				$output .= "<URI>$Server/cfwd.php?action=change&amp;user=$user&amp;key=$key</URI>\n";
				$output .= "</SoftKey>\n";
				if($cf!="")
					{
					$output .= "<SoftKey index=\"2\">\n";
					$output .= "<Label>". _("Cancel")."</Label>\n";
					$output .= "<URI>$Server/cfwd.php?action=cancel&amp;user=$user&amp;key=$key</URI>\n";
					$output .= "</SoftKey>\n";
					}
				$output .= "<SoftKey index=\"6\">\n";
				$output .= "<Label>". _("Done")."</Label>\n";
				$output .= "<URI>SoftKey:Exit</URI>\n";
				$output .= "</SoftKey>\n";
				$output .= "</AastraIPPhoneTextScreen>\n";
				break;
			}
		break;
		}
	}

//error_log($user."/$cf/".$header[0]."|".$header[1]."|".$header[2]."|".$header[3]."\n",3,"./error.log");
// Display XML object
header("Content-Type: text/xml");
header("Content-Length: ".strlen($output));
echo $output;
exit;
?>
