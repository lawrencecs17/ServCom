<?php

	//Se incluye una clase Panel, para el manejo dinamico de contenidos
	require_once "../lib/Panel.php";
	require_once '../model/Persona.php';
	require_once '../model/Validacion.php';
	
	//Constantes
	
	$ACTION="gestionUsuarioV.php";
	$TITULO="Datos de Usuario";
	$TEXT_BUTTON_SUBMIT="aceptar";
	$LOCATION="consultarUsuarioV.php";
	
	//Se asigna a esta variable el archivo plantilla del home
	$pnlmain = new Panel("../view/index.html");
	
	//Se buscan los datos del usuario que ha iniciado sesion
	session_start();
	$user = new Persona();
	$user = $user->findByCedula($_SESSION["usuario"]);
	$pnlmain->add("username",$user->getUsername());
	
	//Se procede la asignación
	$pnlcontent = new Panel("../view/fichaUsuario.html");
	
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
	$pnlcontent->add("action",$ACTION);
	$pnlcontent->add("titulo",$TITULO);
	$pnlcontent->add("location",$LOCATION);
	$pnlcontent->add("botonSubmit",$TEXT_BUTTON_SUBMIT);
	$pnlmain->add("content", $pnlcontent);
	$pnlmain->show();
	
?>