#!/usr/bin/php
<?php

require_once(',,/config.php');

$host = get_dbhost($hosts);
$sag = new Sag($host);
$myip4 = get_ip(4);

/* 1. !!!!!!!!!!!!!!!!!!!!!  phone_settings */
$del = '='; /* set a delimiter to strip key and value */
$prov['endpoint_brand'] = 'panasonic';
$prov['endpoint_family'] = 'kx';
$prov['endpoint_model'] = 'tgp500';

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

';

$prov['cfg_account'] = json_decode(plain2json($in, $del)); /* ":" is for split line in 2 pices on : */

// this is example manual plain to jaon format (BASE OPTIONAL)
$in = 
'

';

$prov['cfg_base'] = json_decode(plain2json($in, $del)); /* ":" is for split line in 2 pices on : */


// this is example manual plain to jaon format (BASE OPTIONAL)
$in =  /* putin behavior settings from phone  !!!!!!!*/
'

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