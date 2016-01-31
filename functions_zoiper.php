<?php
error_reporting(1);

function get_qrcode()
{

    include('phpqrcode/qrlib.php');
//then to output the image directly as PNG stream do for example:

//QRcode::png('your texte here...');
//to save the result locally as a PNG image:

    $tempDir = EXAMPLE_TMP_SERVERPATH;

    $codeContents = 'your message here...';

    $fileName = 'qrcode_name.png';

    $pngAbsoluteFilePath = $tempDir.$fileName;
    $urlRelativeFilePath = EXAMPLE_TMP_URLRELPATH.$fileName;

    QRcode::png($codeContents, $pngAbsoluteFilePath); 

}

?>