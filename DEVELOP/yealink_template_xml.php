#!/usr/bin/php
<?php

require_once('../config.php');

$host = get_dbhost($hosts);
$sag = new Sag($host);
$myip4 = get_ip(4);




/* 1. !!!!!!!!!!!!!!!!!!!!!  phone_settings */
$prov['endpoint_brand'] = 'cisco';
$prov['endpoint_family'] = 'spa3xx';
$prov['endpoint_model'] = '303g';
/* this is programable keys on phone */
$prov['usr_keys']['setable_phone_keys'] = '0';
$prov['usr_keys']['setable_phone_key_counter'] = '0';
$prov['usr_keys']['setable_phone_key_value'] = 'fkey';
/* this is extensions module keys */
$prov['usr_keys']['setable_module_keys'] = '0';
$prov['usr_keys']['setable_module_key_counter'] = '0';
/* there use an special key for extensionsmodule */
$prov['usr_keys']['setable_module_key_value'] = 'extkey';



$in = /* putin account settings from phone  !!!!!!!*/ '


';
$prov['cfg_account'] = XML2Array::createArray($in);

$in = /* putin behavior settings from phone  !!!!!!!*/ '


';
$prov['cfg_behavior'] = XML2Array::createArray($in);

/* if you have more the 1 subselection add this seperatly */
$in = '


';
$prov['cfg_behavior'] = array_merge($prov['cfg_behavior'], XML2Array::createArray($in));




$in = /* putin base settings from phone  !!!!!!!*/ '


';
$prov['cfg_base'] = XML2Array::createArray($in);

/* if you have more the 1 subselection add this seperatly */
$in ='


';
$prov['cfg_base'] = array_merge($prov['cfg_base'], XML2Array::createArray($in));

$in = '


';
$prov['cfg_base'] = array_merge($prov['cfg_base'], XML2Array::createArray($in));




$in = /* putin tone settings from phone  !!!!!!!*/ '



';
$prov['cfg_tone'] = XML2Array::createArray($in); 

$in = /* putin keys settings from phone  !!!!!!!*/ '

';
$prov['cfg_keys'] = XML2Array::createArray($in);


$prov['pvt_generator'] = 'json2xml';
echo upload_phone_data($prov);


?>