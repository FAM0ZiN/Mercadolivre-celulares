<?php

require_once('barcode.inc.php'); 
$code_number = $_GET['digitos'];
new barCodeGenrator($code_number,0,'hello.gif', 540, 65, false);
?> 