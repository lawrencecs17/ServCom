<?php

		
		//Se incluye una clase Panel, para el manejo dinamico de contenidos
		require_once ("../lib/Panel.php");
		require_once '../model/Persona.php';
		require_once '../model/Banco.php';
		require_once '../model/Cuenta.php';
		
		// CONSTANTES		
		$LOCATION="gestionCuentaV.php";
		$ACTION = "registrarCuenta.php";
		$TITULO = "Registro de Cuenta";
		
		//Se asigna a esta variable el archivo plantilla del home
		$pnlmain = new Panel("../view/index.html");
		
		//Se buscan los datos del usuario que ha iniciado sesion
		session_start();
		$user = new Persona();
		$user = $user->findByCedula($_SESSION["usuario"]);
		$pnlmain->add("username",$user->getUsername());
		
		
		//Se listan todos los bancos ACTIVOS
		$miBD = new ConexionBD();
		$miBD->setConexion($miBD->conectarBD($miBD));
		$query = "Select * from Banco WHERE status = 1 ORDER BY nombre ASC";
		$resultado = mysql_query($query,$miBD->getConexion());
		while($fila = mysql_fetch_array($resultado))
		{
			$banco = new Banco();
			$banco->setIdBanco($fila['idBanco']);
			$banco->setNombre($fila['nombre']);
			$banco->setDireccion($fila['direccion']);
			$banco->setTelefono($fila['telefono']);
			$banco->setFkFundacion($fila['fkFundacion']);
		
			$comboBox =$comboBox."<OPTION VALUE=".$banco->getIdBanco().">".$banco->getNombre()."</OPTION> ";
		
		}
		mysql_close();
		
		//Se procede la asignación
		$pnlcontent = new Panel("../view/registrarCuenta.html");
		$pnlcontent->add("location",$LOCATION);
		$pnlcontent->add("action",$ACTION);
		$pnlcontent->add("titulo",$TITULO);
		$pnlcontent->add("list",$comboBox);
		$pnlmain->add("content", $pnlcontent);
		//Se muestra la página
		$pnlmain->show();

?>