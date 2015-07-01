<?php
error_reporting(1);

function show_debug()
{
    global $mypbx, $debug, $phone_data, $data_credit;

    if(is_array($phone_data['number'])) {
        $k = array_keys($phone_data['number']);
        $data_credit = $phone_data[$k[0]];
    }

    if(function_exists(debug_log) && $debug) {
        if(count($debug) < 200) {
            $debug = array_reverse($debug);
            foreach($debug as $key => $log) {
                if($log['level'] == 'd' && ($mypbx['logging'] == 'debug' || ($data_credit['debugphone'] == 'd' && $data_credit['phoneid'] == true)))
                {   //echo $log['file']."-".$log['status']."-".$log['log']."<br>";
                    debug_log($log['log'],$log['status'], $log['file']);
                }
                elseif($log['level'] == 'v' && (($mypbx['logging'] == 'debug' || $mypbx['logging'] == 'verbose') || ($data_credit['debugphone'] == 'v' && $data_credit['phoneid'] == true)
                    || ($data_credit['debugphone'] == 'd' && $data_credit['phoneid'] == true)))
                {   //echo $log['file']."-".$log['status']."-".$log['log']."<br>";
                    debug_log($log['log'],$log['status'], $log['file']);
                }
                elseif($log['level'] == 'm' && (($mypbx['logging'] == 'minimal' || $mypbx['logging'] == 'verbose' || $mypbx['logging'] == 'debug')
                    || ($data_credit['debugphone'] == 'm' && $data_credit['phoneid'] == true)
                    || ($data_credit['debugphone'] == 'v' && $data_credit['phoneid'] == true)
                    || ($data_credit['debugphone'] == 'd' && $data_credit['phoneid'] == true)))
                {
                    debug_log($log['log'],$log['status'], $log['file']);
                }
                elseif($log['level'] == '' && (($mypbx['logging'] == 'minimal' || $mypbx['logging'] == 'verbose' || $mypbx['logging'] == 'debug')
                    || ($data_credit['debugphone'] == 'm' && $data_credit['phoneid'] == true)
                    || ($data_credit['debugphone'] == 'v' && $data_credit['phoneid'] == true)
                    || ($data_credit['debugphone'] == 'd' && $data_credit['phoneid'] == true)))
                {
                    //echo $log['file']."-".$log['status']."-".$log['log']."<br>";
                    debug_log($log['log'],$log['status'], $log['file']);
                }
            }
        }  else debug_log("Count of log is to high: ".count($debug),'problem', __FILE__.":".__LINE__);
    }
}

function get_ip($type)
{
    if($type == '4') return(exec("ip addr list eth0 |grep 'inet '|cut -d' ' -f6|cut -d/ -f1"));
    if($type == '6') return(exec("ip addr list eth0 |grep 'inet6 '|cut -d' ' -f6|cut -d/ -f1"));
}

function remote_ip()
{
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $TheIp = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else $TheIp=$_SERVER['REMOTE_ADDR'];

    return trim($TheIp);
}

function generate_secret($type=NULL) {

$password = '';
$menge = rand(8,13);
$pass = array($menge);
for ($i = 0; $i <= ($menge - 1); $i++) {
    if($type == 'digit') {
      $nmr = rand(48,57);
    } else {
        $grossKlein = rand(1,2);
        if ($grossKlein == 1) {
           $nmr = rand(97,121);
        } else {
            $nmr = rand(65,90);
        }
    }
    $pass[$i] = chr($nmr);
}
for($i = 0; $i <= ($menge -1); $i++) {
    $password .= $pass[$i];
}
return $password;

}

function normalize_phonenumber($dialno)
{
    $suchmuster = array();
    $suchmuster[0] = '/-/';
    $suchmuster[1] = '/\(/';
    $suchmuster[2] = '/\)/';
    $suchmuster[3] = '/\./';

    $ersetzungen = array();
    $ersetzungen[0] = '';
    $ersetzungen[1] = '';
    $ersetzungen[2] = '';
    $ersetzungen[3] = '';

    $dialno = preg_replace("/^\+/", "00" , $dialno);
    $dialno = str_replace(" ", "", urldecode($dialno));
    $dialno = preg_replace($suchmuster, $ersetzungen, $dialno);
//    $dialno = preg_replace("/^41/", "0", $dialno);

return $dialno;
}

// date int format mm/dd/yyyy show in local format
function showdate($date) {
    $d = explode("-",$date);
    if($date != '') $date = strftime("%x", mktime(0, 0, 0, $d[1], $d[2], $d[0]));

return $date;
}

// 2012-12-13 00:45:34 to timestamp
function mysqltimestamp($date) {
    $e = explode(" ",$date);
    $d = explode("-",$e[0]);
    $t = explode(":",$e[1]);
    if($date != '') $date = mktime($t[0], $t[1], $t[2], $d[1], $d[2], $d[0]);

return $date;
}

function get_provisioning($phone_data)
{

    switch($phone_data['device']) {
        case 'snom300':
        case 'snom320':
        case 'snom360':
        case 'snom370':
        case 'snom720':
        case 'snom760':
        case 'snom820':
        case 'snom870':
        case 'snomm9':
        case 'snomm9r':
            $str = generate_snom_provision($phone_data); 
            global $debug; $debug[] = array(level=>'m',status=>'info',file=>__FILE__.":".__LINE__,log=>"Phone ".$phone_data['device']." prov:".$phone_data['voipserver']." port:".$phone_data['port']." len:".strlen($str));
            echo $str;
        break;
        case 'snomm3':
            $str = utf8_decode(generate_snom_provision($phone_data));
            global $debug; $debug[] = array(level=>'m',status=>'info',file=>__FILE__.":".__LINE__,log=>"Phone ".$phone_data['device']." prov:".$phone_data['voipserver']." port:".$phone_data['port']." len:".strlen($str));
            header('Content-Type: text/html; charset=iso-8859-1');
            echo $str;
        break;
        case 'aastra6731i':
        case 'aastra6753i':
        case 'aastra6753i-1':
        case 'aastra6755i':
        case 'aastra6755i-1':
        case 'aastra6757i':
        case 'aastra6757i-1':
        case 'aastra6739i':
            $str = generate_mitel_provision($phone_data);
            global $debug; $debug[] = array(level=>'m',status=>'info',file=>__FILE__.":".__LINE__,log=>"Phone ".$phone_data['device']." prov:".$phone_data['voipserver']." port:".$phone_data['port']." len:".strlen($str));
            echo $str;
        break;
    }
}

/* Usage:
 *       $xml = Array2XML::createXML('root_node_name', $php_array);
 *       echo $xml->saveXML();
*/

class Array2XML {

    private static $xml = null;
    private static $encoding = 'UTF-8';

    /**
     * Initialize the root XML node [optional]
     * @param $version
     * @param $encoding
     * @param $format_output
     */
    public static function init($version = '1.0', $encoding = 'UTF-8', $format_output = true) {
        self::$xml = new DomDocument($version, $encoding);
        self::$xml->formatOutput = $format_output;
        self::$encoding = $encoding;
    }

    /**
     * Convert an Array to XML
     * @param string $node_name - name of the root node to be converted
     * @param array $arr - aray to be converterd
     * @return DomDocument
     */
    public static function &createXML($node_name, $arr=array()) {
        $xml = self::getXMLRoot();
        $xml->appendChild(self::convert($node_name, $arr));

        self::$xml = null;    // clear the xml node in the class for 2nd time use.
        return $xml;
    }

    /**
     * Convert an Array to XML
     * @param string $node_name - name of the root node to be converted
     * @param array $arr - aray to be converterd
     * @return DOMNode
     */
    private static function &convert($node_name, $arr=array()) {

        //print_arr($node_name);
        $xml = self::getXMLRoot();
        $node = $xml->createElement($node_name);

        if(is_array($arr)){
            // get the attributes first.;
            if(isset($arr['@attributes'])) {
                foreach($arr['@attributes'] as $key => $value) {
                    if(!self::isValidTagName($key)) {
                        throw new Exception('[Array2XML] Illegal character in attribute name. attribute: '.$key.' in node: '.$node_name);
                    }
                    $node->setAttribute($key, self::bool2str($value));
                }
                unset($arr['@attributes']); //remove the key from the array once done.
            }

            // check if it has a value stored in @value, if yes store the value and return
            // else check if its directly stored as string
            if(isset($arr['@value'])) {
                $node->appendChild($xml->createTextNode(self::bool2str($arr['@value'])));
                unset($arr['@value']);    //remove the key from the array once done.
                //return from recursion, as a note with value cannot have child nodes.
                return $node;
            } else if(isset($arr['@cdata'])) {
                $node->appendChild($xml->createCDATASection(self::bool2str($arr['@cdata'])));
                unset($arr['@cdata']);    //remove the key from the array once done.
                //return from recursion, as a note with cdata cannot have child nodes.
                return $node;
            }
        }

        //create subnodes using recursion
        if(is_array($arr)){
            // recurse to get the node for that key
            foreach($arr as $key=>$value){
                if(!self::isValidTagName($key)) {
                    throw new Exception('[Array2XML] Illegal character in tag name. tag: '.$key.' in node: '.$node_name);
                }
                if(is_array($value) && is_numeric(key($value))) {
                    // MORE THAN ONE NODE OF ITS KIND;
                    // if the new array is numeric index, means it is array of nodes of the same kind
                    // it should follow the parent key name
                    foreach($value as $k=>$v){
                        $node->appendChild(self::convert($key, $v));
                    }
                } else {
                    // ONLY ONE NODE OF ITS KIND
                    $node->appendChild(self::convert($key, $value));
                }
                unset($arr[$key]); //remove the key from the array once done.
            }
        }

        // after we are done with all the keys in the array (if it is one)
        // we check if it has any text value, if yes, append it.
        if(!is_array($arr)) {
            $node->appendChild($xml->createTextNode(self::bool2str($arr)));
        }

        return $node;
    }

    /*
     * Get the root XML node, if there isn't one, create it.
     */
    private static function getXMLRoot(){
        if(empty(self::$xml)) {
            self::init();
        }
        return self::$xml;
    }

    /*
     * Get string representation of boolean value
     */
    private static function bool2str($v){
        //convert boolean to text value.
        $v = $v === true ? 'true' : $v;
        $v = $v === false ? 'false' : $v;
        return $v;
    }

    /*
     * Check if the tag name or attribute name contains illegal characters
     * Ref: http://www.w3.org/TR/xml/#sec-common-syn
     */
    private static function isValidTagName($tag){
        $pattern = '/^[a-z_]+[a-z0-9\:\-\.\_]*[^:]*$/i';
        return preg_match($pattern, $tag, $matches) && $matches[0] == $tag;
    }
}

/* Usage:
*       $array = XML2Array::createArray($xml);
*/

class XML2Array {

    private static $xml = null;
    private static $encoding = 'UTF-8';

    /**
     * Initialize the root XML node [optional]
     * @param $version
     * @param $encoding
     * @param $format_output
     */
    public static function init($version = '1.0', $encoding = 'UTF-8', $format_output = true) {
        self::$xml = new DOMDocument($version, $encoding);
        self::$xml->formatOutput = $format_output;
        self::$encoding = $encoding;
    }

    /**
     * Convert an XML to Array
     * @param string $node_name - name of the root node to be converted
     * @param array $arr - aray to be converterd
     * @return DOMDocument
     */
    public static function &createArray($input_xml) {
        $xml = self::getXMLRoot();
	if(is_string($input_xml)) {
	    $parsed = $xml->loadXML($input_xml);
	    if(!$parsed) {
		throw new Exception('[XML2Array] Error parsing the XML string.');
	    }
	} else {
	    if(get_class($input_xml) != 'DOMDocument') {
		throw new Exception('[XML2Array] The input XML object should be of type: DOMDocument.');
	    }
	    $xml = self::$xml = $input_xml;
	}
	$array[$xml->documentElement->tagName] = self::convert($xml->documentElement);
        self::$xml = null;    // clear the xml node in the class for 2nd time use.
        return $array;
    }

    /**
     * Convert an Array to XML
     * @param mixed $node - XML as a string or as an object of DOMDocument
     * @return mixed
     */
    private static function &convert($node) {
	$output = array();

	switch ($node->nodeType) {
	    case XML_CDATA_SECTION_NODE:
		$output['@cdata'] = trim($node->textContent);
		break;

	    case XML_TEXT_NODE:
		$output = trim($node->textContent);
		break;

	    case XML_ELEMENT_NODE:

		// for each child node, call the covert function recursively
		for ($i=0, $m=$node->childNodes->length; $i<$m; $i++) {
		    $child = $node->childNodes->item($i);
		    $v = self::convert($child);
		    if(isset($child->tagName)) {
			$t = $child->tagName;

			// assume more nodes of same kind are coming
			if(!isset($output[$t])) {
			    $output[$t] = array();
			}
			$output[$t][] = $v;
		    } else {
			//check if it is not an empty text node
			if($v !== '') {
			    $output = $v;
			}
		    }
		}

		if(is_array($output)) {
		    // if only one node of its kind, assign it directly instead if array($value);
		    foreach ($output as $t => $v) {
			if(is_array($v) && count($v)==1) {
			    $output[$t] = $v[0];
			}
		    }
		    if(empty($output)) {
			//for empty nodes
			$output = '';
		    }
		}

		// loop through the attributes and collect them
		if($node->attributes->length) {
		    $a = array();
		    foreach($node->attributes as $attrName => $attrNode) {
			$a[$attrName] = (string) $attrNode->value;
		    }
		    // if its an leaf node, store the value in @value instead of directly storing it.
		    if(!is_array($output)) {
			$output = array('@value' => $output);
		    }
		    $output['@attributes'] = $a;
		}
		break;
	}
	return $output;
    }

    /*
     * Get the root XML node, if there isn't one, create it.
     */
    private static function getXMLRoot(){
        if(empty(self::$xml)) {
            self::init();
        }
        return self::$xml;
    }
}

/* generate json string for settings
*  obj_datas = object or array of hole or part of provisions data
*/
function plain2json($plain, $delimiter=false)
{
        $plainArray = explode("\n", $plain);
        foreach($plainArray as $key => $line) {
            if(! $line) continue;
            $arr = explode($delimiter, $line);
            if(! $arr[0]) continue;
            $jsonArray[$arr[0]]['value'] = $arr[1];
        }
    $json = json_encode($jsonArray);

return($json);
}

function merge_togetaher($object1, $object2, $typ)
{

    switch($typ) {
        case 'json':
            $res = json_encode(array_merge_recursive(object_decode( $object1, true ) , json_decode( $object2, true )));
        break;
        case 'object':
            $res = array_merge_recursive($object1 , $object2);
        break;
    }

return($res);
}

function get_urlallowed($url)
{
    $remote_ip = @$_SERVER['REMOTE_ADDR'];
    $networks = preg_split('/,| /', $url);
    $allowed = false;
    {global $debug; $debug[] = array(level=>'d',status=>'info',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '."-+$net+-+$url+-+$networks+-");}
    if (function_exists('ip_addr_in_network')) {
        foreach ($networks as $net) {
            if(preg_match("/[a-zA-Z]/",$net)) {
                $dnsrec = dns_get_record($net);
                if($dnsrec['0']['ip'] != false) $net = $dnsrec['0']['ip'];
            }
            if (ip_addr_in_network( $remote_ip, trim($net) )) {
                $allowed = true;
                $net = trim($net);
                break;
            }
        }
    }
return($allowed);
}

function getAddrByHost($host, $timeout = 3) {
    $query = `nslookup -timeout=$timeout -retry=1 $host`;
    if(preg_match('/\nAddress: (.*)\n/', $query, $matches))
        return trim($matches[1]);
return $host;
}

function ip_addr_dec( $ip )
{
    $ip = trim(normalizeIPs($ip));
    if (! preg_match('/(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})/', $ip, $m))
        return 0;
    $ipDec = 0;
    for ($i=4; $i>0; --$i)
        $ipDec += ($m[$i] < 256 ? $m[$i] : 255) * pow(256,4-$i);
    return $ipDec;
    //$ipBin = str_pad(decBin($ipDec), 32, '0', STR_PAD_LEFT);
    //return $ipBin;
}

function normalizeIPs( $str ) {
    //return preg_replace( '/\b0{1,2}(\d*)/', '$1', $str );
    return preg_replace( '/\b0{1,2}(\d+)\b/', '$1', $str );
}

function ip_addr_decbin( $ipDec )
{
    return str_pad(decBin($ipDec), 32, '0', STR_PAD_LEFT);
}

function ip_addr_in_network( $ip, $networkDef )
{
if(preg_match("/[a-zA-Z]/",$networkDef) == 1) {
    $networkDef = getAddrByHost($networkDef,'3');
}
$ipDec = ip_addr_dec( $ip );
if ($ipDec < 1) return false;
$ipBin = ip_addr_decbin( $ipDec );
//echo "ip     : $ipBin\n";

$nDef = explode('/', $networkDef, 2);
if (count($nDef) < 2) $nDef[1] = '32'; // 255.255.255.255
$nIpDec = ip_addr_dec( $nDef[0] );
//if ($nIpDec < 1) return false;
$nIpBin = ip_addr_decbin( $nIpDec );
//echo "netip  : $nIpBin\n";

$nMaskDec = ip_addr_dec( $nDef[1] );
$nMaskBin = ($nMaskDec > 1)
    ? ip_addr_decbin( $nMaskDec )
    : str_repeat('1', (int)$nDef[1]) . str_repeat('0', 32-(int)$nDef[1]);
//echo "netmask: $nMaskBin\n";

for ($i=0; $i<32; ++$i) {
    if ($nMaskBin{$i}=='1' && ($ipBin{$i} != $nIpBin{$i}))
        return false;
}
return true;
}

function store_recording($exten,$fname,$data) {

 if ($_GET['f'] == 'store_recording' && $_GET['upload'] != false) {

    global $program_settings;

    $fname = urldecode($fname);
    $fsplit = explode("-",$fname);
    // get data from customers
    $qry = "SELECT customersphones.*, customers.type as custtype FROM customersphones
    INNER JOIN customers ON customers.id = customersphones.customersid
    WHERE customersphones.username = '".$fsplit[0]."'";

    $result = mysql_send($qry);
    if($result)
        $custdata = mysql_fetch_assoc($result);
    if($custdata['customersid'] == $fsplit[4])
        $path = $program_settings['Monitor_Webpath'].'/'.$custdata['customersid'].'/'.$fname;

    // check subdir of customersid or create it
    if($program_settings['Monitor_Webpath'] != '' && is_dir($program_settings['Monitor_Webpath'].'/'.$custdata['customersid']) == false)
        mkdir($program_settings['Monitor_Webpath'].'/'.$custdata['customersid']);

    // See if the file exists
    if (is_file($path) && $fname != false) return "recording allreday exists";

    // info about file
    $size = strlen($data);
    $extension = strtolower(substr(strrchr($fname,"."),1));

    // This will set the Content-Type to the appropriate setting for the file
    $ctype ='';
    switch( $extension ) {
        case "mp3": $ctype="audio/mpeg"; break;
        case "wav": $ctype="audio/x-wav"; break;
        case "Wav": $ctype="audio/x-wav"; break;
        case "WAV": $ctype="audio/x-wav"; break;
        case "gsm": $ctype="audio/x-gsm"; break;
        case "h264": $ctype="video/x-h264"; break;
        case "h263": $ctype="video/x-h263"; break;

        // not downloadable
        default: return "recording can't handle";
    }

    if ($_GET['f'] == 'store_recording' && $_GET['get_check'] == true && $_GET['upload'] != false && $_GET['overwrite'] != true)
        return "file exits, or use overwrite";

    if($size < 1)
        return "file has not writeable size";

    if(file_put_contents($path,$data,FILE_APPEND | LOCK_EX)) {
        $size = filesize($path);
        if (is_file($path) && $fname != false && $size > 0) return "storeing ok";
    } else {
        return "storeing error";
    }
 return "not specificated";
 }
}

function debug_log($log, $status=false, $file, $offlog=false)
{
    global $data_credit;

    // debug stop loop
    if($offlog) return(false);
    if(!$status) $status = "none";
    $data = array('custid'=>$data_credit['customersid'],'phoneid'=>$data_credit['phoneid'],'timestamp'=>time(),'status'=>$status,'log'=>$log,'app'=>'provapi','file'=>$file);
//    loggen('nodes',$data, true); // set offlog
//    global $debug; $debug[] = array(level=>'d',status=>'problem',file=>__FILE__.":".__LINE__,log=>'custid=>'.$data_credit['customersid'].',phoneid=>'.$data_credit['phoneid'].',timestamp=>'.time().',level=>'. $level .',status=>'.$status.',log=>'.$log.',app=>provapi');
}

function get_phone_data($macaddress, $qpass=false, $nonepass=false)
{

    global $host, $sag;

   if(filemtime('/tmp/provcache-!!') > time()-600) {
        $provdata = unserialize(file_get_contents('/tmp/provcache-!!'));
        if (! is_array($provdata)) {
            {global $debug; $debug[] = array(level=>false,status=>'problem',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '." Loaderror: /tmp/provcache-!!");}
            return(false);
        }
    } else {
        $ret = get_all_dbs($host);
        foreach($ret['res'] AS $key => $value) {
            if(stristr($value, 'account/')) {
                $res = get_entry($value , '/_design/devices/_view/listing_by_macaddress');
                if($res['err']) {show_debug("Get macaddress_view Error:".$res['err']); continue;}
                else {
//                    if(! $ph_dat['devices']) $ph_dat['devices'] = json_decode(json_encode($res['res']->rows), true);
                    foreach($res['res']->rows AS $mac) {
                        $mac->value->account = $value;
                        $mac->value->mac = $mac->key;
                        $provdata[$mac->id] = $mac->value;
                    }
                }
            }
        }
        file_put_contents('/tmp/provcache-!!',serialize($provdata));
    }

    foreach($provdata AS $v) {
        if(stristr(str_replace(":","",$macaddress),str_replace(":","",$v->mac))) $prov[] = $v;
        /* array all devices if owner too  */ if($v->owner) $devices[$v->owner] = $v;
    }
    foreach($prov AS $k => $val) {
        $ph_account = get_entry($prov[$k]->account , $prov[$k]->pvt_account_id);
        $ph_dat['account'][$k] = json_decode(json_encode($ph_account['res']), true);
        $ph_users[$k] = get_entry($prov[$k]->account, '/_design/users/_view/crossbar_listing');
        /* OBJECT2ARRAY */  $ph_user[$k] = json_decode(json_encode($ph_users[$k]['res']->rows), true);
    }
    $ph_dat['devices'] = json_decode(json_encode($devices), true);
    // return fase if qpass enabled and wrong ['provision_enabled']
//{global $debug; $debug[] = array(level=>'d',status=>'info',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '." DEBUG: ".$ph_dat['account'][0]['provision']['provision_enabled']." == false || ".$ph_dat['account'][0]['provision']['urlpass']." == false || ".$ph_dat['account'][0]['provision']['urlpass']." != $qpass) && $nonepass");}
    if(($ph_dat['account'][0]['provision']['provision_enabled'] == false || $ph_dat['account'][0]['provision']['urlpass'] == false || $ph_dat['account'][0]['provision']['urlpass'] != $qpass) && $nonepass == false) {/* fraud? */ sleep(20); return(false);}

    $ph_dat['prov'] = json_decode(json_encode($prov), true);
    // take template of the first account ## get account and userdata (f_path = /ui/snom/3xx/300)
    $ph_dat['template'] = get_groundsettings(array('2' => 'ui', '3'=>$prov[0]->provision->endpoint_brand, '4'=>$prov[0]->provision->endpoint_family, '5'=>$prov[0]->provision->endpoint_model), 'object');
    /* OBJECT2ARRAY */  foreach($ph_user AS $account => $users) { foreach($users AS $k => $v) { $ph_dat['users'][$account][$v['id']] = $v;} }
    {global $debug; $debug[] = array(level=>'d',status=>'info',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '." Get Phone & Userdata from bigCouch");}

//print_r($ph_dat);
//exit;
return($ph_dat);

}

function phonebook_vcard($data,$max_entrys)
{
   if (is_array($data['numbers'])) {
        foreach ($data['numbers'] as $k => $values)    {
            if(($idx >= $max_entrys && $max_entrys != '') || $values['name'] == false)
                continue;
            $values['name'] = preg_replace("/\\\|\(|\)|\[|\]|\+/i","",$values['name']);
            $values['name'] = preg_replace("/\\.|\-/i"," ",$values['name']);
            $values['name'] = substr($values['name'],0,25);
            $pbook .= "BEGIN:VCARD\r\nVERSION:3.0\r\nFN:".$values['name']."\r\nGROUP:\r\nN:".$values['name'].";\r\nTEL;TYPE=WORK,VOICE:".$k."\r\nEND:VCARD\r\n";
            $idx++;
        }
    return $pbook;
    }
}

function phonebook_xml($data,$max_entrys)
{
   if (is_array($data['numbers'])) {
        $idx = 1;
        $pbook .= '<?xml version="1.0" encoding="utf-8"?>'."\r\n<tbook>\r\n";

        foreach ($data['numbers'] as $k => $values)    {
            if(($idx >= $max_entrys && $max_entrys != '') || $values['name'] == false)
                continue;
            $values['name'] = preg_replace("/\\\|\(|\)|\[|\]|\+/i","",$values['name']);
            $values['name'] = preg_replace("/\\.|\-/i"," ",$values['name']);
            $values['name'] = substr($values['name'],0,25);

            $pbook .= '<item context="active" type="friends" fav="true" mod="true" index="'.$idx.'">'."\r\n";
            $pbook .= "<name>".$values['name']."</name>\r\n";
            $pbook .= "<number>".$k."</number>\r\n";
//            $values['name'] .= "<number_type>sip</number_type>";
//            $values['name'] .= "<organization></organization>";
//            $values['name'] .= "<group>friend</group>";
            $pbook .= "</item>\r\n";
            $idx++;
        }
        $pbook .= "</tbook\r\n";
    return($pbook);
    }
}

function get_phonebook($custid, $phoneid, $mime, $limit, $order)
{
    $data = get_phonebook_data($custid, $phoneid, $limit, $order);

    switch($mime) {
        case 'csv': $output = phonebook_csv($data); break;
        case 'vcard': $output = phonebook_vcard($data); break;
        case 'xml': $output = phonebook_xml($data); break;
    }
return $output;
}

function get_phonebook_data($custid, $phoneid, $limit, $order)
{

    if($custid)
        $sql = "SELECT phonebook.id as pbid, phonebook.*, phonebook_custrel.*
        FROM phonebook INNER JOIN phonebook_custrel ON phonebook.id = phonebook_custrel.phonebookid
        WHERE phonebook_custrel.customersid = '$custid' AND phonebook_custrel.blacked != '1'
        ORDER by $order LIMIT $limit";
    elseif($phoneid)
    $sql = "SELECT phonebook.id as pbid, phonebook.*, phonebook_userrel.*
        FROM phonebook INNER JOIN phonebook_userrel ON phonebook.id = phonebook_userrel.phonebookid
        WHERE phonebook_userrel.phoneid = '$phoneid' AND phonebook_userrel.blacked != '1'
        ORDER by $order LIMIT $limit";

    $result = mysql_send($sql);
    global $debug; $debug[] = array(level=>'d',status=>'problem',file=>__FILE__.":".__LINE__,log=>'('. __FUNCTION__ .') '.$result['ERROR']);
    if($result)
    while($row = mysql_fetch_assoc($result))
    {
        if($row['lastname']) $phone_data['numbers'][$row['did']]['name'] = $row['lastname']." ". $row['firstname'];
        elseif($row['company']) $phone_data['numbers'][$row['did']]['name'] = $row['company'];
    }

return $phone_data;
}

// ====================================================================================================

class Object {
    function ResetObject() {
        foreach ($this as $key => $property) {
            unset($this->$key);
        }
    }
}

function db_config() {

    $config = get_entry('system_config','ecallmgr');
    if($config['err']) show_debug("Get config Error:".$config['err']);
    else show_debug("Get config Success:".$config['res']->_id,'v', __FILE__ ,__FUNCTION__, __LINE__);

return($config['res']);
}

function get_all_dbs($host) {

    global $sag;
    $ret['err'] = false;

    try {
            $ret['res'] = $sag->getAllDatabases()->body;
        }
        catch(Exception $e) {
              $ret['err'] = $e->getMessage()."Host:".$host;
        }
    return $ret;
}

function get_entry($db, $view) {

    global $sag;
    $ret['err'] = false;

    try {
            $sag->setDatabase($db);
            $ret['res'] = $sag->get($view)->body;
        }
        catch(Exception $e) {
              $ret['err'] = $e->getMessage()."DB:$db";
        }
    return $ret;
}

// res object

function put_changed($value) {

    global $sag;
    $ret['err'] = false;
    $ret = get_entry($value->db, urlencode($value->id));
    if($ret['err']) {show_debug("Change Get:".$value->id ." Error:".$ret['err']); return(false);} else $res = $ret['res'];
    $res->regextern->pvt_changed = ((date("U", strtotime("0000-01-01"))-time())*-1); // this is gregoriantime (1.1.1 00:00)
    $res->views++;

    try {
            $sag->setDatabase($res->pvt_db_name);
            $ret['res'] = $sag->put(urlencode($res->_id), $res)->body->ok;
        }
        catch(Exception $e) {
              $ret['err'] = $e->getMessage()."DB:$db";
        }
    return $ret;
}

function write_xml($value) {

global $dbconfig;

    $xml = '<include>
<gateway name="'.substr($value->id,1).'">
<param name="proxy" value="'.$value->regextern->proxy.'"/>
<param name="username" value="'.$value->regextern->username.'"/>
<param name="extension" value="'.$value->regextern->extension.'"/>
<param name="password" value="'.$value->regextern->password.'"/>
<param name="register" value="true"/>
<param name="expire-seconds" value="'.$dbconfig->default->extern_numbermanager_default_expire.'"/>
<param name="context" value="context_2"/>
</gateway>
</include>
';
    file_put_contents("/etc/kazoo/freeswitch/gateways/".substr($value->id,1).".xml", $xml, LOCK_EX);
    $ret = put_changed($value);
    if($ret['err']) show_debug("Adding:".$value->id ." Error:".$ret['err']);
    else show_debug("Adding:".$value->id ." Success:".$ret['res'],'v', __FILE__ ,__FUNCTION__, __LINE__);
}

function remove_xml($value) {

    unlink("/etc/kazoo/freeswitch/gateways/".substr($value->id,1).".xml");
    $ret = put_changed($value);
    if($ret['err']) show_debug("Remove:".substr($value->id,1)." Error:".$ret['err']);
    else show_debug("Remove:".$value->id ." Success:".$ret['res'],'v', __FILE__ ,__FUNCTION__, __LINE__);
}

function check_gateways() {

    $ret = false;
    exec('fs_cli -x "sofia xmlstatus gateways"', $ret);
    $xml = simplexml_load_string(implode($ret));
    $json = json_encode($xml);
    $gateways = json_decode($json,TRUE);
    foreach($gateways['gateway'] AS $key => $gateway) {
        if($gateway['status'] == 'DOWN') {show_debug("Gateway:".$gateway['name']." Proxy:".$gateway['proxy']." State:".$gateway['state']." Status:".$gateway['status'],'', __FILE__ ,__FUNCTION__, __LINE__);
            exec('sofia profile sipinterface_1 killgw '.$gateway['name'], $ret); sleep(1); exec('sofia profile sipinterface_1 rescan xmlreload', $ret);}
        else show_debug("Gateway:".$gateway['name']." Proxy:".$gateway['proxy']." State:".$gateway['state']." Status:".$gateway['status'],'v', __FILE__ ,__FUNCTION__, __LINE__);
    }
}

function check_couchdb($testhost) {

    $host = false;
    if($testhost) {
        $fping = exec("fping $testhost -t 50");
        if($fping == $testhost.' is alive') {
            $ret = json_decode(check_http('http://'.$testhost.':5984', 2),TRUE);
            show_debug("Check couchdb:".$testhost.":5984/",'d', __FILE__ ,__FUNCTION__, __LINE__);
            if($ret['couchdb'] == 'Welcome' && $ret['version'] == '1.1.1') return($testhost);
            else show_debug("FAILED couchdb:".$testhost,'', __FILE__ ,__FUNCTION__, __LINE__);
        } else show_debug("FAILED fping:".$pingt." -t 50 ip=".$testhost,'', __FILE__ ,__FUNCTION__, __LINE__);
    }
return(false);
}

function check_http($url, $timeout) {

    $ch=curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

    $result=curl_exec($ch);
    curl_close($ch);

return($result);

}

function get_dbhost($hosts)
{
    global $testsleep;

    while($host == false) {
        foreach(explode(" ",$hosts) AS $testhost) { $host = check_couchdb($testhost); if($host) break;}
        if($host) continue;
        show_debug("No connect to cluster-db sleep now for next tray in (s):".$testsleep);
        sleep($testsleep);
    }
return($host);

}

/* f_path = array(2=>ui, 3=>snom, 4=>3xx, 5=>300)
    retype = object or ''
*/

function get_groundsettings($f_path, $retype=false)
{

    switch($f_path[2])
    {
        case 'ui':
            $res = get_entry('brand_provisioner' , urlencode(implode($f_path,"/")));
            $c_keys = $res['res']->usr_keys->setable_phone_keys + $res['res']->usr_keys->setable_module_keys;
            switch($retype) {
                case '':
                    echo '{"success": true,"data": {"template": {"feature_keys": {"iterate": "'. $c_keys .'"}, "lines": { "iterate": 0, "text": "Lines" } } } }';
                break;
                case 'object':
                    return($res['res']);
                break;
            }
        break;
        case 'phones':
            $res = get_entry('brand_provisioner' , '/_design/provisioner/_view/listings_tree');
            echo json_encode(($res['res']->rows['0']->value));
        break;
    }
}

/* do db->file (db=brand_provisioner, dir=./DB_BACKUP/) */
function backup($db_a, $dir)
{
    // get_all_docs
    $dbs = get_entry($db_a , '/_all_docs');
    $dbs = json_decode(json_encode($dbs['res']->rows), true);

    foreach($dbs AS $k => $db){
        $data = get_entry($db_a , "/".urlencode($db['id']));
        file_put_contents($dir.urlencode($db['id']),json_encode($data['res']));
    }
    return("backup db->file finished\n");
}

/* do file->db (db=brand_provisioner, dir=./DB_BACKUP/) type=update or restore[none]*/
function restore($db_a, $dir, $type=false)
{
    global $sag;

    if ($handle = opendir($dir)) {
        if($type == false) { try {$sag->createDatabase($db_a);} catch(Exception $e) {echo $e->getMessage()."DB:".$db_a."\n";}}
        $sag->setDatabase($db_a);
        while (false !== ($entry = readdir($handle))) {
            if(".." == $entry||"." == $entry) continue;
            $obj = json_decode(file_get_contents($dir.$entry));
            if($type == 'update') $obj->views++;
            else unset($obj->_rev);
            try {
                if(preg_match("/^_/",urldecode($entry))) echo $sag->put(urldecode($entry), $obj)->body->ok;
                else echo $sag->put($entry, $obj)->body->ok;
            }
            catch(Exception $e) {
                echo $e->getMessage()."DB:".$db_a." file:".urlencode($entry)."\n";
            }
        }
    }
    return("restore file->db finished\n");
}

function upload_phone_data($prov, $db_a='brand_provisioner', $type=false)
{
    global $sag;
    $prov['_id'] = 'ui/'.$prov['endpoint_brand']."/".$prov['endpoint_family']."/".$prov['endpoint_model'];
    $obj = $prov;
    $sag->setDatabase($db_a);
    unset($obj->_rev);
    try {
        if(preg_match("/^_/",$prov['_id'])) echo $sag->put($prov['_id'], $obj)->body->ok;
        else echo $sag->put(urlencode($prov['_id']), $obj)->body->ok;
    }
    catch(Exception $e) {
        echo $e->getMessage()."DB:".$db_a." file:".$prov['_id']."\n";
    }
    // add to phonetree
    $tree = get_entry($db_a , "/phonetree");
    $new = json_decode(json_encode($tree), true);
    $new['res']['data'][$prov['endpoint_brand']]['id'] = $prov['endpoint_brand'];
    $new['res']['data'][$prov['endpoint_brand']]['name'] = $prov['endpoint_brand'];
    $new['res']['data'][$prov['endpoint_brand']]['families'][$prov['endpoint_family']]['id'] = $prov['endpoint_brand']."_".$prov['endpoint_family'];
    $new['res']['data'][$prov['endpoint_brand']]['families'][$prov['endpoint_family']]['name'] = $prov['endpoint_family'];
    $new['res']['data'][$prov['endpoint_brand']]['families'][$prov['endpoint_family']]['models'][$prov['endpoint_model']]['id'] = $prov['endpoint_brand']."_".$prov['endpoint_model'];
    $new['res']['data'][$prov['endpoint_brand']]['families'][$prov['endpoint_family']]['models'][$prov['endpoint_model']]['name'] = $prov['endpoint_model'];
    $new = json_decode(json_encode($new), FALSE);
    $new = (array) $new;
    $new['res']->views++;
    $sag->put("phonetree", $new['res'])->body->ok;

    return('uploaded');
}

?>