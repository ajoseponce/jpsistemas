<?php
class Consultas
{
	function __construct($db){
		$this->db = $db;
	}
        
        //////////////////********************/////////////////7
        function save_documentos($data, $nombre, $extension){
            $table = new Table($this->db, 'documentos');
            
            if($data['id_registro']){ 
                $table->find($data['id_registro']);
                if($nombre){
                $table->archivo_nombre = $nombre;
                }
                if($extension){
                $table->archivo_extension = $extension;
                }
                
            $table->estado = $data['estado'];
                //$table->fecha_modificacion = date('Y-m-d H:i:s');
            }else{
                $table->estado = 'A';
                $table->archivo_nombre = $nombre;
                $table->archivo_extension = $extension;
                $table->fecha_alta = date('Y-m-d');
            }
            $table->descripcion = $data['descripcion'];
            $table->ruta = $data['ruta'];
            $table->categoria = $data['categoria'];
            
           // $table->fecha_carga = date('Y-m-d H:i:s');
            $table->usuario = $_SESSION['id'];
            
            //$table->usuario = 1;
            
            if($table->save()){
                return $table->id_registro;
            }else{
                return 0;
            }
        }
        
        function getDocumentos(){
            //session_start();
		$query = "SELECT d.* FROM documentos d "
                        . "WHERE 1 ";
		//echo $query;
                $result = $this->db->loadObjectList($query);
		if($result)
			return $result;
		else
			return false;
	}
        function getDocumentosbyid($id_registro){
                
		$query = "SELECT r.* "
                        . " FROM documentos r"
                        . " WHERE r.id_registro='".$id_registro."' ";
		//echo $query;
                $result = $this->db->loadObjectList($query);
		if($result)
			return $result[0];
		else
			return false;
	    }
        function getPersonasbyid($id_registro){

            $query = "SELECT r.*,date_format(r.fecha_nacimiento, '%d/%m/%Y') fecha_nacimiento,pd.* "
                . " FROM personas r "
                . " LEFT JOIN personas_dias pd ON pd.id_persona=r.id_persona "
                . " WHERE r.id_persona='".$id_registro."' ";
            //echo $query;
            $result = $this->db->loadObjectList($query);
            if($result)
                return $result[0];
            else
                return false;
        }

    function getpersonas(){
        $query = "SELECT a.*,date_format(a.fecha_nacimiento, '%d/%m/%Y') fecha_nacimiento "
            . "  FROM personas a WHERE 1 AND id_dominio='".$_SESSION['dominio']."' ORDER BY apellido, nombre ASC " ;
        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result) {
            foreach ($result as $item) {
                $item ->presentes= $this->getPresentePeriodo($item->id_persona);
                }

            return $result;

        }else
            return false;
    }
    function save_persona($data){
//        print_r($_SESSION);
//        exit;
        $fecha_nac=substr($data['fecha_nacimiento'], 6, 4)."-".substr($data['fecha_nacimiento'], 3, 2)."-".substr($data['fecha_nacimiento'], 0, 2);
        $table = new Table($this->db, 'personas');
        if(isset($data['id_persona'])){
            $table->find($data['id_persona']);

            //$table->fecha_modificacion = date('Y-m-d H:i:s');
        }else{
            $table->fecha_alta = date('Y-m-d H:i:s');

        }
        $table->nombre = $data['nombre'];
        $table->apellido = $data['apellido'];
        $table->dni = $data['dni'];
        $table->fecha_nacimiento = $fecha_nac;
        $table->domicilio_dni = $data['domicilio'];
        $table->telefono_particular = $data['telefono_particular'];
        $table->telefono_celular = $data['telefono_celular'];
        $table->mail = $data['mail'];
        if($data['estado']){
            $table->cod_estado = $data['estado'];
        }else{
            $table->cod_estado = 'A';
        }
        $table->id_proviene = $data['id_proviene'];
        $table->id_dominio = $_SESSION['dominio'];
        $table->usuario = $_SESSION['id'];
        $table->fecha_alta = date('Y-m-d H:i:s');
        if($table->save()){
            return $table->id_persona;
        }else{
            return 0;
        }
    }
        /*********************************************************************************/
    function getproductos(){
        $query = "SELECT a.* "
            . "  FROM productos a WHERE 1 ORDER BY descripcion ASC " ;
        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result;
        else
            return false;
    }
    function eliminar_persona($id_persona){
        $query = "DELETE FROM personas WHERE id_persona='".$id_persona."'";
        //$conn->execute($sql);
        $this->db->query($query);

    }
    function save_producto($data){
        $table = new Table($this->db, 'productos');
        if(isset($data['id_producto'])){
            $table->find($data['id_producto']);
            
        }
        $table->descripcion = $data['descripcion'];
        $table->precio = $data['precio'];
        $table->ingreso10_15 = $data['ingreso10_15'];
        $table->ingreso15_20 = $data['ingreso15_20'];
        $table->ingreso20_25 = $data['ingreso20_25'];
        $table->ingreso25_30 = $data['ingreso25_30'];
        $table->incremento_dia = $data['incremento_dia'];

        if($data['estado']){
            $table->estado = $data['estado'];
        }else{
            $table->estado = 'A';
        }
        $table->id_dominio = $_SESSION['dominio'];
        if($table->save()){
            return $table->id_producto;
        }else{
            return 0;
        }
    }
    function save_dias_productos($id_producuto,$data){
        $table = new Table($this->db, 'productos_dias');
        if(isset($data['id_producto_dias'])){
            $table->find($data['id_producto_dias']);

        }
        $table->id_producto = $id_producuto;
        $table->lunes = $data['lunes'];
        $table->martes = $data['martes'];
        $table->miercoles = $data['miercoles'];
        $table->jueves = $data['jueves'];
        $table->viernes = $data['viernes'];

        if($table->save()){
            return $table->id_producto_dias;
        }else{
            return 0;
        }
    }
    function save_dias_personas($id_persona,$data){
        $table = new Table($this->db, 'personas_dias');
        if(isset($data['id_persona_dias'])){
            $table->find($data['id_persona_dias']);

        }
        $table->id_persona = $id_persona;
        $table->lunes = $data['lunes'];
        $table->martes = $data['martes'];
        $table->miercoles = $data['miercoles'];
        $table->jueves = $data['jueves'];
        $table->viernes = $data['viernes'];

        if($table->save()){
            return $table->id_persona_dias;
        }else{
            return 0;
        }
    }
    function save_pago($data){
        //print_r($data);

        $table = new Table($this->db, 'pagos');

        $table->id_cliente = $data['id_cliente'];
        $table->periodo = $data['periodo'];
        $table->id_producto = $data['id_producto'];
        $table->monto = $data['monto'];
        $table->dias_retraso = $data['dias_retraso'];
        $table->monto_incremento = $data['monto_incremento'];
        $table->nota = $data['nota'];
        $table->usuario = $_SESSION['id'];
        $table->id_dominio = $_SESSION['dominio'];
        $table->fecha_hora = date('Y-m-d H:i:s');
        if($table->save()){
            return $table->id_pago;
        }else{
            return false;
        }
    }
    function getProductobyid($id_registro){

        $query = "SELECT r.*, pd.* "
            . " FROM productos r "
            . " LEFT JOIN productos_dias pd ON pd.id_producto=r.id_producto "
            . " WHERE r.id_producto='".$id_registro."' ";
        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result[0];
        else
            return false;
    }
    function save_relaciones($data){
        session_start();
        $fecha_ini=substr($data['fecha_inicio'], 6, 4)."-".substr($data['fecha_inicio'], 3, 2)."-".substr($data['fecha_inicio'], 0, 2);
        $table = new Table($this->db, 'relaciones');
        if(isset($data['id_relacion'])){
            $table->find($data['id_relacion']);

        }
        $table->id_persona = $data['clientes'];
        $table->id_producto = $data['id_producto'];
        $table->id_dominio = $_SESSION['dominio'];
        $table->fecha_inicio = $fecha_ini;


        if($table->save()){
            return $table->id_relacion;
        }else{
            return 0;
        }
    }
    function getRelaciones(){
        $query = "SELECT r.*, CONCAT_WS(' ',p.apellido, p.nombre) cliente, pr.descripcion producto "
            . "  FROM relaciones r
               INNER JOIN personas p ON p.id_persona=r.id_persona
               INNER JOIN productos pr ON pr.id_producto=r.id_producto
                WHERE 1  " ;
        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result;
        else
            return false;
    }
    function getRelacionByID($id_registro){
        $query = "SELECT r.*, CONCAT_WS(' ',p.apellido, p.nombre) cliente, pr.descripcion producto "
            . "  FROM relaciones r
               INNER JOIN personas p ON p.id_persona=r.id_persona
               INNER JOIN productos pr ON pr.id_producto=r.id_producto
                " ;
        $query .= " WHERE r.id_relacion='".$id_registro."' ";
        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result[0];
        else
            return false;
    }
    function getProductosByClientes($id_cliente){
        $query = "SELECT r.*, pr.descripcion producto "
            . "  FROM relaciones r
               INNER JOIN personas p ON p.id_persona=r.id_persona
               INNER JOIN productos pr ON pr.id_producto=r.id_producto
                " ;
        $query .= " WHERE r.id_persona='".$id_cliente."' ";
        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result;
        else
            return false;
    }
    function getRelacionByIDCliente($id_cliente){
        $query = "SELECT r.*, CONCAT_WS(' ',p.apellido, p.nombre) cliente, pr.descripcion producto,
         date_format(r.fecha_inicio, '%d/%m/%Y') fecha_inicio  "
            . "  FROM relaciones r
               INNER JOIN personas p ON p.id_persona=r.id_persona
               INNER JOIN productos pr ON pr.id_producto=r.id_producto
                " ;
        $query .= " WHERE r.id_persona='".$id_cliente."' ";
        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result;
        else
            return false;
    }
    function chequeaActividad($id_cliente,$id_producto){
        $query = "SELECT COUNT(r.id_relacion) total "
            . "  FROM relaciones r " ;
        $query .= " WHERE r.id_persona='".$id_cliente."' AND r.id_producto='".$id_producto."' ";
        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result[0]->total==0)
            return true;
        else
            return false;
    }
    function getContadorPagosRealizados($id_cliente){
        $query = "SELECT COUNT(p.id_pago) total FROM pagos p  " ;
        $query .= " WHERE p.id_cliente='".$id_cliente."' ";

        $result = $this->db->loadObjectList($query);
        if($result)
            return $result[0]->total;
        else
            return false;

    }
    function getPagosPeriodo($periodo,$cliente){
        $query = "SELECT COUNT(p.id_pago) total FROM pagos p  " ;
        $query .= " WHERE p.periodo='".$periodo."' AND  p.id_cliente='".$cliente."' ";
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result[0]->total;
        else
            return false;

    }
    function getPagos($fecha_desde=null, $fecha_hasta=null, $periodo=null){
        $query = "SELECT p.*, date_format(p.fecha_hora, '%d/%m/%Y %H:%i') fecha_pago ,  CONCAT_WS(' ',pr.apellido, pr.nombre) cliente,
                  pd.descripcion actividad
                  FROM pagos p 
                  INNER JOIN personas pr ON pr.id_persona=p.id_cliente 
                  INNER JOIN productos pd ON pd.id_producto=p.id_producto " ;
        if($fecha_desde && $fecha_hasta==null){
            $fecha_desde=substr($fecha_desde, 6, 4)."-".substr($fecha_desde, 3, 2)."-".substr($fecha_desde, 0, 2)." 00:00:00";
            $query .=" AND p.fecha_hora>='".$fecha_desde."'";
        }
        if($fecha_desde==null && $fecha_hasta){
            $fecha_hasta=substr($fecha_hasta, 6, 4)."-".substr($fecha_hasta, 3, 2)."-".substr($fecha_hasta, 0, 2)." 23:59:00";
            $query .=" AND p.fecha_hora<='".$fecha_hasta."'";
        }

        if($fecha_desde && $fecha_hasta){
            $fecha_desde=substr($fecha_desde, 6, 4)."-".substr($fecha_desde, 3, 2)."-".substr($fecha_desde, 0, 2)." 00:00:00";
            $fecha_hasta=substr($fecha_hasta, 6, 4)."-".substr($fecha_hasta, 3, 2)."-".substr($fecha_hasta, 0, 2)." 23:59:00";
            $query .=" AND (p.fecha_hora between '".$fecha_desde."' AND '".$fecha_hasta."')";
        }
        if($periodo){
            $fecha_desde=substr($fecha_desde, 6, 4)."-".substr($fecha_desde, 3, 2)."-".substr($fecha_desde, 0, 2)." 00:00:00";
            $fecha_hasta=substr($fecha_hasta, 6, 4)."-".substr($fecha_hasta, 3, 2)."-".substr($fecha_hasta, 0, 2)." 23:59:00";
            $query .=" AND p.periodo ='".$periodo."'";
        }
        //$query .= " WHERE p.periodo='".$periodo."' ";
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result;
        else
            return false;

    }
    function getProductosByClientesDNI($dni_cliente){
        $query = "SELECT r.*, pr.descripcion producto "
            . "  FROM relaciones r
               INNER JOIN personas p ON p.id_persona=r.id_persona
               INNER JOIN productos pr ON pr.id_producto=r.id_producto
                " ;
        $query .= " WHERE p.dni='".$dni_cliente."' ";
        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result;
        else
            return false;
    }
    function getPagosClientesPeriodo($cliente){
        $query = "SELECT COUNT(p.id_pago) total FROM pagos p 
        LEFT JOIN personas pr ON pr.id_persona=p.id_cliente " ;
        $query .= " WHERE p.periodo='".(int)date('m')."' AND  pr.dni='".$cliente."' ";
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result[0]->total;
        else
            return false;

    }
    function getDatosClientesPeriodo($cliente){
        $query = "SELECT CONCAT_WS(' ', p.nombre,p.apellido) cliente,p.id_persona FROM  personas p " ;
        $query .= " WHERE  p.dni='".$cliente."' ";
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result[0];
        else
            return false;

    }
    function save_presente($id_cliente,$id_actividad){
        session_start();
        $table = new Table($this->db, 'presente_cliente');
        $table->id_cliente = $id_cliente;
        $table->id_producto = $id_actividad;
        $table->fecha_hora = date('Y-m-d H:i:s');
        $table->id_dominio = $_SESSION['dominio'];
        if($table->save()){
            return $table->id_presente;
        }else{
            return false;
        }
    }
    function getValidaPresente($cliente){
        $query = "SELECT COUNT(p.id_presente) total FROM presente_cliente p 
        WHERE p.id_cliente='".$cliente."' AND date_format(p.fecha_hora, '%Y-%m-%d')='".date('Y-m-d')."' ";
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result[0]->total;
        else
            return false;

    }
    function getProviene(){
        $query = "SELECT a.* "
            . "  FROM proviene a WHERE 1 ORDER BY id_registro ASC " ;
        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result;
        else
            return false;
    }
    function getPresentePeriodo($cliente){
        $query = "SELECT COUNT(p.id_presente) total FROM presente_cliente p 
        WHERE p.id_cliente='".$cliente."' AND date_format(p.fecha_hora, '%m')='".date('m')."' ";
        echo $query;
        $result = $this->db->loadObjectList($query);

        if($result)
            return $result[0]->total;
        else
            return false;

    }
}     
$consultas= new Consultas($db);