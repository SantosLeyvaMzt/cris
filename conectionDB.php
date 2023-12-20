<?php
	//QA
	$mysqli = new mysqli("localhost", "root", "", "pruebas");
	//PRD
	//$mysqli = new mysqli("localhost", "uyercs7oaqwmr", "zbwhblpjmehs", "dbdc2rzgg32hhk");
	if ($mysqli->connect_errno) {
	    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
?>