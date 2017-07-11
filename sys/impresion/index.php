<?php
require_once('barcode.inc.php');
$code_number = 'mauroripa-22-111-1983';
#new barCodeGenrator($code_number,0,'hello.gif');
new barCodeGenrator($code_number,0,'presente', 190, 130, true);
?>
