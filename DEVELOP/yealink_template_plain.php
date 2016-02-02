#!/usr/bin/php
<?php

require_once('../config.php');

$host = get_dbhost($hosts);
$sag = new Sag($host, $dbport);
$myip4 = get_ip(4);

/* 1. !!!!!!!!!!!!!!!!!!!!!  phone_settings */
$del = ' = '; /* set a delimiter to strip key and value */
$prov['endpoint_brand'] = 'yealink';
$prov['endpoint_family'] = 't4x';
$prov['endpoint_model'] = 't46g';

/* this is programable keys on phone */
$prov['usr_keys']['setable_phone_keys'] = '29';
$prov['usr_keys']['setable_phone_key_counter'] = '1';
$prov['usr_keys']['setable_phone_key_value'] = 'linekey';
/* this is extensions module keys */
$prov['usr_keys']['setable_module_keys'] = '0';
$prov['usr_keys']['setable_module_key_counter'] = '1';
/* there use an special key for extensionsmodule */
$prov['usr_keys']['setable_module_key_value'] = 'extkey';


// this is example manual plain to jaon format (ACCOUNT MUST BE!)
$in = 
'

account.{ACCOUNT}.codec.1.priority = 1
account.{ACCOUNT}.codec.2.priority = 2
account.{ACCOUNT}.codec.3.enable = 0
account.{ACCOUNT}.codec.4.enable = 0
account.{ACCOUNT}.codec.5.enable = 0
account.{ACCOUNT}.codec.6.enable = 1
account.{ACCOUNT}.codec.6.priority = 4
account.{ACCOUNT}.codec.7.enable = 0
account.{ACCOUNT}.enable = 1
account.{ACCOUNT}.label = {INTERNAL} {SIPCALLERID}
account.{ACCOUNT}.display_name = {SIPCALLERID}
account.{ACCOUNT}.user_name = {SIPAUTHNAME}
account.{ACCOUNT}.auth_name = {SIPAUTHNAME}
account.{ACCOUNT}.password = {SIPSECRET}
account.{ACCOUNT}.sip_server_host.legacy = {PROXY_SERVER}:{PROXY_PORT}
account.{ACCOUNT}.session_timer.expires = {PHONE_REREGISTER}
account.{ACCOUNT}.sip_server_type = 2
account.{ACCOUNT}.number_of_linekey = -1
account.{ACCOUNT}.reg_fail_retry_interval = 60
account.{ACCOUNT}.refresh_remote_id.enable = 0
account.{ACCOUNT}.alert_info_url_enable = 0
account.{ACCOUNT}.unregister_on_reboot = 1
account.{ACCOUNT}.shared_line_one_touch_bargein.enable = 1
account.{ACCOUNT}.dtmf.info_type = 1
account.{ACCOUNT}.ringtone.ring_type = commom
account.{ACCOUNT}.acd.available = 1
account.{ACCOUNT}.sip_server.1.address = {PROXY_SERVER}:{PROXY_PORT}
account.{ACCOUNT}.sip_server.1.expires = {PHONE_REREGISTER}
account.{ACCOUNT}.timeout_fwd.timeout = 10
account.{ACCOUNT}.always_fwd.off_code = *60
account.{ACCOUNT}.always_fwd.on_code = *61
account.{ACCOUNT}.busy_fwd.off_code = *60
account.{ACCOUNT}.busy_fwd.on_code = *62
account.{ACCOUNT}.dnd.on_code = *77
account.{ACCOUNT}.dnd.off_code = *79
voice_mail.number.{ACCOUNT} = {INTERNAL}

';

$prov['cfg_account'] = json_decode(plain2json($in, $del)); /* ":" is for split line in 2 pices on : */

// this is example manual plain to jaon format (BASE OPTIONAL)
$in = 
'
security.user_password = admin:{PROVPASS}
managementserver.connection_request_url = 
managementserver.product_class = SIP-T48G
managementserver.model_name = SIP-T48G
managementserver.provision_code = **##
local_time.time_zone = {TIMEZONE_NR}
local_time.time_zone_name = {TIMEZONE_NAME}
local_time.offset_time = %NULL%
local_time.ntp_server1 = {NTP_SERVER}
local_time.interval = 600
local_time.dhcp_time = 1
auto_provision.url_wildcard.PN = T48G
auto_provision.server.url = {PROV_SERVER}
auto_provision.downgrade_enable = 1
autoprovision.1.url =
network.lldp.packet_interval = 120
network.qos.signaltos = 24
sip.disp_incall_to_info = 1
sip.listen_mode = 0
watch_dog.enable = 0
network.port.max_rtpport = 11800
redirect.enable = 0
zero_touch.network_fail_wait_times = 5
network.dns.query_timeout = 1
phone_setting.emergency.number = 110,911,112
phone_setting.active_backlight_level = 10
bw.feature_key_sync = 1
super_search.recent_call = 1
gui_lang.url = {LANGUAGE_URL}
lang.gui = {LANGUAGE_IDX}

';

$prov['cfg_base'] = json_decode(plain2json($in, $del)); /* ":" is for split line in 2 pices on : */


// this is example manual plain to jaon format (BASE OPTIONAL)
$in =  /* putin behavior settings from phone  !!!!!!!*/
'

phone_setting.logon_wizard_forever_wait = 0
phone_setting.redial_number = 
phone_setting.redial_server = 
bw_phonebook.enterprise_enable = 0
bw_phonebook.group_common_enable = 0
bw_phonebook.enterprise_common_enable = 0
bw_phonebook.call_log_enable = 1
zero_touch.wait_time = 10
bw.directory_enable = 1
phone_setting.update_contact_display_priority = 0
forward.always.enable = 1
forward.always.on_code = *61
forward.always.off_code = *60
forward.busy.enable = 1
forward.busy.on_code = *62
forward.busy.off_code = *60
call_waiting.tone = 0
features.default_account = 1
features.dnd.on_code = *77
features.dnd.off_code = *79
features.pickup.direct_pickup_code = **
features.pickup.direct_pickup_enable = 1
features.pickup.group_pickup_code = *8
features.pickup.group_pickup_enable = 1
features.factory_pwd_enable = 1


';

$prov['cfg_behavior'] = json_decode(plain2json($in, $del));


// this is example manual plain to jaon format (BASE OPTIONAL)
$in =   /* putin behavior settings from phone  !!!!!!!!!*/
'

phone_setting.backgrounds = Default:Default.png
phone_setting.ring_type = Resource:Ring4.wav
phone_setting.custom_headset_mode_status = 1
features.intercom.barge = 1
features.group_listen_in_talking_enable = 0
voice.group_listening.spk_vol = 7
voice.jib.max = 600
voice.tone.country = {TONEZONE}

';

$prov['cfg_tone'] = json_decode(plain2json($in, $del));

// this is example manual plain to jaon format (BASE OPTIONAL)
$in =   /* putin behavior settings from phone  !!!!!!!!!!*/
'

programablekey.1.type = 28
programablekey.1.line = 1
programablekey.1.value = %NULL%
programablekey.1.label = %NULL%
programablekey.1.extension = %NULL%
programablekey.1.xml_phonebook = %NULL%
programablekey.1.pickup_value = %NULL%
programablekey.2.type = 61
programablekey.2.line = 1
programablekey.2.value = %NULL%
programablekey.2.label = %NULL%
programablekey.2.extension = %NULL%
programablekey.2.xml_phonebook = %NULL%
programablekey.2.pickup_value = %NULL%
programablekey.5.type = 28
programablekey.5.line = 1
programablekey.5.value = %NULL%
programablekey.5.label = %NULL%
programablekey.5.extension = %NULL%
programablekey.5.xml_phonebook = %NULL%
programablekey.5.pickup_value = %NULL%
programablekey.6.type = 29
programablekey.6.line = 1
programablekey.6.value = %NULL%
programablekey.6.label = %NULL%
programablekey.6.extension = %NULL%
programablekey.6.xml_phonebook = %NULL%
programablekey.6.pickup_value = %NULL%

';

$prov['cfg_key'] = json_decode(plain2json($in, $del));

$prov['pvt_generator'] = 'json2plain';
echo upload_phone_data($prov);

?>