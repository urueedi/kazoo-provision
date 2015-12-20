#!/usr/bin/php
<?php

require_once('config.php');

echo "$hosts";
$host = get_dbhost($hosts);
$sag = new Sag($host);

function input()
{
    $stdin = fopen('php://stdin', 'r');
    $resp = fgetc($stdin);

return($resp);
}
echo "HAVE YOU set config in hosts? !!!!!\n";
echo "brand_provisioner install file -> couchdb on $hosts (only 1)? Y/N ";$resp = input();if($resp == 'Y') {restore('brand_provisioner', 'DB_INSTALL/brand_provisioner/'); restore('system_config', 'DB_INSTALL/system_config/');}
echo "brand_provisioner restore from couchdb -> file ? Y/N ";$resp = input();if($resp == 'Y') {backup('brand_provisioner', 'DB_INSTALL/brand_provisioner/', false); backup('system_config', 'DB_INSTALL/system_config/', 'crossbar.devices');}
sleep(2);

?>
