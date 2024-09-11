<?php

include ('../mpdf/mpdf.php');
$mpd=new mPDF();
$html = utf8_encode($html);

$mpdf->WriteHTML($html);

$mpdf->Output('example_1.pdf','D');
exit;

?>
