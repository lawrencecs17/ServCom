<?php

		
		//Se incluye una clase Panel, para el manejo dinamico de contenidos
		require_once ("../lib/Panel.php");
		require_once '../model/Persona.php';
		
		// CONSTANTES		
		$LOCATION="gestionUsuarioV.php";
		
		//Se asigna a esta variable el archivo plantilla del home
		$pnlmain = new Panel("../view/index.html");
		
		//Se buscan los datos del usuario que ha iniciado sesion
		session_start();
		$user = new Persona();
		$user = $user->findByCedula($_SESSION["usuario"]);
		$pnlmain->add("username",$user->getUsername());
		
		//Se procede la asignación
		$pnlcontent = new Panel("../view/registroUsuario.html");		
		$pnlcontent->add("location",$LOCATION);
		$pnlmain->add("content", $pnlcontent);
		
		//Se muestra la página
		$pnlmain->show();

?>