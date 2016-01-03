<?php

/* do db->file (db=system_config, dir=./DB_BACKUP/) */
function backup($db_a, $dir, $match=false)
{
    // get_all_docs
    $dbs = get_entry($db_a , '/_all_docs');
    $dbs = json_decode(json_encode($dbs['res']->rows), true);
    @mkdir($dir, 0777, true);

    foreach($dbs AS $k => $db){
        /* backup only if match */
        if($match == true && $match != $db['id']) continue;
        $data = get_entry($db_a , "/".urlencode($db['id']));
        unset($data['res']->_rev);
        @mkdir($dir.urlencode($db['id']), 0777, true);
        file_put_contents($dir.urlencode($db['id']).'/'.urlencode($db['id']).'.json',json_encode($data['res']));
    }
    return("backup db->file finished\n");
}

/* do file->db (db=system_config, dir=./DB_BACKUP/) type=update or restore[none]*/
function restore($db_a, $dir, $type=false)
{
    global $sag;

    if ($handle = opendir($dir)) {
        try {$sag->createDatabase($db_a);} catch(Exception $e) {echo $e->getMessage()."DB:".$db_a."\n";}
        $sag->setDatabase($db_a);
        while (false !== ($entry = readdir($handle))) {
            if(".." == $entry||"." == $entry) continue;
            $obj1 = get_entry($db_a , "/".$entry);
            $temp_rev = $obj1['res']->_rev;
            $obj2 = json_decode(file_get_contents($dir.$entry.'/'.$entry.'.json'));
            if(is_object($obj1)) $obj = update_together($obj1['res'], $obj2, 'object');
            else $obj = $obj2;
            $obj = object2array($obj); unset($obj['err']); unset($obj['_rev']);
            try {
                if(preg_match("/^_/",urldecode($entry))) echo $sag->put(urldecode($entry), $obj)->body->ok;
                else echo $sag->put($entry, $obj)->body->ok;
            }
            catch(Exception $e) {
                if($type == 'update') {
                    $obj['_rev'] = $temp_rev;
                    $obj['views'] = $obj['views']+1;
                }
                try {
                    if(preg_match("/^_/",urldecode($entry))) echo $sag->put(urldecode($entry), $obj)->body->ok;
                    else echo $sag->put($entry, $obj)->body->ok;
                }
                catch(Exception $e) {
                    echo $e->getMessage()."DB:".$db_a." file:".urlencode($entry)."\n";
                }
            }
        }
    }
    return("restore file->db finished\n");
}

?>