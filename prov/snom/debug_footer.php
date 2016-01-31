<?php

if(DEBUG_FUNCTION != 'DEBUG_FUNCTION' && DEBUG_FUNCTION != 'debug' && DEBUG_VIEW == 'yes') {
    echo '<div style="text-align:left; padding:20px; border:thin solid red; margin:25px">';
    if(function_exists(debug_log) && $debug) {
        foreach($debug as $key => $log) {
                echo $log['file'].' '.$log['status'].' '.$log['log'].'<br>';
        }
        echo '</div>';
    }
}
?>