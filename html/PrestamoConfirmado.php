<?php
$controlador = "PrestamoConfirmado";
 include("../html/Index.php") ?>
	
	<div class="PrimeraAparicion">
	
		<p class="alert alert-success" ><strong> Su prestamo ha sido confirmado. </strong> Su numero de prestamos es <?php echo $this->Numero_Prestamo['numero_prestamo']?> y la fecha de
			devolucion es el <?php echo $this->Numero_Prestamo['fecha_limite_devolucion']?>. Se le han prestados los siguientes ejemplares: </p>
    	<table>
			<table class="table table-hover">
			<thead class="thead-dark">
				<tr><th>Numero de ejemplar</th><th>titulo</th><th>Autor</th></tr>
			</thead>	
			<tbody id="bodyTitulos">
				<?php foreach ($this->Datos_Ejemplares as $key => $value) { ?>
					<tr>
						<td><?php echo $this->Datos_Ejemplares [$key]['numero_ejemplar'] ?></td>
						<td><?php echo $this->Datos_Ejemplares [$key]['titulo'] ?></td>
						<td><?php echo $this->Datos_Ejemplares [$key]['apellidos'] ?></td>
					</tr>
			</tbody>
				<?php } ?>
		</table>	
	</div>
</body>
</html>