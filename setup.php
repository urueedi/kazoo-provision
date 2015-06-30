#!/usr/bin/php
<?php

require_once('config.php');

$host = get_dbhost($hosts);
$sag = new Sag($host);


function backup()
{
    // get_all_docs of brand_provisioner
    $dbs = get_entry('brand_provisioner' , '/_all_docs');
    $dbs = json_decode(json_encode($dbs['res']->rows), true);

    foreach($dbs AS $k => $db){
        $data = get_entry('brand_provisioner' , "/".urlencode($db['id']));
        file_put_contents("./DB_INSTALL/".urlencode($db['id']),json_encode($data['res']));
    }
    echo "backup db->file finished\n";
}

function restore()
{
    global $sag;

    if ($handle = opendir('DB_INSTALL/')) {
        try {$sag->createDatabase('brand_provisioners');}
        catch(Exception $e) {echo $e->getMessage()."DB:brand_provisioners\n";}
        $sag->setDatabase('brand_provisioners');
        while (false !== ($entry = readdir($handle))) {
            if(".." == $entry||"." == $entry) continue;
            $obj = json_decode(file_get_contents('DB_INSTALL/'.$entry));
            $obj->views++;
            unset($obj->_rev);
            try {
                if(preg_match("/^_/",urldecode($entry))) echo $sag->put(urldecode($entry), $obj)->body->ok;
                else echo $sag->put($entry, $obj)->body->ok;
            }
            catch(Exception $e) {
                echo $e->getMessage()."DB:brand_provisioners\n";
            }
        }
    }
    echo "restore file->db finished\n";
}

function input()
{
    $stdin = fopen('php://stdin', 'r');
    $resp = fgetc($stdin);

return($resp);
}
echo "HAVE YOU set config in hosts? !!!!!\n";
echo "brand_provisioner install file -> couchdb on $hosts (only 1)? Y/N ";$resp = input();if($resp == 'Y') restore();
echo "brand_provisioner restore from couchdb -> file ? Y/N ";$resp = input();if($resp == 'Y') backup();
sleep(3);

?>
