<?php

	//Se incluye una clase Panel, para el manejo dinamico de contenidos
	require_once "../lib/Panel.php";
	require_once '../model/Persona.php';
	require_once '../model/Egreso.php';
	
	//Se asigna a esta variable el archivo plantilla del home
	$pnlmain = new Panel("../view/index.html");
	
	// CONSTANTES
	$LOCATION="activarEgresoV.php";
	
	//Se buscan los datos del usuario que ha iniciado sesion
	session_start();
	$user = new Persona();
	$user = $user->findByCedula($_SESSION["usuario"]);
	$pnlmain->add("username",$user->getUsername());
	
	$egreso = new Egreso();
	if($_POST["id"])
	{
		$egreso->active($_POST["id"]);
		$egreso=$egreso->findById($_POST["id"]); 
		if($egreso->getStatus()==1)
		{
			$pnlcontent = new Panel("../view/aviso.html");
			$pnlcontent->add("aviso","Egreso activado exitosamente");
		}
		else
		{
			$pnlcontent = new Panel("../view/error.html");
			$pnlcontent->add("aviso","Ha ocurrido un error, por favor intente en otro momento ".$banco->getStatus());
		}
	}
	else
	{
		$pnlcontent = new Panel("../view/error.html");
		$pnlcontent->add("aviso","Ha ocurrido un error, por favor intente en otro momento".$banco->getStatus());		
	}
	$pnlcontent->add("location",$LOCATION);
	$pnlmain->add("content", $pnlcontent);
	$pnlmain->show();	
?>