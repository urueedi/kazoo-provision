<?php

//
// Copyright (C) 2009 FreePBX-Swiss Urs Rueedi
//

function output($put) {
    // Set content type
    header("Content-Type: text/xml");
    header("Content-Length: ".strlen($put));
    echo $put;
}

$debug = false;

require_once('include/config.inc.php');
require_once('include/backend.inc.php');
require_once('../../functions.inc.php');
require_once('../../common/php-asmanager.php');
require_once('../../modules/phoneprovision/functions.inc.php');
$amp_conf = parse_amportal_conf("/etc/amportal.conf");

//print_r(change_language('2'));
//exit;
// get settings
$ASTERISK_LOCATION = "/etc/asterisk/";
$amp_conf       = parse_amportal_conf("/etc/amportal.conf");
$asterisk_conf  = parse_asterisk_conf(rtrim($amp_conf["ASTETCDIR"],"/")."/asterisk.conf");
$astman         = new AGI_AsteriskManager();
$prov_mode      = $amp_conf["AMPPROVMODE"];

if (! $res = $astman->connect("127.0.0.1", $amp_conf["AMPMGRUSER"] , $amp_conf["AMPMGRPASS"])) {
    unset( $astman );
}               

require_once('../../common/db_connect.php');
require_once('../../modules/core/functions.inc.php');
                
if(file_exists('../../modules/voicemail/functions.inc.php'))
    require_once('../../modules/voicemail/functions.inc.php');

$XML_SERVER = "http://".$amp_conf["AMPPROVSERVER"].$_SERVER['SCRIPT_NAME'];
$AA_PROXY_SERVER = $amp_conf["AMPPROVSERVER"];
$AA_WEB_SERVER = $amp_conf["AMPPROVSERVER"];
$AA_REGISTRAR_SERVER = $amp_conf["AMPPROVSERVER"];
$ASTERISK_LOCATION = "/etc/asterisk/";

// Retrieve parameters
$extension=$_GET["extension"];
$password=$_GET["password"];
$action=$_GET["action"];
$step=$_GET["step"];
$did=$_GET["did"];
$mobilecid=$_GET["mobilecid"];
$name=umlaut($_GET["name"]);

// get MAC address and type of phone
$value=Yealink_decode_HTTP_header();
$model = $value[0];
$mac = $value[1];
$ip = $value[3];

if($model == "Yealink51i") $model = "Yealink6751i";
if($model == "Yealink53i") $model = "Yealink6753i";
if($model == "Yealink55i") $model = "Yealink6755i";
if($model == "Yealink57i") $model = "Yealink6757i";
if($model == "Yealink39i") $model = "Yealink6739i";

if(! $extension)
    $extension = get_provision_state($mac);

$phone = check_config_file($mac);

if($extension)
    $userdata = get_userdata_from_sip($extension);

if($debug) error_log($_SERVER['SCRIPT_NAME']." INFO-1: mac=".$mac." ext=".$extension." ext=".$username." name=$name pass=$password model=".$phone['model']." type=".$phone['type']." lang=".$language." ip=".$ip." did=".$did." mobilecid=".$mobilecid."\n", 3, "/tmp/yealink_startup.log");

if($prov_mode == 'none') {
change_language($extension); 
$output = "<YealinkIPPhoneTextScreen LockIn=\"no\" destroyOnExit=\"yes\">\n";
$output .= "<Title>". _("Error Mode")."</Title>\n";

if($_SERVER['SCRIPT_NAME']=="/".$amp_conf['AMPPROVWEBPATH']."/yealink/logout.php")
    $output .= "<Text>". _("Logout disallow").": $prov_mode</Text>\n";
elseif($_SERVER['SCRIPT_NAME']=="/".$amp_conf['AMPPROVWEBPATH']."/yealink/startup.php")
    $output .= "<Text>". _("Login disallow").": $prov_mode</Text>\n";
$output .= "</YealinkIPPhoneTextScreen>\n";

output($output);
exit;
}

// Reset Local
if($action=="reset")
	{
	$output = "<YealinkIPPhoneExecute>\n";
	$output .= "<ExecuteItem URI=\"Command: local\"/>\n";
	$output .= "<ExecuteItem URI=\"Command: Reset\"/>\n";
	$output .= "</YealinkIPPhoneExecute>\n";
	output($output);
	exit;
	}

// Reset factory
if($action=="factory")
	{
	$output = "<YealinkIPPhoneExecute>\n";
	$output .= "<ExecuteItem URI=\"Command: factroy\"/>\n";
	$output .= "<ExecuteItem URI=\"Command: Reset\"/>\n";
	$output .= "</YealinkIPPhoneExecute>\n";
	output($output);
	exit;
	}

// Reboot
if($action=="reboot")
	{
	$output = "<YealinkIPPhoneExecute>\n";
	$output .= "<ExecuteItem URI=\"Command: reset\"/>\n";
	$output .= "<ExecuteItem URI=\"Command: Reset\"/>\n";
	$output .= "</YealinkIPPhoneExecute>\n";
	output($output);
	exit;
	}

if (($_SERVER['SCRIPT_NAME']=="/".$amp_conf['AMPPROVWEBPATH']."/yealink/logout.php") && is_file($amp_conf['AMPWEBROOT']."/modules/phoneprovision/yealink/".$mac.".cfg"))
    {
		// Input Password
		if ($password=='')
			{
			$output = "<YealinkIPPhoneInputScreen type=\"number\" password=\"yes\" LockIn=\"no\" destroyOnExit=\"yes\">\n";
			$output .= "<Title>". _("Logout") ."</Title>\n";
			$output .= "<Prompt>". _("Logout Password")."</Prompt>\n";
			$output .= "<URL>".$XML_SERVER."?extension=$extension</URL>\n";
			$output .= "<Parameter>password</Parameter>\n";
			$output .= "<Default></Default>\n";
			$output .= "</YealinkIPPhoneInputScreen>\n";
			}
		else
			{
			// IF authentication fails
			$vmdata = get_vm_Users('');
			$vm_password = $vmdata[$extension]['vm_password'];
			if ($userdata[1] != $password && $vm_password != $password)
				{
if($debug) error_log($_SERVER['SCRIPT_NAME']." LOGOUT-1: ".$msg['err_small']." pass=$password mac=$mac ext=$extension ip=$ip \n", 3, "/tmp/yealink_startup.log");
		            if ($password == "999") {
	    		        // Reboot needed
				$output = "<YealinkIPPhoneTextScreen LockIn=\"no\" destroyOnExit=\"yes\">\n";
			        $output .= "<Title>". _("Reboot")."</Title>\n";
				$output .= "<Text>". _("Reboot now")." $extension</Text>\n";
			        $output .= "</YealinkIPPhoneTextScreen>\n";
				header("Refresh: 3; url=".$XML_SERVER."?action=factory");
			        delete_mac($mac,'yealink');
			        sleep(1);
			        output($output);
			        pbx_manage('logout',$extension);
			        output($output);
			        yealink_error_check(phone_reboot($ip,$mac));
if($debug) error_log($_SERVER['SCRIPT_NAME']." LOGOUT-2: '999' ext=$extension ip=$ip\n",3,"/tmp/yealink_startup.log");
			        exit;
			    }
			    // Display error
			    $output = "<YealinkIPPhoneTextScreen LockIn=\"no\" destroyOnExit=\"yes\">\n";
			    $output .= "<Title>". _("Auth. faild")."</Title>\n";
			    $output .= "<Text>". _("Wrong credentials")."</Text>\n";
			    $output .= "</YealinkIPPhoneTextScreen>\n";
				}
			else
				{
				// Update config file
				$output = "<YealinkIPPhoneTextScreen destroyOnExit=\"yes\">\n";
				$output .= "<Title>". _("Logged out")."</Title>\n";
				$output .= "<Text>". _("Reboot")."</Text>\n";
				$output .= "</YealinkIPPhoneTextScreen>\n";
				header("Refresh: 3; url=".$XML_SERVER."?action=reboot");
    				yealink_error_check(delete_update_config_file_mac($mac));
			        sleep(2);
				// Logout phone and reboot
				pbx_manage('logout',$extension);
				output($output);
				yealink_error_check(phone_logout($ip));
if($debug) error_log($_SERVER['SCRIPT_NAME']." LOGOUT-2: ".$msg[err_small]." mac=".$mac." ext=".$extension." ext=".$username." name=$name pass=".$sip_array[$extension]['secret']." callerid=".$callerid_name." model=".$phone['model']." type=".$phone['type']." lang=".$language." ip=".$ip." did=".$did." mobilecid=".$mobilecid."\n", 3, "/tmp/yealink_startup.log");
				exit;
				}
			}
output($output);
exit;
}

// Input Extension
if($prov_mode == 'new') {
    if ($extension=="")
	{
	$output = "<YealinkIPPhoneInputScreen type=\"number\" password=\"no\" LockIn=\"no\" destroyOnExit=\"yes\">\n";
        $output .= "<Title>". _("Install startup") ."</Title>\n";
	$output .= "<Prompt>". _("New Number")."</Prompt>\n";
	$output .= "<URL>".$XML_SERVER."</URL>\n";
	$output .= "<Parameter>extension</Parameter>\n";
	$output .= "<Default></Default>\n";
	$output .= "</YealinkIPPhoneInputScreen>\n";
	output($output);
	exit;
    } else {
	$sip_array = change_language($extension);
	if ($sip_array[$extension] == NULL)
	    {
	    if($mobilecid == "")
		{
		$output = "<YealinkIPPhoneInputScreen type=\"number\" LockIn=\"no\" destroyOnExit=\"yes\">\n";
	        $output .= "<Title>". _("Install startup")."</Title>\n";
		$output .= "<Prompt>". _("Mobile Number")."</Prompt>\n";
	        $output .= "<URL>$XML_SERVER?extension=$extension</URL>\n";
		$output .= "<Parameter>mobilecid</Parameter>\n";
	        $output .= "<Default></Default>\n";
		$output .= "</YealinkIPPhoneInputScreen>\n";
		output($output);
	        exit;
		}
	    if($did == "")
		{
		$output = "<YealinkIPPhoneInputScreen type=\"number\" LockIn=\"no\" destroyOnExit=\"yes\">\n";
	        $output .= "<Title>". _("Install startup")."</Title>\n";
		$output .= "<Prompt>". _("DID Number")."</Prompt>\n";
	        $output .= "<URL>$XML_SERVER?extension=$extension&amp;mobilecid=$mobilecid</URL>\n";
		$output .= "<Parameter>did</Parameter>\n";
	        $output .= "<Default></Default>\n";
		$output .= "</YealinkIPPhoneInputScreen>\n";
		output($output);
	        exit;
		}
	    if($name == "")
		{
		$output = "<YealinkIPPhoneInputScreen type=\"string\" LockIn=\"no\" destroyOnExit=\"yes\">\n";
	        $output .= "<Title>". _("Install startup")."</Title>\n";
		$output .= "<Prompt>". _("Name")."</Prompt>\n";
	        $output .= "<URL>$XML_SERVER?extension=$extension&amp;mobilecid=$mobilecid&amp;did=$did</URL>\n";
		$output .= "<Parameter>name</Parameter>\n";
	        $output .= "<Default></Default>\n";
		$output .= "</YealinkIPPhoneInputScreen>\n";
		output($output);
	        exit;
		}
	    if($password == "")
		{
    		$output = "<YealinkIPPhoneInputScreen type=\"number\" password=\"yes\" LockIn=\"no\" destroyOnExit=\"yes\">\n";
	        $output .= "<Title>". _("Install startup")."</Title>\n";
		$output .= "<Prompt>". _("Password")."</Prompt>\n";
	        $output .= "<URL>$XML_SERVER?extension=$extension&amp;mobilecid=$mobilecid&amp;did=$did&amp;name=$name</URL>\n";
		$output .= "<Parameter>password</Parameter>\n";
	        $output .= "<Default></Default>\n";
		$output .= "</YealinkIPPhoneInputScreen>\n";
		output($output);
	        exit;
		}
	    if($did=='0')
		$did="";

                $nsecret = generate_secret();
		$vars = array();
        	    $vars['tech'] = 'sip';
        	    $vars['extension'] = $extension;
        	    $vars['callerid'] = '<'.$extension.'>';
        	    $vars['outboundcid'] = $did;
        	    $vars['mobilecid'] = $mobilecid;
        	    $vars['directdid'] = $did;
            	    $vars['mailbox'] = $extension;
		    $vars['privacyman'] = '0';
            	    $vars['name'] = isset($name)?$name:_("New extension");
            	    $vars['password'] = $password;
		    $vars['groupcid'] = _("Group");
		    $vars['voicebox_enable'] = '1';
		    $vars['vmanswer'] = '29';
		    $vars['vmmessage'] = 'u';
		    $vars['secret'] = $nsecret;
		    $vars['dtmfmode'] = 'rfc2833';
            	    $vars['insecure'] = 'no';
		    $vars['subscribecontext'] = 'from-internal';
		    $vars['canreinvite'] = 'no';
            	    $vars['context'] = 'from-internal';
        	    $vars['host'] = 'dynamic';
            	    $vars['type'] = 'friend';
            	    $vars['nat'] = 'yes';
            	    $vars['port'] = '5060';
            	    $vars['qualify'] = 'yes';
            	    $vars['disallow'] = 'all';
            	    $vars['allow'] = 'ulaw&alaw';
            	    $vars['language'] = '';
            	    $vars['devinfo_dial'] = 'SIP/'.$extension;
            	    $vars['device'] = $extension;
        	    $vars['accountcode'] = '';
        	    $vars['faxexten'] = 'disabled';
        	    $vars['devicetype'] = 'fixed';
        	    $vars['record_out'] = 'Adhoc';
        	    $vars['record_in'] = 'Adhoc';
            	    $vars['vmbox'] = $extension."@default";
            	    $vars['voicemail'] = "default";

		    $vars['sipfields'][] = array($extension,'account',$extension);
        	    $vars['sipfields'][] = array($extension,'accountcode','');
		    $vars['sipfields'][] = array($extension,'callerid','<'.$extension.'>');
		    $vars['sipfields'][] = array($extension,'secret',$nsecret);
		    $vars['sipfields'][] = array($extension,'dtmfmode','rfc2833');
            	    $vars['sipfields'][] = array($extension,'insecure','no');
		    $vars['sipfields'][] = array($extension,'subscribecontext','from-internal');
		    $vars['sipfields'][] = array($extension,'canreinvite','no');
            	    $vars['sipfields'][] = array($extension,'context','from-internal');
        	    $vars['sipfields'][] = array($extension,'host','dynamic');
            	    $vars['sipfields'][] = array($extension,'type','friend');
            	    $vars['sipfields'][] = array($extension,'nat','yes');
            	    $vars['sipfields'][] = array($extension,'port','5060');
            	    $vars['sipfields'][] = array($extension,'qualify','yes');
            	    $vars['sipfields'][] = array($extension,'disallow','all');
            	    $vars['sipfields'][] = array($extension,'allow','ulaw&alaw');
            	    $vars['sipfields'][] = array($extension,'language','');
            	    $vars['sipfields'][] = array($extension,'dial','SIP/'.$extension);
		    $vars['sipfields'][] = array($extension,'record_in','Adhoc');
	            $vars['sipfields'][] = array($extension,'record_out','Adhoc');
            	    $vars['sipfields'][] = array($extension,'mailbox',$extension.'@default');

            	    if($subrelease[1] >= 4) {
                	$vars['callgroup'] = '1';
            	        $vars['pickupgroup'] = '1';
            	        $vars['call-limit'] = '2';
			$vars['sipfields'][] = array($extension,'callgroup',"1");
		        $vars['sipfields'][] = array($extension,'pickupgroup',"1");
			$vars['sipfields'][] = array($extension,'call-limit',"2");
		    }

		    $vars['mboxarray']['extension'] = $extension;
		    $vars['mboxarray']['vmcontext'] = "default";
		    $vars['mboxarray']['options'] = "callback=from-internal|attach=yes|saycid=no|envelope=yes|delete=no";
		    $vars['mboxarray']['vmpwd'] = $password;
		    $vars['mboxarray']['name'] = $vars['name'];
		    $vars['mboxarray']['email'] = $vars['email'];
		    $vars['mboxarray']['pager'] = $vars['pager'];

		    $msg = core_autoprov_add($vars,'setup');
if($debug) error_log($_SERVER['SCRIPT_NAME']." New Ext-1: ".$msg[err_small]." mac=".$mac." ext=".$extension." ext=".$username." pass=".$sip_array[$extension]['secret']." callerid=".$callerid_name." model=".$phone['model']." type=".$phone['type']." lang=".$language." ip=".$ip." did=".$did." mobilecid=".$mobilecid."\n", 3, "/tmp/yealink_startup.log");
		    if (isset($msg))
	    	    {
	    	    // Display error
		    $output = "<YealinkIPPhoneTextScreen LockIn=\"yes\" destroyOnExit=\"yes\">\n";
		    $output .= "<Title>". _("Internal error")."</Title>\n";
		    $output .= "<Text>". $msg[err_small] ."</Text>\n";
		    $output .= "</YealinkIPPhoneTextScreen>\n";
		    output($output);
  		    exit;
	    	    }
	    }
    }
} else {
    if ($extension=="")
	{
	$output = "<YealinkIPPhoneInputScreen type=\"number\" password=\"no\" LockIn=\"no\" destroyOnExit=\"yes\">\n";
	$output .= "<Title>". _("Initial startup")."</Title>\n";
	$output .= "<Prompt>". _("Login Number")."</Prompt>\n";
	$output .= "<URL>$XML_SERVER</URL>\n";
	$output .= "<Parameter>extension</Parameter>\n";
	$output .= "<Default></Default>\n";
	$output .= "</YealinkIPPhoneInputScreen>\n";
	output($output);
	exit;
    }
}
// Collect data
$username = $extension;
$callerid = $data[0];
$callerid_name = $data[2]." <$extension>";

// Get all the user data
$sip_array = change_language($extension);

if($debug) error_log($_SERVER['SCRIPT_NAME']." INFO-2: mac=".$mac." ext=".$extension." ext=".$username." pass=".$sip_array[$extension]['secret']." callerid=".$callerid_name." model=".$phone['model']." type=".$phone['type']." lang=".$language." ip=".$ip." did=".$did." mobilecid=".$mobilecid."\n", 3, "/tmp/yealink_startup.log");
// If user not found
if ($sip_array[$extension]==NULL)
	{ 
	// Display error
	$output = "<YealinkIPPhoneTextScreen LockIn=\"yes\" destroyOnExit=\"yes\">\n";
	$output .= "<Title>". _("Internal error")."</Title>\n";
	$output .= "<Text>". _("Not provisioned")."</Text>\n";
	$output .= "</YealinkIPPhoneTextScreen>\n";
	output($output);
  	exit;
	}

// Input Password
if ($password=="")
	{
	$output = "<YealinkIPPhoneInputScreen type=\"number\" password=\"yes\" LockIn=\"yes\" destroyOnExit=\"yes\">\n";
	$output .= "<Title>". _("Login startup")."</Title>\n";
	$output .= "<Prompt>". _("Login Password")."</Prompt>\n";
	$output .= "<URL>$XML_SERVER?extension=$extension</URL>\n";
	$output .= "<Parameter>password</Parameter>\n";
	$output .= "<Default></Default>\n";
	$output .= "</YealinkIPPhoneInputScreen>\n";
	output($output);
	exit;
	}

$vmdata = get_vm_Users('');
// IF authentication faild
$vm_password = $vmdata[$extension]['vm_password'];
if ($sip_array[$extension]['secret'] != $password && $vm_password != $password)
	{
	// Display error
	$output = "<YealinkIPPhoneTextScreen LockIn=\"yes\" destroyOnExit=\"yes\">\n";
	$output .= "<Title>". _("Auth. faild")."</Title>\n";
	$output .= "<Text>". _("Wrong user or pass")."</Text>\n";
	$output .= "</YealinkIPPhoneTextScreen>\n";
	output($output);
  	exit;
	}

// IF already configured
$return = lookup_config_file($extension);
if($return != '0' && $prov_mode == 'logout')
	{
	// Display error
	$output = "<YealinkIPPhoneTextScreen LockIn=\"yes\" destroyOnExit=\"yes\">\n";
	$output .= "<Title>". _("Error")."</Title>\n";
	$output .= "<Text>". _("Extension in use")."</Text>\n";
	$output .= "</YealinkIPPhoneTextScreen>\n";
	output($output);
  	exit;
	}

if($return != '0' && ($prov_mode == 'push' || $prov_mode == 'new'))
{
    $msg = check_phone_status($extension);
    if ($msg['err_small']) 
    {
if($debug) error_log($_SERVER['SCRIPT_NAME']." STATUSCHECK-1: ".$msg['err_small']." return=$return mac=".$mac." ext=".$extension." \n", 3, "/tmp/yealink_startup.log");
	$output = "<YealinkIPPhoneTextScreen LockIn=\"yes\" destroyOnExit=\"yes\">\n";
	$output .= "<Title>". _("Error")."</Title>\n";
	$output .= "<Text>". $msg['err_small'] ."</Text>\n";
	$output .= "</YealinkIPPhoneTextScreen>\n";
	output($output);
  	exit;
    }
    else
    {	// Display others will Logout!
	$text = "Logout old extension";
if($debug) error_log($_SERVER['SCRIPT_NAME']." LOGOUT-OLD-1: ".$msg['err_small']." return=$return mac=".$mac." ext=".$extension." \n", 3, "/tmp/yealink_startup.log");
	yealink_error_check(phone_logout($return));
	yealink_error_check(delete_update_config_file($return));
	pbx_manage('logout',$return);
    }
}
else {
    $text = "logged in";
}

if($prov_mode == 'new') {
    if(!preg_match("#:#",$ip))
        $ip .= ":80";

if($debug) error_log($_SERVER['SCRIPT_NAME']." INFO-4: ".$msg['err_small']." mac=".$mac." ext=".$extension." mod=$model \n", 3, "/tmp/yealink_startup.log");

	if (! file_exists('../../modules/phoneprovision/yealink/'.$model.'.cfg'))
        {
	    $output = "<YealinkIPPhoneTextScreen LockIn=\"yes\" destroyOnExit=\"yes\">\n";
	    $output .= "<Title>". _("Error")."</Title>\n";
	    $output .= "<Text>". _("phonetype not found!") ."</Text>\n";
	    $output .= "</YealinkIPPhoneTextScreen>\n";
	    output($output);
	    exit;
	}

        $phone = array('ip'=> $ip,
                    	'file'=> $model,
			'mac'=> $mac,
			'provmode'=> 'login',
			'provdate'=> time(),
			'type' => preg_replace("/yealink/i","",$model),
			'expm' => $expm,
			'model' => 'Yealink',
			'connect' => 'http://'.$ip,
			);
	add_config_file($phone);
}

yealink_error_check(create_yealink_mac($mac,$extension,$username,$sip_array[$extension]['secret'],$callerid_name,$phone['model'].$phone['type'],$language,$ip));
if($debug) error_log($_SERVER['SCRIPT_NAME']." Create MAC.cfg: ext=$extension mac=$mac ip=$ip model=$model ".$phone['model']."-".$phone['type']."\n",3,"/tmp/yealink_startup.log");
// Update config file
yealink_error_check(update_startup_file($extension,$mac,$ip,$phone['type']));
if($debug) error_log($_SERVER['SCRIPT_NAME']." Update-startup.cfg:  ext=$extension mac=$mac ip=$ip model=$model\n",3,"/tmp/yealink_startup.log");
// Create Reboot screen
pbx_manage('login',$extension);
if($debug) error_log($_SERVER['SCRIPT_NAME']." Create-mac: 'login' ext=$extension\n",3,"/tmp/yealink_startup.log");
$output = "<YealinkIPPhoneTextScreen destroyOnExit=\"yes\">\n";
$output .= "<Title>". _("$text")."</Title>\n";
$output .= "<Text>". $extension . _("$text")."</Text>\n";
$output .= "</YealinkIPPhoneTextScreen>\n";
header("Refresh: 2; url=".$XML_SERVER."?action=factory");
output($output);
phone_logout($ip);
if($debug) error_log($_SERVER['SCRIPT_NAME']." FINE: 'restart' ext=$extension ip=$ip\n",3,"/tmp/yealink_startup.log");
exit;
?>