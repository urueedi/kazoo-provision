<?php
error_reporting(1);


function generate_mitel_provision($phone_data) {

    $account = $phone_data['template']->usr_keys->setable_phone_key_counter;
    $account_start = $phone_data['template']->pvt_configs->account_counter;
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
    switch($phone_data['shlang']) {
       case 'en':
           $lang_idx=2;
       break;
       case 'de':
           $lang_idx=1;
       break;
       case 'fr':
           $lang_idx=3;
       break;
       case 'it':
           $lang_idx=4;
       break;
       default:
           $lang_idx=1;
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
        );
    // create account part
        $multiaccount = true;

//print_r($phone_data['account']);
        foreach ($phone_data['prov'] as $k => $value) {
          if(! is_numeric($k)) continue;
          $expm = $value['expm'];
          $device = $value['device'];
          $customersid = $value['cuid'];
          $read = $generator($phone_data['template']->cfg_account, 'settings', false, ": ");
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
                    $XML_SERVER,
                    $phone_data['account'][$account]['provision']['provisionuser'],
                    $phone_data['account'][$account]['provision']['provisionpass'],
                    '',
                    '',
                    '',
                    '',
                    $PROV_SERVER,
                    );
              $output .= preg_replace($search, $replace, $read)."\n";
          }
        $account++;
        $account_counter++;
        $account_start++;
        }
      $read = $generator($phone_data['template']->cfg_behavior, 'settings', false, ": ");
      if($read) {
          $output .= preg_replace($search, $replace, $read)."\n";
    }
      $read = $generator($phone_data['template']->cfg_tone, 'settings', false, ": ");
      if($read) {
          $output .= preg_replace($search, $replace, $read, 'settings')."\n";
    }
      $read = $generator($phone_data['template']->cfg_keys, 'settings', false, ": ");
      if($read) {
          $output .= "\n".preg_replace($search, $replace, $read)."\n";
    }

    // create model spcification pkeys
    $read = $generator($phone_data, 'usrkeys', false, ': ', 'write_mitel_keys');
    if($read) $output .= "\n".$read;

return $output;
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