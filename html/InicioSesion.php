<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="InicioSesion.js"> </script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
  <title>Bienvenido</title>

  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link type="text/css" href="../html/style/inicio.css" rel="stylesheet">
</head>

<body>

  <img src="../html/img/logo.png" id="logo">

        <?php if ( isset ($this->NoLogueado)) { ?>
          <div class="nico">
            <div class="col-lg-5">
              <p class="alert-warning"><strong> ¡Atención! </strong> Los datos ingresados no son correctos</p>
            </div>
          </div>
        <?php } ?>
      
    
    <form action="" method="post">
    <div class="form-group row">
      <div class="col-lg-4">
        <label for="email">Usuario:</label>
          <input type="email" class="form-control" id="email" name="email" required/>
      </div>   
    </div>
      <div class="form-group row">
        <div class="col-lg-4">
          <label for="clave">Clave:</label>
          <input type="password"  class="form-control" id="clave" name="clave" required/>
        </div>    
      </div>
    
      <input type="submit" class="btn btn-primary"/>


  </form>

</body>
</html>