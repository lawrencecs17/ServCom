
<?php
	session_start();
	//Se incluye una clase Panel, para el manejo dinamico de contenidos
	require_once ("../lib/Panel.php");
	require_once '../model/Persona.php';
	
	//Se asigna a esta variable el archivo plantilla del home
	$pnlmain = new Panel("../view/index.html");
	
	//Se buscan los datos del usuario que ha iniciado sesion
	
	$usuario = new Persona();
	$usuario = $usuario->findByCedula($_SESSION["usuario"]);
	
	//Se procede la asignación	
	$pnlcontent = new Panel("../view/menu.html");
	$pnlcontent->add("user",$usuario->getNombre()." ".$usuario->getApellido());
	$pnlmain->add("username",$usuario->getUsername());
	$pnlmain->add("content", $pnlcontent);
	
	//Se muestra la página
	$pnlmain->show();

?>
