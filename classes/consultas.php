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
        function getClientes(){
            //session_start();
            $query = "SELECT d.* FROM clientes d "
                . "WHERE estado='A' ORDER BY apellido, nombre ASC ";
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
                        . " WHERE r.id_registro='".$id_registro."' ";
		//echo $query;
                $result = $this->db->loadObjectList($query);
		if($result)
			return $result[0];
		else
			return false;
	}
        function getDocumentosConta($bandera){
            //session_start();
		$query = "SELECT d.* FROM documentos d "
                        . "WHERE d.estado='A' AND d.categoria='".$bandera."' ";
		//echo $query;
                $result = $this->db->loadObjectList($query);
		if($result)
			return $result;
		else
			return false;
	    }
        function getServicios(){

            $query = "SELECT s.* FROM servicios s
                      WHERE s.estado='A' ";
            //echo $query;
            $result = $this->db->loadObjectList($query);
            if($result)
                return $result;
            else
                return false;
        }
        function getServiciosByid($id_registro){

            $query = "SELECT r.* "
                . " FROM servicios r"
                . " WHERE r.id_registro='".$id_registro."' ";
            //echo $query;
            $result = $this->db->loadObjectList($query);
            if($result)
                return $result[0];
            else
                return false;
        }
    function save_servicio($data){
        $table = new Table($this->db, 'servicios');

        if($data['id_registro']){
            $table->find($data['id_registro']);
            $table->estado = $data['estado'];
        }else{
            $table->estado = 'A';

        }
        $table->descripcion = $data['descripcion'];
        $table->titulo = $data['titulo'];
        $table->usuario = $_SESSION['id'];

        if($table->save()){
            return $table->id_registro;
        }else{
            return 0;
        }
    }
        function save_cliente($data){
        $table = new Table($this->db, 'clientes');

        if($data['id_registro']){
            $table->find($data['id_registro']);
            $table->estado = $data['estado'];
        }else{
            $table->estado = 'A';

        }
        $table->descripcion = $data['descripcion'];
        $table->nombre = $data['nombre'];

            $table->norma = $data['norma'];
            $table->inicio = $data['inicio'];
            $table->fin = $data['fin'];
            $table->detalles = $data['detalles'];
            $table->participantes = $data['participantes'];
            $table->orden = $data['orden'];

        $table->usuario = $_SESSION['id'];

            if($table->save()){
                return $table->id_registro;
            }else{
                return 0;
            }
        }
        function getNosotros(){
            //session_start();
            $query = "SELECT d.* FROM nosotros d "
                . "WHERE 1 ";
            //echo $query;
            $result = $this->db->loadObjectList($query);
            if($result)
                return $result;
            else
                return false;
        }
        function getNosotrosByid($id_registro){

            $query = "SELECT r.* "
                . " FROM nosotros r"
                . " WHERE r.id_registro='".$id_registro."' ";
            //echo $query;
            $result = $this->db->loadObjectList($query);
            if($result)
                return $result[0];
            else
                return false;
        }
        function save_nosotros($data){
            $table = new Table($this->db, 'nosotros');

            if($data['id_registro']){
                $table->find($data['id_registro']);
                $table->estado = $data['estado'];
            }else{
                $table->estado = 'A';

            }
            $table->descripcion = $data['descripcion'];
            $table->firma = $data['firma'];
            $table->telefono = $data['telefono'];
            $table->email = $data['email'];
            $table->usuario = $_SESSION['id'];

            if($table->save()){
                return $table->id_registro;
            }else{
                return 0;
            }
        }
        function getUser($iddata,$clave){

            $query = "SELECT u.*,d.descripcion nombre_dominio,d.aplicativo,d.id_dominio,d.tipo tipo_dominio FROM c0580050_jp.usuarios u
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
        /*********************************************************************************/

}
$consultas= new Consultas($db);
