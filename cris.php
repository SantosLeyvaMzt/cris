<?php
	require_once("conectionDB.php");
		
	$resultado = $mysqli->query("SELECT id, name, nick_name FROM participantes WHERE cris = '' OR cris IS NULL");
	$resultado->data_seek(0);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intercambios navideños!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
  	<form class="row g-3" method="POST" action="getCris.php">
	  	<div class="mb-3" align="center">
	    	<h1>Intercambios navideños!</h1>
	    </div>
	    <div class="mb-3">
		    <select id="selectUser" name="selectUser" class="form-select">
				  <option selected>Selecciona tu nombre</option>
				  <?php
				  	while ( $fila = $resultado->fetch_assoc() ) {
				  		$nickName = ( !empty( $fila['nick_name'] ) ) ? ' (' . $fila['nick_name'] . ') ' : '' ;
							echo '<option value="' . $fila['id'] . '-' . $fila['name'] . ' ' . $nickName . '">' . $fila['name'] . $nickName . '</option>';
						}
				  ?>
				</select>
			</div>
			<div class="mb-3" align="center">
	    	<button type="submit" class="btn btn-primary mb-3">Buscar Cris</button>
	    </div>
		</form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>