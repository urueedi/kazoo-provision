#!/usr/bin/php
<?php

require_once('config.php');

$host = get_dbhost($hosts);
$sag = new Sag($host);

function input()
{
    $stdin = fopen('php://stdin', 'r');
    $resp = fgetc($stdin);

return($resp);
}
echo "HAVE YOU set config in hosts? !!!!!\n";
echo "brand_provisioner install file -> couchdb on $hosts (only 1)? Y/N ";$resp = input();if($resp == 'Y') restore('brand_provisioner', 'DB_INSTALL/');
echo "brand_provisioner restore from couchdb -> file ? Y/N ";$resp = input();if($resp == 'Y') backup('brand_provisioner', 'DB_INSTALL/');
sleep(2);

?>
