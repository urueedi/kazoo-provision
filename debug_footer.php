<?php

if(DEBUG_VIEW == 'yes'|| DEBUG_FUNCTION != '') {
    echo '<div style="text-align:left; padding:20px; border:thin solid red; margin:25px">';
    if(function_exists(debug_log) && $debug) {
        foreach($debug as $key => $log) {
                echo $log['file'].' '.$log['status'].' '.$log['log'].'<br>';
        }
        echo '</div>';
    }
}
?>