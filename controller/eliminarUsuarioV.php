<?php

	//Se incluye una clase Panel, para el manejo dinamico de contenidos
	require_once ("../lib/Panel.php");
	require_once '../model/Persona.php';
	require_once '../model/ArrayList.php';
	require_once '../model/ConexionBD.php';
	
	
	//Se asigna a esta variable el archivo plantilla del home
	$pnlmain = new Panel("../view/index.html");
	
	//Se procede la asignación
	$pnlcontent = new Panel("../view/eliminarUsuario.html");	
	
	/****************************/
	$miBD = new ConexionBD();
	$miBD->setConexion($miBD->conectarBD($miBD));
	$usuario = null;
	$comboBox="";
	//Se listan todos los usuarios ACTIVOS
	$query = "Select * from Persona WHERE rol <> -1 ORDER BY apellido ASC";
	$resultado = mysql_query($query,$miBD->getConexion());
	while($fila = mysql_fetch_array($resultado))
	{
		$usuario = new Persona();
		$usuario->setIdPersona($fila['idPersona']);
		$usuario->setNombre($fila['nombre']);
		$usuario->setApellido($fila['apellido']);
		$usuario->setCedula($fila['cedula']);
		$usuario->setTelefono($fila['telefono']);
		$usuario->setEmail($fila['email']);
		$usuario->setUsername($fila['userName']);
		$usuario->setPassword($fila['password']);
		$usuario->setRol($fila['rol']);
		$usuario->setFkFundacion($fila['fkFundacion']);
		
		$comboBox =$comboBox."<OPTION VALUE=".$usuario->getCedula().">".$usuario->getApellido()." ".$usuario->getNombre()."</OPTION> ";
	
	}
	mysql_close();	
	
	/****************************/
	$pnlcontent->add("listUsuario",$comboBox);
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
?>