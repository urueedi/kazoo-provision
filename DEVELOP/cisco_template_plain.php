#!/usr/bin/php
<?php

require_once('../config.php');

$host = get_dbhost($hosts);
$sag = new Sag($host);
$myip4 = get_ip(4);

/* 1. !!!!!!!!!!!!!!!!!!!!!  phone_settings */
$del = ':'; /* set a delimiter to strip key and value */
$prov['endpoint_brand'] = 'cisco';
$prov['endpoint_family'] = 'spa3xx';
$prov['endpoint_model'] = '303g';

/* this is programable keys on phone */
$prov['usr_keys']['setable_phone_keys'] = '0';
$prov['usr_keys']['setable_phone_key_counter'] = '0';
$prov['usr_keys']['setable_phone_key_value'] = 'FLEX_BUTTON_QUICK_DIAL';
/* this is extensions module keys */
$prov['usr_keys']['setable_module_keys'] = '0';
$prov['usr_keys']['setable_module_key_counter'] = '0';
/* there use an special key for extensionsmodule */
$prov['usr_keys']['setable_module_key_value'] = 'extkey';


// this is example manual plain to jaon format (ACCOUNT MUST BE!)
$in = 
'
line{ACCOUNT}_name: "{USERID}"
line{ACCOUNT}_displayname: "{USERID}"
line{ACCOUNT}_shortname: "{USERID}"
line{ACCOUNT}_authname: "{USERID}"
line{ACCOUNT}_password: "{PASSWORD}"

';
$prov['cfg_account'] = json_decode(plain2json($in, $del)); /* ":" is for split line in 2 pices on : */

// this is example manual plain to jaon format (BASE OPTIONAL)
$in = 
'

{LINES}

# Phone Label (Text desired to be displayed in upper right corner)
phone_label: "{STATION_NAME}"            ; Has no effect on SIP messaging

# Setting for Message speeddial to UOne box
messages_uri: "{VOICEMAIL_NUMBER}"
';
$prov['cfg_base'] = json_decode(plain2json($in, $del)); /* ":" is for split line in 2 pices on : */


// this is example manual plain to jaon format (BASE OPTIONAL)
$in =  /* putin behavior settings from phone  !!!!!!!*/
'

image_version: "P0S3-08-2-00"

# Proxy Server
proxy1_address: "{SERVER}"           ; Dotted IP of Proxy
proxy_backup: "{SERVER}"               ; Dotted IP of Backup Proxy
proxy_emergency: "{SERVER}"            ; Dotted IP of Emergency Proxy

# Proxy Registration (0-disable (default), 1-enable)
proxy_register: "1"

# Preferred Codec
preferred_codec: "g711ulaw"

# NAT/Firewall Traversal
nat_enable: "1"

# Inband DTMF Settings (0-disable, 1-enable (default))
dtmf_inband: "1"
dtmf_outofband: "avt"

# Call Waiting (0-disabled, 1-enabled, 2-disabled with no user control, 3-enabled with no user control)
call_waiting: "1"                 ; Default 1 (Call Waiting enabled)

';
$prov['cfg_behavior'] = json_decode(plain2json($in, $del));


// this is example manual plain to jaon format (BASE OPTIONAL)
$in =   /* putin behavior settings from phone  !!!!!!!!!*/
'

';

$prov['cfg_tone'] = json_decode(plain2json($in, $del));

// this is example manual plain to jaon format (BASE OPTIONAL)
$in =   /* putin behavior settings from phone  !!!!!!!!!!*/
'

';

$prov['cfg_key'] = json_decode(plain2json($in, $del));

$prov['pvt_generator'] = 'json2plain';
echo upload_phone_data($prov);


?>