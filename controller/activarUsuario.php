<?php

	//Se incluye una clase Panel, para el manejo dinamico de contenidos
	require_once "../lib/Panel.php";
	require_once '../model/Persona.php';
	require_once '../model/Validacion.php';
	
	//Se asigna a esta variable el archivo plantilla del home
	$pnlmain = new Panel("../view/index.html");
	
	//Se procede la asignación
	$pnlcontent = new Panel("../view/confirmarActivarUsuario.html");
	
	$pnlmain->add("content", $pnlcontent);
	
	//Se recuperán las variables de session	
	
	if($_POST["listUsuario"]!=0)
	{
		$usuario = new Persona();
		$usuario = $usuario->findByCedula( $_POST["listUsuario"]);	
		
		//Se cargan los datos existentes del usuario
		
		$pnlcontent->add("cedula",$usuario->getCedula());
		$pnlcontent->add("nombre",$usuario->getNombre());
		$pnlcontent->add("apellido",$usuario->getApellido());
		$pnlcontent->add("email",$usuario->getEmail());
		$pnlcontent->add("username",$usuario->getUsername());
		$pnlcontent->add("telefono",$usuario->getTelefono());
		
	
	}
	else 
	{
		$pnlcontent = new Panel("../view/error.html");
		$pnlcontent->add("aviso","No ha seleccionado un usuario valido");
	}
	//Se muestra la página
	$pnlmain->add("content", $pnlcontent);
	$pnlmain->show();
	
?>