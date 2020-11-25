<?php
$controlador = "Devoluciones";
 include("../html/Index.php") ?>

    <div class="PrimeraAparicion">
		
        <p class="alert alert-success" ><strong> Se ha concretado la carga de la devolucion de los ejemplares solicitados. </strong> Abajo el detalle correspondiente</p>
        
        <table class="table table-hover">
        <thead class="thead-dark">
            <tr><th>Numero de prestamo</th><th>Numero de ejemplar</th><th>Titulo</th><th>Apellido autor</th><th>Multa</th></tr>
        </thead>	
            <?php $sumador=0 ?>
            <?php foreach($this->LibrosDevueltos as $l) { ?>
            <tbody id="bodyTitulos">
                <tr>
                    <td><?= $l['numero_prestamo'] ?></td>
                    <td><?= $l['numero_ejemplar'] ?></td>
                    <td><?= $l['titulo'] ?></td>
                    <td><?= $l['apellidos'] ?></td>
                    <td><?= $l['multa'] ?></td>
                </tr>
            </tbody>
            <?php } ?>
        </table>
	</div>		
</body>
</html>