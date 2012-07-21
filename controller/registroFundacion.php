<?php

	require_once '../model/Fundacion.php';
	require_once '../model/Validacion.php';
	require_once '../lib/Panel.php';	
	
	$fundacion 	= new Fundacion();
	$validacion = new Validacion();
	$correcto 	= true;
	$alert_text = "*Caracteres invalidos, no admitido acentos, ñ o simbolos  ";
	$alert_email= "*Email incorrecto";
	$alert_num  = "*No es un numero";
	$alert_repeat="*Ya existe en nuestra Base de Datos"; 	
	
	$rif	 	 = $_POST['rif'];
	$nombre 	 = $_POST['nombre'];
	$telefono 	 = $_POST['telefono'];
	$email	 	 = $_POST['email'];
	$direccion	 = $_POST['direccion'];
	
	$pnlmain = new Panel("../view/index.html");
	$pnlcontent = new Panel("../view/registroFundacion.html");
	
	//Validacion de los campos
	
	if($validacion->textValido($direccion)==false)
	{
		$pnlcontent->add("alert_direccion", $alert_text);
	}
	else
	{
		$pnlcontent->add("direccion", $direccion);
	}
	
	if($validacion->textValido($rif)==false)
	{
		$pnlcontent->add("alert_rif", $alert_text);
	}	
	elseif ($fundacion->findByRif($rif)==null)
	{
		$pnlcontent->add("rif", $rif);
	}
	else 
	{
		$pnlcontent->add("alert_rif", $alert_repeat);
		$pnlcontent->add("rif", $rif);
		$correcto 	= false;
	}
	
	if($validacion->nombreValido($nombre)==false)
	{
		$pnlcontent->add("alert_nombre", $alert_text);
		$correcto 	= false;
	}
	else
	{
		$pnlcontent->add("nombre", $nombre);
	}
	
		
	if($validacion->emailValido($email)==false)
	{
		$pnlcontent->add("alert_email", $alert_email);
		$correcto 	= false;
	}
	elseif ($fundacion->findByEmail($email)==null) 
	{
		$pnlcontent->add("email", $email);
	}
	else
	{
		$pnlcontent->add("alert_email", $alert_repeat);
		$pnlcontent->add("email", $email);
		$correcto 	= false;
	}
	
	if($validacion->numValido($telefono)==false)
	{
		$pnlcontent->add("alert_telefono", $alert_num);
		$correcto 	= false;
	}
	else
	{
		$pnlcontent->add("telefono", $telefono);
	}	
	
	

	if($correcto)
	{	    	
    	$fundacion->setNombre($nombre);;
    	$fundacion->setTelefono($telefono);
    	$fundacion->setEmail($email);
    	$fundacion->setRif($rif);
    	$fundacion->setDireccion($direccion);
		
		$resultado = $fundacion->registrar($fundacion);	
		
		if($resultado==false)
		{
			echo $resultado;
			$pnlcontent = new Panel("../view/error.html");
			$pnlcontent->add("aviso", "Ha ocurrido un error en el servidor intente luego.");
			$pnlmain->add("content", $pnlcontent);
			$pnlmain->show();
		}
		else
		{
			$pnlcontent = new Panel("../view/aviso.html");
			$pnlcontent->add("aviso", "Registro Exitoso");
			$pnlmain->add("content", $pnlcontent);
			$pnlmain->show();
		}
	}
	else
	{		
		$pnlmain->add("content", $pnlcontent);
		$pnlmain->show();
	}
	
?>