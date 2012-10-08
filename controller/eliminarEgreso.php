<?php

	//Se incluye una clase Panel, para el manejo dinamico de contenidos
	require_once "../lib/Panel.php";
	require_once '../model/Persona.php';
	require_once '../model/Egreso.php';
	require_once '../model/Validacion.php';
	require_once '../model/Banco.php';
	
	// CONSTANTES
	$LOCATION="eliminarEgresoV.php";
	$ACTION = "eliminarEgresoYes.php";
	$TITULO = "Eliminar Egreso";
	$BOTON_VALUE = "desactivar";
	
	//Se asigna a esta variable el archivo plantilla del home
	$pnlmain = new Panel("../view/index.html");	
	
	//Se buscan los datos del usuario que ha iniciado sesion
	session_start();
	$user = new Persona();
	$user = $user->findByCedula($_SESSION["usuario"]);
	$pnlmain->add("username",$user->getUsername());
	
	//Se procede la asignación
	$pnlcontent = new Panel("../view/confirmarEgreso.html");
	
	$pnlmain->add("content", $pnlcontent);
	
	//Se recuperán las variables de session	
	
	if($_POST["listUsuario"]!=0)
	{
		$egreso= new Egreso();
		$egreso = $egreso->findById( $_POST["listUsuario"]);	
		
		//Se cargan los datos existentes del usuario
		
		$pnlcontent->add("id",$egreso->getIdEgreso());
		$pnlcontent->add("nombre",$egreso->getNombre());
		$pnlcontent->add("tipo",$egreso->getTipo());
		$pnlcontent->add("fecha",$egreso->getFecha());
		$pnlcontent->add("persona",$egreso->getPersona());
		$pnlcontent->add("descripcion",$egreso->getDescripcion());
		
	}
	else
	{
		$pnlcontent = new Panel("../view/error.html");		
		$pnlcontent->add("aviso","No ha seleccionado una Cuenta valida");
	}
	//Se muestra la página
	$pnlcontent->add("titulo",$TITULO);
	$pnlcontent->add("boton_value",$BOTON_VALUE);
	$pnlcontent->add("action",$ACTION);
	$pnlcontent->add("location",$LOCATION);
	$pnlmain->add("content", $pnlcontent);	
	$pnlmain->show();
	
?>