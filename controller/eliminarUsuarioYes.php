<?php

	//Se incluye una clase Panel, para el manejo dinamico de contenidos
	require_once "../lib/Panel.php";
	require_once '../model/Persona.php';
	
	//Se asigna a esta variable el archivo plantilla del home
	$pnlmain = new Panel("../view/index.html");
	
	// CONSTANTES
	$LOCATION="eliminarUsuarioV.php";
	
	//Se buscan los datos del usuario que ha iniciado sesion
	session_start();
	$user = new Persona();
	$user = $user->findByCedula($_SESSION["usuario"]);
	$pnlmain->add("username",$user->getUsername());
	
	$usuario = new Persona();
	if($_POST["cedula"])
	{
		$usuario->delete($_POST["cedula"]);
		$usuario=$usuario->findByCedula($_POST["cedula"]);
		if($usuario->getRol()==-1)
		{
			$pnlcontent = new Panel("../view/aviso.html");
			$pnlcontent->add("aviso","Usuario desactivado exitosamente");
		}
		else
		{
			$pnlcontent = new Panel("../view/error.html");
			$pnlcontent->add("aviso","Ha ocurrido un error, por favor intente en otro momento");
		}
	}
	else
	{
		$pnlcontent = new Panel("../view/error.html");
		$pnlcontent->add("aviso","Ha ocurrido un error, por favor intente en otro momento");		
	}
	$pnlcontent->add("location",$LOCATION);
	$pnlmain->add("content", $pnlcontent);
	$pnlmain->show();
?>