#!/usr/bin/php
<?php

require_once('../config.php');

$host = get_dbhost($hosts);
$sag = new Sag($host, $dbport);
$myip4 = get_ip(4);


$types['300'] = array('fam' => '3xx', 'keys'=>'6', 'ekeys' => '0');
$types['320'] = array('fam' => '3xx', 'keys'=>'12', 'ekeys' => '0');
$types['360'] = array('fam' => '3xx', 'keys'=>'12', 'ekeys' => '0');
$types['370'] = array('fam' => '3xx', 'keys'=>'12', 'ekeys' => '0');
$types['320-1'] = array('fam' => '3xx', 'keys'=>'12', 'ekeys' => '24');
$types['360-1'] = array('fam' => '3xx', 'keys'=>'12', 'ekeys' => '24');
$types['370-1'] = array('fam' => '3xx', 'keys'=>'12', 'ekeys' => '24');
$types['320-2'] = array('fam' => '3xx', 'keys'=>'12', 'ekeys' => '48');
$types['360-2'] = array('fam' => '3xx', 'keys'=>'12', 'ekeys' => '48');
$types['370-2'] = array('fam' => '3xx', 'keys'=>'12', 'ekeys' => '48');
$types['D375'] = array('fam' => '3xx', 'keys'=>'12', 'ekeys' => '0');
$types['D375-1'] = array('fam' => '3xx', 'keys'=>'12', 'ekeys' => '24');
$types['D375-2'] = array('fam' => '3xx', 'keys'=>'12', 'ekeys' => '48');
$types['710'] = array('fam' => '7xx', 'keys'=>'5', 'ekeys' => '0');
$types['720'] = array('fam' => '7xx', 'keys'=>'18', 'ekeys' => '0');
$types['760'] = array('fam' => '7xx', 'keys'=>'12', 'ekeys' => '0');
$types['D715'] = array('fam' => '7xx', 'keys'=>'9', 'ekeys' => '0');
$types['D725'] = array('fam' => '7xx', 'keys'=>'16', 'ekeys' => '0');
$types['D765'] = array('fam' => '7xx', 'keys'=>'12', 'ekeys' => '0');
$types['821'] = array('fam' => '8xx', 'keys'=>'4', 'ekeys' => '0');
$types['870'] = array('fam' => '8xx', 'keys'=>'4', 'ekeys' => '0');
$types['m9'] = array('fam' => 'm9x', 'keys'=>'0', 'ekeys' => '0');
$types['m9r'] = array('fam' => 'm9x', 'keys'=>'0', 'ekeys' => '0');
$types['m25'] = array('fam' => 'mx5', 'keys'=>'0', 'ekeys' => '0');
$types['m65'] = array('fam' => 'mx5', 'keys'=>'0', 'ekeys' => '0');
$types['pa1'] = array('fam' => 'pax', 'keys'=>'0', 'ekeys' => '0');

foreach($types as $mod => $val) {

    $prov['endpoint_brand'] = 'snom';
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


$in = /* putin account settings from phone  !!!!!!!*/ '
<phone-settings e="2">
<user_server_type idx="{ACCOUNT}" perm="RW">asterisk</user_server_type>
<user_mailbox idx="{ACCOUNT}" perm="RW">{VMSD}</user_mailbox>
<user_symmetrical_rtp idx="{ACCOUNT}" perm="R">off</user_symmetrical_rtp>
<user_idle_text idx="{ACCOUNT}" perm="RW">{INTERNAL} {SIPCALLERID}</user_idle_text>
<user_outbound idx="{ACCOUNT}" perm="RW">{PROXY_SERVER}</user_outbound>
<record_missed_calls idx="{ACCOUNT}" perm="RW">on</record_missed_calls>
<user_realname idx="{ACCOUNT}" perm="RW">{SIPCALLERID}</user_realname>
<user_name idx="{ACCOUNT}" perm="RW">{SIPAUTHNAME}</user_name>
<user_pname idx="{ACCOUNT}" perm="RW">{SIPAUTHNAME}</user_pname>
<user_host idx="{ACCOUNT}" perm="RW">{REGISTRAR_SERVER}</user_host>
<user_pass idx="{ACCOUNT}" perm="RW">{SIPSECRET}</user_pass>
<codec_priority_list idx="{ACCOUNT}" perm="RW">g722,pcmu,gsm,g726-32,aal2-g726-32,g729,telephone-event</codec_priority_list>
<user_active idx="{ACCOUNT}" perm="RW">{STATUS}</user_active>
<user_dtmf_info idx="{ACCOUNT}" perm="RW">sip_info_only</user_dtmf_info>
<user_descr_contact idx="{ACCOUNT}" perm="RW">off</user_descr_contact>
<user_expiry idx="{ACCOUNT}" perm="RW">{PHONE_REREGISTER}</user_expiry>
<user_subscription_expiry idx="{ACCOUNT}" perm="RW">{SUBSCRIPT_REREGISTER}</user_subscription_expiry>
<retry_after_failed_subscribe idx="{ACCOUNT}" perm="RW">30</retry_after_failed_subscribe>
<user_sipusername_as_line idx="{ACCOUNT}" perm="RW">on</user_sipusername_as_line>
<user_ringer idx="{ACCOUNT}" perm="RW">Ringer1</user_ringer>
<user_srtp idx="{ACCOUNT}" perm="">{SRTP}</user_srtp>
<user_savp idx="{ACCOUNT}" perm="">optional</user_savp> 
</phone-settings>
';
$prov['cfg_account'] = XML2Array::createArray($in);

$in = /* putin behavior settings from phone  !!!!!!!*/ '

<phone-settings e="2">
<mwi_notification perm="RW">beep</mwi_notification>
<mwi_dialtone perm="RW">stutter</mwi_dialtone>
<timezone perm="RW">{TIMEZONE_IDX}</timezone>
<date_us_format perm="RW">off</date_us_format>
<time_24_format perm="RW">on</time_24_format>
<ringer_animation perm="RW">on</ringer_animation>
<speaker_dialer perm="RW">on</speaker_dialer>
<overlap_dialing perm="RW">off</overlap_dialing>
<language perm="RW">{LANGUAGE_IDX}</language>
<web_language perm="RW">{LANGUAGE_IDX}</web_language>
<transfer_on_hangup perm="RW">on</transfer_on_hangup>
<answer_after_policy perm="RW">idle</answer_after_policy>
<pickup_indication perm="RW">on</pickup_indication>
<auto_dial perm="RW">off</auto_dial>
<callpickup_dialoginfo perm="RW">on</callpickup_dialoginfo>
<show_name_dialog perm="RW">on</show_name_dialog>
<show_xml_pickup perm="RW">on</show_xml_pickup>
<edit_alpha_mode perm="RW">123</edit_alpha_mode>
<call_waiting perm="RW">visual</call_waiting>
<headset_device perm="RW">none</headset_device>
<keyboard_lock perm="RW">off</keyboard_lock>
<message_led_other perm="RW">off</message_led_other>
<use_backlight perm="RW">all</use_backlight>
<scroll_outgoing perm="RW">on</scroll_outgoing>
<display_method perm="RW">display_number_name</display_method>
</phone-settings>
';
$prov['cfg_behavior'] = XML2Array::createArray($in);

/* if you have more the 1 subselection add this seperatly */
//$in = '<certificates>
//<certificate url="{WEB_SERVER}/ca-root.der" />
//</certificates>
//';
$prov['cfg_behavior'] = array_merge($prov['cfg_behavior'], XML2Array::createArray($in));




$in = /* putin base settings from phone  !!!!!!!*/ '
<phone-settings e="2">
<http_user perm="R">admin</http_user>
<http_pass perm="R">{PROVPASS}</http_pass>
<redirect_event perm="RW">none</redirect_event>
<subscribe_config perm="RW">on</subscribe_config>
<pnp_config perm="RW">off</pnp_config>
<user_phone perm="RW">on</user_phone>
<ntp_server perm="RW">{NTP_SERVER}</ntp_server>
<challenge_response perm="R">off</challenge_response>
<privacy_in perm="RW">off</privacy_in>
<privacy_out perm="RW">off</privacy_out>
<publish_presence perm="RW">off</publish_presence>
<auto_logoff_time perm="RW"></auto_logoff_time>
<text_softkey perm="RW">off</text_softkey>
<action_offhook_url perm="RW"></action_offhook_url>
<action_onhook_url perm="RW"></action_onhook_url>
<action_setup_url perm="RW"></action_setup_url>
<ignore_security_warning perm="">on</ignore_security_warning>
<update_policy perm="RW">settings_only</update_policy>
<block_url_dialing perm="RW">on</block_url_dialing>
<dtmf_speaker_phone perm="RW">off</dtmf_speaker_phone>
<filter_registrar perm="RW">off</filter_registrar>
<show_line_info perm="RW">off</show_line_info>
<keyboard_lock_emergency perm="">110 112</keyboard_lock_emergency>
<advertisement perm="RW">on</advertisement>
<advertisement_url perm="RW">{ADVERTISEMENT_URL}</advertisement_url>
<action_dnd_on_url perm="">{WEB_SERVER}</action_dnd_on_url>
<action_dnd_off_url perm="">{WEB_SERVER}</action_dnd_off_url>
</phone-settings>
';
$prov['cfg_base'] = XML2Array::createArray($in);

/* if you have more the 1 subselection add this seperatly */
$in ='
<gui-languages>
<language url="{WEB_SERVER}/prov/snom/lang/gui_lang_DE.xml" name="Deutsch"/>
<language url="{WEB_SERVER}/prov/snom/lang/gui_lang_EN.xml" name="English"/>
<language url="{WEB_SERVER}/prov/snom/lang/gui_lang_FR.xml" name="Francais"/>
<language url="{WEB_SERVER}/prov/snom/lang/gui_lang_IT.xml" name="Italiano"/>
<language url="{WEB_SERVER}/prov/snom/lang/gui_lang_DA.xml" name="Dansk"/>
</gui-languages>
';
$prov['cfg_base'] = array_merge($prov['cfg_base'], XML2Array::createArray($in));

$in = '
<web-languages>
<language url="{WEB_SERVER}/prov/snom/lang/web_lang_DE.xml" name="Deutsch"/>
<language url="{WEB_SERVER}/prov/snom/lang/web_lang_EN.xml" name="English"/>
<language url="{WEB_SERVER}/prov/snom/lang/web_lang_FR.xml" name="Francais"/>
<language url="{WEB_SERVER}/prov/snom/lang/web_lang_IT.xml" name="Italiano"/>
<language url="{WEB_SERVER}/prov/snom/lang/web_lang_DA.xml" name="Danks"/>
</web-languages>
';
$prov['cfg_base'] = array_merge($prov['cfg_base'], XML2Array::createArray($in));




$in = /* putin tone settings from phone  !!!!!!!*/ '

<phone-settings e="2">
<tone_scheme perm="RW">{DIALTONE_SETTING}</tone_scheme>
<handsfree_mode perm="RW">normal</handsfree_mode>
<call_waiting perm="RW">on</call_waiting>
<intercom_enabled perm="RW">on</intercom_enabled>
<vol_speaker_mic perm="RW">{TX}</vol_speaker_mic>
<vol_handset_mic perm="RW">{TX}</vol_handset_mic>
<vol_headset_mic perm="RW">{TX}</vol_headset_mic>
<disable_speaker perm="RW">off</disable_speaker>
<cw_dialtone perm="RW">off</cw_dialtone>
<alert_internal_ring_sound perm="rw">Ringer1</alert_internal_ring_sound> 
<alert_external_ring_sound perm="rw">Ringer4</alert_external_ring_sound> 
</phone-settings>

';
$prov['cfg_tone'] = XML2Array::createArray($in); 

$in = /* putin keys settings from phone  !!!!!!!*/ '

<functionKeys>
<fkey idx="0" context="active" perm="RW">line</fkey>
<fkey idx="1" context="active" perm="RW">line</fkey>
<fkey idx="2" context="active" perm="RW">speed {VMSD}</fkey>
<fkey idx="3" context="active" perm="RW">url {WEB_SERVER}</fkey>
<fkey idx="4" context="active" perm="RW">keyevent F_TRANSFER</fkey>
<fkey idx="5" context="active" perm="RW">keyevent F_R</fkey>
<dkey_conf perm="RW">speed Meetme-{SIPAUTHNAME}</dkey_conf>
<dkey_transfer perm="RW">keyevent F_TRANSFER</dkey_transfer>
<idle_up_key_action perm="">keyevent F_PREV_ID</idle_up_key_action>
<idle_down_key_action perm="">keyevent F_NEXT_ID</idle_down_key_action>
<idle_left_key_action perm="">keyevent F_SETTINGS</idle_left_key_action>
<idle_right_key_action perm="">keyevent F_CALL_LIST</idle_right_key_action>
</functionKeys>

';
//$prov['cfg_keys'] = XML2Array::createArray($in);

$prov['pvt_counter'] = 1;
$prov['pvt_type'] = 'provisioner';
$prov['pvt_generator'] = 'json2xml';
echo upload_phone_data($prov);
unset($prov);
}

?>