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

    function getpersonas($apellidofiltro=null, $nombrefiltro=null, $dni=null){
            session_start();
        $query = "SELECT p.*,date_format(p.fecha_nacimiento, '%d/%m/%Y') fecha_nacimiento "
            . "  FROM personas p

            WHERE 1 AND p.id_dominio='".$_SESSION['dominio']."' ";
        if($apellidofiltro){
            $query .=" AND p.apellido like '%$apellidofiltro%'";
        }
        if($nombrefiltro){
            $query .=" AND p.nombre like '%$nombrefiltro%'";
        }
        if($dni){
            $query .=" AND p.dni like '%$dni%'";
        }
        $query .= " ORDER BY p.apellido, p.nombre ASC " ;

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
		function getpersonasApi(){
          //  session_start();
        $query = "SELECT p.*,date_format(p.fecha_nacimiento, '%d/%m/%Y') fecha_nacimiento "
            . "  FROM personas p

            WHERE 1 ";

        $query .= " ORDER BY p.apellido, p.nombre ASC " ;

      //  echo $query;
        //$result = $this->db->loadObjectList($query);
        //if($result) {
					while ($row = $this->db->loadObjectList($query)) {
					    $data[] = array(
					        'label' =>$row['apellido'],
					        'id' =>$row['id_persona']
					    );

					}
            return $data;

    }
    function getcontarpersonas(){
        $query = "SELECT COUNT(a.id_persona) total "
            . "  FROM personas a WHERE 1 AND id_dominio='".$_SESSION['dominio']."' ORDER BY apellido, nombre ASC " ;
//        echo $query;
        $result = $this->db->loadObjectList($query);
        if($result) {
            return $result[0]->total;

        }else
            return false;
    }
    function getNombreUsuario($id_persona){
            $query = "SELECT * FROM c0580050_jp.personas WHERE id_persona='".$id_persona."'";

            $result = $this->db->loadObjectList($query);
            if($result)
                return $result[0];
            else
                return false;

        }
        function checkLogin($user, $pass, $count=0){

            $query = "SELECT COUNT(*) AS C FROM c0580050_jp.usuarios WHERE nombre='".$user."' AND clave='".$pass."' AND estado='A'";
            $result = $this->db->loadObjectList($query);
            if($result[0]->C>0)
                return true;
            else
                return false;
        }


        function save_persona($data){
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
        function getUser($iddata,$clave){

        $query = "SELECT u.*,d.descripcion nombre_dominio,d.aplicativo,d.id_dominio FROM c0580050_jp.usuarios u
            INNER JOIN c0580050_jp.usuario_dominio ud ON ud.id_usuario=u.id_usuario
            INNER JOIN c0580050_jp.dominio d ON d.id_dominio=ud.id_dominio
             WHERE u.nombre='".$iddata."' AND  u.clave='".$clave."'";
//echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result[0];
        else
            return false;
    }
    /*********************************************************************************/
    function getproductos(){
        $query = "SELECT a.* "
            . "  FROM productos a WHERE 1 AND id_dominio='".$_SESSION['dominio']."' ORDER BY descripcion ASC " ;
        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result;
        else
            return false;
    }
    function getcontarproductos(){
        $query = "SELECT COUNT(a.id_producto) total "
            . "  FROM productos a WHERE 1 AND id_dominio='".$_SESSION['dominio']."' ORDER BY descripcion ASC " ;
        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result[0]->total;
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
        $table->estado = 'A';
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
//echo $query;
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
        session_start();
        $query = "SELECT p.*, date_format(p.fecha_hora, '%d/%m/%Y %H:%i') fecha_pago ,  CONCAT_WS(' ',pr.apellido, pr.nombre) cliente,
                  pd.descripcion actividad
                  FROM pagos p
                  INNER JOIN personas pr ON pr.id_persona=p.id_cliente
                  INNER JOIN productos pd ON pd.id_producto=p.id_producto
                  WHERE p.estado='A' AND p.id_dominio='".$_SESSION['dominio']."' " ;
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
        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result;
        else
            return false;

    }
    function eliminar_pago($idPago){
        $query = "UPDATE pagos
                      SET estado='B'
                      WHERE id_pago='$idPago'";
        $this->db->query($query);

    }
    function getcontarPagos($periodo=null){
        session_start();
        $query = "SELECT COUNT(p.id_pago) total
                  FROM pagos p
                  INNER JOIN personas pr ON pr.id_persona=p.id_cliente
                  INNER JOIN productos pd ON pd.id_producto=p.id_producto
                  WHERE 1 AND p.id_dominio='".$_SESSION['dominio']."' " ;
        if($periodo){
            $query .=" AND p.periodo ='".$periodo."'";
        }

        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result[0]->total;
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
        session_start();
        $query = "SELECT COUNT(p.id_pago) total FROM pagos p
        LEFT JOIN personas pr ON pr.id_persona=p.id_cliente " ;
        $query .= " WHERE pr.id_dominio='".$_SESSION['dominio']."' AND p.periodo='".(int)date('m')."' AND  pr.dni='".$cliente."' ";
        //echo $query;
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
            . "  FROM proviene a WHERE 1 AND id_dominio='".$_SESSION['dominio']."' ORDER BY id_registro ASC " ;
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
        //echo $query;
        $result = $this->db->loadObjectList($query);

        if($result)
            return $result[0]->total;
        else
            return false;

    }

    function getMenuUsuario(){
        $query = "SELECT * FROM aplicativos a "
            . " INNER JOIN usuario_aplicativos ua ON ua.id_aplicativo=a.id_aplicativo"
            . " WHERE ua.id_aplicativo!='16' AND ua.id_usuario='".$_SESSION['id']."'";

        $result = $this->db->loadObjectList($query);
        if($result)
            return $result;
        else
            return false;
    }
    function getMenuAgrupador(){
        $query = "SELECT ma.id_menu, m.descripcion,m.icon FROM aplicativos a "
            . " INNER JOIN usuario_aplicativos ua ON ua.id_aplicativo=a.id_aplicativo"
            . " INNER JOIN menu_aplicativo ma ON ma.id_aplicativo=a.id_aplicativo"
            . " INNER JOIN menu m ON m.id_menu=ma.id_menu"
            . " WHERE 1 AND ua.id_usuario='".$_SESSION['id']."' GROUP BY ma.id_menu";
//echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result;
        else
            return false;
    }
    function getMenuAplicativos($id_menu){
//        $query = "SELECT a.* FROM aplicativos a "
//            . " INNER JOIN usuario_aplicativos ua ON ua.id_aplicativo=a.id_aplicativo"
//            . " INNER JOIN menu_aplicativo ma ON ma.id_aplicativo=a.id_aplicativo"
//            . " INNER JOIN menu m ON m.id_menu=ma.id_menu"
//            . " WHERE 1 AND ua.id_usuario='".$_SESSION['id']."' AND ma.id_menu='".$id_menu."'";

        $query = "SELECT a.*
              FROM aplicativos a "
            . " INNER JOIN usuario_aplicativos ua ON ua.id_aplicativo=a.id_aplicativo "
            . " INNER JOIN menu_aplicativo ma ON ma.id_aplicativo=a.id_aplicativo "
            . " INNER JOIN usuarios u ON u.id_usuario=ua.id_usuario "
            . " WHERE 1 AND ua.id_usuario='".$_SESSION['id']."' AND ma.id_menu='".$id_menu."'";
       //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result;
        else
            return false;
    }
    /***************************************/
    /*****************menu**********************/
    /***************************************/
    function getMenu(){
        $query = "SELECT * FROM menu a "
            . " WHERE 1 ";

        $result = $this->db->loadObjectList($query);
        if($result)
            return $result;
        else
            return false;
    }
    function save_menu($data){
        $table = new Table($this->db, 'menu');
        if(isset($data['id_menu'])){
            $table->find($data['id_menu']);
        }
        $table->descripcion = $data['descripcion'];
        $table->icon = $data['icon'];

        if($data['estado']){
            $table->estado = $data['estado'];
        }else{
            $table->estado = 'A';
        }
        if($table->save()){
            return $table->id_menu;
        }else{
            return 0;
        }
    }
    function getMenubyid($id_registro){

        $query = "SELECT m.* "
            . " FROM menu m "
            . " WHERE m.id_menu='".$id_registro."' ";
        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result[0];
        else{
            return 0;
        }

    }
    function eliminar_menu($reg){
        $query = "DELETE FROM menu WHERE id_menu='".$reg."'";
        //$conn->execute($sql);
        $this->db->query($query);

    }
    /***************************************/
    /*****************aplicativos**********************/
    /***************************************/
    function getAplicativo(){
        $query = "SELECT * FROM aplicativos a "
            . " WHERE 1 ";

        $result = $this->db->loadObjectList($query);
        if($result)
            return $result;
        else
            return false;
    }
    function save_aplicativos($data){
//        s
        $table = new Table($this->db, 'aplicativos');
        if(isset($data['id_aplicativo'])){
            $table->find($data['id_aplicativo']);
        }
        $table->nombre_menu = $data['nombre_menu'];
        $table->nombre_action = $data['nombre_action'];
        $table->tipo = $data['tipo'];

        if($table->save()){
            return $table->id_aplicativo;
        }else{
            return 0;
        }
    }
    function getAplicativobyid($id_registro){

        $query = "SELECT m.* "
            . " FROM aplicativos m "
            . " WHERE m.id_aplicativo='".$id_registro."' ";
        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result[0];
        else{
            return 0;
        }

    }
    function getAplicativoPorTipo($tipo){

        $query = "SELECT m.* "
            . " FROM aplicativos m "
            . " WHERE m.tipo='".$tipo."' ";
       // echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result;
        else{
            return 0;
        }

    }
    function eliminar_aplicativo($reg){
        $query = "DELETE FROM aplicativos WHERE id_aplicativo='".$reg."'";
        //$conn->execute($sql);
        $this->db->query($query);

    }
    /***************************************/
    /*****************aplicativos menues**********************/
    /***************************************/
    function getAplicativoMenu(){
        $query = "SELECT ma.*, m.descripcion menu, a.nombre_menu aplicativo FROM aplicativos a "
            . " INNER JOIN menu_aplicativo ma ON ma.id_aplicativo=a.id_aplicativo "
            . " INNER JOIN menu m ON m.id_menu=ma.id_menu "
            . " WHERE 1 ";

        $result = $this->db->loadObjectList($query);
        if($result)
            return $result;
        else
            return false;
    }

    function save_aplicativo_menu($data){
//        s
        $table = new Table($this->db, 'menu_aplicativo');

        $table->id_menu = $data['menu'];
        $table->id_aplicativo = $data['aplicativo'];

        if($table->save()){
            return $table->id_relacion;
        }else{
            return 0;
        }
    }

    function eliminar_aplicativo_menu($reg){
        $query = "DELETE FROM menu_aplicativo WHERE id_relacion='".$reg."'";
        //$conn->execute($sql);
        $this->db->query($query);

    }
    /***************************************/
    /*****************aplicativos menues* por persona*********************/
    /***************************************/
    function getAplicativoPersonas($dato=null){
        $query = "SELECT ua.*, a.nombre_menu aplicativo , u.nombre_persona persona
              FROM aplicativos a "
            . " INNER JOIN usuario_aplicativos ua ON ua.id_aplicativo=a.id_aplicativo "
            . " INNER JOIN usuarios u ON u.id_usuario=ua.id_usuario "
            . " WHERE 1 ";

        $result = $this->db->loadObjectList($query);
        if($result)
            return $result;
        else
            return false;
    }
    function save_aplicativo_persona($data){

        $table = new Table($this->db, 'usuario_aplicativos');

        $table->id_usuario = $data['usuario'];
        $table->id_aplicativo = $data['aplicativo'];

        if($table->save()){
            return $table->id_relacion;
        }else{
            return 0;
        }
    }

    function eliminar_aplicativo_Persona($reg){
        $query = "DELETE FROM usuario_aplicativos WHERE id_registro='".$reg."'";
        //$conn->execute($sql);
        $this->db->query($query);

    }
    /***************************************/
    /*****************abm dominios*********************/
    /***************************************/
    function getDominios($dato=null){
        $query = "SELECT a.*, dt.descripcion tipo_dominio
              FROM dominio a INNER JOIN dominio_tipo dt ON dt.id_tipo_dominio=a.tipo "
            . " WHERE 1 ";

        $result = $this->db->loadObjectList($query);
        if($result)
            return $result;
        else
            return false;
    }
    function getDominobyid($id_registro){

        $query = "SELECT m.*, dt.descripcion tipo_dominio "
            . " FROM dominio m
            INNER JOIN dominio_tipo dt ON dt.id_tipo_dominio=m.tipo "
            . " WHERE m.id_dominio='".$id_registro."' ";
        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result[0];
        else{
            return 0;
        }

    }
    function save_dominio($data){

        $table = new Table($this->db, 'dominio');
        if(isset($data['id_dominio'])){
            $table->find($data['id_dominio']);
        }
        $table->descripcion = $data['descripcion'];
        $table->aplicativo = 'sys';
        $table->tipo = $data['tipo'];
        $table->estado = 'A';
        $table->usuario = '1';

        if($table->save()){
            return $table->id_dominio;
        }else{
            return 0;
        }
    }

    function eliminar_dominio($reg){
        $query = "DELETE FROM dominio WHERE id_dominio='".$reg."'";
        //$conn->execute($sql);
        $this->db->query($query);

    }
    /***************************************/
    /*****************abm dominios*********************/
    /***************************************/
    function getUsuarios(){
        $query = "SELECT u.* ,d.descripcion dominio
              FROM usuarios u
               LEFT JOIN  usuario_dominio ud ON ud.id_usuario=u.id_usuario
               LEFT JOIN  dominio d ON d.id_dominio=ud.id_dominio
               WHERE 1 ";

        $result = $this->db->loadObjectList($query);
        if($result)
            return $result;
        else
            return false;
    }
    function getUsuariosById($id_registro){

        $query = "SELECT m.*, d.descripcion dominio, ud.id_dominio id_dom "
            . "  FROM usuarios m
               LEFT JOIN  usuario_dominio ud ON ud.id_usuario=m.id_usuario
               LEFT JOIN  dominio d ON d.id_dominio=ud.id_dominio  "
            . " WHERE m.id_usuario='".$id_registro."' ";
        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result[0];
        else{
            return 0;
        }

    }
    function save_usuario($data){

        $table = new Table($this->db, 'usuarios');
        if(isset($data['id_usuario'])){
            $table->find($data['id_usuario']);
        }
        $table->nombre_persona = $data['nombre_persona'];
        $table->nombre = $data['nombre'];
        $table->clave = $data['clave'];
        $table->tipo = $data['tipo'];
        $table->rol = $data['rol'];
        $table->usuario = $_SESSION['id'];
        $table->fecha_baja = "0000-00-00";
        $table->fecha_ultima_modificacion = "0000-00-00 00:00:00";
        $table->estado = 'A';


        if($table->save()){
            return $table->id_usuario;
        }else{
            return 0;
        }
    }
    function save_persona_dominio($data){

        $table = new Table($this->db, 'usuario_dominio');

        $table->id_usuario = $data['id_usuario'];
        $table->id_dominio = $data['dominios'];
        $table->estado = 'A';

        if($table->save()){
            return $table->id_relacion;
        }else{
            return 0;
        }
    }

    function eliminar_usuario($reg){
        $query = "DELETE FROM dominio WHERE id_dominio='".$reg."'";
        //$conn->execute($sql);
        $this->db->query($query);

    }
    function eliminar_aplicativos_usuario($usuario){
        $query = "DELETE FROM usuario_aplicativos WHERE id_usuario='".$usuario."'";
        //$conn->execute($sql);
        $this->db->query($query);

    }
    function eliminar_dominio_usuario($usuario){
        $query = "DELETE FROM usuario_dominio WHERE id_usuario='".$usuario."'";
        //$conn->execute($sql);
        $this->db->query($query);

    }
    function save_contrasenia($datar){
        session_start();
        global $error;
        //insert o update del rol
        $query = "UPDATE usuarios
                      SET clave='".$datar."'
                      WHERE id_usuario='".$_SESSION['id']."'";
        $this->db->query($query);

    }
    function getEvoluciones($id_registro){

        $query = "SELECT e.*,date_format(e.fecha_hora, '%d/%m/%Y') fecha_evolucion ,CONCAT_WS(' ',p.nombre, p.apellido) paciente,u.nombre_persona nombre_usuario "
            . " FROM evoluciones e "
            . " INNER JOIN personas p ON p.id_persona=e.id_persona "
            . " INNER JOIN dominio d ON d.id_dominio=e.id_dominio "
            . " INNER JOIN usuarios u ON u.id_usuario=e.usuario "
            . " WHERE p.id_persona='".$id_registro."' ";
        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result;
        else
            return false;
    }
    public function getTurnos($persona=null) {
        $query = "SELECT t.* , date_format(t.fecha_turno, '%d/%m/%Y') fecha,
									date_format(t.fecha_turno, '%H/%i') hora,
									m.descripcion motivo,
									CONCAT_WS(' ',p.apellido,p.nombre) cliente
                  FROM turnos t
                  LEFT JOIN motivos_turno m ON m.id_motivo=t.id_motivo
									  LEFT JOIN personas p ON p.id_persona=t.id_persona
									WHERE 1 ";
				if($persona){
					$query .= " AND t.id_persona = $persona";
				}
				$query .= " ORDER BY  t.fecha_turno DESC";
				//echo $query;
        $resutlt = $this->db->loadObjectList($query);
        if ($resutlt) {
            return $resutlt;
        }
        return array();
    }
    function save_turno_persona($data){
        $fecha=substr($data['fecha_turno'], 6, 4)."-".substr($data['fecha_turno'], 3, 2)."-".substr($data['fecha_turno'], 0, 2)."-".substr($data['hora'], 0, 5).":00";
        $table = new Table($this->db, 'turnos');

        $table->id_persona = $data['id_persona'];
        $table->id_motivo = $data['motivo'];
        $table->usuario = $_SESSION['id'];
				$table->id_dominio = $_SESSION['dominio'];
        $table->fecha_turno = $fecha;
				$table->tipo_turno = $data['tipo_turno'];
				$table->estado = $data['estado_turno'];
				$table->observaciones = $data['observaciones'];
        $table->fecha_carga = date('Y-m-d H:i:s');
        $table->estado = 'Asignado';


        if($table->save()){
            return true;
        }else{
            return false;
        }
    }
    public function getMotivos(){
        $query = "SELECT *
                  FROM  motivos_turno m
                  WHERE 1 ";
        $resutlt = $this->db->loadObjectList($query);
        if ($resutlt) {
            return $resutlt;
        }
        return array();
    }
    function getpersonasDos(){
        $query = "SELECT a.* "
            . "  FROM personas_dos a WHERE 1 " ;
        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result) {

            return $result;

        }else
            return false;
    }
    function getpersonasDiaDos($idpersona){
        $query = "SELECT a.* "
            . "  FROM personas_dias_dos a WHERE a.id_persona='".$idpersona."' " ;
        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result) {
            return $result[0];
        }else
            return false;
    }
    function save_persona_migrada($data){

        $table = new Table($this->db, 'personas');

        $table->fecha_alta = date('Y-m-d H:i:s');

        $table->nombre = $data->nombre;
        $table->apellido = $data->apellido;
        $table->dni = $data->dni;
        $table->cod_estado = 'A';
        $table->id_dominio = 3;
        $table->usuario = 4;
        $table->fecha_alta = date('Y-m-d H:i:s');
        if($table->save()){
            return $table->id_persona;
        }else{
            return 0;
        }
    }
    function save_dias_personas_dos($id_persona_nueva,$data){
        $table = new Table($this->db, 'personas_dias');

        $table->id_persona = $id_persona_nueva;
        $table->lunes = $data->lunes;
        $table->martes = $data->martes;
        $table->miercoles = $data->miercoles;
        $table->jueves = $data->jueves;
        $table->viernes = $data->viernes;

        if($table->save()){
            return $table->id_persona_dias;
        }else{
            return 0;
        }
    }
    function getAsistencias($fecha_desde=null, $fecha_hasta=null, $dni=null){
        session_start();
        $query = "SELECT CONCAT_WS(' ',p.apellido,p.nombre) persona,
                        date_format(pp.fecha_hora, '%d/%m/%Y') fecha_h "
            . "  FROM personas p
            INNER JOIN presente_cliente pp ON pp.id_cliente=p.id_persona
            WHERE 1 AND pp.id_dominio='".$_SESSION['dominio']."' ";
        if($fecha_desde && $fecha_hasta==null){
            $fecha_desde=substr($fecha_desde, 6, 4)."-".substr($fecha_desde, 3, 2)."-".substr($fecha_desde, 0, 2)." 00:00:00";
            $query .=" AND pp.fecha_hora>='".$fecha_desde."'";
        }
        if($fecha_desde==null && $fecha_hasta){
            $fecha_hasta=substr($fecha_hasta, 6, 4)."-".substr($fecha_hasta, 3, 2)."-".substr($fecha_hasta, 0, 2)." 23:59:00";
            $query .=" AND pp.fecha_hora<='".$fecha_hasta."'";
        }

        if($fecha_desde && $fecha_hasta){
            $fecha_desde=substr($fecha_desde, 6, 4)."-".substr($fecha_desde, 3, 2)."-".substr($fecha_desde, 0, 2)." 00:00:00";
            $fecha_hasta=substr($fecha_hasta, 6, 4)."-".substr($fecha_hasta, 3, 2)."-".substr($fecha_hasta, 0, 2)." 23:59:00";
            $query .=" AND (pp.fecha_hora between '".$fecha_desde."' AND '".$fecha_hasta."')";
        }
        if($dni){
            $query .=" AND p.dni like '%$dni%'";
        }
        //$query .= " ORDER BY p.apellido, p.nombre ASC " ;

        echo $query;
        $result = $this->db->loadObjectList($query);
        if($result) {
            return $result;

        }else
            return false;
    }
		function getCountTurnosDia($fecha_turno){
			session_start();
			$fecha_desde=substr($fecha_turno, 6, 4)."-".substr($fecha_turno, 3, 2)."-".substr($fecha_turno, 0, 2)." 00:00:00";
			$fecha_hasta=substr($fecha_turno, 6, 4)."-".substr($fecha_turno, 3, 2)."-".substr($fecha_turno, 0, 2)." 23:59:00";

        $query = "SELECT COUNT(t.id_turno) total FROM turnos t  WHERE 1 AND t.id_dominio='".$_SESSION['dominio']."' " ;
				$query .=" AND (t.fecha_turno between '".$fecha_desde."' AND '".$fecha_hasta."')";
				$query .="  ";
				//echo $query;
        $result = $this->db->loadObjectList($query);
        if($result) {
            return $result[0]->total;

        }else
            return false;
    }
		function cancelar_turno($idturno){
        $query = "UPDATE turnos
                      SET estado='Cancelado'
                      WHERE id_turno='$idturno'";
        $this->db->query($query);

    }
		function save_motivo($data){
        $table = new Table($this->db, 'motivos_turno');
        if(isset($data['id_motivo'])){
            $table->find($data['id_motivo']);
        }
        $table->descripcion = $data['descripcion'];
				$table->usuario = $_SESSION['id'];
				$table->id_dominio = $_SESSION['dominio'];
				$table->fecha_alta = date('Y-m-d H:i:s');
        if($data['estado']){
            $table->estado = $data['estado'];
        }else{
            $table->estado = 'A';
        }
        if($table->save()){
            return true;
        }else{
            return false;
        }
    }
		function save_problema($data){
        $table = new Table($this->db, 'problemas');
        if(isset($data['id_problemas'])){
            $table->find($data['id_problemas']);
        }
        $table->descripcion = $data['descripcion'];
				$table->usuario = $_SESSION['id'];
				$table->id_dominio = $_SESSION['dominio'];
				$table->fecha_alta = date('Y-m-d H:i:s');
        if($data['estado']){
            $table->estado = $data['estado'];
        }else{
            $table->estado = 'A';
        }
        if($table->save()){
            return true;
        }else{
            return false;
        }
    }
		function getProblemas(){
				$query = "SELECT pp.descripcion, pp.id_problema FROM c0580050_jp.problemas pp
									WHERE pp.estado='A'";

				$result = $this->db->loadObjectList($query);
				if($result)
						return $result;
				else
						return false;

		}
		function getProblemasByPersona($idpersona){
				$query = "SELECT pr.descripcion, pr.id_problema
				FROM c0580050_jp.problemas pr
				INNER JOIN c0580050_jp.problemas_personas pp ON pp.id_problema=pr.id_problema

									WHERE pp.id_persona='".$idpersona."'";

				$result = $this->db->loadObjectList($query);
				if($result)
						return $result;
				else
						return false;

		}

}
$consultas= new Consultas($db);
