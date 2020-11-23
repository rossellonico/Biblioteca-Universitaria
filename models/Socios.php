<?php 

// models/Socios.php


class Socios extends Model {
	
		public function AplicarHashing($str){
		
		if (strlen ($str)<1 ) throw new validacionException ("error validacion 30");
		$str=sha1($str);
		return $str;
	}
	
	public function getTodos() {

		$this->db->query("SELECT numero_socio, email, clave
						  FROM socios ");
		return $this->db->fetchAll();
	}

		public function TipoUsuario($numero_socio){
		
		if (!ctype_digit($numero_socio)) throw new validacionException ("error validacion 28");
		if ($numero_socio < 1) throw new validacionException ("error validacion 29");

		$this->db->query("SELECT tipo_usuario
						  FROM socios
						  where numero_socio = $numero_socio ");
		$tipousuario = $this->db->fetch();
		return $tipousuario['tipo_usuario'];
	}
	
	public function ValidarSocio($email, $clave){
		
		//Valido $email
		if ( strlen ($email)<3 or strlen ($email)>320 ) throw new validacionException ("error validacion 26");
		$email = $this->db->escapeString($email);
		$email = $this->db->escapeWildcards($email);

		//Valido $clave
		if ( strlen ($clave)<1 or strlen ($clave)>40 ) throw new validacionException ("error validacion 27");
		$clave = $this->db->escapeString($clave);
		$clave = $this->db->escapeWildcards($clave);

		//Ya tengo las variable limpias
		$auxSocio=$this->getTodos();
        $clave=$this->AplicarHashing($clave);
		
		foreach($auxSocio as $a){
			if($a['email']==$email && $a['clave']==$clave)
				return $a['numero_socio'];
        }
		return false;
	}
	




	
}
class validacionException extends Exception {}