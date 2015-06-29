<?php

//parse_str($_SERVER['QUERY_STRING'],$vars);
//
// Copyright (C) 2009-2065 FreePBX-Swiss Urs Rueedi
//

function output($put) {
    // Set content type
    header("Content-Type: text/xml");
    header("Content-Length: ".strlen($put));
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n".$put;
    if(@filemtime('./flash') < time()) {
	touch('./flash',time()+10);
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?><exit/>";
	if($debug) error_log($_SERVER['SCRIPT_NAME']." Exit: reset\n",3,"/tmp/snom_startup.log");
    }
if($debug) error_log($_SERVER['SCRIPT_NAME']."OUT: $put\n",3,"/tmp/snom_startup.log");
}

$debug = false;

require_once('include/config.inc.php');
require_once('include/backend.inc.php');
require_once('../../functions.inc.php');
require_once('../../common/php-asmanager.php');
require_once('../../modules/phoneprovision/functions.inc.php');
$amp_conf = parse_amportal_conf("/etc/amportal.conf");

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

$XML_SERVER = "http://".$_SERVER['SERVER_ADDR'].$_SERVER['SCRIPT_NAME'];
$SM_PROXY_SERVER = $_SERVER['SERVER_ADDR'];
$SM_WEB_SERVER = $_SERVER['SERVER_ADDR'];
$SM_REGISTRAR_SERVER = $_SERVER['SERVER_ADDR'];
$ASTERISK_LOCATION = "/etc/asterisk/";

// Retrieve parameters
$extension=$_GET["extension"];
$password=$_GET["password"];
$action=$_GET["action"];
$step=$_GET["step"];
$mac=$_GET["mac"];
$did=$_GET["did"];
$mobilecid=$_GET["mobilecid"];

// correct problem snom delimiter ?
if (preg_match("/\?/",$mac)) {
$value = preg_split("/\?/",$mac);
$mac = $value[0];
$val = preg_split("/\=/",$value[1]);
$extension = $val[1];
$val = preg_split("/=/",$value[2]);
$did = $val[1];
$val = preg_split("/=/",$value[3]);
$mobilecid = $val[1];
$val = preg_split("/=/",$value[4]);
$password = $val[1];
$val = preg_split("/=/",$value[5]);
$name = umlaut($val[1]);
}
if (preg_match("/\?/",$extension)) {
$value=preg_split("/\?/",$extension);
$extension = $value[0];
$val=preg_split("/\=/",$value[1]);
$password = $val[1];
}

// get MAC address and type of phone
$value = snom_decode_HTTP_header();
$model = $value[0];
$ip = $value[3];

// adding portnumer
if($ip) {
    if(!preg_match("#:#",$ip))
	$ip .= ":80";
}

if (! isset($extension) && $mac)
    $extension = get_provision_state($mac);
if($extension)
    $userdata = get_userdata_from_sip($extension);

if($prov_mode == 'none')
{
change_language($extension);
$output = "<SnomIPPhoneText>\n";
$output .= "<Title>". _("Error Mode")."</Title>\n";
$output .= "<Prompt>Prompt Text</Prompt>\n";

if($_SERVER['SCRIPT_NAME']=="/".$amp_conf['AMPPROVWEBPATH']."/snom/logout.php")
    $output .= "<Text>". _("Logout disallow").": $prov_mode</Text>\n";
elseif($_SERVER['SCRIPT_NAME']=="/".$amp_conf['AMPPROVWEBPATH']."/snom/startup.php")
    $output .= "<Text>". _("Login disallow").": $prov_mode</Text>\n";
$output .= "</SnomIPPhoneText>\n";

output($output);
exit;
}

if($debug) error_log($_SERVER['SCRIPT_NAME']." INFO-1: mac=$mac ext=$extension pass=$password action=$action step=$step did=$did model=$model lang=$language ip=$ip\n",3,"/tmp/snom_startup.log");

if(($_SERVER['SCRIPT_NAME']=="/".$amp_conf['AMPPROVWEBPATH']."/snom/logout.php") && (is_file($amp_conf['AMPWEBROOT']."/modules/phoneprovision/snom/".$mac.".cfg")))
{
    if($password == "")
        $password = $did;

    // Change to Userlanguage
    change_language($extension);

if($debug) error_log($_SERVER['SCRIPT_NAME']." LOGOUT-1: ext=$extension pass=$password\n",3,"/tmp/snom_startup.log");
    // Input Password
    if ($password=='')
    {
	$output = "<SnomIPPhoneInput>\n";
	$output .= "<Title>". _("Initial startup")."</Title>\n";
	$output .= "<Prompt>Prompt</Prompt>\n";
	$output .= "<URL>$XML_SERVER?mac=$mac?extension=$extension</URL>\n";
	$output .= "<InputItem>\n";
	$output .= "<DisplayName>". _("Logout Password")."</DisplayName>\n";
	$output .= "<QueryStringParam>password</QueryStringParam>\n";
	$output .= "<DefaultValue/>\n";
	$output .= "<InputFlags>pn</InputFlags>\n";
	$output .= "</InputItem>\n";
	$output .= "</SnomIPPhoneInput>\n";
	output($output);
	exit;
	}
    else
	{
	$vmdata = get_vm_Users('');
        $vm_password = $vmdata[$extension]['vm_password'];
	// IF authentication faild
        if ($userdata[1] != $password && $vm_password != $password)
	{
	    if ($password == "999") {
    	    // Reboot needed
	    $output = "<SnomIPPhoneText>\n";
	    $output .= "<Title>". _("Reboot")."</Title>\n";
	    $output .= "<Prompt>Prompt Text</Prompt>\n";
	    $output .= "<Text>". _("Reboot now")." $extension</Text>\n";
	    $output .= "</SnomIPPhoneText>\n";
	    output($output);
	    delete_mac($mac,'snom');
	    sleep(1);
	    pbx_manage('logout',$extension);
	    snom_error_check(phone_reboot($ip,$mac));
if($debug) error_log($_SERVER['SCRIPT_NAME']." LOGOUT-2: '999 reboot' mac=$mac ext=$extension pass=".$password." model=".$model." lang=".$language." ip=".$ip."\n",3,"/tmp/snom_startup.log");
            exit;
        }
	// Display error
	$output = "<SnomIPPhoneInput>\n";
	$output .= "<Title>". _("Auth. faild")."</Title>\n";
	$output .= "<Prompt>Prompt</Prompt>\n";
	$output .= "<URL>$XML_SERVER?mac=$mac</URL>\n";
	$output .= "<InputItem>\n";
	$output .= "<DisplayName>". _("reboot type=999")."</DisplayName>\n";
	$output .= "<QueryStringParam>password</QueryStringParam>\n";
	$output .= "<DefaultValue/>\n";
	$output .= "<InputFlags>pn</InputFlags>\n";
	$output .= "</InputItem>\n";
	$output .= "</SnomIPPhoneInput>\n";
	output($output);
        exit;
    }
    else
    {
	$msg = check_phone_status($extension);
        if ($msg) {
	    $output = "<SnomIPPhoneText>\n";
	    $output .= "<Title>". _("Extension in use")."</Title>\n";
	    $output .= "<Prompt>Prompt Text</Prompt>\n";
	    $output .= "<Text>".$msg['err_small']." $extension</Text>\n";
	    $output .= "</SnomIPPhoneText>\n";
	    output($output);
if($debug) error_log($_SERVER['SCRIPT_NAME']." LOGOUT-3: 'ext use' mac=$mac ext=$extension pass=".$password." model=".$model." lang=".$language." ip=".$ip."\n",3,"/tmp/snom_startup.log");
	    exit;
	}
        // Reboot needed
	$output = "<SnomIPPhoneText>\n";
	$output .= "<Title>". _("Logout")."</Title>\n";
	$output .= "<Prompt>Prompt Text</Prompt>\n";
	$output .= "<Text>". _("Logout")." $extension</Text>\n";
	$output .= "</SnomIPPhoneText>\n";
	// Update config file startup.cfg
	snom_error_check(delete_update_config_file($ip,$mac));
	output($output);
	sleep(2);
	// Logout phone and reboot
	pbx_manage('logout',$extension);
	snom_error_check(phone_logout($ip,$mac));
if($debug) error_log($_SERVER['SCRIPT_NAME']." LOGOUT-4: 'logout' mac=$mac ext=$extension pass=".$password." model=".$model." lang=".$language." ip=".$ip."\n",3,"/tmp/snom_startup.log");
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
	$output = "<SnomIPPhoneInput>\n";
	$output .= "<Title>". _("Install startup")."</Title>\n";
	$output .= "<Prompt>Prompt</Prompt>\n";
	$output .= "<URL>$XML_SERVER?mac=$mac</URL>\n";
	$output .= "<InputItem>\n";
	$output .= "<DisplayName>". _("New Number")."</DisplayName>\n";
	$output .= "<QueryStringParam>extension</QueryStringParam>\n";
	$output .= "<DefaultValue/>\n";
	$output .= "<InputFlags>n</InputFlags>\n";
	$output .= "</InputItem>\n";
	$output .= "</SnomIPPhoneInput>\n";
	output($output);
	exit;
    } else {
	$sip_array = change_language($extension);
	if ($sip_array[$extension] == NULL)
	    {
if($debug) error_log($_SERVER['SCRIPT_NAME']." CREATE EXT: ext=$extension pass=$password did=$did mob=$mobilecid nam=$name\n",3,"/tmp/snom_startup.log");
	    if($did == "")
		{
	        $output = "<SnomIPPhoneInput>\n";
	        $output .= "<Title>". _("Install startup")."</Title>\n";
	        $output .= "<Prompt>Prompt</Prompt>\n";
	        $output .= "<URL>$XML_SERVER?mac=$mac?extension=$extension</URL>\n";
	        $output .= "<InputItem>\n";
	        $output .= "<DisplayName>". _("DID Number")."</DisplayName>\n";
	        $output .= "<QueryStringParam>did</QueryStringParam>\n";
	        $output .= "<DefaultValue/>\n";
	        $output .= "<InputFlags>n</InputFlags>\n";
	        $output .= "</InputItem>\n";
	        $output .= "</SnomIPPhoneInput>\n";
	        output($output);
		/* echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?><exit/>"; */
	        exit;
		}
	    if($mobilecid == "")
		{
	        $output = "<SnomIPPhoneInput>\n";
	        $output .= "<Title>". _("Install startup")."</Title>\n";
	        $output .= "<Prompt>Prompt</Prompt>\n";
	        $output .= "<URL>$XML_SERVER?mac=$mac?extension=$extension?did=$did</URL>\n";
	        $output .= "<InputItem>\n";
	        $output .= "<DisplayName>". _("Mobile Number")."</DisplayName>\n";
	        $output .= "<QueryStringParam>mobilecid</QueryStringParam>\n";
	        $output .= "<DefaultValue/>\n";
	        $output .= "<InputFlags>n</InputFlags>\n";
	        $output .= "</InputItem>\n";
	        $output .= "</SnomIPPhoneInput>\n";
	        output($output);
	        exit;
		}
	    if($name == "")
		{
	        $output = "<SnomIPPhoneInput>\n";
	        $output .= "<Title>". _("Install startup")."</Title>\n";
	        $output .= "<Prompt>Prompt</Prompt>\n";
	        $output .= "<URL>$XML_SERVER?mac=$mac?extension=$extension?did=$did?mobilecid=$mobilecid</URL>\n";
	        $output .= "<InputItem>\n";
	        $output .= "<DisplayName>". _("Name")."</DisplayName>\n";
	        $output .= "<QueryStringParam>name</QueryStringParam>\n";
	        $output .= "<DefaultValue/>\n";
	        $output .= "<InputFlags>a</InputFlags>\n";
	        $output .= "</InputItem>\n";
	        $output .= "</SnomIPPhoneInput>\n";
	        output($output);
	        exit;
		}
	    if($password == "")
		{
	        $output = "<SnomIPPhoneInput>\n";
	        $output .= "<Title>". _("Install startup")."</Title>\n";
	        $output .= "<Prompt>Prompt</Prompt>\n";
	        $output .= "<URL>$XML_SERVER?mac=$mac?extension=$extension?did=$did?mobilecid=$mobilecid?name=$name</URL>\n";
	        $output .= "<InputItem>\n";
	        $output .= "<DisplayName>". _("Password")."</DisplayName>\n";
	        $output .= "<QueryStringParam>password</QueryStringParam>\n";
	        $output .= "<DefaultValue/>\n";
	        $output .= "<InputFlags>pn</InputFlags>\n";
	        $output .= "</InputItem>\n";
	        $output .= "</SnomIPPhoneInput>\n";
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
		    if (isset($msg))
	    	    { 
	    	    // Display error
	    	    $output = "<SnomIPPhoneText>\n";
	    	    $output .= "<Title>". _("Internal error")."</Title>\n";
	    	    $output .= "<Prompt>Prompt Text</Prompt>\n";
	    	    $output .= "<Text>". $msg[err_small] ."</Text>\n";
	    	    $output .= "</SnomIPPhoneText>\n";
	    	    output($output);
  	    	    exit;
	    	    }
	    }
    }
} else {
    if ($extension=="")
	{
	$output = "<SnomIPPhoneInput>\n";
	$output .= "<Title>". _("Login startup")."</Title>\n";
	$output .= "<Prompt>Prompt</Prompt>\n";
	$output .= "<URL>$XML_SERVER?mac=$mac</URL>\n";
	$output .= "<InputItem>\n";
	$output .= "<DisplayName>". _("Login Number")."</DisplayName>\n";
	$output .= "<QueryStringParam>extension</QueryStringParam>\n";
	$output .= "<DefaultValue/>\n";
	$output .= "<Parameter></Parameter>\n";
	$output .= "<InputFlags>n</InputFlags>\n";
	$output .= "</InputItem>\n";
	$output .= "</SnomIPPhoneInput>\n";
	output($output);
	exit;
    }
}

// Change to userlanguage
$sip_array = change_language($extension);

// If user not found
if ($sip_array[$extension]==NULL)
	{ 
	// Display error
	$output = "<SnomIPPhoneText>\n";
	$output .= "<Title>". _("Internal error")."</Title>\n";
	$output .= "<Prompt>Prompt Text</Prompt>\n";
	$output .= "<Text>". _("Not provisioned")."</Text>\n";
	$output .= "</SnomIPPhoneText>\n";
	output($output);
  	exit;
	}

// Input Password
if ($password=="")
	{
	$output = "<SnomIPPhoneInput>\n";
	$output .= "<Title>". _("Login startup")."</Title>\n";
	$output .= "<Prompt>Prompt</Prompt>\n";
	$output .= "<URL>$XML_SERVER?mac=$mac&extension=$extension</URL>\n";
	$output .= "<InputItem>\n";
	$output .= "<DisplayName>". _("Password")."</DisplayName>\n";
	$output .= "<QueryStringParam>password</QueryStringParam>\n";
	$output .= "<DefaultValue/>\n";
	$output .= "<InputFlags>pn</InputFlags>\n";
	$output .= "</InputItem>\n";
	$output .= "</SnomIPPhoneInput>\n";
	output($output);
	exit;
	}
$vmdata = get_vm_Users('');
$vm_password = $vmdata[$extension]['vm_password'];
// IF authentication faild
if ($sip_array[$extension]['secret'] != $password && $vm_password != $password)
	{
	// Display error
	$output = "<SnomIPPhoneText>\n";
	$output .= "<Title>". _("Auth. faild")."</Title>\n";
	$output .= "<Prompt>Prompt Text</Prompt>\n";
	$output .= "<Text>". _("Wrong user or pass")."</Text>\n";
	$output .= "</SnomIPPhoneText>\n";
	output($output);
  	exit;
	}

// if already configured
$return = lookup_config_file($extension);
// adding portnumer to 

if($return) {
    if(!preg_match("#:#",$return))
	$return .= ":80";
}

if($return != '0' && $prov_mode == 'logout')
{
	// Display error
	$output = "<SnomIPPhoneText>\n";
	$output .= "<Title>". _("Error")."</Title>\n";
	$output .= "<Prompt>Prompt Text</Prompt>\n";
	$output .= "<Text>". _("Extension in use")."</Text>\n";
	$output .= "</SnomIPPhoneText>\n";
	output($output);
  	exit;
}

if($return != '0' && ($prov_mode == 'push' || $prov_mode == 'new'))
{
    $msg = check_phone_status($extension);
    if ($msg) {
if($debug) error_log($_SERVER['SCRIPT_NAME']." ERROR STATUS: mac=$mac ext=$extension pass=".$password." model=".$model." lang=".$language." ip=".$ip."\n",3,"/tmp/snom_startup.log");
	$output = "<SnomIPPhoneText>\n";
	$output .= "<Title>". _("Problem")."</Title>\n";
	$output .= "<Prompt>Prompt Text</Prompt>\n";
	$output .= "<Text>".$msg['err_small']."</Text>\n";
	$output .= "</SnomIPPhoneText>\n";
	// Display XML Object
	output($output);
	exit;
    } else
    {	// Display others will Logout!
if($debug) error_log($_SERVER['SCRIPT_NAME']." LOGOUT-2: $return mac=$mac ext=$extension pass=".$password." model=".$model." lang=".$language." ip=".$ip."\n",3,"/tmp/snom_startup.log");
	$output = "<SnomIPPhoneText>\n";
	$output .= "<Title>". _("Logout old extension")."</Title>\n";
	$output .= "<Prompt>Prompt Text</Prompt>\n";
	$output .= "<Text>". _("Logout"). " $return</Text>\n";
	$output .= "</SnomIPPhoneText>\n";
	// Logout old phone
	snom_error_check(phone_logout($return));
        snom_error_check(delete_update_config_file($return));
        pbx_manage('logout',$extension);
	// Update config file an login new phone
	snom_error_check(create_snom_mac($mac,$extension,$username,$sip_array[$extension]['secret'],'',$model,$language,$ip)); 
	snom_error_check(update_startup_file($extension,$mac,$ip,$model));
	snom_error_check(phone_provision_user($ip,$mac));
	pbx_manage('login',$extension);
	output($output);
	exit;
    }
}

if($prov_mode == 'new') {

    if(!preg_match("#:#",$ip))
        $ip .= ":80";

if($debug) error_log($_SERVER['SCRIPT_NAME']." NEW-CONFIG $model: mac=$mac ext=$extension pass=".$password." model=".$model." lang=".$language." ip=".$ip."\n",3,"/tmp/snom_startup.log");
        if (! file_exists("../../modules/phoneprovision/snom/". $model ."-base.cfg"))
        {
		$output = "<SnomIPPhoneText>\n";
		$output .= "<Title>". _("Error")."</Title>\n";
		$output .= "<Prompt>Prompt Text</Prompt>\n";
		$output .= "<Text>". sprintf( _("%s not found!"),$model)."</Text>\n";
		$output .= "</SnomIPPhoneText>\n";
		// Display XML Object
		output($output);
		exit;
        }

        $phone = array('ip'=> $ip,
                'file'=> $model,
            	'mac'=> $mac,
                'provmode'=> 'login',
                'provdate'=> time(),
            	'type' => preg_replace("/snom/i","",$model),
                'expm' => $expm,
                'model' => 'Snom',
		'connect' => 'http://'.$ip,
        );
        add_config_file($phone);
}

// Create mac.cfg
if($debug) error_log($_SERVER['SCRIPT_NAME']." Create prov.cfg: mac=$mac ext=$extension pass=$password sippass=".$sip_array[$extension]['secret']." model=".$model." lang=".$language." ip=".$ip."\n",3,"/tmp/snom_startup.log");
snom_error_check(create_snom_mac($mac,$extension,$extension,$sip_array['secret'],'',$model,$language,$ip));
// Update config file startup.cfg
if($debug) error_log($_SERVER['SCRIPT_NAME']." Update-startup.cfg:  ext=$extension mac=$mac ip=$ip model=$model\n",3,"/tmp/snom_startup.log");
update_startup_file($extension,$mac,$ip,$model);
// Create Reboot screen
if($debug) error_log($_SERVER['SCRIPT_NAME']." Create-mac: 'login' ext=$extension\n",3,"/tmp/snom_startup.log");
pbx_manage('login',$extension);
$output = "<SnomIPPhoneText>\n";
$output .= "<Title>". _("logged in")."</Title>\n";
$output .= "<Prompt>Prompt Text</Prompt>\n";
$output .= "<Text>". _("logged in")."</Text>\n";
$output .= "</SnomIPPhoneText>\n";
phone_provision_user($ip,$mac);
output($output);
phone_logout($ip);
if($debug) error_log($_SERVER['SCRIPT_NAME']." Phone: 'reboot' ext=$extension ip=$ip\n",3,"/tmp/snom_startup.log");
exit;
?>
