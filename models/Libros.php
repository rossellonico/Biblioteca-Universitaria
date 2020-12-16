<?php

// models/Libros.php

class Libros extends Model {

	public function buscarEjemplaresLibros ($numero_libro){

		if (!ctype_digit($numero_libro)) throw new validacionException ("error validacion 1");
		if ($numero_libro < 1) throw new validacionException ("error validacion 2");

		// Validacion de que exista ese libro en la base
		$this->db->query("SELECT *
							FROM libros
							where numero_libro= $numero_libro 
							LIMIT 1 ");
		if ($this->db->numRows() != 1) throw new validacionException ("error validacion 3");		

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

		if (!ctype_digit($numero_socio)) throw new validacionException ("error validacion 4");
		if ($numero_socio < 1) throw new validacionException ("error validacion 5");

		// Validacion del id de socio
		$this->db->query("SELECT *
							FROM socios
							where numero_socio = $numero_socio 
							LIMIT 1 ");
		if ($this->db->numRows() != 1) throw new validacionException ("error validacion 6");

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
		
		if (!ctype_digit($numero_libro)) throw new validacionException ("error validacion 7");
		if ($numero_libro < 1) throw new validacionException ("error validacion 8");
		
		// Validacion de que exista ese libro en la base
		$this->db->query("SELECT *
							FROM libros
							where numero_libro= $numero_libro 
							LIMIT 1 ");
		if ($this->db->numRows() != 1) throw new validacionException ("error validacion 9");		

		$this->db->query("SELECT l.titulo, a.apellidos, l.numero_libro
							FROM libros l, autores a, libros_autores la
							WHERE l.numero_libro = $numero_libro and 
							la.numero_libro = l.numero_libro AND
    						a.numero_autor = la.numero_autor
							");
		return $this->db->fetch();
	}
	
	public function buscarPorTituloAutor ($titulo, $autor){

		if ( (strlen ($titulo) <3 ) and (strlen ($autor) <3 ) ) throw new validacionException ("error validacion 10");		
		
		//Valido $titulo
		$titulo = substr ($titulo,0,300);
		$titulo = $this->db->escapeString($titulo);
		$titulo = $this->db->escapeWildcards($titulo);
				
		//Valido $autor
		$autor = substr ($autor,0,30);
		$autor = $this->db->escapeString($autor);
		$autor = $this->db->escapeWildcards($autor);

		if ( strlen ($titulo) < 3){
			
			$this->db->query("SELECT DISTINCT l.titulo, a.apellidos, l.numero_libro
							FROM libros l, autores a, libros_autores la, ejemplares ej
							WHERE a.apellidos LIKE '%$autor%' and 
							la.numero_libro = l.numero_libro and
    						a.numero_autor = la.numero_autor and
							ej.nombre_estado = 'domicilio' and
							ej.numero_libro = l.numero_libro
							");			
			return $this->db->fetchAll();
		}
		if ( strlen($autor) <3){
			$this->db->query("SELECT DISTINCT l.titulo, a.apellidos, l.numero_libro
							FROM libros l, autores a, libros_autores la, ejemplares ej
							WHERE l.titulo LIKE '%$titulo%' and 
							la.numero_libro = l.numero_libro and
    						a.numero_autor = la.numero_autor and
							ej.nombre_estado = 'domicilio' and
							ej.numero_libro = l.numero_libro
							");
			return $this->db->fetchAll();	
		}
		if (strlen ($autor)>=3 and strlen ($titulo)>=3){
			$this->db->query("SELECT DISTINCT l.titulo, a.apellidos, l.numero_libro
							FROM libros l, autores a, libros_autores la, ejemplares ej
							WHERE (l.titulo LIKE '%$titulo%' or a.apellidos LIKE '%$autor%') and 
							la.numero_libro = l.numero_libro and
    						a.numero_autor = la.numero_autor and
							ej.nombre_estado = 'domicilio' and
							ej.numero_libro = l.numero_libro
							");
		return $this->db->fetchAll();

		}
	}

	public function cantidadEjemplaresPermitidos ($tipo_usuario){
		
		if (!ctype_digit($tipo_usuario)) throw new validacionException ("error validacion 11");
		if ($tipo_usuario < 1 or $tipo_usuario > 4) throw new validacionException ("error validacion 12");

		// Validacion de que exista ese tipo de usuario en la base
		$this->db->query("SELECT *
							FROM tipo_usuario
							where numero_tipo = $tipo_usuario 
							LIMIT 1 ");
		if ($this->db->numRows() != 1) throw new validacionException ("error validacion 13");		

		$this->db->query(" SELECT cantidad_libros
							FROM tipo_usuario
							WHERE numero_tipo = $tipo_usuario");
		return $this->db->fetch();							

	}
	
	public function cantidadEjemplaresPrestados ($numero_socio){
		
		if (!ctype_digit($numero_socio)) throw new validacionException ("error validacion 14");
		if ($numero_socio < 1) throw new validacionException ("error validacion 15");

		// Validacion del id de socio
		$this->db->query("SELECT *
							FROM socios
							where numero_socio = $numero_socio 
							LIMIT 1 ");
		if ($this->db->numRows() != 1) throw new validacionException ("error validacion 16");

		$this->db->query(" SELECT pe.numero_ejemplar
							FROM prestamos_ejemplares pe, prestamos p
							WHERE p.numero_socio = $numero_socio AND
									pe.numero_prestamo = p.numero_prestamo AND
									pe.fecha_efectiva_devolucion is null
							GROUP BY pe.numero_ejemplar ");
			return $this->db->numRows();
	}

	public function cargarPrestamo ($numero_socio){
		
		if (!ctype_digit($numero_socio)) throw new validacionException ("error validacion 17");
		if ($numero_socio < 1) throw new validacionException ("error validacion 18");

		// Validacion del id de socio
		$this->db->query("SELECT *
							FROM socios
							where numero_socio = $numero_socio 
							LIMIT 1 ");
		if ($this->db->numRows() != 1) throw new validacionException ("error validacion 19");
		
		$this->db->query ("INSERT INTO prestamos (numero_socio, tipo_prestamo, fecha_prestamo, fecha_limite_devolucion)
							VALUES ($numero_socio, 'D', NOW(), NOW() + INTERVAL 7 day) ");
		$lastID= $this->db->insertID();
		
		$this->db->query ( "SELECT numero_prestamo, DATE_FORMAT(fecha_limite_devolucion, '%d-%m-%Y') as fecha_limite_devolucion 
							FROM prestamos
							where numero_prestamo = $lastID ");
		return $this->db->fetch();
	}

	public function cargarPrestamoEjemplar ($numero_prestamo, $numero_ejemplar){
		
		//Valido $numero_prestamo
		if (!ctype_digit($numero_prestamo)) throw new validacionException ("error validacion 20");
		if ($numero_prestamo < 1) throw new validacionException ("error validacion 21");

		// Valido que exista el prestamo en la base
		$this->db->query("SELECT *
							FROM prestamos
							where numero_prestamo = $numero_prestamo 
							LIMIT 1 ");
		if ($this->db->numRows() != 1) throw new validacionException ("error validacion 22");

		//Valido $numero_ejemplar
		if (!ctype_digit($numero_ejemplar)) throw new validacionException ("error validacion 23");
		if ($numero_ejemplar < 1) throw new validacionException ("error validacion 24");
		
		// Valido que exista el ejemplar en la base
		$this->db->query("SELECT *
							FROM ejemplares
							where numero_ejemplar = $numero_ejemplar 
							LIMIT 1 ");
		if ($this->db->numRows() != 1) throw new validacionException ("error validacion 25");
				
		$this->db->query ("INSERT INTO prestamos_ejemplares (numero_prestamo, numero_ejemplar)
							VALUES ($numero_prestamo, $numero_ejemplar)");
	}

	public function datosejemplar ($numero_ejemplar){
		
		//Valido $numero_ejemplar
		if (!ctype_digit($numero_ejemplar)) throw new validacionException ("error validacion 26");
		if ($numero_ejemplar < 1) throw new validacionException ("error validacion 27");

		// Valido que exista el ejemplar en la base
		$this->db->query("SELECT *
							FROM ejemplares
							where numero_ejemplar = $numero_ejemplar 
							LIMIT 1 ");
		if ($this->db->numRows() != 1) throw new validacionException ("error validacion 28");
		
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
		if (!ctype_digit($numero_prestamo)) throw new validacionException ("error validacion 29");
		if ($numero_prestamo < 1) throw new validacionException ("error validacion 30");

		// Valido que exista el prestamo en la base
		$this->db->query("SELECT *
							FROM prestamos
							where numero_prestamo = $numero_prestamo 
							LIMIT 1 ");
		if ($this->db->numRows() != 1) throw new validacionException ("error validacion 31");

		//Valido $numero_ejemplar
		if (!ctype_digit($numero_ejemplar)) throw new validacionException ("error validacion 32");
		if ($numero_ejemplar < 1) throw new validacionException ("error validacion 33");

		// Valido que exista el ejemplar en la base
		$this->db->query("SELECT *
							FROM ejemplares
							where numero_ejemplar = $numero_ejemplar 
							LIMIT 1 ");
		if ($this->db->numRows() != 1) throw new validacionException ("error validacion 34");

		//Valido $multa
		if (! is_numeric ($multa)) throw new validacionException ("error validacion 35");
		if ($multa < 0) throw new validacionException ("error validacion 36");
		
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