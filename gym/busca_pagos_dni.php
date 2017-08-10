<?php
include('lib/DB_Conectar.php');
include('classes/consultas.php');
$result_cloen = $consultas->getPagosClientesPeriodo($_REQUEST['dni_cliente']);
$cliente = $consultas->getDatosClientesPeriodo($_REQUEST['dni_cliente']);
//return json data

if($cliente) {
    if ($result_cloen > 0) {

        $html['mjs']='<div style="color:green ; font-size: 16px;">Hola '.$cliente->nombre.' su cuenta en el gimnasio se encuentra
            al dia. GRACIAS
        </div>';
        $html['error']=0;
    } else {

        $html['mjs']='<div style="color:red ; font-size: 16px;">Hola '.$cliente->nombre.' su cuenta en el gimnasio registra un
            saldo. Por favor Regularice su situacion.GRACIAS
        </div>';
        $html['error']=0;
    }
}else{
    $html['mjs']='<div style="color:maroon ; font-size: 16px;">Ingrese un dni correcto por favor .GRACIAS </div>';
    $html['error']=1;
}

//return json data
echo json_encode($html);
?>