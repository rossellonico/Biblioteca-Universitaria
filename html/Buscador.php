<?php
$controlador = "Buscador";
 include("../html/Index.php") ?>

	<div class="PrimeraAparicion">
		
		<form action="" method="post">
			<div class="form-row">	
				<div class="form-group col-md-6">
					<label for="titulo1"> Titulo: </label>
					<input type="text" class="form-control" name="titulo1" id="titulo1" placeholder="Ingrese el titulo (mínimo 3 caracteres)">
				</div>
				<div class="form-group col-md-6">
					<label for="autor1" > Autor: </label>
					<input type="text" class="form-control" name="autor1" id="autor1" placeholder="Ingrese el apellido (mínimo 3 caracteres)">
				</div>
			</div>	
			<button type="submit" class="btn btn-primary" name="Buscar">Buscar</button>
		</form>		
	</div>
</body>
</html>

