<?php

	//Se incluye una clase Panel, para el manejo dinamico de contenidos
	require_once "../lib/Panel.php";
	require_once '../model/Persona.php';
	require_once '../model/Cuenta.php';
	require_once '../model/Validacion.php';
	require_once '../model/Banco.php';
	
	// CONSTANTES
	$LOCATION="eliminarCuentaV.php";
	$ACTION = "eliminarCuentaYes.php";
	$TITULO = "Eliminar Cuenta";
	$BOTON_VALUE = "desactivar";
	
	//Se asigna a esta variable el archivo plantilla del home
	$pnlmain = new Panel("../view/index.html");	
	
	//Se buscan los datos del usuario que ha iniciado sesion
	session_start();
	$user = new Persona();
	$user = $user->findByCedula($_SESSION["usuario"]);
	$pnlmain->add("username",$user->getUsername());
	
	//Se procede la asignación
	$pnlcontent = new Panel("../view/confirmarActivarCuenta.html");
	
	$pnlmain->add("content", $pnlcontent);
	
	//Se recuperán las variables de session	
	
	if($_POST["listUsuario"]!=0)
	{
		$cuenta= new Cuenta();
		$cuenta = $cuenta->findById( $_POST["listUsuario"]);	
		
		//Se cargan los datos existentes del usuario
		
		$pnlcontent->add("id",$cuenta->getIdCuenta());
		$pnlcontent->add("codigoCliente",$cuenta->getCodigoCliente());
		$pnlcontent->add("titular",$cuenta->getTitular());
		$pnlcontent->add("banco",$cuenta->getBanco());		
		
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