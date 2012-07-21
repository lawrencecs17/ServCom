<?php

		
		//Se incluye una clase Panel, para el manejo dinamico de contenidos
		require_once '../model/Fundacion.php';
		require_once '../model/Validacion.php';
		require_once '../lib/Panel.php';
		
		$ID_FUNDACION = "1";
		
		//Se asigna a esta variable el archivo plantilla del home
		$pnlmain = new Panel("../view/index.html");
		
		//Se procede la asignación
		$pnlcontent = new Panel("../view/modificarFundacion.html");		
		
		//Se cargan los datos de la fundacion paso a paso "ID = 1"
		
		$fundacion = new Fundacion();
		$fundacion = $fundacion->findById($ID_FUNDACION);
		
		//Se cargan los datos existentes del usuario
		
		$pnlcontent->add("rif",$fundacion->getRif());
		$pnlcontent->add("id",$fundacion->getIdFundacion());
		$pnlcontent->add("nombre",$fundacion->getNombre());
		$pnlcontent->add("email",$fundacion->getEmail());
		$pnlcontent->add("telefono",$fundacion->getTelefono());
		$pnlcontent->add("direccion",$fundacion->getDireccion());
		
		$pnlmain->add("content", $pnlcontent);
		
		//Se muestra la página
		$pnlmain->show();

?>