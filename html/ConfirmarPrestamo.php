<?php
$controlador = "ConfirmarPrestamo";
 include("../html/Index.php") ?>


	<div class="PrimeraAparicion">

		

	<?php if (empty ($this->Prestamo)) { ?>	
		<p class="text-dark">No ha solicitado ningún libro para préstamo<p>
	<?php } ?>

		<?php if (isset ($this->DatosLibrosEjemplaresPrestados)) { ?>
			<p class="text-dark">El prestamo solicitado no se pudo realizar. Los siguientes libros se encuentran prestados en este momento. Para realizar el prestamo debe sacarlos de la seleccion <p>
			<table>
				<tr><th>Id_libro</th><th>titulo</th><th>Autor</th></tr>
				<?php foreach ($this->DatosLibrosEjemplaresPrestados as $key => $value) { ?>
					<tr>
						<td><?php echo $this->DatosLibrosEjemplaresPrestados [$key]['numero_libro'] ?></td>
						<td><?php echo $this->DatosLibrosEjemplaresPrestados [$key]['titulo'] ?></td>
						<td><?php echo $this->DatosLibrosEjemplaresPrestados [$key]['apellidos'] ?></td>
					</tr>
					
				<?php } ?>
			</table>


		<?php } ?>
		
		<form action="" method="post">
			<table>
			<table class="table table-hover">
				<thead class="thead-dark">	
					<tr><th>Identificador libro</th><th>titulo</th><th>Autor</th><th>Quitar de prestamos</th></tr>
				</thead>
				<tbody id="bodyTitulos">
					<?php foreach ($this->Prestamo as $key => $value) { ?>
						<tr>
							<td><?php echo $this->Prestamo [$key]['numero_libro'] ?></td>
							<td><?php echo $this->Prestamo [$key]['titulo'] ?></td>
							<td><?php echo $this->Prestamo [$key]['apellidos'] ?></td>
							
							<td><input type="checkbox" name="Sacar<?=$key?>" value="<?=$this->Prestamo[$key]['numero_libro']?>"/></td>
							
					</tr>
				</tbody>
				<?php } ?>
			</table>
			<?php if (!empty ($this->Prestamo)) { ?>	
				<input type="submit" class="btn btn-primary" value="Solicitar prestamos de libros seleccionados" name="Solicita"/>
				<input type="submit" class="btn btn-primary" value="Quitar libros seleccionados" name="Quitar"/>
			<?php } ?>
		</form>
		
	</div>	
</body>
</html>