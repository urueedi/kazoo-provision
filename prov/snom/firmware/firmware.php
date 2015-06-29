<?php 

// Copyright (C) 2009 FreePBX-Swiss Urs Rueedi
include_once("../../../config.php");

global $debug;

$agent = $_SERVER['HTTP_USER_AGENT'];

//$agent = "Mozilla/4.0 (compatible; snom m9 9.1.43)";
$info = explode(';', $agent);

$is_snom370 = true;
$our_dir="";
$latest_major_version = '6';
$latest_version = "6.5.20";
$latest_v7_version = "8.2.35";
$latest_v7_bf_version = "7.3.14";
$latest_370_major_version = '7';
$latest_370_version = "8.7.3.25";
$latest_linux = "3.38";
$latest_300 = "8.7.5.13";
$latest_320 = "8.7.3.25";
$latest_360 = "8.7.3.25";
$latest_370 = "8.7.3.25";
$latest_720 = "8.7.5.17";
$latest_760 = "8.7.5.17";
$latest_820 = "8.7.3.25";
$latest_870 = "8.7.3.25";
$latest_MP = "8.7.3.25";
$latest_m9 = "9.6.2-a";

if($_REQUEST['phonetyp'] != '') {
    $phone_type = $_REQUEST['phonetyp'];
    $mac = $_REQUEST['mac'];
} else {
    define(DEBUG_FUNCTION,false);
    $phone_type = check_snomphone_type($agent);
    $mac = $_REQUEST['mac'];
}

{ $debug[] = array(level=>'d',status=>'info',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') phone_type='. $phone_type. ' MAC='.$mac);}
foreach ($info as $key => $value) {
  $application = strstr($value, $phone_type.'-SIP ');
  $rootfs_jffs2 = strstr($value, ' jffs2 v');
  $rootfs_ramdisk = strstr($value, 'ramdisk');
  $linux = strstr($value, $phone_type.' linux ');

  unset($version7);
  unset($download_dir);

  if (!empty($application)) {
    if ($application[strlen($application)-1] == ")") {
      $application = substr($application, 12, -1);
    } else {
      $application = substr($application, 12);
    }

    if (empty($is_snom370)) {
      if ($application[0] < '5') {
        $new_application = "5.5a";
      } else if ($application[0] < $latest_major_version || 
                 ($application[0] == $latest_major_version && strcmp($application, $latest_version)!=0)) {
        $new_application = $latest_version;
        $download_dir = $our_dir;
      } else if ($application[0] == "7" && strcmp($application, $latest_v7_version)!=0) {
        $new_application = $latest_v7_version.'-SIP-';
        $download_dir = $our_dir;
        $version7=1;
      } else {
        unset($new_application);
        $appl_ok = true;
      }
    } else if (!empty($is_snom370)) {
      if ($application[0] < $latest_370_major_version || 
          ($application[0] == $latest_370_major_version && strcmp($application, $latest_370_version)!=0)) {
        $new_application = $latest_370_version;
      }
    }
  } else {
    unset($new_application);
  }

  if (!empty($new_application)) {
    generate_firmware_settings($phone_type, $new_application, $new_rootfs, $new_linux, $version7, $download_dir);
    show_debug();
    exit(0);
  }

  if (!empty($rootfs_ramdisk)){
    $new_rootfs = "ramdiskToJffs2-3.36-br.bin";
  } else if (!empty($rootfs_jffs2)){
    $rootfs_jffs2 = substr($rootfs_jffs2, 8);
    if (strcmp($rootfs_jffs2, "3.36") != 0 && strcmp($rootfs_jffs2, "3.37") != 0) {
      $new_rootfs = "ramdiskToJffs2-3.36-br.bin";
    } else {
      unset($new_rootfs);
      $rootfs_ok = true;
    }
  } else {
    unset($new_rootfs);
  }

  if (!empty($new_rootfs)) {
    generate_firmware_settings($phone_type, $new_application, $new_rootfs, $new_linux, $version7, $download_dir);
    show_debug();
    exit(0);
  }

  if (!empty($linux)) {
    $linux = substr($linux, 14, -1);

      if (strcmp($linux, $latest_linux) != 0) {
        $new_linux = $latest_linux;
        $download_dir = $our_dir;
      } else {
        unset($new_linux);
        $linux_ok = true;
      }
  } else {
    unset($new_linux);
  }

  if (!empty($new_linux)) {
    generate_firmware_settings($phone_type, $new_application, $new_rootfs, $new_linux, $version7, $download_dir);
    show_debug();
    exit(0);
  }

  if (!empty($appl_ok) && !empty($rootfs_ok) && !empty($linux_ok)){
    $new_application = "from6to7-".$latest_v7_bf_version."-b";
    $version7 = "true";
    $download_dir = $our_dir;
    generate_firmware_settings($phone_type, $new_application, $new_rootfs, $new_linux, $version7, $download_dir);
    show_debug();
    exit(0);
  }
}

if ($phone_type == "snom300") {
        { $debug[] = array(level=>'d',status=>'info',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '.$phone_type."-".$latest_300.'-SIP-f.bin');}
        generate_firmware_settings('snom300', $appl=NULL, $latest_300.'-SIP-f.bin', $lnx=NULL, $v7=NULL, NULL);
} elseif ($phone_type == "snom320") {
        {$debug[] = array(level=>'d',status=>'info',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '.$phone_type."-".$latest_320.'-SIP-f.bin');}
        generate_firmware_settings('snom320', $appl=NULL, $latest_320.'-SIP-f.bin', $lnx=NULL, $v7=NULL, NULL);
} elseif ($phone_type == "snom360") {
        {$debug[] = array(level=>'d',status=>'info',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '.$new_application.".".$application);}
        generate_firmware_settings('snom360', $appl=NULL, $latest_360.'-SIP-f.bin', $lnx=NULL, $v7=NULL, NULL);
} elseif ($phone_type == "snom370") {
        {$debug[] = array(level=>'d',status=>'info',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '.$phone_type."-".$latest_370.'-SIP-f.bin');}
        generate_firmware_settings('snom370', $appl=NULL, $latest_370.'-SIP-f.bin', $lnx=NULL, $v7=NULL, NULL);
} elseif ($phone_type == "snom720") {
        {$debug[] = array(level=>'d',status=>'info',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '.$phone_type."-".$latest_720.'-SIP-r.bin');}
        generate_firmware_settings('snom720', $appl=NULL, $latest_720.'-SIP-r.bin', $lnx=NULL, $v7=NULL, NULL);
} elseif ($phone_type == "snom760") {
        {$debug[] = array(level=>'d',status=>'info',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '.$phone_type."-".$latest_760.'-SIP-r.bin');}
        generate_firmware_settings('snom760', $appl=NULL, $latest_760.'-SIP-r.bin', $lnx=NULL, $v7=NULL, NULL);
} elseif ($phone_type == "snom820") {
        {$debug[] = array(level=>'d',status=>'info',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '.$phone_type."-".$latest_820.'-SIP-r.bin');}
        generate_firmware_settings('snom820', $appl=NULL, $latest_820.'-SIP-r.bin', $lnx=NULL, $v7=NULL, NULL);
} elseif ($phone_type == "snom870") {
        {$debug[] = array(level=>'d',status=>'info',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '.$phone_type."-".$latest_870.'-SIP-r.bin');}
        generate_firmware_settings('snom870', $appl=NULL, $latest_870.'-SIP-r.bin', $lnx=NULL, $v7=NULL, NULL);
} elseif ($phone_type == "snomMP") {
        {$debug[] = array(level=>'d',status=>'info',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '.$phone_type."-".$latest_MP.'-SIP-f.bin');}
        generate_firmware_settings('snomMP', $appl=NULL, $latest_MP.'-SIP-a.bin', $lnx=NULL, $v7=NULL, NULL);
} elseif ($phone_type == "snomm9") {
        {$debug[] = array(level=>'d',status=>'info',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '.$phone_type."-".$latest_m9.'.bin');}
        generate_firmware_settings('m9', $appl=NULL, $latest_m9.'.bin', $lnx=NULL, $v7=NULL, NULL);
} else {$debug[] = array(level=>'d',status=>'info',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '.$phone_type."-(not supported) ".$latest_m9.'.bin');}

show_debug();
?>