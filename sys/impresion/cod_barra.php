<?php
require_once('barcode.inc.php');
$code_number = '23423443423';
#new barCodeGenrator($code_number,0,'hello.gif');
new barCodeGenrator($code_number,0,'presente', 200, 30, true);
?>
