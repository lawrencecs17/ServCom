<?php

	//Se incluye una clase Panel, para el manejo dinamico de contenidos
	require_once "../lib/Panel.php";
	require_once '../model/Persona.php';
	require_once '../model/Validacion.php';
	require_once '../model/Banco.php';
	
	// CONSTANTES
	$LOCATION="consultarBancoV.php";
	$ACTION ="gestionBancoV.php";
	$TITULO = "Consultar Banco";
	$BOTON_VALUE = "aceptar";
	
	//Se asigna a esta variable el archivo plantilla del home
	$pnlmain = new Panel("../view/index.html");	
	
	//Se buscan los datos del usuario que ha iniciado sesion
	session_start();
	$user = new Persona();
	$user = $user->findByCedula($_SESSION["usuario"]);
	$pnlmain->add("username",$user->getUsername());
	
	//Se procede la asignación
	$pnlcontent = new Panel("../view/confirmarActivarBanco.html");
	
	$pnlmain->add("content", $pnlcontent);
	
	//Se recuperán las variables de session	
	
	if($_POST["listUsuario"]!=0)
	{
		$banco = new Banco();
		$banco = $banco->findById( $_POST["listUsuario"]);	
		
		//Se cargan los datos existentes del usuario
		
		$pnlcontent->add("id",$banco->getIdBanco());
		$pnlcontent->add("nombre",$banco->getNombre());
		$pnlcontent->add("direccion",$banco->getDireccion());
		$pnlcontent->add("telefono",$banco->getTelefono());		
		
	}
	else
	{
		$pnlcontent = new Panel("../view/error.html");		
		$pnlcontent->add("aviso","No ha seleccionado un banco valido");
	}
	//Se muestra la página
	$pnlcontent->add("titulo",$TITULO);
	$pnlcontent->add("boton_value",$BOTON_VALUE);
	$pnlcontent->add("action",$ACTION);
	$pnlcontent->add("location",$LOCATION);
	$pnlmain->add("content", $pnlcontent);	
	$pnlmain->show();
	
?>