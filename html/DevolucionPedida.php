<?php
$controlador = "Devoluciones";
 include("../html/Index.php") ?>

    <div class="PrimeraAparicion">
		
        <?php if ( empty ( $this->LibrosPrestados )) { ?>
			<p class="text-dark">Usted no tiene libros prestados</p>
        <?php } ?>

        <form action="" method="post">	
            <table class="table table-hover">
            <thead class="thead-dark">
                <tr><th>Numero de prestamo</th><th>Numero de ejemplar</th><th>Titulo</th><th>Apellido autor</th><th>Marcar libros a devolver</th></tr>
            </thead>	
                <?php $sumador=0 ?>
                <?php foreach($this->LibrosPrestados as $l) { ?>
                <tbody id="bodyTitulos">
                    <tr>
                        <td><?= $l['numero_prestamo'] ?></td>
                        <td><?= $l['numero_ejemplar'] ?></td>
                        <td><?= $l['titulo'] ?></td>
                        <td><?= $l['apellidos'] ?></td>
                        <?php $sumador = $sumador + 1;?>
                        <td><input type="checkbox" name="Devuelto<?=$sumador?>" value="<?=$l['numero_ejemplar']?>" /></td>
                    </tr>
                </tbody>
                <?php } ?>
            </table>
            <?php if ( !empty ( $this->LibrosPrestados )) { ?>
			    <input type="submit" class="btn btn-primary" value="Devolver libros marcados" name="Devolver"/>
            <?php } ?>
		</form>
	</div>		
</body>
</html>