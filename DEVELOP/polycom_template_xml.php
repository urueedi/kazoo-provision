#!/usr/bin/php
<?php

require_once('../config.php');

$host = get_dbhost($hosts);
$sag = new Sag($host, $dbport);
$myip4 = get_ip(4);
$del = " = ";

// spip family
$types['301'] = array('fam' => 'spip', 'keys'=>'0', 'ekeys' => '0');
$types['320'] = array('fam' => 'spip', 'keys'=>'0', 'ekeys' => '0');
$types['321'] = array('fam' => 'spip', 'keys'=>'0', 'ekeys' => '0');
$types['322'] = array('fam' => 'spip', 'keys'=>'0', 'ekeys' => '0');
$types['330'] = array('fam' => 'spip', 'keys'=>'0', 'ekeys' => '0');
$types['331'] = array('fam' => 'spip', 'keys'=>'0', 'ekeys' => '0');
$types['335'] = array('fam' => 'spip', 'keys'=>'0', 'ekeys' => '0');
$types['430'] = array('fam' => 'spip', 'keys'=>'0', 'ekeys' => '0');
$types['450'] = array('fam' => 'spip', 'keys'=>'0', 'ekeys' => '0');
$types['501'] = array('fam' => 'spip', 'keys'=>'0', 'ekeys' => '0');
$types['550'] = array('fam' => 'spip', 'keys'=>'0', 'ekeys' => '0');
$types['560'] = array('fam' => 'spip', 'keys'=>'0', 'ekeys' => '0');
$types['600'] = array('fam' => 'spip', 'keys'=>'0', 'ekeys' => '0');
$types['601'] = array('fam' => 'spip', 'keys'=>'0', 'ekeys' => '0');
$types['650'] = array('fam' => 'spip', 'keys'=>'0', 'ekeys' => '0');
$types['670'] = array('fam' => 'spip', 'keys'=>'0', 'ekeys' => '0');
$types['4000'] = array('fam' => 'spip', 'keys'=>'0', 'ekeys' => '0');
$types['5000'] = array('fam' => 'spip', 'keys'=>'0', 'ekeys' => '0');
$types['6000'] = array('fam' => 'spip', 'keys'=>'0', 'ekeys' => '0');
$types['7000'] = array('fam' => 'spip', 'keys'=>'0', 'ekeys' => '0');
// vvx family
$types['300'] = array('fam' => 'vvx', 'keys'=>'0', 'ekeys' => '0');
$types['310'] = array('fam' => 'vvx', 'keys'=>'0', 'ekeys' => '0');
$types['400'] = array('fam' => 'vvx', 'keys'=>'0', 'ekeys' => '0');
$types['410'] = array('fam' => 'vvx', 'keys'=>'0', 'ekeys' => '0');
$types['500'] = array('fam' => 'vvx', 'keys'=>'0', 'ekeys' => '0');
$types['600'] = array('fam' => 'vvx', 'keys'=>'0', 'ekeys' => '0');

foreach($types as $mod => $val) {

    $prov['endpoint_brand'] = 'polycom';
    $prov['endpoint_family'] = $val['fam'];
    $prov['endpoint_model'] = $mod;
    /* this is programable keys on phone */
    $prov['usr_keys']['setable_phone_keys'] = $val['keys'];
    $prov['usr_keys']['setable_phone_key_counter'] = '1';
    $prov['usr_keys']['setable_phone_key_value'] = 'fkey';
    /* this is extensions module keys */
    $prov['usr_keys']['setable_module_keys'] = $val['ekeys'];
    $prov['usr_keys']['setable_module_key_counter'] = '1';
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
<network>
  <bootproto>dhcp</bootproto>
  <ntp>0.us.pool.ntp.org</ntp>
  <timezone>CET-1CEST-2,M3.5.0/02:00:00,M10.5.0/03:00:00</timezone>
</network>
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

$prov['cfg_key'] = json_decode(plain2json($in, $del));




$prov['pvt_generator'] = 'json2xml';
$prov['pvt_counter'] = 1;
$prov['pvt_type'] = 'provisioner';
echo upload_phone_data($prov);
unset($prov);
}

?>