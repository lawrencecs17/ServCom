<?php

	//Se incluye una clase Panel, para el manejo dinamico de contenidos
	require_once "../lib/Panel.php";
	require_once '../model/Persona.php';
	require_once '../model/Egreso.php';
	require_once '../model/Validacion.php';
	require_once '../model/Tipo.php';
	
	// CONSTANTES
	$LOCATION="modificarEgresoV.php";
	$ACTION = "modificarEgresoYes.php";
	$TITULO = "Editar Egreso";
	$BOTON_VALUE = "actualizar";
	
	//Se asigna a esta variable el archivo plantilla del home
	$pnlmain = new Panel("../view/index.html");	
	
	//Se buscan los datos del usuario que ha iniciado sesion
	session_start();
	$user = new Persona();
	$user = $user->findByCedula($_SESSION["usuario"]);
	$pnlmain->add("username",$user->getUsername());
	
	//Se procede la asignación
	$pnlcontent = new Panel("../view/registrarEgreso.html");
	
	$pnlmain->add("content", $pnlcontent);
	
	//Se recuperán las variables de session	
	
	if($_POST["listUsuario"]!=0)
	{
		$egreso= new Egreso();
		$egreso = $egreso->findById( $_POST["listUsuario"]);	
		
		$miBD = new ConexionBD();
		$miBD->setConexion($miBD->conectarBD($miBD));
		$query = "Select * from Tipo ORDER BY nombre ASC";
		$resultado = mysql_query($query,$miBD->getConexion());
		while($fila = mysql_fetch_array($resultado))
		{
			$tipo = new Tipo();
			$tipo->setIdTipo($fila['idTipo']);
			$tipo->setNombre($fila['nombre']);
		
			if($tipo->getIdTipo() == $egreso->getFkTipo()){
				$comboBox =$comboBox."<OPTION selected='selected' VALUE=".$tipo->getIdTipo().">".$tipo->getNombre()."</OPTION> ";
			}
			else{
				$comboBox =$comboBox."<OPTION VALUE=".$tipo->getIdTipo().">".$tipo->getNombre()."</OPTION> ";
			}
		}
		
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
	$pnlcontent->add("list",$comboBox);
	$pnlmain->add("content", $pnlcontent);	
	$pnlmain->show();
	
?>