<?php 

header("Content-type: application/pdf");
header("Content-Disposition: readfile; filename=MANUAL_SEGURIDAD.pdf");
readfile("MANUAL DE USUARIO.pdf");

?>