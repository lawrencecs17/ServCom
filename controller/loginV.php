<?php
		
	//Se incluye una clase Panel, para el manejo dinamico de contenidos
	require_once ("../lib/Panel.php");
	
	//Se asigna a esta variable el archivo plantilla del home
	$pnlmain = new Panel("../view/index2.html");
	
	//Se procede la asignación
	$pnlcontent = new Panel("../view/login.html");
	$pnlmain->add("content", $pnlcontent);
	
	//Se muestra la página
	$pnlmain->show();
	
?>