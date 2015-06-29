<?php 

// Copyright (C) 2009 FreePBX-Swiss Urs Rueedi

function generate_settings($type, $appl, $rtfs, $lnx, $v7, $dir) {

  if (!empty($dir)) {
    $firmware_url="http://".$_SERVER['HTTP_HOST']."/prov/snom/firmware/".$dir."/".$type."-";
  } else {
    $firmware_url="http://".$_SERVER['HTTP_HOST']."/prov/snom/firmware/".$type."-";
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
	    //error_log("$firmware_url",3,"error.txt");
    }
  }
}

$agent = $_SERVER['HTTP_USER_AGENT'];

//$agent = "Mozilla/4.0 (compatible; snom m9 9.1.43)";
$info = explode(';', $agent);

$phone_type = "snom";
$is_snom370 = true;

$our_dir="";

$latest_major_version = '6';
$latest_version = "6.5.20";
$latest_v7_version = "8.2.35";
$latest_v7_bf_version = "7.3.14";
$latest_370_major_version = '7';
$latest_370_version = "8.4.32";
$latest_linux = "3.38";
$latest_300 = "8.4.32";
$latest_320 = "8.4.32";
$latest_360 = "8.4.32";
$latest_370 = "8.4.32";
$latest_720 = "8.4.2.9";
$latest_760 = "8.7.2.9";
$latest_820 = "8.4.32";
$latest_870 = "8.4.32";
$latest_MP = "8.4.32";
$latest_m9 = "9.5.14-a";

if (preg_match("/snom300/",$agent)){
  $phone_type = "snom300";
  unset($is_snom370);
} else if (preg_match("/snom320/",$agent)){
  $phone_type = "snom320";
  unset($is_snom370);
} else if (preg_match("/snom360/",$agent)){
  $phone_type = "snom360";
  unset($is_snom370);
} else if (preg_match("/snom370/",$agent)){
  $phone_type = "snom370";
  unset($is_snom370);
} else if (preg_match("/snom720/",$agent)){
  $phone_type = "snom720";
  unset($is_snom370);
} else if (preg_match("/snom760/",$agent)){
  $phone_type = "snom760";
  unset($is_snom370);
} else if (preg_match("/snom820/",$agent)){
  $phone_type = "snom820";
  unset($is_snom370);
} else if (preg_match("/snom870/",$agent)){
  $phone_type = "snom870";
  unset($is_snom370);
} else if (preg_match("/snomMP/",$agent)){
  $phone_type = "snomMP";
  unset($is_snom370);
} else if (preg_match("/snom m9/",$agent)){
  $phone_type = "snomm9";
  unset($is_snom370);
}

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
    generate_settings($phone_type, $new_application, $new_rootfs, $new_linux, $version7, $download_dir);
    exit;
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
    generate_settings($phone_type, $new_application, $new_rootfs, $new_linux, $version7, $download_dir);
    exit;
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
    generate_settings($phone_type, $new_application, $new_rootfs, $new_linux, $version7, $download_dir);
    exit;
  }

  if (!empty($appl_ok) && !empty($rootfs_ok) && !empty($linux_ok)){
    $new_application = "from6to7-".$latest_v7_bf_version."-b";
    $version7 = "true";
    $download_dir = $our_dir;
    generate_settings($phone_type, $new_application, $new_rootfs, $new_linux, $version7, $download_dir);
  }

  if ($phone_type == "snom300") {
    if($debug) error_log($phone_type."-".$latest_300.'-SIP-f.bin'."\n",3,"log.txt");
    generate_settings('snom300', $appl=NULL, $latest_300.'-SIP-f.bin', $lnx=NULL, $v7=NULL, NULL);
    exit;
  }
  if ($phone_type == "snom320") {
    if($debug) error_log($phone_type."-".$latest_320.'-SIP-f.bin'."\n",3,"log.txt");
    generate_settings('snom320', $appl=NULL, $latest_320.'-SIP-f.bin', $lnx=NULL, $v7=NULL, NULL);
    exit;
  }
  if ($phone_type == "snom360") {
    if($debug) error_log($phone_type."-".$new_application.".".$application."\n",3,"log.txt");
    generate_settings('snom360', $appl=NULL, $latest_360.'-SIP-f.bin', $lnx=NULL, $v7=NULL, NULL);
    exit;
  }
  if ($phone_type == "snom370") {
    if($debug) error_log($phone_type."-".$latest_370.'-SIP-f.bin'."\n",3,"log.txt");
    generate_settings('snom370', $appl=NULL, $latest_370.'-SIP-f.bin', $lnx=NULL, $v7=NULL, NULL);
    exit;
  }
  if ($phone_type == "snom720") {
    if($debug) error_log($phone_type."-".$latest_720.'-SIP-r.bin'."\n",3,"log.txt");
    generate_settings('snom720', $appl=NULL, $latest_720.'-SIP-r.bin', $lnx=NULL, $v7=NULL, NULL);
    exit;
  }
  if ($phone_type == "snom760") {
    if($debug) error_log($phone_type."-".$latest_760.'-SIP-r.bin'."\n",3,"log.txt");
    generate_settings('snom760', $appl=NULL, $latest_760.'-SIP-r.bin', $lnx=NULL, $v7=NULL, NULL);
    exit;
  }
  if ($phone_type == "snom820") {
    if($debug) error_log($phone_type."-".$latest_820.'-SIP-r.bin'."\n",3,"log.txt");
    generate_settings('snom820', $appl=NULL, $latest_820.'-SIP-r.bin', $lnx=NULL, $v7=NULL, NULL);
    exit;
  }
  if ($phone_type == "snom870") {
    if($debug) error_log($phone_type."-".$latest_870.'-SIP-r.bin'."\n",3,"log.txt");
    generate_settings('snom870', $appl=NULL, $latest_870.'-SIP-r.bin', $lnx=NULL, $v7=NULL, NULL);
    exit;
  }
  if ($phone_type == "snomMP") {
    if($debug) error_log($phone_type."-".$latest_MP.'-SIP-a.bin'."\n",3,"log.txt");
    generate_settings('snomMP', $appl=NULL, $latest_MP.'-SIP-a.bin', $lnx=NULL, $v7=NULL, NULL);
    exit;
  }
  if ($phone_type == "snomm9") {
    if($debug) error_log($phone_type."-".$latest_m9.'.bin'."\n",3,"log.txt");
    generate_settings('m9', $appl=NULL, $latest_m9.'.bin', $lnx=NULL, $v7=NULL, NULL);
    exit;
  }
}
?>
