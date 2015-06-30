#!/usr/bin/php
<?php

require_once('config.php');

$host = get_dbhost($hosts);
$sag = new Sag($host);
$myip4 = get_ip(4);




/* 1. !!!!!!!!!!!!!!!!!!!!!  phone_settings */
$prov['endpoint_brand'] = 'snom';
$prov['endpoint_family'] = '3xx';
$prov['endpoint_model'] = '3999';

$prov['usr_keys']['setable_phone_keys'] = '0';
$prov['usr_keys']['setable_phone_key_counter'] = '0';



$in = /* putin account settings from phone  !!!!!!!*/ '
<phone-settings e="2">
<user_server_type idx="{ACCOUNT}" perm="RW">asterisk</user_server_type>
<user_mailbox idx="{ACCOUNT}" perm="RW">{VMSD}</user_mailbox>
<user_symmetrical_rtp idx="{ACCOUNT}" perm="R">off</user_symmetrical_rtp>
<user_idle_text idx="{ACCOUNT}" perm="RW">{INTERNAL}{SIPCALLERID}</user_idle_text>
<user_outbound idx="{ACCOUNT}" perm="RW">{PROXY_SERVER}</user_outbound>
<record_missed_calls idx="{ACCOUNT}" perm="RW">on</record_missed_calls>
<user_realname idx="{ACCOUNT}" perm="RW">{INTERNAL}{SIPCALLERID}</user_realname>
<user_name idx="{ACCOUNT}" perm="RW">{SIPAUTHNAME}</user_name>
<user_pname idx="{ACCOUNT}" perm="RW">{SIPAUTHNAME}</user_pname>
<user_host idx="{ACCOUNT}" perm="RW">{REGISTRAR_SERVER}</user_host>
<user_pass idx="{ACCOUNT}" perm="RW">{SIPSECRET}</user_pass>
<codec1_name idx="{ACCOUNT}" perm="RW">9</codec1_name>
<codec2_name idx="{ACCOUNT}" perm="RW">0</codec2_name>
<codec3_name idx="{ACCOUNT}" perm="RW">8</codec3_name>
<codec4_name idx="{ACCOUNT}" perm="RW">3</codec4_name>
<codec5_name idx="{ACCOUNT}" perm="RW">2</codec5_name>
<codec6_name idx="{ACCOUNT}" perm="RW">18</codec6_name>
<codec7_name idx="{ACCOUNT}" perm="RW">4</codec7_name>
<user_active idx="{ACCOUNT}" perm="RW">{STATUS}</user_active>
<user_dtmf_info idx="{ACCOUNT}" perm="RW">sip_info_only</user_dtmf_info>
<user_descr_contact idx="{ACCOUNT}" perm="RW">off</user_descr_contact>
<user_expiry idx="{ACCOUNT}" perm="RW">{Phone_Reregister_Prov}</user_expiry>
<user_subscription_expiry idx="{ACCOUNT}" perm="RW">{Phone_Reregister_Prov}</user_subscription_expiry>
<retry_after_failed_subscribe idx="{ACCOUNT}" perm="RW">{Phone_Reregister_Prov}</retry_after_failed_subscribe>
<user_sipusername_as_line idx="{ACCOUNT}" perm="RW">on</user_sipusername_as_line>
<user_ringer idx="{ACCOUNT}" perm="RW">Ringer1</user_ringer>
<user_srtp idx="{ACCOUNT}" perm="">{SRTP}</user_srtp>
<user_savp idx="{ACCOUNT}" perm="">optional</user_savp> 
</phone-settings>
';
$prov['cfg_account'] = json_encode(XML2Array::createArray($in));

$in = /* putin behavior settings from phone  !!!!!!!*/ '

<phone-settings e="2">
<mwi_notification perm="RW">beep</mwi_notification>
<mwi_dialtone perm="RW">stutter</mwi_dialtone>
<timezone perm="RW">CHE+1</timezone>
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
$prov['behavior'] = json_encode(XML2Array::createArray($in));

/* if you have more the 1 subselection add this seperatly */
$in = '<certificates>
<certificate url="http://{WEB_SERVER}/prov/snom/opennet-ca-root.der" />
</certificates>
';
$prov['cfg_behavior'] .= json_encode(XML2Array::createArray($in));




$in = /* putin base settings from phone  !!!!!!!*/ '
<phone-settings e="2">
<http_user perm="R">admin</http_user>
<http_pass perm="R">{PROVPASS}</http_pass>
<redirect_event perm="RW">none</redirect_event>
<subscribe_config perm="RW">off</subscribe_config>
<pnp_config perm="RW">off</pnp_config>
<user_phone perm="RW">on</user_phone>
<ntp_server perm="RW">{WEB_SERVER}</ntp_server>
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
<keyboard_lock_emergency perm="">110 112 117 118 144 1414</keyboard_lock_emergency>
<advertisement perm="RW">on</advertisement>
<advertisement_url perm="RW">{ADVERTISEMENT_URL}</advertisement_url>
<action_dnd_on_url perm="">{WEB_SERVER}</action_dnd_on_url>
<action_dnd_off_url perm="">{WEB_SERVER}</action_dnd_off_url>
</phone-settings>
';
$prov['cfg_base'] = json_encode(XML2Array::createArray($in));

/* if you have more the 1 subselection add this seperatly */
$in ='
<gui-languages>
<language url="http://{WEB_SERVER}/prov/snom/lang/gui_lang_DE.xml" name="Deutsch"/>
<language url="http://{WEB_SERVER}/prov/snom/lang/gui_lang_EN.xml" name="English"/>
<language url="http://{WEB_SERVER}/prov/snom/lang/gui_lang_FR.xml" name="Francais"/>
<language url="http://{WEB_SERVER}/prov/snom/lang/gui_lang_IT.xml" name="Italiano"/>
</gui-languages>
';
$prov['cfg_base'] .= json_encode(XML2Array::createArray($in));

$in = '
<web-languages>
<language url="http://{WEB_SERVER}/prov/snom/lang/web_lang_DE.xml" name="Deutsch"/>
<language url="http://{WEB_SERVER}/prov/snom/lang/web_lang_EN.xml" name="English"/>
<language url="http://{WEB_SERVER}/prov/snom/lang/web_lang_FR.xml" name="Francais"/>
<language url="http://{WEB_SERVER}/prov/snom/lang/web_lang_IT.xml" name="Italiano"/>
</web-languages>
';
$prov['cfg_base'] .= json_encode(XML2Array::createArray($in));




$in = /* putin tone settings from phone  !!!!!!!*/ '

<phone-settings e="2">
<tone_scheme perm="RW">SWI</tone_scheme>
<handsfree_mode perm="RW">normal</handsfree_mode>
<call_waiting perm="RW">on</call_waiting>
<intercom_enabled perm="RW">on</intercom_enabled>
<vol_speaker_mic perm="RW">3</vol_speaker_mic>
<vol_handset_mic perm="RW">3</vol_handset_mic>
<vol_headset_mic perm="RW">3</vol_headset_mic>
<disable_speaker perm="RW">off</disable_speaker>
<cw_dialtone perm="RW">off</cw_dialtone>
<alert_internal_ring_sound perm="rw">Ringer1</alert_internal_ring_sound> 
<alert_external_ring_sound perm="rw">Ringer4</alert_external_ring_sound> 
</phone-settings>

';
$prov['cfg_tone'] = json_encode(XML2Array::createArray($in)); 

$in = /* putin keys settings from phone  !!!!!!!*/ '

<functionKeys>
<fkey idx="0" context="active" perm="RW">line</fkey>
<fkey idx="1" context="active" perm="RW">line</fkey>
<fkey idx="2" context="active" perm="RW">speed {VMSD}</fkey>
<fkey idx="3" context="active" perm="RW">url http://{WEB_SERVER}</fkey>
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
$prov['cfg_keys'] = json_encode(XML2Array::createArray($in));


$prov['usr_keys']['setable_phone_key_value'] = 'fkey';
$prov['pvt_generator'] = 'json2xml';
echo upload_phone_data($prov);


?>
