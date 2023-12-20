<?php
	require_once("conectionDB.php");

	$usuario 		= explode('-', $_REQUEST['selectUser']);
	$idUsuario 		= $usuario[0];
	$usuarioName 	= $usuario[1];

	$getCrisDB 		= $mysqli->query("SELECT cris FROM participantes WHERE id = '$idUsuario'");
	$crisDB 		= $getCrisDB->fetch_assoc();
	$crisDB 		= $crisDB['cris'];

	if( !empty( $crisDB ) ){
		$cris = $crisDB;
	}else{

		$arrayCris = array();

		$resultado = $mysqli->query("SELECT id, name, nick_name FROM participantes WHERE is_cris != 1");
		$resultado->data_seek(0);

		while( $fila = $resultado->fetch_assoc() ){
			$nickName = ( !empty( $fila['nick_name'] ) ) ? ' (' . $fila['nick_name'] . ') ' : '';
			$arrayCris[$fila['id']]['name'] 	= $fila['name'] . $nickName;
		}

		//print_r( $arrayCris );

		$cris = getCris( $arrayCris, $idUsuario, $mysqli );

	}

	function getCris( $arrayCris, $idUsuario, $mysqli ){
		$nameCris = '';

		while( empty( $nameCris ) ){
			$aleatorio 	= rand(1, 15);

			//Si el id obtenido es diferente al id del usuario, busca su cris.
			if( $aleatorio != $idUsuario ){
				@$nameCris 	= $arrayCris[$aleatorio]['name'];
				
				if( !empty( $nameCris) ){
					updateCris( $aleatorio, $mysqli, $idUsuario, $nameCris );
				}
				
			}
			
		}

		return $nameCris;
	}

	function updateCris( $idCris, $mysqli, $idUsuario, $nameCris ){
		$mysqli->query("UPDATE participantes SET cris = '$nameCris' WHERE id = '$idUsuario'");
		$mysqli->query("UPDATE participantes SET is_cris = 1 WHERE id = '$idCris'");
	}
	
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
	  	
		<div class="alert alert-success" role="alert">
  			<?php echo '<h3 align="center">Hola <b>' . $usuarioName . '</b> tu Cris es: <b> ' . $cris . '</b> :) </h3>'; ?>
		</div>


	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	  </body>
	</html>