<?php

	session_start();
	
	//Se incluye una clase Panel, para el manejo dinamico de contenidos
	require_once "../lib/Panel.php";
	require_once '../model/Persona.php';
	require_once '../model/Validacion.php';
	
	//Constantes
	$LOCATION="gestionUsuarioV.php";
	
	//Se asigna a esta variable el archivo plantilla del home
	$pnlmain = new Panel("../view/index.html");
	
	//Se buscan los datos del usuario que ha iniciado sesion
	$user = new Persona();
	$user = $user->findByCedula($_SESSION["usuario"]);
	$pnlmain->add("username",$user->getUsername());
	
	//Se procede la asignación
	$pnlcontent = new Panel("../view/modificarUsuario.html");
	
	$pnlmain->add("content", $pnlcontent);
	
	//Se recuperán las variables de session	
	
	if($_SESSION["usuario"])
	{
		$usuario = new Persona();
		$usuario = $usuario->findByCedula( $_SESSION["usuario"]);	
		
		//Se cargan los datos existentes del usuario
		
		$pnlcontent->add("id",$usuario->getIdPersona());
		$_SESSION["idPersona"]=$usuario->getIdPersona();
		$pnlcontent->add("cedula",$usuario->getCedula());
		$pnlcontent->add("nombre",$usuario->getNombre());
		$pnlcontent->add("apellido",$usuario->getApellido());
		$pnlcontent->add("email",$usuario->getEmail());
		$pnlcontent->add("username",$usuario->getUsername());
		$pnlcontent->add("telefono",$usuario->getTelefono());
		
		//Se muestra la página
		$pnlcontent->add("location",$LOCATION);
		$pnlmain->add("content", $pnlcontent);
		$pnlmain->show();
	}
?>