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

            $query = "SELECT r.*,date_format(r.fecha_nacimiento, '%d/%m/%Y') fecha_nacimiento,pd.*,pc.id_registro id_persona_cobertura,
						 c.descripcion cobertura, c.id_cobertura  id_cobertura, pc.numero_cobertura, cp.descripcion plan_cobertura, pc.id_plan id_plan_cobertura  "
                . " FROM personas r "
								. " LEFT JOIN personas_dias pd ON pd.id_persona=r.id_persona "
								. " LEFT JOIN persona_cobertura pc ON pc.id_persona=r.id_persona "
								. " LEFT JOIN cobertura c ON c.id_cobertura=pc.id_cobertura "
                . " LEFT JOIN cobertura_plan cp ON cp.id_plan_cobertura=pc.id_plan "
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
            $table->cuil = $data['cuil'];
            $table->fecha_nacimiento = $fecha_nac;
            $table->domicilio_dni = $data['domicilio'];
            $table->telefono_particular = $data['telefono_particular'];
            $table->telefono_celular = $data['telefono_celular'];
						$table->mail = $data['mail'];
						$table->nro_socio = $data['nro_socio'];
            $table->dia_venc = $data['dia_venc'];
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
				function save_persona_cobertura($id_persona_cobertura,$id_persona,$data){

            $table = new Table($this->db, 'persona_cobertura');
            if(isset($id_persona_cobertura)){
                $table->find($id_persona_cobertura);
                //$table->fecha_modificacion = date('Y-m-d H:i:s');
            }
						$table->id_persona = $id_persona;
            $table->id_cobertura = $data['cobertura'];
						$table->id_plan = $data['plan_cobertura'];
						$table->numero_cobertura = $data['numero_cobertura'];
            $table->estado = 'A';
            if($table->save()){
                return $table->id_relacion;
            }else{
                return 0;
            }
        }

				function save_persona_auto($id_persona,$data){

            $table = new Table($this->db, 'persona_auto');

						$table->id_persona = $id_persona;
            $table->id_marca= $data['marca'];
						$table->patente = $data['patente'];
						$table->modelo = $data['modelo'];
            $table->estado = 'A';
            if($table->save()){
                return $table->id_relacion;
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
		function eliminar_vehiculo_persona($id_relacion){
        $query = "DELETE FROM persona_auto WHERE id_relacion='".$id_relacion."'";
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
    function getRelaciones($actividad=null){
			session_start();
        $query = "SELECT r.*, CONCAT_WS(' ',p.apellido, p.nombre) persona, pr.descripcion producto "
            . "  FROM relaciones r
               INNER JOIN personas p ON p.id_persona=r.id_persona AND p.cod_estado='A'
               INNER JOIN productos pr ON pr.id_producto=r.id_producto

                WHERE p.id_dominio='".$_SESSION['dominio']."'  " ;
								if($actividad){
								$query .= " AND pr.id_producto='".$actividad."' ";
								}

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
        $query .= " WHERE r.estado='A' AND r.id_persona='".$id_cliente."' ";
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
		function chequeaPatente($id_cliente,$marca,$patente){
        $query = "SELECT COUNT(r.id_relacion) total "
            . "  FROM persona_auto r " ;
        $query .= " WHERE r.id_persona='".$id_cliente."' AND r.patente='".$patente."'  AND r.id_marca='".$marca."' ";
        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result[0]->total==0)
            return true;
        else
            return false;
    }
		function getAutoByPersona($id_cliente){
        $query = "SELECT pa.*,m.descripcion marca "
            . "  FROM persona_auto pa
									INNER JOIN marcas m ON m.id_marca=pa.id_marca " ;
        $query .= " WHERE pa.id_persona='".$id_cliente."'";
        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result;
        else
            return false;
    }
    function getContadorPagosRealizados($id_cliente,$periodo=null){
        $query = "SELECT COUNT(p.id_pago) total FROM pagos p  " ;
				$query .= " WHERE p.id_cliente='".$id_cliente."' ";
				if($periodo){
					$query .= " AND p.periodo='".$periodo."' ";

				}
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result[0]->total;
        else
            return false;

    }
    function getPagosPeriodo($periodo,$cliente){
			$periodoMas=$periodo++;
        $query = "SELECT COUNT(p.id_pago) total FROM pagos p  " ;
        $query .= " WHERE (p.periodo='".$periodo."' OR p.periodo='".$periodoMas."') AND  p.id_cliente='".$cliente."' ";
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
    function getProductosByClientesDNI($dni_cliente, $dominio){
        $query = "SELECT r.*, pr.descripcion producto "
            . "  FROM relaciones r
               INNER JOIN personas p ON p.id_persona=r.id_persona
               INNER JOIN productos pr ON pr.id_producto=r.id_producto
                " ;
        $query .= " WHERE p.dni='".$dni_cliente."' AND p.id_dominio='".$dominio."' ";
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
    function getDatosClientesPeriodo($cliente, $dominio){
        $query = "SELECT CONCAT_WS(' ', p.nombre,p.apellido) cliente,p.id_persona FROM  personas p " ;
        $query .= " WHERE  p.dni='".$cliente."' AND  p.id_dominio='".$dominio."'  ";
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result[0];
        else
            return false;

    }
    function save_presente($id_cliente,$id_actividad,$dominio){
        session_start();
        $table = new Table($this->db, 'presente_cliente');
        $table->id_cliente = $id_cliente;
        $table->id_actividad = $id_actividad;
        $table->fecha_hora = date('Y-m-d H:i:s');
        $table->id_dominio = $dominio;
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

        $query = "SELECT e.*,date_format(e.fecha_hora, '%d/%m/%Y %H/%i') fecha_evolucion ,CONCAT_WS(' ',p.nombre, p.apellido) paciente,u.nombre_persona nombre_usuario "
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
    public function getTurnos($persona=null,$fecha_desde=null,$fecha_hasta=null,$apellidofiltro=null,$nombrefiltro=null,$dnifiltro=null,$motivofiltro=null) {
			session_start();
        $query = "SELECT t.* , date_format(t.fecha_turno, '%d/%m/%Y') fecha,
									date_format(t.fecha_turno, '%H/%i') hora,
									m.descripcion motivo,
									CONCAT_WS(' ',p.apellido,p.nombre) cliente
                  FROM turnos t
                  LEFT JOIN motivos_turno m ON m.id_motivo=t.id_motivo
									  LEFT JOIN personas p ON p.id_persona=t.id_persona
									WHERE 1 AND t.id_dominio='".$_SESSION['dominio']."' ";
				if($persona){
					$query .= " AND t.id_persona = $persona";
				}
				if($apellidofiltro){
            $query .=" AND p.apellido like '%$apellidofiltro%'";
        }
        if($nombrefiltro){
            $query .=" AND p.nombre like '%$nombrefiltro%'";
        }
        if($dnifiltro){
            $query .=" AND p.dni like '%$dnifiltro%'";
        }
				if($motivofiltro){
            $query .=" AND t.id_motivo like '%$motivofiltro%'";
        }
				if($fecha_desde==null && $fecha_hasta==null){
            //$fecha_desde=substr($fecha_desde, 6, 4)."-".substr($fecha_desde, 3, 2)."-".substr($fecha_desde, 0, 2)." 00:00:00";
            $query .=" AND (t.fecha_turno between '".date('Y-m-d')." 00:00:00' AND '".date('Y-m-d')." 23:59:50')";
        }
				if($fecha_desde && $fecha_hasta==null){
            $fecha_desde=substr($fecha_desde, 6, 4)."-".substr($fecha_desde, 3, 2)."-".substr($fecha_desde, 0, 2)." 00:00:00";
            $query .=" AND t.fecha_turno>='".$fecha_desde."'";
        }
        if($fecha_desde==null && $fecha_hasta){
            $fecha_hasta=substr($fecha_hasta, 6, 4)."-".substr($fecha_hasta, 3, 2)."-".substr($fecha_hasta, 0, 2)." 23:59:00";
            $query .=" AND t.fecha_turno<='".$fecha_hasta."'";
        }

        if($fecha_desde && $fecha_hasta){
            $fecha_desde=substr($fecha_desde, 6, 4)."-".substr($fecha_desde, 3, 2)."-".substr($fecha_desde, 0, 2)." 00:00:00";
            $fecha_hasta=substr($fecha_hasta, 6, 4)."-".substr($fecha_hasta, 3, 2)."-".substr($fecha_hasta, 0, 2)." 23:59:00";
            $query .=" AND (t.fecha_turno between '".$fecha_desde."' AND '".$fecha_hasta."')";
        }
				$query .= " ORDER BY  t.fecha_turno DESC";
				//echo $query;
        $resutlt = $this->db->loadObjectList($query);
        if ($resutlt) {
            return $resutlt;
        }
        return array();
    }
		public function getTurnosClientes($persona=null,$fecha_desde=null,$fecha_hasta=null,$apellidofiltro=null,$nombrefiltro=null,$dnifiltro=null,$motivofiltro=null) {
			session_start();
        $query = "SELECT t.* , date_format(t.fecha_turno, '%d/%m/%Y') fecha,
									date_format(t.fecha_turno, '%H/%i') hora,
									m.descripcion motivo,
									CONCAT_WS(' ',p.apellido,p.nombre) cliente
                  FROM turnos_peluqueria t
                  LEFT JOIN motivos_turno m ON m.id_motivo=t.id_motivo
									  LEFT JOIN clientes p ON p.id_cliente=t.id_cliente
									WHERE 1 AND t.id_dominio='".$_SESSION['dominio']."' ";
				if($persona){
					$query .= " AND t.id_cliente = $persona";
				}
				if($apellidofiltro){
            $query .=" AND p.apellido like '%$apellidofiltro%'";
        }
        if($nombrefiltro){
            $query .=" AND p.nombre like '%$nombrefiltro%'";
        }
        if($dnifiltro){
            $query .=" AND p.dni like '%$dnifiltro%'";
        }
				if($motivofiltro){
            $query .=" AND t.id_motivo like '%$motivofiltro%'";
        }
				if($fecha_desde==null && $fecha_hasta==null){
            //$fecha_desde=substr($fecha_desde, 6, 4)."-".substr($fecha_desde, 3, 2)."-".substr($fecha_desde, 0, 2)." 00:00:00";
            $query .=" AND (t.fecha_turno between '".date('Y-m-d')." 00:00:00' AND '".date('Y-m-d')." 23:59:50')";
        }
				if($fecha_desde && $fecha_hasta==null){
            $fecha_desde=substr($fecha_desde, 6, 4)."-".substr($fecha_desde, 3, 2)."-".substr($fecha_desde, 0, 2)." 00:00:00";
            $query .=" AND t.fecha_turno>='".$fecha_desde."'";
        }
        if($fecha_desde==null && $fecha_hasta){
            $fecha_hasta=substr($fecha_hasta, 6, 4)."-".substr($fecha_hasta, 3, 2)."-".substr($fecha_hasta, 0, 2)." 23:59:00";
            $query .=" AND t.fecha_turno<='".$fecha_hasta."'";
        }

        if($fecha_desde && $fecha_hasta){
            $fecha_desde=substr($fecha_desde, 6, 4)."-".substr($fecha_desde, 3, 2)."-".substr($fecha_desde, 0, 2)." 00:00:00";
            $fecha_hasta=substr($fecha_hasta, 6, 4)."-".substr($fecha_hasta, 3, 2)."-".substr($fecha_hasta, 0, 2)." 23:59:00";
            $query .=" AND (t.fecha_turno between '".$fecha_desde."' AND '".$fecha_hasta."')";
        }
				$query .= " ORDER BY  t.fecha_turno DESC";
				//echo $query;
        $resutlt = $this->db->loadObjectList($query);
        if ($resutlt) {
            return $resutlt;
        }
        return array();
    }
		public function getDatosTurno($id_turno=null) {
			session_start();
        $query = "SELECT t.* , date_format(t.fecha_turno, '%d/%m/%Y') fecha, date_format(p.fecha_nacimiento, '%d/%m/%Y') fecha_nacimiento,
									date_format(t.fecha_turno, '%H/%i') hora,
									m.descripcion motivo, p.dni,
									CONCAT_WS(' ',p.apellido,p.nombre) cliente
                  FROM turnos t
                  LEFT JOIN motivos_turno m ON m.id_motivo=t.id_motivo
									  LEFT JOIN personas p ON p.id_persona=t.id_persona
									WHERE 1 AND t.id_turno='".$id_turno."' ";
				//echo $query;
        $resutlt = $this->db->loadObjectList($query);
        if ($resutlt) {
            return $resutlt[0];
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
            return $table->id_turno;
        }else{
            return false;
        }
    }
    public function getMotivos(){
			session_start();
        $query = "SELECT m.*
                  FROM  motivos_turno m
                  WHERE 1 AND m.id_dominio='".$_SESSION['dominio']."' ";
        $resutlt = $this->db->loadObjectList($query);
        if ($resutlt) {
            return $resutlt;
        }
        return array();
    }

		public function getTurnera($dominio){
			$fecha_desde=date('Y')."-".date('m')."-".date('d')." 00:00:00";
			$fecha_hasta=date('Y')."-".date('m')."-".date('d')." 23:59:00";
        $query = "SELECT CONCAT_WS(' ',p.apellido,p.nombre) cliente
                  FROM turnos t
									LEFT JOIN personas p ON p.id_persona=t.id_persona
                  WHERE t.estado='Llamando' ";
									$query .=" AND t.id_dominio='".$dominio."' AND (t.fecha_turno between '".$fecha_desde."' AND '".$fecha_hasta."')";

									$query .=" ORDER BY t.fecha_llamado DESC";
									//echo $query;
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
		function getOS(){
				//session_start();
		$query = "SELECT d.* FROM ango_personas.financiador_programa_medico d "
												. "WHERE 1 ";
		$result = $this->db->loadObjectList($query);
		if($result)
			return $result;
		else
			return false;
		}
		function getPlanOS($idcobertura){
				//session_start();
		$query = "SELECT d.* FROM cobertura_plan d "
												. "WHERE d.id_cobertura='".$idcobertura."' ";
												//echo $query;
		$result = $this->db->loadObjectList($query);
		if($result)
			return $result;
		else
			return false;
		}
		function getPlanOSMigrar($idcobertura){
				//session_start();
		$query = "SELECT d.* FROM ango_personas.financiador_programa_medico_plan d "
												. "WHERE d.id_programa_medico='".$idcobertura."' ";
												//echo $query;
		$result = $this->db->loadObjectList($query);
		if($result)
			return $result;
		else
			return false;
		}
		function save_cobertura($denominacion){
        $table = new Table($this->db, 'cobertura');

        $table->descripcion = $denominacion;
				$table->usuario = $_SESSION['id'];
				$table->fecha_modificacion = date('Y-m-d H:i:s');
        $table->estado = 'A';
        if($table->save()){
						//$this
            return $table->id_cobertura;
        }else{
            return false;
        }
    }
		function save_plan_cobertura($denominacion, $id_cobertura){
        $table = new Table($this->db, 'cobertura_plan');

				$table->id_cobertura = $id_cobertura;
        $table->descripcion = $denominacion;

        $table->estado = 'A';
        if($table->save()){
            return $table->id_plan_cobertura;
        }else{
            return false;
        }
    }
		function save_evolucion($data){
				$table = new Table($this->db, 'evoluciones');
				$table->id_persona = $data['id_persona'];
				$table->descripcion = $data['evolucion_texto'];
				$table->fecha_hora = date('Y-m-d H:i:s');
				$table->fecha_hora_modificacion = date('Y-m-d H:i:s');
				$table->estado = 'A';
				$table->usuario = $_SESSION['id'];
				$table->id_dominio = $_SESSION['dominio'];
				if($table->save()){
						return $table->id_evolucion;
				}else{
						return 0;
				}
		}
		function save_evolucion_problemas($id_evolucion, $id_problema){

				$table = new Table($this->db, 'problemas_evoluciones');
				$table->id_evolucion = $id_evolucion;
				$table->id_problema = $id_problema;
				$table->usuario = $_SESSION['id'];
				if($table->save()){
						return $table->id_relacion;
				}else{
						return 0;
				}
		}
		function getProblemasEvolucion($id_evolucion){

        $query = "SELECT pe.*, p.descripcion "
            . " FROM problemas_evoluciones pe "
            . " INNER JOIN problemas p ON p.id_problema=pe.id_problema "
            . " WHERE pe.id_evolucion='".$id_evolucion."' ";
      //  echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result;
        else
            return false;
    }
		function presente_turno($idTurno, $estado){
			switch ($estado) {
				case "Asignado":
						$estado='Presente';
				break;
				case "Presente":
						$estado='Llamando';
				break;
				case "cancela_presente":
						$estado='Asignado';
				break;
				case "Llamando":
						$estado='Atendido';
				break;
				case "cancelar_llamada":
						$estado='Presente';
				break;
				case "Cancelado":
						$estado='Cancelado';
				break;
			}
        $query = "UPDATE turnos
                      SET estado='".$estado."' ";
											if($estado=="Llamando"){
												$query.=" , fecha_llamado=NOW() ";
											}
                      $query.=" WHERE id_turno='$idTurno'";
        $this->db->query($query);

    }
		function save_marca($data){
            $table = new Table($this->db, 'marcas');
            if(isset($data['id_marca'])){
                $table->find($data['id_marca']);
            }
            $table->descripcion = $data['descripcion'];
    				if($data['estado']){
                $table->estado = $data['estado'];
            }else{
                $table->estado = 'A';
            }
            if($table->save()){
                return $table->id_marca;
            }else{
                return 0;
            }
        }
		function getMarcas(){
        $query = "SELECT a.* FROM marcas a WHERE 1 ORDER BY descripcion ASC " ;
        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result;
        else
            return false;
    }
		function getMarcabyid($id_registro){

        $query = "SELECT r.* FROM marcas r  WHERE r.id_marca='".$id_registro."' ";
        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result[0];
        else
            return false;
    }
		/***************************************************/
		function save_prestaciones($data){
        $table = new Table($this->db, 'prestaciones');
        if(isset($data['id_prestacion'])){
            $table->find($data['id_prestacion']);
        }
        $table->descripcion = $data['descripcion'];
				$table->precio = $data['precio'];
				$table->costo = $data['costo'];
				$table->id_dominio = $_SESSION['dominio'];
				if($data['estado']){
            $table->estado = $data['estado'];
        }else{
            $table->estado = 'A';
        }
        if($table->save()){
            return $table->id_marca;
        }else{
            return 0;
        }
    }
		function getPrestaciones(){
        $query = "SELECT a.* FROM prestaciones a WHERE 1 ORDER BY descripcion ASC " ;
        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result;
        else
            return false;
    }
		function getPrestacionesByid($id_registro){

        $query = "SELECT r.* FROM prestaciones r  WHERE r.id_prestacion='".$id_registro."' ";
        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result[0];
        else
            return false;
    }
		/***************************************************/
		/*************************clientes**************************/
		function save_cliente($data){
				$fecha_nac=substr($data['fecha_nacimiento'], 6, 4)."-".substr($data['fecha_nacimiento'], 3, 2)."-".substr($data['fecha_nacimiento'], 0, 2);
				$table = new Table($this->db, 'clientes');
				if(isset($data['id_cliente'])){
						$table->find($data['id_cliente']);

						//$table->fecha_modificacion = date('Y-m-d H:i:s');
				}else{
						$table->fecha_alta = date('Y-m-d H:i:s');

				}
				$table->nombre = $data['nombre'];
				$table->apellido = $data['apellido'];
				$table->dni = $data['dni'];
				$table->cuit = $data['cuit'];
				$table->razon_social = $data['razon_social'];
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
						return $table->id_cliente;
				}else{
						return 0;
				}
		}
		function getClientes(){
				//session_start();
				$query = "SELECT d.*,date_format(d.fecha_nacimiento, '%d/%m/%Y') fecha_nacimiento FROM clientes d "
						. "WHERE cod_estado='A' ORDER BY apellido, nombre ASC ";
				//echo $query;
				$result = $this->db->loadObjectList($query);
				if($result)
						return $result;
				else
						return false;
		}
		function getClientesByid($id_registro){

		$query = "SELECT r.* "
										. " FROM clientes r"
										. " WHERE r.id_cliente='".$id_registro."' ";
		//echo $query;
						$result = $this->db->loadObjectList($query);
		if($result)
		return $result[0];
		else
		return false;
		}

		function save_importar_stock($producto, $unidad, $precio){

        $table = new Table($this->db, 'productos_stock');

        $table->descripcion = ucfirst($producto);
				$table->unidad_medida = $unidad;
        $table->precio = $precio;
				$table->estado = 'A';
        $table->id_dominio = 5;

        if($table->save()){
            return $table->id_producto_stock;
        }else{
            return 0;
        }
    }
		function save_pedido($data){
			$fecha_retiro=substr($data['fecha_retiro'], 6, 4)."-".substr($data['fecha_retiro'], 3, 2)."-".substr($data['fecha_retiro'], 0, 2);
			$table = new Table($this->db, 'pedidos');

			$table->id_cliente = $data['clientes'];
			$table->fecha_retiro = $fecha_retiro;
			$table->hora_retiro = $data['hora'];
			$table->nota = $data['nota'];
			$table->fecha_hora = date('Y-m-d H:i:s');
			$table->usuario_carga = $_SESSION['id'];
			$table->estado = 'nuevo';
			$table->id_dominio = $_SESSION['dominio'];

			if($table->save()){
					return $table->id_pedido;
			}else{
					return 0;
			}
		}
		function save_pedido_detalle($pedido, $producto, $cantidad, $unidad, $precio){
		//$fecha_retiro=substr($data['fecha_retiro'], 6, 4)."-".substr($data['fecha_retiro'], 3, 2)."-".substr($data['fecha_retiro'], 0, 2);
			$table = new Table($this->db, 'pedidos_detalle');

			$table->id_pedido = $pedido;
			$table->id_producto_stock = $producto;
			$table->unidad = $unidad;
			$table->cantidad = $cantidad;
			$table->precio_aprox = $precio;


			if($table->save()){
					return $table->id_pedido;
			}else{
					return 0;
			}
		}
		public function getDatosPago($id_pago=null) {
			session_start();
            $query = "SELECT t.* ,
    				date_format(t.fecha_hora, '%d/%m/%Y') fecha, date_format(p.fecha_nacimiento, '%d/%m/%Y') fecha_nacimiento,
    									date_format(t.fecha_hora, '%H:%i') hora,
    									m.descripcion actividad, p.dni,
    									CONCAT_WS(' ',p.apellido,p.nombre) cliente
                      FROM pagos t
                      LEFT JOIN productos m ON m.id_producto=t.id_producto
    									  LEFT JOIN personas p ON p.id_persona=t.id_cliente
    									WHERE 1 AND t.id_pago='".$id_pago."' ";
    				//echo $query;
            $resutlt = $this->db->loadObjectList($query);
            if ($resutlt) {
                return $resutlt[0];
            }
            return array();
        }
		function getPedidos($fecha_desde=null, $fecha_hasta=null){
        session_start();
        $query = "SELECT p.*, date_format(p.fecha_retiro, '%d/%m/%Y') fecha, date_format(p.hora_retiro, '%d/%m/%Y') hora ,  CONCAT_WS(' ',pr.apellido, pr.nombre) cliente
                  FROM pedidos p
                  INNER JOIN clientes pr ON pr.id_cliente=p.id_cliente
                  WHERE 1 AND p.id_dominio='".$_SESSION['dominio']."' " ;
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

        //$query .= " WHERE p.periodo='".$periodo."' ";
      //  echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result;
        else
            return false;

    }
		function save_comprobante($data){
			//$fecha_retiro=substr($data['fecha_retiro'], 6, 4)."-".substr($data['fecha_retiro'], 3, 2)."-".substr($data['fecha_retiro'], 0, 2);
			$table = new Table($this->db, 'comprobantes');

			$table->id_cliente = $data['clientes'];
			//$table->fecha_retiro = $fecha_retiro;
			$table->precio = $data['precio_aprox'];
			$table->id_turno = $data['id_turno'];
			$table->fecha_hora = date('Y-m-d H:i:s');

			$table->id_dominio = $_SESSION['dominio'];

			if($table->save()){
					return $table->id_comprobante;
			}else{
					return 0;
			}
		}
		function save_comprobante_detalle($comprobante, $prestacion, $cantidad=null, $costo=null, $precio=null){
		//$fecha_retiro=substr($data['fecha_retiro'], 6, 4)."-".substr($data['fecha_retiro'], 3, 2)."-".substr($data['fecha_retiro'], 0, 2);
			$table = new Table($this->db, 'comprobantes_detalle');

			$table->id_comprobante = $comprobante;
			$table->id_prestacion = $prestacion;
			$table->costo = $costo;
			$table->cantidad = $cantidad;
			$table->precio = $precio;


			if($table->save()){
					return $table->id_comprobante_detalle;
			}else{
					return 0;
			}
		}
		function getComprobantes($fecha_desde=null, $fecha_hasta=null){
        session_start();
        $query = "SELECT p.*, date_format(p.fecha_hora, '%d/%m/%Y') fecha, date_format(p.fecha_hora, '%H:%i') hora,  CONCAT_WS(' ',pr.apellido, pr.nombre) cliente
                  FROM comprobantes p
                  INNER JOIN clientes pr ON pr.id_cliente=p.id_cliente
                  WHERE 1 AND p.id_dominio='".$_SESSION['dominio']."' " ;
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
				if($fecha_desde==null && $fecha_hasta==null){
						$fecha_desde=substr($fecha_desde, 6, 4)."-".substr($fecha_desde, 3, 2)."-".substr($fecha_desde, 0, 2)." 00:00:00";
						$query .=" AND date_format(p.fecha_hora, '%m')='".date('m')."'";
				}
        //$query .= " WHERE p.periodo='".$periodo."' ";
        // $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result;
        else
            return false;

    }
		function getAsistencias($fecha_desde=null, $fecha_hasta=null){
        session_start();
        $query = "SELECT CONCAT_WS(' ',p.apellido,p.nombre) cliente,
                        date_format(pp.fecha_hora, '%d/%m/%Y') fecha , date_format(pp.fecha_hora, '%H:%i') hora, pr.descripcion actividad "
            . "  FROM presente_cliente pp
            INNER JOIN personas p ON p.id_persona=pp.id_cliente
						INNER JOIN productos pr ON pr.id_producto=pp.id_actividad
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

        $result = $this->db->loadObjectList($query);
        if($result) {
            return $result;

        }else
            return false;
    }
		//---------------------------- todo de stock
		function getStock(){
        $query = "SELECT p.* , u.descripcion unidad "
            . "  FROM productos_stock p
						INNER JOIN unidad_medida u ON u.id_unidad=p.unidad_medida
						WHERE 1 AND p.id_dominio='".$_SESSION['dominio']."' ";
						if($nombrefiltro){
								$query .=" AND p.descripcion like '%$nombrefiltro%'";
						}

						$query .=" ORDER BY p.descripcion ASC " ;
        //echo $query;
        $result = $this->db->loadObjectList($query);
        if($result)
            return $result;
        else
            return false;
    }
		function save_stock($data){
        $table = new Table($this->db, 'productos_stock');
        if(isset($data['id_producto_stock'])){
            $table->find($data['id_producto_stock']);

        }
        $table->descripcion = $data['descripcion'];
				$table->precio = $data['precio'];
				$table->costo = $data['costo'];
        $table->unidad_medida = $data['unidad_medida'];

        if($data['estado']){
            $table->estado = $data['estado'];
        }else{
            $table->estado = 'A';
        }
        $table->id_dominio = $_SESSION['dominio'];
        if($table->save()){
            return $table->id_producto_stock;
        }else{
            return 0;
        }
    }
		function eliminar_relacion($idRelacion){
        $query = "UPDATE relaciones
                      SET estado='B'
                      WHERE id_relacion='$idRelacion'";
        $this->db->query($query);

    }
		function getPersonasObitoByid($id_registro){

				$query = "SELECT r.*,date_format(r.fecha_nacimiento, '%d/%m/%Y') fecha_nacimiento,pd.*,pc.id_registro id_persona_cobertura,
				 c.descripcion cobertura, c.id_cobertura  id_cobertura, pc.numero_cobertura, cp.descripcion plan_cobertura, pc.id_plan id_plan_cobertura  "
						. " FROM personas_obito r "
						. " LEFT JOIN cobertura c ON c.id_cobertura=pc.id_cobertura "
						. " WHERE r.id_persona='".$id_registro."' ";
				//echo $query;
				$result = $this->db->loadObjectList($query);
				if($result)
						return $result[0];
				else
						return false;
		}

		function getPersonasObito($apellidofiltro=null, $nombrefiltro=null, $dni=null){
						session_start();
				$query = "SELECT p.*,date_format(p.fecha_nacimiento, '%d/%m/%Y') fecha_nacimiento "
						. "  FROM personas_obito p

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
						return $result;
				}else
						return false;
		}
		public function getPaises(){
			session_start();
        $query = "SELECT m.*
                  FROM  paises m
                  WHERE 1 AND m.estado='A'";
        $resutlt = $this->db->loadObjectList($query);
        if ($resutlt) {
            return $resutlt;
        }
        return array();
    }
		function save_pais($data){
            $table = new Table($this->db, 'paises');
            if(isset($data['id_pais'])){
                $table->find($data['id_pais']);
            }
            $table->descripcion = $data['descripcion'];

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
		public function getCobertura(){
			session_start();
        $sql="SELECT c.id_cobertura , c.descripcion FROM cobertura AS c WHERE 1 AND c.estado='A' ORDER BY c.descripcion ASC";
        $resutlt = $this->db->loadObjectList($sql);
        if ($resutlt) {
            return $resutlt;
        }
        return array();
    }
		public function getLugaresDeceso(){
			session_start();
        $sql="SELECT c.id_lugar_deceso , c.descripcion FROM lugar_deceso AS c WHERE 1 AND c.estado='A' ORDER BY c.descripcion ASC";
        $resutlt = $this->db->loadObjectList($sql);
        if ($resutlt) {
            return $resutlt;
        }
        return array();
    }
		function save_lugar_deceso($data){
                $table = new Table($this->db, 'lugar_deceso');
                if(isset($data['id_lugar_deceso'])){
                    $table->find($data['id_lugar_deceso']);
                }
                $table->descripcion = $data['descripcion'];

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
		function save_persona_obito($data){
				$fecha_nac=substr($data['fecha_nacimiento'], 6, 4)."-".substr($data['fecha_nacimiento'], 3, 2)."-".substr($data['fecha_nacimiento'], 0, 2);
				$table = new Table($this->db, 'personas_obito');
				if(isset($data['id_persona_obito'])){
						$table->find($data['id_persona_obito']);

						//$table->fecha_modificacion = date('Y-m-d H:i:s');
				}else{
						$table->fecha_alta = date('Y-m-d H:i:s');

				}
				$table->nombre = $data['nombre'];
				$table->apellido = $data['apellido'];
				$table->dni = $data['dni'];
				$table->cuil = $data['cuil'];
				$table->fecha_nacimiento = $fecha_nac;
				$table->domicilio = $data['domicilio'];
				$table->pais_nacimiento = $data['pais'];
				$table->localidad = $data['localidad'];
				$table->estado_civil = $data['estado_civil'];
				$table->religion = $data['religion'];
				$table->ocupacion = $data['ocupacion'];
				$table->cobertura = $data['os'];
				$table->numero_cobertura = $data['numero_cobertura'];
				$table->lugar_deceso = $data['lugar_deceso'];
				$table->hora_deceso = $data['hora_deceso'];
				$table->peso = $data['peso'];
				$table->talla = $data['talla'];
				$table->causa = $data['causa'];
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
		public function getServicios($fecha_desde=null, $fecha_hasta=null, $obito=null){
			session_start();
                $query="SELECT sc.*,date_format(sc.fecha_hora_carga, '%d/%m/%Y %H:%i') fecha_servicio, CONCAT_WS(' ',po.apellido, po.nombre) obito
                                , CONCAT_WS(' ',ta.descripcion, a.ancho, a.medida) ataud, CONCAT_WS(' ',ps.apellido, ps.nombre) solicitante, CONCAT_WS(' ',pg.apellido, pg.nombre) garante, u.nombre_persona usuario
                                	FROM servicios AS sc
                                    LEFT JOIN personas_obito AS po ON po.id_persona_obito=sc.id_persona_obito
                                    LEFT JOIN personas_solicitante AS ps ON ps.id_solicitante=sc.id_solicitante
                                    LEFT JOIN personas_solicitante AS pg ON pg.id_solicitante=sc.id_garante
                                    LEFT JOIN usuarios AS u ON u.id_usuario=sc.id_usuario
                                    LEFT JOIN ataud AS a ON a.id_ataud=sc.id_ataud
        							LEFT JOIN tipo_ataud AS ta ON ta.id_tipo_ataud=a.id_tipo 
                                    WHERE 1 ";
                                    if($fecha_desde && $fecha_hasta==null){
                                        $fecha_desde=substr($fecha_desde, 6, 4)."-".substr($fecha_desde, 3, 2)."-".substr($fecha_desde, 0, 2)." 00:00:00";
                                        $query .=" AND sc.fecha_hora_carga>='".$fecha_desde."'";
                                    }
                                    if($fecha_desde==null && $fecha_hasta){
                                        $fecha_hasta=substr($fecha_hasta, 6, 4)."-".substr($fecha_hasta, 3, 2)."-".substr($fecha_hasta, 0, 2)." 23:59:00";
                                        $query .=" AND sc.fecha_hora_carga<='".$fecha_hasta."'";
                                    }

                                    if($fecha_desde && $fecha_hasta){
                                        $fecha_desde=substr($fecha_desde, 6, 4)."-".substr($fecha_desde, 3, 2)."-".substr($fecha_desde, 0, 2)." 00:00:00";
                                        $fecha_hasta=substr($fecha_hasta, 6, 4)."-".substr($fecha_hasta, 3, 2)."-".substr($fecha_hasta, 0, 2)." 23:59:00";
                                        $query .=" AND (sc.fecha_hora_carga between '".$fecha_desde."' AND '".$fecha_hasta."')";
                                    }
                                    if($obito){
                                        $query .=" AND sc.id_persona_obito='".$obito."' ";
                                    }
                                    
        							$query .=" ORDER BY sc.fecha_hora_carga DESC ";
                                    //echo $query;
                $result = $this->db->loadObjectList($query);
                if($result)
                        return $result;
                else
                        return false;
        }
		function getPersonaObitaByid($id_registro){

				$query = "SELECT po.*,date_format(po.fecha_nacimiento, '%d/%m/%Y') fecha_nacimiento,date_format(po.hora_deceso, '%H:%i') hora_deceso, c.descripcion cobertura_nombre, p.descripcion pais_nombre, l.descripcion lugar_deceso_nombre "
						. " FROM personas_obito po "
						. " INNER JOIN paises p ON p.id_pais=po.pais_nacimiento "
						. " INNER JOIN cobertura c ON c.id_cobertura=po.cobertura "
						. " INNER JOIN lugar_deceso l ON l.id_lugar_deceso=po.lugar_deceso "
						. " WHERE po.id_persona_obito='".$id_registro."' ";
				//echo $query;
				$result = $this->db->loadObjectList($query);
				if($result)
						return $result[0];
				else
						return false;
		}

        public function getAtaudes(){
            session_start();
            $query = "SELECT a.*, ta.descripcion nombre_ataud
                      FROM  ataud a
                      INNER JOIN tipo_ataud ta ON ta.id_tipo_ataud=a.id_tipo
                      WHERE 1 AND a.estado='A' ";
            $resutlt = $this->db->loadObjectList($query);
            if ($resutlt) {
                return $resutlt;
            }
            return array();
        }   
        public function getTipoAtaud(){
            
            $query = "SELECT ta.*
                      FROM  tipo_ataud ta
                      WHERE 1 AND ta.estado='A' ";
            $resutlt = $this->db->loadObjectList($query);
            if ($resutlt) {
                return $resutlt;
            }
            return array();
        }  
        public function getMedidasAtaudPorTipo($tipo){
            
            $query = "SELECT ta.*
                      FROM  ataud ta
                      WHERE 1 AND ta.id_tipo='".$tipo."' ";
                      // echo $query;
            $resutlt = $this->db->loadObjectList($query);
            if ($resutlt) {
                return $resutlt;
            }
            return array();
        } 
        public function getAnchoAtaudPorTipo($tipo, $medida){
            
            $query = "SELECT ta.*
                      FROM  ataud ta
                      WHERE 1 AND ta.id_tipo='".$tipo."' AND ta.medida='".$medida."' ";
                      // echo $query;
            $resutlt = $this->db->loadObjectList($query);
            if ($resutlt) {
                return $resutlt;
            }
            return array();
        } 
        public function getIDAtaudPorCombinacion($tipo=null, $medida=null, $ancho=null){
            
            $query = "SELECT ta.*
                      FROM  ataud ta
                      WHERE 1 ";

                      if($ancho){
                        $query .=" AND ta.ancho='".$ancho."'";
                      }
                      if($tipo){
                        $query .="  AND ta.id_tipo='".$tipo."'";
                      }
                      if($medida){
                        $query .=" AND ta.medida='".$medida."'";
                      }
                      //  echo $query;
            $resutlt = $this->db->loadObjectList($query);
            if ($resutlt) {
                return $resutlt[0];
            }else{
                return false;
            }
        } 
        function getPersonaSolicitanteByid($id_registro){

            $query = "SELECT r.*,date_format(r.fecha_nacimiento, '%d/%m/%Y') fecha_nacimiento "
                . " FROM personas_solicitante r "
                . " WHERE r.id_solicitante='".$id_registro."' ";
            //echo $query;
            $result = $this->db->loadObjectList($query);
            if($result)
                return $result[0];
            else
                return false;
        }
        function getPersonaGaranteByid($id_registro){

            $query = "SELECT r.*,date_format(r.fecha_nacimiento, '%d/%m/%Y') fecha_nacimiento "
                . " FROM personas_garante r "
                . " WHERE r.id_garante='".$id_registro."' ";
            //echo $query;
            $result = $this->db->loadObjectList($query);
            if($result)
                return $result[0];
            else
                return false;
        }

        function getSolicitantes($apellidofiltro=null, $nombrefiltro=null, $dni=null){
                        session_start();
                $query = "SELECT p.*,date_format(p.fecha_nacimiento, '%d/%m/%Y') fecha_nacimiento "
                        . "  FROM personas_solicitante p

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
                        return $result;
                }else
                        return false;
        }
        function getGarantes($apellidofiltro=null, $nombrefiltro=null, $dni=null){
                        session_start();
                $query = "SELECT p.*,date_format(p.fecha_nacimiento, '%d/%m/%Y') fecha_nacimiento "
                        . "  FROM personas_garante p

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
                        return $result;
                }else
                        return false;
        }
        function save_persona_garante($data){
                $fecha_nac=substr($data['fecha_nacimiento'], 6, 4)."-".substr($data['fecha_nacimiento'], 3, 2)."-".substr($data['fecha_nacimiento'], 0, 2);
                $table = new Table($this->db, 'personas_garante');
                if(isset($data['id_garante'])){
                        $table->find($data['id_garante']);
                }else{
                        $table->fecha_alta = date('Y-m-d H:i:s');
                }
                $table->nombre = $data['nombre'];
                $table->apellido = $data['apellido'];
                $table->dni = $data['dni'];
                $table->fecha_nacimiento = $fecha_nac;
                $table->domicilio = $data['domicilio'];
                $table->ocupacion = $data['ocupacion'];
                $table->tel_casa = $data['tel_casa'];
                $table->tel_celular = $data['tel_celular'];
                $table->tel_laboral = $data['tel_laboral'];
                // $table->parentesco = $data['parentesco'];
                if($data['estado']){
                        $table->cod_estado = $data['estado'];
                }else{
                        $table->cod_estado = 'A';
                }
                $table->id_dominio = $_SESSION['dominio'];
                $table->usuario = $_SESSION['id'];
                $table->fecha_alta = date('Y-m-d H:i:s');
                if($table->save()){
                        return $table->id_garante;
                }else{
                        return 0;
                }
        }
        function save_persona_solicitante($data){
           // print_r($data);
                $fecha_nac=substr($data['fecha_nacimiento'], 6, 4)."-".substr($data['fecha_nacimiento'], 3, 2)."-".substr($data['fecha_nacimiento'], 0, 2);
                $table = new Table($this->db, 'personas_solicitante');
                if(isset($data['id_solicitante'])){
                        $table->find($data['id_solicitante']);
                }else{
                        $table->fecha_alta = date('Y-m-d H:i:s');
                }
                $table->nombre = $data['nombre'];
                $table->apellido = $data['apellido'];
                $table->dni = $data['dni'];
                $table->fecha_nacimiento = $fecha_nac;
                $table->domicilio = $data['domicilio'];
                $table->ocupacion = $data['ocupacion'];
                $table->tel_casa = $data['tel_casa'];
                $table->tel_celular = $data['tel_celular'];
                $table->tel_laboral = $data['tel_laboral'];
                $table->parentesco = $data['parentesco'];
                if($data['estado']){
                        $table->cod_estado = $data['estado'];
                }else{
                        $table->cod_estado = 'A';
                }
                $table->id_dominio = $_SESSION['dominio'];
                $table->usuario = $_SESSION['id'];
                $table->fecha_alta = date('Y-m-d H:i:s');
                if($table->save()){
                        return $table->id_solicitante;
                }else{
                        return 0;
                }
            }
            function save_servicio($data){
                
                $fecha_inhumacion=substr($data['fecha_inhumacion'], 6, 4)."-".substr($data['fecha_inhumacion'], 3, 2)."-".substr($data['fecha_inhumacion'], 0, 2);
                $table = new Table($this->db, 'servicios');
                if(isset($data['id_servicio'])){
                        $table->find($data['id_servicio']);

                        $table->fecha_modificado = date('Y-m-d H:i:s');
                        $table->id_usuario_modifica = $_SESSION['id'];
                }else{
                        // $table->fecha_alta = date('Y-m-d H:i:s');
                        
                }
                // echo $fecha_inhumacion;
                // exit();
                $table->id_persona_obito = $data['persona_obito'];
                $table->id_ataud = $data['id_ataud'];
                $table->entierro = $data['lugar_entierro'];
                $table->sala = $data['sala'];
                $table->capilla = $data['capilla'];
                $table->fecha_inhumacion = $fecha_inhumacion;
                $table->domicilio = $data['domicilio'];
                $table->preparador = $data['preparador'];
                $table->tipo_preparacion = $data['tipo_preparacion'];
                $table->cementerio_cremacion = $data['cementerio_cremacion'];
                $table->cementerio = $data['cementerio'];
                $table->hora_inhumacion = $data['hora_inhumacion'];
                $table->traslado = $data['traslado'];
                $table->traslado_hasta = $data['traslado_hasta'];
                $table->traslado_km = $data['traslado_km'];
                $table->id_solicitante = $data['solicitante'];
                $table->parentesco = $data['parentesco'];
                $table->id_garante = $data['garante'];

                $table->importe = $data['importe'];
                $table->entrega = $data['entrega'];
                $table->saldo = $data['saldo'];
                $table->forma_pago = $data['forma_pago'];

                $table->furgon = $data['furgon'];
                $table->coche_funebbre = $data['coche_funebbre'];
                $table->coche_porta = $data['coche_porta'];
                $table->coche_acompana = $data['coche_acompana'];
                $table->refrigerio = $data['refrigerio'];
                $table->saldo = $data['saldo'];
                $table->forma_pago = $data['forma_pago'];
                
                
                $table->id_dominio = $_SESSION['dominio'];
                $table->id_usuario = $_SESSION['id'];
                        $table->fecha_hora_carga = date('Y-m-d H:i:s');
                
                if($table->save()){
                        return $table->id_servicio;
                }else{
                        return 0;
                }   
            }
            function getTipoAtaudByid($id_registro){

                    $query = "SELECT r.* FROM tipo_ataud r  WHERE r.id_tipo_ataud='".$id_registro."' ";
                    //echo $query;
                    $result = $this->db->loadObjectList($query);
                    if($result)
                        return $result[0];
                    else
                        return false;
            }
            function save_tipo_ataud($data){
                $table = new Table($this->db, 'tipo_ataud');
                if(isset($data['id_tipo_ataud'])){
                    $table->find($data['id_tipo_ataud']);
                }
                $table->descripcion = $data['descripcion'];
                        if($data['estado']){
                    $table->estado = $data['estado'];
                }else{
                    $table->estado = 'A';
                }
                if($table->save()){
                    return $table->id_marca;
                }else{
                    return 0;
                }
            }
            function save_ataud($data){
                $table = new Table($this->db, 'ataud');
                if(isset($data['id_ataud'])){
                    $table->find($data['id_ataud']);
                }
                $table->id_tipo = $data['tipo_ataud'];
                $table->medida = $data['medida'];
                $table->ancho = $data['ancho'];
                $table->cantidad = $data['cantidad'];
                if($data['estado']){
                    $table->estado = $data['estado'];
                }else{
                    $table->estado = 'A';
                }
                if($table->save()){
                    return $table->id_ataud;
                }else{
                    return 0;
                }
            }
            public function getAtaud(){
            
                $query = "SELECT a.*, ta.descripcion tipo
                          FROM  ataud a
                          INNER JOIN  tipo_ataud ta ON ta.id_tipo_ataud=a.id_tipo
                          WHERE 1 AND a.estado='A' ";
                $resutlt = $this->db->loadObjectList($query);
                if ($resutlt) {
                    return $resutlt;
                }
                return array();
            }
            function getAtaudByid($id_registro){

                    $query = "SELECT r.* , ta.descripcion 
                        FROM ataud r  
                        INNER JOIN tipo_ataud ta ON ta.id_tipo_ataud=r.id_tipo  
                        WHERE r.id_ataud='".$id_registro."' ";
                   // echo $query;
                    $result = $this->db->loadObjectList($query);
                    if($result)
                        return $result[0];
                    else
                        return false;
            }
            function getServicioByid($id_registro){

                    $query = "SELECT r.* ,date_format(r.fecha_inhumacion, '%d-%m-%Y') fecha_inhumacion,date_format(r.fecha_hora_carga, '%d-%m-%Y') fecha_carga, l.descripcion cemneterionombre, u.nombre_persona,p.descripcion preparador_nombre
                    FROM servicios r  
                    LEFT JOIN lugar_CM_CR l ON l.id_lugar_entierro=r.cementerio
                    LEFT JOIN usuarios u ON u.id_usuario=r.id_usuario
                    LEFT JOIN preparador p ON p.id_preparador=r.preparador
                    WHERE r.id_servicio='".$id_registro."' ";
                    //echo $query;
                    $result = $this->db->loadObjectList($query);
                    if($result)
                        return $result[0];
                    else
                        return false;
            }
            function getSolicitanteByID($id_registro){

                    $query = "SELECT r.*,date_format(r.fecha_nacimiento, '%d/%m/%Y') fecha_nacimiento  FROM personas_solicitante r  WHERE r.id_solicitante='".$id_registro."' ";
                    //echo $query;
                    $result = $this->db->loadObjectList($query);
                    if($result)
                        return $result[0];
                    else
                        return false;
            }
            function getLugar_CM_CR($id_registro){

                    $query = "SELECT r.* FROM lugar_CM_CR r  WHERE r.tipo='".$id_registro."' ";
                   // echo $query;
                    $result = $this->db->loadObjectList($query);
                    if($result)
                        return $result;
                    else
                        return false;
            }
            public function getPreparador(){
            session_start();
                $sql="SELECT c.id_preparador , c.descripcion FROM preparador AS c WHERE 1 AND c.estado='A' ORDER BY c.descripcion ASC";
                $resutlt = $this->db->loadObjectList($sql);
                if ($resutlt) {
                    return $resutlt;
                }
                return array();
            }
            function save_preparador($data){
                $table = new Table($this->db, 'preparador');
                if(isset($data['id_preparador'])){
                    $table->find($data['id_preparador']);
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
            function save_lugar_servicio($data){
                $table = new Table($this->db, 'lugar_CM_CR');
                
                $table->descripcion = $data['descripcion'];
                $table->tipo = $data['cementerio_cremacion'];
                        
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
            public function getDatosPagoServicio($id_pago=null) {
                session_start();
                $query = "SELECT t.* , date_format(t.fecha_hora, '%d/%m/%Y') fecha,
                                            date_format(t.fecha_hora, '%H:%i') hora, p.dni,
                                            CONCAT_WS(' ',p.apellido,p.nombre) solicitante,p.domicilio
                          FROM pagos_servicios t
                          LEFT JOIN personas_solicitante p ON p.id_solicitante=t.id_solicitante
                          WHERE 1 AND t.id_pago_servicio='".$id_pago."' ";
                        //echo $query;
                $resutlt = $this->db->loadObjectList($query);
                if ($resutlt) {
                    return $resutlt[0];
                }
                return array();
            }
            function save_pago_servicio($data){

                $table = new Table($this->db, 'pagos_servicios');
               
                $table->id_solicitante = $data['solicitante'];
                $table->id_servicio = $data['id_servicio'];
                $table->numero_pago = $data['numero_pago'];
                $table->monto = $data['monto'];
                $table->nota = $data['nota'];
                

                $table->usuario = $_SESSION['id'];
                $table->id_dominio = $_SESSION['dominio'];
                $table->fecha_hora = date('Y-m-d H:i:s');
                
                $table->estado = 'A';
                
                if($table->save()){
                    return $table->id_pago_servicio;
                }else{
                    return false;
                }
            }
            public function getPagosServicios($id_servicio=null,$fecha_desde=null,$fecha_hasta=null) {
                session_start();
                $query = "SELECT t.* , date_format(t.fecha_hora, '%d/%m/%Y') fecha,
                                            date_format(t.fecha_hora, '%H:%i') hora, p.dni,
                                            CONCAT_WS(' ',p.apellido,p.nombre) solicitante, u.nombre_persona
                          FROM pagos_servicios t
                          LEFT JOIN personas_solicitante p ON p.id_solicitante=t.id_solicitante
                          LEFT JOIN usuarios u ON u.id_usuario=t.usuario
                          WHERE t.estado='A' ";
                            if($fecha_desde && $fecha_hasta==null){
                                $fecha_desde=substr($fecha_desde, 6, 4)."-".substr($fecha_desde, 3, 2)."-".substr($fecha_desde, 0, 2)." 00:00:00";
                                $query .=" AND t.fecha_hora>='".$fecha_desde."'";
                            }
                            if($fecha_desde==null && $fecha_hasta){
                                $fecha_hasta=substr($fecha_hasta, 6, 4)."-".substr($fecha_hasta, 3, 2)."-".substr($fecha_hasta, 0, 2)." 23:59:00";
                                $query .=" AND t.fecha_hora<='".$fecha_hasta."'";
                            }

                            if($fecha_desde && $fecha_hasta){
                                $fecha_desde=substr($fecha_desde, 6, 4)."-".substr($fecha_desde, 3, 2)."-".substr($fecha_desde, 0, 2)." 00:00:00";
                                $fecha_hasta=substr($fecha_hasta, 6, 4)."-".substr($fecha_hasta, 3, 2)."-".substr($fecha_hasta, 0, 2)." 23:59:00";
                                $query .=" AND (t.fecha_hora between '".$fecha_desde."' AND '".$fecha_hasta."')";
                            }
                            if($id_servicio){
                                    $query .=" AND t.id_servicio = '".$id_servicio."'";
                            }
                        //echo $query;
                $resutlt = $this->db->loadObjectList($query);
                if ($resutlt) {
                    return $resutlt;
                }
                return array();
            }
            function update_saldo_servicio($idServicio, $saldo){
                    $query = "UPDATE servicios
                                  SET saldo='".$saldo."'
                                  WHERE id_servicio='".$idServicio."'";
                    $this->db->query($query);

            }
            function update_baja_pago_servicio($idPagoServicio){
                    $query = "UPDATE pagos_servicios
                                  SET estado='B'
                                  WHERE id_pago_servicio='".$idPagoServicio."'";
                    $this->db->query($query);

            }
            public function getNumeroPagosServicios($id_servicio=null) {
                session_start();
                $query = "SELECT t.numero_pago
                          FROM pagos_servicios t
                          WHERE 1 AND t.id_servicio='".$id_servicio."' ";
                        //echo $query;
                $resutlt = $this->db->loadObjectList($query);
                    if($result)
                        return $result[0]->numero_pago;
                    else
                        return false;
            }
            //getSolicitanteByID
}
$consultas= new Consultas($db);
