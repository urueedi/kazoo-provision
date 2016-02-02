<?php
error_reporting(1);


function generate_yealink_provision($phone_data) {

    global $HTTP;

    $account = $phone_data['template']->usr_keys->setable_phone_key_counter;
    $account_start = $phone_data['template']->pvt_configs->account_counter;
    $generator = $phone_data['template']->pvt_generator;
    //print_r( $phone_data['template']);
    $account_counter = 0;
    $VM_EXT = "*98";
    $XML_SERVER = $HTTP.$_SERVER['HTTP_HOST']."/provisioner/prov/yealink/";
    $WEB_SERVER = $HTTP.$_SERVER['HTTP_HOST'];
    $PROV_SERVER = $HTTP.$_SERVER['HTTP_HOST'];
    $NTP_SERVER = "pool.ntp.org";
    $PROXY_SERVER = $phone_data['account'][$account]['realm'];
    $REGISTRAR_SERVER = $phone_data['account'][$account]['realm'];
    if($Phone_Reregister_Prov == false) $Phone_Reregister_Prov = 360;
    ($phone_data['users'][0][$phone_data['prov'][0]['owner']]['value']['language']) ? $language = $phone_data['users'][0][$phone_data['prov'][0]['owner']]['value']['language'] : $language = $phone_data['account'][$account]['language'];
    ($phone_data['users'][0][$phone_data['prov'][0]['owner']]['value']['timezone']) ? $timezone = $phone_data['users'][0][$phone_data['prov'][0]['owner']]['value']['timezone'] : $timezone = $phone_data['account'][$account]['timezone'];

    switch($language) {
       case 'en-US': $lang_idx="English"; break;
       case 'de-DE': $lang_idx="German"; break;
       case 'da-DA': $lang_idx="Dansk"; break;
       case 'fr-FR': $lang_idx="French"; break;
       case 'it-IT': $lang_idx="Italian"; break;
       default: $lang_idx="Enlish";
    }

    // code ersetzten und per ip zeitzone definieren fuer telefon config
    if($phone_data['template']->endpoint_brand == 'yealink') {
        switch($timezone) {
/*
        −11:00 Samoa
        −10:00 United States-Hawaii-Aleutian
        −10:00 United States-Alaska-Aleutian
        −09:00 United States-Alaska Time
        −08:00 Canada(Vancouver, Whitehorse)
        −08:00 Mexico(Tijuana, Mexicali)
        −08:00 United States-Pacific Time
        −07:00 Canada(Edmonton, Calgary)
        −07:00 Mexico(Mazatlan, Chihuahua)
        −07:00 United States-Mountain Time
        −07:00 United States-MST no DST
        −06:00 Canada-Manitoba(Winnipeg)
        −06:00 Chile(Easter Islands)
        −06:00 Mexico(Mexico City, Acapulco)
        −06:00 United States-Central Time
        −05:00 Bahamas(Nassau)
        −05:00 Canada(Montreal, Ottawa, Quebec)
        −05:00 Cuba(Havana)
        −05:00 United States-Eastern Time
        −04:30 Venezuela(Caracas)
        −04:00 Canada(Halifax, Saint John)
        −04:00 Chile(Santiago)
        −04:00 Paraguay(Asuncion)
        −04:00 United Kingdom-Bermuda(Bermuda)
        −04:00 United Kingdom(Falkland Islands)
        −04:00 Trinidad&Tobago
        −03:30 Canada-New Foundland(St.Johns)
        −03:00 Denmark-Greenland(Nuuk)
        −03:00 Argentina(Buenos Aires)
        −03:00 Brazil(no DST)
        −03:00 Brazil(DST)
        −02:00 Brazil(no DST)
        −01:00 Portugal(Azores)
        0 GMT
        0 Greenland
        0 Denmark-Faroe Islands(Torshavn)
        0 Ireland(Dublin)
        0 Portugal(Lisboa, Porto, Funchal)
        0 Spain-Canary Islands(Las Palmas)
        0 United Kingdom(London)
        0 Morocco
        +01:00 Albania(Tirane)
        +01:00 Austria(Vienna)
        +01:00 Belgium(Brussels)
        +01:00 Caicos
        +01:00 Chad
        +01:00 Spain(Madrid)
        +01:00 Croatia(Zagreb)
        +01:00 Czech Republic(Prague)
        +01:00 Denmark(Kopenhagen)
        +01:00 France(Paris)
        +01:00 Germany(Berlin)
        +01:00 Hungary(Budapest)
        +01:00 Italy(Rome)
        +01:00 Luxembourg(Luxembourg)
        +01:00 Macedonia(Skopje)
        +01:00 Netherlands(Amsterdam)
        +01:00 Namibia(Windhoek)
        +02:00 Estonia(Tallinn)
        +02:00 Finland(Helsinki)
        +02:00 Gaza Strip(Gaza)
        +02:00 Greece(Athens)
        +02:00 Israel(Tel Aviv)
        +02:00 Jordan(Amman)
        +02:00 Latvia(Riga)
        +02:00 Lebanon(Beirut)
        +02:00 Moldova(Kishinev)
        +02:00 Russia(Kaliningrad)
        +02:00 Romania(Bucharest)
        +02:00 Syria(Damascus)
        +02:00 Turkey(Ankara)
        +02:00 Ukraine(Kyiv, Odessa)
        +03:00 East Africa Time
        +03:00 Iraq(Baghdad)
        +03:00 Russia(Moscow)
        +03:30 Iran(Teheran)
        +04:00 Armenia(Yerevan)
        +04:00 Azerbaijan(Baku)
        +04:00 Georgia(Tbilisi)
        +04:00 Kazakhstan(Aktau)
        +04:00 Russia(Samara)Appendix
        +04:30 Afghanistan
        +05:00 Kazakhstan(Aqtobe)
        +05:00 Kyrgyzstan(Bishkek)
        +05:00 Pakistan(Islamabad)
        +05:00 Russia(Chelyabinsk)
        +05:30 India(Calcutta)
        +06:00 Kazakhstan(Astana, Almaty)
        +06:00 Russia(Novosibirsk, Omsk)
        +07:00 Russia(Krasnoyarsk)
        +07:00 Thailand(Bangkok)
        +08:00 China(Beijing)
        +08:00 Singapore(Singapore)
        +08:00 Australia(Perth)
        +09:00 Korea(Seoul)
        +09:00 Japan(Tokyo)
        +09:30 Australia(Adelaide)
        +09:30 Australia(Darwin)
        +10:00 Australia(Sydney, Melbourne, Canberra)
        +10:00 Australia(Brisbane)
        +10:00 Australia(Hobart)
        +10:00 Russia(Vladivostok)
        +10:30 Australia(Lord Howe Islands)
        +11:00 New Caledonia(Noumea)
        +12:00 New Zealand(Wellington, Auckland)
        +12:45 New Zealand(Chatham Islan
*/
            case 'Europe/Berlin':	$timezone_nr="+01:00"; $timezone_name="Germany(Berlin)"; $lang_idx="German"; break;
            case 'Europe/Copenhagen':	$timezone_nr="+01:00"; $timezone_name="Denmark(Kopenhagen)"; $lang_idx="Dansk"; break;
            default:	$timezone_nr="+01:00"; $timezone_name="Germany(Berlin)";
        }
   }
    // Prepare replace strings
    $search=array(
        '{{ACCOUNT}}',
        '{{SIPAUTHNAME}}',
        '{{SIPSECRET}}',
        '{{SIPUSERNAME}}',
        '{{SIPCALLERID}}',
        '{{PROXY_SERVER}}',
        '{{REGISTRAR_SERVER}}',
        '{{WEB_SERVER}}',
        '{{LANGUAGE_IDX}}',
        '{{VMSD}}',
        '{{LOGOUT}}',
        '{{FORWARD}}',
        '{{DND}}',
        '{{VOICEMAIL}}',
        '{{PHONEBOOK}}',
        '{{ATD_XFER}}',
        '{{ATD_XFERCODE}}',
        '{{XFER}}',
        '{{XFERCODE}}',
        '{{INTERNAL}}',
        '{{MAC}}',
        '{{PRESENCE_ID}}',
        '{{PROXY_PORT}}',
        '{{NTP_SERVER}}',
        '{{INTERNAL}}',
        '{{SUBSCRIPT_REREGISTER}}',
        '{{PHONE_REREGISTER}}',
        '{{PROV_SERVER_URL}}',
        '{{PROV_PHONE_USER}}',
        '{{PROV_PHONE_PASS}}',
        '{{PROV_SERVER_URL_CERTIFICATE}}',
        '{{SETTING_SERVER}}',
        '{{SETTINGS_REFRESH_TIMER}}',
        '{{SRTP}}',
        '{{PROV_SERVER}}',
        '{{PROVPASS}}',
        '{{PROV_PASSWORD}}',
        '{{TIMEZONE_NR}}',
        '{{TIMEZONE_NAME}}',
        '{{LANGUAGE_URL}}',
        );
    // create account part
        $multiaccount = true;

//print_r($phone_data['account']);
        foreach ($phone_data['prov'] as $k => $value) {
          if(! is_numeric($k)) continue;
          $expm = $value['expm'];
          $device = $value['device'];
          $customersid = $value['cuid'];
          $read = $generator($phone_data['template']->cfg_account, 'settings', false, " = ");
          if($read) {
//print_r($value);
//print_r($phone_data['account'][$account_counter]['provision']);
//print_r($phone_data['users'][$account_counter][$phone_data['prov'][$account_counter]['owner']]);
//print_r($value);
            $replace = array(
                    $account,
                    $value['sip']['username'],                                                 /*   */
                    $value['sip']['password'],                                                 /*   */
                    $value['sip']['username'],                                                 /*   */
		    $phone_data['users'][$account_counter][$phone_data['prov'][$account_counter]['owner']]['key'],
                    $phone_data['account'][0]['realm'],                               /*   */
                    $phone_data['account'][0]['realm'],                               /*   */
                    $WEB_SERVER,
                    $lang_idx,
                    ($value['cutype'] == 'hostedpbx')?'0'.$VM_EXT:$VM_EXT,
                    _("Logout"),
                    _("Forward"),
                    _("DND"),
                    _("Voicemail"),
                    _("Phonebook"),
                    _("At Transfer"),
                    '*8',
                    _("Blind Tansfer"),
                    'on',
                    $phone_data['users'][$account_counter][$phone_data['prov'][$account_counter]['owner']]['value']['presence_id'],
                    strtolower(str_replace(":","",$value['mac'])),
                    $phone_data['users'][$account_counter][$phone_data['prov'][$account_counter]['owner']]['value']['presence_id'],
                    '5060',
                    $NTP_SERVER,
                    $phone_data['users'][$account_counter][$value['owner']]['value']['presence_id'],
                    $Phone_Reregister_Prov,
                    $Phone_Reregister_Prov,
                    $XML_SERVER,
                    $phone_data['account'][$account]['provision']['provisionuser'],
                    $phone_data['account'][$account]['provision']['provisionpass'],
                    '',
                    '',
                    '',
                    '',
                    $value['provision']['provstring'],
                    $phone_data['account'][$account_counter]['provision']['admin_password'],
                    $phone_data['account'][$account_counter]['provision']['urlpass'],
                    $timezone_nr,
                    $timezone_name,
                    dirname($value['provision']['provstring']).DIRECTORY_SEPARATOR."lang/".$lang_idx.".txt",
                    );
            $output .= "#!version:1.0.0.1\n";
              $output .= preg_replace($search, $replace, $read)."\n";
          }
        $account++;
        $account_counter++;
        $account_start++;
        }
      $read = $generator($phone_data['template']->cfg_base, 'settings', false, " = ");
      if($read) {
          $output .= preg_replace($search, $replace, $read)."\n";
      }
      $read = $generator($phone_data['template']->cfg_behavior, 'settings', false, " = ");
      if($read) {
          $output .= preg_replace($search, $replace, $read)."\n";
      }
      $read = $generator($phone_data['template']->cfg_tone, 'settings', false, " = ");
      if($read) {
          $output .= preg_replace($search, $replace, $read, 'settings')."\n";
      }
      $read = $generator($phone_data['template']->cfg_keys, 'settings', false, " = ");
      if($read) {
          $output .= "\n".preg_replace($search, $replace, $read)."\n";
      }

      // create model spcification pkeys
      $read = $generator($phone_data, 'usrkeys', false, " = ", 'write_yealink_keys');
      if($read) $output .= $read;

return $output;
}

/* write_yealink_keys kind = typ (presence, speed_dial, ... ) and value , expm=1, key=1, obj_data=array of prov
*/
function write_yealink_keys($kind, $expm, $key, $obj_datas, $account)
{

    switch($kind['type']) {
        case 'presence':
            $ret = "linekey.".$key.".type = 16".
            "\nlinekey.".$key.".line = 1".
            "\nlinekey.".$key.".value = ".$obj_datas['users'][$account][$kind['value']]['value']['presence_id'].
            "\nlinekey.".$key.".label = ".$obj_datas['users'][$account][$kind['value']]['value']['last_name']." ".$obj_datas['users'][$account][$kind['value']]['value']['first_name'].
            "\nlinekey.".$key.".extension = %NULL%".
            "\nlinekey.".$key.".pickup_value = *8\n";
        break;
        case 'speed_dial':
            $ret = "linekey.".$key.".type = 13".
            "\nlinekey.".$key.".line = 1".
            "\nlinekey.".$key.".value = ".$kind['value'].
            "\nlinekey.".$key.".label = "._("Speeddial").
            "\nlinekey.".$key.".extension = %NULL%".
            "\nlinekey.".$key.".pickup_value = %NULL%\n";
        break;
        case 'parking':
            $ret = "linekey.".$key.".type = 56".
            "\nlinekey.".$key.".line = 1".
            "\nlinekey.".$key.".value = ".$kind['value'].
            "\nlinekey.".$key.".label = "._("Park").
            "\nlinekey.".$key.".extension = %NULL%".
            "\nlinekey.".$key.".pickup_value = %NULL%\n";
        break;
        case 'personal_parking':
            $ret = "linekey.".$key.".type = 56".
            "\nlinekey.".$key.".line = 1".
            "\nlinekey.".$key.".value = ".$kind['value'].
            "\nlinekey.".$key.".label = "._("Pers. Park").
            "\nlinekey.".$key.".extension = %NULL%".
            "\nlinekey.".$key.".pickup_value = %NULL%\n";
        break;
    }

return($ret);
}

function check_yealink_firmware($agent, $phone_type) {

global $debug, $mac;

    error_log(__FILE__.":".__LINE__." $agent, $mac, $phone_type");
    global $debug; $debug[] = array(level=>'v',status=>'info',file=>__FILE__.":".__LINE__,log=>" $agent, $mac, $phone_type");
    switch ($phone_type) {
        case 'yealinksip-t19p':
        case 'yealinksip-t21p':
        case 'yealinksip-t22p':
        case 'yealinksip-t23p':
        case 'yealinksip-t26p':
        case 'yealinksip-t28p':
        if (strpos($agent,"") == false) {
            $firmware_url="http://".$_SERVER['HTTP_HOST']."/provisioner/prov/yealink/firmware/".$file;
        } break;
        case 'yealinksip-t32g':
        case 'yealinksip-t38g':
        case 'yealinksip-t41g':
        case 'yealinksip-t42g':
        if (strpos($agent,"") == false) {
            $firmware_url="http://".$_SERVER['HTTP_HOST']."/provisioner/prov/yealink/firmware/".$file;
        } break;
        case 'yealinksip-t46g':
        case 'yealinksip-t46g-1':
        case 'yealinksip-t46g-2':
        if (strpos($agent,"") == false) {
            $firmware_url="http://".$_SERVER['HTTP_HOST']."/provisioner/prov/yealink/firmware/".$file;
        } break;
        case 'yealinksip-t48g':
        case 'yealinksip-t48g-1':
        case 'yealinksip-t48g-2':
        if (strpos($agent,"") == false) {
            $firmware_url="http://".$_SERVER['HTTP_HOST']."/provisioner/prov/yealink/firmware/".$file;
        } break;
    }

    if($upd == true) {
        echo "#!version:1.0.0.1\nfirmware.url = ".$firmware_url;
        return(false);
    }
    return(true);
}

?>