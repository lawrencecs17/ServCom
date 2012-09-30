<?php

	//Se incluye una clase Panel, para el manejo dinamico de contenidos
	require_once "../lib/Panel.php";
	require_once '../model/Persona.php';
	require_once '../model/Banco.php';
	
	//Se asigna a esta variable el archivo plantilla del home
	$pnlmain = new Panel("../view/index.html");
	
	// CONSTANTES
	$LOCATION="modificarBancoV.php";
	
	//Se buscan los datos del usuario que ha iniciado sesion
	session_start();
	$user = new Persona();
	$user = $user->findByCedula($_SESSION["usuario"]);
	$pnlmain->add("username",$user->getUsername());
	$nombre 	 = $_POST['nombre'];
	$telefono 	 = $_POST['telefono'];
	$direccion	 = $_POST['direccion'];
	$id	 = $_POST['id'];
	
	$banco = new Banco();
	$banco->setNombre($nombre);;
	$banco->setTelefono($telefono);
	$banco->setDireccion($direccion);
	$banco->setIdBanco($id);
	$resultado = $banco->update($banco);

	if($resultado==false)
	{
			
		$pnlcontent = new Panel("../view/error.html");
		$pnlcontent->add("location",$LOCATION);
		$pnlcontent->add("aviso", "Ha ocurrido un error en el servidor intente luego.");
		$pnlmain->add("content", $pnlcontent);
		$pnlmain->show();
	}
	else
	{
		$pnlcontent = new Panel("../view/aviso.html");
		$pnlcontent->add("location",$LOCATION);
		$pnlcontent->add("aviso", "Registro Exitoso");
		$pnlmain->add("content", $pnlcontent);
		$pnlmain->show();
	}	
?>