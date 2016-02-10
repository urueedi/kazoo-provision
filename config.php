<?php

$host=false;
/* --------------------- */
$HTTP="http://";       /* define http is only supported now */
$hosts = 'localhost';  /* define one or more couchdb hosts by whitespace (if one node is down is takes next... */
$dbport="5984";        /* define dbport default 5984 */
$testsleep=15;         /* loop between next try all hosts */
/* --------------------- */

require_once('phplib/Sag.php');
include_once("functions.php");

foreach (glob(dirname(__FILE__)."/functions_*.php") as $filename) {
    include_once basename($filename);
}

// debug info settings
define('DEBUG_REMOTE', ''); // '' for all, name or ip address of debug view. multiple addresses with space
if(get_urlallowed(DEBUG_REMOTE) == true) define('DEBUG_FUNCTION', 'd'); // 'd' or 'v' or 'm' or none
//@define('DEBUG_FUNCTION', 'snom'); // all or <functionsname> or phonetype (aastra snom)  (only allowed with mozilla browser and DEBUG_REMOTE!!!!!)

// SERVER/prov/snom/settings.php?mac=000413563934&pass=dfgJ345bjw45sd&user_agent=Mozilla/4.0%20(compatible;%20snom820-SIP%208.4.32%201.1.4-IFX-26.11.09)
// SERVER/prov/snom/settings.php?mac=0004132A931D?typ=SnomM3?pass=dfg2445sd&user_agent=Mozilla/4.0%20%28compatible;%20snom820-SIP%208.4.32%201.1.4-IFX-26.11.09%29
// SERVER/prov/mitel/settings.php?typ=Aastra6731i&mac=00085D63723E&firmware=3.2.2.56-SIP

if(DEBUG_FUNCTION != 'DEBUG_FUNCTION' && DEBUG_FUNCTION != 'debug') {
    if(!function_exists(DEBUG_FUNCTION) && DEBUG_FUNCTION != '') {
        define('DEBUG_VIEW','yes');
//echo "++++++".DEBUG_FUNCTION;
        ini_set('display_errors', true);
        global $debug; $debug[__FILE__][] = "<font color='red'>DEBUG function (".DEBUG_FUNCTION.") doesn't exist</font>";
    }
}
$debug = false;

?>