<?php
error_reporting(1);

function generate_snom_provision($phone_data) {

global $HTTP;

//print_r($phone_data);
    $generator = $phone_data['template']->pvt_generator;
    $VM_EXT = "*98";
    $XML_SERVER = $HTTP.$_SERVER['HTTP_HOST']."/provisioner/prov/snom/";
    $WEB_SERVER = $HTTP.$_SERVER['HTTP_HOST'];
    $PROV_SERVER = $_SERVER['HTTP_HOST'];
    $NTP_SERVER = 'ntp.snom.com';
    $PROXY_SERVER = $phone_data['account'][$account]['realm'].':5060';
    $REGISTRAR_SERVER = $phone_data['account'][$account]['realm'].':5060';
    if($Phone_Reregister_Prov == false) $Phone_Reregister_Prov = 360;

    unset($adda); unset($addb);
    ($phone_data['users'][0][$phone_data['prov'][0]['owner']]['value']['language']) ? $language = $phone_data['users'][0][$phone_data['prov'][0]['owner']]['value']['language'] : $language = $phone_data['account'][$account]['language'];
    ($phone_data['users'][0][$phone_data['prov'][0]['owner']]['value']['timezone']) ? $timezone = $phone_data['users'][0][$phone_data['prov'][0]['owner']]['value']['timezone'] : $timezone = $phone_data['account'][$account]['timezone'];

    switch($timezone) {
           case 'Europe/London':
                        $lang_idx="English"; $lang_code="en"; $tone = "GBR"; $timezone_idx = "GBR0"; break;
           case 'America/Los_Angeles':
                        $lang_idx="English"; $lang_code="en"; $tone = "USA"; $timezone_idx = "USA10"; break;
           case 'America/Boston':
           case 'America/New_York':
                        $lang_idx="English"; $lang_code="en"; $tone = "USA"; $timezone_idx = "USA9"; break;
           case 'Europe/Copenhagen':
                        $lang_idx="Dansk"; $lang_code="dk"; $tone = "DNK"; $timezone_idx = "DNK+1"; break;
           case 'Europe/Berlin':
                        $lang_idx="Deutsch"; $lang_code="de"; $tone = "GER"; $timezone_idx = "GER+1"; break;
           case 'Europe/Bern':
           case 'Europe/Zurich':
                        $lang_idx="Deutsch"; $lang_code="de"; $tone = "SWI"; $timezone_idx = "CHE+1"; break;
           case 'Europe/Paris':
                        $lang_idx="France"; $lang_code="fr"; $tone = "FRA"; $timezone_idx = "FRA+1";  break;
           case 'Europe/Geneva':
                        $lang_idx="France"; $lang_code="fr"; $tone = "SWI"; $timezone_idx = "CHE+1";  break;
           case 'Europe/Rom':
                        $lang_idx="Italian"; $lang_code="it"; $tone = "ITA"; $timezone_idx = "ITA+1"; break;
           default; $lang_idx="English"; $lang_code="en"; $tone = "USA"; $timezone_idx = "GBR0";
           

    }
    switch($language) {
           case 'en-UK':
           case 'en-US':
                        $lang_idx="English"; $lang_code="en"; break;
           case 'dk-DK':
                        $lang_idx="Dansk"; $lang_code="dk"; break;
           case 'de-DE':
                        $lang_idx="Deutsch"; $lang_code="de"; break;
           case 'fr-FR':
                        $lang_idx="France"; $lang_code="fr";  break;
           case 'it-IT':
                 $lang_idx="Italian"; $lang_code="it"; break;
    }

    // code ersetzten und per ip zeitzone definieren fuer telefon config
    if($phone_data['template']->endpoint_family == 'm9x') {
     switch($timezone) {
       case 'au': $timezoneidv9="355"; $tonesv9="13"; break;
       case 'be': $timezoneidv9="355"; $tonesv9="3"; break;
       case 'Europe/Copenhagen':
       case 'dk': $timezoneidv9="355"; $tonesv9="3"; break;
       case 'Europe/Berlin':
            $timezoneidv9="355"; $tonesv9="3"; break;
       case 'es': $timezoneidv9="355"; $tonesv9="3"; break;
       case 'fr': $timezoneidv9="2"; $tonesv9="12"; break;
       case 'ir': $timezoneidv9="355"; $tonesv9="3"; break;
       case 'Europe/Rom':
            $timezoneidv9="342"; $tonesv9="11"; break;
       case 'lx': $timezoneidv9="355"; $tonesv9="3"; break;
       case 'nl': $timezoneidv9="355"; $tonesv9="5"; break;
       case 'pt': $timezoneidv9="355"; $tonesv9="3"; break;
       case 'Europe/Bern':
       case 'Europe/Zurich':
                $timezoneidv9="355"; $tonesv9="3"; break;
       case 'uk': $timezoneidv9="355"; $tonesv9="2"; break;
       case 'Europe/London':
       case 'America/Boston':
                $timezoneidv9="355"; $tonesv9="1"; break;
       case 'at': $timezoneidv9="355"; $tonesv9="4"; break;
       default: $timezoneidv9="355"; $tonesv9="3";
     }
    }

    if($phone_data['template']->endpoint_family == 'm3x') {
        switch($lang_code) {
           case 'au': $countryid="0x13"; break;
           case 'be': $countryid="0x0E"; break;
           case 'dk': $countryid="9"; break;
           case 'de': $countryid="0"; break;
           case 'es': $countryid="8"; break;
           case 'fr': $countryid="2"; break;
           case 'ir': $countryid="6"; break;
           case 'it': $countryid="3"; break;
           case 'lx': $countryid="1"; break;
           case 'nl': $countryid="4"; break;
           case 'pt': $countryid="0x0d"; break;
           case 'ch': $countryid="0x0c"; break;
           case 'uk': $countryid="0x10"; break;
           case 'us': $countryid="0x12"; break;
           case 'at': $countryid="0x0F"; break;
           default: $countryid="0x12";
        }
    $NTP_SERVER = "188.40.67.131";
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
        '{{STATUS}}',
        '{{PROVPASS}}',
        '{{LANG_PREFIX}}',
        '{{TONES_IDX}}',
        '{{TIMEZONE_PREFIX}}',
        '{{TIMEZONE_ID}}',
        '{{MAC}}',
        '{{NAME}}',
        '{{NTP_SERVER}}',
        '{{INTERNAL}}',
        '{{ACCESSPROVPASS}}',
        '{{SETTINGS_REFRSH_TIMER}}',
        '{{PHONE_REREGISTER}}',
        '{{PROV_PHONE_USER}}',
        '{{PROV_PHONE_PASS}}',
        '{{SRTP}}',
        '{{ADVERTISEMNT_URL}}',
        '{{PS_ACTION}}',
        '{{DND_ACTION}}',
        '{{EMERGENCY_NUMS}}',
        '{{PROV_SERVER_URL_CERTIFICATE}}',
        '{{SETTING_SERVER}}',
        '{{SETTINGS_REFRESH_TIMER}}',
        '{{ACCOUNT_2}}',
        '{{PROXY_PORT}}',
        '{{COUNTRYID_M3}}',
        '{{PROV_SERVER}}',
        '{{SUBSCRIPT_REREGISTER}}',
        '{{DIALTONE_SETTING}}',
        '{{ADVERTISEMENT_URL}}',
        '{{TIMEZONE_IDX}}',
        '{{TX}}',
        '{{RX}}',
        );
    // create account part
    $account = $phone_data['template']->usr_keys->setable_phone_key_counter;
    $account_start = $phone_data['template']->pvt_configs->account_counter;
//print_r( $phone_data['template']);
    $account_counter = 0;
    if($phone_data['template']->endpoint_family != 'm3x')
    $output .= '<?xml version="1.0" encoding="UTF-8"?>'."\n<settings>\n".$adda;
//    if(is_array($phone_data['number'])) {
        $multiaccount = true;
//print_r($phone_data['users'][$account_counter][$phone_data['prov'][$account_counter]['owner']]);
        foreach ($phone_data['prov'] as $k => $value) {
          if(! is_numeric($k)) continue;
          $read = $generator($phone_data['template']->cfg_account, 'settings');
          $srtp = "off";
//          if($value->media->encryption->enforce_security->methods[0]) { $PROXY_SERVER = $phone_data['voipserver'].":".($phone_data['port']+1).";transport=tls"; $value->media->encryption->enforce_security->methods[0] = "on"; }
//print_r($value);
          if($read) {
                $replace = array(
                $account_start,
                $value['sip']['username'],                                                 /*   */
                $value['sip']['password'],                                                 /*   */
                $phone_data['users'][$account_counter][$phone_data['prov'][$account_counter]['owner']]['key'],
                $phone_data['users'][$account_counter][$phone_data['prov'][$account_counter]['owner']]['key'],
                $phone_data['account'][$account_counter]['realm'],                               /*   */
                $phone_data['account'][$account_counter]['realm'],                               /*   */
                $WEB_SERVER,                                                               /*   */
                $lang_idx,                                                                 /*   */
                $VM_EXT,                                                                   /*   */
                _("Logout"),
                _("Forward"),
                _("DND"),
                _("Voicemail"),
                _("Phonebook"),
                _("At Transfer"),
                $program_settings['atxfer_code'],                                          /*   */
                _("Blind Tansfer"),                                                        /*   */
                '**',                                                                      /*   */
                'on',                                                                      /*   */
                $phone_data['account'][$account_counter]['provision']['provisionpass'],          /*   */
                $lang_code,                                                                /*   */
                $tonesv9,                                                                  /*   */
                $lang_idx,                                                                 /*   */
                $timezoneidv9,                                                             /*   */
                $value['macaddress'],                                                      /*   */
                $value['callername'],                                                      /*   */
                $NTP_SERVER,                                                               /*   */
                $phone_data['users'][$account_counter][$phone_data['prov'][$account_counter]['owner']]['value']['presence_id'],    /* internal number  */
                'accessprovpass',                                                          /*   */
                '0',                                                                       /* refresh config from server in seconds  */
                $Phone_Reregister_Prov,                                                    /*   */
                $phone_data['account'][$account]['provision']['provisionuser'],            /*   */
                $phone_data['account'][$account]['provision']['provisionpass'],            /*   */
                $srtp,                                                                     /* srtp (on/off) */
                $phone_data['whitelabel']['provision']['advertisement_url'],               /* advertisement http path */
                $XML_SERVER."ps.php",                                                      /* Presence button action path  */
                $XML_SERVER."dnd.php",                                                     /* DND button action path  */
                '110 112 911',                                                             /* emergency numbers */
                $phone_data['whitelabel']['provision']['server_url_certificate'],          /* certification path */
                $WEB_SERVER."/provisioner/prov/snom/settings.php?mac={mac}&pass=".$phone_data['account'][$account_counter]['provision']['urlpass'],                                                            /* provisions server path */
                '0',                                                                         /* refresh timer for settings (only at startup!! because of wrong settings) */
                $account,                                                                  /* Handset account number */
                '5060',                                                                    /* Port of Enduser phone */
                $countryid,                                                                /* Snom M3 Country code */
                $PROV_SERVER,                                                              /* prov server: eg. prov.allip.ovh */
                $Phone_Reregister_Prov,                                                                     /* key reregister after 600s */
                $tone,                                                                     /* dialtone settings SWI GRB .. */
                $WEB_SERVER."/advertisement/snom.php",                                     /* ADVERTISEMENT_URL .. */
                $timezone_idx,                                                             /* timezone snom */
                round((9+$value['media']['audio']['tx_volume'])*(8-1)/(15-2)),             /* audio tx snom */
                round((9+$value['media']['audio']['rx_volume'])*(8-1)/(15-2)),             /* audio rx snom */
                );
            $output .= preg_replace($search, $replace, $read);
          }
        $account_counter++;
        $account_start++;
        }
    // base settings
    $read = $generator($phone_data['template']->cfg_base, 'settings');
    if($read) {
        $output .= "".@preg_replace($search, $replace, $read);
    }

    // behavior settings
    $read = $generator($phone_data['template']->cfg_behavior, 'settings');
    if($read) {
        $output .= "".@preg_replace($search, $replace, $read);
    }

    // tone settings
    $read = $generator($phone_data['template']->cfg_tone, 'settings');
    if($read) {
        $output .= "".@preg_replace($search, $replace, $read);
    }

    $account = 0;
    // keys settings
    $read = $generator($phone_data, 'usrkeys', $account);
    if($read) $output .= "".$read;

    // pbook settings
    $read = $generator($phone_data, 'usrpbook', $account);
    if($read) $output .= "".$read;

return $output;
}

/* generate xml string for settings
*  obj_datas = object or array of hole or part of provisions data
*/
function json2xml($obj_datas, $type=false, $account=false)
{

    switch($type) {
        case 'usrkeys':
            // write keysettings to expansions module
            $expm = explode("-",$obj_datas['prov'][0]['provision']['endpoint_model']);
            $module = '0';
            foreach ($obj_datas['prov'][0]['provision']['feature_keys'] AS $key => $kind) {
                    /* we support 1 or 2 expansions modules */ if ($expm[1] == 2 && $key > 36) { $keydiff = -36; $module=1; }
                    $xml_keys .= write_xml_keys($kind, $module, ($key - $keydiff), $obj_datas, $account);
            }
            return("<functionKeys>\n".$xml_keys."</functionKeys>\n");
        break;
        case 'usrpbook':
            // write keysettings to expansions module
            $expm = explode("-",$obj_datas['prov'][0]['provision']['endpoint_model']);
            if ($expm[1] == true) { $module = '0';
                foreach ($obj_datas['prov'][0]['provision']['feature_keys'] AS $key => $kind) {
                    /* we support 1 or 2 expansions modules */ if ($expm[1] == 2 && $key > 36) { $keydiff = -36; $module=1; }
                    $xml_pbook .= write_xml_keys($kind, $module, ($key - $keydiff), $obj_datas);
                }
            }
            return("<tbook e=\"2\">\n".$xml_pbook."</tbook>\n".'</settings>'."\n");
        break;
        case 'settings':
            $array = json_decode(json_encode($obj_datas), true);
            //$array = XML2Array::createArray($xml);
            $xml = Array2XML::createXML('settings', $array);
            $str = $xml->saveXML($xml->documentElement);$str = substr($str, (strpos($str, "\n")+1));$str = substr($str, 0, strrpos($str, "\n"));
//echo $str;
//exit;
        return($str."\n");
        break;
    }
}
/* write_xml_keys kind = typ (presence, speed_dial, ... ) and value , expm=1, key=1, obj_data=array of prov
*/
function write_xml_keys($kind, $expm, $key, $obj_datas, $account)
{
//print_r($obj_datas['users'][0][$kind['value']]['value']);
//print_r($obj_datas['users'][$account][$kind['value']]['value']);

    switch($kind['type']) {
        case 'presence':
            $ret = '<fkey idx="'.$key.'" context="active" label="'.$obj_datas['users'][0][$kind['value']]['value']['last_name'].
            '" perm="RW">dest &lt;sip:'.$obj_datas['users'][0][$kind['value']]['value']['presence_id'].'@'.$obj_datas['account'][$account]['realm'].';user=phone&gt;|*8</fkey>'."\n";
        break;
        case 'speed_dial':
            $ret = '<fkey idx="'.$key.'" context="active" label="'._("Speeddial").'" perm="RW">dest '.$kind['value'].'</fkey>'."\n";
        break;
        case 'parking':
            $ret = '<fkey idx="'.$key.'" context="active" label="'._("Parking").'" perm="RW">orbit '.$kind['value'].'</fkey>'."\n";
        break;
        case 'personal_parking':
            $ret = '<fkey idx="'.$key.'" context="active" label="'._("My PArking").'" perm="RW">orbit '.$kind['value'].'</fkey>'."\n";
        break;
    }

return($ret);
}

function check_snomphone_type($agent) {

global $debug, $mac;

    $phone_type = "snom";
    if (strpos($agent,"snom300")){
      $phone_type = "snom300";
    } else if (strpos($agent,"snom320")){
      $phone_type = "snom320";
    } else if (strpos($agent,"snom360")){
      $phone_type = "snom360";
    } else if (strpos($agent,"snom370")){
      $phone_type = "snom370";
    } else if (strpos($agent,"snom720")){
      $phone_type = "snom720";
    } else if (strpos($agent,"snom760")){
      $phone_type = "snom760";
    } else if (strpos($agent,"snom820")){
      $phone_type = "snom820";
    } else if (strpos($agent,"snom870")){
      $phone_type = "snom870";
    } else if (strpos($agent,"snom-m3")){
      $phone_type = "snomm3";
    } else if (strpos($agent," m9 ")){
      $phone_type = "snomm9";
    }
    global $debug; $debug[] = array(level=>'v',status=>'info',file=>__FILE__.":".__LINE__,log=>"$agent, $mac, $phone_type");
return($phone_type);
}

function check_snom_firmware($agent, $phone_type) {

global $debug, $mac;


    error_log(__FILE__.":".__LINE__." $agent, $mac, $phone_type");
    global $debug; $debug[] = array(level=>'v',status=>'info',file=>__FILE__.":".__LINE__,log=>" $agent, $mac, $phone_type");
    switch ($phone_type) {
        case "snom300":
        if (strpos($agent,"8.7.5.13") == false) {
          $firmware_status="http://".$_SERVER['HTTP_HOST']."/provisioner/prov/snom/firmware/firmware.php?mac=".$mac;
          echo("<html lang=\"en\">\n");
          echo("<pre>\n");
          echo("update_policy\$: auto_update\n");
          echo("pnp_config\$: off\n");
          echo("firmware_status: ".$firmware_status."\n");
          echo("</pre>\n");
          echo("</html>\n");
          show_debug();
          exit;
        }
    break;

        case "snom320":
        case "snom360":
        case "snom370":

        if (strpos($agent,"8.7.3.25") == false) {
          $firmware_status="http://".$_SERVER['HTTP_HOST']."/provisioner/prov/snom/firmware/firmware.php?mac=".$mac;
          echo("<html lang=\"en\">\n");
          echo("<pre>\n");
          echo("update_policy\$: auto_update\n");
          echo("pnp_config\$: off\n");
          echo("firmware_status: ".$firmware_status."\n");
          echo("</pre>\n");
          echo("</html>\n");
          show_debug();
          exit;
        }
    break;

    case "snom720":

    if (strpos($agent,"8.7.5.13") == false) {
              $firmware_status="http://".$_SERVER['HTTP_HOST']."/provisioner/prov/snom/firmware/firmware.php?mac=".$mac;
      echo("<html lang=\"en\">\n");
              echo("<pre>\n");
      echo("update_policy\$: auto_update\n");
              echo("pnp_config\$: off\n");
      echo("firmware_status: ".$firmware_status."\n");
              echo("</pre>\n");
      echo("</html>\n");
      show_debug();
      exit;
    }
    break;

    case "snom760":

    if (strpos($agent,"8.7.5.13") == false) {
              $firmware_status="http://".$_SERVER['HTTP_HOST']."/provisioner/prov/snom/firmware/firmware.php?mac=".$mac;
      echo("<html lang=\"en\">\n");
              echo("<pre>\n");
      echo("update_policy\$: auto_update\n");
          echo("pnp_config\$: off\n");
      echo("firmware_status: ".$firmware_status."\n");
              echo("</pre>\n");
      echo("</html>\n");
      show_debug();
      exit;
    }
    break;

    case "snom820":

    if (strpos($agent,"8.7.3.25") == false) {
              $firmware_status="http://".$_SERVER['HTTP_HOST']."/provisioner/prov/snom/firmware/firmware.php?mac=".$mac;
      echo("<html lang=\"en\">\n");
              echo("<pre>\n");
      echo("update_policy\$: auto_update\n");
              echo("pnp_config\$: off\n");
      echo("firmware_status: ".$firmware_status."\n");
              echo("</pre>\n");
      echo("</html>\n");
      show_debug();
      exit;
    }
    break;

    case "snom870":

    if (strpos($agent,"8.7.3.25") == false) {
              $firmware_status="http://".$_SERVER['HTTP_HOST']."/provisioner/prov/snom/firmware/firmware.php?mac=".$mac;
      echo("<html lang=\"en\">\n");
              echo("<pre>\n");
      echo("update_policy\$: auto_update\n");
              echo("pnp_config\$: off\n");
      echo("firmware_status: ".$firmware_status."\n");
              echo("</pre>\n");
      echo("</html>\n");
      show_debug();
      exit;
    }
    break;

    case "snomMP":

    if (strpos($agent,"8.7.3.25") == false) {
              $firmware_status="http://".$_SERVER['HTTP_HOST']."/provisioner/prov/snom/firmware/firmware.php?mac=".$mac;
      echo("<html lang=\"en\">\n");
              echo("<pre>\n");
      echo("update_policy\$: auto_update\n");
              echo("pnp_config\$: off\n");
      echo("firmware_status: ".$firmware_status."\n");
              echo("</pre>\n");
      echo("</html>\n");
      show_debug();
      exit;
    }
    break;

    // checkaddphone for needed firmwareupdate
    case "snomm9":

    if (strpos($agent,"9.6.2-a") == false) {
              $firmware_status="http://".$_SERVER['HTTP_HOST']."/provisioner/prov/snom/firmware/m9-9.6.2-a.bin";
      echo('<?xml version="1.0" encoding="utf-8"?>'."\n");
      echo("<firmware-settings>\n");
      echo("<firmware>".$firmware_status."</firmware>\n");
      echo("</firmware-settings>\n");
      show_debug();
      exit;
    }
    break;
    }
//    return $phone_type;
}

function snom_decode_HTTP_header()
{
  if($_REQUEST['user_agent'] != false)
    $user_agent = $_REQUEST['user_agent'];
  else
    $user_agent=$_SERVER["HTTP_USER_AGENT"];

  if(strpos($user_agent,"snom-m3")) {
    $value=preg_split("/ /",$user_agent);
    $u_agent=preg_split("/-/",$value[0]);
    $value[0] = $u_agent[0].$u_agent[1];
  } elseif(strpos($user_agent,"snom")) {
    $value=preg_split("/ /",$user_agent);
    $u_agent=preg_split("/-/",$value[2]);
    $value[0] = $u_agent[0];
  } else {
    $value[0]="MSIE";
    $value[1]="NA";
    $value[2]="NA";
  }
  $value[3]=$_SERVER["REMOTE_ADDR"];
  $val="(0=>".$value[0]." 1=>".$value[1]." 2=>".$value[2]." 3=>".$value[3];
  global $debug; $debug[] = array(level=>'v',status=>'info',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .")  $val");
return($value);
}

function generate_firmware_settings($type, $appl, $rtfs, $lnx, $v7, $dir) {

  if (!empty($dir)) {
    $firmware_url="http://".$_SERVER['HTTP_HOST']."/provisioner/prov/snom/firmware/".$dir."/".$type."-";
  } else {
    $firmware_url="http://".$_SERVER['HTTP_HOST']."/provisioner/prov/snom/firmware/".$type."-";
  }

  if (!empty($v7)) {
    if (!empty($appl)) {
      $firmware_url=$firmware_url.$appl."f.bin";
    } else {
      unset($firmware_url);
    }
  } else {
    if (!empty($appl)) {
      $firmware_url=$firmware_url.$appl."-SIP-j.bin";
    } else if (!empty($rtfs)) {
      $firmware_url=$firmware_url.$rtfs;
    } else if (!empty($lnx)) {
      $firmware_url=$firmware_url.$lnx."-l.bin";
    } else {
      unset($firmware_url);
    }
  }

    switch ($type) {
      case "m9":
        readfile($type."-".$rtfs);
      break;
      default:
      if (!empty($firmware_url)){
        echo("<html lang=\"en\">\n");
        echo("<pre>\n");
        echo("firmware: ".$firmware_url."\n");
        echo("</pre>\n");
        echo("</html>\n");
        {global $debug; $debug[] = array(level=>'v',status=>'info',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '." firmware_url=$firmware_url");}
    }
  }
}

?>