<?php 

// models/Socios.php


class Socios extends Model {
	
		public function AplicarHashing($str){
		
		if (strlen ($str)<1 ) throw new validacionException ("error validacion 37");
		$str=sha1($str);
		return $str;
	}
	
	public function getTodos() {

		$this->db->query("SELECT numero_socio, email, clave
						  FROM socios ");
		return $this->db->fetchAll();
	}

		public function TipoUsuario($numero_socio){
		
		if (!ctype_digit($numero_socio)) throw new validacionException ("error validacion 38");
		if ($numero_socio < 1) throw new validacionException ("error validacion 39");
		
		// Validacion del id de socio
		$this->db->query("SELECT *
							FROM socios
							where numero_socio = $numero_socio 
							LIMIT 1 ");
		if ($this->db->numRows() != 1) throw new validacionException ("error validacion 40");

		$this->db->query("SELECT tipo_usuario
						  FROM socios
						  where numero_socio = $numero_socio ");
		$tipousuario = $this->db->fetch();
		return $tipousuario['tipo_usuario'];
	}
	
	public function ValidarSocio($email, $clave){
		
		//Valido $email
		if ( strlen ($email)<3 or strlen ($email)>320 ) throw new validacionException ("error validacion 41");
		if (!strpos($email, "@", 1)) throw new validacionException ("error validacion 42");
		if (!strpos($email, ".", 3)) throw new validacionException ("error validacion 43");
		$email = $this->db->escapeString($email);

		//Valido $clave
		if ( strlen ($clave)<1 or strlen ($clave)>40 ) throw new validacionException ("error validacion 44");
		$clave = $this->db->escapeString($clave);

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