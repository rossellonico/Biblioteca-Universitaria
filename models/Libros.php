<?php

// models/Libros.php

class Libros extends Model {

	public function buscarEjemplaresLibros ($numero_libro){

		if (!ctype_digit($numero_libro)) throw new validacionException ("error validacion 1");
		if ($numero_libro < 1) throw new validacionException ("error validacion 2");

		$this->db->query(" SELECT e.numero_ejemplar
							FROM ejemplares e, prestamos_ejemplares p
							WHERE e.numero_libro = $numero_libro and
							e.nombre_estado = 'domicilio' and
							(
							(p.numero_ejemplar = e.numero_ejemplar and
							p.numero_ejemplar not in  (SELECT e.numero_ejemplar
							FROM ejemplares e, prestamos_ejemplares p
							WHERE e.numero_libro = $numero_libro and
								e.nombre_estado = 'domicilio' and
									p.numero_ejemplar = e.numero_ejemplar and
									p.fecha_efectiva_devolucion is null)
							) 
							or 
							(e.numero_ejemplar not in (SELECT e.numero_ejemplar
													FROM  ejemplares e, prestamos_ejemplares p
													WHERE e.numero_ejemplar = p.numero_ejemplar))
							)
							ORDER BY e.numero_ejemplar
							Limit 1 ");
			return $this->db->fetch();

	}
	
	public function buscarlibrosprestado ($numero_socio){

		if (!ctype_digit($numero_socio)) throw new validacionException ("error validacion 3");
		if ($numero_socio < 1) throw new validacionException ("error validacion 4");


		$this->db->query(" SELECT pe.numero_prestamo, pe.numero_ejemplar, l.titulo, a.apellidos, 
							datediff ( CURRENT_TIMESTAMP, p.fecha_limite_devolucion) as dias_vencido
							FROM prestamos p, prestamos_ejemplares pe, ejemplares e, libros l, libros_autores la, autores a 
							where p.numero_socio = $numero_socio AND
								p.numero_prestamo = pe.numero_prestamo AND
								pe.fecha_efectiva_devolucion is null AND
								pe.numero_ejemplar = e.numero_ejemplar AND
								e.numero_libro = l.numero_libro AND
								l.numero_libro = la.numero_libro AND
								la.numero_autor = a.numero_autor	");
		return $this->db->fetchAll();
	}

	public function buscarPornumero_libro ($numero_libro){
		
		if (!ctype_digit($numero_libro)) throw new validacionException ("error validacion 5");
		if ($numero_libro < 1) throw new validacionException ("error validacion 6");
		
		$this->db->query("SELECT l.titulo, a.apellidos, l.numero_libro
							FROM libros l, autores a, libros_autores la
							WHERE l.numero_libro = $numero_libro and 
							la.numero_libro = l.numero_libro AND
    						a.numero_autor = la.numero_autor
							");
		return $this->db->fetch();
	}
	
	public function buscarPorTituloAutor ($titulo, $autor){

		//Valido $titulo
		if ( (strlen ($titulo) <1 ) and (strlen ($autor) <1 ) ) throw new validacionException ("error validacion 7");
		$titulo = substr ($titulo,0,300);
		$titulo = $this->db->escapeString($titulo);
		$titulo = $this->db->escapeWildcards($titulo);
		
		//Valido $autor
		$autor = substr ($autor,0,30);
		$autor = $this->db->escapeString($autor);
		$autor = $this->db->escapeWildcards($autor);
		
		$this->db->query("SELECT DISTINCT l.titulo, a.apellidos, l.numero_libro
							FROM libros l, autores a, libros_autores la, ejemplares ej
							WHERE (l.titulo = '$titulo' or a.apellidos = '$autor') and 
							la.numero_libro = l.numero_libro and
    						a.numero_autor = la.numero_autor and
							ej.nombre_estado = 'domicilio' and
							ej.numero_libro = l.numero_libro
							");
		return $this->db->fetchAll();
	}

	public function cantidadEjemplaresPermitidos ($tipo_usuario){
		
		if (!ctype_digit($tipo_usuario)) throw new validacionException ("error validacion 8");
		if ($tipo_usuario < 1 or $tipo_usuario > 4) throw new validacionException ("error validacion 9");

		$this->db->query(" SELECT cantidad_libros
							FROM tipo_usuario
							WHERE numero_tipo = $tipo_usuario");
		return $this->db->fetch();							

	}
	
	public function cantidadEjemplaresPrestados ($numero_socio){
		
		if (!ctype_digit($numero_socio)) throw new validacionException ("error validacion 10");
		if ($numero_socio < 1) throw new validacionException ("error validacion 11");

		$this->db->query(" SELECT pe.numero_ejemplar
							FROM prestamos_ejemplares pe, prestamos p
							WHERE p.numero_socio = $numero_socio AND
									pe.numero_prestamo = p.numero_prestamo AND
									pe.fecha_efectiva_devolucion is null
							GROUP BY pe.numero_ejemplar ");
			return $this->db->numRows();
	}

	public function cargarPrestamo ($numero_socio){
		
		if (!ctype_digit($numero_socio)) throw new validacionException ("error validacion 12");
		if ($numero_socio < 1) throw new validacionException ("error validacion 13");
		
		$this->db->query ("INSERT INTO prestamos (numero_socio, tipo_prestamo, fecha_prestamo, fecha_limite_devolucion)
							VALUES ($numero_socio, 'D', NOW(), NOW() + INTERVAL 7 day) ");
		$lastID= $this->db->insertID();
		
		$this->db->query ( "SELECT numero_prestamo, DATE_FORMAT(fecha_limite_devolucion, '%d-%m-%Y') as fecha_limite_devolucion 
							FROM prestamos
							where numero_prestamo = $lastID ");
		return $this->db->fetch();

		/*
		$this->db->query ( "SELECT MAX(numero_prestamo) as numero_prestamo, DATE_FORMAT(fecha_limite_devolucion, '%d-%m-%Y') as fecha_limite_devolucion 
							FROM prestamos
							where numero_prestamo = (SELECT max(numero_prestamo) FROM prestamos)" ) ;
		return $this->db->fetch();
		*/
	}

	public function cargarPrestamoEjemplar ($numero_prestamo, $numero_ejemplar){
		
		//Valido $numero_prestamo
		if (!ctype_digit($numero_prestamo)) throw new validacionException ("error validacion 14");
		if ($numero_prestamo < 1) throw new validacionException ("error validacion 15");

		//Valido $numero_ejemplar
		if (!ctype_digit($numero_ejemplar)) throw new validacionException ("error validacion 16");
		if ($numero_ejemplar < 1) throw new validacionException ("error validacion 17");
				
		$this->db->query ("INSERT INTO prestamos_ejemplares (numero_prestamo, numero_ejemplar)
							VALUES ($numero_prestamo, $numero_ejemplar)");
	}

	public function datosejemplar ($numero_ejemplar){
		
		//Valido $numero_ejemplar
		if (!ctype_digit($numero_ejemplar)) throw new validacionException ("error validacion 18");
		if ($numero_ejemplar < 1) throw new validacionException ("error validacion 19");
		
		$this->db->query(" SELECT e.numero_ejemplar, e.numero_libro, l.titulo, a.apellidos 
							FROM ejemplares e, libros l, autores a, libros_autores la
							WHERE e.numero_ejemplar = $numero_ejemplar and
									e.numero_libro = l.numero_libro and
									l.numero_libro = la.numero_libro and
									la.numero_autor = a.numero_autor");
		return $this->db->fetch();							
	}

	public function devolverEjemplares ($numero_prestamo, $numero_ejemplar, $multa){
	
		//Valido $numero_prestamo
		if (!ctype_digit($numero_prestamo)) throw new validacionException ("error validacion 20");
		if ($numero_prestamo < 1) throw new validacionException ("error validacion 21");

		//Valido $numero_ejemplar
		if (!ctype_digit($numero_ejemplar)) throw new validacionException ("error validacion 22");
		if ($numero_ejemplar < 1) throw new validacionException ("error validacion 23");

		//Valido $multa
		if (! is_numeric ($multa)) throw new validacionException ("error validacion 24");
		if ($multa < 0) throw new validacionException ("error validacion 25");
		
		if ($multa==0)
			$this->db->query ("UPDATE prestamos_ejemplares 
								SET fecha_efectiva_devolucion = NOW()
								where numero_prestamo = $numero_prestamo and
										numero_ejemplar = $numero_ejemplar ");
		else
		$this->db->query ("UPDATE prestamos_ejemplares 
							SET fecha_efectiva_devolucion = NOW(), precio_multa=$multa
							where numero_prestamo = $numero_prestamo and
									numero_ejemplar = $numero_ejemplar ");

	}
	public function getTodos() {
		$this->db->query("SELECT * from libros");
		return $this->db->fetchAll();
	}
}

class validacionException extends Exception {}