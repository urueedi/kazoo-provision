<?php
error_reporting(1);


function generate_mitel_provision($phone_data) {

    $account = $phone_data['template']->usr_keys->setable_phone_key_counter;
    $account_start = $phone_data['template']->pvt_counter;
    $generator = $phone_data['template']->pvt_generator;
    //print_r( $phone_data['template']);
    $account_counter = 0;
    $VM_EXT = "*98";
    $XML_SERVER = $HTTP.$_SERVER['HTTP_HOST']."/prov/mitel/";
    $WEB_SERVER = $HTTP.$_SERVER['HTTP_HOST'];
    $PROV_SERVER = $_SERVER['HTTP_HOST'];
    $NTP_SERVER = "pool.ntp.org";
    $PROXY_SERVER = $phone_data['account'][$account]['realm'];
    $REGISTRAR_SERVER = $phone_data['account'][$account]['realm'];
    if($Phone_Reregister_Prov == false) $Phone_Reregister_Prov = 360;
    ($phone_data['users'][0][$phone_data['prov'][0]['owner']]['value']['language']) ? $language = $phone_data['users'][0][$phone_data['prov'][0]['owner']]['value']['language'] : $language = $phone_data['account'][$account]['language'];
    ($phone_data['users'][0][$phone_data['prov'][0]['owner']]['value']['timezone']) ? $timezone = $phone_data['users'][0][$phone_data['prov'][0]['owner']]['value']['timezone'] : $timezone = $phone_data['account'][$account]['timezone'];

    switch($timezone) {
           case 'Europe/London':
                        $lang_idx=0; $lang_code="English"; $tone = "UK"; $timezone_idx = "UK"; break;
           case 'America/Los_Angeles':
                        $lang_idx=0; $lang_code="English"; $tone = "US"; $timezone_idx = "US"; break;
           case 'America/Boston':
           case 'America/New_York':
                        $lang_idx=0; $lang_code="English"; $tone = "US"; $timezone_idx = "US"; break;
           case 'America/Mexico':
                        $lang_idx=0; $lang_code="English"; $tone = "Mexico"; $timezone_idx = "Mexico"; break;
           case 'Asia/Singapure':
                        $lang_idx=0; $lang_code="English"; $tone = "Malaysia"; $timezone_idx = "Malaysia"; break;
           case 'Europe/Copenhagen':
                        $lang_idx=4; $lang_code="Dansk"; $tone = "UK"; $timezone_idx = "UK"; break;
           case 'Europe/Berlin':
                        $lang_idx=1; $lang_code="German"; $tone = "Germany"; $timezone_idx = "Germany"; break;
           case 'Europe/Bern':
           case 'Europe/Zurich':
                        $lang_idx=1; $lang_code="German"; $tone = "Europe"; $timezone_idx = "CH-Zurich"; break;
           case 'Europe/Paris':
                        $lang_idx=2; $lang_code="French"; $tone = "France"; $timezone_idx = "France";  break;
           case 'Europe/Geneva':
                        $lang_idx=2; $lang_code="French"; $tone = "Europe"; $timezone_idx = "Europe";  break;
           case 'Europe/Rom':
                        $lang_idx=3; $lang_code="Italiano"; $tone = "Italy"; $timezone_idx = "Ialy"; break;
           case 'Europe/Moskau':
                        $lang_idx=0; $lang_code="Russian"; $tone = "Russia"; $timezone_idx = "Russia"; break;
           default; $lang_idx=0; $lang_code="English"; $tone = "US"; $timezone_idx = "US";
    }

    switch($language) {
           case 'en-UK':
           case 'en-US':
                        $lang_idx=0; $lang_code="English"; break;
           case 'dk-DK':
                        $lang_idx=4; $lang_code="Dansk"; break;
           case 'de-DE':
                        $lang_idx=1; $lang_code="German"; break;
           case 'fr-FR':
                        $lang_idx=2; $lang_code="French";  break;
           case 'it-IT':
                        $lang_idx=3; $lang_code="Italiano"; break;
           case 'ru-RU':
                        $lang_idx=0; $lang_code="Russian"; break;
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
        '{{BAK_PROXY_SERVER}}',
        '{{BAK_REGISTRAR_SERVER}}',
        '{{CONFERENCE_LABEL}}',
        '{{PROXY_PORT}}',
        '{{HOST_TIMESERVER}}',
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
        '{{TONEZONE}}',
        '{{RX}}',
        '{{TX}}',
        '{{INPUT_LANG}}',
        '{{TIMEZONE}}',
        );
    // create account part
        $multiaccount = true;

//print_r($phone_data['account']);
        foreach ($phone_data['prov'] as $k => $value) {
          if(! is_numeric($k)) continue;
          $expm = $value['expm'];
          $device = $value['device'];
          $customersid = $value['cuid'];
          $read = $generator($phone_data['template']->cfg_account, 'settings', false, ":");
          if($read) {
//print_r($value);
//print_r($phone_data['users'][$account_counter][$phone_data['prov'][$account_counter]['owner']]);
//[$value['owner']]['key']
            $replace = array(
                    $account,
                    $value['sip']['username'],                                                 /*   */
                    $value['sip']['password'],                                                 /*   */
                    $value['sip']['username'],                                                 /*   */
//                    $phone_data['users'][$account_counter][$phone_data['prov'][$account_counter]['owner']]['value']['presence_id']." ".
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
                    $phone_data['prov'][0]['macaddress'],
                    $phone_data['users'][$account_counter][$phone_data['prov'][$account_counter]['owner']]['value']['presence_id'],
                    '5060',
                    $NTP_SERVER,
                    $phone_data['users'][$account_counter][$value['owner']]['value']['presence_id'],
                    $Phone_Reregister_Prov,
                    $Phone_Reregister_Prov,
                    $_SERVER['HTTP_HOST'],
                    $phone_data['account'][0]['provision']['provisionuser'],            /*   */
                    $phone_data['account'][0]['provision']['provisionpass'],            /*   */
                    '',
                    '',
                    '',
                    '',
                    $PROV_SERVER,
                    $tone,
                    round((9+$value['media']['audio']['tx_volume'])*(8-1)/(15-2)),             /* audio tx mitel */
                    round((9+$value['media']['audio']['rx_volume'])*(8-1)/(15-2)),             /* audio rx mitel */
                    $lang_code,
                    $timezone_idx,
                    );
              $output .= preg_replace($search, $replace, $read)."\n";
          }
        $account++;
        $account_counter++;
        $account_start++;
        }
    $read = $generator($phone_data['template']->cfg_behavior, 'settings', false, ":");
    if($read) {
          $output .= preg_replace($search, $replace, $read)."\n";
    }
    $read = $generator($phone_data['template']->cfg_tone, 'settings', false, ":");
    if($read) {
          $output .= preg_replace($search, $replace, $read, 'settings')."\n";
    }
    // if model have softkey prov it on phone
    if($phone_data['template']->usr_keys->setable_phone_keys >= count($phone_data['prov'][0]['provision']['feature_keys'])) {
        // create model spcification softkeys
        $read = $generator($phone_data, 'usrkeys', false, ': ', 'write_mitel_softkeys');
        if($read) $output .= "\n".$read;
    } else {
        // create model spcification pkeys
        $read = $generator($phone_data, 'usrkeys', false, ': ', 'write_mitel_keys');
        if($read) $output .= "\n".$read;
    }

return $output;
}

/* write_plain_keys kind = typ (presence, speed_dial, ... ) and value , expm=1, key=1, obj_data=array of prov */
function write_mitel_softkeys($kind, $expm, $key, $obj_datas, $account)
{

    switch($kind['type']) {
        case 'presence':
            $ret = "prgkey".$key." type: blf\nprgkey".$key." label: ".$obj_datas['users'][$account][$kind['value']]['value']['caller_id']['internal']['name'].
                "\nprgkey".$key." value: ".$obj_datas['users'][$account][$kind['value']]['value']['presence_id']."\nprgkey".$key." line: 0\n";
        break;
        case 'speed_dial':
            $ret = "prgkey".$key." type: speed_dial\nprgkey".$key." label: "._("Speeddial")."\nprgkey".$key." value: ".$kind['value'].
            "\nprgkey".$key." line: 0\n";
        break;
        case 'parking':
            $ret = "prgkey".$key." type: park\nprgkey".$key." label: "._("Parking")."\nprgkey".$key." value: ".$kind['value']."\nprgkey".$key." line: 0\n";
        break;
        case 'personal_parking':
            $ret = "prgkey".$key." type: blf\nprgkey".$key." label: "._("My Parking")."\nprogkey".$key." value: ".$kind['value']."\nprgkey".$key." line: 0\n";
        break;
    }

return($ret);
}

/* write_plain_keys kind = typ (presence, speed_dial, ... ) and value , expm=1, key=1, obj_data=array of prov
*/
function write_mitel_keys($kind, $expm, $key, $obj_datas, $account)
{

    switch($kind['type']) {
        case 'presence':
            $ret = "expmod".($expm+1)." key".$key." type: blf\nexpmod".($expm+1)." key".$key." label: ".$obj_datas['users'][$account][$kind['value']]['value']['caller_id']['internal']['name'].
                "\nexpmod".($expm+1)." key".$key." value: ".$obj_datas['users'][$account][$kind['value']]['value']['presence_id']."\nexpmod".($expm+1)." key".$key." line: 0\n";
        break;
        case 'speed_dial':
            $ret = "expmod".($expm+1)." key".$key." type: speed_dial\nexpmod".($expm+1)." key".$key." label: "._("Speeddial")."\nexpmod".($expm+1)." key".$key." value: ".$kind['value']."\nexpmod".($expm+1)." key".$key." line: 0\n";
        break;
        case 'parking':
            $ret = "expmod".($expm+1)." key".$key." type: park\nexpmod".($expm+1)." key".$key." label: "._("Parking")."\nexpmod".($expm+1)." key".$key." value: ".$kind['value']."\nexpmod".($expm+1)." key".$key." line: 0\n";
        break;
        case 'personal_parking':
            $ret = "expmod".($expm+1)." key".$key." type: blf\nexpmod".($expm+1)." key".$key." label: "._("My Parking")."\nexpmod".($expm+1)." key".$key." value: ".$kind['value']."\nexpmod".($expm+1)." key".$key." line: 0\n";
        break;
    }

return($ret);
}

?>