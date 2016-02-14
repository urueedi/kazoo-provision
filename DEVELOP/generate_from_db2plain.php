#!/usr/bin/php
<?php

require_once('../config.php');

$host = get_dbhost($hosts);
$sag = new Sag($host, $dbport);
$myip4 = get_ip(4);
$del = ":";

$phone_data = get_entry('brand_provisioner' , '/'.urlencode('ui/snom/m3x/m3'));
//print_r($phone_data);
//sleep(88);
$generator = $phone_data['res']->pvt_generator;
 
    // base settings
    $read = $generator($phone_data['res']->cfg_base, 'settings');
    if($read) {
        $output .= $read."\n 1. \n";
    }
    // behavior settings
    $read = $generator($phone_data['res']->cfg_account, 'settings');
    if($read) {
        $output .= $read."\n 2. \n";
    }
    // tone settings
    $read = $generator($phone_data['res']->cfg_tone, 'settings');
    if($read) {
        $output .= $read."\n 3. \n";
    }
    $account = 0;
    // keys settings
    $read = $generator($phone_data, 'usrkeys', $account);
    if($read) $output .= $read."\n 4. \n";

    // pbook settings
    $read = $generator($phone_data, 'usrpbook', $account);
    if($read) $output .= $read."\n 5. \n";


echo $output;
sleep(22);
?>