<?php
$controlador = "MostrarTitulos";
 include("../html/Index.php") ?>

	<div class="PrimeraAparicion">
		<?php if ($this->SinTituloAutor == TRUE) { ?>
			<p class="lead"><strong>Usted no ha ingresado ningun título ni autor </strong></p>
		<?php } ?>
						 
		<?php if ($this->NoHayCoincidencia == TRUE ) { ?>
			<p class="lead"><strong>Ningun libro coincide con la busqueda pedida</strong></p>
		<?php } ?>


		<form action="" method="post">
			<div class="form-row">	
				<div class="form-group col-md-6">
					<label for="titulo1"> Titulo: </label>
					<input type="text" class="form-control" name="titulo1" id="titulo1" placeholder="Ingrese el titulo">
				</div>
				<div class="form-group col-md-6">
					<label for="autor1" > Autor: </label>
					<input type="text" class="form-control" name="autor1" id="autor1" placeholder="Ingrese el apellido">
				</div>
			</div>	
			<button type="submit" class="btn btn-primary" name="Buscar">Buscar</button>
		</form>		
	</div>

	<div class="MostrarTitulos">
	
		<?php if ( ($this->Confirmar == FALSE) and  ($this->Repetidos == FALSE)   ) { ?>
		<p class="lead"><strong>Su pedido de agregar esos libros para prestamos no fue realizado. Usted solicito una cantidad de libros mayor a la que tiene permitida</strong></p>

		<?php } ?>
		
		<?php if ($this->Repetidos == TRUE) { ?>
		<p class="lead"><strong>Su pedido de agregar esos libros para prestamos no fue realizado. Usted solicito más de una vez el mismo libro</strong></p>

		<?php } ?>

		<?php if ($this->SinTituloAutor == FALSE  and $this->NoHayCoincidencia == FALSE  ) { ?>  
 
			<form action="" method="post">
				
					<table class="table table-hover">
					<thead class="thead-dark">
						<tr><th>Titulo</th><th>Autor</th><th>Agregar para prestamo</th></tr>
					</thead>	
						<?php $sumador=0 ?>
						<?php foreach($this->Libro as $l) { ?>
						<tbody id="bodyTitulos">
							<tr>
								<td><?= $l['titulo'] ?></td>
								<td><?= $l['apellidos'] ?></td>
								<?php $sumador = $sumador + 1;?>
								<td><input type="checkbox" name="Pedido<?=$sumador?>" value="<?=$l['numero_libro']?>" /></td>
							</tr>
						</tbody>
						<?php } ?>
					</table>
				<input type="submit" class="btn btn-primary" value="Agregar estos libros al pedido de prestamo" name="Solicita"/>
			</form>
		<?php } ?>

	</div>		
</body>
</html>