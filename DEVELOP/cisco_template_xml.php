#!/usr/bin/php
<?php

require_once('../config.php');

$host = get_dbhost($hosts);
$sag = new Sag($host, $dbport);
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



$in = /* putin account settings from phone  !!!!!!!*/ '

<device>
   <fullConfig>true</fullConfig>
   <deviceProtocol>SIP</deviceProtocol>
   <sshUserId>cisco</sshUserId>
   <sshPassword>cisco</sshPassword>
   <devicePool>
      <dateTimeSetting>
         <dateTemplate>M/D/Ya</dateTemplate>
         <timeZone>Eastern Standard/Daylight Time</timeZone>
         <ntps>
              <ntp>
                  <name>{SERVER}</name>
                  <ntpMode>Unicast</ntpMode>
              </ntp>
         </ntps>
      </dateTimeSetting>
      <callManagerGroup>
         <members>
            <member priority="0">
               <callManager>
                  <ports>
                     <ethernetPhonePort>2000</ethernetPhonePort>
                     <sipPort>5060</sipPort>
                     <securedSipPort>5061</securedSipPort>
                  </ports>
                  <processNodeName>{SERVER}</processNodeName>
               </callManager>
            </member>
         </members>
      </callManagerGroup>
   </devicePool>
   <sipProfile>
      <sipProxies>
         <backupProxy></backupProxy>
         <backupProxyPort></backupProxyPort>
         <emergencyProxy></emergencyProxy>
         <emergencyProxyPort></emergencyProxyPort>
         <outboundProxy></outboundProxy>
         <outboundProxyPort></outboundProxyPort>
         <registerWithProxy>true</registerWithProxy>
      </sipProxies>
      <sipCallFeatures>
         <cnfJoinEnabled>true</cnfJoinEnabled>
         <callForwardURI>x--serviceuri-cfwdall</callForwardURI>
         <callPickupURI>x-cisco-serviceuri-pickup</callPickupURI>
         <callPickupListURI>x-cisco-serviceuri-opickup</callPickupListURI>
         <callPickupGroupURI>x-cisco-serviceuri-gpickup</callPickupGroupURI>
         <meetMeServiceURI>x-cisco-serviceuri-meetme</meetMeServiceURI>
         <abbreviatedDialURI>x-cisco-serviceuri-abbrdial</abbreviatedDialURI>
         <rfc2543Hold>false</rfc2543Hold>
         <callHoldRingback>2</callHoldRingback>
         <localCfwdEnable>true</localCfwdEnable>
         <semiAttendedTransfer>true</semiAttendedTransfer>
         <anonymousCallBlock>2</anonymousCallBlock>
         <callerIdBlocking>2</callerIdBlocking>
         <dndControl>0</dndControl>
         <remoteCcEnable>true</remoteCcEnable>
      </sipCallFeatures>
      <sipStack>
         <sipInviteRetx>6</sipInviteRetx>
         <sipRetx>10</sipRetx>
         <timerInviteExpires>180</timerInviteExpires>
         <timerRegisterExpires>3600</timerRegisterExpires>
         <timerRegisterDelta>5</timerRegisterDelta>
         <timerKeepAliveExpires>120</timerKeepAliveExpires>
         <timerSubscribeExpires>120</timerSubscribeExpires>
         <timerSubscribeDelta>5</timerSubscribeDelta>
         <timerT1>500</timerT1>
         <timerT2>4000</timerT2>
         <maxRedirects>70</maxRedirects>
         <remotePartyID>false</remotePartyID>
         <userInfo>None</userInfo>
      </sipStack>
      <autoAnswerTimer>1</autoAnswerTimer>
      <autoAnswerAltBehavior>false</autoAnswerAltBehavior>
      <autoAnswerOverride>true</autoAnswerOverride>
      <transferOnhookEnabled>false</transferOnhookEnabled>
      <enableVad>false</enableVad>
      <preferredCodec>g711ulaw</preferredCodec>
      <dtmfAvtPayload>101</dtmfAvtPayload>
      <dtmfDbLevel>3</dtmfDbLevel>
      <dtmfOutofBand>avt</dtmfOutofBand>
      <alwaysUsePrimeLine>false</alwaysUsePrimeLine>
      <alwaysUsePrimeLineVoiceMail>false</alwaysUsePrimeLineVoiceMail>
      <kpml>3</kpml>
      <natEnabled>0</natEnabled>
      <natAddress></natAddress>
      <phoneLabel>{STATION_NAME}</phoneLabel>
      <stutterMsgWaiting>1</stutterMsgWaiting>
      <callStats>true</callStats>
      <silentPeriodBetweenCallWaitingBursts>10</silentPeriodBetweenCallWaitingBursts>
      <disableLocalSpeedDialConfig>false</disableLocalSpeedDialConfig>
      <startMediaPort>16384</startMediaPort>
      <stopMediaPort>32766</stopMediaPort>
      <sipLines>
{LINES}
{SPEEDDIALS}
      </sipLines>
      <voipControlPort>5060</voipControlPort>
      <dscpForAudio>184</dscpForAudio>
      <ringSettingBusyStationPolicy>0</ringSettingBusyStationPolicy>
      <dialTemplate>dialplan.xml</dialTemplate>
   </sipProfile>
   <commonProfile>
      <phonePassword></phonePassword>
      <backgroundImageAccess>true</backgroundImageAccess>
      <callLogBlfEnabled>2</callLogBlfEnabled>
   </commonProfile>
   <loadInformation>SIP41.8-3-1S</loadInformation>
   <vendorConfig>
      <disableSpeaker>false</disableSpeaker>
      <disableSpeakerAndHeadset>false</disableSpeakerAndHeadset>
      <pcPort>0</pcPort>
      <settingsAccess>1</settingsAccess>
      <garp>0</garp>
      <voiceVlanAccess>1</voiceVlanAccess>
      <videoCapability>0</videoCapability>
      <autoSelectLineEnable>0</autoSelectLineEnable>
      <webAccess>1</webAccess>
      <spanToPCPort>1</spanToPCPort>
      <loggingDisplay>1</loggingDisplay>
      <loadServer></loadServer>
   </vendorConfig>
   <versionStamp>1143565489-a3cbf294-7526-4c29-8791-c4fce4ce4c37</versionStamp>
   <networkLocale>US</networkLocale>
   <networkLocaleInfo>
      <name>US</name>
      <version>5.0(2)</version>
   </networkLocaleInfo>
   <deviceSecurityMode>1</deviceSecurityMode>
   <authenticationURL></authenticationURL>
   <directoryURL></directoryURL>
   <idleURL></idleURL>
   <informationURL></informationURL>
   <messagesURL></messagesURL>
   <proxyServerURL>{SERVER}</proxyServerURL>
   <servicesURL></servicesURL>
   <dscpForSCCPPhoneConfig>96</dscpForSCCPPhoneConfig>
   <dscpForSCCPPhoneServices>0</dscpForSCCPPhoneServices>
   <dscpForCm2Dvce>96</dscpForCm2Dvce>
   <transportLayerProtocol>4</transportLayerProtocol>
   <capfAuthMode>0</capfAuthMode>
   <capfList>
      <capf>
         <phonePort>3804</phonePort>
      </capf>
   </capfList>
   <certHash></certHash>
   <encrConfig>false</encrConfig>
</device>
';
if($in) $prov['cfg_account'] = XML2Array::createArray($in);

$in = /* putin behavior settings from phone  !!!!!!!*/ '';
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