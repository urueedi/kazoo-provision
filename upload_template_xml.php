#!/usr/bin/php
<?php

require_once('config.php');

$host = get_dbhost($hosts);
$sag = new Sag($host);
$myip4 = get_ip(4);


// this is example manual plain to jaon format
$in = 

'

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

$out = json_encode(XML2Array::createArray($in));

echo $out;



?>
