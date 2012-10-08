<?php

		
		//Se incluye una clase Panel, para el manejo dinamico de contenidos
		require_once ("../lib/Panel.php");
		require_once '../model/Persona.php';
		require_once '../model/Egreso.php';
		require_once '../model/Tipo.php';
		
		// CONSTANTES		
		$LOCATION="gestionEgresoV.php";
		$ACTION = "registrarEgreso.php";
		$TITULO = "Registro de Egreso";
		
		//Se asigna a esta variable el archivo plantilla del home
		$pnlmain = new Panel("../view/index.html");
		
		//Se buscan los datos del usuario que ha iniciado sesion
		session_start();
		$user = new Persona();
		$user = $user->findByCedula($_SESSION["usuario"]);
		$pnlmain->add("username",$user->getUsername());
		
		$miBD = new ConexionBD();
		$miBD->setConexion($miBD->conectarBD($miBD));		
		$query = "Select * from Tipo ORDER BY nombre ASC";
		$resultado = mysql_query($query,$miBD->getConexion());
		while($fila = mysql_fetch_array($resultado))
		{
			$tipo = new Tipo();
			$tipo->setIdTipo($fila['idTipo']);
			$tipo->setNombre($fila['nombre']);
		
			$comboBox =$comboBox."<OPTION VALUE=".$tipo->getIdTipo().">".$tipo->getNombre()."</OPTION> ";
		
		}
		mysql_close();
		$fecha = date("d-m-Y");
		//Se procede la asignación
		$pnlcontent = new Panel("../view/registrarEgreso.html");		
		$pnlcontent->add("location",$LOCATION);
		$pnlcontent->add("action",$ACTION);
		$pnlcontent->add("fecha",$fecha);
		$pnlcontent->add("titulo",$TITULO);
		$pnlcontent->add("list",$comboBox);
		$pnlmain->add("content", $pnlcontent);
		
		//Se muestra la página
		$pnlmain->show();

?>