#!/usr/bin/php
<?php

require_once('../config.php');

$host = get_dbhost($hosts);
$sag = new Sag($host);
$myip4 = get_ip(4);




/* 1. !!!!!!!!!!!!!!!!!!!!!  phone_settings */
$prov['endpoint_brand'] = 'cisco';
$prov['endpoint_family'] = 'spa3xx';
$prov['endpoint_model'] = '501g';
/* this is programable keys on phone */
$prov['usr_keys']['setable_phone_keys'] = '0';
$prov['usr_keys']['setable_phone_key_counter'] = '0';
$prov['usr_keys']['setable_phone_key_value'] = 'fkey';
/* this is extensions module keys */
$prov['usr_keys']['setable_module_keys'] = '0';
$prov['usr_keys']['setable_module_key_counter'] = '0';
/* there use an special key for extensionsmodule */
$prov['usr_keys']['setable_module_key_value'] = 'extkey';



$in = /* putin account settings from phone  !!!!!!!*/ '';
if($in) $prov['cfg_account'] = XML2Array::createArray($in);

$in = /* putin behavior settings from phone  !!!!!!!*/ '
<config>
<dect>
  <auto_create_users>true</auto_create_users>
  <send_date_time>true</send_date_time>
  <subscription_allowed>true</subscription_allowed>
</dect>
<provisioning>
  <check>
    <check_sync>update</check_sync>
    <interval>0</interval>
    <time>05:08</time>
  </check>
  <firmware>
    <kws>kws300firmware.bin</kws>
  </firmware>
  <server>
    <method>static</method>
    <url>ftp://{SERVER}/</url>
  </server>
  <users>
    <check>true</check>
  </users>
</provisioning><sip>
  <defaultdomain>{SERVER}</defaultdomain>
  <dtmf>
    <duration>270</duration>
    <info>false</info>
    <rtp>true</rtp>
    <rtp_payload_type>96</rtp_payload_type>
  </dtmf>
  <localport>12050</localport>
  <maxforwards>70</maxforwards>
  <media>
    <codecs>1,2</codecs>
    <port>58000</port>
    <ptime>20</ptime>
    <symmetric>true</symmetric>
    <tos>184</tos>
  </media>
  <mwi>
    <enable>true</enable>
    <expire>300</expire>
    <subscribe>true</subscribe>
  </mwi>
  <onholdtone>true</onholdtone>
  <pound_dials_overlap>false</pound_dials_overlap>
  <proxy>
    <domain>{SERVER}</domain>
    <port>0</port>
    <transport>UDPonly</transport>
  </proxy>
  <registration_expire>300</registration_expire>
  <send_to_current_registrar>false</send_to_current_registrar>
  <separate_endpoint_ports>false</separate_endpoint_ports>
  <seperate_endpoint_ports>true</seperate_endpoint_ports>
  <showstatustext>true</showstatustext>
  <tos>96</tos>
</sip>
</config>
';
if($in) $prov['cfg_behavior'] = XML2Array::createArray($in);

/* if you have more the 1 subselection add this seperatly */
$in = '';
if($in) $prov['cfg_behavior'] = array_merge($prov['cfg_behavior'], XML2Array::createArray($in));

$in = /* putin base settings from phone  !!!!!!!*/ '';
if($in) $prov['cfg_base'] = XML2Array::createArray($in);

/* if you have more the 1 subselection add this seperatly */
$in ='';
if($in) $prov['cfg_base'] = array_merge($prov['cfg_base'], XML2Array::createArray($in));

$in = '';
if($in) $prov['cfg_base'] = array_merge($prov['cfg_base'], XML2Array::createArray($in));

$in = /* putin tone settings from phone  !!!!!!!*/ '';
if($in) $prov['cfg_tone'] = XML2Array::createArray($in); 

$in = /* putin keys settings from phone  !!!!!!!*/ '';
if($in) $prov['cfg_keys'] = XML2Array::createArray($in);

$prov['pvt_generator'] = 'json2xml';
echo upload_phone_data($prov);


?>