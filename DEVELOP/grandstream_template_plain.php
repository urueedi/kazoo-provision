#!/usr/bin/php
<?php

require_once('../config.php');

$host = get_dbhost($hosts);
$sag = new Sag($host, $dbport);
$myip4 = get_ip(4);
$del = ":";

$types['m3'] = array('fam' => 'm3x', 'keys'=>'0', 'ekeys' => '0');

foreach($types as $mod => $val) {

    $prov['endpoint_brand'] = 'grandstream';
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


// this is example manual plain to jaon format (ACCOUNT MUST BE!)
$in = 
'

%SRV_{ACCOUNT}_SIP_UA_DATA_DOMAIN%: 
%SRV_{ACCOUNT}_SIP_URI_DOMAIN_CONFIG%: 2
%SRV_{ACCOUNT}_SIP_UA_DATA_SERVER_PORT%: {PROXY_PORT}
%SRV_{ACCOUNT}_SIP_UA_DATA_SERVER_TYPE%: 0
%SRV_{ACCOUNT}_SIP_UA_DATA_SERVER_IS_LOCAL%: 1
%SRV_{ACCOUNT}_SIP_UA_DATA_REREG_TIME%: {PHONE_REREGISTER}
%SRV_{ACCOUNT}_SIP_UA_DATA_PROXY_ADDR%: 
%SRV_{ACCOUNT}_DTMF_SIGNALLING%: 1
%SRV_{ACCOUNT}_SIP_UA_CODEC_PRIORITY%: 0, 1, 2, 4, 255
%SUBSCR_{ACCOUNT}_SIP_UA_DATA_SIP_NAME%: "{SIPAUTHNAME}"
%SUBSCR_{ACCOUNT}_UA_DATA_DISP_NAME%: "{SIPCALLERID}"
%SUBSCR_{ACCOUNT}_SIP_UA_DATA_SIP_NAME_ALIAS%: "{SIPAUTHNAME}"
%SUBSCR_{ACCOUNT}_SIP_UA_DATA_VOICE_MAILBOX_NAME%: "{SIPAUTHNAME}"
%SUBSCR_{ACCOUNT}_SIP_UA_DATA_VOICE_MAILBOX_NUMBER%: "{VMSD}"
%SUBSCR_{ACCOUNT}_UA_DATA_AUTH_NAME%: "{SIPAUTHNAME}"
%SUBSCR_{ACCOUNT}_UA_DATA_AUTH_PASS%: "{SIPSECRET}"
%CLIR_CODE_ENABLE_UA_{ACCOUNT}%: 0
%CLIR_PREFIX_UA_{ACCOUNT}%: 
%SRV_{ACCOUNT}_SIP_UA_DATA_PROXY_PORT%: {PROXY_PORT}
%HANDSET_{ACCOUNT_2}_NAME%: "{INTERNAL} {SIPCALLERID}"
%HANDSET_{ACCOUNT_2}_CW%: 1
%HANDSET_{ACCOUNT_2}_DND%: 0
%FWD_ON_BUSY_ACT_{ACCOUNT_2}%: 
%FWD_ON_BUSY_DEACT_{ACCOUNT_2}%: 
%FWD_ON_NO_ANSWER_ACT_{ACCOUNT_2}%: 
%FWD_ON_NO_ANSWER_DEACT_{ACCOUNT_2}%: 
%FWD_UNCOND_ACT_{ACCOUNT_2}%: "61*"
%FWD_UNCOND_DEACT_{ACCOUNT_2}%: 
%DECT_SUBS_{ACCOUNT_2}%: 0, 0, 0, 0, 0

';

$prov['cfg_account'] = json_decode(plain2json($in, $del)); /* ":" is for split line in 2 pices on : */

// this is example manual plain to jaon format (BASE OPTIONAL)
$in = 
'

%GMT_TIME_ZONE%: 16
%PLAY_INBAND_DTMF%: 1
%AUTOMATIC_SYNC_CLOCK%: 1
%AC_CODE%: {PROVPASS}
%COMMON_PHONEBOOK%: 1
%PINCODE_PROTECTED_SETTINGS%: 255
%DECT_SUBS_MATCH_IPEI%: 0
%FWU_POLLING_ENABLE%: 0
%FWU_POLLING_MODE%: 0
%FWU_POLLING_PERIOD%: 86400
%FWU_POLLING_TIME_HH%: 3
%FWU_POLLING_TIME_MM%: 0
%COUNTRY_VARIANT_ID%: {COUNTRYID_M3}
%EMERGENCY_PRIMARY_PORT%: 1
%JOIN_CALLS_ALLOWED%: 0
%SIP_KEEP_ALIVE_ENABLE%: 1
%SIP_SIP_PRIORITY%: 4
%DELAYED_MEDIA_BEHAVIOUR%: 0
%NETWORK_FWU_SERVER%: "provisioning.grandstream.com"
%NETWORK_RTP_QOS_REPORT_SERVER%: 
%NETWORK_RTP_QOS_REPORT_PATH%: "/QOSReports/"
%NETWORK_RTP_QOS_REPORT_PROTOCOL%: 1
%NETWORK_RTP_QOS_REPORT_ENABLE%: 0
%NETWORK_VLAN_ID%: 0
%NETWORK_VLAN_USER_PRIORITY%: 0
%VOIP_LOG_AUTO_UPLOAD%: 0
%NETWORK_DHCP_CLIENT_TIMEOUT%: 3
%NETWORK_DHCP_CLIENT_BOOT_SERVER%: 3
%NETWORK_DHCP_CLIENT_BOOT_SERVER_OPTION%: 160
%NETWORK_DHCP_CLIENT_BOOT_SERVER_OPTION_DATATYPE%: 1
%INFOPUSH_ICO_PRELOAD_URL%: 
%LOCAL_HTTP_SERVER_TEMPLATE_TITLE%: "grandstream M3"
%LOCAL_HTTP_SERVER_AUTH_NAME%: "admin"
%LOCAL_HTTP_SERVER_AUTH_PASS%: "{PROVPASS}"
%LOCAL_HTTP_SERVER_ACCESS%: 36863
%CODEC_SILENCE_SUPPRESSION%: 0
%SIP_STUN_ENABLE%: 0
%SIP_RPORT_ENABLE%: 0
%SIP_STUN_BINDTIME_GUARD%: 0
%SIP_STUN_BINDTIME_DETERMINE%: 0
%SIP_STUN_KEEP_ALIVE_TIME%: 0
%SIP_SIP_PORT%: {PROXY_PORT}
%SIP_RTP_PORT%: 15000
%SIP_RTP_PORT_RANGE%: 20
%FWU_TFTP_SERVER_PATH%: "/m3/firmware/"
%SIP_RTP_PRIORITY%: 4
%TRACE_MODE%: 1
%CONFIGURATION_FILE_FLAG%: 1
%MANAGEMENT_TRANSFER_PROTOCOL%: 1
%MANAGEMENT_PASSWORD%: "VoipLan"
%MANAGEMENT_UPLOAD_SCRIPT%: "/CfgUpload"
%ENABLE_SIP_MESSAGE_ENCRYPTION%: 0
%NETWORK_STUN_SERVER%: 
%NETWORK_SNTP_SERVER%: "{PROV_SERVER}"
%NETWORK_TFTP_SERVER%: "{PROV_SERVER}"
%NETWORK_SNTP_SERVER_UPDATE_TIME%: 60

';

$prov['cfg_base'] = json_decode(plain2json($in, $del)); /* ":" is for split line in 2 pices on : */


// this is example manual plain to jaon format (BASE OPTIONAL)
$in =  /* putin behavior settings from phone  !!!!!!!*/
'

%DST_ENABLE%: 2
%DST_FIXED_DAY_ENABLE%: 0
%DST_START_MONTH%: 3
%DST_START_DATE%: 1
%DST_START_TIME%: 2
%DST_START_DAY_OF_WEEK%: 1
%DST_START_WDAY_LAST_IN_MONTH%: 1
%DST_STOP_MONTH%: 10
%DST_STOP_DATE%: 1
%DST_STOP_TIME%: 2
%DST_STOP_DAY_OF_WEEK%: 1
%DST_STOP_WDAY_LAST_IN_MONTH%: 1
%ENABLE_ENHANCED_IDLE_SCREEN%: 0

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

$prov['pvt_counter'] = 0;
$prov['pvt_type'] = 'provisioner';

$prov['pvt_generator'] = 'json2plain';
echo upload_phone_data($prov);
unset($prov);
}

?>